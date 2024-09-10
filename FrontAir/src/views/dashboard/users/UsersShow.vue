<template>
    <h1>User: {{ user }}</h1>
    <p>{{ $route.params.id }}</p>

    <!-- RouterLink has to return back to previous page -->
    <!-- <button @click="$router.go(-1)" class="btn btn-primary">Back</button> -->
    <!-- <RouterLink :to="{ name: 'dashboard.users.index' }" class="btn btn-primary">Back</RouterLink> -->
</template>

<script>
import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

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
            axios
                .get(apiUrl + '/users/' + this.$route.params.id)
                .then((response) => {
                    console.log(response.data);
                    this.user = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
