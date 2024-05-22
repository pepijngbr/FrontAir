<!-- View for registering -->
<template>
    <h1>Register</h1>
    <p>Register for an account.</p>
    <label class="form-control">
        <div class="label">
            <span class="label-text">What is your name?</span>
        </div>
        <input type="text" placeholder="Daisy" class="input input-bordered w-full max-w-xs" />
    </label>
    <label class="form-control">
        <div class="label">
            <span class="label-text">Where can we send your emails to?</span>
        </div>
        <input type="text" placeholder="daisy@gmail.com" class="input input-bordered w-full max-w-xs" />
    </label>
</template>

<script lang="ts">
    export default {
        name: 'RegisterView',
    }
</script>