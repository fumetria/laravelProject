<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import { ref } from 'vue';

defineProps({
    books: Object,
    updateBookMsg: String,
    newBookMsg: String,
});

const showModal = ref(false);
const selectedBook = ref('');
const barcode = ref('');
const openModal = async (book) => {
    selectedBook.value = book;
    const res = await axios.get(`/api/books/barcode/${selectedBook.value.id_isbn}`);
    barcode.value = res.data.barcode;
    showModal.value = true;
}
const closeModal = () => {
    showModal.value = false
}

const printBarcode = () =>{

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
                    <PrimaryButton title="Nuevo Libro">
                        <font-awesome-icon :icon="['fas', 'plus']" class="z-50 text-xl text-stone-50" />
                    </PrimaryButton>
                </a>
            </div>

        </template>
        <section class="bg-stone-900 my-4 mx-5 overflow-scroll overflow-y-auto ">
            <div>
                <h2>{{ newBookMsg }}</h2>
            </div>
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
                        <td class="p-2 text-center ">
                            <div class="flex flex-row gap-1 justify-center items-center align-middle">
                                <a :href="route('editBook', book.id_isbn)">
                                    <PrimaryButton title="Editar libro" class=" bg-orange-600  hover:bg-orange-400">
                                        <font-awesome-icon :icon="['fas', 'edit']" class="z-50 text-l  text-stone-50" />
                                    </PrimaryButton>
                                </a>
                                <div v-if="$page.props.auth.user.is_admin === 1">
                                    <PrimaryButton title="Eliminar libro"
                                        class="bg-red-600 hover:bg-red-400 focus:bg-red-700 active:bg-red-900"
                                        @click.prevent="deleteBook(book.id_isbn)">
                                        <font-awesome-icon :icon="['fas', 'trash-alt']"
                                            class="z-50 text-l text-stone-50" />
                                    </PrimaryButton>
                                </div>
                                <div>
                                    <PrimaryButton title="Imprimir código de barras"
                                        class="bg-sky-600 hover:bg-sky-400 focus:bg-sky-700 active:bg-sky-900"
                                        @click="openModal(book)">
                                        <font-awesome-icon :icon="['fas', 'barcode']"
                                            class="z-50 text-l text-stone-50" />
                                    </PrimaryButton>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section>
            <Modal class="" :show="showModal" @close="closeModal()">
                <div class="flex flex-col justify-center items-center gap-6 my-4" id="book_barcode">
                    <section class="flex gap-2">
                        <img src="/img/libraryLogos.PNG" alt="" height="40px" width="100px">
                        <div class="flex flex-col items-center justify-center">
                            <h2 class="uppercase font-mono">{{ selectedBook.title }}</h2>
                            <div v-html="barcode">
                            </div>
                        </div>
                    </section>

                    <div class="flex justify-center gap-2">
                        <PrimaryButton @click="closeModal()" class="bg-red-600 hover:bg-red-400 focus:bg-red-700 active:bg-red-900">
                            Cerrar
                        </PrimaryButton>
                        <PrimaryButton class="flex gap-2 bg-sky-600 hover:bg-sky-400 focus:bg-sky-700 active:bg-sky-900">
                            <font-awesome-icon :icon="['fas', 'print']" />
                            Imprimir
                        </PrimaryButton>
                    </div>
                </div>
            </Modal>
        </section>
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