<template>
  <section class="h-[calc(100vh-63px)] flex items-center">
    <div class="flex flex-col items-start">
      <h1>FrontAir</h1>
      <p>Fly with Ease, Book with Breeze!</p>
      <RouterLink :to="{ name: 'flights' }" class="btn btn-primary">Book Now</RouterLink>
    </div>
    <!-- img here -->
  </section>
  <section class="py-20">
    <h2>Flight Schedule</h2>
    <p>Book your flights using the Flight Schedule below!</p>
    <div class="flex">
      <div class="card bg-red-400" v-for="flight in flights" :key="flight.id">
        <h3>Flight number: {{ flight.flight_number }}</h3>
        <h3>Price: €{{ flight.price }}</h3>
        <h3>Available seats: {{ flight.available_seats }}</h3>
      </div>
    </div>
    <RouterLink :to="{ name: 'flights' }" class="btn bg-slate-200">View More</RouterLink>
  </section>
  <section class="py-20">
    <h2>About Us</h2>
    <p>Learn more about FrontAir and our mission!</p>
    <RouterLink to="about" class="btn btn-ghost">Click Here</RouterLink>
  </section>
  <section class="py-20">
    <h2>Contact Us</h2>
    <p>Get in touch with us!</p>
    <RouterLink to="contact" class="btn btn-ghost">Contact Us</RouterLink>
  </section>
  <section class="py-20">
    <h2>Dashboard</h2>
    <div class="flex">
      <div class="card bg-base-100">
        <h3>Overview</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque quidem consectetur, excepturi at
          exercitationem voluptate provident aliquid totam illo et est nulla sapiente quam quibusdam accusamus pariatur
          optio voluptatem temporibus?</p>
        <a href="#">Click me</a>
      </div>
      <div class="card bg-base-200">
        <h3>Profile</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere tempore sint magni, ipsa aspernatur
          voluptatum nisi eius aliquam quaerat itaque nihil et eos sequi quis illo repellendus ratione earum molestias?
        </p>
        <a href="#">Click me</a>
      </div>
      <div class="card bg-base-300">
        <h3>Settings</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus voluptatum sapiente repellat quaerat
          molestias. Dolorem consequatur excepturi debitis illo, optio aliquam repellat quas rem neque, nobis assumenda
          explicabo numquam aperiam!</p>
        <a href="#">Click me</a>
      </div>
    </div>
  </section>
</template>

<script lang="ts">
  import { RouterLink } from 'vue-router';

  import axios from 'axios';

  const apiUrl = 'http://127.0.0.1:8000/api';

  export default {
    name: 'HomeView',
    data() {
      return {
        flights: [],
      }
    },
    mounted() {
      this.retrieveFlights();
    },
    methods: {
      retrieveFlights() {
        axios.get(apiUrl + '/flights?limit=3')
          .then(response => {
            console.log(response.data);
            this.flights = response.data;
          })
          .catch(e => {
            console.log(e);
          });
      }
    }
  }
</script>
