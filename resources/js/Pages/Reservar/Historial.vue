<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { format } from "date-fns";
import Reserva from "@/Components/Reserva.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    citasPendientes: Array,
    citasAceptadas: Array,
    citasRechazadas: Array,
});
const form = useForm({});

const abrirBoleta = (id, type) => {
    window.open(`/reserva/historial/${id}/${type}`, "_blank");
};

const formatDate = (date) => {
    return format(new Date(date), "dd/MM/yyyy");
};
const formatTime = (time) => {
    // Convierte la cadena de tiempo a un objeto de fecha
    const date = new Date(time);

    // Utiliza la función format de date-fns para formatear la hora
    return format(date, "HH:mm:ss");
};
</script>

<template>
    <Head title="Citas index" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="uppercase p-3 bg-black rounded-full text-white w-full font-semibold text-center"
            >
                PANEL DE HISTORIAL
            </h2>
        </template>
        <Reserva>
            <div class="w-full mx-auto py-4 x">
                <div class="mt-6">
                    <div>
                        <h2
                            class="mt-6 uppercase rounded-t-2xl p-2 bg-gray-600 text-white w-full font-semibold text-center"
                        >
                            CITAS PENDIENTES
                        </h2>
                    </div>
                    <Table>
                        <!-- Header de la tabla -->
                        <template #header>
                            <TableRow
                                class="bg-gray-300 shadow-black shadow-inner"
                            >
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Fecha</TableHeaderCell>
                                <TableHeaderCell>Hora</TableHeaderCell>
                                <TableHeaderCell>Estado</TableHeaderCell>
                                <TableHeaderCell>Opciones</TableHeaderCell>
                            </TableRow>
                        </template>
                        <!-- Contenido de la tabla -->
                        <template #default>
                            <TableRow
                                v-for="cita in props.citasPendientes"
                                :key="cita.id"
                                class="border-b bg-gray-100"
                            >
                                <TableDataCell>{{ cita.id }}</TableDataCell>
                                <TableDataCell>{{
                                    formatDate(cita.fecha)
                                }}</TableDataCell>
                                <TableDataCell>{{
                                    formatTime(cita.hora)
                                }}</TableDataCell>
                                <TableDataCell>{{ cita.tipo }}</TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <PrimaryButton
                                        @click="
                                            () =>
                                                abrirBoleta(
                                                    cita.id,
                                                    'comprobantep'
                                                )
                                        "
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Comp
                                    </PrimaryButton>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>

                    <div>
                        <h2
                            class="mt-6 uppercase p-2 rounded-t-2xl bg-green-600 text-white w-full font-semibold text-center"
                        >
                            CITAS RECHAZADAS
                        </h2>
                    </div>
                    <Table>
                        <!-- Header de la tabla -->
                        <template #header>
                            <TableRow
                                class="bg-green-300 shadow-black shadow-inner"
                            >
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Fecha</TableHeaderCell>
                                <TableHeaderCell>Hora</TableHeaderCell>
                                <TableHeaderCell>Estado</TableHeaderCell>
                                <TableHeaderCell>Opciones</TableHeaderCell>
                            </TableRow>
                        </template>
                        <!-- Contenido de la tabla -->
                        <template #default>
                            <TableRow
                                v-for="cita in props.citasAceptadas"
                                :key="cita.id"
                                class="border-b bg-green-100"
                            >
                                <TableDataCell>{{ cita.id }}</TableDataCell>
                                <TableDataCell>{{
                                    formatDate(cita.fecha)
                                }}</TableDataCell>
                                <TableDataCell>{{
                                    formatTime(cita.hora)
                                }}</TableDataCell>
                                <TableDataCell> Aceptada </TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <PrimaryButton
                                        @click="
                                            () =>
                                                abrirBoleta(
                                                    cita.id,
                                                    'comprobantea'
                                                )
                                        "
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Comp
                                    </PrimaryButton>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                    <div>
                        <h2
                            class="mt-6 uppercase p-2 rounded-t-2xl bg-red-600 text-white w-full font-semibold text-center"
                        >
                            CITAS RECHAZADAS
                        </h2>
                    </div>
                    <Table>
                        <!-- Header de la tabla -->
                        <template #header>
                            <TableRow
                                class="bg-red-300 shadow-black shadow-inner"
                            >
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Fecha</TableHeaderCell>
                                <TableHeaderCell>Hora</TableHeaderCell>
                                <TableHeaderCell>Estado</TableHeaderCell>
                                <TableHeaderCell>Opciones</TableHeaderCell>
                            </TableRow>
                        </template>
                        <!-- Contenido de la tabla -->
                        <template #default>
                            <TableRow
                                v-for="cita in props.citasRechazadas"
                                :key="cita.id"
                                class="border-b bg-red-100"
                            >
                                <TableDataCell>{{ cita.id }}</TableDataCell>
                                <TableDataCell>{{
                                    formatDate(cita.fecha)
                                }}</TableDataCell>
                                <TableDataCell>{{
                                    formatTime(cita.hora)
                                }}</TableDataCell>
                                <TableDataCell> Rechazada </TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <PrimaryButton
                                        @click="
                                            () =>
                                                abrirBoleta(
                                                    cita.id,
                                                    'comprobanter'
                                                )
                                        "
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Comp
                                    </PrimaryButton>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </Reserva>
    </AuthenticatedLayout>
</template>
