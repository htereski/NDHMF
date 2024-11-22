<script setup>
import { onMounted, ref, watch } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  chats: Array,
});

const openChatIds = ref([]);
const currentChat = ref('');

const chatMessages = ref({});
const inputMessages = ref({});

const form = useForm({
  content: '',
  chat_id: ''
});

onMounted(() => {
  props.chats.forEach(chat => {
    if (chat.messages) {
      chatMessages.value[chat.id] = chat.messages;
    } else {
      chatMessages.value[chat.id] = [];
    }

    Echo.private(`new-chat-message.${chat.id}`)
      .listen('NewChatMessage', (e) => {
        if (!chatMessages.value[chat.id]) {
          chatMessages.value[chat.id] = [];
        }
        chatMessages.value[chat.id].push(e.message);
      });
  });
});

const toggleChat = (chatId) => {
  currentChat.value = chatId;

  if (openChatIds.value.includes(chatId)) {
    openChatIds.value = [];
  } else {
    openChatIds.value = [chatId];
  }
};

const sendMessage = () => {
  const content = inputMessages.value[currentChat.value]?.trim();
  if (!content) return;

  form.content = content;

  form.post(route('send.message'), {
    preserveScroll: true,
    onSuccess: () => {
      inputMessages.value[currentChat.value] = '';
    }
  });
};

watch(currentChat, (newChatId) => {
  form.chat_id = newChatId;
  form.content = chatMessages.value[newChatId] || '';
});
</script>

<template>
  <AppLayout title="Chamados" :user="true">
    <div class="p-6 bg-gray-100 min-h-screen">
      <h1 class="text-2xl font-bold text-gray-700 mb-6">Meus Chamados</h1>

      <div v-if="chats.length === 0" class="text-center text-gray-500">
        <p>Nenhum chat encontrado.</p>
      </div>

      <div v-else class="grid gap-4">
        <div v-for="chat in chats" :key="chat.id"
          class="p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
          <div @click="toggleChat(chat.id)" class="cursor-pointer">
            <h2 class="text-lg font-semibold text-gray-800">
              {{ chat.subject }}
            </h2>
            <p class="text-sm text-gray-600">
              Status:
              <span :class="chat.status === 'ATIVO' ? 'text-green-500' : 'text-red-500'">
                {{ chat.status === 'ATIVO' ? 'Ativo' : 'Fechado' }}
              </span>
            </p>
          </div>

          <div v-if="openChatIds.includes(chat.id)" class="mt-4">
            <div v-for="message in (chatMessages[chat.id] || [])" :key="message.id"
              class="mb-2 p-2 bg-gray-50 rounded-lg border border-gray-200">
              <p class="text-sm text-gray-800">
                <strong>{{ message.user.name }}:</strong> {{ message.content }}
              </p>
            </div>

            <form @submit.prevent="sendMessage">
              <div v-if="chat.status === 'ATIVO'" class="mt-4">
                <input v-model="inputMessages[chat.id]" type="text" placeholder="Digite sua mensagem..."
                  class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
