<script setup>
const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
    errors:{
        type: Object,
        default: ()=> [],
    }
});
</script>

<template>    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
        <!-- Nombre -->
        <div>
            <label class="block font-semibold mb-1">Nombre</label>
            <input
                type="text"
                v-model="form.name"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Tipo -->
        <div>
            <label class="block font-semibold mb-1">Tipo</label>
            <select
                v-model="form.type"
                class="w-full border border-gray-300 rounded px-3 py-2"
            >
                <option value="branch">Sucursal</option>
                <option value="parent">Matriz</option>
            </select>
        </div>

        <!-- Teléfono -->
        <div>
            <label class="block font-semibold mb-1">Teléfono</label>
            <input
                type="text"
                v-model="form.phone"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Email -->
        <div>
            <label class="block font-semibold mb-1">Correo electrónico</label>
            <input
                type="email"
                v-model="form.email"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Encargado -->
        <div>
            <label class="block font-semibold mb-1">Encargado</label>
            <input
                type="text"
                v-model="form.manager"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Estado -->
        <div>
            <label class="block font-semibold mb-1">Estado</label>
            <select
                v-model="form.status"
                class="w-full border border-gray-300 rounded px-3 py-2"
            >
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
            </select>
        </div>
    </div>
</template>
