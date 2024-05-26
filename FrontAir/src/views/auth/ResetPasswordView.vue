<template>
    <section class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-semibold text-center">Reset Password</h1>
            <p class="text-center text-sm mt-2">Enter your email address to reset your password.</p>
            <form class="mt-8" @submit.prevent="resetPassword">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input v-model="email" type="email" id="email" name="email" placeholder="
            Enter your email address"
                        class="mt-1 block w-full px-3 py-2 rounded-lg bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" />
                </div>
                <button type="submit"
                    class="btn btn-primary w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Reset Password
                </button>
            </form>
        </div>
    </section>
</template>

<script lang="ts">
    import axios from 'axios';

    const apiUrl = '';

    export default {
        name: 'ResetPasswordView',
        data() {
            return {
                email: '',
            }
        },
        methods: {
            resetPassword() {
                // console.log('Password reset!');
            }
        }
    }
</script>