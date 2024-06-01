<!-- Flights page using default app layout -->
<template>
  <section class="pt-20 pb-10 mb-4">
    <div class="flex items-center gap-4">
      <img
        src="../assets/images/FrontAir_Aeroplane_V2.png"
        class="h-14"
        alt="FrontAir Airplane"
      />
      <h1>Flight Schedule</h1>
    </div>
    <p>View our Flight Schedule below and book a flight!</p>
  </section>
  <p>Destination</p>
  <select class="select select-bordered w-full max-w-xs">
    <option disabled selected>From</option>
    <option v-for="airport in this.airports" :key="airport.id">
      {{ airport.name }} ({{ airport.icao_code }})
    </option>
  </select>
  <select class="select select-bordered w-full max-w-xs">
    <option disabled selected>To</option>
    <option v-for="airport in this.airports" :key="airport.id">
      {{ airport.name }} ({{ airport.icao_code }})
    </option>
  </select>
  <br /><br />
  <p>Airline</p>
  <select class="select select-bordered w-full max-w-xs" v-model="this.airline">
    <option disabled selected>Airline</option>
    <option value="0">All</option>
    <option
      v-for="airline in this.airlines"
      :value="airline.id"
      :key="airline.id"
    >
      {{ airline.name }}
    </option>
  </select>
  <div class="divider"></div>
  <p>Date selection</p>
  <div class="relative max-w-sm">
    <div
      class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none"
    >
      <svg
        class="w-4 h-4 text-gray-500 dark:text-gray-400"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        viewBox="0 0 20 20"
      >
        <path
          d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
        />
      </svg>
    </div>
    <input
      type="text"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      placeholder="Select date"
    />
  </div>
  <div class="flex items-center">
    <div class="relative">
      <div
        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
      >
        <svg
          class="w-4 h-4 text-gray-500 dark:text-gray-400"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
          />
        </svg>
      </div>
      <input
        name="start"
        type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Select date start"
      />
    </div>
    <span class="mx-4 text-gray-500">to</span>
    <div class="relative">
      <div
        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
      >
        <svg
          class="w-4 h-4 text-gray-500 dark:text-gray-400"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
          />
        </svg>
      </div>
      <input
        name="end"
        type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Select date end"
      />
    </div>
  </div>
  <div class="divider"></div>
  <div v-if="this.flights" class="p-4 grid gap-4 grid-cols-12 auto-rows-fr">
    <div
      v-for="flight in this.flights"
      :key="flight.id"
      class="col-span-12 md:col-span-6 lg:col-span-3 card bg-base-100 shadow-xl group"
    >
      <figure>
        <img
          class="w-full h-60 object-cover object-center"
          :src="
            '../src/assets/images/airlines/' +
            flight.airline.name.toLowerCase().replace(/\s/g, '_') +
            '/' +
            flight.image +
            '.jpg'
          "
          alt=""
        />
      </figure>
      <div class="card-body">
        <h2 class="card-title justify-center">
          <RouterLink :to="{ name: 'flights.show', params: { id: flight.id } }">
            {{
              flight.id +
              " " +
              flight.airline.name +
              " " +
              flight.flight_number.toUpperCase()
            }}
          </RouterLink>
        </h2>
        <div class="card-body">
          {{ flight.departure_airport.name }} ({{
            flight.departure_airport.icao_code
          }}) - {{ flight.arrival_airport.name }} ({{
            flight.arrival_airport.icao_code
          }})<br />
          {{ flight.departure_time }} - {{ flight.arrival_time }}<br />
          {{ flight.available_seats }} seats available<br />
        </div>
        <div class="card-actions justify-between items-end">
          <b class="text-4xl"
            >€{{ flight.price }}<span class="text-lg font-normal">/pp</span></b
          >
          <RouterLink
            :to="{ name: 'flights.show', params: { id: flight.id } }"
            class="btn btn-primary"
          >
            Book Flight
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="text-center p-4">
    <p>No flights available.</p>
  </div>
  <div
    v-if="this.flights && this.limit <= this.flights.length"
    class="flex flex-col items-center justify-center mt-4 mb-12"
  >
    <p>Current limit: {{ this.limit }}</p>
    <button @click="flightLimit(+10)" class="btn">View More</button>
  </div>
</template>

<script lang="ts">
import { RouterLink } from "vue-router";

import axios from "axios";

const apiUrl = "http://127.0.0.1:8000/api";

export default {
  name: "FlightsView",
  components: {
    RouterLink,
  },
  data() {
    return {
      flights: [],
      airports: [],
      airlines: [],
      date_from: "", // filter
      date_to: "", // filter
      airline: "", // filter
      limit: 10,
    };
  },
  mounted() {
    this.retrieveAirlines();
    this.retrieveAirports();
    this.retrieveFlights();
  },
  watch: {
    airline: function () {
      this.retrieveFlights();
    },
  },
  methods: {
    retrieveFlights() {
      // axios.get(apiUrl + '/flights?limit=' + this.limit + '&date_from=' + this.date_from + '&date_to=' + this.date_to + '&airline=' + this.airline)
      axios
        .get(
          apiUrl +
            "/flights?sort_by=id&sort_order=DESC&limit=" +
            this.limit +
            "&airline_id=" +
            this.airline,
        )
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
        .get(apiUrl + "/airports")
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
        .get(apiUrl + "/airlines")
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
    },
  },
};
</script>
