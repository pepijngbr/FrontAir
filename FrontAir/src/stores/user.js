import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
    state: () => ({
        user: JSON.parse(localStorage.getItem('user')) || null,
        isLoggedIn: localStorage.getItem('user') ? true : false,
    }),
    actions: {
        setUser(user) {
            this.user = user;
            this.isLoggedIn = true;
            localStorage.setItem('user', JSON.stringify(user));
        },
        async updateUser(updatedUser) {
            this.user = updatedUser;
            localStorage.setItem('user', JSON.stringify(updatedUser));
        },
        logout() {
            this.user = null;
            this.isLoggedIn = false;
            localStorage.removeItem('user');
        },
        loadUser() {
            const user = localStorage.getItem('user');
            if (user) {
                this.user = JSON.parse(user);
                this.isLoggedIn = true;
            } else {
                return false;
            }
        },
        addLoyaltyPoints(points) {
            this.user.loyalty_points += points;
            localStorage.setItem('user', JSON.stringify(this.user));
        },
    },
    mounted() {
        this.loadUser();
    },
});
