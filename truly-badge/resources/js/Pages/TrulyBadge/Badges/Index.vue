<template>
    <Head title="Badges" />
    <AppLayout>
        <div
        class="bg-truly h-screen w-full flex items-center px-12 py-10"
    >
        <div class="h-full w-full bg-gray-50 rounded-2xl flex justify-center">
            <div class="w-5/6 md:w-3/4 flex flex-col items-center">
                <div class="pt-8">
                    <h1 class="text-4xl font-black text-gray-900">
                        Badge Installation Tool
                    </h1>
                </div>
                <div class="w-1/2 pt-4 flex text-center">
                    Dolor sit amet consectetur. Semper enim suspendisse eget egestas eu diam elementum sit, sed ultrices
                </div>
                <div class="pt-8 w-full justify-between grid grid-cols-3 gap-4">
                    <div class="col-span-2 bg-white text-gray-900 w-full rounded-2xl px-16 pt-4 pb-10">
                        <h3 class="text-lg font-semibold text-gray-900 text-center pb-4">
                            Paste Your Site ID
                        </h3>
                        <div>
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
                                :class="`border-${borderColor}-500 focus:ring-${borderColor}-600 focus:border-${borderColor}-600`"
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
                            <div> TEst Depliy again Im getting tyired</div>
                        </div>
                    </div>
                    <div class="col-span-1 bg-gray-900 text-white w-full rounded-2xl px-4 pt-4 pb-10">
                        right
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

const form = useForm({
    siteId: '',
});

const hasError = (propName) => {
    return has(form.errors, propName);
};

const borderColor = computed(() => {
    return hasError('siteId') ? 'red' : 'blue';
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

function clearError(propName) {
    form.clearErrors(propName);
    formSubmitted = false;
}

function getErrorMessage(propName) {
    return !isEmpty(form.errors[propName]) ? form.errors[propName] : null;
}
</script>
