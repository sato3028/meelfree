<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3'

defineProps({
})

const form = reactive({
  title : null,
  body : null
})

const postItem = () => {
  router.post('/posts', form)
}
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
                                  <label for="body" class="leading-7 text-sm text-gray-600">投稿内容</label>
                                  <textarea id="message" name="body" v-model="form.body" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                </div>
                              </div>
                              <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
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