<template>
    <section class="mx-auto mb-4 max-w-[900px] pb-8 pt-4 md:pt-20">
        <h1>Contact</h1>
        <p>Have questions or having technical difficulties? No worries!</p>
        <p>Our team has got you covered so you can quickly take flight!</p>
        <br />
        <p>Contact us using the form below.</p>
    </section>
    <section class="mx-auto max-w-[900px]">
        <form @submit.prevent="submit()" class="[&>*]:my-4">
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Name</span>
                </div>
                <label
                    class="input input-bordered flex w-full items-center gap-2 md:w-fit"
                >
                    <i class="bi bi-person-fill opacity-70"></i>
                    <input
                        type="text"
                        class="grow border-none"
                        placeholder="Name"
                        v-model="this.name"
                    />
                </label>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Email Address</span>
                </div>
                <label
                    class="input input-bordered flex w-full items-center gap-2 md:w-fit"
                >
                    <i class="bi bi-envelope-fill opacity-70"></i>
                    <input
                        type="text"
                        class="grow border-none"
                        placeholder="Email"
                        v-model="this.email"
                    />
                </label>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Message</span>
                </div>
                <textarea
                    class="textarea textarea-bordered"
                    placeholder="Type here"
                    v-model="this.content"
                ></textarea>
            </label>
            <button type="submit" class="btn btn-primary w-full md:w-fit">
                Submit
            </button>
        </form>
    </section>
</template>

<script>
import { useHead } from '@vueuse/head';

export default {
    name: 'ContactView',
    setup() {
        useHead({
            title: 'Contact - FrontAir',
            meta: [],
        });
    },
    data() {
        return {
            name: '',
            email: '',
            content: '',
        };
    },
    methods: {
        submit() {
            if (this.name !== '' && this.email !== '' && this.content !== '') {
                alert('Successfully submitted!');
            } else {
                alert('Fill in all fields.');
            }
        },
    },
};
</script>
