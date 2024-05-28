<!-- Flights page using default app layout -->
<template>
  <section class="pt-20 pb-10 mb-4">
    <div class="flex items-center gap-4">
      <img src="../assets/images/FrontAir_Aeroplane_V2.png" class="h-14" alt="FrontAir Airplane">
      <h1>Flight Schedule</h1>
    </div>
    <p>View our Flight Schedule below and book a flight!</p>
    <!-- <p>Book your flights using the Flight Schedule below!</p> -->
  </section>

  <!-- group -->
  <div class="card w-96 bg-base-100 shadow-xl group">
    <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
    <div class="card-body">
      <div class="flex">
        <p>From: </p>
        <h2>Destination</h2>
        <p class="ml-auto">To: </p>
      </div>
      <h2 class="card-title justify-center">Shoes!</h2>
      <p>If a dog chews shoes whose shoes does he choose?</p>
      <div class="card-actions justify-end">
        <!-- invisible group-hover:visible -->
        <button class="btn btn-primary">Book Flight</button>
      </div>
    </div>
  </div>
  <div class="p-4 grid gap-4 grid-cols-12 auto-rows-fr">
    <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-base-100 shadow-xl group">
      <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
      </figure>
      <div class="card-body">
        <h2 class="card-title justify-center">Shoes!</h2>
        <div class="card-actions justify-end">
          <!-- invisible group-hover:visible -->
          <button class="btn btn-primary">Book Flight</button>
        </div>
      </div>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-base-100 shadow-xl group">
      <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
      </figure>
      <div class="card-body">
        <h2 class="card-title justify-center">Shoes!</h2>
        <div class="card-actions justify-end">
          <!-- invisible group-hover:visible -->
          <button class="btn btn-primary">Book Flight</button>
        </div>
      </div>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-base-100 shadow-xl group">
      <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
      </figure>
      <div class="card-body">
        <h2 class="card-title justify-center">Shoes!</h2>
        <div class="card-actions justify-end">
          <!-- invisible group-hover:visible -->
          <button class="btn btn-primary">Book Flight</button>
        </div>
      </div>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-base-100 shadow-xl group">
      <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
      </figure>
      <div class="card-body">
        <h2 class="card-title justify-center">Shoes!</h2>
        <div class="card-actions justify-end">
          <!-- invisible group-hover:visible -->
          <button class="btn btn-primary">Book Flight</button>
        </div>
      </div>
    </div>
  </div>

  <div class="form-control w-52">
    <p>Type Flight:</p>
    <label class="cursor-pointer label">
      <span class="label-text">One-way</span>
      <input type="checkbox" class="toggle toggle-primary" />
      <span class="label-text">Return</span>
    </label>
  </div>
  <select class="select select-bordered w-full max-w-xs">
    <option disabled selected>From</option>
    <option v-for="airport in this.airports" :key="airport.id">{{ airport.name }} ({{ airport.icao_code }})</option>
  </select>
  <select class="select select-bordered w-full max-w-xs">
    <option disabled selected>To</option>
    <option v-for="airport in this.airports" :key="airport.id">{{ airport.name }} ({{ airport.icao_code }})</option>
  </select>
  <div class="divider"></div>
  <!-- TODO: https://stackblitz.com/edit/nextjs-e4rcaq?file=pages%2Fpicker.js,node_modules%2Frc-picker%2Flib%2FRangePicker.d.ts -->
  <h1>Kijken voor een date picker waarmee je een start en eind datum kunt kiezen met kleuren highlight ertussen</h1>
  <div class="relative max-w-sm">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
      <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
      </svg>
    </div>
    <input datepicker type="text"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      placeholder="Select date">
  </div>
  <div date-rangepicker class="flex items-center">
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
        </svg>
      </div>
      <input name="start" type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Select date start">
    </div>
    <span class="mx-4 text-gray-500">to</span>
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
        </svg>
      </div>
      <input name="end" type="text"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Select date end">
    </div>
  </div>
  <div class="p-4 grid gap-4 grid-cols-12 auto-rows-fr">
    <!-- :src binding gebruiken voor image van vluchtmaatschappij -->
    <div v-for="flight in this.flights" :key="flight.id"
      class="col-span-12 md:col-span-6 lg:col-span-3 card bg-base-100 shadow-xl group">
      <figure>
        <img class="w-full" :src="'https://source.unsplash.com/600x450/?Airplane'" alt="" />
      </figure>
      <div class="card-body">
        <h2 class="card-title justify-center">
          <RouterLink to="/flights">
            {{ 'id: ' + flight['id'] + ' - name: ' + flight['flight_number'] }}
          </RouterLink>
        </h2>
        <div class="card-actions justify-end">
          <!-- invisible group-hover:visible -->
          <RouterLink :to="{ name: 'flights.show', params: { id: flight.id } }" class="btn btn-primary">
            Book Flight
          </RouterLink>
        </div>
      </div>
    </div>
  </div>

</template>

<script lang="ts">
  import { RouterLink } from 'vue-router';

  import axios from 'axios';

  const apiUrl = 'http://127.0.0.1:8000/api';

  export default {
    name: 'FlightsView',
    components: {
      RouterLink,
    },
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
      bookFlight() {
        axios.post(apiUrl + '/tickets')
          .then(response => {
            // flightid, userid, date
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
    },
  }
</script>