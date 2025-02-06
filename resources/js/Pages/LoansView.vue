<script setup>
import { ref, watch } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';



defineProps({
    loans: Object,
    errorLoan: String,
})
const { props } = usePage();
const form = useForm({
    id_isbn: ref(''),
    title: ref(''),
    user_id: ref(''),
    employee_id: props.auth.user.id

})

// Busca el nombre del libro para mostrar al introducir id_isbn del libro
const isLoading = ref(false);
const errorMessage = ref('');
watch(() => form.id_isbn, async (newIsbn) => {
    if (newIsbn > 10) {
        isLoading.value = true;
        errorMessage.value = '';
        try {
            const res = await axios.get(`/api/books/search/?query=${newIsbn}&filterType=id_isbn`);
            if (res.data[0] != null) {
                const book = res.data[0];
                form.title = book.title;
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
    <AppLayout title="Préstamo" class="">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Préstamo Libros</h1>

        </template>
        <div class="h-full flex justify-center items-center gap-4">
            <section class="bg-emerald-600 rounded-xl px-5 flex justify-center my-5">
                <div class="py-1 px-2 mx-auto my-10 rounded-xl max-w-xl bg-emerald-600">
                    <form @submit.prevent="form.post('/loans/store')">
                        <div class="container flex flex-col items-center justify-center">
                            <div class="flex flex-col my-2 justify-between">
                                <label for="id_isbn" class="text-white">ID_ISBN</label>
                                <input type="text" v-model="form.id_isbn" id="id_isbn"
                                    placeholder="Introduce id del libro" class="focus:border-orange-600 focus:outline-orange-600">
                                <div v-if="isLoading" class="text-white">Buscando...</div>
                                <div v-if="errorMessage" class="text-white">{{ errorMessage }}</div>
                            </div>
                            <div class="flex flex-col my-2 justify-between">
                                <label for="title" class="text-white">TíTULO</label>
                                <input type="text" v-model="form.title" id="title" disabled>
                            </div>
                            <div class="flex flex-col my-2 justify-between">
                                <label for="user_id" class="text-white">ID USUARIO</label>
                                <input type="text" v-model="form.user_id" id="user_id" placeholder="Nº usuario">
                            </div>
                            <div v-bind="errorLoan" class="text-red-500">{{ errorLoan }}</div>
                            <PrimaryButton type="submit"
                                class="flex flex-col my-2 justify-between bg-orange-600 hover:bg-orange-400"
                                :disabled="form.processing">
                                Alta préstamo
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
                <aside class="flex flex-col gap-2 justify-center mx-2">
                    <a :href="route('loansList')" :active="route().current('loansList')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center size-32 items-center bg-sky-600 hover:bg-sky-400"
                            :disabled="form.processing">
                            Listado
                        </PrimaryButton>
                    </a>
                    <a :href="route('loansReturn')" :active="route().current('loansReturn')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center size-32 items-center bg-pink-600 hover:bg-pink-400"
                            :disabled="form.processing">
                            Devolución
                        </PrimaryButton>
                    </a>
                </aside>
            </section>

        </div>

    </AppLayout>
</template>

<script>

</script>
