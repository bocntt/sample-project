<template>
  <div class="child">
    <ul>
      <child v-for="item in items" :key="item.id" v-bind:item="item"></child>
    </ul>
  </div>
</template>
<script>
  export default {
    props: ['items'],
  }
</script>