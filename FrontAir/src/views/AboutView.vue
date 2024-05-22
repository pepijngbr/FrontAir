<template>
  <section class="pt-20 pb-10 mb-4">
    <h1>About Us</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ab voluptates provident tempora cupiditate
      veritatis nemo ipsa dolore, excepturi, debitis minus aliquam saepe aperiam eaque aspernatur unde eligendi ad
      voluptatem sunt! Maxime mollitia, perferendis, consectetur esse nulla quis officiis illo minus architecto impedit
      magni? Dolore illo fugit harum atque sunt saepe itaque voluptatibus et voluptatum animi culpa numquam tempora
      magnam asperiores architecto repellendus pariatur odio cumque quidem, in laudantium expedita doloribus. Possimus
      consectetur facere nesciunt.</p>
  </section>
  <details class="dropdown">
    <summary class="m-1 btn">open or close</summary>
    <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
      <li><a>Item 1</a></li>
      <li><a>Item 2</a></li>
    </ul>
  </details>
</template>

<script lang="ts">
  export default {
    name: 'AboutView',
  }
</script>