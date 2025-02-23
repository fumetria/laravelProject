<script setup>
import { ref, watch } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';



defineProps({
    loans: Object,
    errorLoan: String,
})

const form = useForm({
    id_isbn: ref(''),
    title: ref(''),
    user_id: ref(''),

})

// Busca el nombre del libro para mostrar al introducir id_isbn del libro
const isLoading = ref(false);
const errorMessage = ref('');
watch(() => form.id_isbn, async (id_isbn) => {
    if (id_isbn > 10) {
        isLoading.value = true;
        errorMessage.value = '';
        try {
            const res = await axios.get(`/loans/show/${id_isbn}`);
            if (res.data[0] != null) {
                const loan = res.data[0];
                form.id_isbn = loan.id_isbn;
                form.user_id = loan.user_id;
            }
        } catch (error) {
            if (error.response && error.response.status === 404) {
                errorMessage.value = 'No se encontró ningún préstamo con este id.';
            } else {
                errorMessage.value = 'Ocurrió un error al buscar el ID.';
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
            <h1 class="font-semibold text-4xl text-gray-800 leading-tight">Préstamo Libros</h1>

        </template>
        <div class="h-full flex justify-center items-center gap-4">
            <section class="bg-pink-600 rounded-xl px-5 py-2 flex justify-center my-5">
                <div class="py-1 px-2 mx-auto my-10 rounded-xl max-w-xl bg-pink-600">
                    <form @submit.prevent="form.post('/loans/finish')">
                        <div class="container flex flex-col me-2 items-center justify-center">
                            <div class="flex flex-col my-2 justify-between">
                                <label for="id_isbn" class="text-white">ID_ISBN</label>
                                <input type="text" v-model="form.id_isbn" id="id_isbn"
                                    placeholder="Introduce id del libro">
                                <div v-if="isLoading" class="text-white">Buscando...</div>
                                <div v-if="errorMessage" class="text-white">{{ errorMessage }}</div>
                            </div>
                            <!-- <div class="flex flex-col my-2 justify-between">
                            <label for="title">TíTULO</label>
                            <input type="text" v-model="form.title" id="title" disabled>
                        </div> -->
                            <div class="flex flex-col my-2 justify-between">
                                <label for="user_id" class="text-white">ID USUARIO</label>
                                <input type="text" v-model="form.user_id" id="user_id" placeholder="Nº usuario"
                                    disabled>
                            </div>

                            <div v-bind="errorLoan" class="text-red-500">{{ errorLoan }}</div>
                            <PrimaryButton type="submit"
                                class="flex flex-col my-2 justify-between bg-orange-600 hover:bg-orange-400"
                                :disabled="form.processing">
                                Devolución libro
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
                <aside class="flex flex-col gap-2">
                    <a :href="route('loansList')" :active="route().current('loansList')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center size-32 items-center bg-sky-600 hover:bg-sky-400"
                            :disabled="form.processing">
                            Listado
                        </PrimaryButton>
                    </a>
                    <a :href="route('loans')" :active="route().current('loans')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center size-32 items-center bg-purple-600 hover:bg-purple-400"
                            :disabled="form.processing">
                            Alta préstamo
                        </PrimaryButton>
                    </a>
                </aside>
            </section>

        </div>
        <template #userLogged>
            Usuario: {{ $page.props.auth.user.id }} - {{ $page.props.auth.user.name }}
        </template>
    </AppLayout>
</template>

<script>

</script>
