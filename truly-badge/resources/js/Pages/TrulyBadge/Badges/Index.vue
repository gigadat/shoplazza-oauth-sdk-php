<template>
    <Head title="Badges" />
    <AppLayout>
        <div class="bg-truly h-screen w-full flex items-center px-12 py-10">
            <div class="h-full w-full bg-gray-50 rounded-2xl flex justify-center">
                <div class="w-5/6 md:w-3/4 flex flex-col items-center">
                    <div class="pt-8">
                        <h1 class="text-4xl font-black text-gray-900">
                            Badge Installation Tool
                        </h1>
                    </div>
                    <div class="w-3/5 pt-4 flex text-center font-articulat">
                        Use our automatic badge installation tool, to display the badges on your store's website.
                    </div>
                    <div class="pt-8 w-full justify-between grid grid-cols-3 gap-4">
                        <div class="col-span-2 bg-white text-gray-900 w-full rounded-2xl 2xl:py-10">
                            <h3 class="text-lg font-bold text-gray-900 text-center px-16 py-4">
                                Paste Your Site ID
                            </h3>
                            <div class="px-16 pb-6">
                                <label
                                    for="siteId"
                                    class="font-semibold text-sm text-gray-700"
                                >
                                    Site ID
                                </label>
                                <input
                                    id="siteId"
                                    v-model="form.siteId"
                                    class="shadow-sm block w-full sm:text-sm rounded-md"
                                    :class="borderStyle"
                                    required="true"
                                    @input="clearError('siteId')"
                                >
                                <div class="mt-2 ml-0.5 text-xs text-gray-500">
                                    NOTE** Ensure you click save for badge installation to complete.
                                </div>
                                <p
                                    v-if="getErrorMessage('siteId')"
                                    :class="`mt-2 text-sm text-red-500`"
                                >
                                    {{ getErrorMessage('siteId') }}
                                </p>
                                <p
                                    v-else-if="formSubmitted"
                                    :class="`mt-2 text-sm text-blue-500`"
                                >
                                    Form Submitted!
                                </p>

                                <button
                                    @click="submit"
                                    class="outline-none mt-2 px-4 py-2 border border-gray-300 rounded shadow-sm text-white text-sm bg-blue-600 hover:bg-blue-700 cursor-pointer"
                                >
                                    Save
                                </button>
                            </div>
                            <div class="border-t border-gray-300 text-center">
                                <h3 class="text-lg font-bold text-gray-900 px-16 pt-4">
                                    Place Static Badges Option
                                </h3>
                                <div class="mt-2 text-xs text-gray-500 font-articulat px-16">
                                    Set an id attribute on the div element you created 
                                    and set the id value based on the type of badge to display.
                                </div>
                                <div class="text-sm font-semibold text-gray-900 px-16 py-10 flex flex-col gap-2">
                                    <div>id="truly-certified-badge" - for the Verified Business badge</div>
                                    <div>id="truly-secured-badge" - for the Secure Site badge</div>
                                    <div>id="truly-shield-badge" - for the Truly Shield badge</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 bg-gray-900 text-white w-full rounded-2xl px-4 2xl:px-6 pt-4 pb-10 2xl:py-6">
                            <div class="text-2xl 2xl:text-4xl font-extrabold">
                                Badge Customization.
                            </div>
                            <div class="font-articulat pt-2">
                                Login to your Truly Legit account to customize your badges further.
                            </div>
                            <div class="py-14 2xl:py-20 flex flex-col items-left justify-center gap-6 px-8">
                                <VerifiedBusiness class="w-full"/>
                                <SecureSite class="w-5/6"/>
                            </div>
                            <div class="flex justify-center">
                                <button
                                    @click="goToCustomizeBadges"
                                    class="outline-none px-6 py-2 rounded shadow-sm text-white text-sm bg-blue-600 hover:bg-blue-700 cursor-pointer"
                                >
                                    Customize
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed, ref } from 'vue'
import { has, isEmpty } from 'lodash';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SecureSite from '@/Components/Badges/SecureSite.vue';
import VerifiedBusiness from '@/Components/Badges/VerifiedBusiness.vue';

const form = useForm({
    siteId: '',
});

const borderStyle = computed(() => {
    if (getErrorMessage('siteId') === null) {
        return 'border-blue-500 focus:ring-blue-600 focus:border-blue-600';
    } else {
        return 'border-red-500 focus:ring-red-600 focus:border-red-600';
    }
});

let formSubmitted = ref(false);

function submit() {
    if (form.isDirty) {
        form.post(route('badge.update'), {
            preserveScroll: true,
            onSuccess: () => {
                formSubmitted = true;
                form.siteId = '';
            },
        });
    }
}

function goToCustomizeBadges() {
    if (import.meta.env.VUE_APP_ENV === 'production') {
        window.open('https://portal.trulylegit.com/badges', '_blank');
    } else {
        window.open('https://qa-portal.trulylegit.com/badges', '_blank');
    }
}

function clearError(propName) {
    form.clearErrors(propName);
    formSubmitted = false;
}

function getErrorMessage(propName) {
    return !isEmpty(form.errors[propName]) ? form.errors[propName] : null;
}
</script>
