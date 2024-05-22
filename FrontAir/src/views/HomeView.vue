<template>
  <section class="pt-20 pb-10">
    <h1>FrontAir</h1>
    <p>Fly with Ease, Book with Breeze!</p>
    <RouterLink to="/flights" class="btn btn-primary">Book Now</RouterLink>
    <!-- img here -->
  </section>
  <section class="py-20">
    <h2>Flight Schedule</h2>
    <p>Book your flights using the Flight Schedule below!</p>
    <RouterLink to="about" class="btn btn-ghost bg-slate-200">View More</RouterLink>
    <div class="flex">
      <div class="card bg-red-400">
        <h3>Flight 1</h3>
      </div>
      <div class="card bg-blue-400">
        <h3>Flight 1</h3>
      </div>
      <div class="card bg-green-400">
        <h3>Flight 1</h3>
      </div>
    </div>
  </section>
  <section class="py-20">
    <h2>About Us</h2>
    <p>Learn more about FrontAir and our mission!</p>
    <RouterLink to="about" class="btn btn-ghost">Click Here</RouterLink>
  </section>
  <section class="py-20">
    <h2>Contact Us</h2>
    <p>Get in touch with us!</p>
    <RouterLink to="contact" class="btn btn-ghost">Contact Us</RouterLink>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'HomeView',
  }
</script>
