<template>
    <!-- Static sidebar for desktop -->
    <div
        class="hidden md:flex md:flex-col md:fixed md:inset-y-0 md:transition-[width] md:duration-300 relative"
        :class="sidebarExpnaded ? 'md:w-64' : 'md:w-20'"
    >
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex-1 flex flex-col min-h-0 bg-gray-800 transition-[width] duration-300">
            <div class="flex justify-center items-center h-16 px-4 bg-white">
                <TrulyLogo
                    :kind="sidebarExpnaded ? 'full' : 'logo'"
                    :width="sidebarExpnaded ? '180' : '42'"
                />
            </div>
            <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
                <nav
                    class="flex-1 px-2 py-4 space-y-2"
                    aria-label="Sidebar"
                >
                    <template
                        v-for="item in navigation"
                        :key="item.name"
                    >
                        <p v-if="item.name === 'Sites'" class="px-2 pt-3 text-sm text-gray-500 font-medium">Admin</p>
                        <div v-if="!item.children">
                            <a
                                :href="item.href"
                                :class="[item.current ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white',
                                         'group flex items-center px-2 py-2 text-sm font-medium rounded-md',]"
                            >
                                <component
                                    :is="item.icon"
                                    :class="[item.current ? 'text-gray-300' : 'text-black-400 group-hover:text-gray-300', 'mr-3 flex-shrink-0 h-6 w-6',]"
                                    aria-hidden="true"
                                />
                                {{ sidebarExpnaded ? item.name : '' }}
                            </a>
                        </div>
                        <Disclosure
                            v-else
                            v-slot="{ open }"
                            as="div"
                            class="space-y-1"
                        >
                            <DisclosureButton :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none']">
                                <component
                                    :is="item.icon"
                                    class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"
                                    :class="sidebarExpnaded ? 'mr-3' : 'mr-2'"
                                    aria-hidden="true"
                                />
                                <span
                                    class="flex-1"
                                    :class="sidebarExpnaded ? '' : 'sr-only'"
                                >
                                    {{ item.name }}
                                </span>
                                <svg
                                    :class="[open ? 'text-gray-300 rotate-90' : 'text-gray-400', 'flex-shrink-0 h-5 w-5 transform group-hover:text-gray-300 transition-colors ease-in-out duration-150', sidebarExpnaded ? 'ml-3' : 'ml-1']"
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
                                    class="group w-full flex items-center pr-2 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700"
                                    :class="sidebarExpnaded ? 'pl-11' : 'pl-8'"
                                >
                                    <component
                                        :is="item.icon"
                                        v-if="!sidebarExpnaded"
                                        class="mr-2 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300"
                                        aria-hidden="true"
                                    />
                                    {{ sidebarExpnaded ? subItem.name : '' }}
                                </DisclosureButton>
                            </DisclosurePanel>
                        </Disclosure>
                    </template>
                </nav>

                <div 
                    v-if="sidebarExpnaded"
                    class="text-black text-lg w-full px-8"
                >
                    <TrulyLink />
                </div>

                <!-- Sidebar toggle button -->
                <span class="flex flex-row-reverse">
                    <ChevronDoubleRightIcon
                        class="cursor-pointer hover:text-black mr-2"
                        :class="[sidebarExpnaded ? 'rotate-180' : '', 'text-gray-400 group-hover:text-gray-300', 'flex-shrink-0 h-12 w-5',]"
                        @click="transitionSidebar(!sidebarExpnaded)"
                    />
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
import TrulyLogo from '@/Components/TrulyLogo.vue';
import TrulyLink from '@/Components/TrulyLink.vue';

import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
import { ChevronDoubleRightIcon } from '@heroicons/vue/24/outline';
const props = defineProps({
    navigation: {
        type: Object,
        default() {
            return {};
        },
    },
    transitionSidebar: {
        type: Function,
        default() {
            return () => {};
        }
    },
    sidebarExpnaded: {
        type: Boolean,
        default: true
    }
});

</script>
