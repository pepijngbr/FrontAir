<template>
    <section class="mb-4 pb-10 pt-20">
        <h1>Dashboard</h1>
        <p>
            Beheer (CRUD): Flights, Airlines (CRUD), Airports (CRUD), Users
            (CRUD), Bookings (CRUD)
        </p>
        <p>
            Bootstrap icons voor: navigation items (bookings, airplanes), langs
            headers voor fun
        </p>
        <p>:icon: Header</p>
        <div class="divider my-10 before:bg-black after:bg-black" />
        <p>Dashboard: Overview, Flights, Airlines, Airports, Users, Bookings</p>
        <p>
            Overview: Total Flights, Total Airlines, Total Airports, Total
            Users, Total Bookings
        </p>
        <p>Flights: Flight Schedule, Book Flight</p>
        <p>Airlines: Airline Schedule, Book Airline</p>
        <p>Airports: Airport Schedule, Book Airport</p>
        <p>Users: User Schedule, Book User</p>
        <p>Bookings: Booking Schedule, Book Booking</p>
    </section>
    <div
        class="grid auto-rows-[150px] grid-cols-3 gap-4 p-4 md:grid-cols-6 lg:grid-cols-12 [&>div]:rounded-lg"
    >
        <div
            class="col-span-3 row-span-1 border-4 border-green-400 bg-green-300 p-2"
        >
            <p>Flights</p>
            <h2>{{ flights.length || 'N/A' }}</h2>
            <p>-</p>
        </div>
        <div
            class="col-span-3 row-span-1 border-4 border-green-600 bg-green-500 p-2"
        >
            <p>Users</p>
            <h2>{{ users.length || 'N/A' }}</h2>
            <p>-</p>
        </div>
        <div
            class="col-span-3 row-span-1 border-4 border-green-800 bg-green-700 p-2"
        >
            <p>Airports</p>
            <h2>{{ airports.length || 'N/A' }}</h2>
            <p>-</p>
        </div>
        <div
            class="col-span-3 row-span-1 border-4 border-green-900 bg-green-900 p-2"
        >
            <p>Airlines</p>
            <h2>{{ airlines.length || 'N/A' }}</h2>
            <p>-</p>
        </div>
        <div
            class="col-span-8 row-span-3 border-4 border-purple-600 bg-purple-500 p-2"
        >
            <!-- Grid AutoRow = 150px, row-span-2 == 150 x 2 = 300px height -->
            <p>Stats in Chart-js dashboard</p>
        </div>
        <div
            class="col-span-2 row-span-2 border-4 border-red-600 bg-red-500 p-2"
        >
            <p>Incoming Flights</p>
            <!-- <ul class="[&>*]:bg-white [&>*]:mb-2">
                            <li>Flight 1</li>
                            <li>Flight 2</li>
                            <li>Flight 3</li>
                        </ul> -->
        </div>
        <div
            class="col-span-2 row-span-2 border-4 border-red-600 bg-red-500 p-2"
        >
            <p>Outgoing Flights</p>
            <!-- <ul class="[&>*]:bg-white [&>*]:mb-2">
                            <li>Flight 1</li>
                            <li>Flight 2</li>
                            <li>Flight 3</li>
                        </ul> -->
        </div>
        <div
            class="col-span-4 row-span-1 border-4 border-orange-600 bg-orange-500 p-2"
        >
            <p>Logs</p>
            <!-- <ul class="[&>*]:bg-white [&>*]:mb-2">
                            <li>Log 1</li>
                            <li>Log 2</li>
                            <li>Log 3</li>
                        </ul> -->
        </div>
    </div>
</template>

<script>
import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000';

export default {
    name: 'OverviewView',
    data() {
        return {
            flights: [],
            users: [],
            airports: [],
            airlines: [],
        };
    },
    mounted() {
        // TODO: make this a single API call
        axios
            .get(apiUrl + '/api/flights')
            .then((response) => {
                this.flights = response.data;
                console.log('Flights: ', response.data);
            })
            .catch((error) => {
                console.error(error);
            });
        axios
            .get(apiUrl + '/api/users')
            .then((response) => {
                this.users = response.data;
                console.log('Users: ', response.data);
            })
            .catch((error) => {
                console.error(error);
            });
        axios
            .get(apiUrl + '/api/airports')
            .then((response) => {
                this.airports = response.data;
                console.log('Airports: ', response.data);
            })
            .catch((error) => {
                console.error(error);
            });
        axios
            .get(apiUrl + '/api/airlines')
            .then((response) => {
                this.airlines = response.data;
                console.log('Airlines: ', response.data);
                console.log('OverviewView mounted');
            })
            .catch((error) => {
                console.error(error);
            });
    },
};
</script>
