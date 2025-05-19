<script setup>
import { ref } from 'vue';

defineProps({
    welcomeTitle: String,
    welcomeDescription: String,
})


</script>

<template>
    <section class="relative">
        <img src="/img/welcome/header.png" alt="Imagen de bienvenida" class="object-cover w-full h-96 ">
        <div class="absolute inset-0 blur-2xs bg-black opacity-40 h-96"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
            <h1 class="text-4xl font-light">{{ welcomeTitle }}</h1>
            <p>{{ welcomeDescription }}</p>
        </div>
    </section>
</template>