<script setup>
import { ref, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';



defineProps({
    loans: Object,
})

const form = useForm({
    id_isbn: ref(''),
    title: ref(''),
    user_id: ref(''),
    employee_id: ref('')

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
            console.log(res);
            console.log(res.data[0]);
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
    <AppLayout title="Préstamo" class="flex flex-col justify-between h-screen">
        <template #header>
            <h1>Préstamo Libros</h1>
        </template>
        <div>
            <section class="bg-stone-500">
                <div class="">
                    <form @submit.prevent="form.post('/loans/store')">
                        <div>
                            <label for="id_isbn">ID_ISBN</label>
                            <input type="text" v-model="form.id_isbn" id="id_isbn" placeholder="Introduce id del libro">
                            <div v-if="isLoading" class="text-white">Buscando...</div>
                        </div>
                        <div>
                            <label for="title">TíTULO</label>
                            <input type="text" v-model="form.title" id="title" disabled>
                        </div>
                        <div>
                            <label for="user_id">ID USUARIO</label>
                            <input type="text" v-model="form.user_id" id="user_id" placeholder="Nº usuario">
                        </div>
                        <div>
                            <label for="employee_id" hidden>ID EMPLEADO</label>
                            <input type="text" id="employee_id" v-model="form.employee_id" hidden>
                        </div>
                        <PrimaryButton type="submit"
                            class="flex flex-col my-2 justify-between bg-orange-600 hover:bg-orange-400"
                            :disabled="form.processing">
                            Alta préstamo
                        </PrimaryButton>
                    </form>
                </div>
            </section>
            <aside>
                <a :href="route('loansList')" :active="route().current('loansList')">
                    <PrimaryButton type="button"
                        class="flex flex-col my-2 justify-between bg-orange-600 hover:bg-orange-400"
                        :disabled="form.processing">
                        Listado
                    </PrimaryButton>
                </a>
                <div></div>
            </aside>
        </div>
        <template #userLogged>
            Usuario: {{ $page.props.auth.user.id }} - {{ $page.props.auth.user.name }}
        </template>
    </AppLayout>
</template>
