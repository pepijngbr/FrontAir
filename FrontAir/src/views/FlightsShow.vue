<template>
    <h2>Flight Details for ID: {{ flightId }}</h2>
</template>

<script lang="ts">
    export default {
        name: 'FlightsShow',
        computed: {
            flightId() {
                return this.$route.params.id;
            }
        }
    }
</script>