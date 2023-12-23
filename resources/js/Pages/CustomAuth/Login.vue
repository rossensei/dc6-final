<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
});

const submit = () => {
    form.post('/login');
}
</script>

<template>
    <Head title="Login" />

    <div class="flex min-h-screen bg-gray-50">
        <section class="w-full max-w-md mx-auto">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-3xl font-bold text-[#004385]">
                    TaskHub    
                </a>

                <div v-if="$page.props.flash.success" class="w-full flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                    <div>
                        {{ $page.props.flash.success }}
                    </div> 
                </div>

                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            Login to your account
                        </h1>
                        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">

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

                            <button type="submit" class="w-full text-white bg-[#004385] hover:bg-[#0057A1] focus:ring-4 focus:outline-none focus:ring-[#004385] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
                            <p class="text-sm font-light text-gray-500">
                                Already have an account? <a href="/register" class="font-medium text-[#004385] hover:underline">Register</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
          </section>
    </div>
</template>