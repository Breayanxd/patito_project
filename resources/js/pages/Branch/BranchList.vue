<script setup>
import BackButton from "@/Components/BackButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { onMounted, ref, watch } from "vue";
import { router, usePage } from '@inertiajs/vue3'
import Toast from "@/Components/Toast.vue";

const page = usePage();

const props = defineProps({
    branches: {
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

const selectedBranches = ref([]);

watch(
    () => page.props.flash?.success,
    (newVal) => {
        if (newVal) {
            flashMessage.value = flashMessage.value = page.props.flash?.success;
        }
    }
);
const deleteSelected = () =>{
    
    if (!confirm('¿Estás seguro de que deseas eliminar los empleados seleccionados?')) return;

    router.post(route('branch.destroy'), {
        ids: selectedBranches.value,
    }, {
        onSuccess: () => {
            selectedBranches.value = [];
        },
        preserveScroll: true,
    });    
}
const createBranch = () => {
    router.visit(route("branch.form", {
        mode: "create",
        branch: null,
    }));
};

const goForm = (id) => {
    router.visit(route("branch.form", {
        mode: "update",
        branch: id,
    }));
};

const search = () =>{
    flashMessage.value = 'La barra de búsqueda no está implementada :(';    
}
</script>

<template>
    <AuthenticatedLayout>
        <BackButton path="dashboard" />
        <div class="px-6 py-4">
            <div
                class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6"
            >
                
                    <h1 class="text-2xl font-bold text-center">Sucursales</h1>
                

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <input
                        type="text"
                        placeholder="Buscar sucursal..."
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
                        @click="createBranch"
                    >
                        Crear
                    </button>
                    <button
                        class="bg-red-500 text-white px-4 py-2 rounded disabled:opacity-50"
                        :disabled="selectedBranches.length === 0"
                        @click="deleteSelected"
                    >
                        Borrar
                    </button>
                </div>
            </div>
            <div class="h-[60vh] overflow-y-auto pr-2">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div
                    v-for="branch in branches"
                    :key="branch.id"
                    class="border rounded-lg p-4 shadow flex items-start gap-4 cursor-pointer hover:bg-gray-50"
                    @click="goForm(branch.id)"
                >
                    <input
                        type="checkbox"
                        @click.stop
                        v-model="selectedBranches"
                        :value="branch.id"
                        class="mt-1"
                    />
                    <div>
                        <p class="font-bold">{{ branch.name }}</p>
                        <p class="text-sm text-gray-600 font-semibold">
                            {{ branch.type == 'parent' ? 'Matriz':'Sucursal' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Encargado: {{ branch.manager }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Estatus: {{ branch.status }}
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <Toast
            v-if="flashMessage"
            :message="flashMessage"
            :duration="3000"
        />
    </AuthenticatedLayout>
</template>
