<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';

const sucursales = ref([
  { id: 1, nombre: 'Sucursal A', direccion: 'Calle 1' },
  { id: 2, nombre: 'Sucursal B', direccion: 'Calle 2' },
])

const selectedSucursal = ref(null)

function selectSucursal(sucursal) {
  selectedSucursal.value = sucursal
}
</script>

<template>
  <div class="flex flex-col md:flex-row h-screen">
    
    <!-- Lista de sucursales -->
    <div class="md:w-1/2 w-full p-4 overflow-y-auto">
      <h2 class="text-xl font-bold mb-4">Sucursales</h2>
      <ul>
        <li 
          v-for="sucursal in sucursales" 
          :key="sucursal.id"
          @click="selectSucursal(sucursal)"
          class="p-3 rounded hover:bg-gray-100 cursor-pointer"
        >
          {{ sucursal.nombre }}
        </li>
      </ul>
    </div>

    <!-- Detalle de sucursal -->
    <div v-if="selectedSucursal" class="md:w-1/2 w-full p-4 border-l border-gray-200 hidden md:block">
      <h3 class="text-lg font-semibold">{{ selectedSucursal.nombre }}</h3>
      <p>{{ selectedSucursal.direccion }}</p>
      <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Editar</button>
      <button class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
    </div>
  </div>
</template>
