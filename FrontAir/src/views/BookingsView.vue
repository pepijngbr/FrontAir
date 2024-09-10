<template>
    <section class="py-20">
        <h1><i class="bi bi-ticket" /> My Bookings</h1>
        <p>Here you can see all your bookings.</p>
        <p>
            If the status of a booking is "booked", the flight can not be
            cancelled.
        </p>
    </section>
    <section
        v-if="bookings.length > 0 && userStore.isLoggedIn == true"
        class="mb-20"
    >
        <div
            class="grid grid-cols-1 gap-4 p-0 sm:p-4 md:grid-cols-2 xl:grid-cols-3"
        >
            <div
                v-for="booking in bookings"
                :key="booking.id"
                class="card bordered shadow-lg"
                :class="theme == 'frontair' ? '' : 'shadow-white/30'"
            >
                <figure>
                    <img
                        class="h-60 w-full object-cover object-center"
                        :src="
                            '../src/assets/images/airlines/' +
                            booking.flight.airline.name
                                .toLowerCase()
                                .replace(/\s/g, '_') +
                            '/' +
                            booking.flight.image +
                            '.webp'
                        "
                        :alt="
                            booking.flight.airline.name != null
                                ? booking.flight.airline.name
                                : 'Image of Airline'
                        "
                    />
                </figure>

                <div class="card-header relative">
                    <div class="absolute left-0 right-0 top-0 mt-4">
                        <img
                            class="h-12 w-full"
                            :src="
                                '../src/assets/images/airlines/' +
                                booking.flight.airline.name
                                    .toLowerCase()
                                    .replace(/\s/g, '_') +
                                '.svg'
                            "
                            :alt="
                                booking.flight.airline.name != null
                                    ? booking.flight.airline.name
                                    : 'Image of Airline'
                            "
                        />
                    </div>
                </div>
                <div class="card-body mt-20">
                    <div
                        class="grid grid-cols-2 gap-2 sm:grid-cols-4 [&>*]:text-center"
                    >
                        <div>
                            <p class="text-lg font-bold">Status</p>
                            <p>{{ booking.booking_status }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold">Class</p>
                            <p>{{ booking.class }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold">Type</p>
                            <p>{{ booking.type }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold">Airline</p>
                            <p>{{ booking.flight.airline.name }}</p>
                        </div>
                    </div>
                    <div class="divider my-2" />
                    <div class="mb-4 grid grid-cols-1 gap-2 sm:grid-cols-2">
                        <div class="flex flex-col">
                            <p class="text-lg font-bold">From</p>
                            <p>
                                {{ booking.flight.departure_airport.name }}
                            </p>
                            <p>
                                {{ booking.flight.departure_airport.city }},
                                {{ booking.flight.departure_airport.country }}
                            </p>
                            <p>
                                {{ formatDate(booking.flight.departure_time) }}
                            </p>
                        </div>
                        <div class="flex flex-col text-left sm:text-right">
                            <p class="text-lg font-bold">To</p>
                            <p>
                                {{ booking.flight.arrival_airport.name }}
                            </p>
                            <p>
                                {{ booking.flight.arrival_airport.city }},
                                {{ booking.flight.arrival_airport.country }}
                            </p>
                            <p>{{ formatDate(booking.flight.arrival_time) }}</p>
                        </div>
                    </div>
                    <p class="text-center text-2xl font-bold">Ticket</p>
                    <BarcodeLabel
                        v-show="booking.booking_status == 'booked'"
                        :value="
                            booking.user_id +
                            '' +
                            booking.flight.departure_airport.id +
                            '' +
                            booking.flight.arrival_airport.id +
                            booking.flight.flight_number +
                            booking.id
                        "
                    />
                    <button
                        v-if="booking.booking_status == 'pending'"
                        class="btn btn-success absolute left-4 top-4"
                        @click="confirmBooking(booking.id)"
                    >
                        Confirm
                    </button>
                    <button
                        v-if="booking.booking_status == 'pending'"
                        class="btn btn-error absolute right-4 top-4"
                        @click="cancelBooking(booking.id)"
                    >
                        Cancel
                    </button>
                    <div class="card-actions mt-auto items-end justify-end">
                        <p class="text-center text-2xl font-bold sm:text-left">
                            Price: €{{ booking.price }}
                        </p>
                        <RouterLink
                            class="btn btn-info w-full sm:w-1/2 md:w-auto"
                            :to="{
                                name: 'bookings.show',
                                params: { id: booking.id },
                            }"
                        >
                            More details
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section v-else>
        <p v-if="bookings.length == 0 && userStore.isLoggedIn == true">
            It's empty in here.. try booking a
            <RouterLink
                :to="{ name: 'flights' }"
                class="text-primary underline"
            >
                Flight
            </RouterLink>
            !
        </p>
        <div v-if="userStore.isLoggedIn == false">
            <p>
                Please log in to view your bookings or register to start
                booking.
            </p>
            <RouterLink :to="{ name: 'login' }" class="text-primary underline">
                Login
            </RouterLink>
            <RouterLink :to="{ name: 'register' }" class="btn btn-primary">
                Register
            </RouterLink>
        </div>
    </section>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useUserStore } from '@/stores/user.js';
import { RouterLink } from 'vue-router';
import BarcodeLabel from '@/components/BarcodeLabel.vue';
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'BookingsView',
    components: {
        RouterLink,
        BarcodeLabel,
    },
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;

        useHead({
            title: 'Bookings - FrontAir',
            link: [
                {
                    rel: 'canonical',
                    href: canonicalUrl,
                },
            ],
            meta: [
                {
                    name: 'description',
                    content:
                        'The bookings page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'bookings, booked flights, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Bookings - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The bookings page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    property: 'og:type',
                    content: 'website',
                },
                {
                    property: 'og:url',
                    content: 'https://www.frontair.nl',
                },
                {
                    property: 'og:image',
                    content:
                        'https://www.frontair.nl/images/frontair_logo.webp',
                },
            ],
        });
    },
    data() {
        return {
            bookings: [],
            userStore: useUserStore(),
        };
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
    mounted() {
        this.retrieveBookings();
    },
    methods: {
        retrieveBookings() {
            const userStore = useUserStore();
            if (userStore.isLoggedIn) {
                console.log(userStore.user.id);
                axios
                    .get(
                        apiUrl +
                            '/users/' +
                            userStore.user.id +
                            '/bookings?sort_by=id&sort_order=desc',
                    )
                    .then((response) => {
                        this.bookings = response.data.bookings;
                        console.log(this.bookings);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                return console.log('User is logged in, retrieving bookings');
            } else {
                console.log('User is not logged in');
            }
        },
        cancelBooking(booking_id) {
            const userStore = useUserStore();
            if (confirm('Are you sure you want to cancel this booking?')) {
                axios
                    .delete(apiUrl + '/bookings/' + booking_id)
                    .then((response) => {
                        console.log(response.data);
                        this.retrieveBookings();
                        const updatedWallet =
                            Number(userStore.user.wallet) +
                            Number(response.data.flight.price);
                        const userData = {
                            wallet: parseFloat(updatedWallet).toFixed(2),
                        };

                        // Add Flight price back to user wallet after cancelling
                        axios
                            .put(
                                apiUrl + '/users/' + userStore.user.id,
                                userData,
                            )
                            .then((response) => {
                                console.log(response.data);
                                userStore.updateUser(response.data);
                            })
                            .catch((error) => {
                                console.error(error);
                            });

                        const flightData = {
                            available_seats:
                                response.data.flight.available_seats + 1,
                        };

                        // Add available seats back with +1 because of cancelling
                        axios
                            .put(
                                apiUrl + '/flights/' + response.data.flight.id,
                                flightData,
                            )
                            .then((response) => {
                                console.log(response.data);
                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            } else {
                return;
            }
        },
        confirmBooking(booking_id) {
            if (confirm('Are you sure you want to confirm this booking?')) {
                const data = {
                    booking_status: 'booked',
                };
                axios
                    .put(apiUrl + '/bookings/' + booking_id, data)
                    .then((response) => {
                        console.log(response.data);
                        this.retrieveBookings();
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            } else {
                return;
            }
        },
        formatDate(datetime) {
            const date = new Date(datetime);
            return date.toLocaleDateString('nl-NL', {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                timeZone: 'GMT',
            });
        },
    },
};
</script>
