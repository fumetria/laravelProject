<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center gap-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <a :href="route('loans')" :active="route().current('loans')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-between bg-orange-600 hover:bg-orange-400"
                            >
                            Préstamos
                        </PrimaryButton>
                    </a>
                    <a :href="route('books')" :active="route().current('books')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-between bg-sky-500 hover:bg-sky-300"
                            >
                            Libros
                        </PrimaryButton>
                    </a>
                    <!-- <a :href="route('')" :active="route().current('')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-between bg-orange-600 hover:bg-orange-400"
                            >
                            Usuarios
                        </PrimaryButton>
                    </a> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
