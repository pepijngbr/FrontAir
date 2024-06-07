<template>
  <section class="py-20">
    <h1><i class="bi bi-ticket"></i> My Bookings</h1>
    <p>Here you can see all your bookings.</p>
  </section>

  <section v-if="bookings.length > 0 && this.userStore.isLoggedIn == true">
    <div class="p-4 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <div
        class="card bordered bg-gray-100"
        v-for="booking in this.bookings"
        :key="booking.id"
      >
        <img
          class="h-8 mt-4"
          :src="
            '../src/assets/images/airlines/' +
            booking.flight.airline.name.toLowerCase().replace(/\s/g, '_') +
            '.svg'
          "
          :alt="
            booking.flight.airline.name != null
              ? booking.flight.airline.name
              : 'Image of Airline'
          "
        />
        <div class="divider"></div>
        <figure>
          <img
            class="w-full h-60 object-cover object-center"
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
        </figure>
        <div class="card-header">
          <h2>{{ booking.flight_id }}</h2>
        </div>

        <div class="card-body">
          <p>Airline: {{ booking.flight.airline.name }}</p>
          <p>Departure: {{ booking.flight.departure_airport.name }}</p>
          <p>Arrival: {{ booking.flight.arrival_airport.name }}</p>
          <p>Departure Time: {{ booking.flight.departure_time }}</p>
          <p>Arrival Time: {{ booking.flight.arrival_time }}</p>
          <p>Seat Number: {{ booking.seat_number }}</p>
          <p>Class: {{ booking.class }}</p>
          <p>Type: {{ booking.type }}</p>
          <p>Price: €{{ booking.price }}</p>
        </div>
      </div>
    </div>
  </section>
  <section v-else>
    <p v-if="bookings.length == 0 && this.userStore.isLoggedIn == true">
      It's empty in here.. try booking a
      <RouterLink :to="{ name: 'flights' }" class="underline text-primary"
        >Flight
      </RouterLink>
      !
    </p>
    <div v-if="this.userStore.isLoggedIn == false">
      <p>Please log in to view your bookings or register to start booking.</p>
      <RouterLink :to="{ name: 'login' }" class="underline text-primary"
        >Login
      </RouterLink>
      <RouterLink :to="{ name: 'register' }" class="btn btn-primary"
        >Register
      </RouterLink>
    </div>
  </section>
</template>

<script lang="ts">
import { useUserStore } from "@/stores/user";
import { RouterLink } from "vue-router";

import axios from "axios";

const apiUrl = "http://127.0.0.1:8000/api";

export default {
  name: "BookingsView",
  components: {
    RouterLink,
  },
  data() {
    return {
      bookings: [],
      userStore: useUserStore(),
    };
  },
  mounted() {
    this.retrieveBookings();
  },
  methods: {
    /**
     * Retrieve all bookings for the logged in user
     */
    retrieveBookings() {
      const userStore = useUserStore();
      if (userStore.isLoggedIn) {
        console.log(userStore.user.id);
        axios
          .get(apiUrl + "/users/" + userStore.user.id + "/bookings")
          .then((response) => {
            this.bookings = response.data.bookings;
            console.log(this.bookings);
          })
          .catch((error) => {
            console.error(error);
          });
        return console.log("User is logged in, retrieving bookings");
      } else {
        console.log("User is not logged in");
      }
    },
  },
};
</script>
