<template>
    <Head title="Home" />
    <AppLayout>
        <div class="bg-truly h-screen w-full flex items-center px-12 py-10">
            <div class="h-full w-full bg-gray-50 rounded-2xl flex justify-center">
                <div class="w-5/6 2xl:w-3/4 flex flex-col items-center">
                    <div class="pt-8">
                        <h1 class="text-4xl font-black text-gray-900">
                            Get Started In 5-Minutes.
                        </h1>
                    </div>
                    <div class="w-3/5 pt-4 flex text-center font-articulat">
                        Follow the step by step instructions to sign-up and set-up the Truly Legit service.
                    </div>
                    <div class="py-6 2xl:py-10">
                        <div class="w-full">
                            <TabPages
                                :num-pages="3"
                                first-tab="Registration"
                                second-tab="Verification"
                                third-tab="Installation"
                            >
                                <!-- Registration -->
                                <template #first>
                                    <Register />
                                </template>

                                <!-- Verification -->
                                <template #second>
                                    <Verify />
                                </template>

                                <!-- Installation -->
                                <template #third>
                                    <Install />
                                </template>
                            </TabPages>
                        </div>
                    </div>
                    <div>bottom</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/AppLayout.vue';
import TabPages from '@/Components/TabPages.vue';

import Register from './Components/Register.vue';
import Verify from './Components/Verify.vue';
import Install from './Components/Install.vue';
</script>
