<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
</script>

<template>
    <AdminLayout>
        <div class="flex justify-center items-center bg-transparent mt-10">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!-- Botón para citas pendientes -->
                <button
                    class="p-6 bg-white border rounded-md shadow-md hover:shadow-lg transition duration-300 ease-in-out"
                    @click="navigateTo('citas/pendientes')"
                >
                    <h2 class="text-xl font-semibold mb-2">Citas Pendientes</h2>
                    <p class="text-gray-600">
                        Ver citas pendientes de confirmación.
                    </p>
                </button>

                <!-- Botón para citas aceptadas -->
                <button
                    class="p-6 bg-white border rounded-md shadow-md hover:shadow-lg transition duration-300 ease-in-out"
                    @click="navigateTo('citas/aceptadas')"
                >
                    <h2 class="text-xl font-semibold mb-2">Citas Aceptadas</h2>
                    <p class="text-gray-600">
                        Ver citas aceptadas y confirmadas.
                    </p>
                </button>

                <!-- Botón para citas rechazadas -->
                <button
                    class="p-6 bg-white border rounded-md shadow-md hover:shadow-lg transition duration-300 ease-in-out"
                    @click="navigateTo('citas/rechazadas')"
                >
                    <h2 class="text-xl font-semibold mb-2">Citas Rechazadas</h2>
                    <p class="text-gray-600">
                        Ver citas rechazadas y canceladas.
                    </p>
                </button>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
export default {
    methods: {
        navigateTo(route) {
            // Utiliza Inertia para navegar a la ruta deseada
            this.$inertia.visit(route);
        },
    },
};
</script>

<style scoped>
/* Puedes personalizar los estilos aquí según tus preferencias */
button {
    cursor: pointer;
    transition: transform 0.2s ease-in-out;
}

button:hover {
    transform: scale(1.05);
}
</style>
