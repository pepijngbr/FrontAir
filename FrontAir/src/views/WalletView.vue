<template>
    <section
        class="mx-auto mb-4 max-w-[900px] pb-10 pt-4 text-center md:pt-20 md:text-left"
    >
        <h1><i class="bi bi-wallet"></i> Wallet</h1>
        <p>
            Here you can see your wallet balance and top it up using the input
            below.
        </p>
        <p>
            Your current balance is:
            <span class="font-black">€{{ balance }}</span>
        </p>
        <p>The top up limit has a maximum of €999.</p>
        <div class="my-4 flex justify-center gap-2 md:justify-start">
            <input
                type="text"
                placeholder="9.99"
                class="input input-bordered"
                v-model="this.amount"
            />
            <button @click="topUp" class="btn btn-outline">Top up</button>
        </div>
    </section>
    <section>
        <div class="p-4 pt-2 text-center text-2xl"></div>
    </section>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'WalletView',
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;
        useHead({
            title: 'Wallet - FrontAir',
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
                        'The wallet page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'wallet, account, money, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Wallet - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The wallet page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
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
            balance: 0 || useUserStore().user.wallet,
            amount: null,
        };
    },
    mounted() {
        this.retrieveBalance();
    },
    methods: {
        async retrieveBalance() {
            const userStore = useUserStore();
            const user = userStore.user;
            await axios
                .get(apiUrl + '/users/' + user.id)
                .then((response) => {
                    console.log(response.data);
                    userStore.updateUser(response.data);
                    this.balance = parseFloat(response.data.wallet).toFixed(2);
                })
                .catch((error) => {
                    console.error('Error retrieving balance: ', error);
                });
        },
        async topUp() {
            if (this.amount <= 0) {
                alert('Unprocessable amount. Try again.');
            } else if (this.amount > 999) {
                alert('Amount cannot be higher than 999');
            } else {
                await this.retrieveBalance(); // ensure the balance is retrieve before adding a new amount
                const userStore = useUserStore();
                const user = userStore.user;
                let newAmount = (
                    Number(this.balance) + Number(this.amount)
                ).toFixed(2);
                const data = {
                    wallet: newAmount,
                };
                console.log('data: ', data);
                await axios
                    .put(apiUrl + '/users/' + user.id, data)
                    .then((response) => {
                        console.log('Wallet topped up!');
                        this.retrieveBalance();
                    })
                    .catch((error) => {
                        console.error('Error update wallet: ', error);
                    });
            }
        },
    },
};
</script>
