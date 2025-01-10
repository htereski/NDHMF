<script setup>
import { onMounted } from 'vue'

const props = defineProps({
  message: String,
  type: String,
  duration: {
    type: Number,
    default: 2000,
  },
})

onMounted(() => {
  setTimeout(() => {
    emit('remove')
  }, props.duration)
})

const emit = defineEmits(['remove'])
</script>

<template>
  <div
    :class="[
      'flex items-center p-4 text-gray-500 rounded-lg shadow',
      type === 'success' && 'bg-[#57B553]',
      type === 'error' && 'bg-[#E6232B]',
      type === 'info' && 'bg-[#4293D4]',
      type === 'warning' && 'bg-[#FF9A0A]',
    ]"
    role="alert"
  >
    <div
      :class="[
        'inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-white rounded-lg',
        type === 'success' && 'bg-[#57B553]',
        type === 'error' && 'bg-[#E6232B]',
        type === 'info' && 'bg-[#4293D4]',
        type === 'warning' && 'bg-[#FF9A0A]',
      ]"
    >
      <svg
        class="w-5 h-5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        viewBox="0 0 20 20"
      >
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
        />
      </svg>
    </div>
    <div class="ms-3 text-sm font-normal text-white">{{ props.message }}</div>
    <button
      @click="emit('remove')"
      type="button"
      class="ms-auto -mx-1.5 -my-1.5 text-white rounded-lg p-1.5"
    >
      <span class="sr-only">Close</span>
      <svg
        class="w-3 h-3"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 14 14"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
        />
      </svg>
    </button>
  </div>
</template>
