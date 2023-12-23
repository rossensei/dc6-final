<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register/new-user', {
        onSuccess: () => form.reset()
    });
}
</script>

<template>
    <Head title="Register" />
    
    <div class="flex min-h-screen bg-gray-50">
        <section class="w-full max-w-xl mx-auto">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-3xl font-bold text-[#004385]">
                    TaskHub    
                </a>

                <div v-if="$page.props.flash.success" class="w-full flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="flex-1">
                        <span class="font-medium">Success!</span> {{ $page.props.flash.success }}
                    </div>
                </div>

                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            Create an account
                        </h1>
                        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">

                            <!-- <div class="grid grid-cols-2 gap-6"> -->
                                <div>
                                    <InputLabel for="name" value="Name" />
                                    <TextInput 
                                    v-model="form.name"
                                    id="name"
                                    type="text"
                                    class="w-full text-sm"
                                    />
                                    <InputError :message="form.errors.name" />
                                </div>
                                <div>
                                    <InputLabel for="email" value="Email" />
                                    <TextInput 
                                    v-model="form.email"
                                    id="email"
                                    type="text"
                                    class="w-full text-sm"
                                    />
                                    <InputError :message="form.errors.email" />
                                </div>
                                <!-- <div>
                                    <InputLabel for="phone" value="Phone" />
                                    <TextInput
                                    v-model="form.phone"
                                    id="phone"
                                    type="number"
                                    class="w-full text-sm"
                                    />
                                    <InputError :message="form.errors.phone" />
                                </div>
                                <div>
                                    <InputLabel for="address" value="Address" />
                                    <TextInput 
                                    v-model="form.address"
                                    id="address"
                                    type="text"
                                    class="w-full text-sm"
                                    />
                                    <InputError :message="form.errors.address" />
                                </div> -->
                                <div>
                                    <InputLabel for="password" value="Password" />
                                    <TextInput 
                                    v-model="form.password"
                                    id="password"
                                    type="password"
                                    class="w-full text-sm"
                                    />
                                    <InputError :message="form.errors.password" />
                                </div>
                                <div>
                                    <InputLabel for="password_confirmation" value="Confirm Password" />
                                    <TextInput 
                                    v-model="form.password_confirmation"
                                    id="password_confirmation"
                                    type="password"
                                    class="w-full text-sm"
                                    />
                                </div>
                            <!-- </div> -->

                            <div class="flex">
                                <button type="submit" class="text-white bg-[#004385] hover:bg-[#0057A1] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create your account</button>
                            </div>
                            <p class="text-sm font-light text-gray-500">
                                Already have an account? <a href="/login" class="font-medium text-[#004385] hover:underline">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
          </section>
    </div>
</template>