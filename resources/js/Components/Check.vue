<script setup>

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
                <button>View</button>
            </template>
            <template v-else>-</template>
        </td>
    </tr>
</template>
