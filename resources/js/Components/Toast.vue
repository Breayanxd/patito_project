<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  message: String,
  duration: {
    type: Number,
    default: 3000
  }
});

const visible = ref(true);

onMounted(() => {
  setTimeout(() => {
    visible.value = false;
  }, props.duration);
});
</script>

<template>
  <transition name="fade">
    <div
      v-if="visible"
      class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-green-600 text-white px-4 py-2 rounded shadow-md z-50"
    >
      {{ message }}
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
