<script setup>
import Estadistica2 from "@/Components/Estadistica2.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import ChartJs from "@/Components/ChartJs.vue";
import { computed } from "vue";

// const chartData = computed(() =>
//     props.registros.map((registro) => registro.idControl)
// );
// const chartLabels = computed(() =>
//     props.registros.map((registro) => registro.nombre_usuario)
// );

const Labels = ["Admin", "Puerta", "Secretaria", "Tesoreria", "OTI", "Obras"];
const Colors = ["skyblue", "purple", "orange", "brown", "red", "yellow"];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="uppercase p-3 bg-black rounded-full text-white w-full font-semibold text-center"
            >
                PANEL DE INICIO
            </h2>
        </template>
        <Estadistica2>
            <template #oficina>{{ $page.props.auth.user.oficina_id }}</template>
            <template #usuario>{{ $page.props.auth.user.name }}</template>
            <template #correo>{{ $page.props.auth.user.email }}</template>
            <template #visitasTotales>{{}}</template>
            <template #visitasHoy>{{}}</template>
            <template #visitasActuales>{{}}</template>
            <template #adminHoy>{{}}</template>
            <template #adminTotal>{{}}</template>
            <template #puertaHoy>{{}}</template>
            <template #puertaTotal>{{}}</template>
            <template #secretariaHoy>{{}}</template>
            <template #secretariaTotal>{{}}</template>
            <template #tesoreriaHoy>{{}}</template>
            <template #tesoreriaTotal>{{}}</template>
            <template #otiHoy>{{}}</template>
            <template #otiTotal>{{}}</template>
            <template #obrasHoy>{{}}</template>
            <template #obrasTotal>{{}}</template>
            <template #graficos
                ><ChartJs
                    :chart-data="[]"
                    :chart-labels="Labels"
                    chart-label="Visitas de Oficinas Hoy"
                    :chart-colors="Colors"
                ></ChartJs>
                <ChartJs
                    :chart-data="[]"
                    :chart-labels="Labels"
                    chart-label="Visitas de Oficinas Totales"
                    :chart-colors="Colors"
                ></ChartJs
            ></template>
        </Estadistica2>
    </AuthenticatedLayout>
</template>
<script>
export default {
    components: {
        ChartJs,
    },
};
</script>
