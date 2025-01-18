<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    books: Object,
});
</script>

<template>
    <h3>Listado Libros</h3>
    <table>
        <thead>
            <th>ID</th>
            <th>ID_ISBN</th>
            <th>ISBN</th>
            <th>TíTULO</th>
            <th>GÉNERO</th>
            <th>EDITORIAL</th>
            <th>AUTOR</th>
            <th>ESTADO</th>
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
</template>
