<script setup>
import { onMounted, ref, watch, nextTick } from 'vue'
import Layout from '@/Layouts/Layout.vue'
import { useForm } from '@inertiajs/vue3'
import formatDate from '@/Utils/FormatDate.js'

const props = defineProps({
  chats: Array,
  user: Object,
})

const openChatIds = ref([])
const currentChat = ref('')
const chatMessages = ref({})
const groupedMessages = ref({})
const inputMessages = ref({})
const loading = ref(false)

const form = useForm({
  content: '',
  chat_id: '',
})

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

  return grouped
}

onMounted(() => {
  props.chats.forEach(chat => {
    Echo.private(`new-chat-message.${chat.id}`).listen('NewChatMessage', e => {
      chatMessages.value[chat.id].push(e.message)
      groupedMessages.value[chat.id] = groupMessagesByDate(
        chatMessages.value[chat.id]
      )

      const chatIndex = props.chats.findIndex(c => c.id === chat.id)
      if (chatIndex !== -1) {
        let role = e.message.user.role

        if (role !== 'VITIMA') {
          props.chats[chatIndex].unanswered = false
        } else {
          props.chats[chatIndex].unanswered = true
        }
      }
      
      scrollToBottom()
    })
  })
})

const scrollToBottom = () => {
  nextTick(() => {
    const container = document.getElementById(`chat-${currentChat.value}`)
    if (container) {
      container.scrollTop = container.scrollHeight
    }
  })
}

const toggleChat = async chatId => {
  currentChat.value = chatId

  if (openChatIds.value.includes(chatId)) {
    openChatIds.value = []
  } else {
    openChatIds.value = [chatId]
  }

  loading.value = true

  try {
    const response = await axios.get(`/chats/messages/${chatId}`)
    chatMessages.value[chatId] = response.data.messages
    groupedMessages.value[chatId] = groupMessagesByDate(
      chatMessages.value[chatId]
    )
    nextTick(() => {
      scrollToBottom()
    })
  } catch (error) {
    console.error('Erro ao buscar mensagens:', error)
  } finally {
    loading.value = false
  }
}

const sendMessage = () => {
  const content = inputMessages.value[currentChat.value]?.trim()
  if (!content) return

  form.content = content

  form.post(route('send.message'), {
    preserveScroll: true,
    onSuccess: () => {
      inputMessages.value[currentChat.value] = ''
    },
  })
}

watch(currentChat, newChatId => {
  form.chat_id = newChatId
  form.content = chatMessages.value[newChatId] || ''
})
</script>

<template>
  <Layout title="Chamados" :isAuthenticated="true" :user="user">
    <div class="p-6 bg-gray-100 min-h-screen">
      <h1 class="text-2xl font-bold text-gray-700 mb-6">Meus Chamados</h1>

      <div v-if="chats.length === 0" class="text-center text-gray-500">
        <p>Nenhum chat encontrado.</p>
      </div>

      <div v-else class="grid gap-4">
        <div
          v-for="chat in chats"
          :key="chat.id"
          class="p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow"
        >
          <div @click="toggleChat(chat.id)" class="cursor-pointer">
            <div class="flex items-center gap-2">
              <h2 class="text-lg font-semibold text-gray-800">
                #{{ chat.id }}
              </h2>
              <span
                v-if="chat.unanswered"
                class="bg-blue-500 w-2 h-2 rounded-full"
              ></span>
            </div>
          </div>

          <div
            v-if="openChatIds.includes(chat.id)"
            class="mt-4 overflow-y-auto max-h-96"
            :id="'chat-' + chat.id"
          >
            <div v-if="loading" class="flex justify-center items-center">
              <div
                class="w-8 h-8 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"
              ></div>
            </div>

            <div v-else>
              <div
                v-for="(item, index) in groupedMessages[chat.id] || []"
                :key="index"
                class="mb-4"
              >
                <div
                  v-if="item.type === 'date'"
                  class="text-center text-gray-500 my-2"
                >
                  {{ item.date }}
                </div>
                <div v-else>
                  <div v-if="item.user.id == user.id" class="flex justify-end">
                    <div
                      class="bg-green-100 text-green-900 p-3 rounded-lg shadow-md max-w-xs"
                    >
                      <p class="mt-1 text-end">{{ item.content }}</p>
                      <p class="mt-1 prose-sm text-right">
                        {{ formatDate(item.send_at, 'hour') }}
                      </p>
                    </div>
                  </div>

                  <div v-else class="flex justify-start">
                    <div
                      class="bg-slate-200 text-slate-800 p-3 rounded-lg shadow-md max-w-xs"
                    >
                      <span class="flex gap-2">
                        <strong>{{ item.user.name }}</strong>
                        <img
                          v-if="item.user.role != 'VITIMA'"
                          class="rounded-full w-7"
                          :src="'/assets/img/logo.ico'"
                          alt="icone marielle"
                        />
                      </span>
                      <p class="mt-1">{{ item.content }}</p>
                      <p class="mt-1 prose-sm text-right">
                        {{ formatDate(item.send_at, 'hour') }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <form
            v-if="openChatIds.includes(chat.id)"
            @submit.prevent="sendMessage"
            class="flex gap-2 mt-4"
          >
            <input
              v-model="inputMessages[chat.id]"
              type="text"
              placeholder="Digite sua mensagem..."
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button
              class="bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 transition"
            >
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>
  </Layout>
</template>
