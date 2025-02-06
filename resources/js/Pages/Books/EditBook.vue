<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';


const props = defineProps({
    authors: Object,
    book: Object,
})

const form = useForm({
    id_isbn: ref(''),
    title: ref(''),
    genre: ref(''),
    publisher: ref(''),
    author_id: ref(''),
    cover_url: ref(''),
    location_floor: ref(''),
    location_aisle: ref(''),
    location_bookshelves: ref(''),
})

form.id_isbn = props.book.id_isbn;
form.title = props.book.title;
form.genre = props.book.genre;
form.publisher = props.book.publisher;
form.author_id = props.book.author_id;
form.cover_url = props.book.cover_url;
form.location_floor = props.book.location_floor;
form.location_aisle = props.book.location_aisle;
form.location_bookshelves = props.book.location_bookshelves;

</script>


<template>
    <AppLayout title="Nuevo libro">
        <template #header>
            <a href="">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Editar Libro</h1>
            </a>
        </template>
        <section class=" w-full">
            <div class="py-8 px-4 mx-auto my-10 rounded-xl max-w-xl lg:py-10 bg-emerald-600">
                <form @submit.prevent="form.post('/books/update/{{ form.id_isbn }}')">
                    <div class="container flex flex-col items-center justify-center">
                        <div class="flex flex-col my-2 justify-between">
                            <label for="isbn" class="font-bold text-white">ISBN</label>
                            <input type="text" v-model="form.id_isbn" id="isbn" placeholder="ISBN" class="rounded w-96"
                                 disabled>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="title" class="font-bold text-white">TíTULO</label>
                            <input type="text" v-model="form.title" id="title" placeholder="Título" class="rounded w-96"
                                 disabled>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="genre" class="font-bold text-white">GÉNERO</label>
                            <input type="text" v-model="form.genre" id="genre" placeholder="Género" class="rounded w-96"
                               required>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="publisher" class="font-bold text-white">EDITORIAL</label>
                            <input type="text" v-model="form.publisher" id="publisher" placeholder="Editorial"
                                class="rounded w-96" required>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="author" class="font-bold text-white">
                                AUTOR
                                <span class="text-white">
                                    <a :href="route('addAuthorView')"><font-awesome-icon icon="fa-solid fa-user-plus" /></a>
                                </span>
                            </label>
                            <select name="author_id" v-model="form.author_id" id="author_id" class="rounded w-96"
                                required>
                                <option value="">Seleccione autor</option>
                                <option v-for="author in authors" :key="author_id" :value="author.id">
                                    {{ author.name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="cover_url" class="font-bold text-white">PORTADA</label>
                            <input type="text" v-model="form.cover_url" id="cover_url"  placeholder="Portada"
                                class="rounded w-96" required>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="cover_url" class="font-bold text-white">UBICACIÓN</label>
                            <div class="flex flex-row w-96 justify-center gap-2">
                                <input type="text" v-model="form.location_floor" id="location_floor" placeholder="Piso"
                                    class="rounded w-24" required >
                                <input type="text" v-model="form.location_aisle" id="location_aisle" placeholder="Pasillo"
                                    class="rounded w-24" required>
                                <input type="text" v-model="form.location_bookshelves" id="location_bookshelves"
                                    placeholder="Estantería" class="rounded w-24" required>
                            </div>
                        </div>
                        <PrimaryButton type="submit"
                            class="flex flex-col my-2 justify-between bg-orange-600  hover:bg-orange-400"
                            :disabled="form.processing">
                            Modificar
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
