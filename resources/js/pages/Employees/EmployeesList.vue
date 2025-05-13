<script setup>


defineProps({
    employees:{
        type: Array,
        default: () => []
    }
})

</script>

<template>    
    <div>
    <div
      v-for="emp in employees"
      :key="emp.id"
      @click="$emit('select', emp.id)"
      class="cursor-pointer hover:bg-gray-100 p-2"
    >
      {{ emp.name }}
    </div>
  </div>  
</template>