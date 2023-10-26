<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex justify-center items-center min-h-screen bg-center bg-cover bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
        style="background-image: url('https://res.cloudinary.com/dqaxgeag8/image/upload/v1698058550/jason-jarrach-LJ5IhBA4gbs-unsplash_djr1pk.jpg');"
    >
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="absolute text-center z-10">
            <h1 class="w-2/4 mx-auto text-2xl mb-4 font-bold leading-relaxed text-white text-center mb-10">「MealFree」へようこそ！MealFreeは食や料理に特化したSNSサービスであり、食の楽しさや新しいレシピの発見、料理のコツなどを気軽に共有できる場所です。食事の楽しみをもっと自由に、もっとオープンに。あなたの食の物語を、MealFreeで思いのままに発信してください。気軽に参加し、食の新しい世界を探求しましょう！</h1>

            <div v-if="canLogin">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('posts.index')"
                    class="px-6 py-2 mb-2 inline-block text-lg font-semibold text-white bg-green-500 rounded hover:bg-green-600"
                >投稿一覧へ</Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="w-36 py-2 mb-2 inline-block text-lg font-semibold text-white bg-green-500 rounded hover:bg-green-600"
                    >ログイン</Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="w-36 py-2 inline-block ml-4 text-lg font-semibold text-white bg-green-500 rounded hover:bg-green-600"
                    >新規登録</Link>
                </template>
            </div>
        </div>
    </div>
</template>

<style>
</style>
