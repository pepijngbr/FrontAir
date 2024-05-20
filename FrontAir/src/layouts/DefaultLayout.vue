<template>
    <h1>Working Layout</h1>
    <v-layout>
        <v-main>
            <!--The <slot> element is a slot outlet that indicates 
                where the "VIEW" content should be rendered.-->
            <slot></slot>
        </v-main>
    </v-layout>
</template>

<script lang="ts">
    // import { defineComponent } from "vue";

    // export default defineComponent({
    //     name: "DefaultLayout",
    // });

    export default {
        name: "DefaultLayout",
    };
</script>