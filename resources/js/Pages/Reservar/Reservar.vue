<script setup>
import Reserva2 from "@/Components/Reserva2.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

const form = ref({
    fecha: null,
    hora: null,
    hora_fin: null,
    processing: false,
    reservas: {},
});

let reservaActual = null;
// console.log("hola: ", $page.props.usuarioId);
const reservar = (dia, hora) => {
    const key = `${dia}-${hora}`;

    if (reservaActual === key) {
        // Cancelar la reserva actual si se hace clic nuevamente en el mismo botón
        form.value.reservas[key] = null;
        reservaActual = null;

        // Restablecer valores en el formulario
        form.value.fecha = null;
        form.value.hora = null;
        form.value.hora_fin = null;
    } else {
        // Cancelar la reserva actual si se hace clic en otro botón
        if (reservaActual) {
            form.value.reservas[reservaActual] = null;
        }

        // Realizar la nueva reserva
        form.value.reservas[key] = "reservado";
        reservaActual = key;

        // Actualizar los valores en el formulario
        form.value.fecha = dia;
        form.value.hora = hora;
        form.value.hora_fin = addHourToTime(hora); // Agregar una hora a la hora de inicio
    }
};

const addHourToTime = (time) => {
    const [hour, minute] = time.split(":");
    const newHour = parseInt(hour) + 1;
    return `${newHour.toString().padStart(2, "0")}:${minute}`;
};

const isReservando = (dia, hora) => {
    const key = `${dia}-${hora}`;
    return reservaActual === key;
};

const submit = () => {
    // const formValues = toRefs(form.value);

    console.log("form: ", form);

    const form2 = useForm({
        fechaInput: form.value.fecha ? form.value.fecha : null,
        horaInput: form.value.hora ? form.value.hora : null,
        hora_finInput: form.value.hora_fin ? form.value.hora_fin : null,
        processing: true,
        reservas: form.value.reservas ? form.value.reservas : {},
    });

    console.log("form2: ", form2);
    // Realiza el envío del formulario
    form2.post(route("reserva.store"), {
        onFinish: () => {
            form2.processing = false;
            form2.reset();
        },
    });
};
</script>

