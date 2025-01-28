<script setup>
import { ref, watch } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrivacyPolicy from './PrivacyPolicy.vue';
import NavLink from '@/Components/NavLink.vue';
import FormSection from '@/Components/FormSection.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Banner from '@/Components/Banner.vue';
import TextInput from '@/Components/TextInput.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    authors: Object,
})

const form = useForm({
    isbn: '',
    title: '',
    genre: '',
    publisher: '',
    author_id: '',
    cover_url: '',
})

</script>

<template>
    <AppLayout>
        <h1>Nuevo Libro</h1>
        <form @submit.prevent="form.post('/books/store')">
            <div>
                <label for="isbn">ISBN</label>
                <input type="text" v-model="form.isbn" id="isbn" placeholder="ISBN">
            </div>
            <div>
                <label for="title">TíTULO</label>
                <input type="text" v-model="form.title" id="title" placeholder="Título">
            </div>
            <div>
                <label for="genre">GÉNERO</label>
                <input type="text" v-model="form.genre" id="genre" placeholder="Género">
            </div>
            <div>
                <label for="publisher">EDITORIAL</label>
                <input type="text" v-model="form.publisher" id="publisher" placeholder="Editorial">
            </div>
            <div>
                <label for="author">AUTOR</label>
                <select name="author_id" v-model="form.author_id"  id="author_id">
                    <option value="">Autor:</option>
                    <option v-for="author in authors" :key="author_id" :value="author.id">
                        {{ author.name }}
                    </option>
                </select>
            </div>
            <div>
                <label for="cover_url">PORTADA</label>
                <input type="text" v-model="form.cover_url" id="cover_url" placeholder="Portada">
            </div>
            <!-- <button type="submit" :disabled="form.processing">Añadir</button> -->
            <PrimaryButton type="submit">
                <template #btnName>
                    Añadir
                </template>
            </PrimaryButton>
        </form>
    </AppLayout>
</template>