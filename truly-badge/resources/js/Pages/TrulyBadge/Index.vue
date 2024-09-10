<template>
    <Head title="Plugin">
        <link
            rel="icon"
            href="/images/truly-legit-favicon-1.png"
            type="image/png"
        >
    </Head>

    <div
        class="bg-truly h-screen w-screen flex items-center px-12 py-10"
    >
        <div class="h-full w-full bg-gray-100 rounded-2xl flex justify-between">
            <div class="flex flex-col pl-32">
                <div class="pt-20">
                    <TrulyLogo width="350" />
                </div>
                <div class="pt-20 text-black text-5xl flex flex-col">
                    <div class="text-gray-900">
                        Welcome To
                    </div>
                    <div class="text-blue-custom">
                        Truly Legit.
                    </div>
                </div>
                <div class="py-6 text-black text-2xl">
                    Subtitle
                </div>
                <div class="py-10 text-black text-lg w-fit">
                    <TrulyLink
                        href="/home"
                        :newTab="false"
                        label="Continue"
                    />
                </div>
            </div>
            <div class="flex justify-center items-center pr-20">
                <img
                    src="@/Components/Truly3D.png"
                    class="w-5/6"
                >
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

import TrulyLogo from '@/Components/TrulyLogo.vue';
import TrulyLink from '@/Components/TrulyLink.vue';
</script>
