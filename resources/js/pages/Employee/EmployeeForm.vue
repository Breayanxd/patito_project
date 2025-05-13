<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { computed, onMounted, ref, toRaw } from "vue";

const branches = ref([]);

const props = defineProps({
  mode: {
    type: String,
    default: "create",
  },
  selectedEmployee: {
    type: Object,
    default: null,
  },
});

const form = useForm({
  id: props.selectedEmployee?.id || '',
  name: props.selectedEmployee?.name || '',
  phone: props.selectedEmployee?.phone || '',
  email: props.selectedEmployee?.email || '',
  address_id: props.selectedEmployee?.address_id || '',
  area_or_department: props.selectedEmployee?.area_or_department || '',
  position: props.selectedEmployee?.position || '',
  branch_id: props.selectedEmployee?.branch_id || '',
  date_entry: props.selectedEmployee?.date_entry || '',
  status: props.selectedEmployee?.status || 'active',

  address: {
    id: props.selectedEmployee?.address?.id || '',
    street: props.selectedEmployee?.address?.street || '',
    number: props.selectedEmployee?.address?.number || '',
    col: props.selectedEmployee?.address?.col || '',
    cp: props.selectedEmployee?.address?.cp || '',
    city: props.selectedEmployee?.address?.city || '',
    state: props.selectedEmployee?.address?.state || '',
    country: props.selectedEmployee?.address?.country || '',
  }
});
const submit =  () => {
    if(props.mode === 'create'){
        form.post(route('employee.store'));                
    }else{
        form.put(route('employee.update',form.id));   
    }
};

onMounted(async () => {
  try {
    const response = await axios.get('/branches/names');
    branches.value = response.data;
  } catch (error) {
    console.error("Error al cargar sucursales:", error);
  }
});
</script>


<template>
    <AuthenticatedLayout>
    <form class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow space-y-4" @submit.prevent="submit">
        <!-- Nombre -->
        <div>
            <label for="name" class="block font-medium text-gray-700"
                >Nombre:</label
            >
            <input
                v-model="form.name"
                type="text"
                id="name"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Teléfono -->
        <div>
            <label for="phone" class="block font-medium text-gray-700"
                >Teléfono:</label
            >
            <input
                v-model="form.phone"
                type="text"
                id="phone"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Correo -->
        <div>
            <label for="email" class="block font-medium text-gray-700"
                >Correo electrónico:</label
            >
            <input
                v-model="form.email"
                type="email"
                id="email"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Calle -->
        <div>
            <label for="street" class="block font-medium text-gray-700"
                >Calle:</label
            >
            <input
                v-model="form.address.street"
                type="text"
                id="street"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Número -->
        <div>
            <label for="number" class="block font-medium text-gray-700"
                >Número:</label
            >
            <input
                v-model="form.address.number"
                type="text"
                id="number"
                maxlength="10"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Colonia -->
        <div>
            <label for="col" class="block font-medium text-gray-700"
                >Colonia:</label
            >
            <input
                v-model="form.address.col"
                type="text"
                id="col"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- CP -->
        <div>
            <label for="cp" class="block font-medium text-gray-700"
                >Código Postal:</label
            >
            <input
                v-model="form.address.cp"
                type="text"
                id="cp"
                maxlength="10"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Ciudad -->
        <div>
            <label for="city" class="block font-medium text-gray-700"
                >Ciudad:</label
            >
            <input
                v-model="form.address.city"
                type="text"
                id="city"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Estado -->
        <div>
            <label for="state" class="block font-medium text-gray-700"
                >Estado:</label
            >
            <input
                v-model="form.address.state"
                type="text"
                id="state"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- País -->
        <div>
            <label for="country" class="block font-medium text-gray-700"
                >País:</label
            >
            <input
                v-model="form.address.country"
                type="text"
                id="country"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Área o Departamento -->
        <div>
            <label
                for="area_or_department"
                class="block font-medium text-gray-700"
                >Área o Departamento:</label
            >
            <input
                v-model="form.area_or_department"
                type="text"
                id="area_or_department"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Puesto -->
        <div>
            <label for="position" class="block font-medium text-gray-700"
                >Puesto:</label
            >
            <input
                v-model="form.position"
                type="text"
                id="position"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Sucursal -->
        <div>
            <label for="branch_id" class="block font-medium text-gray-700"
                >Sucursal:</label
            >
            <select
                v-model="form.branch_id"
                id="branch_id"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            >
                <option disabled selected value="">
                    Selecciona una sucursal
                </option>
                <option
                    v-for="branch in branches"
                    :key="branch.id"
                    :value="branch.id"
                >
                    {{ branch.name }}
                </option>
            </select>
        </div>

        <!-- Fecha de ingreso -->
        <div>
            <label for="date_entry" class="block font-medium text-gray-700"
                >Fecha de Ingreso:</label
            >
            <input
                v-model="form.date_entry"
                type="date"
                id="date_entry"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
        </div>

        <!-- Estado -->
        <div>
            <label for="status" class="block font-medium text-gray-700"
                >Estado:</label
            >
            <select
                v-model="form.status"
                id="status"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            >
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
            </select>
        </div>

        <!-- Botón -->
        <div class="pt-4">
            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition"
            >
                {{ props.mode === 'create' ? 'Guardar':'Actualizar' }}
            </button>
        </div>
    </form>
    </AuthenticatedLayout>
</template>
