<script setup>
import { ref } from "vue";
import { VueFinalModal } from "vue-final-modal";

const showResponseBodyModal = ref(false);
defineProps({
    check: Object
})
</script>
<template>
    <tr>
        <td class="whitespace-nowrap py-4 pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900">
            {{ check.created_at.human }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium" :class="{
                    'bg-green-100 text-green-800': check.isSuccessful,
                    'bg-red-100 text-red-800': !check.isSuccessful,
                }">
                    {{ check.response_code }} {{ check.status_text }}
            </span>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <template v-if="check.response_body">
                <button @click="showResponseBodyModal = true">View</button>
            </template>
            <template v-else>-</template>
        </td>
    </tr>
    <VueFinalModal
        v-model="showResponseBodyModal"
        classes="flex justify-center items-start pt-16 md:pt-24 mx-4"
        content-class="relative max-h-full rounded bg-white w-full max-w-2xl p-4 md:p-6"
        overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50"
        :esc-to-close="true"
    >
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">What we got</h2>

        <textarea :value="check.response_body" readonly class="border-gray-300 rounded-md w-full" rows="10"></textarea>
    </VueFinalModal>
</template>
