<script setup>
import Layout from '@/Layouts/Layout.vue'
import Pagination from '@/Components/Pagination.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Pencil from 'vue-material-design-icons/Pencil.vue'
import Delete from 'vue-material-design-icons/Delete.vue'
import AccountPlus from 'vue-material-design-icons/AccountPlus.vue'
import toast from '@/Stores/toast'
import { Link } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue'

const props = defineProps({
  users: Array,
})

const userToDelete = ref(0)

async function deleteUser() {
  try {
    await axios.delete(route('admin.destroy', userToDelete.value))

    const userIndex = props.users.users.data.findIndex(
      user => user.id === userToDelete.value
    )

    if (userIndex !== -1) {
      props.users.users.data.splice(userIndex, 1)
    }

    closeModal(userToDelete.value)

    addToast('Usuário excluído com sucesso.', 'success')
  } catch (error) {
    addToast('Erro ao excluir o usuário.', 'error')
  }
}

function openModal(id) {
  const modal = document.getElementById('my_modal_' + id)
  modal.showModal()
  userToDelete.value = id
}

function closeModal(id) {
  const modal = document.getElementById('my_modal_' + id)
  modal.close()
}

function addToast(message, type) {
  toast.add({ message: message, type: type })
}
</script>

<template>
  <Layout
    title="Postagens"
    :isAuthenticated="$page.props.auth.user"
    :user="$page.props.auth.user"
  >
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Colaboradores do projeto
      </h2>
    </template>

    <div class="container flex flex-col mx-auto items-center mt-8 mb-10">
      <div
        class="w-full relative overflow-x-auto sm:rounded-lg flex justify-end mb-8"
      >
        <Link :href="route('admin.create')" class="border rounded-md">
          <SecondaryButton><AccountPlus /></SecondaryButton
        ></Link>
      </div>
      <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black">
          <thead class="text-xs text-black uppercase bg-white">
            <tr>
              <th scope="col" class="px-6 py-3">Nome</th>
              <th scope="col" class="px-6 py-3">Papel</th>
              <th scope="col" class="px-6 py-3"></th>
              <th scope="col" class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.users.data"
              :key="user.id"
              class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-100"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-black whitespace-nowrap"
              >
                {{ user.name }}
              </th>
              <td class="px-6 py-4">{{ user.role }}</td>
              <td class="px-6 py-4">
                <Link :href="`${route('admin.edit', user.id)}`">
                  <Pencil class="text-blue-600 hover:text-blue-800" />
                </Link>
              </td>
              <td class="px-6 py-4">
                <Delete
                  class="text-red-600 hover:text-red-800 hover:cursor-pointer"
                  @click="openModal(user.id)"
                />
              </td>

              <dialog :id="'my_modal_' + user.id" class="modal">
                <div class="modal-box min-h-96 bg-slate-50 flex flex-col">
                  <form method="dialog">
                    <button
                      class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                    >
                      ✕
                    </button>
                  </form>
                  <div
                    class="flex flex-col grow items-center justify-center text-justify"
                  >
                    <p class="text-black text-xl">
                      Deseja mesmo excluir {{ user.name }}?
                    </p>
                    <div class="flex gap-4 mt-8">
                      <SecondaryButton @click="deleteUser">Sim</SecondaryButton>
                      <form method="dialog">
                        <PrimaryButton type="submit">Não</PrimaryButton>
                      </form>
                    </div>
                  </div>
                </div>
              </dialog>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <Pagination :pagination="users.users"> </Pagination>
  </Layout>
</template>
