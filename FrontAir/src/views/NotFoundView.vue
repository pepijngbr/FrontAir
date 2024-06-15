<template>
    <h1>Not Found</h1>
    <p>Sorry, the page you are looking for does not exist.</p>
    <RouterLink :to="{ name: 'home' }">Return to Home</RouterLink>
</template>

<script>
import { RouterLink } from 'vue-router';
import { useHead } from '@vueuse/head';

export default {
    name: 'NotFoundView',
    components: {
        RouterLink,
    },
    setup() {
        useHead({
            title: 'Not Found - FrontAir',
            meta: [],
        });
    },
};
</script>
