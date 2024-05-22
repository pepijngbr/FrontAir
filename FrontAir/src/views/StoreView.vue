<template>
    <section class="pt-20 pb-10 mb-4">
        <h1>Store</h1>
        <p>Buy items from the store.</p>
    </section>
    <section>
        <h2>Items</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="card bordered">
                <figure>
                    <img src="https://source.unsplash.com/400x400/?clothes" alt="Clothes" />
                </figure>
                <div class="card-body">
                    <h2>Clothes</h2>
                    <p>Buy clothes from the store.</p>
                    <button class="btn btn-primary">Buy</button>
                </div>
            </div>
            <div class="card bordered">
                <figure>
                    <img src="https://source.unsplash.com/400x400/?shoes" alt="Shoes" />
                </figure>
                <div class="card-body">
                    <h2>Shoes</h2>
                    <p>Buy shoes from the store.</p>
                    <button class="btn btn-primary">Buy</button>
                </div>
            </div>
            <div class="card bordered">
                <figure>
                    <img src="https://source.unsplash.com/400x400/?electronics" alt="Electronics" />
                </figure>
                <div class="card-body">
                    <h2>Electronics</h2>
                    <p>Buy electronics from the store.</p>
                    <button class="btn btn-primary">Buy</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
    export default {
        name: 'StoreView',
    }
</script>