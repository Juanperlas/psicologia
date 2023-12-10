<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import NavLinkTwo from "@/Components/NavLinkTwo.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import "@fortawesome/fontawesome-free/css/all.css";
import SidebarLink from "@/Components/SidebarLink.vue";

const showingNavigationDropdown = ref(false);
const { hasRole } = usePermission();
</script>
<template>
    <div class="sidebar col-span-3 rounded-lg p-4">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus icon"
                ><GlobeAltIcon class="h-8 w-8 text-white"
            /></i>
            <div class="logo_name flex justify-center uppercase text-center">
                PSICOPUTINA
            </div>
        </div>
        <ul class="nav-list space-y-4">
            <li>
                <i
                    class="bx bx-search flex justify-center items-center text-center"
                    ><SearchIcon class="h-8 w-8 text-white"
                /></i>
                <input type="text" placeholder="Buscar..." />
                <span class="tooltip">Buscar</span>
            </li>
            <li>
                <Link
                    :href="route('admin.citas')"
                    :active="route().current('admin.citas')"
                >
                    <i
                        class="bx bx-grid-alt flex justify-center items-center text-center"
                        ><HomeIcon class="h-8 w-8 text-white" />
                    </i>
                    <span class="links_name">Inicio</span>
                </Link>
                <span class="tooltip">Inicio</span>
            </li>
            <li>
                <Link
                    :href="route('users.index')"
                    :active="route().current('users.index')"
                >
                    <i
                        class="bx bx-user flex justify-center items-center text-center"
                        ><UserGroupIcon class="h-8 w-8 text-white"
                    /></i>
                    <span class="links_name">Usuarios</span>
                </Link>
                <span class="tooltip">Usuarios</span>
            </li>
            <li>
                <Link
                    :href="route('roles.index')"
                    :active="route().current('roles.index')"
                >
                    <i
                        class="bx bx-pie-chart-alt-2 flex justify-center items-center text-center"
                        ><FingerPrintIcon class="h-8 w-8 text-white"
                    /></i>
                    <span class="links_name">Roles</span>
                </Link>
                <span class="tooltip">Roles</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img
                        src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                        alt="profileImg"
                    />
                    <div class="name_job">
                        <div class="name">NOmbre</div>
                        <div class="job">Oficina</div>
                    </div>
                </div>
                <i class="bx bx-log-out" id="log_out"></i>
            </li>
            <li>
                <Link
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    <i
                        class="bx bx-folder flex justify-center items-center text-center"
                        ><OfficeBuildingIcon class="h-8 w-8 text-white"
                    /></i>
                    <span class="links_name">Volver</span>
                </Link>
                <span class="tooltip">Volver</span>
            </li>
        </ul>
    </div>

    <section class="sticky home-section">
        <nav class="sticky w-full h-26 p-2 bg-white shadow-md top-0">
            <div class="flex items-center justify-between px-10">
                <button
                    class="bx bx-menu flex justify-center items-center text-center"
                    id="btn"
                >
                    <MenuIcon class="h-8 w-8 text-black" />
                </button>
                <!-- Header logo -->
                <div class="flex col-span-1 text-center justify-center">
                    <Link
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="font-bold font-heading hidden xl:flex"
                    >
                        <img
                            src="https://web.cippuno.org.pe/wp-content/themes/templatecippuno/img/logocip.png"
                            class="h-16"
                        />
                    </Link>
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
                            <div class="text-center justify-center pt-5 pb-5">
                                <Link
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                    class="text-black text-3xl font-bold font-heading"
                                >
                                    PSICOPUTINA
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
                                :href="route('users.index')"
                                :active="route().current('users.index')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i> REGISTRAR
                                </span>
                            </NavLink>
                        </li>
                        <li class="block p-auto w-full uppercase pt-4 pb-3">
                            <NavLink
                                :href="route('users.index')"
                                :active="route().current('users.index')"
                            >
                                <span class="block px-1 pt-1 pb-2 w-full">
                                    <i class="fa-solid fa-list"></i> REGISTROS
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
        <div
            class="mx-auto gap-2 sm:gap-4 md:gap-6 lg:gap-10 xl:gap-14 max-w-[90%] my-10 px-2"
        >
            <slot></slot>
        </div>
    </section>
</template>

<script>
import { SearchIcon } from "@heroicons/vue/outline";
import {
    HomeIcon,
    UserGroupIcon,
    MenuIcon,
    FingerPrintIcon,
    CursorClickIcon,
    ArrowCircleRightIcon,
    OfficeBuildingIcon,
    NewspaperIcon,
    ChartPieIcon,
} from "@heroicons/vue/outline";

export default {
    components: {
        SearchIcon,
        HomeIcon,
        UserGroupIcon,
        FingerPrintIcon,
        CursorClickIcon,
        ArrowCircleRightIcon,
        NewspaperIcon,
        OfficeBuildingIcon,
        MenuIcon,
        ChartPieIcon,
        SidebarLink,
    },
    mounted() {
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        searchBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }
    },
};
</script>

