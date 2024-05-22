<!-- clouds -->
<!-- Logo, links to available pages (same as top navigation bar, load dynamically via this.$router) -->
<template>
    <footer class="footer bg-base-200 text-base-content">
        <div>
            <p>FrontAir</p>
        </div>
        <div>
            <p>© 2021 FrontAir</p>
        </div>
        <div>
            <p>Links</p>
            <ul>
                <li v-for="item in items" :key="item.path">
                    <RouterLink :to="item.path">{{ item.name }}</RouterLink>
                </li>
            </ul>
        </div>
    </footer>

    <script lang="ts">
    export default {
        data() {
            return {
                items: []
            }
        },
        created() {
            this.$router.options.routes.forEach(route => {
                this.items.push({
                    name: route.name,
                    path: route.path
                })
            })
        }
    }
</script>
