<script setup>
import { ref } from 'vue';

const emit = defineEmits(['update:activeTab']);
const activeTab = ref('following');

const setActiveTab = (tab) => {
  activeTab.value = tab;
  emit('update:activeTab', tab);
};

const tabClass = (tab) => {
  return activeTab.value === tab ? 'bg-blue-500 text-white' : 'bg-gray-200';
};
</script>

<template>
  <div>
    <div class="flex justify-center space-x-4 mb-4">
      <button @click="setActiveTab('following')" :class="tabClass('following')">Following</button>
      <button @click="setActiveTab('followers')" :class="tabClass('followers')">Followers</button>
    </div>
    <slot name="content" :activeTab="activeTab"></slot>
  </div>
</template>