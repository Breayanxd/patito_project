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
    <Link :href="path" class="pt-10 pl-10 "><- Volver</Link>
    
</template>