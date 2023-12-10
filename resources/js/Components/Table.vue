<script setup></script>
<template>
    <div class="relative overflow-x-auto">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-center text-xs text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <slot name="header"></slot>
            </thead>
            <tbody
                class="text-center text-xs text-black bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>
