<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["citasPendientes"]);
const form = useForm({});

const showConfirmActionModal = ref(false);

const confirmAction = (action, cita) => {
    form.put(route(`citas.pendientes.${action}`, { id: cita.id }), null, {
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    showConfirmActionModal.value = false;
};
</script>

<template>
    <Head title="Citas Pendientes" />
    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Citas Pendientes</h1>
            </div>
            <div class="mt-6">
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
                            v-for="cita in citasPendientes"
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
                                <PrimaryButton
                                    @click="confirmAction('aceptar', cita)"
                                    >Aceptar</PrimaryButton
                                >
                                <SecondaryButton
                                    @click="confirmAction('rechazar', cita)"
                                    >Rechazar</SecondaryButton
                                >
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
                <Modal :show="showConfirmActionModal" @close="closeModal">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-slate-800">
                            ¿Estás seguro de realizar esta acción?
                        </h2>
                        <div class="mt-6 flex space-x-4">
                            <PrimaryButton
                                @click="confirmAction('aceptar', cita)"
                                >Aceptar</PrimaryButton
                            >
                            <SecondaryButton
                                @click="confirmAction('rechazar', cita)"
                                >Rechazar</SecondaryButton
                            >
                        </div>
                    </div>
                </Modal>
            </div>
        </div>
    </AdminLayout>
</template>
