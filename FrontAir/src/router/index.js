import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '@/stores/user.js';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    scrollBehavior(to, from, savedPosition) {
        return {
            top: 0,
            behavior: 'smooth',
        };
    },
    routes: [
        {
            path: '',
            name: 'home',
            component: () => import('../views/HomeView.vue'),
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
            meta: { requiresAuth: true },
            component: () => import('../views/WalletView.vue'),
        },
        {
            path: '/bookings',
            name: 'bookings.index',
            meta: { requiresAuth: true },
            component: () => import('../views/BookingsView.vue'),
        },
        {
            path: '/bookings/:id',
            name: 'bookings.show',
            meta: { requiresAuth: true },
            component: () => import('../views/BookingsShow.vue'),
        },
        {
            path: '/store',
            name: 'store',
            component: () => import('../views/StoreView.vue'),
        },
        {
            path: '/store/:id',
            name: 'store.show',
            component: () => import('../views/StoreShow.vue'),
        },
        {
            path: '/profile',
            name: 'profile',
            meta: { requiresAuth: true },
            component: () => import('../views/ProfileView.vue'),
        },
        {
            path: '/login',
            name: 'login',
            meta: { requiresGuest: true },
            component: () => import('../views/auth/LoginView.vue'),
        },
        {
            path: '/register',
            name: 'register',
            meta: { requiresGuest: true },
            component: () => import('../views/auth/RegisterView.vue'),
        },
        {
            path: '/reset-password',
            name: 'reset-password',
            component: () => import('../views/auth/ResetPasswordView.vue'),
        },
        // TODO: Dashboard (maybe another time)
        {
            path: '/dashboard',
            name: 'dashboard.overview',
            meta: { requiresAuth: true },
            component: () => import('../views/dashboard/OverviewView.vue'),
        },
        {
            path: '/dashboard/analytics',
            name: 'dashboard.analytics',
            meta: { requiresAuth: true },
            component: () => import('../views/dashboard/AnalyticsView.vue'),
        },
        {
            path: '/dashboard/users',
            name: 'dashboard.users.index',
            meta: { requiresAuth: true },
            component: () => import('../views/dashboard/users/UsersView.vue'),
        },
        {
            path: '/dashboard/users/:id',
            name: 'dashboard.users.show',
            meta: { requiresAuth: true },
            component: () => import('../views/dashboard/users/UsersShow.vue'),
        },
        {
            path: '/refund-policy',
            name: 'policy.refund',
            component: () => import('../views/RefundPolicyView.vue'),
        },
        {
            path: '/privacy-policy',
            name: 'policy.privacy',
            component: () => import('../views/PrivacyPolicyView.vue'),
        },
        {
            path: '/terms-of-service',
            name: 'tos.index',
            component: () => import('../views/TermsOfServiceView.vue'),
        },
    ],
});

// Authentication for each route that has the meta "requiresAuth" (pages that require user information) or "requiresGuest" (login & register pages)
router.beforeEach((to, from, next) => {
    const userStore = useUserStore();
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!userStore.isLoggedIn) {
            // Redirect to login page if not authenticated
            next({ name: 'login' });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.requiresGuest)) {
        if (userStore.isLoggedIn) {
            // Redirect to home page if authenticated
            next({ name: 'home' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
