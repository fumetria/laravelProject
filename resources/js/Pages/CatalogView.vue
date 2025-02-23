<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayoutNoneUser from '@/Layouts/AppLayoutNoneUser.vue';
import axios from 'axios';

const query = ref('');
const tquery = ref('');
const errorMessage = ref('');

</script>

<template>
    <AppLayoutNoneUser title="Catálogo" class="">
        <template #header>
            <h1>Catálogo</h1>
        </template>
        <div class="flex justify-center my-5 align-middle">
            <div>
                <input type="text" v-model="query" id="query">
                <select name="tquery" id="tquery" v-model="tquery">
                    <option value="">Todos</option>
                    <option value="id_isbn">Id_isbn</option>
                    <option value="title">Título</option>
                    <option value="author_id">Autor</option>
                    <option value="isbn">Isbn</option>
                    <option value="genre">Género</option>
                    <option value="publisher">Editorial</option>
                    <option value="status">Estado</option>
                </select>
                <PrimaryButton @click="getBooks(query, tquery)" class="bg-orange-600  hover:bg-orange-400">
                    Buscar
                </PrimaryButton>
            </div>
            <div>{{ errorMessage }}</div>
        </div>
        <div>
            <div v-if="books" class="flex flex-col justify-center items-center">
                <div v-for="book in books" :key="book.id_isbn"
                    class="flex gap-3 my-2 mx-4 bg-white shadow w-full py-2 px-4">
                    <img :src="getCoverUrl(book.cover_url)" alt="" width="100" height="100">
                    <div class="flex flex-col w-full justify-between">
                        <div>
                            <div class="flex justify-between">
                                <h4 class="text-l font-bold">{{ book.title }}</h4>
                                <p :class="estado(book.status)">{{ book.status }}</p>
                            </div>

                            <p>{{ book.author_id }}</p>
                            <p>{{ book.genre }}</p>
                            <p>{{ book.publisher }}</p>
                        </div>
                        <div class="flex flex-col items-end justify-between">
                            <p class="text-blue-500">Ubicación</p>
                            <div class="flex gap-2">
                                <p>Planta: {{ book.location_floor }}</p>
                                <p>Pasillo: {{ book.location_aisle }}</p>
                                <p>Estantería: {{ book.location_bookshelves }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayoutNoneUser>
</template>

<script>
const books = ref('');
const getBooks = async (query, tquery) => {
    try {
        const res = await axios.get(`/api/catalog/search?query=${query}&filterType=${tquery}`);
        books.value = res.data;
    } catch (error) {
        if (error.response && error.response.status === 404) {
            errorMessage.value = 'No se encontró ningún libro con los datos introducidos.';
        } else {
            errorMessage.value = 'Ha ocurrido un error. Por favor, inténtelo de nuevo.';
        }
    }
};

export default {
    data() {
        return {
            items: [
                { status: 'Disponible' },
                { status: 'Prestado' }
            ]
        };
    },
    methods: {
        estado(status) {
            return {
                'text-green-500': status === 'Disponible',
                'text-red-500': status === 'Prestado'
            };
        },
        getCoverUrl(coverPath) {
            return coverPath ? `/storage/${coverPath}` : '/img/noimage.png';
        }
    }
};

</script>
