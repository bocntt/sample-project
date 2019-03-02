<template>
  <div class="chat-log">
    <chat-message v-for="message in messages" :key="message.id"
                  v-bind:message="message">
    </chat-message>

    <div class="empty"
          v-show="messages.length === 0">
      No Messsage yet!
    </div>
  </div>
</template>

<script>
  export default {
    props: ['messages'],
  }
</script>

<style>
  .chat-log .chat-message:nth-child(even) {
    background-color: #f7f7f7;
  }
  .empty {
    padding: 1rem;
    text-align: center;
  }
</style>