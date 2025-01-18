<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    books: Object,
});
</script>

<template>
    <!-- <AppLayout title="Listado_libros"> -->
        <h3>Listado Libros</h3>
        <table class="border-collapse border border-neutral-800">
            <thead>
                <tr class="border-collapse border border-neutral-800">
                    <th>ID</th>
                    <th>ID_ISBN</th>
                    <th>ISBN</th>
                    <th>TíTULO</th>
                    <th>GÉNERO</th>
                    <th>EDITORIAL</th>
                    <th>AUTOR</th>
                    <th>ESTADO</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books" :key="book.id">
                    <td>{{ book.id }}</td>
                    <td>{{ book.id_isbn }}</td>
                    <td>{{ book.isbn }}</td>
                    <td>{{ book.title }}</td>
                    <td>{{ book.genre }}</td>
                    <td>{{ book.publisher }}</td>
                    <td>{{ book.author_id }}</td>
                    <td>{{ book.status }}</td>
                </tr>
            </tbody>
        </table>
    <!-- </AppLayout> -->
</template>

