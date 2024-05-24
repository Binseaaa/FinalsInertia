<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    totalStudents: Number,
    totalTeachers: Number,
    studentsCleared: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-4 p-5">
                <!-- Total Students -->
                <div class="p-3 rounded-xl w-full h-[20vh] bg-white shadow-2xl">
                    <div class="p-2 flex flex-col h-full">
                        <h1 class="text-3xl flex-1">Total Students</h1>
                        <span class="text-3xl mb-5 text-red-400">{{ totalStudents }}</span>
                    </div>
                </div>

                <!-- Students Cleared -->
                <div class="p-3 rounded-xl w-full h-[20vh] bg-white shadow-2xl">
                    <div class="p-2 flex flex-col h-full">
                        <h1 class="text-3xl flex-1">Students Cleared</h1>
                        <span class="text-3xl mb-5 text-red-400">{{ studentsCleared }}</span>
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
