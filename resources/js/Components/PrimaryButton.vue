<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit',
  },
})
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-700 active:bg-green-900 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"
  >
    <slot />
  </button>
</template>
