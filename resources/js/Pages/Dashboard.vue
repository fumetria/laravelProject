<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <AppLayout title="Dashboard" >
        <template #header>
            <div class="box-border flex justify-between">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h1>
                  <h2> Bienvenido <span class="text-red-600">{{ $page.props.auth.user.name }}</span></h2>
            </div>
        </template>

        <div class="py-12">
            <div class=" max-w-5xl mx-auto sm:px-6 lg:px-6 ">
                <div class="flex justify-center gap-4 bg-green-100 overflow-hidden shadow-xl sm:rounded-lg xl:p-8">
                    <a :href="route('loans')" :active="route().current('loans')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center text-2xl xl:size-64 size-32 bg-orange-600 hover:bg-orange-400 focus:bg-orange-700 active:bg-orange-900">
                            Préstamos
                        </PrimaryButton>
                    </a>
                    <a :href="route('books')" :active="route().current('books')">
                        <PrimaryButton type="button"
                            class="flex flex-col my-2 justify-center text-2xl xl:size-64 size-32 bg-sky-500 hover:bg-sky-300 focus:bg-sky-700 active:bg-sky-900">
                            Libros
                        </PrimaryButton>
                    </a>
                    <div v-if="$page.props.auth.user.is_admin === 1">
                        <a :href="route('usersList')" :active="route().current('usersList')">
                            <PrimaryButton type="button"
                                class="flex flex-col my-2 justify-center text-2xl xl:size-64 size-32 bg-pink-600 hover:bg-pink-400 focus:bg-pink-700 active:bg-pink-900">
                                Usuarios
                            </PrimaryButton>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>