<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
  posts: Array
});

const reversedPosts = computed(() => {
  return [...props.posts].reverse();
});

</script>

<template>
    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                  
                <div class="grid place-items-center mt-6">
                  
                <div  v-for="post in reversedPosts" class="bg-white rounded-md bg-gray-800 shadow-lg my-6 mx-auto w-3/4">
                  <div class="md:flex px-4 leading-none max-w-4xl">
                    
                    <div class="flex-none image-container">
                      <div
                          :style="`background-image: url(${post.images.length > 0 ? post.images[0].image_url : 'https://res.cloudinary.com/dqaxgeag8/image/upload/v1697804642/20200501_noimage_k5bak3.jpg'});`"
                          class="post-image rounded-md shadow-2xl transform -translate-y-4 border-4 border-gray-300 shadow-lg"
                      ></div>
                    </div>
          
                    <div class="flex-col text-gray-300 w-hull">
             
                      <p class="pl-4 mt-2 text-2xl font-bold">{{ post.title }}</p>
                      <hr class="hr-text" data-content="">
                      <div class="hidden md:block  text-left text-xl px-4 my-2">
                        <span class="font-bold">{{ post.body }}</span>
                      </div>
                      
                      <p class="flex space-x-2 text-md px-4 my-2">
                        <span
                        v-for="category in post.categories" 
                        :key="category.id" 
                        class="inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest"
                        >
                          {{ category.name }}
                        </span>
                      </p>
                    
                    </div>
                  </div>
                  <div class="flex justify-between items-center px-4 mb-4 w-full">
                    <div class="flex">
                    <!--<i class="material-icons mr-2 text-red-600">favorite_border</i>-->
                    <!--<i class="material-icons text-blue-600">remove_red_eye</i>-->
                      <a :href="`/users/${post.user_id}`" class="inline-flex items-center">
                        <img alt="blog" src="https://dummyimage.com/104x104" class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center">
                        <span class="flex-grow flex flex-col pl-4">
                        <span class="title-font font-medium text-gray-900">{{ post.user.name }}</span>
                        </span>
                      </a>
                    </div>
                    <div class="flex">
                      <a :href="`/posts/${post.id}`" class="text-indigo-500 inline-flex items-center">詳細
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M5 12h14"></path>
                          <path d="M12 5l7 7-7 7"></path>
                        </svg>
                      </a>
                    </div>
                  </div>          
                </div>
              </div>
                </div>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>
<style scoped>
body {
  text-align: center;
}

.hr-text {
  line-height: 1em;
  position: relative;
  outline: 0;
  border: 0;
  color: black;
  text-align: center;
  height: 1.5em;
  opacity: 0.5;
}
.hr-text:before {
  content: "";
  background: linear-gradient(to right, transparent, #818078, transparent);
  position: absolute;
  left: 0;
  top: 50%;
  width: 100%;
  height: 1px;
}
.hr-text:after {
  content: attr(data-content);
  position: relative;
  display: inline-block;
  color: black;
  padding: 0 0.5em;
  line-height: 1.5em;
  color: #818078;
  background-color: #fcfcfa;
}

.image-container {
    width: 14rem;
    height: 18rem;
}

.post-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>