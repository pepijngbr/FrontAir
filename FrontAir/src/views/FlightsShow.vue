<template>
    <h2>Flight Details for ID: {{ flightId }}</h2>
    <p>$route params id: {{ this.$route.params.id }}</p>

    <div class="divider"></div>

    <p>From: COUNTRY FROM</p>
    <p>To: COUNTRY TO</p>
    <p>Departure: DATE TIME</p>
    <p>Arrival: DATE TIME</p>
    <p>Price: $PRICE</p>
    <p>Seats Available: SEATS</p>
    <p>Flight Duration: DURATION</p>
    <p>Flight Distance: DISTANCE</p>
    <p>Flight Type: One-way / Return Flight</p>
    <p>Flight Class: CLASS</p>
    <p>Flight Status: STATUS</p>
    <p>Flight Airline: AIRLINE</p>
    <p>Flight Aircraft: AIRCRAFT</p>
    <p>Flight Passengers: PASSENGERS</p>

    <div class="divider"></div>

    <button class="btn btn-primary">Book Flight</button>
</template>

<script lang="ts">
    import axios from 'axios';

    const apiUrl = 'http://127.0.0.1:8000/api';

    export default {
        name: 'FlightsShow',
        computed: {
            flightId() {
                return this.$route.params.id;
            }
        },
        mounted() {
            console.log('FlightsShow component mounted');
            this.retrieveFlight();
        },
        methods: {
            retrieveFlight() {
                // get flight by id

                axios.get(apiUrl + '/flights/' + this.flightId)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
</script>