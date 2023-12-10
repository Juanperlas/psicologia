<script setup>
import { ref } from "vue";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import NavLinkTwo from "@/Components/NavLinkTwo.vue";
import { Link } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import "@fortawesome/fontawesome-free/css/all.css";

const showingNavigationDropdown = ref(false);
const { hasRole } = usePermission();
</script>

<template>
    <div class="bg-slate-300 h-screen">
        <nav class="block w-full h-26 p-2 bg-white fixed top-0 z-50 mb-0">
            <div class="items-center justify-between grid grid-cols-6 gap-4">
                <!-- Header logo -->
                <div class="flex col-span-1 text-center justify-center">
                    <Link
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="text-white text-3xl font-bold font-heading hidden xl:flex"
                    >
                        <ApplicationLogo2 class="h-12" />
                    </Link>
                </div>

                <!-- Mobile toggle -->
                <div class="md:hidden flex justify-start">
                    <button @click="drawer">
                        <svg
                            class="h-14 w-10 fill-current text-black"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navbar -->
                <div
                    class="hidden md:block col-span-4 text-center items-center px-8 bg-white rounded-2xl"
                >
                    <div class="flex justify-center">
                        <div class="flex-1 group">
                            <NavLinkTwo
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                <span class="block px-1 pt-1 pb-2">
                                    <i class="fa-solid fa-house"></i>
                                    <span class="block text-md pb-1"
                                        >Inicio</span
                                    >
                                </span>
                            </NavLinkTwo>
                        </div>
                        <div class="flex-1 group">
                            <NavLinkTwo
                                :href="route('consultas.index')"
                                :active="route().current('consultas.index')"
                            >
                                <span class="block px-1 pt-1 pb-2">
                                    <i class="fa-solid fa-pen"></i>
                                    <span class="block text-md pb-1"
                                        >Consultar</span
                                    >
                                </span>
                            </NavLinkTwo>
                        </div>
                        <div class="flex-1 group">
                            <NavLinkTwo
                                :href="route('reserva.index')"
                                :active="route().current('reserva.index')"
                            >
                                <span class="block px-1 pt-1 pb-2">
                                    <div class="flex justify-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 group-hover:text-white"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                            />
                                        </svg>
                                    </div>
                                    <span class="block text-md pb-1"
                                        >Reservar</span
                                    >
                                </span>
                            </NavLinkTwo>
                        </div>

                        <div class="flex-1 group">
                            <NavLinkTwo
                                :href="route('reserva.historial')"
                                :active="route().current('reserva.historial')"
                            >
                                <span class="block px-1 pt-1 pb-2">
                                    <div class="flex justify-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 group-hover:text-white"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                            />
                                        </svg>
                                    </div>
                                    <span class="block text-md pb-1"
                                        >Historial</span
                                    >
                                </span>
                            </NavLinkTwo>
                        </div>
                        <div class="flex-1 group" v-if="hasRole('admin')">
                            <NavLinkTwo
                                :href="route('users.index')"
                                :active="route().current('users.index')"
                            >
                                <span class="block px-1 pt-1 pb-2">
                                    <div
                                        class="flex justify-center text-center"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                    </div>
                                    <span class="block text-md pb-1"
                                        >ADMIN</span
                                    >
                                </span>
                            </NavLinkTwo>
                        </div>
                    </div>
                </div>
                <div
                    class="hidden xl:flex space-x-5 items-center col-span-1 justify-center text-center"
                >
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-md text-black leading-4 font-medium rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-400 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6 mr-2"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink
                                        :href="route('profile.edit')"
                                        class="hover:bg-slate-300"
                                    >
                                        Mi Perfil
                                    </DropdownLink>
                                    <DropdownLink
                                        class="hover:bg-slate-300"
                                        v-if="hasRole('admin')"
                                        :href="route('users.index')"
                                        :active="route().current('users.index')"
                                    >
                                        Administrar
                                    </DropdownLink>
                                    <DropdownLink
                                        class="hover:bg-slate-300"
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Cerrar Sesión
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Dark Background Transition -->
                <transition
                    enter-class="opacity-0"
                    enter-active-class="ease-out transition-medium"
                    enter-to-class="opacity-100"
                    leave-class="opacity-100"
                    leave-active-class="ease-out transition-medium"
                    leave-to-class="opacity-0"
                >
                    <div
                        @keydown.esc="isOpen = false"
                        v-show="isOpen"
                        class="z-10 fixed inset-0 transition-opacity"
                    >
                        <div
                            @click="isOpen = false"
                            class="absolute inset-0 bg-blue-500 opacity-50"
                            tabindex="0"
                        ></div>
                    </div>
                </transition>

                <!-- Drawer Menu -->
                <aside
                    class="p-5 transform top-0 left-0 w-64 bg-white fixed h-full overflow-auto ease-in-out transition-all duration-300 z-30"
                    :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
                >
                    <div class="close">
                        <button
                            class="absolute top-0 right-0 mt-4 mr-4"
                            @click="isOpen = false"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <span
                        @click="isOpen = false"
                        class="flex w-full items-center p-4 border-b"
                    >
                    </span>

                    <ul class="divide-y font-sans">
                        <li>
                            <div
                                class="flex text-center justify-center pt-5 pb-5"
                            >
                                <Link
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                    class="text-black text-3xl font-bold font-heading"
                                >
                                    <ApplicationLogo2 />
                                </Link>
                            </div>
                        </li>
                        <li class="block p-auto w-full uppercase pt-4 pb-3">
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i> PANEL DE
                                    INICIO
                                </span>
                            </NavLink>
                        </li>
                        <li class="block p-auto w-full uppercase pt-4 pb-3">
                            <NavLink
                                :href="route('consultas.index')"
                                :active="route().current('consultas.index')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i> CONSULTAS
                                </span>
                            </NavLink>
                        </li>
                        <li class="block p-auto w-full uppercase pt-4 pb-3">
                            <NavLink
                                :href="route('reserva.index')"
                                :active="route().current('reserva.index')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i> RESERVAR
                                </span>
                            </NavLink>
                        </li>
                        <li class="block p-auto w-full uppercase pt-4 pb-3">
                            <NavLink
                                :href="route('reserva.historial')"
                                :active="route().current('reserva.historial')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i> HISTORIAL
                                </span>
                            </NavLink>
                        </li>
                        <li
                            class="block p-auto w-full uppercase pt-4 pb-3"
                            v-if="hasRole('admin')"
                        >
                            <NavLink
                                :href="route('admin.citas')"
                                :active="route().current('admin.citas')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i>
                                    ADMINISTRADOR
                                </span>
                            </NavLink>
                        </li>
                        <li>
                            <NavLinkTwo
                                :href="route('logout')"
                                method="post"
                                as="button"
                                @click="isOpen = false"
                                class="my-8 w-full text-center font-semibold cta inline-block bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded text-white"
                                >Cerrar Sesión</NavLinkTwo
                            >
                        </li>
                    </ul>
                </aside>
            </div>
        </nav>
        <header
            class="bg-white dark:bg-gray-800 shadow"
            :style="{ marginTop: '80px' }"
            v-if="$slots.header"
        >
            <div class="w-full mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false,
        };
    },
    methods: {
        drawer() {
            this.isOpen = !this.isOpen;
        },
    },
    watch: {
        isOpen: {
            immediate: true,
            handler(isOpen) {
                if (typeof process !== "undefined" && process.client) {
                    if (isOpen)
                        document.body.style.setProperty("overflow", "hidden");
                    else document.body.style.removeProperty("overflow");
                }
            },
        },
    },
    mounted() {
        document.addEventListener("keydown", (e) => {
            if (e.keyCode == 27 && this.isOpen) this.isOpen = false;
        });
    },
};
</script>