<template>
    <Head title="Reservar" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="uppercase p-3 bg-black rounded-full text-white w-full font-semibold text-center"
            >
                PANEL DE RESERVAS
            </h2>
        </template>
        <Reserva2>
            <template #oficina>{{ $page.props.auth.user.oficina_id }}</template>
            <template #usuario>{{ $page.props.auth.user.name }}</template>
            <template #correo>{{ $page.props.auth.user.email }}</template>
            <div class="relative overflow-x-auto">
                <table
                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400 justify-center text-center"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th class="px-6 py-4">Hora/Día</th>
                            <th
                                v-for="(dia, index) in dias"
                                :key="index"
                                class="px-6 py-4"
                            >
                                {{ getFormattedDate(dia) }}
                                <!-- Usa la función para obtener la fecha formateada -->
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr v-for="(hora, horaIndex) in horas" :key="horaIndex">
                            <td class="px-6 py-3">{{ hora }}</td>
                            <td
                                v-for="(dia, diaIndex) in dias"
                                :key="diaIndex"
                                class="px-6 py-3"
                            >
                                <button
                                    :class="{
                                        reservando: isReservando(dia, hora),
                                        ocupado:
                                            getButtonClass(dia, hora) ===
                                            'ocupado',
                                        disponible:
                                            getButtonClass(dia, hora) ===
                                            'disponible',
                                        reservado:
                                            getButtonClass(dia, hora) ===
                                            'reservado',
                                        seleccionado:
                                            form.reservas[`${dia}-${hora}`] ===
                                            'reservado',
                                    }"
                                    :disabled="isDisabled(dia, hora)"
                                    @click="reservar(dia, hora)"
                                >
                                    {{ getButtonText(dia, hora) }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center mt-4 items-center text-center">
                <form @submit.prevent="submit">
                    <!-- Agrega los campos necesarios para la reserva -->
                    <input
                        v-model="form.fecha"
                        type="text"
                        readonly
                        placeholder="Fecha de la reserva"
                        class="text-center"
                    />
                    <input
                        v-model="form.hora"
                        type="time"
                        required
                        readonly
                        placeholder="Hora de inicio"
                        class="justify-items-center"
                    />
                    <input
                        v-model="form.hora_fin"
                        type="time"
                        required
                        readonly
                        placeholder="Hora de fin"
                    />

                    <!-- Botones -->
                    <div class="mt-5 buttons flex justify-center">
                        <Link
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                            class="mx-2 p-2 rounded-md btn border bg-black hover:bg-slate-600 border-gray-300 px-4 font-semibold cursor-pointer text-gray-200"
                        >
                            Cancelar
                        </Link>

                        <!-- Botón Pendiente o Confirmar Reserva -->
                        <button
                            v-if="haReservadoRecientemente"
                            disabled
                            class="mx-2 p-2 btn bg-red-500 text-white rounded-lg hover:bg-red-700 font-bold shadow-xl"
                            title="Ya haz realizado tu reserva"
                        >
                            Ya Reservaste
                        </button>
                        <PrimaryButton
                            v-else
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            type="submit"
                            class="mx-2"
                        >
                            Confirmar Reserva
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </Reserva2>
    </AuthenticatedLayout>
</template>

<script>
import { format, addDays, parseISO } from "date-fns";
import es from "date-fns/locale/es";

export default {
    props: {
        citasPendientes: Object,
        citasAceptadas: Object,
        idUsuarios: Array,
        usuarioId: Number,
    },
    data() {
        return {
            horas: [
                "08:00",
                "09:00",
                "10:00",
                "11:00",
                "14:00",
                "15:00",
                "16:00",
                "17:00",
            ],
            reservas: {},
            reservaActual: null,
            fechaInicio: new Date(),
        };
    },
    computed: {
        dias() {
            const dias = [];
            let fechaActual = addDays(this.fechaInicio, 1); // Comienza desde el día siguiente

            while (dias.length < 5) {
                const formattedDate = format(fechaActual, "yyyy-MM-dd");
                dias.push(formattedDate);
                fechaActual = addDays(fechaActual, 1);
            }

            return dias;
        },
        haReservadoRecientemente() {
            console.log("this.idUsuarios:", this.idUsuarios);
            console.log("usuarioID:", this.usuarioId);

            // Convierte el objeto directamente a un array de claves
            const idKeys = Object.values(this.idUsuarios);

            // Verifica si el usuarioId está presente en el array de claves
            const result = idKeys.includes(this.usuarioId);

            console.log("Result:", result);

            return result;
        },
    },
    methods: {
        // Otras funciones para determinar el estado de las celdas
        isOcupado(dia, hora) {
            const key = `${dia}-${hora}`;
            return this.citasAceptadas[key];
        },
        isDisponible(dia, hora) {
            const key = `${dia}-${hora}`;
            return (
                !this.citasAceptadas[key] &&
                !this.citasPendientes[key] &&
                reservaActual !== key
            );
        },
        getFormattedDate(dia) {
            const dateObject = parseISO(dia); // Convierte la cadena de fecha a un objeto de fecha
            return format(dateObject, "EEEE, dd/MM/yyyy", { locale: es });
        },
        reservar(dia, hora) {
            const key = `${dia}-${hora}`;
            if (this.form.reservas[key] === "reservado") {
                this.form.reservas[key] = null;
            } else {
                for (const k in this.form.reservas) {
                    this.form.reservas[k] = null;
                }
                this.form.reservas[key] = "reservado";
            }

            this.reservaActual = this.form.reservas[key] ? key : null;

            // Actualiza los valores en form
            this.form.fecha = this.getFormattedDate(dia); // Usa la función para obtener la fecha formateada
            this.form.hora = hora;
            this.form.hora_fin = addHourToTime(hora); // Agrega una hora a la hora de inicio
        },
        getButtonClass(dia, hora) {
            const key = `${dia}-${hora}`;
            if (this.citasAceptadas[key]) {
                return "reservado";
            } else if (this.citasPendientes[key]) {
                return "ocupado";
            } else if (this.reservaActual === key) {
                return "reservando";
            } else {
                return "disponible";
            }
        },

        isDisabled(dia, hora) {
            const key = `${dia}-${hora}`;
            return this.citasAceptadas[key] || this.citasPendientes[key];
        },
        getButtonText(dia, hora) {
            const key = `${dia}-${hora}`;
            if (this.citasAceptadas[key]) {
                return "Reservado";
            } else if (this.citasPendientes[key]) {
                return "Pendiente";
            } else if (this.reservaActual === key) {
                return "Reservando";
            } else {
                return "Reservar";
            }
        },
        confirmarReserva() {
            this.$inertia.post(route("reserva.store"), this.form);
        },
        cancelarReservaActual() {
            if (this.reservaActual) {
                const [dia, hora] = this.reservaActual.split("-");
                this.reservas[this.reservaActual] = null;
                this.reservaActual = null;
            }
        },
    },
};
</script>

<style scoped>
button {
    transition: all 0.3s ease;
}
button.disponible {
    background-color: yellow;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
    color: black;
    padding: 8px;
    border-radius: 15%;
    justify-items: center;
    justify-content: center;
    text-align: center;
    font-weight: bold;
}
button.reservando {
    background-color: green;
    color: white;
    transform: scale(1.3);
    padding: 8px;
    border-radius: 15%;
    justify-items: center;
    justify-content: center;
    text-align: center;
    font-weight: bold;
}
button.ocupado {
    background-color: gray;
    color: white;
    font-weight: bold;
    padding: 8px;
    border-radius: 15%;
    justify-items: center;
    justify-content: center;
    text-align: center;
}
button.reservado {
    background-color: red;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
    color: white;
    padding: 8px;
    border-radius: 15%;
    justify-items: center;
    justify-content: center;
    text-align: center;
    font-weight: bold;
}
</style>
