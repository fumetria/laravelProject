<script setup>

defineProps({
    barcode: Object,
})
</script>

<template>
    <div class="flex h-screen items-center justify-center">
    <div v-html="barcode">
    </div>
    </div>
</template> 