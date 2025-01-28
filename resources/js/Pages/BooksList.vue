<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    books: Object,
});


</script>

<template>
    <AppLayout title="Listado Libros">
        <template #header>
            <div class="box-border flex justify-between content-center items-center">
                <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                    Listado Libros
                </h1>
                <a :href="route('newBook')">
                    <PrimaryButton>
                        <font-awesome-icon :icon="['fas', 'plus']" class="z-50 text-xl text-stone-50" />
                    </PrimaryButton>
                </a>
            </div>

        </template>
        <section class="bg-stone-900 my-4 mx-5 ">
            <table class="items-center w-full py-3 border-collapse border-neutral-800 bg-stone-50">
                <thead class="bg-cyan-200 py-3 px-4">
                    <tr class="border-collapse border border-neutral-800 text-blueGray-500">
                        <th class="text-neutral-500 py-2 px-2">ID_ISBN</th>
                        <th class="text-neutral-500 py-2 px-2">ISBN</th>
                        <th class="text-neutral-500 py-2 px-2">TíTULO</th>
                        <th class="text-neutral-500 py-2 px-2">GÉNERO</th>
                        <th class="text-neutral-500 py-2 px-2">EDITORIAL</th>
                        <th class="text-neutral-500 py-2 px-2">AUTOR</th>
                        <th class="text-neutral-500 py-2 px-2">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books" :key="book.id" class="items-center">
                        <td class="p-2">{{ book.id_isbn }}</td>
                        <td class="p-2">{{ book.isbn }}</td>
                        <td class="p-2">{{ book.title }}</td>
                        <td class="p-2 text-center">{{ book.genre }}</td>
                        <td class="p-2">{{ book.publisher }}</td>
                        <td class="p-2">{{ book.author_id }}</td>
                        <td class="p-2">{{
                            book.status
                        }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>
