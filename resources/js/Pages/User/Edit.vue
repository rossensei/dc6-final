<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const crumbs = [
    {
        name: 'Home',
        url: '/home',
        active: false,
    },
    {
        name: 'Users',
        url: '/admin/users',
        active: false,
    },
    {
        name: 'Edit User',
        url: null,
        active: true,
    },
];

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.roles[0]?.name,
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.patch('/admin/users/' + props.user.id, {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <Head title="Edit User" />

    <AppLayout>
        <div class="w-full py-6 px-4">
            <Breadcrumb :crumbs="crumbs" class="mb-2" />
            <h1 class="text-2xl font-semibold text-gray-700 mb-4">Edit user details</h1>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="name" value="Name" />
                    <TextInput v-model="form.name" id="name" type="text" class="w-full text-sm max-w-2xl"/>
                    <InputError :message="form.errors.name" />
                </div>
                <div class="mb-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput v-model="form.email" id="email" type="email" class="w-full text-sm max-w-2xl"/>
                    <InputError :message="form.errors.email" />
                </div>
                <div class="mb-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput v-model="form.password" id="password" type="password" class="w-full text-sm max-w-2xl"/>
                    <InputError :message="form.errors.password" />
                </div>
                <div class="mb-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput v-model="form.password_confirmation" id="password_confirmation" type="password" class="w-full text-sm max-w-2xl"/>
                </div>

                <div class="mb-4">
                    <InputLabel for="role" value="Role" />
                    <select v-model="form.role" id="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full text-sm max-w-2xl">
                        <option value="">--</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Manager">Manager</option>
                        <option value="User">User</option>
                    </select>
                    <InputError :message="form.errors.role" />
                </div>

                <div class="flex">
                    <button type="submit" class="px-4 py-2 rounded-md bg-[#004385] hover:bg-[#0057A1] text-white text-sm" :disabled="form.processing">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>