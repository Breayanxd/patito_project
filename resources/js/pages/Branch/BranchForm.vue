<script setup>
import BackButton from "@/Components/BackButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import BranchFields from "./partials/BranchFields.vue";
import AddressFields from "../Address/partials/AddressFields.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { toRaw, watch } from "vue";

const props = defineProps({
    mode: {
        type: String,
        default: "create",
    },
    selectedBranch: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    id: props.selectedBranch?.id || "",
    name: props.selectedBranch?.name || "",
    type: props.selectedBranch?.type || "branch",
    phone: props.selectedBranch?.phone || "",
    email: props.selectedBranch?.email || "",
    manager: props.selectedBranch?.manager || "",
    address_id: props.selectedBranch?.address_id || "",
    status: props.selectedBranch?.status || "active",

    address: {
        id: props.selectedBranch?.address?.id || "",
        street: props.selectedBranch?.address?.street || "",
        number: props.selectedBranch?.address?.number || "",
        col: props.selectedBranch?.address?.col || "",
        cp: props.selectedBranch?.address?.cp || "",
        city: props.selectedBranch?.address?.city || "",
        state: props.selectedBranch?.address?.state || "",
        country: props.selectedBranch?.address?.country || "",
    },
});

const submit = () => {
    if (props.mode === "create") {
        form.post(route("branch.store"));
    } else {
        form.put(route("branch.update", form.id));
    }
};

</script>

<template>
    <AuthenticatedLayout>
        <BackButton path="/branches " />
        <div class="text-center">
            <h1 class="text-3xl bold italic text-gray-800">
                {{
                    mode === "create"
                    ? "Registro de Nuevo Establecimiento"
                    : "Editar Establecimiento"
                }}
            </h1>
        </div>
        <form @submit.prevent="submit">
            <BranchFields :form="form" :errors="form.errors"/>
            <AddressFields :form="form.address" :errors="form.errors"/>
            <div class="flex justify-center mb-5">
                <PrimaryButton>{{
                    mode === "create" ? "Añadir registro" : "Confirmar Edición"
                }}</PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
