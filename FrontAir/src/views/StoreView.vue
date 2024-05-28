<template>
    <section class="pt-20 pb-10 mb-4">
        <h1><i class="bi bi-shop"></i> Store</h1>
        <p>Buy items from the store.</p>
        <button @click="loyaltyPoints(+100)" class="btn btn-success">Add 100</button>
        <button @click="loyaltyPoints(-100)" class="btn btn-error">Remove 100</button>
    </section>
    <section>
        <h2>Items</h2>
        <div class="p-4 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="card bordered">
                <figure>
                    <img class="w-full" src="https://source.unsplash.com/500x250/?Airplane" alt="Airplane" />
                </figure>
                <div class="card-body">
                    <h2>Item 1</h2>
                    <p>Buy airplanes from the store.</p>
                    <button class="btn btn-primary">{{ this.points > 180 ? 'Redeem' : 'More Loyalty Points needed'
                        }}</button>
                </div>
            </div>
            <div class="card bordered">
                <figure>
                    <img class="w-full" src="https://source.unsplash.com/500x250/?Airplane Airbus" alt="Airplane" />
                </figure>
                <div class="card-body">
                    <h2>Item 2</h2>
                    <p>Buy airplanes from the store.</p>
                    <button class="btn btn-primary">{{ this.points > 210 ? 'Redeem' : 'More Loyalty Points needed'
                        }}</button>
                </div>
            </div>
            <div class="card bordered">
                <figure>
                    <img class="w-full" src="https://source.unsplash.com/500x250/?Airplane Boeing" alt="Airplane" />
                </figure>
                <div class="card-body">
                    <h2>Item 3</h2>
                    <p>Buy airplanes from the store.</p>
                    <button class="btn btn-primary">{{ this.points >= 200 ? 'Redeem' : 'More Loyalty Points needed'
                        }}</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
    import { useUserStore } from '@/stores/user';

    export default {
        name: 'StoreView',
        data() {
            return {
                points: useUserStore().user ? useUserStore().user.loyalty_points : null
            }
        },
        // setup() {
        //     const userStore = useUserStore();
        //     useUserStore.user == null ? userStore.setUser({ loyalty_points: 0 }) : null;
        // },
        // watch: {
        //     useUserStore() {
        //         this.points = useUserStore().user.loyalty_points;
        //     }
        // },
        methods: {
            loyaltyPoints(amount: number) {
                const userStore = useUserStore();
                if (userStore.user != null) {
                    userStore.addLoyaltyPoints(amount);
                    this.points = userStore.user.loyalty_points;
                } else {
                    return;
                }
            }
        }
    }
</script>