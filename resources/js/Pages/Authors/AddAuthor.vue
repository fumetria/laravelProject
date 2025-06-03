<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';

const form = useForm({
    name: ref(''),
    biography: ref(''),
    profile_photo: ref(null),
    profile_url: ref(''),
})

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.cover = file;
    }
}
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
            <div class="py-4 mx-auto my-10 rounded-xl max-w-2xl lg:py-4 bg-emerald-600">

                <form @submit.prevent="form.post('/authors/store')">
                    <div class="container flex flex-col items-center justify-center">
                        <section>
                            <h1 class="uppercase text-white font-bold text-left text-xl ">Nuevo Autor</h1>
                        </section>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="name" class="font-bold text-white">NOMBRE</label>
                            <input type="text" v-model="form.name" id="name" placeholder="Nombre autor"
                                class="rounded w-96" required>
                            <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="name" class="font-bold text-white">BIOGRAFIA</label>
                            <textarea maxlength="2048" v-model="form.biography" id="biography"
                                placeholder="Biografía del autor" class="rounded w-96 field-sizing-content" cols="20"
                                rows="6" required></textarea>
                            <div v-if="form.errors.biography" class="text-red-500">{{ form.errors.biography }}</div>
                        </div>
                        <div class="flex flex-col my-2 justify-between">
                            <label for="name" class="font-bold text-white">IMAGEN PERFIL</label>
                            <input type="file" @change="handleFileChange"  id="profile_photo" placeholder="Inserte imagen de perfil"
                                class="rounded w-96 bg-white" accept=".jpg,.jpeg,.png,.webp" required>
                            <div v-if="form.errors.profile_photo" class="text-red-500">{{ form.errors.profile_photo }}</div>
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
