<template>
    <a
        :href="href"
        :target="newTab ? '_blank' : '_self'"
        rel="noopener noreferrer"
        class="group hidden md:flex items-center justify-center rounded-3xl dark-cta-button-default hover:dark-cta-button-hover text-white text-sm px-4 py-3 shadow-sm"
    >
        <div class="h-3 w-3 rounded-full mr-2 bg-white group-hover:bg-blue-custom transition-colors duration-300"></div>
        <div>{{ label }}</div>
    </a>
</template>

<script setup>
const props = defineProps({
    href: {
        type: String,
        default: 'https://trulylegit.com/',
    },

    newTab: {
        type: Boolean,
        default: true,
    },

    label: {
        type: String,
        default: 'Visit Truly Legit',
    },
});
</script>
