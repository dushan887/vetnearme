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
import PostCategories from './components/PostCategories.vue'
import PostForm from './components/PostForm.vue'

let adminVue = new Vue({
    el: '#admin-app',
    mixins: [Form],
    components: {
        adminService: Service,
        adminMedia: Media,
        adminModal: Modal,
        adminAlerts: EventMessages,
        adminClinics: ClinicsList,
        adminPostCategories: PostCategories,
        adminPostForm: PostForm
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
            $('input[role=selectAll]').prop('checked', element.checked)
        },
        deleteEntry(element){

            let table = $('.table-content')
            let text  = table.data('text')
            let id    = !Array.isArray(element) ? element.dataset.id : element
            let url   = table.data("url") + '/' + id

            this.$dialog.confirm('Are you sure you want to delete this ' + text +'?', {
                loader: true
            }).then((dialog) => {

                axios.post(url)
                .then((response) => {

                    let data = response.data

                    this.removeElement(id)

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
                console.log('Delete aborted')
            });
        },
        deleteMultiple(){

            let selected = $("input[role=selectAll]:checked").map(function () {
                return $(this).val();
            }).get().filter(element => element !== 'null')

            if(selected.length){
                this.deleteEntry(selected)

                $('input[role=selectAll]').prop('checked', false)
            }

        },
        removeElement(elemenID){

            if(Array.isArray(elemenID)){
                elemenID.forEach((id) => {
                    $('#entryid-' + id).slideUp('fast', () => {
                        $(this).remove()
                    })
                })
            } else {
                $('#entryid-' + elemenID).slideUp('fast', () => {
                    $(this).remove()
                })
            }

        }
    },
    mounted(){

        Event.$on('form:errors:show', (form, errors) => {
            Form.showErrors(form, errors)
        })

        Event.$on('select:all', (element) => {
            this.selectAll(element)
        })

        Event.$on('delete:entry', (element) => {
            this.deleteEntry(element)
        })

        Event.$on('delete:multiple', () => {
            this.deleteMultiple()
        })
    }
})

//Timepicker
$('.timepicker').timepicker({
    timeFormat: 'HH:mm',
    interval: 5
})

if (typeof tinymce !== 'undefined') {

    tinymce.init({
        selector: '.editor',
        toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
        plugins: 'code'
      });

}

