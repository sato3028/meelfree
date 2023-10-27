<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FollowButton from '@/Layouts/FollowButton.vue';
import { Head,router } from '@inertiajs/vue3'

const { users } = usePage().props;
const { following, followers } = usePage().props;
const activeTab = ref('following');

const setActiveTab = (tab) => {
  activeTab.value = tab;
};


const follow = (userId) => {
  router.post(`/follow/${userId}`);
};

const unfollow = (userId) => {
  router.delete(`/unfollow/${userId}`);
};
</script>

<template>
    <Head title="フォロー情報" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">フォロー情報</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  
                <div>
                  <div class="hidden mt-6 mb-6 w-full sm:flex justify-between">
                    <button
                      class="w-1/2 py-3 mx-4 flex items-center justify-center text-2xl font-medium leading-5 text-gray-900 text-center focus:outline-none transition duration-150 ease-in-out"
                      :class="activeTab === 'following' ? 'border-b-2 border-indigo-400' : ''"
                      @click="setActiveTab('following')"
                    >
                      フォローリスト
                    </button>
                    <button
                      class="w-1/2 py-3 mx-4 flex items-center justify-center text-2xl font-medium leading-5 text-gray-900 text-center focus:outline-none transition duration-150 ease-in-out"
                      :class="activeTab === 'followers' ? 'border-b-2 border-indigo-400' : ''"
                      @click="setActiveTab('followers')"
                    >
                      フォロワーリスト
                    </button>
                  </div>
                  
                  <div v-if="activeTab === 'following'">
                      <ul>
                          <li v-for="user in following" :key="user.id" class="text-gray-600 body-font">
                              <!-- ここに各ユーザーの情報を表示 -->
                              <div class="container px-5 py-4 mx-auto">
                                  <div class="lg:w-3/5 flex flex-col sm:flex-row sm:items-center items-start mx-auto">
                                      <div class="w-10 h-10 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-7 h-7" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                          </svg>
                                      </div>
                                      <h1 class="flex-grow sm:pr-16 text-2xl font-medium title-font text-gray-900">{{ user.name }}</h1>
                                      
                                      <FollowButton
                                        :userId="user.id"
                                        :initialIsFollowing="following.map(f => f.id).includes(user.id)"
                                        @follow="follow"
                                        @unfollow="unfollow"
                                      />
                                      
                                  </div>
                              </div>
                          </li>
                      </ul>
                  </div>
                  <div v-if="activeTab === 'followers'">
                      <ul>
                        <li v-for="user in followers" :key="user.id" class="text-gray-600 body-font">
                            <div class="container px-5 py-4 mx-auto">
                                <div class="lg:w-3/5 flex flex-col sm:flex-row sm:items-center items-start mx-auto">
                                    <div class="w-10 h-10 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-7 h-7" viewBox="0 0 24 24">
                                          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                          <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <h1 class="flex-grow sm:pr-16 text-2xl font-medium title-font text-gray-900">{{ user.name }}</h1>
                                    
                                    <FollowButton
                                      :userId="user.id"
                                      :initialIsFollowing="following.map(f => f.id).includes(user.id)"
                                      @follow="follow"
                                      @unfollow="unfollow"
                                    />

                                </div>
                            </div>
                        </li>
                      </ul>
                  </div>
        
                </div>
                
                </div>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
