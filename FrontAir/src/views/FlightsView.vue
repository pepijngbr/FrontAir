<template>
    <section class="mb-4 pt-20 text-center md:text-left">
        <div class="flex justify-center gap-4 md:justify-start">
            <h1>Flight Schedule</h1>
        </div>
        <p>View our Flight Schedule below and book a flight!</p>
        <div class="mx-auto mb-12 mt-4 flex max-w-[400px] flex-col md:mx-0">
            <div class="collapse collapse-arrow mr-auto bg-base-200">
                <input type="checkbox" name="checkbox" />
                <div class="collapse-title text-xl font-medium">Filters</div>
                <div class="collapse-content text-center md:text-left">
                    <p class="font-bold">Destination</p>
                    <select
                        class="select select-bordered w-1/2 border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                        v-model="this.departure_airport"
                    >
                        <option disabled>From</option>
                        <option value="0" selected>Any</option>
                        <option
                            v-for="airport in this.airports"
                            :key="airport.id"
                            :value="airport.id"
                            v-show="this.arrival_airport != airport.id"
                        >
                            {{ airport.country }}, {{ airport.name }} ({{
                                airport.iata
                            }})
                        </option>
                    </select>
                    <select
                        class="select select-bordered w-1/2 border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                        v-model="this.arrival_airport"
                    >
                        <option disabled>To</option>
                        <option value="0" selected>Any</option>
                        <option
                            v-for="airport in this.airports"
                            :key="airport.id"
                            :value="airport.id"
                            v-show="this.departure_airport != airport.id"
                        >
                            {{ airport.country }}, {{ airport.name }} ({{
                                airport.iata
                            }})
                        </option>
                    </select>
                    <p class="mt-4 font-bold">Airline</p>
                    <select
                        class="select select-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                        v-model="this.airline"
                    >
                        <option value="0" selected>All</option>
                        <option
                            v-for="airline in this.airlines"
                            :value="airline.id"
                            :key="airline.id"
                        >
                            {{ airline.name }}
                        </option>
                    </select>
                    <p class="mt-4 font-bold">Date selection</p>
                    <div class="relative max-w-sm">
                        <div
                            class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5"
                        >
                            <i class="bi bi-calendar-fill text-lg"></i>
                        </div>
                        <input
                            type="text"
                            class="block w-full rounded-lg border p-2.5 ps-10 text-sm caret-primary transition-colors focus:border-primary focus:outline-none focus:ring-blue-500"
                            placeholder="Select date"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div
        v-if="this.flights.length > 0 && !this.loading"
        class="grid auto-rows-fr grid-cols-12 gap-4 px-4"
    >
        <div
            v-for="flight in this.flights"
            :key="flight.id"
            class="group card col-span-12 min-h-[443px] bg-base-100 shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
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
                        class="hover:underline"
                    >
                        {{
                            flight.flight_number.toUpperCase() +
                            ' - ' +
                            flight.airline.name
                        }}
                    </RouterLink>
                </h2>
                <div
                    class="relative flex justify-between rounded-lg bg-base-200 px-4"
                >
                    <div class="p-1 text-center lg:col-span-2">
                        <p class="text-2xl">
                            {{ flight.departure_airport.iata }}
                        </p>

                        <p class="text-xs">
                            {{ flight.departure_airport.name }},<br />
                            {{ flight.departure_airport.country }}
                        </p>
                        <p class="mt-4 hidden lg:block">
                            {{ formatDate(flight.departure_time) }}
                        </p>
                    </div>
                    <div
                        class="mt-3 flex h-10 w-10 rotate-90 items-center justify-center"
                    >
                        <i class="bi bi-airplane-fill"></i>
                    </div>
                    <div class="p-1 text-center lg:col-span-2">
                        <p class="text-2xl">
                            {{ flight.arrival_airport.iata }}
                        </p>

                        <p class="text-xs">
                            {{ flight.arrival_airport.name }},<br />
                            {{ flight.arrival_airport.country }}
                        </p>
                        <p class="mt-4 hidden lg:block">
                            {{ formatDate(flight.arrival_time) }}
                        </p>
                    </div>
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
                        >Login to book
                    </RouterLink>
                    <RouterLink
                        v-else
                        :to="{
                            name: 'bookings.index',
                        }"
                        class="btn btn-warning w-full sm:w-1/2 md:w-auto"
                        >View booking
                    </RouterLink>
                </div>
            </div>
        </div>
    </div>
    <div
        v-else-if="this.flights.length === 0 && !this.loading"
        class="h-screen w-full text-center"
    >
        <p>No flights found.</p>
    </div>
    <div v-else class="grid auto-rows-fr grid-cols-12 gap-4 px-4">
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
        <div
            class="card skeleton col-span-12 min-h-[443px] shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-3"
        ></div>
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
import { RouterLink, useRoute } from 'vue-router';
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
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;

        useHead({
            title: 'Flights - FrontAir',
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
                        'The flight schedule page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'flight schedule, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Flights - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The flight schedule page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
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
            flights: [],
            airports: [],
            airlines: [],
            bookings: [],
            airline: '',
            departure_airport: '',
            arrival_airport: '',
            date: '',
            limit: 10,
            loading: true,
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
        departure_airport: function () {
            this.retrieveFlights();
        },
        arrival_airport: function () {
            this.retrieveFlights();
        },
    },
    methods: {
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
        retrieveFlights() {
            axios
                .get(
                    apiUrl +
                        '/flights?sort_by=id&sort_order=DESC&limit=' +
                        this.limit +
                        '&airline_id=' +
                        this.airline +
                        '&departure_airport_id=' +
                        this.departure_airport +
                        '&arrival_airport_id=' +
                        this.arrival_airport,
                )
                .then((response) => {
                    console.log(response.data);
                    this.flights = response.data;
                })
                .catch((error) => {
                    console.error(error);
                })
                .finally(() => {
                    this.loading = false;
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
