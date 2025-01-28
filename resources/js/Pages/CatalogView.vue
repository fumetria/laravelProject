<script setup>
import { ref, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { formToJSON } from 'axios';

const books = ref('');
const form = useForm({
    query: ref(''),
    tquery: ref('')
});
const isLoading = ref(false);
const errorMessage = ref('');
watch(() => form, async (newQuery) => {
    if (newQuery > 5) {
        isLoading.value = true;
        errorMessage.value = '';
        try {
            const res = await axios.get(`/api/books/search/?query=${newQuery.query}&filterType=${newQuery.tquery}`);
            console.log(res.data);
            if (res.data != null) {
                books = res.data;
            }
        } catch (error) {
            if (error.response && error.response.status === 404) {
                errorMessage.value = 'No se encontró ningún libro con este ISBN.';
            } else {
                errorMessage.value = 'Ocurrió un error al buscar el ISBN.';
            }
        } finally {
            isLoading.value = false;
        }
    }

})

</script>

<template>
    <AppLayout title="Catálogo" class="">
        <template #header>
            <h1>Catálogo</h1>
        </template>
        <div class="flex justify-center align-middle">
            <section>
                <input type="text" v-model="form.query" id="query">
                <select name="tquery" id="tquery" v-model="form.tquery">
                    <option value="">Todos</option>
                    <option value="id_isbn">Id_isbn</option>
                    <option value="title">Título</option>
                    <option value="author_id">Autor</option>
                    <option value="isbn">Isbn</option>
                    <option value="genre">Género</option>
                    <option value="publisher">Editorial</option>
                    <option value="status">Estado</option>
                </select>
            </section>
        </div>
        <div v-if="books">
            <div v-for="book in books">
                <img src="${ book.cover_url }" alt="" width="50" height="50">
                <h4>{{ book.title }}</h4>
                <p>{{ book.author }}</p>
                <p>Location</p>
                <p>{{ book.location_floor }}</p>
                <p>{{ book.location_aisle }}</p>
                <p>{{ book.location_bookshelves }}</p>
            </div>
        </div>

    </AppLayout>
</template>
