<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    users: Array,
})

const currentUriPath = window.location.pathname;
</script>

<template>
    <Head title="Send Money" />

    <UserLayout>
        <template #header>
            <div class="flex items-center space-x-3">
                <Link 
                href="/myaccount/transfer/send" 
                class="px-4 py-2 rounded-full bg-white hover:bg-gray-100 text-[#004385] font-semibold hover:shadow"
                :class="{ 'bg-[#D6EBFF]' : currentUriPath === '/myaccount/transfer/send' || currentUriPath.includes('/myaccount/transfer') }"
                >Send</Link>
                <Link href="/myaccount/transfer/request" class="px-4 py-2 rounded-full bg-white hover:bg-gray-100 text-[#004385] font-semibold hover:shadow">Request</Link>
            </div>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <h1 class="text-2xl font-semibold mb-3">Send Payment to</h1>

                
            </div>
        </div>

    </UserLayout>
</template>