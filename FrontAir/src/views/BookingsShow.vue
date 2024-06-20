<template>
    <section class="pt-20" v-if="this.booking.flight">
        <h1>{{ this.booking.flight.flight_number }}</h1>
    </section>
    <section class="py-20">
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
    <section class="py-20" v-if="this.booking.user">
        <h2>Billing information</h2>
        <p>
            Booking made by: {{ this.booking.user.name }} ({{
                this.booking.user.email
            }})
        </p>
    </section>
    <section class="py-20">
        <h2>Flight</h2>
        <h3>{{ this.booking.name }}</h3>
        <p>Price: {{ this.booking.price }}</p>
        <p>{{ this.booking.flight.arrival_airport }}</p>
        <p>{{ this.booking.flight.departure_airport }}</p>
        <p>{{ this.booking.flight.airline }}</p>
        <p>Available seats: {{ this.booking.flight.available_seats }}</p>
        <p>Your seat number: {{ this.booking.seat_number }}</p>
    </section>
    <section class="py-20">
        <h2>Airports</h2>
        <h3>Departure airport</h3>
        <div v-for="airport in airports" :key="airport.id">
            <h3>{{ airport.name }}</h3>
            <p>{{ airport.code }}</p>
            <p>{{ airport.city }}</p>
            <p>{{ airport.country }}</p>
        </div>
        <h4>Arrival airport</h4>
        <div v-for="airport in airports" :key="airport.id">
            <h3>{{ airport.name }}</h3>
            <p>{{ airport.code }}</p>
            <p>{{ airport.city }}</p>
            <p>{{ airport.country }}</p>
        </div>
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
