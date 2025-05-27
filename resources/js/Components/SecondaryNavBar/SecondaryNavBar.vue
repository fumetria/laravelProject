<script setup>
import SecondaryNavLink from '@/Components/SecondaryNavBar/SecondaryNavLink.vue';


</script>

<template>
    <nav>
        <div class="w-full flex items-center justify-center gap-4 pb-1 bg-cyan-700 text-white">
            <SecondaryNavLink :href="route('welcome')" :active="route().current('welcome')">
                Inicio
            </SecondaryNavLink>
            <SecondaryNavLink :href="route('catalog')" :active="route().current('catalog')">
                Cátalogo
            </SecondaryNavLink>
            <!-- <SecondaryNavLink :href="route()" :active="route().current()">
                Eventos
            </SecondaryNavLink> -->
        </div>
    </nav>
</template>