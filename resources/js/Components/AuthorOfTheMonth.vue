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
            <div>
                <h2 class="uppercase font-bold text-cyan-600 mb-2">{{ author.name }}</h2>
                <h2 class="underline">Biografía</h2>
                <p>{{ author.biography }}</p>
            </div>
            <aside>
                <img :src="author.profile_url" alt="" class="rounded">
            </aside>
        </section>
        <section>
            <h3>Bibliografía</h3>
        </section>
        <section>
            <p class="text-center">Encuentra sus libros en nuestro catálogo en el siguiente enlace</p>
            <div class="flex justify-end">
                <PrimaryButton class="bg-cyan-600 hover:bg-cyan-400 focus:bg-cyan-700 active:bg-cyan-900">
                    Buscar libros
                </PrimaryButton>
            </div>

        </section>
    </div>
</template>