<!-- Analytics page for Dashboard -->
<template>
  <h1>Analytics</h1>
</template>

<script lang="ts">
import axios from "axios";

const apiUrl = "http://127.0.0.1:8000/api";

export default {
  name: "AnalyticsView",
  data() {
    return {
      flights: [],
      users: [],
      airports: [],
      airlines: [],
    };
  },
  mounted() {
    axios
      .get(apiUrl + "/api/flights")
      .then((response) => {
        this.flights = response.data;
        console.log("Flights: ", response.data);
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get(apiUrl + "/api/users")
      .then((response) => {
        this.users = response.data;
        console.log("Users: ", response.data);
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get(apiUrl + "/api/airports")
      .then((response) => {
        this.airports = response.data;
        console.log("Airports: ", response.data);
      })
      .catch((error) => {
        console.error(error);
      });
    axios
      .get(apiUrl + "/api/airlines")
      .then((response) => {
        this.airlines = response.data;
        console.log("Airlines: ", response.data);
        console.log("OverviewView mounted");
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