<style>
/* Google Font Link */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    height: 100%;
    width: 78px;
    background: #11101d;
    padding: 6px 14px;
    z-index: 99;
    transition: all 0.5s ease;
}
.sidebar.open {
    width: 250px;
}
.sidebar .logo-details {
    height: 60px;
    display: flex;
    align-items: center;
    position: relative;
}
.sidebar .logo-details .icon {
    opacity: 0;
    transition: all 0.5s ease;
}
.sidebar .logo-details .logo_name {
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    opacity: 0;
    transition: all 0.5s ease;
}
.sidebar.open .logo-details .icon,
.sidebar.open .logo-details .logo_name {
    opacity: 1;
}
.sidebar .logo-details #btn {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    font-size: 22px;
    transition: all 0.4s ease;
    font-size: 23px;
    text-align: center;
    cursor: pointer;
    transition: all 0.5s ease;
}
.sidebar.open .logo-details #btn {
    text-align: right;
}
.sidebar i {
    color: #fff;
    height: 60px;
    min-width: 50px;
    font-size: 28px;
    text-align: center;
    line-height: 60px;
}
.sidebar .nav-list {
    margin-top: 20px;
    height: 100%;
}
.sidebar li {
    position: relative;
    margin: 8px 0;
    list-style: none;
}
.sidebar li .tooltip {
    position: absolute;
    top: -20px;
    left: calc(100% + 15px);
    z-index: 3;
    background: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 15px;
    font-weight: 400;
    opacity: 0;
    white-space: nowrap;
    pointer-events: none;
    transition: 0s;
}
.sidebar li:hover .tooltip {
    opacity: 1;
    pointer-events: auto;
    transition: all 0.4s ease;
    top: 50%;
    transform: translateY(-50%);
}
.sidebar.open li .tooltip {
    display: none;
}
.sidebar input {
    font-size: 15px;
    color: #fff;
    font-weight: 400;
    outline: none;
    height: 50px;
    width: 100%;
    width: 50px;
    border: none;
    border-radius: 12px;
    transition: all 0.5s ease;
    background: #1d1b31;
}
.sidebar.open input {
    padding: 0 20px 0 50px;
    width: 100%;
}
.sidebar .bx-search {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 22px;
    background: #1d1b31;
    color: #fff;
}
.sidebar.open .bx-search:hover {
    background: #1d1b31;
    color: #fff;
}
.sidebar .bx-search:hover {
    background: #fff;
    color: #11101d;
}
.sidebar li a {
    display: flex;
    height: 100%;
    width: 100%;
    border-radius: 12px;
    align-items: center;
    text-decoration: none;
    transition: all 0.4s ease;
    background: #11101d;
}
.sidebar li a:hover {
    background: #fff;
}
.sidebar li a .links_name {
    color: #fff;
    font-size: 15px;
    font-weight: 400;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: 0.4s;
}
.sidebar.open li a .links_name {
    opacity: 1;
    pointer-events: auto;
}
.sidebar li a:hover .links_name,
.sidebar li a:hover i {
    transition: all 0.5s ease;
    color: #11101d;
}
.sidebar li i {
    height: 50px;
    line-height: 50px;
    font-size: 18px;
    border-radius: 12px;
}
.sidebar li.profile {
    position: fixed;
    height: 60px;
    width: 78px;
    left: 0;
    bottom: -8px;
    padding: 10px 14px;
    background: #1d1b31;
    transition: all 0.5s ease;
    overflow: hidden;
}
.sidebar.open li.profile {
    width: 250px;
}
.sidebar li .profile-details {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
}
.sidebar li img {
    height: 45px;
    width: 45px;
    object-fit: cover;
    border-radius: 6px;
    margin-right: 10px;
}
.sidebar li.profile .name,
.sidebar li.profile .job {
    font-size: 15px;
    font-weight: 400;
    color: #fff;
    white-space: nowrap;
}
.sidebar li.profile .job {
    font-size: 12px;
}
.sidebar .profile #log_out {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    background: #1d1b31;
    width: 100%;
    height: 60px;
    line-height: 60px;
    border-radius: 0px;
    transition: all 0.5s ease;
}
.sidebar.open .profile #log_out {
    width: 50px;
    background: none;
}
.home-section {
    position: relative;
    background: #e4e9f7;
    min-height: 100vh;
    top: 0;
    left: 78px;
    width: calc(100% - 78px);
    transition: all 0.5s ease;
    z-index: 2;
}
.sidebar.open ~ .home-section {
    left: 250px;
    width: calc(100% - 250px);
}
.home-section .text {
    display: inline-block;
    color: #11101d;
    font-size: 25px;
    font-weight: 500;
    margin: 18px;
}
@media (max-width: 420px) {
    .sidebar li .tooltip {
        display: none;
    }
}
</style>
