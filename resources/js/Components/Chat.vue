<script setup>
import { nextTick, onMounted, ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  chat: Object,
  user: Object,
})

const chatMessages = ref([])
const inputMessage = ref('')

const messagesContainer = ref(null)

const form = useForm({
  content: '',
  chat_id: props.chat.id,
})

const scrollToBottom = () => {
  nextTick(() => {
    if (messagesContainer.value) {
      messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight
    }
  })
}

onMounted(() => {
  if (props.chat?.messages) {
    chatMessages.value = props.chat.messages
    scrollToBottom()
  }

  nextTick(() => {
    scrollToBottom()
  })

  Echo.private(`new-chat-message.${props.chat.id}`).listen(
    'NewChatMessage',
    e => {
      chatMessages.value.push(e.message)
      scrollToBottom()
    }
  )
})

watch(chatMessages, () => {
  scrollToBottom()
})

const sendMessage = () => {
  const content = inputMessage.value.trim()
  if (!content) return

  form.content = content

  form.post(route('send.message'), {
    preserveScroll: true,
    onSuccess: () => {
      inputMessage.value = ''
      scrollToBottom()
    },
  })
}

const isChatOpen = ref(false)

const toggleChat = () => {
  isChatOpen.value = !isChatOpen.value
  if (isChatOpen.value) {
    scrollToBottom()
  }
}
</script>

<template>
  <div
    class="fixed bottom-0 right-0 w-full md:w-1/3 lg:w-1/4 bg-white shadow-lg border border-gray-300 rounded-t-lg z-50"
  >
    <div
      class="bg-blue-500 text-white p-3 flex justify-between items-center cursor-pointer"
      @click="toggleChat"
    >
      <span>Chat</span>
      <span class="text-lg font-bold">{{ isChatOpen ? '−' : '+' }}</span>
    </div>

    <div
      v-if="isChatOpen"
      ref="messagesContainer"
      class="p-4 max-h-96 overflow-y-auto bg-gray-100 rounded-lg shadow-md"
    >
      <div v-for="message in chatMessages" :key="message.id" class="mb-4">
        <div v-if="message.user.id == user.id" class="flex justify-end">
          <div
            class="bg-green-100 text-green-900 p-3 rounded-lg shadow-md max-w-xs"
          >
            <strong>Você</strong>
            <p class="mt-1">{{ message.content }}</p>
          </div>
        </div>
        <div v-else class="flex justify-start">
          <div
            class="bg-slate-200 text-slate-800 p-3 rounded-lg shadow-md max-w-xs"
          >
            <strong>{{ message.user.name }}</strong>
            <p class="mt-1">{{ message.content }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="p-3 border-t border-gray-300" v-if="isChatOpen">
      <form @submit.prevent="sendMessage" class="flex gap-2">
        <input
          v-model="inputMessage"
          type="text"
          placeholder="Digite sua mensagem..."
          class="flex-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <button
          class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
        >
          Enviar
        </button>
      </form>
    </div>
  </div>
</template>
