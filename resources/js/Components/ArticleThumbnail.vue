<template>
    <div class="card">
        <NavLink :href="route('articles.show', article.slug)" class="text-reset text-decoration-none">
            <img :src="article.thumbnail" :alt="article.title" class="card-img-top"/>
            <div class="card-body">
                <h5 class="card-title">{{ article.title }}</h5>
                <p class="card-text">{{ article.content.substring(0, 100) }}...</p>
                <div>
                    <span v-for="tag in article.tags" :key="tag.id" class="badge bg-secondary me-1">{{ tag.name }}</span>
                </div>
            </div>
        </NavLink>
    </div>
</template>

<script setup>
import {route} from "ziggy-js";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    article: Object
})
</script>
