<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Quiz from '@/Components/Quiz.vue'
import Layout from '@/Layouts/Layout.vue'
import Chat from '@/Components/Chat.vue'
import { ref } from 'vue'
import ScrollToTopButton from '@/Components/ScrollToTopButton.vue'

defineProps({
  chat: Object,
})

const showQuiz = ref(false)
</script>

<template>
  <Layout
    title="Núcleo de Direitos Humanos Marielle Franco"
    :isAuthenticated="$page.props.auth.user"
    :user="$page.props.auth.user"
  >
    <div class="hero bg-white min-h-[70vh]">
      <div class="hero-content text-center">
        <div class="max-w-md">
          <h1 class="text-5xl font-bold text-black">
            Núcleo de Direitos Humanos Marielle Franco
          </h1>
          <p class="py-6 text-lg text-black">
            Por direitos iguais, Marielle vive em nós!
          </p>
        </div>
      </div>
    </div>

    <div
      class="w-full bg-green-400 min-h-[20vh] flex justify-center items-center"
    >
      <p class="text-white text-xl text-center p-10 leading-relaxed">
        O NDH foi criado para responder às demandas sociais presentes em
        Paranaguá, com foco em temáticas como violência doméstica, gênero e
        direito à moradia.
      </p>
    </div>

    <div class="hero min-h-5/6 pb-20 bg-white" id="sobre">
      <div class="hero-overlay bg-white"></div>
      <div class="hero-content text-neutral-content text-center">
        <div class="max-w-6xl text-black">
          <h2 class="mb-10 mt-5 text-5xl font-semibold">Sobre</h2>

          <p
            class="m-5 text-justify indent-12 text-xl font-light leading-relaxed"
          >
            A criação do Núcleo Marielle Franco remonta ao curso de Defensores
            Populares, iniciado em 2017. Após a formação, as participantes
            buscaram apoio institucional, solicitando ao Instituto Federal
            suporte para atuarem em suas comunidades.
          </p>

          <p
            class="m-5 text-justify indent-12 text-xl font-light leading-relaxed"
          >
            Em 2018, o núcleo foi formalizado, e, naquele ano, o assassinato de
            Marielle Franco ainda repercutia fortemente. Seu nome já simbolizava
            a luta por justiça, o que motivou a escolha de seu nome para o
            núcleo, em homenagem a seu legado de defesa dos direitos das
            mulheres, da população LGBTQIA+, negra e periférica.
          </p>

          <p
            class="m-5 text-justify indent-12 text-xl font-light leading-relaxed"
          >
            Composto por defensoras populares de 2017 e 2018, o núcleo deu
            início a mutirões nas comunidades de Paranaguá, em parceria com a
            Defensoria Pública e o CRAS. Essa ação foi o marco da presença do
            núcleo nas periferias, consolidando sua atuação.
          </p>

          <p
            class="m-5 text-justify indent-12 text-xl font-light leading-relaxed"
          >
            A necessidade de dar continuidade aos atendimentos realizados nos
            mutirões levou à organização de acolhimentos e orientações no
            Instituto Federal. Contudo, no final de 2018, a Defensoria Pública
            deixou Paranaguá, e os mutirões passaram a ocorrer de forma
            independente.
          </p>

          <p
            class="m-5 text-justify indent-12 text-xl font-light leading-relaxed"
          >
            Em 2019, com a chegada da professora Valéria, surgiu a ideia de
            expandir o trabalho para as escolas, por meio de ações educativas.
            Com a pandemia, no entanto, as atividades presenciais foram
            interrompidas, e o núcleo direcionou seus esforços para formações
            online.
          </p>

          <p
            class="m-5 text-justify indent-12 text-xl font-light leading-relaxed"
          >
            Desde 2020, a professora Valéria Borges Ribeiro coordena o núcleo, e
            o professor Roberto Martins de Souza como vice-coordenador. Seguem
            com o compromisso de fortalecer as ações comunitárias e educativas,
            mantendo vivo o legado de resistência e apoio às comunidades.
          </p>

          <h2 class="pt-[50px] text-4xl font-semibold">Como funciona?</h2>
          <div class="flex flex-col 2xl:flex-row w-full pt-10 h-max">
            <div class="card grid flex-grow place-items-center h-max">
              <p
                class="text-justify indent-12 text-xl font-light mx-5 leading-relaxed"
              >
                Suas atividades são levadas às comunidades em resposta a uma
                demanda local, caracterizada pelo recebimento de uma
                carta/ofício pleiteando essas ações. Geralmente, esse pedido é
                enviado por meio da representação de uma associação de
                moradores.
              </p>
            </div>

            <div
              class="divider divider-horizontal mx-10 bg-gray-400 w-[1px] pb-10 hidden 2xl:block"
            ></div>

            <div
              class="card grid flex-grow place-items-center h-max pt-10 2xl:pt-0"
            >
              <p
                class="text-justify indent-12 text-xl font-light mx-5 leading-relaxed"
              >
                A realização de mutirões de atendimento e palestras em
                diferentes bairros e comunidades empoderou a classe do
                município, possibilitando inclusão social. Os grupos atendidos
                foram formados principalmente por mulheres com baixa
                escolaridade e em situação de vulnerabilidade social.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="w-full bg-black min-h-[20vh] flex flex-col xl:flex-row justify-evenly items-start"
    >
      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center">
          <h3 class="text-white text-3xl text-center pb-5">Objetivo</h3>
          <p
            class="text-white text-xl text-center flex-grow flex items-center justify-center leading-relaxed"
          >
            O NDH orienta permanentemente pessoas e coletivos em situações de
            violação dos direitos humanos e oferece condições para orientação
            jurídica à população.
          </p>
        </div>
      </div>

      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center">
          <h3 class="text-white text-3xl text-center pb-5">Parcerias</h3>
          <p
            class="text-white text-xl text-center flex-grow flex items-center justify-center leading-relaxed"
          >
            Contamos com o apoio da Defensoria Pública da União, Defensoria do
            Estado do Paraná, e realizamos mutirões, palestras e oficinas com a
            comunidade.
          </p>
        </div>
      </div>

      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center">
          <h3 class="text-white text-3xl text-center pb-5">Funcionamento</h3>
          <p
            class="text-white text-xl text-center flex-grow flex items-center justify-center leading-relaxed"
          >
            Respondemos às demandas das comunidades de Paranaguá, muitas vezes
            por meio de solicitações de associações de moradores, levando apoio
            jurídico e social às regiões mais necessitadas.
          </p>
        </div>
      </div>
    </div>

    <section
      id="acoes"
      class="w-full min-h-screen bg-gradient-to-b from-green-400 to-green-500 flex flex-col items-center justify-center py-10"
    >
      <h3 class="text-5xl text-white font-semibold text-center pb-10">Ações</h3>

      <ul
        class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical w-[calc(100%-10%)] lg:w-3/4"
      >
        <li>
          <div class="timeline-middle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="white"
              class="h-5 w-5"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div class="timeline-start mb-10 md:text-end text-white">
            <time class="font-mono text-2xl font-black italic"
              >Mutirões de Orientação Jurídica</time
            >
            <div></div>
            <p class="indent-12 text-justify text-lg leading-relaxed">
              Realização de mutirões de atendimento para orientação jurídica em
              diversos bairros/comunidades da cidade. O atendimento é realizado,
              em data e horário pré-estabelecidos, pelos(as) defensores(as)
              populares, com o apoio da Defensoria Pública do Paraná e de duas
              professoras do IFPR, que são advogadas e atuam como apoiadoras.
            </p>
          </div>
          <hr />
        </li>
        <li>
          <hr />
          <div class="timeline-middle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="white"
              class="h-5 w-5"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div class="timeline-end mb-10 text-white">
            <time class="font-mono text-2xl font-black italic"
              >Palestras Educativas</time
            >
            <div></div>
            <p class="indent-12 text-justify text-lg leading-relaxed">
              Realizadas em conjunto com os mutirões, proferidas por defensoras
              populares. Buscam criar espaços para partilhar experiências de
              superação por mulheres que sofreram ou sofrem situações de
              violência doméstica, além de compartilhar informações sobre seus
              direitos.
            </p>
          </div>
          <hr />
        </li>
        <li>
          <hr />
          <div class="timeline-middle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="white"
              class="h-5 w-5"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div class="timeline-start mb-10 md:text-end text-white">
            <time class="font-mono text-2xl font-black italic"
              >Mini-Cursos de formação</time
            >
            <div></div>
            <p class="indent-12 text-justify text-lg leading-relaxed">
              Realizados nas dependências do campus IFPR - Paranaguá-PR.
            </p>
          </div>
          <hr />
        </li>
      </ul>
    </section>

    <section
      class="w-full flex flex-col items-center justify-center gap-10 py-10"
    >
      <PrimaryButton @click="showQuiz = !showQuiz">
        Fazer teste de violentômetro
      </PrimaryButton>
      <Quiz v-if="showQuiz"></Quiz>
    </section>

    <Chat
      v-if="$page.props.auth.user && $page.props.auth.user.role == 'VITIMA'"
      :user="$page.props.auth.user"
      :chat="chat"
    />

    <ScrollToTopButton />
  </Layout>
</template>
