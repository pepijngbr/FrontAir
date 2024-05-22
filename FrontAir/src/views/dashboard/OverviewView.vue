<!-- Landing page for Dashboard -->
<template>
    <section class="pt-20 pb-10 mb-4">
        <h1>Dashboard</h1>
        <p>Beheer (CRUD): Flights, Airlines (CRUD), Airports (CRUD), Users (CRUD), Tickets (Bookings, CRUD)</p>
        <p>Bootstrap icons voor: navigation items (tickets, airplanes), langs headers voor fun</p>
        <p>:icon: Header</p>
        <div class="divider my-10 after:bg-black before:bg-black"></div>
        <p>Dashboard: Overview, Flights, Airlines, Airports, Users, Tickets</p>
        <p>Overview: Total Flights, Total Airlines, Total Airports, Total Users, Total Tickets</p>
        <p>Flights: Flight Schedule, Book Flight</p>
        <p>Airlines: Airline Schedule, Book Airline</p>
        <p>Airports: Airport Schedule, Book Airport</p>
        <p>Users: User Schedule, Book User</p>
        <p>Tickets: Ticket Schedule, Book Ticket</p>
    </section>
    <div class="p-4 grid gap-4 grid-cols-3 md:grid-cols-6 lg:grid-cols-12 auto-rows-[150px] [&>div]:rounded-lg">
        <div class="col-span-3 row-span-1 bg-green-300 border-4 border-green-400 p-2">
            <p>Flights</p>
            <h2>11</h2>
            <p>2 arriving, 9 departing</p>
        </div>
        <div class="col-span-3 row-span-1 bg-green-500 border-4 border-green-600 p-2">
            <p>Users</p>
            <h2>7</h2>
            <p>4 active</p>
        </div>
        <div class="col-span-3 row-span-1 bg-green-700 border-4 border-green-800 p-2">
            <p>Airports</p>
            <h2>3</h2>
            <p>2 active</p>
        </div>
        <div class="col-span-3 row-span-1 bg-green-900 border-4 border-green-900 p-2">
            <p>Airlines</p>
            <h2>2</h2>
            <p>1 active</p>
        </div>
        <div class="col-span-8 row-span-3 bg-purple-500 border-4 border-purple-600 p-2">
            <!-- Grid AutoRow = 150px, row-span-2 == 150 x 2 = 300px height -->
            <p>Stats in Chart-js dashboard</p>
        </div>
        <div class="col-span-2 row-span-2 bg-red-500 border-4 border-red-600 p-2">
            <p>Incoming Flights</p>
            <ul class="[&>*]:bg-white [&>*]:mb-2">
                <li>Flight 1</li>
                <li>Flight 2</li>
                <li>Flight 3</li>
            </ul>
        </div>
        <div class="col-span-2 row-span-2 bg-red-500 border-4 border-red-600 p-2">
            <p>Outgoing Flights</p>
            <ul class="[&>*]:bg-white [&>*]:mb-2">
                <li>Flight 1</li>
                <li>Flight 2</li>
                <li>Flight 3</li>
            </ul>
        </div>
        <div class="col-span-4 row-span-1 bg-orange-500 border-4 border-orange-600 p-2">
            <p>Logs</p>
            <ul class="[&>*]:bg-white [&>*]:mb-2">
                <li>Log 1</li>
                <li>Log 2</li>
                <li>Log 3</li>
            </ul>
        </div>
    </div>
</template>

<script lang="ts">
    export default {
        name: 'OverviewView',
    }
</script>