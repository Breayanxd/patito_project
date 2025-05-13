<script setup>
const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
    errors:{
        type: Object,
    }
});
</script>

<template>    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
        <!-- Calle -->
        <div class="md:col-span-2">
            <label class="block font-semibold mb-1">Calle</label>
            <input
                type="text"
                v-model="form.street"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Número -->
        <div>
            <label class="block font-semibold mb-1">Número</label>
            <input
                type="text"
                v-model="form.number"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Colonia -->
        <div class="md:col-span-2">
            <label class="block font-semibold mb-1">Colonia</label>
            <input
                type="text"
                v-model="form.col"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Código Postal -->
        <div>
            <label class="block font-semibold mb-1">C.P.</label>
            <input
                type="text"
                v-model="form.cp"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Ciudad -->
        <div>
            <label class="block font-semibold mb-1">Ciudad</label>
            <input
                type="text"
                v-model="form.city"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- Estado -->
        <div>
            <label class="block font-semibold mb-1">Estado</label>
            <input
                type="text"
                v-model="form.state"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>

        <!-- País -->
        <div>
            <label class="block font-semibold mb-1">País</label>
            <input
                type="text"
                v-model="form.country"
                class="w-full border border-gray-300 rounded px-3 py-2"
            />
        </div>
    </div>
</template>
