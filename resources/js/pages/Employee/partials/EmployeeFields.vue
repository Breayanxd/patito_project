<script setup>
const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
    branches: {
        type: Array,
        required: true,
    },
});
</script>
<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-6">
        <div>
            <label class="block font-semibold mb-1">Nombre</label>
            <input
                required
                v-model="form.name"
                type="text"
                class="w-full border rounded px-3 py-2"
            />
        </div>

        <div>
            <label class="block font-semibold mb-1">Teléfono</label>
            <input
                maxlength="20"
                required
                v-model="form.phone"
                type="text"
                class="w-full border rounded px-3 py-2"
            />
        </div>

        <div>
            <label class="block font-semibold mb-1">Correo electrónico</label>
            <input
                required
                v-model="form.email"
                type="email"
                class="w-full border rounded px-3 py-2"
            />
        </div>

        <div>
            <label class="block font-semibold mb-1">Área o Departamento</label>
            <input
                required
                v-model="form.area_or_department"
                type="text"
                class="w-full border rounded px-3 py-2"
            />
        </div>

        <div>
            <label class="block font-semibold mb-1">Puesto</label>
            <input
                required
                v-model="form.position"
                type="text"
                class="w-full border rounded px-3 py-2"
            />
        </div>

        <div>
            <label class="block font-semibold mb-1">Sucursal</label>
            <select
                required
                v-model="form.branch_id"
                class="w-full border rounded px-3 py-2"
            >
                <option value="" disabled>Seleccione una sucursal</option>
                <option
                    v-for="branch in branches"
                    :key="branch.id"
                    :value="branch.id"
                >
                    {{ branch.name }}
                </option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Fecha de ingreso</label>
            <input
                required
                v-model="form.date_entry"
                type="date"
                class="w-full border rounded px-3 py-2"
            />
        </div>

        <div>
            <label class="block font-semibold mb-1">Estado</label>
            <select
                v-model="form.status"
                class="w-full border rounded px-3 py-2"
            >
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
            </select>
        </div>
    </div>
</template>
