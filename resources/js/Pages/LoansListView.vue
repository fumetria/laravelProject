<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    loans: Object,
});


</script>

<template>
    <AppLayout title="Listado Préstamos">
        <template #header>
            <div class="box-border flex justify-between content-center items-center">
                <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                    Listado Préstamos
                </h1>
            </div>

        </template>
        <section class="bg-stone-900 my-4 mx-5 ">
            <table class="items-center py-3 border-collapse border-neutral-800 bg-orange-300">
                <thead class="bg-cyan-200 py-3 px-4">
                    <tr class="border-collapse border border-neutral-800 text-blueGray-500">
                        <th class="text-neutral-500 py-2 px-2">ID</th>
                        <th class="text-neutral-500 py-2 px-2">FECHA ALTA</th>
                        <th class="text-neutral-500 py-2 px-2">ID_ISBN</th>
                        <th class="text-neutral-500 py-2 px-2">ID_USUARIO</th>
                        <th class="text-neutral-500 py-2 px-2">FECHA DEVOLUCION</th>
                        <th class="text-neutral-500 py-2 px-2">FECHA MÁXIMA</th>
                        <th class="text-neutral-500 py-2 px-2">ESTADO</th>
                        <th class="text-neutral-500 py-2 px-2">ID_EMPLEADO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="loan in loans" :key="loan.id" class="items-center">
                        <th class="p-2">{{ loan.id }}</th>
                        <td class="p-2">{{ loan.loan_start_date }}</td>
                        <td class="p-2">{{ loan.book_id_isbn }}</td>
                        <td class="p-2">{{ loan.user_id }}</td>
                        <td class="p-2 text-center">{{ loan.loan_end_date }}</td>
                        <td class="p-2">{{ loan.loan_due_date }}</td>
                        <td class="p-2">{{ loan.loan_status }}</td>
                        <td class="p-2">{{ loan.employee_id }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>
