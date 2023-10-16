<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  post: Object,
  comments: Array,
  user: Object
});

let newComment = ref('');

function addComment() {
  router.post(`/posts/${props.post.id}/comments`, { body: newComment.value });
}
</script>

<template>
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿詳細</h2>
    </template>

    <!-- Post Details -->
    <!-- ... (display post details similarly to Index.vue) ... -->

    <!-- Comments Section -->
    <section>
        <h3>コメント:</h3>
        <div v-for="comment in props.comments">
            <p>{{ comment.body }} - {{ comment.user.name }}</p>
        </div>

        <!-- Add Comment -->
        <div>
            <textarea v-model="newComment" placeholder="コメントを追加..."></textarea>
            <button @click="addComment">送信</button>
        </div>
    </section>

    <!-- Back to Posts List -->
    <a href="/posts">投稿一覧に戻る</a>

</AuthenticatedLayout>
</template>
