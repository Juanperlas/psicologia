<template>
    <AdminLayout
        ><div>
            <h1>Citas Rechazadas</h1>
            <Table>
                <template #header>
                    <TableRow>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Usuario</TableHeaderCell>
                        <TableHeaderCell>Fecha</TableHeaderCell>
                        <TableHeaderCell>Hora Inicio</TableHeaderCell>
                        <TableHeaderCell>Hora Fin</TableHeaderCell>
                        <TableHeaderCell>Acciones</TableHeaderCell>
                    </TableRow>
                </template>
                <template #default>
                    <TableRow
                        v-for="cita in citasRechazadas"
                        :key="cita.id"
                        class="border-b"
                    >
                        <TableDataCell>{{ cita.id }}</TableDataCell>
                        <TableDataCell>{{
                            cita.usuario ? cita.usuario.name : "N/A"
                        }}</TableDataCell>
                        <TableDataCell>{{ cita.fecha }}</TableDataCell>
                        <TableDataCell>{{ cita.hora }}</TableDataCell>
                        <TableDataCell>{{ cita.hora_fin }}</TableDataCell>
                        <TableDataCell class="space-x-4">
                            <!-- Agregar botones o enlaces para aceptar y rechazar -->
                            <PrimaryButton @click="aceptarCita(cita.id)">
                                Aceptar
                            </PrimaryButton>
                            <SecondaryButton @click="rechazarCita(cita.id)">
                                Rechazar
                            </SecondaryButton>
                        </TableDataCell>
                    </TableRow>
                </template>
            </Table>
        </div></AdminLayout
    >
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";

const { citasRechazadas } = usePage().props;

// Agregar funciones para aceptar y rechazar citas
const aceptarCita = (id) => {
    // Lógica para aceptar la cita
};

const rechazarCita = (id) => {
    // Lógica para rechazar la cita
};
</script>
