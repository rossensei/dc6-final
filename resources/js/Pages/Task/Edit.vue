<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    task: Object,
    users: Array,
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
        name: 'Edit Task Details',
        url: null,
        active: true,
    },
]

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    user_id: props.task.user_id,
    due_date: props.task.due_date,
})

const submit = () => {
    form.patch('/tasks/update/' + props.task.id, {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <Head title="Create User" />

    <AppLayout>
        <div class="w-full py-6 px-4">
            <Breadcrumb :crumbs="crumbs" class="mb-2" />
            <h1 class="text-2xl font-semibold text-gray-700 mb-4">Edit task details</h1>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="title" value="Title" />
                    <TextInput v-model="form.title" id="title" type="text" class="w-full text-sm max-w-2xl"/>
                    <InputError :message="form.errors.title" />
                </div>
                <div class="mb-4">
                    <InputLabel for="description" value="Description" />
                    <!-- <TextInput v-model="form.description" id="description" type="description" class="w-full text-sm max-w-2xl"/> -->
                    <textarea v-model="form.description" id="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full text-sm max-w-2xl"></textarea>
                    <InputError :message="form.errors.description" />
                </div>
                <div class="mb-4">
                    <InputLabel for="due_date" value="Due date" />
                    <TextInput v-model="form.due_date" id="due_date" type="date" class="w-full text-sm max-w-2xl"/>
                    <InputError :message="form.errors.due_date" />
                </div>

                <div class="mb-4">
                    <InputLabel for="user_id" value="Assign to user" />
                    <select v-model="form.user_id" id="user_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full text-sm max-w-2xl">
                        <option value="">Select a user</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                    </select>
                    <InputError :message="form.errors.user_id" />
                </div>

                <div class="flex">
                    <button type="submit" class="px-4 py-2 rounded-md bg-[#004385] hover:bg-[#0057A1] text-white text-sm" :disabled="form.processing">
                        Update task
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>