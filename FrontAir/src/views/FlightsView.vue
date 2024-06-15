<template>
    <section class="mb-4 pt-20 text-center md:text-left">
        <div class="flex justify-center gap-4 md:justify-start">
            <img
                src="../assets/images/FrontAir_Aeroplane_V2.webp"
                class="hidden h-14"
                alt="FrontAir Airplane"
            />
            <h1>Flight Schedule</h1>
        </div>
        <p>View our Flight Schedule below and book a flight!</p>
        <div
            v-if="this.flights.length > 0"
            class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col md:mx-0"
        >
            <div class="collapse collapse-arrow mr-auto bg-base-200">
                <input type="checkbox" />
                <div class="collapse-title text-xl font-medium">Filters</div>
                <div class="collapse-content text-center md:text-left">
                    <p class="font-bold">Destination</p>
                    <select class="select select-bordered w-1/2">
                        <option disabled selected>From</option>
                        <option
                            v-for="airport in this.airports"
                            :key="airport.id"
                        >
                            {{ airport.name }} ({{ airport.icao }})
                        </option>
                    </select>
                    <select class="select select-bordered w-1/2">
                        <option disabled selected>To</option>
                        <option
                            v-for="airport in this.airports"
                            :key="airport.id"
                        >
                            {{ airport.name }} ({{ airport.icao }})
                        </option></select
                    ><br /><br />
                    <p class="font-bold">Airline</p>
                    <select
                        class="select select-bordered w-full"
                        v-model="this.airline"
                    >
                        <option value="0" selected>All</option>
                        <option
                            v-for="airline in this.airlines"
                            :value="airline.id"
                            :key="airline.id"
                        >
                            {{ airline.name }}
                        </option></select
                    ><br /><br />
                    <p class="font-bold">Date selection</p>
                    <div class="relative max-w-sm">
                        <div
                            class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5"
                        >
                            <i
                                class="bi bi-calendar-fill text-lg text-gray-500 dark:text-gray-400"
                            ></i>
                        </div>
                        <input
                            type="text"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="Select date"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div
        v-if="this.flights.length > 0"
        class="grid auto-rows-fr grid-cols-12 gap-4 px-4"
    >
        <div
            v-for="flight in this.flights"
            :key="flight.id"
            class="group card col-span-12 bg-base-100 shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
            :class="theme == 'frontair' ? '' : 'shadow-white/30'"
        >
            <figure>
                <img
                    class="h-60 w-full object-cover object-center"
                    :src="
                        '../src/assets/images/airlines/' +
                        flight.airline.name.toLowerCase().replace(/\s/g, '_') +
                        '/' +
                        flight.image +
                        '.webp'
                    "
                    :alt="
                        flight.airline.name != null
                            ? flight.airline.name
                            : 'Image of Airline'
                    "
                />
            </figure>
            <div class="card-body">
                <h2 class="card-title justify-center">
                    <RouterLink
                        :to="{
                            name: 'flights.show',
                            params: { id: flight.id },
                        }"
                    >
                        {{
                            flight.airline.name +
                            ' - ' +
                            flight.flight_number.toUpperCase()
                        }}
                    </RouterLink>
                </h2>
                <div class="card-body">
                    {{ flight.departure_airport.name }} ({{
                        flight.departure_airport.icao
                    }}) - {{ flight.arrival_airport.name }} ({{
                        flight.arrival_airport.icao
                    }})<br />
                    {{ flight.departure_time }} - {{ flight.arrival_time
                    }}<br />
                    {{ flight.available_seats }} seats available<br />
                </div>
                <div class="card-actions items-end justify-between">
                    <b
                        class="w-full text-center text-4xl sm:w-1/3 sm:text-left md:w-auto"
                        >€{{ flight.price
                        }}<span class="text-lg font-normal">/pp</span></b
                    >
                    <RouterLink
                        v-if="user.isLoggedIn && !isFlightBooked(flight.id)"
                        :to="{
                            name: 'flights.show',
                            params: { id: flight.id },
                        }"
                        class="btn btn-primary w-full sm:w-1/2 md:w-auto"
                    >
                        Book Flight
                    </RouterLink>
                    <RouterLink
                        v-else-if="!user.isLoggedIn"
                        :to="{ name: 'login' }"
                        class="btn btn-warning w-full sm:w-1/2 md:w-auto"
                        >Login to book</RouterLink
                    >
                    <div v-else>
                        <p>Flight already booked.</p>
                        <RouterLink
                            :to="{
                                name: 'bookings.index',
                            }"
                            class="btn btn-warning w-full sm:w-1/2 md:w-auto"
                            >View booked flight
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="h-screen p-4 text-center">
        <p>No flights available.</p>
    </div>
    <div
        v-if="this.flights && this.limit <= this.flights.length"
        class="mb-12 mt-4 flex flex-col items-center justify-center"
    >
        <p>Current limit: {{ this.limit }}</p>
        <button @click="flightLimit(+10)" class="btn btn-secondary">
            View More
        </button>
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useUserStore } from '@/stores/user.js';
import { RouterLink } from 'vue-router';
import { useHead } from '@vueuse/head';

const userStore = useUserStore();

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'FlightsView',
    components: {
        RouterLink,
    },
    setup() {
        useHead({
            title: 'Flights - FrontAir',
            meta: [],
        });
    },
    data() {
        return {
            flights: [],
            airports: [],
            airlines: [],
            bookings: [],
            date_from: '', // filter
            date_to: '', // filter
            airline: '', // filter
            limit: 10,
        };
    },
    mounted() {
        this.retrieveAirlines();
        this.retrieveAirports();
        if (userStore.user) {
            this.retrieveBookings();
        }
        this.retrieveFlights();
    },
    watch: {
        airline: function () {
            this.retrieveFlights();
        },
    },
    methods: {
        retrieveFlights() {
            // axios.get(apiUrl + '/flights?limit=' + this.limit + '&date_from=' + this.date_from + '&date_to=' + this.date_to + '&airline=' + this.airline)
            axios
                .get(
                    apiUrl +
                        '/flights?sort_by=id&sort_order=DESC&limit=' +
                        this.limit +
                        '&airline_id=' +
                        this.airline,
                )
                .then((response) => {
                    console.log(response.data);
                    this.flights = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        retrieveAirports() {
            axios
                .get(apiUrl + '/airports')
                .then((response) => {
                    console.log(response.data);
                    this.airports = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        retrieveAirlines() {
            axios
                .get(apiUrl + '/airlines')
                .then((response) => {
                    console.log(response.data);
                    this.airlines = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        flightLimit(limit) {
            this.limit += limit;
            this.retrieveFlights();
        },
        retrieveBookings() {
            axios
                .get(apiUrl + '/users/' + userStore.user.id + '/bookings')
                .then((response) => {
                    console.log(response.data);
                    this.bookings = response.data.bookings;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        isFlightBooked(flight_id) {
            // this.bookings.forEach((booking) => {
            //     if (booking.flight_id === flight_id) {
            //         return true;
            //     }
            // });

            if (this.bookings.length > 0) {
                for (let i = 0; i < this.bookings.length; i++) {
                    if (this.bookings[i].flight_id == flight_id) {
                        console.log('found e');
                        return true;
                    }
                }
            } else {
                return false;
            }

            // return this.bookings.some(
            //     (booking) => booking.flight_id === flight_id,
            // );

            // return (
            //     this.bookings.find(
            //         (booking) => booking.flight_id === flight_id,
            //     ) !== undefined
            // );
        },
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
        user() {
            return userStore;
        },
    },
};
</script>
