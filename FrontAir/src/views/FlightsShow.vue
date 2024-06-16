<template>
    <section class="py-10" v-if="this.flight">
        <div
            class="mx-12 grid auto-rows-fr grid-cols-1 rounded-lg bg-base-200 md:auto-rows-[750px] lg:grid-cols-3"
        >
            <img
                class="col-span-2 h-full w-full rounded-lg object-cover object-center"
                :src="
                    '../src/assets/images/airlines/' +
                    this.flight.airline.name.toLowerCase().replace(/\s/g, '_') +
                    '/' +
                    this.flight.image +
                    '.webp'
                "
                :alt="
                    flight.airline.name != null
                        ? flight.airline.name
                        : 'Image of Airline'
                "
            />
            <div class="col-span-3 p-4 md:col-span-1">
                <h1>
                    {{ this.flight.flight_number }} -
                    {{ this.flight.airline.icao }}
                </h1>
                <p class="text-2xl">Price: €{{ this.flight.price }}</p>
                <p class="my-4">
                    From: {{ this.flight.departure_airport.name }}
                    <span class="text-sm opacity-80"
                        >({{ this.flight.departure_airport.city }},
                        {{ this.flight.departure_airport.country }})</span
                    ><br />
                    To: {{ this.flight.arrival_airport.name }}
                    <span class="text-sm opacity-80"
                        >({{ this.flight.arrival_airport.city }},
                        {{ this.flight.arrival_airport.country }})</span
                    >
                </p>
                <p>Estimated times</p>
                <div class="flex flex-col gap-4 lg:flex-row">
                    <div class="h-30 rounded-lg bg-base-100 p-2 lg:p-4">
                        <p class="font-bold">Departure</p>
                        {{ this.flight.departure_time }}
                    </div>
                    <div class="h-30 rounded-lg bg-base-100 p-2 lg:p-4">
                        <p class="font-bold">Arrival</p>
                        {{ this.flight.arrival_time }}
                    </div>
                </div>
                <p class="my-4">Airline: {{ this.flight.airline.name }}</p>
                <p class="my-4">
                    Seats available: {{ this.flight.available_seats }}
                </p>
                <form
                    v-if="user.isLoggedIn && !isFlightBooked(flight.id)"
                    @submit.prevent="bookFlight"
                    class="my-4 flex w-full flex-col gap-0 lg:flex-row lg:gap-4"
                >
                    <label class="form-control max-w-xs">
                        <div class="label">
                            <span class="label-text">Class</span>
                        </div>
                        <select
                            v-model="this.class"
                            class="select select-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                        >
                            <option value="Economy">Economy</option>
                            <option value="Business">Business</option>
                            <option value="First">First</option>
                        </select>
                    </label>
                    <label class="form-control max-w-xs">
                        <div class="label">
                            <span class="label-text">Type</span>
                        </div>
                        <select
                            v-model="this.type"
                            class="select select-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                        >
                            <option value="one-way">one-way</option>
                            <option value="round-trip">round-trip</option>
                        </select>
                    </label>
                </form>
                <label
                    for="confirmation"
                    class="my-4 flex gap-2"
                    v-if="user.isLoggedIn && !isFlightBooked(flight.id)"
                >
                    <input
                        v-model="this.confirmation"
                        type="checkbox"
                        name="confirmation"
                        class="checkbox"
                        id="confirmation"
                    />
                    Confirm
                </label>
                <button
                    type="submit"
                    v-if="user.isLoggedIn && !isFlightBooked(flight.id)"
                    class="btn btn-primary w-full sm:w-1/2 md:w-auto"
                    @click="bookFlight"
                >
                    Book Flight
                </button>
                <RouterLink
                    v-else-if="!user.isLoggedIn"
                    :to="{ name: 'login' }"
                    class="btn btn-warning w-full sm:w-1/2 md:w-auto"
                    >Login to book
                </RouterLink>
                <div v-else class="mt-4">
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
    </section>
    <section v-else>
        <p>No flight found.</p>
    </section>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { useHead } from '@vueuse/head';

