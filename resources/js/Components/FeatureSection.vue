<script setup>




</script>

<template>
    <div
        class="flex flex-col bg-transparent justify-center w-full max-w-4xl mx-auto my-0 px-6 py-7 shadow">
        <div class="text-left font-light text-2xl">
            <h2>
                <slot name="title" />
            </h2>
        </div>
        <div class="mt-5">
            <slot name="content" />
        </div>
        <div class="flex flex-col justify-center items-center w-full mt-5">
            <slot name="footer" />
        </div>
    </div>
</template>