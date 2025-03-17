<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    users: Object,
});



</script>



<template>
    <AppLayout title="Listado Libros">
        <template #header>
            <div class="box-border flex justify-between">
                <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Listado Usuarios
                </h1>
            </div>

        </template>
        <section class="my-4 mx-8 overflow-scroll overflow-y-auto ">
            <table class="items-center w-full py-3 border-collapse border-neutral-800 bg-stone-50">
                <thead class="bg-emerald-600 py-3 px-4 border-collapse border border-neutral-800 text-blueGray-500">
                    <tr class="">
                        <th class="text-stone-100 py-2 px-2">ID</th>
                        <th class="text-stone-100 py-2 px-2">NOMBRE</th>
                        <th class="text-stone-100 py-2 px-2">EMAIL</th>
                        <th class="text-stone-100 py-2 px-2">¿EMPLEADO?</th>
                        <th class="text-stone-100 py-2 px-2">¿ADMIN?</th>
                        <th class="text-stone-100 py-2 px-2">¿ACTIVO?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="items-center even:bg-gray-200">
                        <td class="p-2 text-center">{{ user.id }}</td>
                        <td class="p-2">{{ user.name }}</td>
                        <td class="p-2">{{ user.email }}</td>
                        <td class="p-2 text-center">{{ user.is_employee === 1 ? 'SÍ' : 'NO' }}</td>
                        <td class="p-2 text-center">{{ user.is_admin === 1 ? 'SÍ' : 'NO' }}</td>
                        <td class="p-2 text-center">
                            <PrimaryButton :class="userActive(user.is_active)" @click.prevent="updateIsActive(user.id)">
                                {{ user.is_active === 1 ? 'SÍ' : 'NO' }}
                            </PrimaryButton>
                        </td>
                        <!-- <td class="p-2 text-center flex flex-row gap-1 justify-center items-center">
                            <a :href="route('editBook', book.id_isbn)">
                                <PrimaryButton class=" bg-orange-600  hover:bg-orange-400">
                                    <font-awesome-icon :icon="['fas', 'edit']" class="z-50 text-l  text-stone-50" />
                                </PrimaryButton>
                            </a>
                            <div v-if="$page.props.auth.user.is_admin === 1">
                                <PrimaryButton class="bg-red-500" @click.prevent="deleteBook(book.id_isbn)">
                                    <font-awesome-icon :icon="['fas', 'trash-alt']" class="z-50 text-l text-stone-50" />
                                </PrimaryButton>
                            </div>

                        </td> -->
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>

<script>
export default {
    data() {
        // return {
        //     items: [
        //         { is_active: 1 },
        //         { is_active: 0 }
        //     ]
        // };
    },
    methods: {
        userActive(is_active) {
            return is_active === 1 ? 'bg-green-600 hover:bg-green-400' : 'bg-red-600 hover:bg-red-400';
        },
        updateIsActive(id) {
            this.$inertia.patch(route('updateIsActive', id));
        },
    }
};

</script>
