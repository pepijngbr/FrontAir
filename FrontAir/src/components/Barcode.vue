<template>
    <div>
        <svg ref="barcode"></svg>
    </div>
</template>

<!-- using ref="{value}", is like querySelector but for Vue -->
<!-- this can be used for retrieving values or manipulating the DOM -->

<script>
import JsBarcode from 'jsbarcode';

export default {
    name: 'Barcode',
    props: {
        value: {
            type: String,
            required: true,
        },
    },
    mounted() {
        this.generateBarcode();
    },
    methods: {
        generateBarcode() {
            JsBarcode(this.$refs.barcode, this.value, {
                format: 'CODE128',
                width: 2,
                height: 100,
                displayValue: true,
            });
        },
    },
    watch: {
        value() {
            this.generateBarcode();
        },
    },
};
</script>

<style scoped>
svg {
    width: 100%;
}
</style>
