
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components');

const app = new Vue({
    el: '#app',
    data: {
      items: ['apples', 'berries', 'bananas'],
      messages: [],
      currentuser: '',
      roomCount: [],
    },
    methods: {
      addItem(item) {
        this.items.push(item.item);
      },
      addMessage(message) {
        // add to existing mesasges
        this.messages.push(message);
        axios.post('/chat-messages', message)
              .then(response => {
              })
              .catch(error => {
                console.log(error);
              });
      },
    },
    created() {
      axios.get('/chat-messages').then(response => {
        this.messages = response.data;
      });

      axios.get('/username').then(response => {
        this.currentuser = response.data;
      });
    }
});
