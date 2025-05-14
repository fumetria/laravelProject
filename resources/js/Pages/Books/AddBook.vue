<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';

const props = defineProps({
    authors: Object,
})

const form = useForm({
    isbn: ref(''),
    title: ref(''),
    genre: ref(''),
    publisher: ref(''),
    author_id: ref(''),
    cover: null,
    cover_url: null,
})

const isLoading = ref(false);
const errorMessage = ref('');
watch(() => form.isbn, async (newIsbn) => {
    if (newIsbn > 10) {
        isLoading.value = true;
        errorMessage.value = '';
        try {
            const res = await axios.get(`/api/books/search/?query=${newIsbn}&filterType=isbn`);
            if (res.data[0] != null) {
                const book = res.data[0];
                form.title = book.title;
                form.genre = book.genre;
                form.publisher = book.publisher;
                form.author_id = book.author_id;
                form.cover_url = book.cover_url;
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

});

// Captura el archivo seleccionado
const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.cover = file;
    }
    console.log(event.target.files[0]);
    console.log(form.cover.value);
}

</script>


<template>
    <AppLayout title="Nuevo libro">
        <template #header>
            <a href="">
                <h1 class="font-semibold text-4xl text-gray-800 leading-tight">Nuevo Libro</h1>
            </a>
        </template>
        <section class=" w-full">
            <div class="py-8 px-4 mx-auto my-10 rounded-xl max-w-2xl lg:py-16 bg-emerald-600">
                <form @submit.prevent="form.post('/books/store', { forceFormData: true })">
                    <div class="container flex flex-col items-center justify-center">
                        <div class="flex flex-col my-2 justify-between">
                            <label for="isbn" class="font-bold text-white">ISBN</label>
                            <input type="text" v-model="form.isbn" id="isbn" placeholder="ISBN" class="rounded w-96"
                                required>
                            <div v-if="form.errors.isbn" class="text-red-500">{{ form.errors.isbn }}</div>
                            <div v-if="isLoading" class="text-white">Buscando...</div>
                            <div v-if="errorMessage" class="text-red-500">{{ errorMessage }}</div>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="title" class="font-bold text-white">TíTULO</label>
                            <input type="text" v-model="form.title" id="title" placeholder="Título" class="rounded w-96"
                                required>
                            <div v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</div>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="genre" class="font-bold text-white">GÉNERO</label>
                            <input type="text" v-model="form.genre" id="genre" placeholder="Género" class="rounded w-96"
                                required>
                            <div v-if="form.errors.genre" class="text-red-500">{{ form.errors.genre }}</div>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="publisher" class="font-bold text-white">EDITORIAL</label>
                            <input type="text" v-model="form.publisher" id="publisher" placeholder="Editorial"
                                class="rounded w-96" required>
                            <div v-if="form.errors.publisher" class="text-red-500">{{ form.errors.publisher }}</div>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="author" class="font-bold text-white">
                                AUTOR
                                <span class="text-white">
                                    <a :href="route('addAuthorView')"><font-awesome-icon
                                            icon="fa-solid fa-user-plus" /></a>
                                </span>
                            </label>
                            <select name="author_id" v-model="form.author_id" id="author_id" class="rounded w-96"
                                required>
                                <option value="">Seleccione autor</option>
                                <option v-for="author in authors" :key="author_id" :value="author.id">
                                    {{ author.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.author_id" class="text-red-500">{{ form.errors.author_id }}</div>
                        </div>
                        <div class="display-none">
                            <input type="text" v-model="form.cover_url" id="cover_url" hidden>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="cover" class="font-bold text-white">PORTADA</label>
                            <input type="file" @change="handleFileChange" id="cover" placeholder="Portada"
                                class="rounded w-96 bg-white" accept=".jpg,.jpeg,.png,.webp">
                            <div v-if="form.errors.cover" class="text-red-500">{{ form.errors.cover }}</div>
                        </div>
                        <PrimaryButton type="submit"
                            class="flex flex-col my-2 justify-between bg-orange-600  hover:bg-orange-400"
                            :disabled="form.processing">
                            Añadir
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
<!-- <script>
methods: {
    handleFileChange(event) {
        this.form.cover = event.target.files[0];
    },
    submitForm() {
        this.form.post('/books/store', {
            forceFormData: true
        });
    }
}
</script> -->
