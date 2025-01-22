<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    loans: Object,
})
</script>

<template>
    <AppLayout title="Préstamo">
        <template #header>
            <h1>Préstamo Libros</h1>
        </template>
        <div>
            <section class="bg-stone-500">
                <form action="">
                    <label for="">ISBN</label>
                    <input type="text">
                </form>
            </section>
            <aside>
                <div><button>Listado</button></div>
                <div></div>
            </aside>
        </div>
    </AppLayout>
</template>
