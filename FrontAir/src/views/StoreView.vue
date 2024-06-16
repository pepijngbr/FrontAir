<template>
    <section class="mb-4 pb-10 pt-20">
        <h1><i class="bi bi-shop"></i> Store</h1>
        <p>Buy items from the store using your Loyalty Points!</p>
        <p>Receive Loyalty Points by booking Flights.</p>
    </section>
    <section>
        <h2>Items</h2>
        <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="item in this.items"
                class="card bordered shadow shadow-white/30"
            >
                <div class="card-body">
                    <h2>{{ item.name }}</h2>
                    <p class="font-bold">
                        Price: {{ item.loyalty_points }} loyalty points
                    </p>
                    <button
                        class="btn btn-primary"
                        @click="redeemItem(item.name, item.loyalty_points)"
                    >
                        {{
                            this.points > item.loyalty_points
                                ? 'Redeem'
                                : 'More loyalty points needed'
                        }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { useHead } from '@vueuse/head';

export default {
    name: 'StoreView',
    setup() {
        useHead({
            title: 'Store - FrontAir',
            meta: [],
        });
    },
    data() {
        return {
            points: useUserStore().user
                ? useUserStore().user.loyalty_points
                : null,
            items: [
                {
                    name: 'Item 1',
                    loyalty_points: 180,
                },
                {
                    name: 'Item 2',
                    loyalty_points: 210,
                },
                {
                    name: 'Item 3',
                    loyalty_points: 200,
                },
                {
                    name: 'Item 4',
                    loyalty_points: 700,
                },
            ],
        };
    },
    props: {
        isLoggedIn: Boolean,
    },
    methods: {
        redeemItem(item, loyalty_points) {
            const userStore = useUserStore();
            if (userStore.user.loyalty_points >= loyalty_points) {
                alert(
                    'Succesfully redeemed ' +
                        item +
                        ' for ' +
                        loyalty_points +
                        ' loyalty points!',
                );
            } else {
                const difference =
                    loyalty_points - userStore.user.loyalty_points;
                alert(
                    'Failed to redeem, ' +
                        difference +
                        ' more loyalty points needed.',
                );
            }
        },
    },
};
</script>
