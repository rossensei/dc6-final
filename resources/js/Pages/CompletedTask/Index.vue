<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, router, usePage, Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';


const props = defineProps({
    tasks: Object,
    // filters: Object,
})

// const search = ref(props.filters.search)

// watch(search, debounce(function(newSearchVal) {
//     let params = {
//         search: newSearchVal
//     };

//     if(params && (params.search === undefined || params.search === '')) {
//         delete params.search
//     }

//     router.get('/tasks', params, { preserveState: true, replace: true });
// }, 300))


// const toggleComplete = (taskId) => {
//     // console.log(ev.target.value, taskId)
//     router.post('/tasks/toggle-complete/' + taskId, {
//         preserveState: true
//     })
// }


// server response from actions
const page = usePage();
</script>

<template>
    <Head title="Completed Tasks" />

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

            <h1 class="text-2xl font-semibold text-gray-700 mb-2">Completed Tasks ({{ props.tasks.total }})</h1>

            
            <!-- <div class="mb-2 flex items-center justify-between">
                <input v-model="search" type="search" placeholder="Search for tasks" class="px-3 py-2 rounded-md text-sm w-[300px]">

                <Link href="/tasks/create" class="px-4 py-2 rounded-md bg-[#004385] hover:bg-[#0057A1] text-white text-sm font-medium">
                    Add New Task
                </Link>                
            </div> -->

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Task
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Assigned To
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created on
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Due Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50" v-for="task in props.tasks.data" :key="task.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ task.title }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium">
                                {{ task.user.name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ new Date(task.created_at).toDateString() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ new Date(task.due_date).toDateString() }}
                            </td>
                            <td class="flex items-center px-6 py-4">
                                <Link :href="'/tasks/completed/delete/' + task.id" as="button" method="DELETE" class="font-medium text-red-600 hover:underline">Trash</Link>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <Pagination 
                :data="props.tasks"
                />
            </div>
        </div>
    </AppLayout>
</template>