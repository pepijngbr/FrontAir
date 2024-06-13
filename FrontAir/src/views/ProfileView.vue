<template>
    <section class="mb-4 pt-20 text-center md:text-left">
        <h1><i class="bi bi-person-circle"></i> Profile</h1>
        <p>View and edit your profile.</p>
    </section>
    <div class="divider"></div>
    <section class="my-12">
        <b class="text-2xl">Profile Information</b>
        <form @submit.prevent="updateInformation()" class="my-2">
            <p class="font-bold">Name</p>
            <input
                type="text"
                placeholder="Type here"
                class="input input-bordered w-full max-w-xs"
                required
                v-model="this.name"
            />
            <button type="submit" class="btn btn-accent">Update</button>
        </form>
        <div class="my-2">
            <p class="font-bold">Email</p>
            <p>{{ this.user.email }}</p>
        </div>
        <button class="btn" onclick="support_modal.showModal()">
            How do I change my email address?
        </button>
        <dialog id="support_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Hey there! :)</h3>
                <p class="py-4">
                    If you would like to change your email address, please
                    contact our support team via
                    <a
                        href="mailto:support@frontair.nl"
                        class="text-primary underline"
                        >support@frontair.nl</a
                    >
                </p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </section>
    <section class="my-12">
        <b class="text-2xl">Change Password</b>
        <form class="my-4">
            <label for="old-password">Old Password</label><br />
            <input
                type="password"
                placeholder="Type here"
                class="input input-bordered w-full max-w-xs"
                id="old-password"
                name="old-password"
            /><br />
            <label for="new-password">New Password</label><br />
            <input
                type="password"
                placeholder="Type here"
                class="input input-bordered w-full max-w-xs"
                id="new-password"
                name="new-password"
            /><br />
            <label for="confirm-password">Confirm Password</label><br />
            <input
                type="password"
                placeholder="Type here"
                class="input input-bordered w-full max-w-xs"
                id="confirm-password"
                name="confirm-password"
            /><br /><br />
            <button type="submit" class="btn btn-accent">
                Change Password
            </button>
        </form>
    </section>
    <section class="my-12">
        <b class="text-2xl">Change Theme</b>
        <p>Change the theme of the website to your liking!</p>
        <div class="join my-4">
            <input
                type="radio"
                name="theme-buttons"
                class="theme-controller btn join-item"
                aria-label="Light"
                value="frontair"
                @click="setTheme('frontair')"
            />
            <input
                type="radio"
                name="theme-buttons"
                class="theme-controller btn join-item"
                aria-label="Dark"
                value="frontairDark"
                @click="setTheme('frontairDark')"
            />
        </div>
    </section>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { useSiteThemeStore } from '@/stores/siteTheme.js';

import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'ProfileView',
    data() {
        return {
            theme: '',
            name: '',
            user: {
                first_name: useUserStore().user.name,
                email: useUserStore().user.email,
            },
        };
    },
    mounted() {
        if (this.name === '') {
            this.name = useUserStore().user.name;
        }
    },
    methods: {
        setTheme(theme) {
            // Access the Pinia store
            const siteThemeStore = useSiteThemeStore();

            // Update the theme state in the store
            siteThemeStore.setTheme(theme);

            // Update localStorage
            localStorage.setItem('theme', theme);

            // Apply the theme to the document element
            document.documentElement.setAttribute('data-theme', theme);
        },
        updateInformation() {
            const data = {
                name: this.name,
            };
            axios
                .put(apiUrl + '/users/' + useUserStore().user.id, data)
                .then((response) => {
                    console.log(response.data);
                    useUserStore().updateUser(response.data);
                    alert('Succesfully updated user information!');
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
