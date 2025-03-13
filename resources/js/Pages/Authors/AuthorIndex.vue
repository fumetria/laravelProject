<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, watch } from 'vue';

defineProps({
    authors: Object
})
</script>

<template>
    <AppLayout class="h-screen">
        <section>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>FECHA CREACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="author in authors" :key="author.id">
                        <td>{{ author.id }}</td>
                        <td>{{ author.name }}</td>
                        <td>{{ author.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>