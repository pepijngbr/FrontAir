<template>
    <section class="pt-20 pb-10 mb-4">
        <h1>Book {{ this.$route.params }}</h1>
        <p>Book a flight</p>
    </section>
    <section>
        <div class="row">
            <div class="col-md-6">
                <h2>Flight</h2>
                <div v-for="flight in this.flights" :key="flight.id">
                    <h3>{{ flight.name }}</h3>
                    <p>{{ flight.description }}</p>
                    <p>{{ flight.price }}</p>
                    <p>{{ flight.departure }}</p>
                    <p>{{ flight.arrival }}</p>
                    <p>{{ flight.airline }}</p>
                    <p>{{ flight.aircraft }}</p>
                    <p>{{ flight.seats }}</p>
                    <p>{{ flight.from }}</p>
                    <p>{{ flight.to }}</p>
                    <!-- <button @click="bookFlight(flight.id)">Book</button> -->
                </div>
            </div>
            <div class="col-md-6">
                <h2>Airports</h2>
                <div v-for="airport in airports" :key="airport.id">
                    <h3>{{ airport.name }}</h3>
                    <p>{{ airport.code }}</p>
                    <p>{{ airport.city }}</p>
                    <p>{{ airport.country }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
    import axios from 'axios';

    const apiUrl = '';

    export default {
        name: 'BookShow',
        data() {
            return {
                flights: [],
                airports: [],
            };
        },
        mounted() {
            this.retrieveFlights();
            this.retrieveAirports();
        },
        methods: {
            bookFlight(flightId: number) {
                axios.post(apiUrl + '/bookings', {
                    flight_id: flightId,
                })
                    .then(response => {
                        console.log('Flight booked!');
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            retrieveFlights() {
                axios.get(apiUrl + '/flights')
                    .then(response => {
                        console.log(response.data);
                        this.flights = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            retrieveAirports() {
                axios.get(apiUrl + '/airports')
                    .then(response => {
                        console.log(response.data);
                        this.airports = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
        }
    }
</script>