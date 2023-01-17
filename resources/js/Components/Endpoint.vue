<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { usePage, useForm, Link } from "@inertiajs/inertia-vue3";
import debounce from 'lodash.debounce';


const props = defineProps({
    endpoint: Object,
})

const page = usePage();

const editing = ref(false);

const deleteEndpoint = () => {
    if (confirm('Are you sure?')) {
        Inertia.delete(`/endpoints/${props.endpoint.id}`);
    }
}

const editForm = useForm({
    location: props.endpoint.location,
    frequency: props.endpoint.frequency_value,
})

const editEndpoint = debounce(() => {
    editForm.patch(`/endpoints/${props.endpoint.id}`, {
        preserveScroll: true,
        onSuccess: () => {

        }
    })
}, 500);

watch(() => editForm.isDirty, () => {
    editEndpoint();
});
</script>
<template>
    <tr>
        <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
            <template v-if="editing">
                <InputLabel for="location" value="Location" class="sr-only"/>
                <TextInput id="location" type="text" class="block w-full h-9 text-sm" placeholder="e.g. /pricing" v-model="editForm.location"/>
            </template>
            <template v-else>
                <Link :href="`/endpoints/${endpoint.id}`" class="text-indigo-600 hover:text-indigo-900">
                    {{ endpoint.location }}
                </Link>
            </template>
        </td>
        <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
            <template v-if="editing">
                <div>
                    <InputLabel for="frequency" value="Frequency" class="sr-only"/>
                    <select name="frequency" id="frequency" class="border-gray-300 focus:border-indigo-500
                        focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm" v-model="editForm.frequency">
                        <option :value="frequency.frequency"
                                v-for="frequency in page.props.value.endpointFrequencies.data"
                                :key="frequency.frequency"
                        >
                            {{ frequency.label }}
                        </option>
                    </select>
                </div>
            </template>
            <template v-else>
                {{ endpoint.frequency_label }}
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="endpoint.latest_check">
                {{ endpoint.latest_check.created_at.human }}
            </template>

            <template v-else>
                -
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="endpoint.latest_check">
                <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium" :class="{
                    'bg-green-100 text-green-800': endpoint.latest_check.isSuccessful,
                    'bg-red-100 text-red-800': !endpoint.latest_check.isSuccessful,
                }">
                    {{ endpoint.latest_check.response_code }} {{ endpoint.latest_check.status_text }}</span>
            </template>

            <template v-else>
                -
            </template>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            x%
        </td>
        <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32">
            <button class="text-indigo-600 hover:text-indigo-900" v-on:click="editing = !editing">
                {{ editing ? 'Done' : 'Edit' }}
            </button>
        </td>
        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
            <button class="text-red-600 hover:text-red-900" v-on:click="deleteEndpoint">
                Delete
            </button>
        </td>
    </tr>
</template>
