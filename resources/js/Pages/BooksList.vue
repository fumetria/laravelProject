<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import axios from 'axios';

defineProps({
    books: Array,
    authors: Object,
});

const showModal = ref(false);
const selectedBook = ref('');
const updateBookOk = ref();
const updateBookMsg = ref('');

const openModal = (book) => {
    selectedBook.value = book;
    showModal.value = true;
}
const closeModal =  () => {
    showModal.value = false
}

function updateBook(book){
    const res = axios.put(`/api/books/update/${book.id_isbn}`, book);
    closeModal();
}

function checkAuthorId(bookAuthorId, authorId){
    if(bookAuthorId === authorId){
        return true
    }
}

</script>



<template>
    <AppLayout title="Listado Libros">
        <template #header>
            <div class="box-border flex justify-between">
                <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Listado Libros
                </h1>
                <a :href="route('newBook')">
                    <PrimaryButton>
                        <font-awesome-icon :icon="['fas', 'plus']" class="z-50 text-xl text-stone-50" />
                    </PrimaryButton>
                </a>
            </div>

        </template>
        <section class="bg-stone-900 my-4 mx-5 overflow-scroll overflow-y-auto ">
            <table class="items-center w-full py-3 border-collapse border-neutral-800 bg-stone-50">
                <thead class="bg-emerald-600 py-3 px-4 border-collapse border border-neutral-800 text-blueGray-500">
                    <tr class="">
                        <th rowspan="2" class="text-stone-100 py-2 px-2">ID_ISBN</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">ISBN</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">TíTULO</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">GÉNERO</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">EDITORIAL</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">AUTOR</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">ESTADO</th>
                        <th colspan="3" class="text-stone-100 pt-2 px-2">UBICACIÓN</th>
                        <th rowspan="2" class="text-stone-100 py-2 px-2">ACCIONES</th>
                    </tr>
                    <tr>
                        <th class="text-stone-100 pb-2 px-2">PISO</th>
                        <th class="text-stone-100 pb-2 px-2">PASILLO</th>
                        <th class="text-stone-100 pb-2 px-2">ESTANTERÍA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books" :key="book.id" class="items-center even:bg-gray-200">
                        <td class="p-2">{{ book.id_isbn }}</td>
                        <td class="p-2">{{ book.isbn }}</td>
                        <td class="p-2 text-wrap">{{ book.title }}</td>
                        <td class="p-2 text-center">{{ book.genre }}</td>
                        <td class="p-2">{{ book.publisher }}</td>
                        <td class="p-2">{{ book.author_id }}</td>
                        <td class="p-2" :class="estado(book.status)">{{
                            book.status
                            }}</td>
                        <td class="p-2 text-center">{{ book.location_floor }}</td>
                        <td class="p-2 text-center">{{ book.location_aisle }}</td>
                        <td class="p-2 text-center">{{ book.location_bookshelves }}</td>
                        <td class="p-2 text-center flex flex-row gap-1 justify-center items-center">
                            <PrimaryButton class=" bg-orange-600  hover:bg-orange-400 focus:bg-orange-400" @click="openModal(book)">
                                <font-awesome-icon :icon="['fas', 'edit']" class="z-50 text-l  text-stone-50" />
                            </PrimaryButton>

                            <div v-if="$page.props.auth.user.is_admin === 1">
                                <PrimaryButton class="bg-red-500" @click.prevent="deleteBook(book.id_isbn)">
                                    <font-awesome-icon :icon="['fas', 'trash-alt']" class="z-50 text-l text-stone-50" />
                                </PrimaryButton>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <Modal :show="showModal" @close="closeModal()">
            <template #default>
                <div class="p-6">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-semibold">Editar Libro</h2>
                        <div><font-awesome-icon :icon="['fas', 'x']" class="text-xl text-gray-800" /></div>
                    </div>
                    
                    <form method="put" @submit.prevent="updateBook(selectedBook)">
                        <div class="mt-4">
                            <input type="text" v-model="selectedBook.isbn" id="isbn" placeholder="ISBN" class="rounded w-96"
                                disabled hidden>
                        </div>
                        <div class="mt-4">
                            <label for="id_isbn" class="block">Id_isbn</label>
                            <input v-model="selectedBook.id_isbn" type="text" id="id_isbn" class="mt-2 p-2 w-full" disabled/>
                        </div>
                        <div class="mt-4">
                            <label for="title" class="block">Título</label>
                            <input v-model="selectedBook.title" type="text" id="title" class="mt-2 p-2 w-full" />
                        </div>
                        <div class="mt-4">
                            <label for="author" class="block">Género</label>
                            <input v-model="selectedBook.genre" type="text" id="author" class="mt-2 p-2 w-full" />
                        </div>
                        <div class="mt-4">
                            <label for="author" class="block">Autor</label>
                            <input v-model="selectedBook.author_id" type="text" id="author" class="mt-2 p-2 w-full" />
                            <select name="author_id" v-model="selectedBook.author_id" id="author_id" class="rounded w-96"
                                required>
                                <option value="">Seleccione autor</option>
                                <option v-for="author in authors" :key="author_id" :value="author.id" :selected="checkAuthorId(selectedBook.author_id, author.id)">
                                    {{ author.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="publisher" class="block">Editorial</label>
                            <input v-model="selectedBook.publisher" type="text" id="publisher"
                                class="mt-2 p-2 w-full" />
                        </div>
                        <div class="mt-4">
                            <label for="cover_url" class="block">Ubicación</label>
                            <div class="flex flex-row w-96 justify-center gap-2">
                                <input type="text" v-model="selectedBook.location_floor" id="location_floor" placeholder="Piso"
                                    class="rounded w-24" required>
                                <input type="text" v-model="selectedBook.location_aisle" id="location_aisle"
                                    placeholder="Pasillo" class="rounded w-24" required>
                                <input type="text" v-model="selectedBook.location_bookshelves" id="location_bookshelves"
                                    placeholder="Estantería" class="rounded w-24" required>
                            </div>
                        </div>
                        <!-- Agrega más campos según sea necesario -->
                        <div class="mt-4 text-right">
                            <PrimaryButton type="submit" class="bg-green-600 hover:bg-green-400 focus:bg-green-400">
                                Guardar cambios
                            </PrimaryButton>
                        </div>
                    </form>
                    <div class="">{{ updateBookMsg }}</div>
                </div>
            </template>
        </Modal>
    </AppLayout>
</template>

<script>
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
        deleteBook(id_isbn) {
            this.$inertia.delete(route('deleteBook', id_isbn));
        }
    }
};

</script>
