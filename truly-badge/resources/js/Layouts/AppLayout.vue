<template>
    <Head>
        <link
            rel="icon"
            href="/images/icon.png"
            type="image/png"
        >
    </Head>
    <div class="h-full">
        <mobile-menu
            :mobile-menu-open="mobileMenuOpen"
            :transition-mobile-nav="transitionMobileNav"
            :navigation="menuOptions"
        />

        <desktop-sidebar
            :navigation="menuOptions"
            :sidebar-expnaded="sidebarExpnaded"
            :transition-sidebar="transitionSidebar"
        />

        <div
            class="flex flex-col transition duration-300 min-h-screen bg-truly"
            :class="sidebarExpnaded ? 'md:pl-64' : 'md:pl-20'"
        >
            <main class="flex-1">
                <div class="max-w-auto mx-auto">
                    <!-- Replace with your content -->
                    <slot />
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { router, Head } from '@inertiajs/vue3'
import { ref } from 'vue';
import { route } from 'ziggy-js';
import MobileMenu from '@/Layouts/Partials/MobileMenu.vue';
import DesktopSidebar from '@/Layouts/Partials/DesktopSidebar.vue';
import {
    CodeBracketIcon,
    HomeIcon,
    BanknotesIcon,
    EnvelopeIcon,
    ChartBarIcon,
    CheckBadgeIcon,
    ShieldCheckIcon,
    BuildingOfficeIcon,
    GlobeAmericasIcon,
    BoltIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline';

const mobileMenuOpen = ref(false);
const sidebarExpnaded = ref(true);

const menuOptions = [
    {
        name: 'Home',
        href: route('home'),
        icon: HomeIcon,
        current: route().current('home'),
        hideMobile: false,
    },
    {
        name: 'Badges',
        href: route('badges'),
        icon: CheckBadgeIcon,
        current: route().current('badges'),
        hideMobile: false,
    },
    {
        name:'Support',
        href: 'https://trulylegit.com/contact/support',
        icon: ShieldCheckIcon,
        hideMobile: false,
    },
];

function transitionMobileNav(open) {
    mobileMenuOpen.value = open;
}

function transitionSidebar(open) {
    sidebarExpnaded.value = open;
}
</script>
