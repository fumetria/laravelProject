<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="box-border flex justify-between">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h1>
                  <h2> Bienvenido <span class="text-red-600">{{ $page.props.auth.user.name }}</span></h2>
            </div>
        </template>

        <div class="py-12">
            <div class=" max-w-5xl mx-auto sm:px-6 lg:px-6">
                <div class="flex justify-center gap-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <a :href="route('loans')" :active="route().current('loans')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center text-2xl xl:size-64 size-32 bg-orange-600 hover:bg-orange-400">
                            Préstamos
                        </PrimaryButton>
                    </a>
                    <a :href="route('books')" :active="route().current('books')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center text-2xl xl:size-64 size-32 bg-sky-500 hover:bg-sky-300">
                            Libros
                        </PrimaryButton>
                    </a>
                    <div v-if="$page.props.auth.user.is_admin === 1">
                        <a :href="route('usersList')" :active="route().current('usersList')">
                            <PrimaryButton type="button"
                                class="flex flex-col my-2 justify-center text-2xl xl:size-64 size-32 bg-pink-600 hover:bg-pink-400">
                                Usuarios
                            </PrimaryButton>
                        </a>

                    </div>
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
