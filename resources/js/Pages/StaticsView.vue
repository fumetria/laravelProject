<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    numBooks: Object,
    users: Object,
    authors: Object,
    loans: Object,
});



</script>



<template>
    <AppLayout title="Listado Libros">
        <template #header>
            <div class="box-border flex justify-between content-center items-center">
                <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                    Listado Libros
                </h1>
                <a :href="route('newBook')">
                    <PrimaryButton>
                        <font-awesome-icon :icon="['fas', 'plus']" class="z-50 text-xl text-stone-50" />
                    </PrimaryButton>
                </a>
            </div>

        </template>
        <section class="bg-stone-900 my-4 mx-5 ">
            <table class="items-center w-full py-3 border-collapse border-neutral-800 bg-stone-50">
                <thead class="bg-cyan-200 py-3 px-4 border-collapse border border-neutral-800 text-blueGray-500">
                    <tr>
                        <th></th>
                        <th>USUARIOS</th>
                        <th>PRESTAMOS</th>
                        <th>LIBROS</th>
                        <th>AUTORES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>CANTIDAD</th>
                        <td class="text-center">{{ users }}</td>
                        <td class="text-center">{{ loans }}</td>
                        <td class="text-center">{{ numBooks }}</td>
                        <td class="text-center">{{ authors }}</td>


                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { status: 'Disponible' },
        { status: 'Prestado' }
      ]
    };
  },
  methods: {
    estado(status) {
      return {
        'text-green-500': status === 'Disponible',
        'text-red-500': status === 'Prestado'
      };
    }
  }
};
</script>
