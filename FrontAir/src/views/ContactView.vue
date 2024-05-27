<!-- View for contact -->
<template>
  <!-- bg-primary = DaisyUI primary colour theme (can be modified) -->
  <section class="pt-20 pb-10 mb-4">
    <h1>Contact</h1>
    <p>Have questions or having technical difficulties? <br>No worries! Our team has got you covered so you can quickly
      fly away! <br><br>Contact us using the form below.</p>
  </section>
  <section>
    <label class="form-control">
      <div class="label">
        <span class="label-text">Name</span>
      </div>
      <label class="input input-bordered flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
          <path
            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
        </svg>

        <input type="text" class="grow border-none" placeholder="Name" />
      </label>
    </label>
    <label class="form-control">
      <div class="label">
        <span class="label-text">Email Address</span>
      </div>
      <label class="input input-bordered flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
          <path
            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
          <path
            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
        </svg>
        <input type="text" class="grow border-none" placeholder="Email" />
      </label>
    </label>
    <div class="divider my-10"></div>
    <label class="input input-bordered flex items-center gap-2">
      Name
      <input type="text" class="grow border-none" placeholder="Daisy" />
    </label>
    <label class="input input-bordered flex items-center gap-2">
      Email
      <input type="text" class="grow border-none" placeholder="daisy@site.com" />
    </label>
    <textarea class="textarea textarea-bordered" placeholder="Type here"></textarea>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'ContactView',
  }
</script>