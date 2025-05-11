<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const modules = [{
    id: 0,
    name: "Empleados",
    description: "Administra tus empleados",
},
{
    id: 1,
    name: "Sucursales",
    description: "Administra tus sucursales",
}]

const goToModule = (nameModule) =>{
    console.log(nameModule);
    
    router.visit(`/${nameModule}`)
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>        
        <div class="p-6">
            <h1 class="text-2xl font-semibold mb-4">Módulos</h1>
            
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <div 
                    v-for="module in modules" 
                    :key="module.id"
                    class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition cursor-pointer"
                    @click="goToModule(module.name)"
                >
                    <h2 class="text-lg font-bold text-gray-800">{{ module.name }}</h2>
                    <p class="text-sm text-gray-500 mt-2">{{ module.description }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
