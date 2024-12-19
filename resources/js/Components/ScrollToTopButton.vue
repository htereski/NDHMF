<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'

const showScrollButton = ref(false)

const scrollToTop = () => window.scrollTo({ top: 0, behavior: 'smooth' })
const handleScroll = () => (showScrollButton.value = window.scrollY > 100)

onMounted(() => window.addEventListener('scroll', handleScroll))
onBeforeUnmount(() => window.removeEventListener('scroll', handleScroll))
</script>

<template>
  <span
    v-if="showScrollButton"
    @click="scrollToTop"
    class="fixed bottom-[70px] right-[30px] cursor-pointer p-[10px] bg-black rounded-full text-white shadow-lg"
  >
    <svg
      class="w-6 h-6 text-white"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      fill="none"
      viewBox="0 0 24 24"
    >
      <path
        stroke="white"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M12 6v13m0-13 4 4m-4-4-4 4"
      />
    </svg>
  </span>
</template>
