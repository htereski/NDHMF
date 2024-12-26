<script setup>
import { nextTick, onMounted, ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import formatDate from '@/Utils/FormatDate.js'

const props = defineProps({
  chat: Object,
  user: Object,
})

const chatMessages = ref([])
const groupedMessages = ref([])
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

const groupMessagesByDate = messages => {
  const grouped = []
  let lastDate = null

  messages.forEach(message => {
    const messageDate = formatDate(message.send_at, 'day')
    if (messageDate !== lastDate) {
      grouped.push({ type: 'date', date: messageDate })
      lastDate = messageDate
    }
    grouped.push({ type: 'message', ...message })
  })

  groupedMessages.value = grouped
}

onMounted(() => {
  if (props.chat?.messages) {
    chatMessages.value = props.chat.messages
    groupMessagesByDate(chatMessages.value)
    scrollToBottom()
  }

  nextTick(() => {
    scrollToBottom()
  })

  Echo.private(`new-chat-message.${props.chat.id}`).listen(
    'NewChatMessage',
    e => {
      chatMessages.value.push(e.message)
      groupMessagesByDate(chatMessages.value)
      scrollToBottom()
    }
  )
})

watch(chatMessages, () => {
  groupMessagesByDate(chatMessages.value)
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
      <div v-for="(item, index) in groupedMessages" :key="index" class="mb-4">
        <div v-if="item.type === 'date'" class="text-center text-gray-500 my-2">
          {{ item.date }}
        </div>
        <div v-else>
          <div v-if="item.user.id == user.id" class="flex justify-end">
            <div
              class="bg-green-100 text-green-900 p-3 rounded-lg shadow-md max-w-xs"
            >
              <p class="mt-1">{{ item.content }}</p>
              <p class="mt-1 prose-sm text-right">
                {{ formatDate(item.send_at, 'hour') }}
              </p>
            </div>
          </div>
          <div v-else class="flex justify-start">
            <div
              class="bg-slate-200 text-slate-800 p-3 rounded-lg shadow-md max-w-xs"
            >
              <strong>{{ item.user.name }}</strong>
              <p class="mt-1">{{ item.content }}</p>
              <p class="mt-1 prose-sm text-right">
                {{ formatDate(item.send_at, 'hour') }}
              </p>
            </div>
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
