<template>
    <section
        class="bg-base-400 flex h-[calc(100vh-63px)] items-center justify-center gap-20"
    >
        <div class="max-w-screen flex flex-col items-center gap-4 lg:flex-row">
            <div
                class="flex w-auto flex-col items-center gap-2 text-center sm:w-[650px] md:items-start md:text-left"
            >
                <h1>
                    Fly with Ease,<br />
                    Book with Breeze!
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Tincidunt dui ut ornare lectus sit amet. Ultricies
                    mi quis hendrerit dolor magna eget.
                </p>
                <RouterLink :to="{ name: 'flights' }" class="btn btn-primary">
                    Book Now
                </RouterLink>
            </div>
            <img
                :srcset="
                    '../src/assets/images/FrontAir_Aeroplane_V2' +
                    (theme == 'frontair' ? '' : '_White') +
                    '.webp'
                "
                class="mx-auto hidden h-[250px] md:block lg:h-[300px]"
                alt="FrontAir Logo"
            />
        </div>
    </section>
    <section class="py-20">
        <div class="text-center">
            <h2>Flight Schedule</h2>
            <p>Book your flights using the Flight Schedule below!</p>
        </div>
        <div
            v-if="this.flights.length > 0 && !this.loading"
            class="mt-8 grid auto-rows-fr grid-cols-12 gap-4"
        >
            <div
                v-for="flight in this.flights"
                :key="flight.id"
                class="group card col-span-12 min-h-[443px] bg-base-100 shadow-lg md:col-span-6 xl:col-span-4 2xl:col-span-4"
                :class="theme == 'frontair' ? '' : 'shadow-white/30'"
            >
                <figure>
                    <img
                        class="h-60 w-full object-cover object-center"
                        :srcset="
                            '../src/assets/images/airlines/' +
                            flight.airline.name
                                .toLowerCase()
                                .replace(/\s/g, '_') +
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
                                flight.airline.name +
                                ' - ' +
                                flight.flight_number.toUpperCase()
                            }}
                        </RouterLink>
                    </h2>
                    <div
                        class="relative flex justify-between rounded-lg bg-base-200 px-2"
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
        <div v-else class="mt-8 grid auto-rows-fr grid-cols-12 gap-4">
            <div
                class="skeleton col-span-12 min-h-[443px] md:col-span-6 xl:col-span-4 2xl:col-span-4"
            ></div>
            <div
                class="skeleton col-span-12 min-h-[443px] md:col-span-6 xl:col-span-4 2xl:col-span-4"
            ></div>
            <div
                class="skeleton col-span-12 min-h-[443px] md:col-span-6 xl:col-span-4 2xl:col-span-4"
            ></div>
        </div>
        <div class="mt-4 flex justify-center">
            <RouterLink :to="{ name: 'flights' }" class="btn btn-secondary"
                >View More
            </RouterLink>
        </div>
    </section>
    <section class="mx-auto max-w-[900px] py-32">
        <div class="text-center">
            <h2>About Us</h2>
            <div
                class="grid grid-cols-1 gap-12 sm:grid-cols-2 sm:gap-4 md:grid-cols-3"
            >
                <div class="avatar flex-col text-center">
                    <div class="mb-2 h-full w-full rounded-xl sm:h-[400px]">
                        <img
                            srcset="
                                @/assets/images/linkedin-sales-solutions-pAtA8xe_iVM-unsplash.webp
                            "
                            alt="Marcus Stevens"
                            width="400"
                            height="400"
                        />
                    </div>
                    <p class="text-lg">Marcus Stevens</p>
                    <p class="text-sm opacity-75">IT Manager</p>
                </div>
                <div class="avatar flex-col text-center">
                    <div class="mb-2 h-full w-full rounded-xl sm:h-[400px]">
                        <img
                            srcset="
                                @/assets/images/albert-dera-ILip77SbmOE-unsplash.webp
                            "
                            alt="Jameson Reid"
                            width="400"
                            height="400"
                        />
                    </div>
                    <p class="text-lg">Jameson Reid</p>
                    <p class="text-sm opacity-75">Marketing Manager</p>
                </div>
                <div class="avatar flex-col text-center">
                    <div class="mb-2 h-full w-full rounded-xl sm:h-[400px]">
                        <img
                            srcset="
                                @/assets/images/anthony-tran-3Xkms-gMvZg-unsplash.webp
                            "
                            alt="Lily Chen"
                            width="400"
                            height="400"
                        />
                    </div>
                    <p class="text-lg">Lily Chen</p>
                    <p class="text-sm opacity-75">
                        Media and Communications Specialist
                    </p>
                </div>
            </div>
            <p class="mt-8">Learn more about FrontAir and our mission!</p>
            <RouterLink to="about" class="btn btn-secondary mt-4"
                >About us
            </RouterLink>
        </div>
    </section>
    <section class="py-32">
        <div class="text-center">
            <h2>Contact Us</h2>
            <p>Get in touch with us!</p>
            <RouterLink to="contact" class="btn btn-secondary mt-4"
                >Contact us
            </RouterLink>
        </div>
    </section>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useUserStore } from '@/stores/user.js';
import { RouterLink } from 'vue-router';
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';

const userStore = useUserStore();

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'HomeView',
    components: {
        RouterLink,
    },
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;
        useHead({
            title: 'Home - FrontAir',
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
                        'The home page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'home, landing page, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Home - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The home page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
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
            bookings: [],
            loading: true,
        };
    },
    mounted() {
        this.retrieveFlights();
        if (userStore.user) {
            this.retrieveBookings();
        }
    },
    methods: {
        retrieveFlights() {
            axios
                .get(apiUrl + '/flights?sort_by=id&sort_order=DESC&limit=3')
                .then((response) => {
                    console.log(response.data);
                    this.flights = response.data;
                })
                .catch((e) => {
                    console.log(e);
                })
                .finally(() => {
                    this.loading = false;
                });
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
                        return true;
                    }
                }
            } else {
                return false;
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
