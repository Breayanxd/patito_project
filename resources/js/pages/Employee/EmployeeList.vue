<script setup>
import BackButton from "@/Components/BackButton.vue";
import Toast from "@/Components/Toast.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { router, usePage } from "@inertiajs/vue3";
import { onMounted, ref, toRaw, watch } from "vue";

const page = usePage();

const props = defineProps({
    employees: {
        type: Array,
        default: () => [],
    },
});

const flashMessage = ref("");

onMounted(() => {
    if (page.props.flash?.success) {
        flashMessage.value = page.props.flash?.success;
    }
});

watch(
    () => page.props.flash?.success,
    (newVal) => {
        if (newVal) {
            flashMessage.value = flashMessage.value = page.props.flash?.success;
        }
    }
);
const selectedEmployees = ref([]);

const goForm = (id) => {
    router.visit(
        route("employee.form", {
            mode: "update",
            employee: id,
        })
    );
};

const deleteSelected = () => {
    if (
        !confirm(
            "¿Estás seguro de que deseas eliminar los empleados seleccionados?"
        )
    )
        return;

    router.post(
        route("employee.destroy"),
        {
            ids: selectedEmployees.value,
        },
        {
            onSuccess: () => {
                selectedEmployees.value = [];
            },
            preserveScroll: true,
        }
    );
};

const createEmployee = () => {
    router.visit(route("employee.form", { mode: "create" }));
};

const search = () =>{
    flashMessage.value = 'La barra de búsqueda no está implementada :(';    
}
</script>

<template>
    <AuthenticatedLayout>
        <BackButton path="/dashboard" />
        <div class="px-6 py-4">
            <div
                class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6"
            >
                <h1 class="text-2xl font-bold text-center">Empleados</h1>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <input
                        type="text"
                        placeholder="Buscar empleado..."
                        class="border border-gray-300 rounded px-4 py-2 w-full md:w-64"
                    />
                    <button class="bg-blue-500 text-white px-4 py-2 rounded" @click="search">
                        Buscar
                    </button>
                </div>

                <div
                    class="flex items-center justify-end gap-2 w-full md:w-auto"
                >
                    <button
                        class="bg-green-500 text-white px-4 py-2 rounded"
                        @click="createEmployee"
                    >
                        Crear
                    </button>
                    <button
                        class="bg-red-500 text-white px-4 py-2 rounded disabled:opacity-50"
                        :disabled="selectedEmployees.length === 0"
                        @click="deleteSelected"
                    >
                        Borrar
                    </button>
                </div>
            </div>

            <div class="h-[60vh] overflow-y-auto pr-2">
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
                            correo: {{ employee.email }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Sucursal:
                            {{ employee.branch?.name ?? "Sin sucursal" }}
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <Toast v-if="flashMessage" :message="flashMessage" :duration="3000" />
    </AuthenticatedLayout>
</template>
