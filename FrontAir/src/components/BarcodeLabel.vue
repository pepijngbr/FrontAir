<template>
    <div>
        <svg ref="barcode" />
    </div>
</template>

<script>
import JsBarcode from 'jsbarcode';

export default {
    name: 'BarcodeLabel',
    props: {
        value: {
            type: String,
            required: true,
        },
    },
    watch: {
        value() {
            this.generateBarcode();
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
};
</script>

<style scoped>
svg {
    width: 100%;
}
</style>
