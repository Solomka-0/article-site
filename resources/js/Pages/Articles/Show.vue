<template>
    <div>
        <Nav />

        <div class="container mt-4">
            <img :src="article.cover_image" :alt="article.title" class="img-fluid">

            <!-- Текст статьи -->
            <h1 class="mt-4">{{ article.title }}</h1>
            <div v-html="article.content" class="mb-4"></div>

            <!-- Теги статьи -->
            <div>
                <Link :href="`/tags/${tag.slug}`" v-for="tag in article.tags" :key="tag.id">
                    <span class="badge bg-secondary me-1">{{ tag.name }}</span>
                </Link>
            </div>

            <!-- Счетчик лайков -->
            <div class="mt-3">
                <button @click="incrementLikes" class="btn btn-primary">
                    ❤️ {{ likesCount }}
                </button>
            </div>

            <!-- Счетчик просмотров -->
            <div class="mt-2">
                Просмотры: {{ viewsCount }}
            </div>

            <!-- Форма комментария -->
            <div v-if="!commentSent" class="mt-4">
                <h2>Оставить комментарий</h2>
                <form @submit.prevent="submitComment">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Тема сообщения</label>
                        <input type="text" v-model="comment.subject" class="form-control" id="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Текст сообщения</label>
                        <textarea v-model="comment.body" class="form-control" id="body" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Отправить</button>
                </form>
            </div>
            <div v-else class="alert alert-success mt-4">Ваше сообщение успешно отправлено.</div>
        </div>
    </div>
</template>

<script setup>
import Nav from '@/Shared/Nav.vue';
import { ref, onMounted } from 'vue';
import {route} from "ziggy-js";
import axios from 'axios';
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    article: {
        id: Number
    }
})

const likesCount = ref(props.article.likes_count);
const viewsCount = ref(props.article.views_count);
const commentSent = ref(false);
const comment = ref({
    subject: '',
    body: '',
});

const incrementLikes = () => {
    axios.post(route('articles.incrementLikes', props.article.id))
        .then(response => {
            console.log('articles.incrementLikes')
            likesCount.value = response.data.likes_count;
        })
        .catch(error => {
            console.error(error);
        });
};

const incrementViews = () => {
    axios.post(route('articles.incrementViews', props.article.id))
        .then(response => {
            viewsCount.value = response.data.views_count;
        })
        .catch(error => {
            console.error(error);
        });
};

const submitComment = () => {
    axios.post(route('comments.store', props.article.id), comment.value)
        .then(response => {
            commentSent.value = true;
        })
        .catch(error => {
            if (error.response.status === 422) {
                alert('Ошибка валидации. Пожалуйста, заполните все поля.');
            } else {
                console.error(error);
            }
        });
};

onMounted(() => {
    setTimeout(incrementViews, 5000);
});
</script>
