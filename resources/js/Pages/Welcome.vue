<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-black text-white py-20">
        <div
            class="container mx-auto flex flex-col md:flex-row items-center my-12 md:my-24"
        >
            <div
                class="flex flex-col w-full lg:w-1/3 justify-center items-start p-8"
            >
                <h1
                    class="text-4xl font-extrabold md:text-5xl p-2 text-blue-300 tracking-loose"
                >
                    PSICOPUTINA
                </h1>
                <h2
                    class="text-xl md:text-3xl leading-relaxed md:leading-snug mb-2"
                >
                    "Es importante que busques ayuda profesional si necesitas
                    apoyo."
                </h2>
                <p class="text-sm md:text-base text-gray-50 mb-4">
                    "El cambio es posible. Con el tiempo y el esfuerzo, puedes
                    superar tus dificultades."
                </p>
                <div v-if="canLogin" class="mt-10">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Dashboard</Link
                    >

                    <template v-else>
                        <div class="w-24">
                            <Link
                                :href="route('login')"
                                class="hover:bg-slate-200 transition text-black duration-150 ease-linear rounded-lg py-3 p-2 grou bg-white"
                                ><button>Ingresar</button></Link
                            >
                        </div>
                        <div class="mt-10">
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="hover:bg-slate-200 transition text-black duration-150 ease-linear rounded-lg py-3 p-2 grou bg-white"
                                >Registrarse</Link
                            >
                        </div>
                    </template>
                </div>
            </div>
            <div
                class="p-8 mt-12 mb-6 md:mb-0 md:mt-0 ml-0 md:ml-12 lg:w-2/3 justify-center"
            >
                <div class="h-48 flex flex-wrap content-center">
                    <div>
                        <img
                            class="inline-block mt-28 hidden xl:block"
                            src="https://www.cromosomax.com/pics/2023/03/que-es-ambigua-en-psicologia.png"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
