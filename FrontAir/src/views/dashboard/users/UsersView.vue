<template>
    <div class="mx-[300px]">
        <RouterView />
        <h1>Manage Users</h1>
        <p>Manage users in the system.</p>
        <table class="w-full table-fixed text-left">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td class="text-center [&>*]:mx-1">
                        <div class="tooltip" data-tip="Opens User window">
                            <RouterLink
                                :to="{
                                    name: 'dashboard.users.show',
                                    params: { id: user.id },
                                }"
                                class="btn btn-info"
                            >
                                View
                            </RouterLink>
                        </div>
                        <div class="tooltip" data-tip="Opens update window">
                            <button
                                @click="updateUser(user.id)"
                                class="btn btn-warning"
                            >
                                Update
                            </button>
                        </div>
                        <div
                            class="tooltip"
                            data-tip="Opens deletion confirm window"
                        >
                            <button
                                @click="deleteUser(user.id)"
                                class="btn btn-error"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                    <td>
                        <!-- Open the modal using ID.showModal() method -->
                        <button class="btn" onclick="my_modal_2.showModal()">
                            open modal
                        </button>
                        <dialog id="my_modal_2" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button
                                        class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2"
                                    >
                                        ✕
                                    </button>
                                </form>
                                <h3 class="text-lg font-bold">Hello!</h3>
                                <p class="py-4">
                                    Press ESC key or click outside to close
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
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn" @click="modifyLimit(-10)">Prev</button>
        <p>Pages: {{ this.currentPage }} / {{ this.allUsers }}</p>
        <button class="btn" @click="modifyLimit(+10)">Next</button>
    </div>
</template>

<script>
import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'UsersView',
    data() {
        return {
            users: [],
            allUsers: [],
            currentPage: 1,
            limit: 10,
        };
    },
    mounted() {
        this.retrieveUsers();
    },
    watch: {
        limit() {
            this.retrieveUsers();
        },
    },
    methods: {
        modifyLimit(value) {
            if (this.limit + value < 10) {
                console.log('Limit cannot be less than 10');
                return;
            } else {
                this.currentPage += value / 10;
                this.limit += value;
            }
        },
        retrieveUsers() {
            axios
                .get(apiUrl + '/users')
                .then((response) => {
                    console.log(response.data);
                    this.allUsers = response.data.length;
                })
                .catch((error) => {
                    console.error(error);
                });
            // TODO: Add pagination, instead of retrieving users each time, retrieve all users but show 10 with offset
            axios
                .get(apiUrl + '/users?limit=10&offset=' + (this.limit - 10))
                .then((response) => {
                    console.log(response.data);
                    this.users = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        createUser() {
            axios
                .post(apiUrl + '/users')
                .then((response) => {
                    console.log('User created!');
                    console.log(response.data);
                    this.retrieveUsers();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        updateUser(id) {
            axios
                .put(apiUrl + '/users/' + id)
                .then((response) => {
                    console.log('User updated!');
                    console.log(response.data);
                    this.retrieveUsers();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        deleteUser(id) {
            axios
                .delete(apiUrl + '/users/' + id)
                .then((response) => {
                    console.log('User deleted!');
                    console.log(response.data);
                    this.retrieveUsers();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
