<script setup>
defineProps({
  type: {
    type: String,
    default: 'button',
  },
})
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center px-4 py-2 bg-white border border-green-600 rounded-md font-semibold text-xs text-green-600 uppercase tracking-widest shadow-sm hover:bg-green-600 hover:text-white focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
  >
    <slot />
  </button>
</template>
