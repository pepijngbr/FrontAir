<template>
    <section
        class='text-white h-[calc(100vh-63px)] px-4 flex items-center justify-center gap-20 bg-gradient-to-b from-primary to-secondary'
    >
        <div
            class='flex flex-col items-center w-[650px] gap-2 md:items-start md:text-left'
        >
            <!--      <h1>FrontAir</h1>-->
            <h1>
                Fly with Ease,<br/>
                Book with Breeze!
            </h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Tincidunt dui ut
                ornare lectus sit amet. Ultricies mi quis hendrerit dolor magna eget.
            </p>
            <RouterLink :to="{ name: 'flights' }" class='btn btn-primary'>
                Book Now
            </RouterLink>
        </div>
        <img :src="'../src/assets/images/FrontAir_Aeroplane_V2' + (this.theme == 'light' ? '' : '_White') + '.png'" class='h-[400px] hidden md:block' alt='FrontAir Logo'/>
        <!-- img here -->
    </section>
    <section class='pt-4 py-20 md:pt-20 pb-10 mb-4 bg-gradient-to-t from-accent to-secondary'>
        <div class='text-center md:text-left'>
            <h2>Flight Schedule</h2>
            <p>Book your flights using the Flight Schedule below!</p>
        </div>
        <div v-if='this.flights' class='p-4 mb-8 grid gap-4 grid-cols-12 auto-rows-fr'>
            <div v-for='flight in this.flights' :key='flight.id' class='col-span-12 md:col-span-6 lg:col-span-4 card bg-base-100 shadow-xl group'>
                <figure>
                    <img class='w-full h-60 object-cover object-center' :src="'../src/assets/images/airlines/' + flight.airline.name.toLowerCase().replace(/\s/g, '_') +'/' + flight.image + '.webp'" alt=''/>
                </figure>
                <div class='card-body'>
                    <h2 class='card-title justify-center'>
                        <RouterLink :to="{ name: 'flights.show', params: { id: flight.id } }">
                            {{ flight.id + ' ' + flight.airline.name + ' ' + flight.flight_number.toUpperCase() }}
                        </RouterLink>
                    </h2>
                    <div class='card-body'>
                        {{ flight.departure_airport.name }} ({{ flight.departure_airport.icao }}) - {{ flight.arrival_airport.name }} ({{ flight.arrival_airport.icao }})<br/>
                        {{ flight.departure_time }} - {{ flight.arrival_time }}<br/>
                        {{ flight.available_seats }} seats available<br/>
                    </div>
                    <div class='card-actions justify-between items-end'>
                        <b class='text-4xl'
                        >€{{ flight.price
                            }}<span class='text-lg font-normal'>/pp</span></b
                        >
                        <RouterLink
                            :to="{ name: 'flights.show', params: { id: flight.id } }"
                            class='btn btn-primary'
                        >
                            Book Flight
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
        <div class='flex justify-center'>
            <RouterLink :to="{ name: 'flights' }" class='btn bg-slate-200'
            >View More
            </RouterLink>
        </div>
    </section>
    <section class='py-20'>
        <div class='text-center md:text-left'>
            <h2>About Us</h2>
            <p>Learn more about FrontAir and our mission!</p>
            <RouterLink to='about' class='btn btn-ghost'>Click Here</RouterLink>
        </div>
    </section>
    <section class='py-20'>
        <div class='text-center md:text-left'>
            <h2>Contact Us</h2>
            <p>Get in touch with us!</p>
            <RouterLink to='contact' class='btn btn-ghost'>Contact Us</RouterLink>
        </div>
    </section>
    <section class='py-20'>
        <h2>For Users</h2>
        <div class='flex flex-col md:flex-row gap-4'>
            <div class='card bg-base-300'>
                <div class='card-body'>
                    <h3>Overview</h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
                        tempore sint magni, ipsa aspernatur voluptatum nisi eius aliquam
                        quaerat itaque nihil et eos sequi quis illo repellendus ratione
                        earum molestias?
                    </p>
                    <div class='card-actions justify-center'>
                        <RouterLink :to="{ name: 'dashboard.overview' }" class='btn'
                        >Click me
                        </RouterLink>
                    </div>
                </div>
            </div>

            <div class='card bg-base-300'>
                <div class='card-body'>
                    <h3>Profile</h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
                        tempore sint magni, ipsa aspernatur voluptatum nisi eius aliquam
                        quaerat itaque nihil et eos sequi quis illo repellendus ratione
                        earum molestias?
                    </p>
                    <div class='card-actions justify-center'>
                        <RouterLink :to="{ name: 'profile' }" class='btn'
                        >Click me
                        </RouterLink>
                    </div>
                </div>
            </div>
            <div class='card bg-base-300'>
                <div class='card-body'>
                    <h3>Settings</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus
                        voluptatum sapiente repellat quaerat molestias. Dolorem consequatur
                        excepturi debitis illo, optio aliquam repellat quas rem neque, nobis
                        assumenda explicabo numquam aperiam!
                    </p>
                    <div class='card-actions justify-center'>
                        <RouterLink :to="{ name: 'profile' }" class='btn'
                        >Click me
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang='ts'>
import { RouterLink } from 'vue-router';

import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'HomeView',
    data() {
        return {
            flights: []
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
        }
    }
};
</script>
