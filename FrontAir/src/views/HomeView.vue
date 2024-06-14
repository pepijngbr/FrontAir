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
                :src="
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
            v-if="this.flights.length > 0"
            class="mt-8 grid auto-rows-fr grid-cols-12 gap-4"
        >
            <div
                v-for="flight in this.flights"
                :key="flight.id"
                class="group card col-span-12 bg-base-100 shadow-lg md:col-span-6 lg:col-span-4"
                :class="theme == 'frontair' ? '' : 'shadow-white/30'"
            >
                <figure>
                    <img
                        class="h-60 w-full object-cover object-center"
                        :src="
                            '../src/assets/images/airlines/' +
                            flight.airline.name
                                .toLowerCase()
                                .replace(/\s/g, '_') +
                            '/' +
                            flight.image +
                            '.webp'
                        "
                        :alt="flight.airline.name"
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
                                flight.flight_number.toUpperCase() +
                                ' - ' +
                                flight.airline.name
                            }}
                        </RouterLink>
                    </h2>
                    <div class="card-body">
                        Flight number: {{ flight.flight_number.toUpperCase() }}
                    </div>
                    <div class="card-actions items-end justify-between">
                        <b
                            class="w-full text-center text-4xl sm:w-1/3 sm:text-left md:w-auto"
                            >€{{ flight.price
                            }}<span class="text-lg font-normal">/pp</span></b
                        >
                        <RouterLink
                            :to="{
                                name: 'flights.show',
                                params: { id: flight.id },
                            }"
                            class="btn btn-primary w-full sm:w-1/2 md:w-auto"
                        >
                            Book Flight
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 flex justify-center">
            <RouterLink :to="{ name: 'flights' }" class="btn btn-secondary"
                >View More
            </RouterLink>
        </div>
    </section>
    <section class="py-32">
        <div class="text-center">
            <h2>About Us</h2>
            <p>Learn more about FrontAir and our mission!</p>
            <RouterLink to="about" class="btn btn-secondary mt-4"
                >Click Here
            </RouterLink>
        </div>
    </section>
    <section class="py-32">
        <div class="text-center">
            <h2>Contact Us</h2>
            <p>Get in touch with us!</p>
            <RouterLink to="contact" class="btn btn-secondary mt-4"
                >Click Here
            </RouterLink>
        </div>
    </section>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { RouterLink } from 'vue-router';
import { useHead } from '@vueuse/head';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'HomeView',
    components: {
        RouterLink,
    },
    setup() {
        useHead({
            title: 'Home - FrontAir',
        });
    },
    data() {
        return {
            flights: [],
        };
    },
    mounted() {
        this.retrieveFlights();
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
                });
        },
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
};
</script>
