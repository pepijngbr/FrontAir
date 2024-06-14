<template>
    <section class="py-20">
        <h1><i class="bi bi-ticket"></i> My Bookings</h1>
        <p>Here you can see all your bookings.</p>
        <p>
            If the status of a booking is "booked", the flight can not be
            cancelled.
        </p>
    </section>
    <section v-if="bookings.length > 0 && this.userStore.isLoggedIn == true">
        <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
            <div
                class="card bordered shadow-lg"
                :class="theme == 'frontair' ? '' : 'shadow-white/30'"
                v-for="booking in this.bookings"
                :key="booking.id"
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
                    <div class="grid grid-cols-2">
                        <p>Airline: {{ booking.flight.airline.name }}</p>
                        <!--                    <p>-->
                        <!--                        Departure: {{ booking.flight.departure_airport.name }}-->
                        <!--                    </p>-->
                        <!--                    <p>Arrival: {{ booking.flight.arrival_airport.name }}</p>-->
                        <!--                    <p>Departure Time: {{ booking.flight.departure_time }}</p>-->
                        <!--                    <p>Arrival Time: {{ booking.flight.arrival_time }}</p>-->
                        <p>Seat Number: {{ booking.seat_number }}</p>
                        <p>Class: {{ booking.class }}</p>
                        <p>Type: {{ booking.type }}</p>
                        <p>Price: €{{ booking.price }}</p>
                        <p>Booking status: {{ booking.booking_status }}</p>
                    </div>

                    <button
                        v-if="booking.booking_status == 'pending'"
                        class="btn btn-error"
                        @click="cancelBooking(booking.id)"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section v-else>
        <p v-if="bookings.length == 0 && this.userStore.isLoggedIn == true">
            It's empty in here.. try booking a
            <RouterLink :to="{ name: 'flights' }" class="text-primary underline"
                >Flight
            </RouterLink>
            !
        </p>
        <div v-if="this.userStore.isLoggedIn == false">
            <p>
                Please log in to view your bookings or register to start
                booking.
            </p>
            <RouterLink :to="{ name: 'login' }" class="text-primary underline"
                >Login
            </RouterLink>
            <RouterLink :to="{ name: 'register' }" class="btn btn-primary"
                >Register
            </RouterLink>
        </div>
    </section>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { RouterLink } from 'vue-router';
import { useSiteThemeStore } from '@/stores/siteTheme.js';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'BookingsView',
    components: {
        RouterLink,
    },
    data() {
        return {
            bookings: [],
            userStore: useUserStore(),
        };
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
                        // const updatedWallet = useUserStore().user.wallet + ;
                        // const data = {
                        //     wallet: updatedWallet,
                        // };
                        // axios
                        //     .put(apiUrl + '/users/' + userStore.user.id, data)
                        //     .then((response) => {
                        //         console.log(response.data);
                        //         userStore.updateUser(response.data);
                        //     })
                        //     .catch((error) => {
                        //         console.error(error);
                        //     });
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            } else {
                return;
            }
        },
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
};
</script>
