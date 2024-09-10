<template>
    <TransitionRoot as="template" :show="props.mobileMenuOpen">
        <Dialog
            as="div"
            class="fixed inset-0 flex z-40 md:hidden"
            @close="props.transitionMobileNav(false)"
        >
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <DialogOverlay
                    class="fixed inset-0 bg-gray-600 bg-opacity-75"
                />
            </TransitionChild>
            <TransitionChild
                as="template"
                enter="transition ease-in-out duration-300 transform"
                enter-from="-translate-x-full"
                enter-to="translate-x-0"
                leave="transition ease-in-out duration-300 transform"
                leave-from="translate-x-0"
                leave-to="-translate-x-full"
            >
                <div
                    class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-in-out duration-300"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="ease-in-out duration-300"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="absolute top-0 right-0 -mr-12 pt-2">
                            <button
                                type="button"
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                @click="props.transitionMobileNav(false)"
                            >
                                <span class="sr-only">Close Menu</span>
                                <XMarkIcon
                                    class="h-6 w-6 text-white"
                                    aria-hidden="true"
                                />
                            </button>
                        </div>
                    </TransitionChild>
                    <div class="flex-shrink-0 flex items-center px-4 bg-white">
                        <TrulyLogo class="mt-2" kind="full" :width="180" />
                    </div>
                    <div class="mt-5 flex-1 h-0 overflow-y-auto bg-gray-50">
                        <nav class="px-2 py-4 space-y-1">
                            <template
                                v-for="item in navigation"
                                :key="item.name"
                            >
                                <div v-if="!item.hideMobile">
                                    <p
                                        v-if="item.name === 'Sites'"
                                        class="px-2 pt-3 text-sm text-gray-500 font-medium"
                                    >
                                        Admin
                                    </p>
                                    <div v-if="!item.children">
                                        <a
                                            :href="item.href"
                                            :class="[
                                                item.current
                                                    ? 'bg-gray-900 text-white'
                                                    : 'text-gray-900 hover:bg-gray-700 hover:text-white',
                                                'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                                            ]"
                                        >
                                            <component
                                                :is="item.icon"
                                                :class="[
                                                    item.current
                                                        ? 'text-gray-300'
                                                        : 'text-gray-900 group-hover:text-gray-300',
                                                    'mr-3 flex-shrink-0 h-6 w-6',
                                                ]"
                                                aria-hidden="true"
                                            />
                                            {{ item.name }}
                                        </a>
                                    </div>
                                    <Disclosure
                                        v-else
                                        v-slot="{ open }"
                                        as="div"
                                        class="space-y-1"
                                    >
                                        <DisclosureButton
                                            :class="[
                                                item.current
                                                    ? 'bg-gray-900 text-white'
                                                    : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                                'group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none',
                                            ]"
                                        >
                                            <component
                                                :is="item.icon"
                                                class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"
                                                aria-hidden="true"
                                            />
                                            <span class="flex-1">
                                                {{ item.name }}
                                            </span>
                                            <svg
                                                :class="[
                                                    open
                                                        ? 'text-gray-300 rotate-90'
                                                        : 'text-gray-400',
                                                    'ml-3 flex-shrink-0 h-5 w-5 transform group-hover:text-gray-300 transition-colors ease-in-out duration-150',
                                                ]"
                                                viewBox="0 0 20 20"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    d="M6 6L14 10L6 14V6Z"
                                                    fill="currentColor"
                                                />
                                            </svg>
                                        </DisclosureButton>
                                        <DisclosurePanel class="space-y-1">
                                            <DisclosureButton
                                                v-for="subItem in item.children"
                                                :key="subItem.name"
                                                as="a"
                                                :href="subItem.href"
                                                class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700"
                                            >
                                                {{ subItem.name }}
                                            </DisclosureButton>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </div>
                            </template>
                        </nav>
                    </div>
                </div>
            </TransitionChild>
            <div class="flex-shrink-0 w-14" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { XMarkIcon } from '@heroicons/vue/24/solid';
import TrulyLogo from '@/Components/TrulyLogo.vue';

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
} from '@headlessui/vue';

const props = defineProps({
    mobileMenuOpen: Boolean,
    transitionMobileNav: {
        type: Function,
        default: () => {},
    },
    navigation: {
        type: Object,
        default() {
            return {};
        },
    },
});
</script>
