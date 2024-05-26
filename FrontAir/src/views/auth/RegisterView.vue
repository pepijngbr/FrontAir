<template>
    <!-- TODO: without header (Auth layout, via index.ts vue-router) -->
    <img :src="'../src/assets/images/FrontAir.png'" alt="FrontAir Logo" class="h-40">
    <h1>Register</h1>
    <p>Register for an account.</p>
    <label class="form-control">
        <div class="label">
            <span class="label-text">What is your name?</span>
        </div>
        <input v-model="this.name" type="text" placeholder="Daisy" class="input input-bordered w-full max-w-xs" />
    </label>
    <label class="form-control">
        <div class="label">
            <span class="label-text">Where can we send your emails to?</span>
        </div>
        <input v-model="this.email" type="text" placeholder="daisy@gmail.com"
            class="input input-bordered w-full max-w-xs" />
    </label>
    <label class="form-control">
        <div class="label">
            <span class="label-text">Create a password</span>
        </div>
        <input v-model="this.password" type="password" placeholder="Enter your password"
            class="input input-bordered w-full max-w-xs" />
    </label>
    <button class="btn btn-primary" @click="register()">Register</button>
    <p>Already have an account? <RouterLink to="/login" class="text-primary font-bold">Login</RouterLink>
    </p>
    <p>Forgot your password? <RouterLink to="/reset-password" class="text-secondary font-bold">Reset Password
        </RouterLink>
    </p>
</template>

<script lang="ts">
    import axios from 'axios';

    const apiUrl = 'http://127.0.0.1:8000/api';

    export default {
        name: 'RegisterView',
        data() {
            return {
                name: '',
                email: '',
                password: '',
            }
        },
        methods: {
            register() {
                const newUser = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }
                axios.post(apiUrl + '/register', newUser)
                    .then(response => {
                        console.log('Registration successful!');
                        this.name = '';
                        this.email = '';
                        this.password = '';
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
        },
    }
</script>