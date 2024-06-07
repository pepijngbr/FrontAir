<template>
    <h2>Flight Details for ID: {{ flightId }}</h2>
    <p>$route params id: {{ this.$route.params.id }}</p>
    <div class="divider"></div>
    <h3>Departure Airport</h3>
    <p>Name: {{ flight.departure_airport.name }}</p>
    <p>City: {{ flight.departure_airport.city }}</p>
    <p>Country: {{ flight.departure_airport.country }}</p>
    <p>IATA: {{ flight.departure_airport.iata }}</p>
    <p>ICAO: {{ flight.departure_airport.icao }}</p>
    <p>Timezone: {{ flight.departure_airport.timezone }}</p>
    <p>Type: {{ flight.departure_airport.type }}</p>
    <p>Created At: {{ flight.departure_airport.created_at }}</p>
    <p>Updated At: {{ flight.departure_airport.updated_at }}</p>
    <div class="divider"></div>
    <h3>Arrival Airport</h3>
    <p>Name: {{ flight.arrival_airport.name }}</p>
    <p>City: {{ flight.arrival_airport.city }}</p>
    <p>Country: {{ flight.arrival_airport.country }}</p>
    <p>IATA: {{ flight.arrival_airport.iata }}</p>
    <p>ICAO: {{ flight.arrival_airport.icao }}</p>
    <p>Timezone: {{ flight.arrival_airport.timezone }}</p>
    <p>Type: {{ flight.arrival_airport.type }}</p>
    <p>Created At: {{ flight.arrival_airport.created_at }}</p>
    <p>Updated At: {{ flight.arrival_airport.updated_at }}</p>
    <div class="divider"></div>
    <h3>Airline</h3>
    <p>Name: {{ flight.airline.name }}</p>
    <p>IATA: {{ flight.airline.iata }}</p>
    <p>ICAO: {{ flight.airline.icao }}</p>
    <p>Callsign: {{ flight.airline.callsign }}</p>
    <p>Country: {{ flight.airline.country }}</p>
    <p>Operating since: {{ flight.airline.operating_since }}</p>
    <p>Created At: {{ flight.airline.created_at }}</p>
    <p>Updated At: {{ flight.airline.updated_at }}</p>

    <div class="divider"></div>
    <h3>Information</h3>
    <input type="text" />
    <button class="btn btn-primary">Book Flight</button>
</template>

<script lang="ts">
import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'FlightsShow',
    data() {
        flight: Object;
    },
    computed: {
        flightId() {
            return this.$route.params.id;
        },
    },
    mounted() {
        console.log('FlightsShow component mounted');
        this.retrieveFlight();
    },
    methods: {
        retrieveFlight() {
            axios
                .get(apiUrl + '/flights/' + this.flightId)
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        bookFlight() {
            //
        },
    },
};
</script>
