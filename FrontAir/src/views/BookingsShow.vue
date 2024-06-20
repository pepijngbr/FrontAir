<template>
    <section class="pt-20" v-if="this.booking.flight">
        <img
            class="h-60 w-full rounded-lg object-cover object-center"
            :src="
                '../src/assets/images/airlines/' +
                booking.flight.airline.name.toLowerCase().replace(/\s/g, '_') +
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
        <h1>{{ this.booking.flight.flight_number }}</h1>
    </section>
    <section class="py-10">
        <h2>Your Ticket</h2>
        <div class="max-w-[300px]">
            <Barcode
                :value="
                    this.booking.user_id +
                    '' +
                    this.booking.flight.departure_airport.id +
                    '' +
                    this.booking.flight.arrival_airport.id +
                    this.booking.flight.flight_number +
                    this.booking.id
                "
            />
        </div>
    </section>
    <section class="py-10" v-if="this.booking.user">
        <h2>Billing information</h2>
        <p>
            Booking made by: {{ this.booking.user.name }} ({{
                this.booking.user.email
            }})
        </p>
    </section>
    <section class="py-10">
        <h2>Flight</h2>
        <h3>{{ this.booking.flight.flight_number }}</h3>
        <p>Price: €{{ this.booking.price }}</p>
        <p>
            Arrival Airport: {{ this.booking.flight.arrival_airport.name }} ({{
                this.booking.flight.arrival_airport.iata
            }})
        </p>
        <p>
            Departure Airport:
            {{ this.booking.flight.departure_airport.name }} ({{
                this.booking.flight.departure_airport.iata
            }})
        </p>
        <p>Airline: {{ this.booking.flight.airline.name }}</p>
        <p>Available seats: {{ this.booking.flight.available_seats }}</p>
        <p>Your seat number: {{ this.booking.seat_number }}</p>
    </section>
    <section class="py-20">
        <h2>Airports</h2>
        <b
            >Departure airport:
            {{ this.booking.flight.departure_airport.name }}</b
        >
        <p>Code: {{ this.booking.flight.departure_airport.iata }}</p>
        <p>City: {{ this.booking.flight.departure_airport.city }}</p>
        <p>Country: {{ this.booking.flight.departure_airport.country }}</p>
        <br /><br />
        <b>Arrival airport: {{ this.booking.flight.arrival_airport.name }}</b>
        <p>Code: {{ this.booking.flight.arrival_airport.iata }}</p>
        <p>City: {{ this.booking.flight.arrival_airport.city }}</p>
        <p>Country: {{ this.booking.flight.arrival_airport.country }}</p>
    </section>
</template>

<script>
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';
import { useUserStore } from '@/stores/user.js';
import Barcode from '@/components/Barcode.vue';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'BookingShow',
    components: {
        Barcode,
    },
    data() {
        return {
            booking: {},
        };
    },
    created() {
        this.retrieveBooking();
    },
    methods: {
        retrieveBooking() {
            axios
                .get(
                    apiUrl +
                        '/users/' +
                        useUserStore().user.id +
                        '/bookings/' +
                        this.bookingId,
                )
                .then((response) => {
                    console.log(response.data);
                    this.booking = response.data[0];
                    this.updateMetaData();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        updateMetaData() {
            const route = useRoute();
            const canonicalUrl = 'https://www.frontair.nl' + route.path;
            useHead({
                title: `${this.booking.flight.flight_number} - ${this.booking.flight.airline.name}`,
                link: [
                    {
                        rel: 'canonical',
                        href: canonicalUrl,
                    },
                ],
                meta: [
                    {
                        name: 'description',
                        content: `Book your flight ${this.booking.flight.flight_number} with ${this.booking.flight.airline.name}. Fly from ${this.booking.flight.departure_airport.city}, ${this.booking.flight.departure_airport.country} to ${this.booking.flight.arrival_airport.city}, ${this.booking.flight.arrival_airport.country}.`,
                    },
                    {
                        name: 'keywords',
                        content: `flight, ${this.booking.flight.airline.name}, ${this.booking.flight.flight_number}, book flight, ${this.booking.flight.departure_airport.city}, ${this.booking.flight.arrival_airport.city}`,
                    },
                ],
                script: [
                    {
                        type: 'application/ld+json',
                        json: {
                            '@context': 'http://schema.org',
                            '@type': 'Reservation',
                            reservationId: this.booking.id,
                            reservationStatus: this.booking.booking_status,
                            underName: {
                                '@type': 'Person',
                                name: this.booking.user.name,
                            },
                            reservationFor: {
                                '@type': 'Flight',
                                flightNumber: this.booking.flight.flight_number,
                                airline: {
                                    '@type': 'Airline',
                                    name: this.booking.flight.airline.name,
                                },
                                departureAirport: {
                                    '@type': 'Airport',
                                    name: this.booking.flight.departure_airport
                                        .city,
                                    address: {
                                        '@type': 'PostalAddress',
                                        addressCity:
                                            this.booking.flight
                                                .departure_airport.city,
                                        addressCountry:
                                            this.booking.flight
                                                .departure_airport.country,
                                    },
                                },
                                arrivalAirport: {
                                    '@type': 'Airport',
                                    name: this.booking.flight.arrival_airport
                                        .city,
                                    address: {
                                        '@type': 'PostalAddress',
                                        addressCity:
                                            this.booking.flight.arrival_airport
                                                .city,
                                        addressCountry:
                                            this.booking.flight.arrival_airport
                                                .country,
                                    },
                                },
                            },
                            reservedTicket: {
                                '@type': 'Ticket',
                                ticketedSeat: this.booking.seat_number,
                                ticketToken: 'urn:uuid:' + this.booking.id,
                                ticketedOffer: {
                                    '@type': 'Offer',
                                    priceCurrency: 'EUR',
                                    price: this.booking.price,
                                },
                            },
                        },
                    },
                ],
            });
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
        bookingId() {
            return this.$route.params.id;
        },
    },
};
</script>
