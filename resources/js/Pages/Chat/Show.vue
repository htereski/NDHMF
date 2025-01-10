<script setup>
import { onMounted, ref, watch, nextTick } from 'vue'
import Layout from '@/Layouts/Layout.vue'
import { useForm } from '@inertiajs/vue3'
import formatDate from '@/Utils/FormatDate.js'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import Pagination from '@/Components/Pagination.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import toast from '@/Stores/toast'

const props = defineProps({
  paginate: Object,
  chats: Array,
})

const openChatId = ref(null)
const currentChat = ref('')

const chatMessages = ref({})
const messageDiv = ref('')

const groupedMessages = ref({})
const messageModal = ref('')

const loading = ref(false)

const search_id = ref('')
const modalRef = ref(null)

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

      nextTick(() => {
        scrollToBottom()
        scrollToBottom('modal')
      })
    })
  })
})

const scrollToBottom = (option = 'default') => {
  nextTick(() => {
    let container = null

    if (option === 'default') {
      container = document.getElementById(`chat-${currentChat.value}`)
    } else {
      container = document.getElementById(`chat-modal-${currentChat.value}`)
    }

    if (container) {
      container.scrollTop = container.scrollHeight
    }
  })
}

const toggleChat = async chatId => {
  if (openChatId.value === chatId) {
    openChatId.value = null
    return
  }

  openChatId.value = chatId
  currentChat.value = chatId
  loading.value = true

  try {
    const response = await axios.get(route('chat.messages', chatId))
    chatMessages.value[chatId] = response.data.messages
    groupedMessages.value[chatId] = groupMessagesByDate(
      chatMessages.value[chatId]
    )
    nextTick(() => {
      scrollToBottom()
    })
  } catch (error) {
    addToast('Erro ao buscar mensagens', 'error')
  } finally {
    loading.value = false
  }
}

const openModal = () => {
  const modal = document.getElementById('my_modal_3')
  modal.showModal()
}

const closeModal = () => {
  const modal = document.getElementById('my_modal_3')
  modal.close()
}

const searchChat = async () => {
  if (search_id.value != '') {
    loading.value = true
    modalRef.value = true
    currentChat.value = search_id.value

    openModal()

    try {
      const response = await axios.get(route('chat.show', search_id.value))

      chatMessages.value[search_id.value] = response.data.messages

      groupedMessages.value[search_id.value] = groupMessagesByDate(
        chatMessages.value[search_id.value]
      )

      messageModal.value = ''

      nextTick(() => {
        scrollToBottom('modal')
      })
    } catch (error) {
      closeModal()
      addToast('Erro ao buscar chat', 'error')
    } finally {
      loading.value = false
    }
  }
}

const sendMessage = async (option = 'default') => {
  const content1 = messageDiv.value?.trim()
  const content2 = messageModal.value?.trim()

  if (!content1 && !content2) return

  content1 ? (form.content = content1) : (form.content = content2)

  try {
    await axios.post(route('send.message'), {
      chat_id: form.chat_id,
      content: form.content,
    })

    if (content1) {
      messageDiv.value = ''
    }
    if (content2) {
      messageModal.value = ''
    }

    if (!option == 'default') {
      nextTick(() => {
        scrollToBottom('modal')
      })
    }
  } catch (error) {
    addToast('Erro ao enviar mensagem', 'error')
  }
}

watch(currentChat, newChatId => {
  form.chat_id = newChatId
  form.content = chatMessages.value[newChatId] || ''
})

function addToast(message, type) {
  toast.add({ message: message, type: type })
}
</script>

<template>
  <Layout
    title="Chamados"
    :isAuthenticated="true"
    :user="$page.props.auth.user"
  >
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Chamados
      </h2>
    </template>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div
        v-if="chats && chats.length > 0"
        class="col-span-6 sm:col-span-4 mb-10"
      >
        <InputLabel for="id" value="ID" />
        <div class="flex gap-2">
          <TextInput
            id="id"
            v-model="search_id"
            type="number"
            class="mt-1 block w-full"
            required
            @keyup.enter="searchChat"
          />
          <InputError :message="form.errors.id" class="mt-2" />
          <PrimaryButton @click="searchChat"> Buscar </PrimaryButton>
        </div>
      </div>

      <div v-if="chats && chats.length === 0" class="text-center text-gray-500">
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
            v-if="openChatId === chat.id"
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
                  <div
                    v-if="item.user.id == $page.props.auth.user.id"
                    class="flex justify-end"
                  >
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
            v-if="openChatId === chat.id"
            @submit.prevent="sendMessage"
            class="flex gap-2 mt-4"
          >
            <input
              v-model="messageDiv"
              type="text"
              placeholder="Digite sua mensagem..."
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <SecondaryButton type="submit">Enviar</SecondaryButton>
          </form>
        </div>
      </div>
    </div>

    <dialog ref="modalRef" id="my_modal_3" class="modal">
      <div class="modal-box min-h-96 bg-slate-50 flex flex-col">
        <button
          class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
          @click="closeModal"
        >
          ✕
        </button>

        <div
          :id="'chat-modal-' + search_id"
          class="mt-4 overflow-y-auto max-h-96 flex-1"
        >
          <div v-if="loading" class="flex justify-center items-center grow">
            <div
              class="w-8 h-8 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"
            ></div>
          </div>

          <div
            v-else
            v-for="(item, index) in groupedMessages[search_id] || []"
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
              <div
                v-if="item.user.id == $page.props.auth.user.id"
                class="flex justify-end"
              >
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

        <div v-if="!loading" class="mt-4 flex-shrink-0">
          <form @submit.prevent="sendMessage" class="flex gap-2">
            <input
              v-model="messageModal"
              type="text"
              placeholder="Digite sua mensagem..."
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <SecondaryButton type="submit">Enviar</SecondaryButton>
          </form>
        </div>
      </div>
    </dialog>

    <Pagination :pagination="paginate"> </Pagination>
  </Layout>
</template>
