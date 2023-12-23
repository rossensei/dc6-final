<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    data: Object
})

</script>

<template>
    <div class="flex flex-col items-center">
        <!-- Help text -->
    <span class="text-sm text-gray-700">
        Showing <span class="font-semibold text-gray-900">{{ props.data.from }}</span> to <span class="font-semibold text-gray-900">{{ props.data.to }}</span> of <span class="font-semibold text-gray-900">{{ props.data.total }}</span> Entries
    </span>
    <div class="inline-flex mt-2 xs:mt-0">
        <!-- Buttons -->
        <Link :href="props.data.prev_page_url" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-[#004385] rounded-s hover:bg-[#0057A1]">
            <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
            </svg>
            Prev
        </Link>
        <Link :href="props.data.next_page_url" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-[#004385] border-0 border-s border-gray-300 rounded-e hover:bg-[#0057A1]">
            Next
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
        </Link>
    </div>
    </div>
</template>