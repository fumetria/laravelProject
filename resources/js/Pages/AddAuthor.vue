<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';

const form = useForm({
    name: ref(''),
})

// const isLoading = ref(false);
// const errorMessage = ref('');
// watch(() => form.isbn, async (newIsbn) => {
//     if (newIsbn > 10) {
//         isLoading.value = true;
//         errorMessage.value = '';
//         try {
//             const res = await axios.get(`/api/books/search/?query=${newIsbn}&filterType=isbn`);
//             console.log(res);
//             console.log(res.data[0]);
//             if (res.data[0] != null) {
//                 const book = res.data[0];
//                 form.title = book.title;
//                 form.genre = book.genre;
//                 form.publisher = book.publisher;
//                 form.author_id = book.author_id;
//                 form.cover_url = book.cover_url;
//             }
//         } catch (error) {
//             if (error.response && error.response.status === 404) {
//                 errorMessage.value = 'No se encontró ningún libro con este ISBN.';
//             } else {
//                 errorMessage.value = 'Ocurrió un error al buscar el ISBN.';
//             }
//         } finally {
//             isLoading.value = false;
//         }
//     }

// })
</script>


<template>
    <AppLayout title="Nuevo autor">
        <template #header>
            <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                <span>
                    <a :href="route('newBook')">
                        <font-awesome-icon icon="circle-xmark" class="z-50 text-xl text-red-600" />
                    </a>
                </span>
                Nuevo Autor
            </h1>
        </template>
        <section class=" w-full">
            <div class="py-4 px-4 mx-auto my-10 rounded-xl max-w-2xl lg:py-4 bg-emerald-600">
                <form @submit.prevent="form.post('/authors/store')">
                    <div class="container flex flex-col items-center justify-center">
                        <div class="flex flex-col my-2 justify-between">
                            <label for="name" class="font-bold text-white">NOMBRE</label>
                            <input type="text" v-model="form.name" id="name" placeholder="Nombre autor"
                                class="rounded w-96" required>
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
