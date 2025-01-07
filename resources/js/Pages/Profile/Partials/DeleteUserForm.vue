<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import ActionSection from '@/Components/ActionSection.vue'
import DangerButton from '@/Components/DangerButton.vue'
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
  password: '',
})

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true

  setTimeout(() => passwordInput.value.focus(), 250)
}

const deleteUser = () => {
  form.delete(route('current-user.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  })
}

const closeModal = () => {
  confirmingUserDeletion.value = false

  form.reset()
}
</script>

<template>
  <ActionSection>
    <template #title> Deletar Conta </template>

    <template #description> Deleta permanentemente a sua conta. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Você tem certeza que quer deletar essa conta? Uma vez que sua conta é
        deletada, todos os dados serão permanentemente deletados. Por favor,
        entre com a sua senha para confirmar que você quer deletar
        permanentemente sua conta.
      </div>

      <div class="mt-5">
        <DangerButton @click="confirmUserDeletion">
          Deletar Conta
        </DangerButton>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <DialogModal :show="confirmingUserDeletion" @close="closeModal">
        <template #title> Deletar Conta </template>

        <template #content>
          Você tem certeza que quer deletar essa conta? Uma vez que sua conta é
          deletada, todos os dados serão permanentemente deletados. Por favor,
          entre com a sua senha para confirmar que você quer deletar
          permanentemente sua conta.

          <div class="mt-4">
            <TextInput
              ref="passwordInput"
              v-model="form.password"
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Senha"
              autocomplete="current-password"
              @keyup.enter="deleteUser"
            />

            <InputError :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

          <DangerButton
            class="ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
          >
            Deletar Conta
          </DangerButton>
        </template>
      </DialogModal>
    </template>
  </ActionSection>
</template>
