<template>
    <h1>User: {{ this.user }}</h1>
    <p>{{ this.$route.params.id }}</p>

    <!-- RouterLink has to return back to previous page -->
    <!-- <button @click="$router.go(-1)" class="btn btn-primary">Back</button> -->
    <!-- <RouterLink :to="{ name: 'dashboard.users.index' }" class="btn btn-primary">Back</RouterLink> -->
</template>

<script lang="ts">
    import axios from 'axios';

    export default {
        name: 'UsersShow',
        data() {
            return {
                user: {},
            };
        },
        mounted() {
            this.retrieveUser();
        },
        methods: {
            retrieveUser() {
                axios.get(apiUrl + '/users/' + this.$route.params.id)
                    .then(response => {
                        console.log(response.data);
                        this.user = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
        },
    };
</script>