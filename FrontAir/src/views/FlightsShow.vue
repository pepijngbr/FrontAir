<template>
    <section v-if="this.flight">
        <h1>
            {{ this.flight.flight_number }} - {{ this.flight.airline.name }}
        </h1>
        Price: €{{ this.flight.price }}
        <form @submit.prevent="bookFlight">
            <label class="form-control max-w-xs">
                <div class="label">
                    <span class="label-text">Class</span>
                </div>
                <select v-model="this.class" class="select select-bordered">
                    <option value="Economy">Economy</option>
                    <option value="Business">Business</option>
                    <option value="First">First</option>
                </select>
            </label>
            <label class="form-control max-w-xs">
                <div class="label">
                    <span class="label-text">Type</span>
                </div>
                <select v-model="this.type" class="select select-bordered">
                    <option value="one-way">one-way</option>
                    <option value="round-trip">round-trip</option>
                </select>
            </label>
            <label for="confirmation" class="flex gap-2">
                <input
                    v-model="this.confirmation"
                    type="checkbox"
                    name="confirmation"
                    class="checkbox"
                    id="confirmation"
                />
                Confirm</label
            >
            <button class="btn btn-primary" type="submit">Book Flight</button>
        </form>
        <img
            class="object-cover object-center"
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
        <!--        <p>$route params id: {{ flightId }}</p>-->
        <!--        <div class="divider"></div>-->
        <!--        <h3>Departure Airport</h3>-->
        <!--        <p>Name:</p>-->
        <!--        <p>City: {{ this.flight.departure_airport.city }}</p>-->
        <!--        <p>Country: {{ this.flight.departure_airport.country }}</p>-->
        <!--        <p>IATA: {{ this.flight.departure_airport.iata }}</p>-->
        <!--        <p>ICAO: {{ this.flight.departure_airport.icao }}</p>-->
        <!--        <p>Type: {{ this.flight.departure_airport.type }}</p>-->
        <!--        <p>Created At: {{ this.flight.departure_airport.created_at }}</p>-->
        <!--        <p>Updated At: {{ this.flight.departure_airport.updated_at }}</p>-->
        <!--        <div class="divider"></div>-->
        <!--        <h3>Arrival Airport</h3>-->
        <!--        <p>Name: {{ this.flight.arrival_airport.name }}</p>-->
        <!--        <p>City: {{ this.flight.arrival_airport.city }}</p>-->
        <!--        <p>Country: {{ this.flight.arrival_airport.country }}</p>-->
        <!--        <p>IATA: {{ this.flight.arrival_airport.iata }}</p>-->
        <!--        <p>ICAO: {{ this.flight.arrival_airport.icao }}</p>-->
        <!--        <p>Type: {{ this.flight.arrival_airport.type }}</p>-->
        <!--        <p>Created At: {{ this.flight.arrival_airport.created_at }}</p>-->
        <!--        <p>Updated At: {{ this.flight.arrival_airport.updated_at }}</p>-->
        <!--        <div class="divider"></div>-->
        <!--        <h3>Airline</h3>-->
        <!--        <p>Name: {{ this.flight.airline.name }}</p>-->
        <!--        <p>IATA: {{ this.flight.airline.iata }}</p>-->
        <!--        <p>ICAO: {{ this.flight.airline.icao }}</p>-->
        <!--        <p>Callsign: {{ this.flight.airline.callsign }}</p>-->
        <!--        <p>Country: {{ this.flight.airline.country }}</p>-->
        <!--        <p>Operating since: {{ this.flight.airline.operating_since }}</p>-->
        <!--        <p>Created At: {{ this.flight.airline.created_at }}</p>-->
        <!--        <p>Updated At: {{ this.flight.airline.updated_at }}</p>-->
    </section>
    <section v-else>
        <p>No flight found.</p>
    </section>
    <!--    <div class="divider"></div>-->
    <!--    <h3>Information</h3>-->
    <!--    <input type="text" />-->
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { useHead } from '@vueuse/head';

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
        };
    },
    computed: {
        flightId() {
            return this.$route.params.id;
        },
    },
    created() {
        console.log('FlightsShow component mounted');
        this.retrieveFlight();
    },
    methods: {
        retrieveFlight() {
            axios
                .get(apiUrl + '/flights/' + this.$route.params.id)
                .then((response) => {
                    console.log(response.data);
                    this.flight = response.data[0];
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
                if (userStore.user.wallet < this.flight.price) {
                    alert(
                        'Insufficient wallet balance. Please top up your Wallet.',
                    );
                } else {
                    axios
                        .post(apiUrl + '/bookings', data)
                        .then((response) => {
                            alert('Flight booked!');
                            console.log(response);
                            const cost = response.data.flight.price;
                            const data = {
                                wallet: userStore.user.wallet - cost,
                            };
                            axios
                                .put(
                                    apiUrl + '/users/' + userStore.user.id,
                                    data,
                                )
                                .then((response) => {
                                    console.log(response.data);
                                    // Update the Pinia state management
                                    userStore.setUser(response.data);

                                    // Update the wallet balance in localStorage
                                    localStorage.setItem(
                                        'user',
                                        JSON.stringify(response.data),
                                    );
                                })
                                .catch((error) => {
                                    console.error(error);
                                });
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }
            } else {
                alert(
                    'Try again. Please select a Class, Type and click on the checkbox.',
                );
            }
        },
    },
    setup() {
        useHead({
            title: `${this.flight.flight_number} - ${this.flight.airline.name}`,
            meta: [
                {
                    name: 'description',
                    content: `Book your flight ${this.flight.flight_number} with ${this.flight.airline.name}. Fly from ${this.flight.departure_airport.city}, ${this.flight.departure_airport.country} to ${this.flight.arrival_airport.city}, ${this.flight.arrival_airport.country}.`,
                },
                {
                    name: 'keywords',
                    content: `flight, ${this.flight.value.airline.name}, ${this.flight.flight_number}, book flight, ${this.flight.departure_airport.city}, ${this.flight.arrival_airport.city}`,
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
                            price: this.value.price,
                        },
                    },
                },
            ],
        });
    },
};
</script>
