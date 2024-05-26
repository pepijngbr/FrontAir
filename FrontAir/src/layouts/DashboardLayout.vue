<template>
    <nav class="h-screen">
        <!-- Logo -->
        <!-- = DIVIDER = -->
        <!-- Nav Items (with Bootstrap Icons), RouterLinks -->
    </nav>
    <v-layout>
        <v-app-bar color="grey-lighten-2"></v-app-bar>
        <v-navigation-drawer color="grey-darken-2" permanent></v-navigation-drawer>
        <v-main>
            <!--The <slot> element is a slot outlet that indicates 
                where the "VIEW" content should be rendered.-->
            <slot></slot>
        </v-main>
    </v-layout>
</template>

<script lang="ts">
    export default {
        name: "DashboardLayout",
    };
</script>