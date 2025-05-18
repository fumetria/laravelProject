<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AuthorOfTheMonth from '@/Components/AuthorOfTheMonth.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

</script>


<template>
    <AppLayout title="Welcome" class="">
        <template #header>
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight">Bienvenido</h1>
        </template>
        <section>
            <WelcomeHeader></WelcomeHeader>
            <AuthorOfTheMonth ></AuthorOfTheMonth>
            <section>
                <FeatureSection>
                    <template #title>
                        <h2>Catálogo</h2>
                    </template>
                    <template #content>
                        <img src="/img/welcome/catalog-img.webp" alt="Imagen de una biblioteca">
                        <p>Disponemos de un amplio catálogo de libros. Accede a nuestro catálogo y encuentra el libro que necesitas para tu trabajo o simplemente algo para leer</p>
                        <PrimaryButton>Ir a Catálogo</PrimaryButton>
                    </template>
                </FeatureSection>
            </section>
        </section>

    </AppLayout>

</template>
