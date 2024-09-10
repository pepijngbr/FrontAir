<template>
    <section class="mb-4 pb-10 pt-20">
        <h1>Store {{ $route.params }}</h1>
        <p>Show specific product information</p>
    </section>
    <!-- left column -->
    <!-- image -->

    <!-- right column -->
    <!-- product name -->
    <!-- product description -->
    <!-- product price -->
    <!-- product quantity -->
    <!-- product actions (redeem using loyalty points) -->
</template>

<script>
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'StoreShow',
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;
        useHead({
            title: 'Store Show - FrontAir',
            link: [
                {
                    rel: 'canonical',
                    href: canonicalUrl,
                },
            ],
            meta: [
                {
                    name: 'description',
                    content:
                        'The store show page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'product, store, store show, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Store Show - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The store show page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    property: 'og:type',
                    content: 'website',
                },
                {
                    property: 'og:url',
                    content: 'https://www.frontair.nl',
                },
                {
                    property: 'og:image',
                    content:
                        'https://www.frontair.nl/images/frontair_logo.webp',
                },
            ],
        });
    },
    data() {
        return {
            product: {},
        };
    },
    mounted() {
        this.retrieveProduct();
        console.log(this.$route.params);
    },
    methods: {
        retrieveProduct() {
            axios
                .get(apiUrl + '/products/' + this.$route.params.id)
                .then((response) => {
                    console.log(response.data);
                    this.product = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        redeemProduct() {
            console.log('Product redeemed!');
        },
    },
};
</script>
