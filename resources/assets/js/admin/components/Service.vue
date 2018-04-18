<template>
    <div>
        <h1>Services ({{ services.length }})</h1>
        <div class="services-actions">
            <button type="button" class="btn btn-primary" @click="openModal">Add Service</button>
        </div>
        <div class="services" v-for="(service, index) in services" :key="service.id">
            <p>{{ service.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            services: []
        }
    },
    methods: {
        getAll(){
            axios.get('/admin/services/all', {})
            .then((response) => {
                this.services = response.data
            })
        },
        openModal(){
            axios.get('/admin/services/create', {})
            .then((response) => {
               Event.$emit('modal:show', response.data)
            })
        },
        save(){

            let form  = $('#service-store')

            axios.post('/admin/services/store', {
                name: form.find('#name').val()
            })
            .then((response) => {

               let service = response.data

               this.services.unshift({'id' : service.id, 'name' : service.name})

               Event.$emit('modal:hide')
            })
            .catch((error) => {
                Event.$emit('form:errors:show', form, error.response.data.errors)
            })
        }

    },
    mounted(){
        this.getAll()

        Event.$on('service:save', () => {
            this.save()
        })
    }
}
</script>
