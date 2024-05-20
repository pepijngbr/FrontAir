<template>
    <v-layout>
        <!-- TODO: v-main gets image background and slot is the content -->
        <v-main>
            <!--The <slot> element is a slot outlet that indicates 
                where the "VIEW" content should be rendered.-->
            <slot></slot>
        </v-main>
    </v-layout>
</template>

<script lang="ts">
    export default {
        name: 'AuthLayout'
    };
</script>