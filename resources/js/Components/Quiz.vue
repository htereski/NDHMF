<script setup>
import { ref, computed, watch } from 'vue'
import PrimaryButton from './PrimaryButton.vue'

const questionsGroup1 = ref([
  'Piadas ofensivas',
  'Chantagear',
  'Mentir / Enganar',
  'Ignorar / Dar um gelo',
  'Ciumar',
  'Culpar',
  'Desqualificar',
  'Ridicularizar / Ofender',
  'Humilhar em público',
  'Intimidar / Ameaçar',
])

const questionsGroup2 = ref([
  'Controlar / Proibir',
  'Destruir bens pessoais',
  'Machucar',
  'Tapinhas / Pancadinhas',
  'Brincar de bater',
  'Beliscar / Arranhar',
  'Empurrar',
  'Dar tapas',
])

const questionsGroup3 = ref([
  'Chutar',
  'Confinar / Prender',
  'Ameaçar com objetos',
  'Ameaçar com armas',
  'Ameaçar de morte',
  'Forçar uma relação sexual',
  'Abuso sexual',
  'Violentar',
  'Mutilar',
])

const answers = ref([
  'Tome cuidado a violência tende a aumentar',
  'Reaja! Não se destrua',
  'Peça ajuda a um profissional',
])

const selectedQuestions = ref([])
const showAnswer = ref(false)
const result = ref('')

const combinedQuestions = computed(() => {
  return [
    ...questionsGroup1.value,
    ...questionsGroup2.value,
    ...questionsGroup3.value,
  ]
})

watch(selectedQuestions, question => {
  if (question.length === 0) {
    result.value = ''
    showAnswer.value = false
  }
})

function giveAnswer() {
  showAnswer.value = true
  result.value = ''

  if (selectedQuestions.value.length === 0) {
    result.value = 'Nenhuma opção selecionada.'
    return
  }

  if (selectedQuestions.value.some(q => questionsGroup3.value.includes(q))) {
    result.value = answers.value[2]
  } else if (
    selectedQuestions.value.some(q => questionsGroup2.value.includes(q))
  ) {
    result.value = answers.value[1]
  } else if (
    selectedQuestions.value.some(q => questionsGroup1.value.includes(q))
  ) {
    result.value = answers.value[0]
  }
}
</script>

<template>
  <div class="flex flex-col w-full p-6 bg-[#abe58283] gap-10">
    <h1 class="text-2xl font-light text-center mb-4 text-black">
      Questionário de Agressão
    </h1>
    <div
      class="flex flex-col md:flex-row justify-center items-center w-full flex-wrap gap-5"
    >
      <template v-for="(question, index) in combinedQuestions" :key="index">
        <div
          class="flex w-full md:w-fit items-center p-4 gap-2 bg-white rounded-lg shadow-md transition-transform transform hover:scale-105 text-black font-light"
        >
          <label class="flex-1 text-lg">{{ question }}</label>
          <input
            type="checkbox"
            class="cursor-pointer h-6 w-6 text-orange-600 border-gray-300 rounded focus:ring-orange-500"
            :value="question"
            v-model="selectedQuestions"
          />
        </div>
      </template>
    </div>
    <PrimaryButton
      class="my-10 w-fit mx-auto"
      @click="giveAnswer"
      v-if="selectedQuestions.length > 0"
    >
      Mostrar resultado
    </PrimaryButton>
    <p
      class="text-lg text-black font-light p-10 text-center bg-white shadow-md w-fit mx-auto rounded-lg"
      v-if="showAnswer && selectedQuestions.length > 0"
    >
      {{ result }}
    </p>
  </div>
</template>
