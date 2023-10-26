<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Slider from '@/Components/Slider.vue';

const props = defineProps({
  post: Object,
  comments: Array,
  user: Object,
  images: Array
});

let newComment = ref('');

function addComment() {
  router.post(`/posts/${props.post.id}/comments`, { body: newComment.value });
  newComment = '';
}
</script>

<template>
<AuthenticatedLayout>
<template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿詳細</h2>
</template>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="bg-gray-100 h-screen overflow-hidden">
        
        <div class="flex h-full">
            <div class="bg-white w-1/2 p-4 overflow-y-auto hide-scrollbar">
                <Slider :images="images"/>
            </div>
        
            <div class="flex-grow w-1/2 bg-white overflow-y-auto p-4">
                <h1 class="text-4xl font-semibold text-center">{{ post.title }}</h1>
                <hr class="w-72 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                <div class="mb-4">
                    <p class="text-2xl">{{ post.body }}</p>
                </div>
                
                <div class="flex mx-auto items-center justify-center shadow-lg mt-32 mb-12">
                   <div class="w-full max-w-xl bg-white rounded-lg px-4 pt-2">
                      <div class="flex flex-wrap -mx-3 mb-6">
                         <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">コメント</h2>
                         <div class="w-full md:w-full px-3 mb-2 mt-2">
                            <textarea v-model="newComment" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="body" placeholder='コメントを入力' required></textarea>
                         </div>
                         <div class="w-full md:w-full flex items-start md:w-full px-3">
                            <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
                               <!--<svg fill="none" class="w-5 h-5 text-gray-600 mr-1" viewBox="0 0 24 24" stroke="currentColor">-->
                               <!--   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>-->
                               <!--</svg>-->
                            </div>
                            <div class="-mr-1">
                               <button @click="addComment" class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100">送信</button>
                            </div>
                         </div>
                   </div>
                   </div>
                </div>
                
                <div v-for="comment in props.comments" class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
                    <div class="relative flex gap-4">
                        <img src="https://dummyimage.com/104x104" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy">
                        <div class="flex flex-col w-full">
                            <div class="flex flex-row justify-between">
                                <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{ comment.user.name }}</p>
                                <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
                            </div>
                            <p class="text-gray-400 text-sm">20 April 2022, at 14:88 PM</p>
                        </div>
                    </div>
                    <p class="-mt-4 text-gray-500 overflow-hidden whitespace-normal break-words">{{ comment.body }}</p>
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
        /* スクロールバーを非表示にする */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
