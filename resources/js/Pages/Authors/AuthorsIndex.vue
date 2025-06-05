<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    authors: Object
})
</script>

<template>
    <AppLayout class="h-screen" title="Autores">
        <section class="w-full flex justify-center items-center">
            <table class="bg-slate-50">
                <thead class="bg-emerald-400 text-white">
                    <tr class="">
                        <th class="px-2 py-1 text-center">ID</th>
                        <th class="px-2 py-1 text-center">NOMBRE</th>
                        <th class="px-2 py-1 text-center">FECHA CREACIÓN</th>
                        <th class="px-2 py-1 text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="author in authors" :key="author.id">
                        <td class="px-2 py-1 text-center">{{ author.id }}</td>
                        <td class="px-2 py-1 text-center">{{ author.name }}</td>
                        <td class="px-2 py-1 text-center">{{ author.created_at }}</td>
                        <td class="px-2 py-1 text-center">
                            <div class="flex gap-1 items-center">
                                <PrimaryButton>
                                    <font-awesome-icon :icon="['fas', 'eye']" class="z-50 text-l  text-stone-50" />
                                </PrimaryButton>
                                <SecondaryButton>
                                    <font-awesome-icon :icon="['fas', 'edit']" class="z-50 text-l text-stone-50" />
                                </SecondaryButton>
                                <DangerButton>
                                    <font-awesome-icon :icon="['fas', 'trash-alt']" class="z-50 text-l text-stone-50" />
                                </DangerButton>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>