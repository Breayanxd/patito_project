<script setup>
import BackButton from "@/Components/BackButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { computed, onMounted, ref, toRaw } from "vue";
import EmployeeFields from "./partials/EmployeeFields.vue";
import AddressFields from "../Address/partials/AddressFields.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
    id: props.selectedEmployee?.id || "",
    name: props.selectedEmployee?.name || "",
    phone: props.selectedEmployee?.phone || "",
    email: props.selectedEmployee?.email || "",
    address_id: props.selectedEmployee?.address_id || "",
    area_or_department: props.selectedEmployee?.area_or_department || "",
    position: props.selectedEmployee?.position || "",
    branch_id: props.selectedEmployee?.branch_id || "",
    date_entry: props.selectedEmployee?.date_entry || "",
    status: props.selectedEmployee?.status || "active",

    address: {
        id: props.selectedEmployee?.address?.id || "",
        street: props.selectedEmployee?.address?.street || "",
        number: props.selectedEmployee?.address?.number || "",
        col: props.selectedEmployee?.address?.col || "",
        cp: props.selectedEmployee?.address?.cp || "",
        city: props.selectedEmployee?.address?.city || "",
        state: props.selectedEmployee?.address?.state || "",
        country: props.selectedEmployee?.address?.country || "",
    },
});
const submit = () => {
    if (props.mode === "create") {
        form.post(route("employee.store"));
    } else {
        form.put(route("employee.update", form.id));
    }
};

onMounted(async () => {
    try {
        const response = await axios.get("/branches/names");
        branches.value = response.data;
    } catch (error) {
        console.error("Error al cargar sucursales:", error);
    }
});
</script>

<template>
    <AuthenticatedLayout>
        <BackButton path="/employees" />
        <div class="text-center">
            <h1 class="text-3xl bold italic text-gray-800">
                {{
                    mode === "create"
                        ? "Registro de Nuevo Empleado"
                        : "Editar Empleado"
                }}
            </h1>
        </div>
        <form @submit.prevent="submit">
            <EmployeeFields :form="form" :branches="branches" />
            <AddressFields :form="form.address" :errors="form.errors" />
            <div class="flex justify-center mb-5">
                <PrimaryButton>{{
                    mode === "create" ? "Añadir registro" : "Confirmar Edición"
                }}</PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
