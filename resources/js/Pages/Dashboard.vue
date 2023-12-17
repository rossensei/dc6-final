<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    wallet: Object
})
</script>

<template>
    <Head title="Dashboard" />

    <UserLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div> -->

                <div class="flex items-start space-x-4">
                    <div class="w-1/2">
                        <div class="bg-white rounded-lg p-6 shadow mb-4">
                            <h2 class="text-xl font-semibold text-gray-700 mb-4">WalletWise Balance</h2>
                            <p class="text-4xl font-semibold text-gray-900 mb-3">₱{{ wallet.balance }}</p>

                            <p class="text-sm font-normal mb-8">Available</p>

                            <Link href="/myaccount/transfer" class="px-4 py-2 rounded-full bg-[#004385] hover:bg-[#0052A3] text-white font-semibold">Transfer Funds</Link>

                        </div>
                        <div class="bg-white rounded-lg p-6 shadow mb-4">
                            <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Activity</h2>
                            <p class="text-base font-normal text-gray-900">See when money comes in, and when it goes out. You’ll find your recent PayPal activity here.</p>
                        </div>
                    </div>

                    <div class="w-1/2 bg-white rounded-lg p-6 shadow">
                        <div class="flex items-center space-x-2 mb-4">
                            <Link href="/myaccount/transfer/send" class="px-4 py-2 rounded-full bg-[#004385] hover:bg-[#0052A3] text-white font-semibold">Send</Link>
                            <Link href="/myaccount/transfer/request" class="px-4 py-2 rounded-full bg-[#004385] hover:bg-[#0052A3] text-white font-semibold">Request</Link>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Send again</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
