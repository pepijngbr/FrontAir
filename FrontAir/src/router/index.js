import { createRouter, createWebHistory } from 'vue-router';

// Layouts
// import DefaultLayout from '../layouts/DefaultLayout.vue'
import DashboardLayout from '../layouts/DashboardLayout.vue';
// import AuthLayout from '../layouts/AuthLayout.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        //   TODO: Make use of the default layout
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
            // children: [
            //   {
            //     path: ':id', // having an empty path will make this the default route
            //     name: 'flights.show',
            //     component: () => import('../views/FlightsShow.vue')
            //   },
            // ]
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
        },

        // TODO: add authentication guard for bookings
        {
            path: '',
            name: 'bookings',
            children: [
                {
                    path: 'bookings',
                    name: 'bookings.index',
                    component: () => import('../views/BookingsView.vue'),
                },
                {
                    path: 'bookings/:id',
                    name: 'bookings.show',
                    component: () => import('../views/BookingsShow.vue'),
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
        },
        {
            path: '',
            name: 'auth',
            component: () => import('../layouts/AuthLayout.vue'),
            children: [
                {
                    path: 'login',
                    name: 'login',
                    component: () => import('../views/auth/LoginView.vue'),
                },
                {
                    path: 'register',
                    name: 'register',
                    component: () => import('../views/auth/RegisterView.vue'),
                },
                {
                    path: 'reset-password',
                    name: 'reset-password',
                    component: () =>
                        import('../views/auth/ResetPasswordView.vue'),
                },
            ],
        },
        // TODO: Add authentication guard for dashboard
        {
            path: '/dashboard',
            name: 'dashboard',
            meta: { requiresAuth: true, layout: DashboardLayout },
            // component: () => import('../layouts/DashboardLayout.vue'),
            children: [
                {
                    path: '', // having an empty path will make this the default child route
                    name: 'dashboard.overview',
                    component: () =>
                        import('../views/dashboard/OverviewView.vue'),
                },
                {
                    path: 'analytics',
                    name: 'dashboard.analytics',
                    component: () =>
                        import('../views/dashboard/AnalyticsView.vue'),
                },
                {
                    path: 'users',
                    name: 'dashboard.users',
                    children: [
                        {
                            path: '',
                            name: 'dashboard.users.index',
                            component: () =>
                                import(
                                    '../views/dashboard/users/UsersView.vue'
                                ),
                        },
                        {
                            path: ':id',
                            name: 'dashboard.users.show',
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

export default router;
