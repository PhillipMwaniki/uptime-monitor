<script setup>
import SiteSelector from "@/Components/SiteSelector.vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const page = usePage()

defineProps({
    site: Object,
    sites: Object,
})

const endpointForm = useForm({
    location: null,
    frequency: null
})

const createEndpoint = () => {
    endpointForm.post('/endpoints', {
        preserveScroll: true,
        onSuccess: () => {
            endpointForm.reset()
        }
    })
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ site.data.domain }}
                </h2>
                <div>
                    <SiteSelector :sites="sites.data"/>
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">New endpoint</h2>

                <form v-on:submit.prevent="createEndpoint"
                      class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start p-3 mt-4 space-x-2">
                    <div class="grow">
                        <InputLabel for="location" value="Location" class="sr-only"/>

                        <TextInput id="location" type="text" class="block w-full h-9 text-sm"
                                   placeholder="e.g. /pricing" v-model="endpointForm.location"
                                   :class="{ 'border-red-500': endpointForm.errors.location }"/>
                        <InputError class="mt-2" :message="endpointForm.errors.location"/>
                    </div>
                    <div>
                        <InputLabel for="frequency" value="Frequency" class="sr-only"/>
                        <select name="frequency" id="frequency" class="border-gray-300 focus:border-indigo-500
                        focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm">
                            <option value="frequency.frequency"
                                    v-for="frequency in page.props.value.endpointFrequencies.data"
                                    :key="frequency.frequency"
                            >
                                {{ frequency.label }}
                            </option>
                        </select>
                    </div>
                    <PrimaryButton>Add</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
