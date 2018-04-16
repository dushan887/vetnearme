import Vue from 'vue'

// Components
import Service from './components/Service.vue';
import Modal from './components/Modal.vue';

window.Event = new Vue();

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

new Vue({
    el: '#admin-app',
    components: {
        adminService: Service,
        adminModal: Modal
    }
})

