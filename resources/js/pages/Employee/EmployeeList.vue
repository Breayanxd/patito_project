<script setup>
import Toast from "@/Components/Toast.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { router, usePage } from '@inertiajs/vue3'
import { onMounted, ref, toRaw, watch } from "vue";

const page = usePage();

const props = defineProps({
    employees: {
        type: Array,
        default: () => [],
    },
});

const flashMessage = ref('');

onMounted(()=>{
    if(page.props.flash?.success){
        flashMessage.value = page.props.flash?.success;
    }
})

const selectedEmployees = ref([]);

const goForm = (id) => {
    router.visit(route("employee.form", {
        mode: "update",
        employee: id,
    }));
};

const deleteSelected = () =>{
    if (!confirm('¿Estás seguro de que deseas eliminar los empleados seleccionados?')) return;

    router.post(route('employee.destroy'), {
        ids: selectedEmployees.value,
    }, {
        onSuccess: () => {
            selectedEmployees.value = [];
        },
        preserveScroll: true,
    });    
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <h1 class="text-2xl font-bold">Empleados</h1>
                </div>
                <button
                    @click="deleteSelected"
                    class="bg-red-500 text-white px-4 py-2 rounded disabled:opacity-50"
                    :disabled="selectedEmployees.length === 0"
                >
                    Borrar
                </button>
            </div>

            <!-- Search bar -->
            <div class="flex justify-center mb-6 gap-2">
                <input
                    type="text"
                    placeholder="Buscar empleado..."
                    class="border border-gray-300 rounded px-4 py-2 w-1/3"
                />
                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Buscar
                </button>
            </div>

            <!-- Tarjetas de empleados -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div
                    v-for="employee in employees"
                    :key="employee.id"
                    class="border rounded-lg p-4 shadow flex items-start gap-4 cursor-pointer hover:bg-gray-50"
                    @click="goForm(employee.id)"
                >
                    <input
                        type="checkbox"
                        @click.stop
                        v-model="selectedEmployees"
                        :value="employee.id"
                        class="mt-1"
                    />
                    <div>
                        <p class="font-semibold">{{ employee.name }}</p>
                        <p class="text-sm text-gray-600">
                            {{ employee.position }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Ingreso: {{ employee.date_entry }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Sucursal: {{ employee.branch?.name ?? 'Sin sucursal' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <Toast
            v-if="flashMessage"
            :message="flashMessage"
            :duration="3000"
        />
        <Link :href="route('employee.form', { mode: 'create' })">
            <button
                class="fixed bottom-20 right-20 bg-green-500 hover:bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center text-2xl shadow-lg"
            >
                +
            </button>
        </Link>
    </AuthenticatedLayout>
</template>
