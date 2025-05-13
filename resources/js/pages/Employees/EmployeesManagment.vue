<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EmployeesList from './EmployeesList.vue';
import EmployeesForm from './EmployeesForm.vue';
import { ref, watch } from 'vue';
import axios from 'axios';
const props = defineProps({
    employees:{
        type: Array,
        default: () => []
    }
})

const selectedEmployee = ref(null);

const handleSelect = async (id) =>{
    try {
        const response = await axios.get(`/employees/${id}`);
        selectedEmployee.value = response.data;                    
    } catch (error) {
        
    }
}

watch(() => props.employees, (newEmployees) => {
    if (newEmployees.length > 0) {
        handleSelect(newEmployees[0].id);        
    }
}, { immediate: true });

</script>

<template>
    <AuthenticatedLayout>
        <div class="py-6">
            <div>
                <h1>Empleados</h1>
                 <p v-if="$page.props.flash?.success" class="text-green-600">
                    {{ $page.props.flash.success }}
                </p>
            </div>
            <div class="flex justify-around">
                <div>
                    <EmployeesList :employees="employees" @select="handleSelect"/>
                </div>                
                <div>
                    <EmployeesForm :selectedEmployee="selectedEmployee"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>