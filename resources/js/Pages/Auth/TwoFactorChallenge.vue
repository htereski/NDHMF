<script setup>
import { nextTick, ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticationCard from '@/Components/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const recovery = ref(false)

const form = useForm({
  code: '',
  recovery_code: '',
})

const recoveryCodeInput = ref(null)
const codeInput = ref(null)

const toggleRecovery = async () => {
  recovery.value ^= true

  await nextTick()

  if (recovery.value) {
    recoveryCodeInput.value.focus()
    form.code = ''
  } else {
    codeInput.value.focus()
    form.recovery_code = ''
  }
}

const submit = () => {
  form.post(route('two-factor.login'))
}
</script>

<template>
  <Head title="Two-factor Confirmação" />

  <AuthenticationCard>
    <template #logo>
      <AuthenticationCardLogo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      <template v-if="!recovery">
        Por favor, confirme o acesso à sua conta digitando o código da
        autenticação provido pelo seu aplicativo autenticador.
      </template>

      <template v-else>
        Por favor, confirme o acesso à sua conta digitando um de seus códigos de
        emergência.
      </template>
    </div>

    <form @submit.prevent="submit">
      <div v-if="!recovery">
        <InputLabel for="code" value="Código" />
        <TextInput
          id="code"
          ref="codeInput"
          v-model="form.code"
          type="text"
          inputmode="numeric"
          class="mt-1 block w-full"
          autofocus
          autocomplete="one-time-code"
        />
        <InputError class="mt-2" :message="form.errors.code" />
      </div>

      <div v-else>
        <InputLabel for="recovery_code" value="Código Recuperado" />
        <TextInput
          id="recovery_code"
          ref="recoveryCodeInput"
          v-model="form.recovery_code"
          type="text"
          class="mt-1 block w-full"
          autocomplete="one-time-code"
        />
        <InputError class="mt-2" :message="form.errors.recovery_code" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <button
          type="button"
          class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
          @click.prevent="toggleRecovery"
        >
          <template v-if="!recovery"> Use o código recuperado </template>

          <template v-else> Use um código de autenticação </template>
        </button>

        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Entrar
        </PrimaryButton>
      </div>
    </form>
  </AuthenticationCard>
</template>
