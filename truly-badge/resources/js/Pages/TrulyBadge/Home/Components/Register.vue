<template>
    <div class="mt-5 flex flex-col justify-between rounded-lg shadow bg-gradient-to-b from-sky-50 to-white">
        <div>
            <!-- Item Header -->
            <div class="rounded-t-lg bg-white border-b flex items-center space-x-4 p-2">
                <div class="rounded-full border py-1 px-3 flex">
                    1
                </div>
                <div class="font-semibold">
                    Register Your Account
                </div>
            </div>
            
            <!-- Item Logo -->
            <div class="block relative w-full py-8">
                <svg class="mx-auto w-full h-fit stroke-sky-500">
                    <circle
                        cx="50%"
                        cy="50%"
                        r="70"
                        fill="none"
                        stroke-width="7"
                    />
                </svg>
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <component 
                        :is="ClipboardDocumentListIcon"
                        class="h-12 w-full stroke-sky-500"
                    />
                </div>
            </div>

            <!-- Item Body -->
            <div class="py-4 px-6 flex justify-center">
                <div class="text-gray-500">
                    Click below to register your account and subscribe to the Truly Legit service.
                </div>
            </div>
        </div>
        <div>
            <div class="mx-6 pb-4">
                <button
                    @click="goToRegister"
                    class="outline-none w-full py-2 rounded-full shadow-sm text-white text-sm bg-blue-600 hover:bg-blue-700 cursor-pointer"
                >
                    Register
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ClipboardDocumentListIcon } from '@heroicons/vue/24/outline';

function goToRegister() {
    if (import.meta.env.VUE_APP_ENV === 'production') {
        window.open('https://trulylegit.com/pricing', '_blank');
    } else {
        window.open('https://qa-portal.trulylegit.com/pricing', '_blank');
    }
}
</script>
