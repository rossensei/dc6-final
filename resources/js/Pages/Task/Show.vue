<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    task: Object,
})

const crumbs = [
    {
        name: 'Home',
        url: '/home',
        active: false,
    },
    {
        name: 'Tasks',
        url: '/tasks',
        active: false,
    },
    {
        name: 'View Details',
        url: null,
        active: true,
    },
];
</script>

<template>
    <Head title="Create User" />

    <AppLayout>
        <div class="w-full py-6 px-4">
            <Breadcrumb :crumbs="crumbs" class="mb-2" />
            <h1 class="text-2xl font-semibold text-gray-700 mb-4">Show task details</h1>

            

            <div class="max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ props.task.title }}</h5>
                </a>
                <p class="font-normal text-xs text-left text-gray-500 dark:text-gray-400 mb-2">Due date: {{ new Date(props.task.due_date).toDateString() }} | Assigned to: {{ props.task.user.name }} </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{ props.task.description }}</p>
                <div class="flex items-center space-x-2">
                    <Link :href="'/tasks/edit/' + props.task.id" class="text-sm text-blue-600 hover:underline">
                        Edit task details
                    </Link>
                    <Link :href="'/tasks/delete/' + props.task.id" as="button" method="DELETE" class="text-sm text-red-600 hover:underline">
                        Remove
                    </Link>
                </div>
            </div>

        </div>
    </AppLayout>
</template>