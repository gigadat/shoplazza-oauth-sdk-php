<template>
    <div class="flex-none flex items-center justify-center pb-6 2xl:pb-10 whitespace-nowrap">
        <div class="p-0.5 rounded-full grid grid-cols-2 gap-0 sm:flex bg-white/60 sm:bg-gray-200/60">
            <!-- First Page button -->
            <button
                type="button"
                class="p-1.5 lg:pl-2.5 lg:pr-3.5 lg:py-2.5 rounded-full flex items-center justify-center text-sm text-gray-600 font-medium focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus:outline-none focus-visible:ring-offset-gray-100"
                :class="state.activeTab === 'first' ? 'bg-blue-600 shadow-sm ring-1 ring-black ring-opacity-5' : 'group'"
                @click="state.activeTab = 'first'"
            >
                <span
                    :class="state.activeTab === 'first' ? 'text-gray-100' : 'text-gray-600 group-hover:text-gray-900'"
                >
                    {{ firstTab }}
                </span>
            </button>

            <!-- Second Page button -->
            <button
                type="button"
                class="ml-0.5 p-1.5 lg:pl-2.5 lg:pr-3.5 lg:py-2.5 rounded-full flex items-center justify-center text-sm text-gray-600 font-medium focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus:outline-none focus-visible:ring-offset-gray-100"
                :class="state.activeTab === 'second' ? 'bg-blue-600 shadow-sm ring-1 ring-black ring-opacity-5' : 'group'"
                @click="state.activeTab = 'second'"
            >
                <span
                    :class="state.activeTab === 'second' ? 'text-gray-100' : 'text-gray-600 group-hover:text-gray-900'"
                >
                    {{ secondTab }}
                </span>
            </button>

            <!-- Third Page button if needed -->
            <button
                v-if="numPages > 2"
                type="button"
                class="ml-0.5 p-1.5 lg:pl-2.5 lg:pr-3.5 lg:py-2.5 rounded-full flex items-center justify-center text-sm text-gray-600 font-medium focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus:outline-none focus-visible:ring-offset-gray-100"
                :class="state.activeTab === 'third' ? 'bg-blue-600 shadow-sm ring-1 ring-black ring-opacity-5' : 'group'"
                @click="state.activeTab = 'third'"
            >
                <span
                    :class="state.activeTab === 'third' ? 'text-gray-100' : 'text-gray-600 group-hover:text-gray-900'"
                >
                    {{ thirdTab }}
                </span>
            </button>

            <!-- Fourth Page button if needed -->
            <button
                v-if="numPages > 3"
                type="button"
                class="ml-0.5 p-1.5 lg:pl-2.5 lg:pr-3.5 lg:py-2.5 rounded-full flex items-center justify-center text-sm text-gray-600 font-medium focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus:outline-none focus-visible:ring-offset-gray-100"
                :class="state.activeTab === 'fourth' ? 'bg-blue-600 shadow-sm ring-1 ring-black ring-opacity-5' : 'group'"
                @click="state.activeTab = 'fourth'"
            >
                <span
                    :class="state.activeTab === 'fourth' ? 'text-gray-100' : 'text-gray-600 group-hover:text-gray-900'"
                >
                    {{ fourthTab }}
                </span>
            </button>
        </div>
    </div>

    <div
        :class="{ 'block': state.activeTab === 'first', 'hidden': state.activeTab !== 'first' }"
    >
        <slot name="first" />
    </div>

    <div
        :class="{ 'block': state.activeTab === 'second', 'hidden': state.activeTab !== 'second' }"
    >
        <slot name="second" />
    </div>

    <div
        :class="{ 'block': state.activeTab === 'third', 'hidden': state.activeTab !== 'third' }"
    >
        <slot name="third" />
    </div>

    <div
        :class="{ 'block': state.activeTab === 'fourth', 'hidden': state.activeTab !== 'fourth' }"
    >
        <slot name="fourth" />
    </div>
</template>
<script setup>
import { reactive } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: 'No Type Specified',
    },

    numPages: {
        type: Number,
        default: 2,
    },

    firstTab: {
        type: String,
        default: '',
    },

    secondTab: {
        type: String,
        default: '',
    },

    thirdTab: {
        type: String,
        default: '',
    },

    fourthTab: {
        type: String,
        default: '',
    },
});

const state = reactive({
    activeTab: 'first',
});
</script>
