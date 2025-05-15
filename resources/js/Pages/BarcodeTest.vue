<script setup>

defineProps({
    barcode: String,
    book: Object,
})
</script>

<template>
    <div class="flex flex-col h-screen items-center justify-center">
        <h2 class="uppercase font-mono">{{ book.title }}</h2>
        <div v-html="barcode">
        </div>
    </div>
</template>