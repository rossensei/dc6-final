<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { setupCalendar, Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/style.css';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    onGoingTasksCount: Number,
    completedTasksCount: Number,
})
</script>

<template>
    <Head title="Home" />

    <AppLayout>
        <div class="w-full py-6 px-4">
            <h1 class="text-2xl font-semibold text-gray-700 mb-2">Dashboard</h1>

            <div class="flex flex-wrap items-center space-x-2">  
                <Link href="/tasks" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex-1 min-w-[280px]">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ onGoingTasksCount }}</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">On-going Tasks</p>
                </Link>    
                <Link href="/tasks/completed" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex-1 min-w-[280px]">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ completedTasksCount }}</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Completed Tasks</p>
                </Link>    
            </div>

            <div class="mt-4">
                <Calendar />
            </div>
        </div>
    </AppLayout>
</template>
