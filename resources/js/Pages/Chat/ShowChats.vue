<script setup>
import { onMounted, ref, watch } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  chats: Array,
  user: Object
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
  <AppLayout title="Chamados" :loggedIn="true" :user="user">
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
              #{{ chat.id }}
            </h2>
          </div>

          <div v-if="openChatIds.includes(chat.id)" class="mt-4">
            <div v-for="message in (chatMessages[chat.id] || [])" :key="message.id" class="mb-4">
              <div v-if="message.user.id == user.id" class="flex justify-end">
                <div class="bg-green-100 text-green-900 p-3 rounded-lg shadow-md max-w-xs">
                  <strong>Você</strong>
                  <p class="mt-1">{{ message.content }}</p>
                </div>
              </div>
              <div v-else class="flex justify-start">
                <div class="bg-slate-200 text-slate-800 p-3 rounded-lg shadow-md max-w-xs">
                  <strong>{{ message.user.name }}</strong>
                  <p class="mt-1">{{ message.content }}</p>
                </div>
              </div>
            </div>

            <form @submit.prevent="sendMessage" class="flex gap-2">
              <input v-model="inputMessages[chat.id]" type="text" placeholder="Digite sua mensagem..."
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
              <button class="bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 transition">
                Enviar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>