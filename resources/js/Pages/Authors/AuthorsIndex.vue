<script setup>
import AuthorOfTheMonth from '@/Components/AuthorOfTheMonth.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';


defineProps({
    authors: Object
});

const selectedAuthor = ref('');
const showModal = ref(false);

const openModal = (author) => {
    selectedAuthor.value = author;
    showModal.value = true;
}
const closeModal = () => {
    showModal.value = false;
}

</script>

<template>
    <AppLayout class="h-screen" title="Autores">
        <section class="mx-auto w-full max-w-3xl flex flex-col justify-center items-center">
            <div class="flex justify-between items-center w-full bg-emerald-600 px-4 py-2">
                <h1 class="uppercase text-xl text-white">lista de autores</h1>
                <Link :href="route('addAuthorView')">
                <button title="nuevo autor"
                    class="bg-emerald-400 hover:bg-emerald-700 size-8 flex justify-center items-center rounded">
                    <font-awesome-icon :icon="['fas', 'plus']" class="z-50 text-xl text-stone-50" />
                </button>
                </Link>

            </div>
            <table class="bg-slate-50 w-full">
                <thead class="bg-emerald-400  border-x border-collapse border-emerald-400 text-white">
                    <tr class="">
                        <th class="px-2 py-1 text-center">ID</th>
                        <th class="px-2 py-1 text-center">NOMBRE</th>
                        <th class="px-2 py-1 text-center">FECHA CREACIÓN</th>
                        <th class="px-2 py-1 text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="author in authors" :key="author.id">
                        <td class="px-2 py-1 text-center border-x border-collapse border-emerald-400">{{ author.id }}
                        </td>
                        <td class="px-2 py-1 text-center border-x border-collapse border-emerald-400">{{ author.name }}
                        </td>
                        <td class="px-2 py-1 text-center border-x border-collapse border-emerald-400">{{
                            author.created_at }}</td>
                        <td
                            class="py-2 text-center flex justify-center items-center border-x border-collapse border-emerald-400">
                            <div class="flex gap-3 items-center">
                                <PrimaryButton title="Ver detalles de autor" @click="openModal(author)">
                                    <font-awesome-icon :icon="['fas', 'eye']" class="z-50 text-l  text-stone-50" />
                                </PrimaryButton>
                                <SecondaryButton title="Editar">
                                    <font-awesome-icon :icon="['fas', 'edit']" class="z-50 text-l text-stone-50" />
                                </SecondaryButton>
                                <DangerButton title="Eliminar">
                                    <font-awesome-icon :icon="['fas', 'trash-alt']" class="z-50 text-l text-stone-50" />
                                </DangerButton>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section id="showAuthor">
            <DialogModal :show="showModal" @close="closeModal()">
                <template #title>
                    <h2>{{ selectedAuthor.name }}</h2>
                </template>
                <template #content>
                    <div class="flex flex-col justify-center gap-2">
                        <section class="mb-3 flex justify-center">
                            <img :src="selectedAuthor.profile_url" :alt="selectedAuthor.name + ' profile photo'"
                                class="size-2/4 rounded">
                        </section>
                        <section class="mt-2">
                            <p>{{ selectedAuthor.biography }}</p>
                        </section>
                    </div>
                </template>
                <template #footer>
                    <div class="flex justify-center">
                        <PrimaryButton @click="closeModal()">
                            Cerrar
                        </PrimaryButton>

                    </div>
                </template>

            </DialogModal>
        </section>
    </AppLayout>
</template>