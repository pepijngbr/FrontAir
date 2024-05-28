<template>
    <section class="pt-20 pb-10 mb-4">
        <h1>Store {{ this.$route.params }}</h1>
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

<script lang="ts">
    import axios from 'axios';

    const apiUrl = 'http://127.0.0.1:8000';

    export default {
        name: 'StoreShow',
        data() {
            return {
                product: {}, // object
            };
        },
        mounted() {
            this.retrieveProduct();
            console.log(this.$route.params);
        },
        methods: {
            retrieveProduct() {
                axios.get(apiUrl + '/products/' + this.$route.params.id)
                    .then(response => {
                        console.log(response.data);
                        this.product = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            redeemProduct() {
                console.log('Product redeemed!');
            },
        }
    }
</script>