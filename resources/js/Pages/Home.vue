<template>
    <div>
        <Nav/>

        <div class="container mt-4">
            <h1 v-if="$page.url === '/'">Последние добавленные статьи</h1>
            <h1 v-else>Каталог статей</h1>

            <div class="row g-3">
                <div class="col-md-4 g-3" v-for="article in articles" :key="article.id">
                    <ArticleThumbnail :article="article"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Nav from '@/Shared/Nav.vue';
import ArticleThumbnail from "@/Components/ArticleThumbnail.vue";

const props = defineProps({
    articles: Array
})

</script>

<style scoped>

</style>
