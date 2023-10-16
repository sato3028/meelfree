<template>
  <div>
    <button type="button" @click="toggleBold">Bold</button>
    <input type="file" @change="insertImage" multiple />
    <button type="button" @click="removeImage">Remove Image</button>
    <editor-content :editor="editor" class="prose p-4 border rounded" />
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watchEffect } from 'vue';
import { Editor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';

const editor = ref(null);
const CLOUDINARY_UPLOAD_URL = `https://api.cloudinary.com/v1_1/dqaxgeag8/image/upload`;
const CLOUDINARY_UPLOAD_PRESET = 'meel-free';

const emit = defineEmits(['update:modelValue']);

onMounted(() => {
  editor.value = new Editor({
    extensions: [StarterKit, Image],
    onUpdate: ({ editor }) => {
      emit('update:modelValue', editor.getHTML());
    },
  });

  // デバッグログ
  console.log('Editor instance:', editor.value);
  console.log('getHTML is a function:', typeof editor.value.getHTML === 'function');
});

onBeforeUnmount(() => {
  editor.value?.destroy();
});

const toggleBold = () => {
  editor.value.chain().focus().toggleBold().run();
};

const insertImage = async (event) => {
  const files = event.target.files;
  
  for (const file of files) {
    if (file && file.type.startsWith('image/')) {
      const formData = new FormData();
      formData.append('file', file);
      formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);
      
      try {
        const response = await fetch(CLOUDINARY_UPLOAD_URL, {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          const errorData = await response.json();
          console.error('Cloudinary error:', errorData);
          return;
        }

        const data = await response.json();
        if (data.secure_url) {
          editor.value.chain().focus().setImage({ src: data.secure_url }).run();
        }
      } catch (error) {
        console.error('Error uploading image:', error);
      }
    }
  }
};

const removeImage = () => {
  editor.value.chain().focus().deleteSelection().run();
};

const props = defineProps({
  modelValue: String,
});

watchEffect(() => {
  if (props.modelValue !== editor.value?.getHTML()) {
    editor.value?.commands.setContent(props.modelValue);
  }
});

defineExpose({
  editor,
});
</script>

<style scoped>
/* Add your styles here */
</style>
