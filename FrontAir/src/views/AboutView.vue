<template>
    <section class="mx-auto max-w-[900px] py-10 [&>*]:mb-4">
        <h1 class="text-center md:text-left">About Us</h1>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="flex h-full flex-col justify-center gap-4">
                <p>
                    Welcome to FrontAir, where your journey begins with an
                    exceptional booking experience.
                </p>
                <p>
                    At FrontAir, we are dedicated to providing you with the best
                    customer service and the most seamless flight booking
                    process.
                </p>
                <p>
                    Our mission is to make your travel planning as effortless
                    and enjoyable as possible. We understand that booking
                    flights can sometimes be stressful, so we’ve made it our
                    goal to simplify every step of the way.
                </p>
            </div>
            <img
                class="rounded-lg"
                src="../assets/images/suhyeon-choi-tTfDMaRq-FE-unsplash.webp"
            />
        </div>
    </section>
    <section class="mx-auto max-w-[900px] py-10 [&>*]:mb-4">
        <h2 class="text-center md:text-left">Meet the Team</h2>
        <div
            class="grid grid-cols-1 gap-12 sm:grid-cols-2 sm:gap-4 md:grid-cols-3"
        >
            <div class="avatar flex-col text-center">
                <div class="mb-2 h-full w-full rounded-xl sm:h-[400px]">
                    <img
                        src="../assets/images/linkedin-sales-solutions-pAtA8xe_iVM-unsplash.webp"
                    />
                </div>
                <p class="text-lg">Marcus Stevens</p>
                <p class="text-sm opacity-75">IT Manager</p>
            </div>
            <div class="avatar flex-col text-center">
                <div class="mb-2 h-full w-full rounded-xl sm:h-[400px]">
                    <img
                        src="../assets/images/albert-dera-ILip77SbmOE-unsplash.webp"
                    />
                </div>
                <p class="text-lg">Jameson Reid</p>
                <p class="text-sm opacity-75">Marketing Manager</p>
            </div>
            <div class="avatar flex-col text-center">
                <div class="mb-2 h-full w-full rounded-xl sm:h-[400px]">
                    <img
                        src="../assets/images/anthony-tran-3Xkms-gMvZg-unsplash.webp"
                    />
                </div>
                <p class="text-lg">Lily Chen</p>
                <p class="text-sm opacity-75">
                    Media and Communications Specialist
                </p>
            </div>
        </div>
    </section>
    <section class="mx-auto max-w-[900px] py-10 [&>*]:mb-4">
        <h2 class="text-center md:text-left">Our Vision</h2>
        <p>
            We believe in a world where travel is accessible, convenient, and
            stress-free. Our vision is to connect people to their destinations
            with ease and confidence. By leveraging cutting-edge technology and
            a user-friendly platform, we bring you the best flight options at
            the most competitive prices.
        </p>
    </section>
    <section class="mx-auto max-w-[900px] py-10 [&>*]:mb-4">
        <h2 class="text-center md:text-left">Our Commitment</h2>
        <p>
            <span class="font-bold">Customer Satisfaction:</span> Your
            satisfaction is our top priority. Our dedicated support team is here
            to assist you 24/7, ensuring that all your questions are answered
            and your concerns are addressed promptly.
        </p>
        <p>
            <span class="font-bold">Ease of Use:</span> Our intuitive interface
            is designed to make flight booking quick and straightforward.
            Whether you’re booking a last-minute trip or planning a vacation
            months in advance, FrontAir provides a smooth and hassle-free
            experience.
        </p>
        <p>
            <span class="font-bold">Best Prices:</span> We partner with a wide
            range of airlines to offer you the best deals and discounts. Our
            advanced search algorithms find the most affordable and convenient
            flights tailored to your needs.
        </p>
    </section>
    <section class="mx-auto max-w-[900px] py-10 [&>*]:mb-4">
        <h2 class="text-center md:text-left">Why Choose FrontAir?</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-lg bg-base-200 p-4">
                <p class="mb-4 text-center text-2xl">
                    Comprehensive Flight Options
                </p>
                <p>
                    We offer a vast selection of flights to destinations
                    worldwide, giving you the flexibility to choose what works
                    best for you.
                </p>
            </div>
            <div class="rounded-lg bg-base-200 p-4">
                <p class="mb-4 text-center text-2xl">Secure Transactions</p>
                <p>
                    Your security is paramount. We ensure that all transactions
                    are safe and secure, giving you peace of mind when booking
                    with us.
                </p>
            </div>
            <div class="rounded-lg bg-base-200 p-4">
                <p class="mb-4 text-center text-2xl">Innovative Technology</p>
                <p>
                    Our platform is powered by the latest technology to bring
                    you real-time updates and the most accurate information.
                </p>
            </div>
            <div class="rounded-lg bg-base-200 p-4">
                <p class="mb-4 text-center text-2xl">Dedicated Support</p>
                <p>
                    Our friendly and knowledgeable customer service team is
                    always ready to help, providing support whenever you need
                    it.
                </p>
            </div>
        </div>
    </section>
    <section class="mx-auto max-w-[900px] py-10 [&>*]:mb-4">
        <h2 class="text-center md:text-left">Join Us on Your Next Adventure</h2>
        <p>
            We are excited to be a part of your travel journey. Whether you’re
            traveling for business or leisure, solo or with family, FrontAir is
            here to ensure that your flight booking experience is nothing short
            of excellent.
        </p>
        <p>
            Thank you for choosing and believing FrontAir. We look forward to
            helping you reach new heights.
        </p>
    </section>
</template>

<script>
import { useHead } from '@vueuse/head';

export default {
    name: 'AboutView',
    setup() {
        useHead({
            title: 'About - FrontAir',
            meta: [
                {
                    name: 'description',
                    content:
                        'At FrontAir, we strive to provide the best customer experience when booking flights. Meet our dedicated team committed to making your travel smooth and enjoyable.',
                },
                {
                    name: 'keywords',
                    content:
                        'FrontAir, flights, booking, customer experience, travel, team',
                },
                {
                    property: 'og:title',
                    content: 'About - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'At FrontAir, we strive to provide the best customer experience when booking flights. Meet our dedicated team committed to making your travel smooth and enjoyable.',
                },
                {
                    property: 'og:type',
                    content: 'website',
                },
                {
                    property: 'og:url',
                    content: 'https://www.frontair.com/about',
                },
                {
                    property: 'og:image',
                    content:
                        'https://www.frontair.com/images/about-page-image.jpg',
                },
                {
                    name: 'twitter:card',
                    content: 'summary_large_image',
                },
                {
                    name: 'twitter:title',
                    content: 'About - FrontAir',
                },
                {
                    name: 'twitter:description',
                    content:
                        'At FrontAir, we strive to provide the best customer experience when booking flights. Meet our dedicated team committed to making your travel smooth and enjoyable.',
                },
                {
                    name: 'twitter:image',
                    content:
                        'https://www.frontair.com/images/about-page-image.jpg',
                },
            ],
        });
    },
};
</script>
