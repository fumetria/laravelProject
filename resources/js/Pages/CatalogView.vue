<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayoutNoneUser from '@/Layouts/AppLayoutNoneUser.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';

const query = ref('');
const tquery = ref('');
const errorMessage = ref('');

</script>

<template>
    <AppLayout title="Catálogo" class="">
        <template #header>
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight">Catálogo</h1>
        </template>
        <div class="flex justify-center my-5 align-middle">
            <div>
                <input type="text" v-model="query" id="query" placeholder="Introduce texto a buscar">
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
            <div v-if="loanding">
                <p><span><img src="/img/loading.gif" alt="loading animation"></span> Buscando...</p>
            </div>
            <div v-bind="errorMessage">{{ errorMessage }}</div>
        </div>
        <div>
            <div v-if="books" class="flex flex-col justify-center items-center">
                <div v-for="book in books" :key="book.id_isbn"
                    class="flex gap-3 my-2 mx-4 bg-white shadow w-full py-2 px-4">
                    <img :src="getCoverUrl(book.cover_url)" :alt="book.title + ' cover'" width="100" height="100"
                        class="border">
                    <div class="flex flex-col w-full justify-between">
                        <div>
                            <div class="flex justify-between">
                                <h4 class="text-l font-bold uppercase">{{ book.title }}</h4>
                                <p :class="estado(book.status)">{{ book.status }}</p>
                            </div>

                            <p class="italic">{{ book.author_id }}</p>
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
    </AppLayout>
</template>

<script>
const books = ref('');
const errorMessage = ref('');
const loading = ref(false);
const getBooks = async (query, tquery) => {
    try {
        loading.value = true;
        const res = await axios.get(`/api/catalog/search?query=${query}&filterType=${tquery}`);
        console.log(res);
        if (res.data === 'Introduce texto a buscar') {
            errorMessage.value = res.data;
            loading.value = false;
            return;
        }
        books.value = await Promise.all(res.data.map(async (book) => {
            book.author_id = await getAuthorNom(book.author_id);
            return book;
        }));
        loading.value = false;
    } catch (error) {
        if (error.response && error.response.status === 404) {
            errorMessage.value = 'No se encontró ningún libro con los datos introducidos.';
        } else {
            errorMessage.value = 'Ha ocurrido un error. Por favor, inténtelo de nuevo.';
        }
    }
};
async function getAuthorNom(authorId) {
    try {
        const res = await axios.get(`/api/authors/${authorId}`);
        let author = res.data.name;
        return author;
    } catch (error) {
        return `Autor no encontrado`
    }
}

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
            return coverPath ? `/storage${coverPath}` : '/img/noimage.png';
        },
        async getAuthorName(authorId) {

            try {
                const res = await axios.get(`/api/authors/${authorId}`);
                console.log(res);
                let author = res.data.name;
                console.log(author);
                console.log(author.name);
                return author.name;
            } catch (error) {
                return `Autor no encontrado`
            }
        }
    }
};

</script>
