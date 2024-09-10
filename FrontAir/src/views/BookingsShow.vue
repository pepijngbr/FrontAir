<template>
    <section v-if="booking.flight" class="pt-20">
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
        <h1>{{ booking.flight.flight_number }}</h1>
    </section>
    <section class="py-10">
        <h2>Your Ticket</h2>
        <div class="max-w-[300px]">
            <BarcodeLabel
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
        </div>
    </section>
    <section v-if="booking.user" class="py-10">
        <h2>Billing information</h2>
        <p>
            Booking made by: {{ booking.user.name }} ({{ booking.user.email }})
        </p>
    </section>
    <section class="py-10">
        <h2>Flight</h2>
        <h3>{{ booking.flight.flight_number }}</h3>
        <p>Price: €{{ booking.price }}</p>
        <p>
            Arrival Airport: {{ booking.flight.arrival_airport.name }} ({{
                booking.flight.arrival_airport.iata
            }})
        </p>
        <p>
            Departure Airport:
            {{ booking.flight.departure_airport.name }} ({{
                booking.flight.departure_airport.iata
            }})
        </p>
        <p>Airline: {{ booking.flight.airline.name }}</p>
        <p>Available seats: {{ booking.flight.available_seats }}</p>
        <p>Your seat number: {{ booking.seat_number }}</p>
    </section>
    <section class="py-20">
        <h2>Airports</h2>
        <b>Departure airport: {{ booking.flight.departure_airport.name }}</b>
        <p>Code: {{ booking.flight.departure_airport.iata }}</p>
        <p>City: {{ booking.flight.departure_airport.city }}</p>
        <p>Country: {{ booking.flight.departure_airport.country }}</p>
        <br /><br />
        <b>Arrival airport: {{ booking.flight.arrival_airport.name }}</b>
        <p>Code: {{ booking.flight.arrival_airport.iata }}</p>
        <p>City: {{ booking.flight.arrival_airport.city }}</p>
        <p>Country: {{ booking.flight.arrival_airport.country }}</p>
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
    computed: {
        bookngId() {
            return this.$route.params.id;
        },
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
};
</script>
