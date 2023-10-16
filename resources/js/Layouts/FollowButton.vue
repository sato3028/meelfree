<template>
  <button 
    @click="handleClick" 
    :class="buttonClass"
    class="text-white py-2 px-4 uppercase rounded shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"
  >
    {{ isFollowing ? 'フォロー解除' : 'フォロー' }}
  </button>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps(['userId', 'initialIsFollowing']);
const emits = defineEmits(['follow', 'unfollow']);

const isFollowing = ref(props.initialIsFollowing);

const handleClick = () => {
  if (isFollowing.value) {
    emits('unfollow', props.userId);
  } else {
    emits('follow', props.userId);
  }
  isFollowing.value = !isFollowing.value;
};

const buttonClass = computed(() => {
  return isFollowing.value 
    ? 'bg-gray-700 hover:bg-gray-800' 
    : 'bg-blue-400 hover:bg-blue-500';
});
</script>

<style scoped>
/* ここに追加のスタイルを記述することもできます */
</style>