const userStore = useUserStore();

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'FlightsShow',
    data() {
        return {
            flight: {},
            class: '',
            type: '',
            confirmation: false,
            bookings: [],
        };
    },
    created() {
        this.retrieveFlight();
        if (userStore.user) {
            this.retrieveBookings();
        }
    },
    methods: {
        retrieveFlight() {
            axios
                .get(apiUrl + '/flights/' + this.$route.params.id)
                .then((response) => {
                    console.log(response.data);
                    this.flight = response.data[0];
                    this.updateMetaData();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        bookFlight() {
            const userStore = useUserStore();
            const data = {
                user_id: userStore.user.id,
                flight_id: Number(this.flightId || this.flight.id),
                seat_number: Math.floor(Math.random() * 999) + 1,
                class: this.class,
                type: this.type,
                price: Number(this.flight.price),
            };
            if (this.confirmation === true) {
                if (
                    Number(userStore.user.wallet) >= Number(this.flight.price)
                ) {
                    axios
                        .post(apiUrl + '/bookings', data)
                        .then((response) => {
                            alert('Flight booked!');
                            console.log(response);

                            const cost = Number(response.data.flight.price);
                            const updatedWallet = (
                                Number(userStore.user.wallet) - cost
                            ).toFixed(2);
                            const updatedLoyaltyPoints = Math.round(
                                Number(userStore.user.loyalty_points) + cost,
                            );

                            const updateUserData = {
                                wallet: updatedWallet,
                                loyalty_points: updatedLoyaltyPoints,
                            };
                            axios
                                .put(
                                    apiUrl + '/users/' + userStore.user.id,
                                    updateUserData,
                                )
                                .then((response) => {
                                    console.log(response.data);
                                    userStore.setUser(response.data);
                                    localStorage.setItem(
                                        'user',
                                        JSON.stringify(response.data),
                                    );
                                })
                                .catch((error) => {
                                    console.error(error);
                                });

                            const updateFlightData = {
                                available_seats:
                                    this.flight.available_seats - 1,
                            };
                            axios
                                .put(
                                    apiUrl + '/flights/' + this.flight.id,
                                    updateFlightData,
                                )
                                .then((response) => {
                                    console.log(response.data);
                                    this.retrieveFlight();
                                })
                                .catch((error) => {
                                    console.error(error);
                                });
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                } else {
                    alert(
                        'Insufficient wallet balance. Please top up your Wallet.',
                    );
                }
            } else {
                alert(
                    'Try again. Please select a Class, Type and click the checkbox to confirm.',
                );
            }
        },
        updateMetaData() {
            useHead({
                title: `Flight ${this.flight.flight_number} - ${this.flight.airline.name}`,
                meta: [
                    {
                        name: 'description',
                        content: `Book your flight ${this.flight.flight_number} with ${this.flight.airline.name}. Fly from ${this.flight.departure_airport.city}, ${this.flight.departure_airport.country} to ${this.flight.arrival_airport.city}, ${this.flight.arrival_airport.country}.`,
                    },
                    {
                        name: 'keywords',
                        content: `flight, ${this.flight.airline.name}, ${this.flight.flight_number}, book flight, ${this.flight.departure_airport.city}, ${this.flight.arrival_airport.city}`,
                    },
                ],
                script: [
                    {
                        type: 'application/ld+json',
                        json: {
                            '@context': 'http://schema.org',
                            '@type': 'Flight',
                            flightNumber: this.flight.flight_number,
                            airline: {
                                '@type': 'Airline',
                                name: this.flight.airline.name,
                            },
                            departureAirport: {
                                '@type': 'Airport',
                                name: this.flight.departure_airport.city,
                                address: {
                                    '@type': 'PostalAddress',
                                    addressLocality:
                                        this.flight.departure_airport.city,
                                    addressCountry:
                                        this.flight.departure_airport.country,
                                },
                            },
                            arrivalAirport: {
                                '@type': 'Airport',
                                name: this.flight.arrival_airport.city,
                                address: {
                                    '@type': 'PostalAddress',
                                    addressLocality:
                                        this.flight.arrival_airport.city,
                                    addressCountry:
                                        this.flight.arrival_airport.country,
                                },
                            },
                            offers: {
                                '@type': 'Offer',
                                priceCurrency: 'EUR',
                                price: this.flight.price,
                            },
                        },
                    },
                ],
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
    },
    computed: {
        flightId() {
            return this.$route.params.id;
        },
        useUserStore() {
            return useUserStore();
        },
        user() {
            return userStore;
        },
    },
};
</script>
