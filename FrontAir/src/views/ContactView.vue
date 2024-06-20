<template>
    <section class="mx-auto max-w-[900px] py-10">
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
                    class="textarea textarea-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                    placeholder="Type here"
                    v-model="this.content"
                ></textarea>
            </label>
            <button
                type="submit"
                @click="submit()"
                class="btn btn-primary w-full md:w-fit"
            >
                Submit
            </button>
        </form>
    </section>
</template>

<script>
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';

export default {
    name: 'ContactView',
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;

        useHead({
            title: 'Contact - FrontAir',
            link: [
                {
                    rel: 'canonical',
                    href: canonicalUrl,
                },
            ],
            meta: [
                {
                    name: 'description',
                    content:
                        'The contact page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'contact, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Contact - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The contact page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    property: 'og:type',
                    content: 'website',
                },
                {
                    property: 'og:url',
                    content: 'https://www.frontair.nl',
                },
                {
                    property: 'og:image',
                    content:
                        'https://www.frontair.nl/images/frontair_logo.webp',
                },
            ],
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
