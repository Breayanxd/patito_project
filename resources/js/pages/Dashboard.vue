<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const modules = [{
    id: 0,
    name: "Empleados",
    description: "Administra tus empleados",
    path: '/employees',
},
{
    id: 1,
    name: "Sucursales",
    description: "Administra tus sucursales",
    path: '/branches',
}]

const goToModule = (pathModule) =>{        
    router.visit(pathModule)
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>        
        <div class="p-6">
            <h1 class="text-2xl font-semibold mb-4">Módulos</h1>
            
            <div class="flex flex-wrap justify-center gap-6">
                <div 
                    v-for="module in modules" 
                    :key="module.id"
                    class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition cursor-pointer"
                    @click="goToModule(module.path)"
                >
                    <h2 class="text-lg font-bold text-gray-800">{{ module.name }}</h2>
                    <p class="text-sm text-gray-500 mt-2">{{ module.description }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
