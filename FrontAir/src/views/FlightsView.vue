<!-- Flights page using default app layout -->
<template>
    <button class='text-white px-4 sm:px-8 py-2 sm:py-3 bg-sky-700 hover:bg-sky-800'>...</button>
    <section class='pt-20 pb-10 mb-4 text-center md:text-left'>
        <div class='flex justify-center md:justify-start gap-4'>
            <img src='../assets/images/FrontAir_Aeroplane_V2.png' class='h-14 hidden' alt='FrontAir Airplane' />
            <h1>Flight Schedule</h1>
        </div>
        <p>View our Flight Schedule below and book a flight!</p>
    </section>
    <p>Destination</p>
    <select class='select select-bordered w-full max-w-xs'>
        <option disabled selected>From</option>
        <option v-for='airport in this.airports' :key='airport.id'>{{ airport.name }} ({{ airport.icao }})</option>
    </select>
    <select class='select select-bordered w-full max-w-xs'>
        <option disabled selected>To</option>
        <option v-for='airport in this.airports' :key='airport.id'>{{ airport.name }} ({{ airport.icao }})</option>
    </select>
    <br /><br />
    <p>Airline</p>
    <select class='select select-bordered w-full max-w-xs' v-model='this.airline'>
        <option disabled selected>Airline</option>
        <option value='0'>All</option>
        <option v-for='airline in this.airlines' :value='airline.id' :key='airline.id'>{{ airline.name }}</option>
    </select>
    <div class='divider'></div>
    <p>Date selection</p>
    <div class='relative max-w-sm'>
        <div class='absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none'>
            <i class='bi bi-calendar-fill text-lg text-gray-500 dark:text-gray-400'></i>
        </div>
        <input type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Select date' />
    </div>
    <div class='flex items-center'>
        <div class='relative'>
            <div class='absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none'>
                <i class='bi bi-calendar-fill text-lg text-gray-500 dark:text-gray-400'></i>
            </div>
            <input name='start' type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Select date start' />
        </div>
        <span class='mx-4 text-gray-500'>to</span>
        <div class='relative'>
            <div class='absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none'>
                <i class='bi bi-calendar-fill text-lg text-gray-500 dark:text-gray-400'></i>
            </div>
            <input name='end' type='text' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' placeholder='Select date end' />
        </div>
    </div>
    <div class='divider'></div>
    <!--  p-4 added to element underneath -->
    <div v-if='this.flights' class='grid gap-4 grid-cols-12 auto-rows-fr px-4'>
        <div v-for='flight in this.flights' :key='flight.id' class='col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-3 card bg-base-100 shadow-xl group'>
            <figure>
                <img class='w-full h-60 object-cover object-center' :src="'../src/assets/images/airlines/' +flight.airline.name.toLowerCase().replace(/\s/g, '_') +'/' + flight.image +'.webp'" :alt="flight.airline.name != null ? flight.airline.name : 'Image of Airline'" />
            </figure>
            <div class='card-body'>
                <h2 class='card-title justify-center'>
                    <RouterLink :to="{ name: 'flights.show', params: { id: flight.id } }">
                        {{ flight.airline.name + ' - ' + flight.flight_number.toUpperCase() }}
                    </RouterLink>
                </h2>
                <div class='card-body'>
                    {{ flight.departure_airport.name }} ({{ flight.departure_airport.icao }}) - {{ flight.arrival_airport.name }} ({{ flight.arrival_airport.icao }})<br />
                    {{ flight.departure_time }} - {{ flight.arrival_time }}<br />
                    {{ flight.available_seats }} seats available<br />
                </div>
                <div class='card-actions justify-between items-end'>
                    <b class='text-4xl'>€{{ flight.price }}<span class='text-lg font-normal'>/pp</span></b>
                    <RouterLink :to="{ name: 'flights.show', params: { id: flight.id } }" class='btn btn-primary'>Book Flight</RouterLink>
                </div>
            </div>
        </div>
    </div>
    <div v-else class='text-center p-4'>
        <p>No flights available.</p>
    </div>
    <div v-if='this.flights && this.limit <= this.flights.length' class='flex flex-col items-center justify-center mt-4 mb-12'>
        <p>Current limit: {{ this.limit }}</p>
        <button @click='flightLimit(+10)' class='btn'>View More</button>
    </div>
</template>

<script lang='ts'>
import { RouterLink } from 'vue-router';

import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'FlightsView',
    components: {
        RouterLink
    },
    data() {
        return {
            flights: [],
            airports: [],
            airlines: [],
            date_from: '', // filter
            date_to: '', // filter
            airline: '', // filter
            limit: 10
        };
    },
    mounted() {
        this.retrieveAirlines();
        this.retrieveAirports();
        this.retrieveFlights();
    },
    watch: {
        airline: function() {
            this.retrieveFlights();
        }
    },
    methods: {
        retrieveFlights() {
            // axios.get(apiUrl + '/flights?limit=' + this.limit + '&date_from=' + this.date_from + '&date_to=' + this.date_to + '&airline=' + this.airline)
            axios
                .get(apiUrl + '/flights?sort_by=id&sort_order=DESC&limit=' + this.limit + '&airline_id=' + this.airline)
                .then((response) => {
                    console.log(response.data);
                    this.flights = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        retrieveAirports() {
            axios
                .get(apiUrl + '/airports')
                .then((response) => {
                    console.log(response.data);
                    this.airports = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        retrieveAirlines() {
            axios
                .get(apiUrl + '/airlines')
                .then((response) => {
                    console.log(response.data);
                    this.airlines = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        flightLimit(limit: number) {
            this.limit += limit;
            this.retrieveFlights();
        }
    }
};
</script>
