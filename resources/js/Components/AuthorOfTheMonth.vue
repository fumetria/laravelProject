<script setup>
import PrimaryButton from './PrimaryButton.vue';

defineProps({
    author: Object
})

</script>

<template>
    <div class="bg-stone-300">
        <h2 class="capitalize">Autor del mes</h2>
        <section>
            <aside>
                <img src="" alt="">
            </aside>
            <div>
                <h2 class="uppercase">{{ author.name }}</h2>
                <h2>Biografía</h2>
            </div>
        </section>
        <section>
            <h3>Bibliografía</h3>
        </section>
        <section>
            <p>Encuentra sus libros en nuestro catálogo en el siguiente enlace</p>
            <PrimaryButton>
                
            </PrimaryButton>
        </section>
    </div>
</template>