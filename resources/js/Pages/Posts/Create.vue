<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive, computed ,ref, watch } from 'vue';
import { router } from '@inertiajs/vue3'

const props = defineProps({
  categories: Array
})

const form = reactive({
  title : null,
  body : null,
  categories: []
})

const postItem = () => {
  router.post('/posts', form)
}

const options = computed(() => {
  return props.categories.map(category => ({
    value: category.id, 
    text: category.name, 
    selected: false 
  }));
});

const selected = ref([]);
const show = ref(false);
const selectedOptions = ref([]);

const open = () => show.value = true;
const close = () => show.value = false;
const isOpen = () => show.value === true;

const select = (index, event) => {
  if (!options.value[index].selected) {
    options.value[index].selected = true;
    options.value[index].element = event.target;
    selected.value.push(index);
  } else {
    selected.value.splice(selected.value.lastIndexOf(index), 1);
    options.value[index].selected = false;
  }
};

const remove = (index, option) => {
  options.value[option].selected = false;
  selected.value.splice(index, 1);
};

const selectedValues = computed(() => 
  selected.value.map(optionIndex => options.value[optionIndex].value)
);

watch(selectedValues, (newVal) => {
  form.categories = newVal;
});
</script>

<template>
    <Head title="投稿する" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿する</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      
                      <section class="text-gray-600 body-font relative">
                      <form @submit.prevent="postItem">
                        
                        <div class="container px-5 py-8 mx-auto">
                          <div class="flex flex-col text-center w-full mb-12">
                          </div>
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                                  <input type="text" id="title" name="name" v-model="form.title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                              </div>
                              
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="categories" class="leading-7 text-sm text-gray-600">カテゴリー</label>
                                  
                                  <div class="w-full md:w-1/2 flex flex-col items-center mx-auto">
                                  <form>
                                    <input name="values" type="hidden" :value="selectedValues">
                                    <div class="inline-block relative w-64">
                                      <div class="flex flex-col items-center relative">
                                        <div @click="open" class="w-full svelte-1l8159u">
                                          <div class="my-2 p-1 flex border border-gray-200 bg-white rounded svelte-1l8159u">
                                            <div class="flex flex-auto flex-wrap">
                                              <template v-for="(optionIndex, index) in selected" :key="options[optionIndex].value">
                                                <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                                                  <div class="text-xs font-normal leading-none max-w-full flex-initial" v-text="options[optionIndex].text"></div>
                                                  <div class="flex flex-auto flex-row-reverse">
                                                    <div @click="remove(index, optionIndex)">
                                                      <svg class="fill-current h-6 w-6 " role="button" viewBox="0 0 20 20">
                                                        <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                          c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                          l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                          C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                      </svg>
                                                    </div>
                                                  </div>
                                                </div>
                                              </template>
                                              <div v-show="selected.length === 0" class="flex-1">
                                                <input placeholder="Select a option"
                                                  class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                                  :value="selectedValues"
                                                >
                                              </div>
                                            </div>
                                            <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">
                                              <button type="button" v-show="show" @click="open"
                                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                  <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                                                    c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                                                    L17.418,6.109z" />
                                                </svg>
                                              </button>
                                              <button type="button" v-show="!show" @click="close"
                                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                  <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                                                    c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                                                    " />
                                                </svg>
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="w-full px-4">
                                          <div v-show="show" @click.away="close" 
                                            class="absolute shadow top-100 bg-white z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                                            <div class="flex flex-col w-full">
                                              <div v-for="(option, index) in options" :key="index">
                                                <div @click="select(index, $event)"
                                                  class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                                                  <div :class="option.selected ? 'border-teal-600' : ''"
                                                    class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                    <div class="w-full items-center flex">
                                                      <div class="mx-2 leading-6" v-text="option.text"></div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                  <select v-cloak v-model="selectedOptions" multiple style="display: none;">
                                    <option v-for="(option, index) in options" :key="index" :value="option.value">
                                      {{ option.text }}
                                    </option>
                                  </select>
                                </div>
                                </div>
                              </div>
                              
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="body" class="leading-7 text-sm text-gray-600">投稿内容</label>
                                  <textarea id="message" name="body" v-model="form.body" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                </div>
                              </div>
                              
                              <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿する</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      </form>
                      </section>
                      
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
[v-cloak] {
  display: none;
}
</style>