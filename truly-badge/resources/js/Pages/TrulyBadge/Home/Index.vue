<template>
    <Head title="Home" />
    <AppLayout>
        <div class="bg-truly h-screen w-full flex items-center px-12 py-10">
            <div class="h-full w-full bg-gray-50 rounded-2xl flex justify-center">
                <div class="w-5/6 md:w-3/4 flex flex-col items-center">
                    <div class="pt-8">
                        <h1 class="text-4xl font-black text-gray-900">
                            Get Started In 5-Minutes.
                        </h1>
                    </div>
                    <div class="w-3/5 pt-4 flex text-center font-articulat">
                        Follow the step by step instructions to sign-up and set-up the Truly Legit service.
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
