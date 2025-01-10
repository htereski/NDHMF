<script setup>
import ToastListItem from './ToastListItem.vue'
import toast from '@/Stores/toast'

function remove(index) {
  toast.remove(index)
}
</script>

<template>
  <TransitionGroup
    tag="div"
    enter-from-class="translate-x-full opacity-0"
    enter-active-class="duration-500"
    leave-active-class="duration-500"
    leave-to-class="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs"
  >
    <ToastListItem
      v-for="(item, index) in toast.items"
      :key="item.key"
      :message="item.message"
      :type="item.type"
      :duration="2000"
      @remove="remove(index)"
    />
  </TransitionGroup>
</template>
