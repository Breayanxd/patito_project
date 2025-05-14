<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    path:{
        type: String,
        default: () => '/dashboard'
    }
});
</script>

<template>
    <div class="pl-10 pt-5"><Link :href="path" class="text-lg font-extrabold text-blue-800 hover:text-blue-400"><- <span class="underline">Volver</span></Link></div>
</template>