<template>
    <Head title="Philip Test">
        <link
            rel="icon"
            href="/images/truly-legit-favicon-1.png"
            type="image/png"
        >
    </Head>

    <div
        class="bg-truly min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div class="px-6 mt-2">
            <TrulyLogo width="350" />
        </div>

        <div class="px-6">
            <h1 class="mt-5 text-3xl font-medium">
                <span class="sm:inline-block block"> Welcome!&nbsp;</span>
                <span class="sm:inline-block block">
                    Let's Get You Started.
                </span>
            </h1>
        </div>
    </div>
</template>

<script setup>
import { has, isEmpty } from 'lodash';
import { Head, Link, useForm } from '@inertiajs/vue3';

import TrulyLogo from '@/Components/TrulyLogo.vue';
</script>
