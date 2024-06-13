import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '@/stores/user.js';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '',
            children: [
                {
                    path: '',
                    name: 'home',
                    component: () => import('../views/HomeView.vue'),
                },
            ],
        },
        {
            path: '/flights',
            name: 'flights',
            component: () => import('../views/FlightsView.vue'),
        },
        {
            path: '/flights/:id',
            name: 'flights.show',
            component: () => import('../views/FlightsShow.vue'),
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('../views/AboutView.vue'),
        },
        {
            path: '/contact',
            name: 'contact',
            component: () => import('../views/ContactView.vue'),
        },
        {
            path: '/wallet',
            name: 'wallet',
            component: () => import('../views/WalletView.vue'),
            // meta: { requiresAuth: true },
        },
        {
            path: '',
            name: 'bookings',
            // meta: { requiresAuth: true },
            children: [
                {
                    path: 'bookings',
                    name: 'bookings.index',
                    component: () => import('../views/BookingsView.vue'),
                    // meta: { requiresAuth: true },
                },
                {
                    path: 'bookings/:id',
                    name: 'bookings.show',
                    component: () => import('../views/BookingsShow.vue'),
                    // meta: { requiresAuth: true },
                },
            ],
        },
        {
            path: '/store',
            name: 'store',
            component: () => import('../views/StoreView.vue'),
            children: [
                {
                    path: ':id',
                    name: 'store.show',
                    component: () => import('../views/StoreShow.vue'),
                },
            ],
        },
        {
            path: '/profile',
            name: 'profile',
            component: () => import('../views/ProfileView.vue'),
            // meta: { requiresAuth: true },
        },
        {
            path: '',
            name: 'auth',
            children: [
                {
                    path: 'login',
                    name: 'login',
                    component: () => import('../views/auth/LoginView.vue'),
                    // meta: { requiresGuest: true },
                },
                {
                    path: 'register',
                    name: 'register',
                    component: () => import('../views/auth/RegisterView.vue'),
                    // meta: { requiresGuest: true },
                },
                {
                    path: 'reset-password',
                    name: 'reset-password',
                    component: () =>
                        import('../views/auth/ResetPasswordView.vue'),
                },
            ],
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            meta: { requiresAuth: true },
            children: [
                {
                    path: '', // having an empty path will make this the default child route
                    name: 'dashboard.overview',
                    meta: { requiresAuth: true },
                    component: () =>
                        import('../views/dashboard/OverviewView.vue'),
                },
                {
                    path: 'analytics',
                    name: 'dashboard.analytics',
                    meta: { requiresAuth: true },
                    component: () =>
                        import('../views/dashboard/AnalyticsView.vue'),
                },
                {
                    path: 'users',
                    name: 'dashboard.users',
                    meta: { requiresAuth: true },
                    children: [
                        {
                            path: '',
                            name: 'dashboard.users.index',
                            meta: { requiresAuth: true },
                            component: () =>
                                import(
                                    '../views/dashboard/users/UsersView.vue'
                                ),
                        },
                        {
                            path: ':id',
                            name: 'dashboard.users.show',
                            meta: { requiresAuth: true },
                            component: () =>
                                import(
                                    '../views/dashboard/users/UsersShow.vue'
                                ),
                        },
                    ],
                },
            ],
        },
    ],
});

// Authentication for each route that has the meta "requiresAuth" (pages that require user information) or "requiresGuest" (login & register pages)
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!useUserStore().loadUser()) {
            // Redirect to login page if not authenticated
            next({ name: 'login' });
        } else {
            next();
        }
    }
    // else if (to.matched.some((record) => record.meta.requiresGuest)) {
    //     if (useUserStore().loadUser()) {
    //         // Redirect to home page if authenticated
    //         next({ name: 'home' });
    //     } else {
    //         next();
    //     }
    // }
    else {
        next();
    }
});

export default router;
