<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { computed, onMounted, ref, toRef, watch } from 'vue';

const branches = ref([]);
const selectedBranchId = ref(null)

//const page = usePage();
//const flashMessage = page.props.flash.success

const props = defineProps(['selectedEmployee']);

const employee = computed(() => {    
    return props.selectedEmployee
        ? {
            id: props.selectedEmployee.id,
            name: props.selectedEmployee.name,
            phone: props.selectedEmployee.phone,
            email: props.selectedEmployee.email,
            address_id: props.selectedEmployee.address_id,
            area_or_department: props.selectedEmployee.area_or_department,
            position: props.selectedEmployee.position,
            branch_id: props.selectedEmployee.branch_id,
            date_entry: props.selectedEmployee.date_entry,
            status: props.selectedEmployee.status,              
          }
        : null;
});

const employeeForm = useForm({
  id: employee.value?.id || '',
  name: employee.value?.name || '',
  phone: employee.value?.phone || '',
  email: employee.value?.email || '',
  address_id: employee.value?.address_id || '',
  area_or_department: employee.value?.area_or_department || '',
  position: employee.value?.position || '',
  branch_id: employee.value?.branch_id || '',
  date_entry: employee.value?.date_entry || '',
  status: employee.value?.status || '', 
})

const address = computed(() => {
    return props.selectedEmployee?.address || null;
});

const addressForm = useForm({
  id: address.value?.id || '',
  street: address.value?.street || '',
  number: address.value?.number || '',
  col: address.value?.col || '',
  cp: address.value?.cp || '',
  city: address.value?.city || '',
  state: address.value?.state || '',
  country: address.value?.country || '',
})

onMounted(async ()=>{
  try {
    const response = await axios.get('/branches/names');
    branches.value = response.data;
    selectedBranchId.value = employee.value.branch_id;
  } catch (error) {
    
  }
})

watch(employee, (newEmployee)=>{
  employeeForm.defaults({
    id: newEmployee?.id || '',
    name: newEmployee?.name || '',
    phone: newEmployee?.phone || '',
    email: newEmployee?.email || '',
    address_id: newEmployee?.address_id || '',
    area_or_department: newEmployee?.area_or_department || '',
    position: newEmployee?.position || '',
    branch_id: newEmployee?.branch_id || '',
    date_entry: newEmployee?.date_entry || '',
    status: newEmployee?.status || '', 
  })
  employeeForm.reset();
})

watch(address, (newAddress)=>{
  addressForm.defaults({
    id: newAddress?.id || '',
    street: newAddress?.street || '',
    number: newAddress?.number || '',
    col: newAddress?.col || '',
    cp: newAddress?.cp || '',
    city: newAddress?.city || '',
    state: newAddress?.state || '',
    country: newAddress?.country || '',
  })
  addressForm.reset();
})

const submit = async () => {
    try {
      await addressForm.put(route('address.update', addressForm.id),{
        onSuccess: async () =>{
          await employeeForm.put(route('employee.update',employeeForm.id));
        }
      });
    } catch (error) {
      console.log(error);
      
    }
}    
</script>

<template>   
    <form v-if="employee && address"  @submit.prevent="submit">      
      <div>
        <label for="">Nombre:</label>
        <input type="text" v-model="employeeForm.name"/>
      </div>
      <div>
        <label for="">Número de contacto:</label>
        <input type="text" v-model="employeeForm.phone"/>
      </div>
      <div>
        <label for="">Correo:</label>
        <input type="email" v-model="employeeForm.email"/>
      </div>
      <div>
        <label for="">Calle:</label>
        <input type="text" v-model="addressForm.street"/>
      </div>
      <div>
        <label for="">No:</label>
        <input type="text" v-model="addressForm.number"/>
      </div>
      <div>
        <label for="">Col:</label>
        <input type="text" v-model="addressForm.col"/>
      </div>
      <div>
        <label for="">CP:</label>
        <input type="text" v-model="addressForm.cp"/>
      </div>
      <div>
        <label for="">Ciudad:</label>
        <input type="text" v-model="addressForm.city"/>
      </div>
      <div>
        <label for="">Estado:</label>
        <input type="text" v-model="addressForm.state"/>
      </div>
      <div>
        <label for="">País:</label>
        <input type="text" v-model="addressForm.country"/>
      </div>
      <div>
        <label for="">Área o Departamento:</label>
        <input type="text" v-model="employeeForm.area_or_department"/>
      </div>
      <div>
        <label for="">Puesto:</label>
        <input type="text" v-model="employeeForm.position"/>
      </div>
      <select v-model="employeeForm.branch_id" class="border rounded px-2 py-1">
        <option 
          v-for="branch in branches" 
          :key="branch.id" 
          :value="branch.id">
          {{ branch.name }}
        </option>
</select>
      <div>
        <label for="">Fecha de ingreso:</label>
        <input type="text" v-model="employeeForm.date_entry"/>
      </div>
      <PrimaryButton>Actualizar</PrimaryButton>
    </form>
    <div v-else>
      <p>LOADING...</p>
    </div>
</template>