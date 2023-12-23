<script setup>
import Pagination from '@/Components/Pagination.vue';
import Modal from '@/Components/Modal.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, router, Link, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    users: Object,
    filters: Object
})

const search = ref(props.filters.search)

watch(search, debounce(function(newSearchVal) {

    let params = {
        search: newSearchVal,
    };

    // Object.keys(params).forEach(key => {
    //     if(params[key] === undefined || params[key])
    // })

    if(params && (params.search === undefined || params.search === '')) {
        delete params.search
    }

    router.get('/admin/users', params, { preserveState: true, replace: true });
},300))


// Modal
const isModalOpen = ref(false);

const closeModal = () => {
    isModalOpen.value = false;
}

const selectedUserIdForDelete = ref(null);

const deleteUser = (userId) => {
    isModalOpen.value = true;
    selectedUserIdForDelete.value = userId;
}

const confirm = () => {

    if(!selectedUserIdForDelete) {
        return;
    }

    router.delete('/admin/users/delete/' + selectedUserIdForDelete.value, {
        onSuccess: () => closeModal()
    })
}

// Server Response From Actions
const page = usePage();
</script>

<template>
    <Head title="Users" />

    <AppLayout>
        <div class="w-full py-6 px-4">

            <div v-if="page.props.flash.error" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-5 h-5 mr-1">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                  </svg>                  
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">Danger!</span> {{ page.props.flash.error }}
                </div>
            </div>              

            <div v-if="page.props.flash.success" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">Success!</span> {{ page.props.flash.success }}
                </div>
            </div>

            <h1 class="text-2xl font-semibold text-gray-700 mb-2">Users</h1>

            <div class="mb-2 flex items-center justify-between">
                <input v-model="search" type="search" placeholder="Search for users" class="px-3 py-2 rounded-md text-sm w-[300px]">

                <Link href="/admin/users/create" class="px-4 py-2 rounded-md bg-[#004385] hover:bg-[#0057A1] text-white text-sm">
                    Add New
                </Link>                
            </div>

            <div class="relative overflow-x-auto shadow-md rounded-md">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Joined On
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50" v-for="user in users.data" :key="user.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ user.name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ user.email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.role }}
                            </td>
                            <td class="px-6 py-4">
                                {{ new Date(user.created_at).toDateString() }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <Link :href="'/admin/users/edit/' + user.id" class="font-medium text-blue-600 hover:underline">Edit</Link>
                                    <button type="button" class="font-medium text-red-600 hover:underline" @click="deleteUser(user.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <Pagination
                :data="users"
                />
            </div>
        </div>

        <Modal :show="isModalOpen" @close="closeModal" maxWidth="md">
            <div class="p-6">

                <div class="flex items-start space-x-3">
                    <div class="shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6 text-red-500">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>
            
                    <div class="flex-1">
                        <h1 class="text-lg font-semibold text-red-600">Delete Confirmation</h1>
                        <div class="text-sm text-gray-800">
                            Are you sure you want to delete this user? This action cannot be undone.
                        </div>
                    </div>
            
                    <div class="shrink-0">
                        <button @click="closeModal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6 text-gray-600">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
        
                <div class="mt-4 flex justify-end items-center space-x-2">
                    <button class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm font-medium" @click="closeModal">Cancel</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium" @click="confirm">Confirm</button>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>