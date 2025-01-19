<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    books: Object,
});
</script>

<template>
    <AppLayout title="Listado_libros">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listado Libros
            </h2>
        </template>
        <section class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="items-center w-full border-collapse border-neutral-800 bg-neutral-50">
                <thead class="bg-cyan-200 ">
                    <tr class="border-collapse border border-neutral-800 text-blueGray-500">
                        <th class="text-neutral-500 py-2 px-2">ID</th>
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
                        <th class="p-2">{{ book.id }}</th>
                        <td class="p-2">{{ book.id_isbn }}</td>
                        <td class="p-2">{{ book.isbn }}</td>
                        <td class="p-2">{{ book.title }}</td>
                        <td class="p-2 text-center">{{ book.genre }}</td>
                        <td class="p-2">{{ book.publisher }}</td>
                        <td class="p-2">{{ book.author_id }}</td>
                        <td class="p-2">{{ book.status }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>
