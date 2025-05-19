<script setup>




</script>

<template>
    <div class="flex flex-col bg-slate-100 justify-center items-center w-full max-w-4xl mx-auto my-5 p-5 shadow">
        <div class="flex justify-start text-left font-light text-2xl">
            <slot name="title" />
        </div>
        <div class="mt-5">
            <slot name="content" />
        </div>
        <div class="flex flex-col justify-center items-center w-full mt-5">
            <slot name="footer" />
        </div>
    </div>
</template>