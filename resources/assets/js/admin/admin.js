import Vue from 'vue'
import VuejsDialog from "vuejs-dialog"

Vue.use(VuejsDialog)

window.Event = new Vue()
window.Vue   = Vue

window.axios = require('axios')

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {

    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

let Form = require('./methods/Form.js');

// Components
import Service from './components/Service.vue'
import Modal from './components/Modal.vue'
import EventMessages from './components/EventMessages.vue'

let adminVue = new Vue({
    el: '#admin-app',
    mixins: [Form],
    components: {
        adminService: Service,
        adminModal: Modal,
        adminAlerts: EventMessages
    },
    mounted(){
        Event.$on('form:errors:show', (form, errors) => {
            Form.showErrors(form, errors)
        })
    }
})
