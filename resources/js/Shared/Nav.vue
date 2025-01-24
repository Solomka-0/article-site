<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <Link :href="route('home')" class="navbar-brand">Статейник</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link" :class="{ active: $page.component === 'Home' && $page.url === '/' }">На главную</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('articles.list')" class="nav-link" :class="{ active: $page.component === 'Articles/Index' || $page.component === 'Articles/Show' && $page.url.startsWith('/articles') && $page.url !== '/' }">Каталог статей</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {route} from "ziggy-js";
</script>
