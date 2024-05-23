<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div> -->
            <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-4 p-5">  
                <div class="p-3 rounded-xl w-full h-[20vh] bg-white shadow-2xl">
                    <div class="p-2 flex flex-col h-full">
                        <h1 class="text-3xl flex-1">Total Students</h1>
                        <span class="text-3xl mb-5 text-red-400">0</span>
                    </div>
                </div>

                <div class="p-3 rounded-xl w-full h-[20vh] bg-white shadow-2xl">
                    <div class="p-2 flex flex-col h-full">
                        <h1 class="text-3xl flex-1">Total Teachers</h1>
                        <span class="text-3xl mb-5 text-red-400">0</span>
                    </div>
                </div>

                <div class="p-3 rounded-xl w-full h-[20vh] bg-white shadow-2xl">
                    <div class="p-2 flex flex-col h-full">
                        <h1 class="text-3xl flex-1">User Online</h1>
                        <span class="text-3xl mb-5 text-red-400">0</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
body {
    background-color: #34495e;
}
</style>