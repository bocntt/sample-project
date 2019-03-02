
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

Vue.component('example', require('./components/Example.vue').default);
Vue.component('widget-grid', require('./components/WidgetGrid.vue').default);
Vue.component('marketing-image-grid', require('./components/MarketingImageGrid.vue').default);
Vue.component('parent', require('./components/Parent.vue').default);
Vue.component('child', require('./components/Child.vue').default);
Vue.component('add-item', require('./components/AddItem.vue').default);

const app = new Vue({
    el: '#app',
    data: {
      items: ['apples', 'berries', 'bananas']
    },
    methods: {
      addItem(item) {
        this.items.push(item.item);
      }
    }
});
