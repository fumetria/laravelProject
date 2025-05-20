<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AuthorOfTheMonth from '@/Components/AuthorOfTheMonth.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Banner from '@/Components/Banner.vue';
import FeatureSection from '@/Components/FeatureSection.vue';
import WelcomeHeader from '@/Components/WelcomeHeader.vue';

defineProps({
    author: Object,
})

const welcomeTitle = 'Bienvenidos a la biblioteca';
const welcomeDescription = 'Accede a nuestro catálogo y encuentra el libro que necesitas para tu trabajo o simplemente algo para leer';
</script>


<template>
    <AppLayout title="Welcome" class="">
        <!-- <template #header>
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight">Bienvenido</h1>
        </template> -->
        <section class="bg-slate-200">
            <WelcomeHeader :welcome-title="welcomeTitle" :welcome-description="welcomeDescription"></WelcomeHeader>
            <AuthorOfTheMonth :author="author"></AuthorOfTheMonth>
            <section class="py-5 px-5 rounded-xl">
                <div class="rounded-xl">
                    <FeatureSection>
                        <template #title>
                            <h2>Nuestro catálogo</h2>
                        </template>
                        <template #content class="">
                            <img src="/img/welcome/catalog-img.webp" alt="Imagen de una biblioteca" width="400px"
                                height="300px" class="rounded-lg float-right ml-4 mb-4">
                            <p>Disponemos de un amplio catálogo de libros. Accede a nuestro catálogo y encuentra el
                                libro
                                que necesitas para tu trabajo o simplemente algo para leer</p>

                        </template>
                        <template #footer>
                            <div class="flex w-full justify-end">
                                <button
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-cyan-800 hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Ir
                                    a Catálogo</button>
                            </div>
                        </template>
                    </FeatureSection>
                    <FeatureSection>
                        <template #title>
                            <h2>Eventos</h2>
                        </template>
                        <template #content class="">
                            <img src="/img/welcome/eventos.webp" alt="Imagen de una ponencia" width="400px"
                                height="300px" class="rounded-lg float-right ml-4 mb-4">
                            <p>Consulta nuestro calendario de eventos y actividades que diserrollamos dentro de nuestras instalaciones a lo largo del año.</p>

                        </template>
                        <template #footer>
                            <div class="flex w-full justify-end">
                                <button
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-cyan-800 hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Ir
                                    a Eventos</button>
                            </div>
                        </template>
                    </FeatureSection>
                    <FeatureSection>
                        <template #title>
                            <h2>Comunidad</h2>
                        </template>
                        <template #content class="">
                            <img src="/img/welcome/comunidad.webp" alt="Grupo de lectura" width="400px"
                                height="300px" class="rounded-lg float-right ml-4 mb-4">
                            <p>Accede a nuestra comunidad y encuentra personas con tus mismos intereses o recomendaciones de lectura.</p>
                        </template>
                        <template #footer>
                            <div class="flex w-full justify-end">
                                <button
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-cyan-800 hover:bg-cyan-700 focus:bg-cyan-700 active:bg-cyan-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Ir
                                    a Comunidad</button>
                            </div>
                        </template>
                    </FeatureSection>
                </div>

            </section>
        </section>

    </AppLayout>

</template>
