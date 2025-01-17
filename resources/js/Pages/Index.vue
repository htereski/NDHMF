<script setup>
import Quiz from '@/Components/Quiz.vue'
import Layout from '@/Layouts/Layout.vue'
import Chat from '@/Components/Chat.vue'
import { ref } from 'vue'
import ScrollToTopButton from '@/Components/ScrollToTopButton.vue'
import WhatsApp from '@/Components/WhatsApp.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Information from '@/Components/Information.vue'

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
      class="w-full bg-primary min-h-[20vh] flex justify-center items-center"
    >
      <p class="text-black text-xl text-center p-10 leading-relaxed font-light">
        O NDH foi criado para responder às demandas sociais presentes em
        Paranaguá, com foco em temáticas como violência doméstica, gênero e
        direito à moradia.
      </p>
    </div>

    <div class="hero min-h-5/6 pb-20 bg-white" id="sobre">
      <div class="hero-overlay bg-white"></div>
      <div class="hero-content text-neutral-content text-center">
        <div class="max-w-6xl text-black">
          <h2 class="mb-10 mt-5 text-5xl font-light">Sobre</h2>

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

          <h2 class="pt-[50px] text-4xl font-light">Como Funciona?</h2>
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
              class="divider divider-horizontal mx-10 bg-black w-[5px] pb-10 hidden 2xl:block"
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
      class="w-full bg-accent min-h-[20vh] flex flex-col xl:flex-row justify-evenly items-start"
    >
      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center text-black">
          <h3 class="text-3xl text-center pb-5 font-light">Objetivo</h3>
          <p
            class="text-xl text-center flex-grow flex items-center justify-center leading-relaxed font-light"
          >
            O NDH orienta permanentemente pessoas e coletivos em situações de
            violação dos direitos humanos e oferece condições para orientação
            jurídica à população.
          </p>
        </div>
      </div>

      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center text-black">
          <h3 class="text-3xl text-center pb-5 font-light">Parcerias</h3>
          <p
            class="text-xl text-center flex-grow flex items-center justify-center leading-relaxed font-light"
          >
            Contamos com o apoio da Defensoria Pública da União, Defensoria do
            Estado do Paraná, e realizamos mutirões, palestras e oficinas com a
            comunidade.
          </p>
        </div>
      </div>

      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center text-black">
          <h3 class="text-3xl text-center pb-5 font-light">Funcionamento</h3>
          <p
            class="text-xl text-center flex-grow flex items-center justify-center leading-relaxed font-light"
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
      class="w-full min-h-screen bg-white flex flex-col items-center justify-center py-10"
    >
      <h3 class="text-5xl text-black text-center pb-10 font-light">Ações</h3>

      <ul
        class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical w-[calc(100%-10%)] lg:w-3/4"
      >
        <li>
          <div class="timeline-middle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="text-primary"
              class="h-5 w-5"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div
            class="timeline-start rounded-xl p-10 md:text-end text-black bg-primary flex flex-col gap-3 shadow-xl font-light"
          >
            <time class="font-mono text-2xl italic text-center"
              >Mutirões de Orientação Jurídica</time
            >
            <p class="indent-12 text-justify text-lg leading-relaxed">
              Realização de mutirões de atendimento para orientação jurídica em
              diversos bairros/comunidades da cidade. O atendimento é realizado,
              em data e horário pré-estabelecidos, pelos(as) defensores(as)
              populares, com o apoio da Defensoria Pública do Paraná e de duas
              professoras do IFPR, que são advogadas e atuam como apoiadoras.
            </p>
          </div>
          <hr class="bg-text" />
        </li>
        <li>
          <hr class="bg-text" />
          <div class="timeline-middle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="text-primary"
              class="h-5 w-5"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                clip-rule="evenodd"
              />
            </svg>
          </div>

          <div
            class="timeline-end rounded-xl p-10 md:text-end text-black bg-accent flex flex-col gap-3 shadow-xl font-light"
          >
            <time class="font-mono text-2xl italic text-center"
              >Palestras Educativas</time
            >
            <p class="indent-12 text-justify text-lg leading-relaxed">
              Realizadas em conjunto com os mutirões, proferidas por defensoras
              populares. Buscam criar espaços para partilhar experiências de
              superação por mulheres que sofreram ou sofrem situações de
              violência doméstica, além de compartilhar informações sobre seus
              direitos.
            </p>
          </div>
          <hr class="bg-text" />
        </li>
        <li>
          <hr class="bg-text" />
          <div class="timeline-middle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="text-primary"
              class="h-5 w-5"
            >
              <path
                fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div
            class="timeline-start rounded-xl p-10 md:text-end text-black bg-primary flex flex-col gap-3 shadow-xl font-light"
          >
            <time class="font-mono text-2xl italic text-center"
              >Mini-Cursos de Formação</time
            >
            <p class="indent-12 text-justify text-lg leading-relaxed">
              Realizados nas dependências do campus IFPR - Paranaguá-PR.
            </p>
          </div>
          <hr class="bg-text" />
        </li>
      </ul>
    </section>

    <section
      class="w-full flex flex-col items-center justify-center gap-10 pb-10 bg-white"
    >
      <SecondaryButton @click="showQuiz = !showQuiz">
        Violentômetro
      </SecondaryButton>
      <transition
        enter-active-class="transition-all duration-1000 ease-out"
        enter-from-class="opacity-0 transform -translate-y-5"
        enter-to-class="opacity-100 transform translate-y-0"
        leave-active-class="transition-all duration-500 ease-in"
        leave-from-class="opacity-100 transform translate-y-0"
        leave-to-class="opacity-0 transform -translate-y-5"
      >
        <Quiz v-if="showQuiz"></Quiz>
      </transition>
    </section>

    <Chat
      v-if="$page.props.auth.user && $page.props.auth.user.role == 'VITIMA'"
      :user="$page.props.auth.user"
      :chat="chat"
    />

    <template
      v-if="$page.props.auth.user && $page.props.auth.user.role == 'VITIMA'"
    >
      <WhatsApp />
    </template>

    <section class="py-10 bg-white">
      <h2 class="text-black text-5xl text-center pb-10 font-light">
        Onde Buscar Ajuda?
      </h2>

      <div
        class="grid sm:grid-cols-2 grid-cols-1 w-[75%] mx-auto gap-10 font-light"
      >
        <Information
          description="Se a violência causou danos à saúde, a mulher deve procurar a UPA ou
            o HRL - em casos de estupro também."
          :items="[
            {
              title: 'UPA',
              subtitle: 'Unidade de Pronto Atendimento',
              address:
                'Av. Roque Vernalha - Estradinha, Paranaguá - PR, 83206-250',
            },
            {
              title: 'HRL',
              subtitle: 'Hospital Regional do Litoral',
              address:
                'R. Pres. Getúlio Vargas, 222 - Palmital, Paranaguá - PR, 83206-020',
            },
          ]"
        />

        <Information
          description="Se ela está sofrendo violência naquele momento, deve acionar a
            Polícia Militar ou a Guarda Municipal."
          :items="[
            {
              title: 'PM',
              subtitle: 'Polícia Militar',
              address:
                'Rua Professor Cleto, 1740, Bairro Industrial, Paranaguá-PR, 83203-070',
            },
            {
              title: 'GCM',
              subtitle: 'Guarda Municipal',
              address:
                'Rua Tocantins, nº 206 - Bairro: Padre Jackson, Paranaguá, 83.221-450',
            },
          ]"
        />

        <Information
          description="Se estiver em risco de voltar para casa, pode solicitar acolhimento
            na CMP."
          :items="[
            {
              title: 'CMP',
              subtitle: 'Casa da Mulher Parnanguara',
              address:
                'Av. Ford, 342-426 - Emboguaçu, Paranaguá - PR, 83209-040',
            },
          ]"
        />

        <Information
          description="Caso ela sofra violência recorrente, ou seja, a violência que já
            ocorre a algum tempo e ela resolveu denunciar, deve procurar a
            delegacia de polícia."
          :items="[
            {
              title: 'Delegacia Policial de Paranaguá',
              address:
                'Rua Vieira dos Santos, 200 - Centro Histórico, Paranaguá - PR, 83203-050',
            },
            {
              title: 'Delegacia Cidadã de Paranaguá',
              address:
                'R. Domingos Peneda, 2850 - Vila Itiberê, Paranaguá - PR, 83209-235',
            },
          ]"
        />

        <Information
          description="Se ela estiver sofrendo violência mas não quiser registrar B.O.,
            pode procurar diretamente o CREAS."
          :items="[
            {
              title: 'CREAS',
              subtitle:
                'Centro de Referência Especializado em Assistência Social',
              address: 'Rua Vieira dos Santos - Paranaguá, PR, 83203-050',
            },
          ]"
        />

        <div
          class="bg-[#abe58283] rounded-lg flex flex-col justify-center items-center text-justify p-10 text-black shadow-xl"
        >
          <p class="pb-10 text-center text-lg">Canais de denúncia:</p>
          <ul class="w-full">
            <li>
              <strong class="font-semibold">180</strong> - Central de
              Atendimento à Mulher.
            </li>
            <li class="pt-2">
              <strong class="font-semibold">100</strong> - É um serviço gratuito
              de denúncias de violações de direitos humanos.
            </li>
          </ul>
        </div>
      </div>
    </section>

    <ScrollToTopButton />
  </Layout>
</template>
