<template>
    <div>
        <Nav />

        <div class="container mt-4">
            <h1 v-if="$page.url === '/'">Последние добавленные статьи</h1>
            <h1 v-else>Каталог статей</h1>


            <div class="row g-3">
                <div class="col-md-4 g-3" v-for="article in articles.data" :key="article.id">
                    <ArticleThumbnail :article="article"/>
                </div>
            </div>
            <!-- Пейджинация для каталога статей -->
            <div v-if="$page.url !== '/' && articles.links.length > 3" class="mt-3 d-flex justify-content-center">
                <nav>
                    <ul class="pagination">
                        <li v-for="link in articles.links" :key="link.url" :class="['page-item', { active: link.active, disabled: !link.url }]">
                            <Link :href="link.url" class="page-link" v-html="link.label"></Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import Nav from '@/Shared/Nav.vue';
import ArticleThumbnail from '@/Components/ArticleThumbnail.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    articles: {
        data: Array
    }
})
</script>
