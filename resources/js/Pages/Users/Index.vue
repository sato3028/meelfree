<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const { user } = defineProps({
    user: Object
});
</script>

<template>
    <Head title="プロフィール" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">プロフィール</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-8 bg-white shadow mt-24">
                              <div class="grid grid-cols-1 md:grid-cols-3">
                                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                                  <div>
                                    <p class="font-bold text-gray-700 text-xl">{{ user.following_count }}</p>
                                    <p class="text-gray-400">フォロー</p>
                                  </div>
                                  <div>
                                       <p class="font-bold text-gray-700 text-xl">{{ user.followers_count }}</p>
                                    <p class="text-gray-400">フォロワー</p>
                                  </div>
                                      <div>
                                       <p class="font-bold text-gray-700 text-xl">{{ user.posts_count }}</p>
                                    <p class="text-gray-400">投稿数</p>
                                  </div>
                                </div>
                                <div class="relative">
                                  <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                                  </div>
                                </div>
                            
                                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                            <button
                              class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"
                            >
                              button1
                            </button>
                                <button
                              class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"
                            >
                              button2
                            </button>
                                </div>
                              </div>
                            
                              <div class="mt-20 text-center border-b pb-12">
                                <h1 class="text-4xl font-medium text-gray-700">{{ user.name }}</h1>
                              </div>
                              
                              <div>
                                
                              <div class="container px-5 py-12 mx-auto">
                                <div class="flex flex-wrap -m-12">
                                    
                                  <div v-for="post in user.posts" :key="post.id" class="p-12 md:w-1/2 flex flex-col items-start">
                                    <span class="inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest">CATEGORY</span>
                                    <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">{{ post.title }}</h2>
                                    <p class="leading-relaxed mb-8">{{ post.body }}</p>
                                    <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
                                      <a class="text-indigo-500 inline-flex items-center">Learn More
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M5 12h14"></path>
                                          <path d="M12 5l7 7-7 7"></path>
                                        </svg>
                                      </a>
                                      <span class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                        <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                          <circle cx="12" cy="12" r="3"></circle>
                                        </svg>1.2K
                                      </span>
                                      <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                        <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                          <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                        </svg>6
                                      </span>
                                    </div>
                                  </div>
                            
                                </div>
                              </div>
                                
                                
                                </div>
                            
                            </div>
                            </div>
                        </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>