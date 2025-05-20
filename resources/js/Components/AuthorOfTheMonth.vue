<script setup>
import PrimaryButton from './PrimaryButton.vue';

defineProps({
    author: Object
})

</script>

<template>
    <div class="bg-slate-100 flex flex-col w-full max-w-4xl rounded mx-auto my-5 p-5 shadow">
        <section class="flex justify-start text-3xl">
            <h2 class="capitalize">Autor del mes</h2>
        </section>
        <section class="flex justify-between gap-5 my-3">
            <div class="mx-auto">
                <h2 class="uppercase font-bold text-cyan-600 my-2">{{ author.name }}</h2>
                <h2 class="underline my-2">Biografía</h2>
                <p class="text-wrap">{{ author.biography }}</p>
                <h3 class="my-2 underline">Bibliografía</h3>
            </div>
            <aside class="">
                <img :src="author.profile_url" alt="" class="rounded object-cover w-100 h-100">
            </aside>
        </section>
        <section>

        </section>
        <section class="mt-4">
            <p class="text-center">Encuentra sus libros en nuestro catálogo en el siguiente enlace</p>
            <div class="flex justify-center">
                <button
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-cyan-800 hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                    Buscar libros
                </button>
            </div>

        </section>
    </div>
</template>