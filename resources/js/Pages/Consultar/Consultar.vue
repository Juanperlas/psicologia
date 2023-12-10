<script setup>
import Consulta from "@/Components/Consulta.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="uppercase p-3 bg-black rounded-full text-white w-full font-semibold text-center"
            >
                PANEL DE CONSULTAS
            </h2>
        </template>
        <Consulta
            ><template #oficina>{{
                $page.props.auth.user.oficina_id
            }}</template>
            <template #usuario>{{ $page.props.auth.user.name }}</template>
            <template #correo>{{
                $page.props.auth.user.email
            }}</template></Consulta
        >
    </AuthenticatedLayout>
</template>
