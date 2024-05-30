<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FrontAir API Routing</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <h1>API Routing for FrontAir</h1>
    <table>
        <thead>
            <tr>
                <th>API</th>
                <th>Method</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="api/flights">/flights</a></td>
                <td>GET</td>
                <td>Retrieve all Flights.</td>
            </tr>
            <tr>
                <td><a href="api/flights/1">/flights/{id}</a></td>
                <td>GET</td>
                <td>Retrieves information about a specific Flight.</td>
            </tr>
            <tr>
                <td><a href="api/users">/users</a></td>
                <td>GET</td>
                <td>Retrieve all Users.</td>
            </tr>
            <tr>
                <td><a href="api/users/1">/users/{id}</a></td>
                <td>GET</td>
                <td>Retrieves information about a specific User.</td>
            </tr>
            <tr>
                <td><a href="api/airports">/airports</a></td>
                <td>GET</td>
                <td>Retrieve all Airports.</td>
            </tr>
            <tr>
                <td><a href="api/airports/1">/airports/{id}</a></td>
                <td>GET</td>
                <td>Retrieves information about a specific Airport.</td>
            </tr>
            <tr>
                <td><a href="api/bookings">/bookings</a></td>
                <td>GET</td>
                <td>Retrieve all Bookings.</td>
            </tr>
            <tr>
                <td><a href="api/bookings/1">/bookings/{id}</a></td>
                <td>GET</td>
                <td>Retrieves information about a specific Booking.</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
