<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    loans: Object,
});


</script>

<template>
    <AppLayout title="Listado Préstamos">
        <template #header class="flex justify-between">
            <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                <span>
                    <a :href="route('loans')">
                        <font-awesome-icon icon="circle-xmark"  class="z-50 text-xl text-red-600"/>
                    </a>
                </span>
                Listado Préstamos
            </h1>

        </template>
        <section class=" my-4 mx-5 ">
            <table class="items-center w-full py-3 border-collapse border-neutral-800 ">
                <thead class="bg-cyan-200 py-3 px-4">
                    <tr class="border-collapse border border-neutral-800 text-blueGray-500">
                        <th class="text-neutral-500 py-2 px-2">ID</th>
                        <th class="text-neutral-500 py-2 px-2">FECHA ALTA</th>
                        <th class="text-neutral-500 py-2 px-2">LIBRO_ID</th>
                        <th class="text-neutral-500 py-2 px-2">ID_USUARIO</th>
                        <th class="text-neutral-500 py-2 px-2">FECHA DEVOLUCION</th>
                        <th class="text-neutral-500 py-2 px-2">FECHA MÁXIMA</th>
                        <th class="text-neutral-500 py-2 px-2">ESTADO</th>
                        <th class="text-neutral-500 py-2 px-2">ID_EMPLEADO</th>
                        <th class="text-neutral-500 py-2 px-2">ULTIMA MODIFICACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="loan in loans" :key="loan.id" class="items-center even:bg-gray-300">
                        <th class="p-2 text-center">{{ loan.id }}</th>
                        <td class="p-2 text-center">{{ loan.loan_start_date }}</td>
                        <td class="p-2 text-center">{{ loan.id_isbn }}</td>
                        <td class="p-2 text-center">{{ loan.user_id }}</td>
                        <td class="p-2 text-center">{{ loan.loan_end_date }}</td>
                        <td class="p-2 text-center">{{ loan.loan_due_date }}</td>
                        <td class="p-2 text-center">{{ loan.loan_status }}</td>
                        <td class="p-2 text-center">{{ loan.employee_id }}</td>
                        <td class="p-2 text-center">{{ loan.updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>
