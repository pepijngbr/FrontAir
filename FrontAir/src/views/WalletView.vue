<template>
    <div class="p-4 pt-2 text-left text-2xl">
        <h1><i class="bi bi-wallet"></i> Wallet</h1>
        <p>Here you can see your wallet balance and top it up.</p>
        <p>Your current balance is: €{{ balance }}</p>
        <div class="flex">
            <input
                type="text"
                placeholder="Amount"
                class="input input-bordered"
            />
            <button @click="topUp" class="btn btn-outline">Top up</button>
        </div>
    </div>
</template>

<script lang="ts">
import { useUserStore } from '@/stores/user';

import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'WalletView',
    data() {
        return {
            balance: 0,
        };
    },
    mounted() {
        this.retrieveBalance();
    },
    methods: {
        retrieveBalance() {
            const userStore = useUserStore();
            const user = userStore.user;
            axios
                .get(apiUrl + '/users/' + user.id)
                .then((response) => {
                    console.log(response.data);
                    this.balance = response.data[0].wallet;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        topUp() {
            const userStore = useUserStore();
            const user = userStore.user;
            axios
                .post(apiUrl + '/users/' + user.id)
                .then((response) => {
                    console.log('Wallet topped up!');
                    console.log(response.data);
                    this.retrieveBalance();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
