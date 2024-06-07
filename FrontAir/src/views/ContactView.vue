<!-- View for contact -->
<template>
    <!-- bg-primary = DaisyUI primary colour theme (can be modified) -->
    <section class="mb-4 pb-10 pt-4 md:pt-20">
        <h1>Contact</h1>
        <p>
            Have questions or having technical difficulties?<br />
            No worries! Our team has got you covered so you can quickly fly
            away!<br /><br />
            Contact us using the form below.
        </p>
    </section>
    <section>
        <label class="form-control">
            <div class="label">
                <span class="label-text">Name</span>
            </div>
            <label class="input input-bordered flex items-center gap-2">
                <i class="bi bi-person-fill opacity-70"></i>
                <input
                    type="text"
                    class="grow border-none"
                    placeholder="Name"
                />
            </label>
        </label>
        <label class="form-control">
            <div class="label">
                <span class="label-text">Email Address</span>
            </div>
            <label class="input input-bordered flex items-center gap-2">
                <i class="bi bi-envelope-fill opacity-70"></i>
                <input
                    type="text"
                    class="grow border-none"
                    placeholder="Email"
                />
            </label>
        </label>
        <div class="divider my-10"></div>
        <label class="input input-bordered flex items-center gap-2">
            Name
            <input type="text" class="grow border-none" placeholder="Daisy" />
        </label>
        <label class="input input-bordered flex items-center gap-2">
            Email
            <input
                type="text"
                class="grow border-none"
                placeholder="daisy@site.com"
            />
        </label>
        <textarea
            class="textarea textarea-bordered"
            placeholder="Type here"
        ></textarea>
    </section>
</template>

<script lang="ts">
export default {
    name: 'ContactView',
};
</script>
