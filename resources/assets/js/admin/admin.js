import Vue from 'vue'
import VuejsDialog from "vuejs-dialog"

Vue.use(VuejsDialog)

window.Event = new Vue()
window.Vue   = Vue

window.axios  = require('axios')

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
import Media from './components/Media.vue'
import ClinicsList from './components/ClinicsList.vue'

let adminVue = new Vue({
    el: '#admin-app',
    mixins: [Form],
    components: {
        adminService: Service,
        adminMedia: Media,
        adminModal: Modal,
        adminAlerts: EventMessages,
        adminClinicsList: ClinicsList
    },
    methods: {
        notWorking(day){
            $('[data-hoursday=' + day + '] input[type=text]')
                .prop('readOnly', (i, v) => { return !v } )
                .val('00:00')
        },
        generateRandomString(){
            $('input[role=random-string]').val(Math.random().toString(36).substring(2, 10) + Math.random().toString(36).substring(2, 10))
        },
        selectAll(element){
            $('input[role=selectAll').prop('checked', element.checked)
        },
        deleteEntry(element){

            let text = element.dataset.text
            let id   = element.dataset.id
            let url  = element.dataset.url + '/' + id

            this.$dialog.confirm('Are you sure you want to delete this ' + text +'?', {
                loader: true
            }).then((dialog) => {

                axios.post(url)
                .then((response) => {

                    dialog.close()

                    Event.$emit('message:show', {
                        messageTitle: data.messageTitle,
                        messageText: data.messageText
                    }, data.class)
                })
                .catch((error) => {
                    console.log(error);

                    alert('Something went wrong. Please try again a bit later')
                })

            })
            .catch((error) => {
                console.log(error);

                alert('Something went wrong. Please try again a bit later')
            });
        }
    },
    mounted(){
        Event.$on('form:errors:show', (form, errors) => {
            Form.showErrors(form, errors)
        })
    }
})



//Timepicker
$('.timepicker').timepicker({
    timeFormat: 'HH:mm',
    interval: 5,
    defaultTime: '00',

})
