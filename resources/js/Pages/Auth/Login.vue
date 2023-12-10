<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <div class="h-screen flex">
        <div
            class="hidden lg:flex w-full lg:w-1/2 login_img_section justify-around items-center"
        >
            <div class="bg-black opacity-20 inset-0 z-0"></div>
            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 class="text-white font-bold text-4xl font-sans">
                    PSICOPUTINA
                </h1>
                <p class="text-white mt-1">
                    “La mente es todo lo que somos, todo lo que hacemos comienza
                    con ella” - Earl Nightingale
                </p>
                <div class="flex justify-center lg:justify-start mt-6">
                    <a
                        href="#"
                        class="hover:bg-indigo-700 hover:text-white hover:-translate-y-1 transition-all duration-500 bg-white text-indigo-800 mt-4 px-4 py-2 rounded-2xl font-bold mb-2"
                        >Regresar</a
                    >
                </div>
            </div>
        </div>
        <div
            class="flex w-full lg:w-1/2 justify-center items-center bg-white space-y-8 text-center"
        >
            <div
                class="w-full px-8 md:px-32 lg:px-24 justify-center text-center"
            >
                <div class="flex justify-center mb-10">
                    <ApplicationLogo2 class="h-24 w-24" />
                </div>
                <form
                    @submit.prevent="submit"
                    class="bg-white rounded-md shadow-2xl p-5"
                >
                    <h1 class="text-gray-800 font-bold text-2xl mb-1">
                        Bienvenido de Vuelta
                    </h1>
                    <p class="text-sm font-normal text-gray-600 mb-8">
                        Ingresa tus credenciales para ingresar
                    </p>
                    <div
                        class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                            />
                        </svg>
                        <TextInput
                            id="email"
                            class="pl-2 w-full outline-none border-none"
                            type="email"
                            name="email"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Correo"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div
                        class="flex items-center border-2 mb-12 py-2 px-3 rounded-2xl"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fillRule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clipRule="evenodd"
                            />
                        </svg>
                        <TextInput
                            class="pl-2 w-full outline-none border-none"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>
                    <PrimaryButton
                        type="submit"
                        class="text-center justify-center block w-full bg-indigo-600 py-4 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Ingresar
                    </PrimaryButton>
                    <div class="flex justify-center mt-4 text-center">
                        <Link
                            :href="route('register')"
                            class="text-sm ml-2 hover:text-blue-500 cursor-pointer hover:-translate-y-1 duration-500 transition-all"
                            >¿Aun no tienes tu cuenta?</Link
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
.login_img_section {
    background: linear-gradient(rgba(2, 2, 2, 0.7), rgba(0, 0, 0, 0.7)),
        url(https://scontent.flim14-1.fna.fbcdn.net/v/t39.30808-6/277559592_321113933344067_4733414263101819638_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=783fdb&_nc_ohc=oKisDHo4lTAAX-altsu&_nc_oc=AQlfUemNOu9mwejylm2aslHlCg4Px82HC9zUKfp2vGhfdl6jF8vpF0ZhrIh2N_ztv4w&_nc_ht=scontent.flim14-1.fna&oh=00_AfDw6tbGD8ujnWOtI42QOZsgudbDJBZxa0iAlkT64YevVw&oe=6578B179)
            center center;
}
</style>
