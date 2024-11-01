<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onMounted, onBeforeUnmount } from "vue";

defineProps({
  user: Boolean,
});

const showScrollButton = ref(false);

const scrollToTop = () => window.scrollTo({ top: 0, behavior: "smooth" });

const handleScroll = () => (showScrollButton.value = window.scrollY > 100);

onMounted(() => window.addEventListener("scroll", handleScroll));
onBeforeUnmount(() => window.removeEventListener("scroll", handleScroll));
</script>

<template>
  <AppLayout title="Núcleo de Direitos Humanos Marielle Franco" :user="user">
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
      <p class="text-white text-xl text-center p-10">
        O NDH foi criado para responder às demandas sociais presentes em
        Paranaguá, com foco em temáticas como violência doméstica, gênero e
        direito à moradia.
      </p>
    </div>

    <div class="hero min-h-5/6 pb-20 bg-white" id="sobre">
      <div class="hero-overlay bg-white"></div>
      <div class="hero-content text-neutral-content text-center">
        <div class="max-w-6xl text-black">
          <h2 class="mb-10 text-5xl font-semibold">Sobre</h2>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            A criação do Núcleo Marielle Franco remonta ao curso de Defensores
            Populares, iniciado em 2017. Após a formação, as participantes
            buscaram apoio institucional, solicitando ao Instituto Federal
            suporte para atuarem em suas comunidades.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Em 2018, o núcleo foi formalizado, e, naquele ano, o assassinato de
            Marielle Franco ainda repercutia fortemente. Seu nome já simbolizava
            a luta por justiça, o que motivou a escolha de seu nome para o
            núcleo, em homenagem a seu legado de defesa dos direitos das
            mulheres, da população LGBTQIA+, negra e periférica.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Composto por defensoras populares de 2017 e 2018, o núcleo deu
            início a mutirões nas comunidades de Paranaguá, em parceria com a
            Defensoria Pública e o CRAS. Essa ação foi o marco da presença do
            núcleo nas periferias, consolidando sua atuação.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            A necessidade de dar continuidade aos atendimentos realizados nos
            mutirões levou à organização de acolhimentos e orientações no
            Instituto Federal. Contudo, no final de 2018, a Defensoria Pública
            deixou Paranaguá, e os mutirões passaram a ocorrer de forma
            independente.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Em 2019, com a chegada da professora Valéria, surgiu a ideia de
            expandir o trabalho para as escolas, por meio de ações educativas.
            Com a pandemia, no entanto, as atividades presenciais foram
            interrompidas, e o núcleo direcionou seus esforços para formações
            online.
          </p>

          <p class="m-5 text-justify indent-12 text-xl font-light">
            Desde 2020, a professora Valéria Borges Ribeiro coordena o núcleo, e
            o professor Roberto Martins de Souza como vice-coordenador. Seguem
            com o compromisso de fortalecer as ações comunitárias e educativas,
            mantendo vivo o legado de resistência e apoio às comunidades.
          </p>

          <h2 class="pt-[50px] text-4xl font-semibold">Como funciona?</h2>
          <div class="flex flex-col 2xl:flex-row w-full pt-10 h-max">
            <div class="card grid flex-grow place-items-center h-max">
              <p class="text-justify indent-12 text-xl font-light mx-5">
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
              <p class="text-justify indent-12 text-xl font-light mx-5">
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
      class="w-full bg-red-900 min-h-[20vh] flex flex-col xl:flex-row justify-evenly items-start"
    >
      <div class="flex flex-col text-black w-full xl:min-w-[20vw] p-5 m-auto">
        <div class="flex flex-col items-center">
          <h3 class="text-white text-3xl text-center pb-5">Objetivo</h3>
          <p
            class="text-white text-xl text-center flex-grow flex items-center justify-center"
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
            class="text-white text-xl text-center flex-grow flex items-center justify-center"
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
            class="text-white text-xl text-center flex-grow flex items-center justify-center"
          >
            Respondemos às demandas das comunidades de Paranaguá, muitas vezes
            por meio de solicitações de associações de moradores, levando apoio
            jurídico e social às regiões mais necessitadas.
          </p>
        </div>
      </div>
    </div>

    <span
      v-if="showScrollButton"
      @click="scrollToTop"
      class="fixed bottom-[30px] right-[30px] cursor-pointer p-[10px] bg-black rounded-full text-white shadow-lg"
    >
      <svg
        class="w-6 h-6 text-white"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke="white"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 6v13m0-13 4 4m-4-4-4 4"
        />
      </svg>
    </span>
  </AppLayout>
</template>