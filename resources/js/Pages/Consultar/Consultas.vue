<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="uppercase p-3 bg-black rounded-full text-white w-full font-semibold text-center"
            >
                TODAS LAS CONSULTAS
            </h2>
        </template>
        <ConsultaT>
            <template #oficina>{{ $page.props.auth.user.oficina_id }}</template>
            <template #usuario>{{ $page.props.auth.user.name }}</template>
            <template #correo>{{ $page.props.auth.user.email }}</template>
            <div class="w-full bg-gray-800">
                <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-6">
                    <div class="text-center pb-6">
                        <h2 class="text-base font-bold text-white uppercase">
                            Todas las consultas realizadas
                        </h2>
                    </div>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <!-- Iterar sobre las consultas -->
                        <div
                            v-for="consulta in $page.props.consultas"
                            :key="consulta.id"
                            class="w-full bg-gray-900 rounded-lg shadow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <img
                                    v-if="
                                        consulta.usuario &&
                                        consulta.usuario.imagen
                                    "
                                    class="object-center object-cover rounded-full h-28 w-28"
                                    :src="consulta.usuario.imagen"
                                    alt="photo"
                                />
                                <img
                                    v-else
                                    class="object-center object-cover rounded-full h-28 w-28"
                                    src="https://static.vecteezy.com/system/resources/previews/020/765/399/non_2x/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg"
                                    alt="photo"
                                />
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">
                                    {{ consulta.usuario.name }}
                                </p>
                                <p class="text-base text-gray-400 font-normal">
                                    {{ consulta.mensaje }}
                                </p>
                            </div>
                        </div>
                        <!-- Fin del bucle de iteración -->
                    </div>
                </section>
            </div>
        </ConsultaT>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ConsultaT from "@/Components/ConsultaT.vue";
</script>
