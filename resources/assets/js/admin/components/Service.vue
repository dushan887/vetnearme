<template>
    <div>
        <h1>Services ({{ services.length }})</h1>
        <div class="services-actions">
            <button type="button" class="btn btn-primary" @click="openModal('store')">Add Service</button>
        </div>

        <div class="services clearfix row">
            <div class="col-md-2 col-sm-3 col-xs-4" v-for="(service, index) in services" :key="service.id">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{{ service.name }} ({{ service.count }})</h4>
                    </div>
                    <div class="panel-footer">
                        <button type="button"
                            class="btn btn-primary"
                            @click="openModal('edit')"
                            :data-id=service.id
                        >Edit</button>

                        <button type="button"
                            class="btn btn-danger"
                            @click="openModal('delete')"
                            :data-id=service.id
                        >Delete</button>
                    </div>
                </div>
            </div>
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
        openModal(action){

            let url;
            let data = {}

            switch (action) {
                case 'store':
                    url = '/admin/services/create'
                    this.getData(url)
                    break;

                case 'edit':
                    url = '/admin/services/edit/' + event.target.dataset.id
                    this.getData(url)
                    break;

                case 'delete':
                    let serviceID = event.target.dataset.id
                    url = '/admin/services/destroy/' + serviceID

                    this.$dialog.confirm('Are you sure you want to delete this service?',{
                        loader: true
                    })
                    .then((dialog) => {

                        axios.post(url, {
                            id: serviceID
                        })
                        .then((response) => {
                            dialog.close()

                            let serviceIndex = this.services.findIndex(service => serviceID)

                            Vue.delete(this.services, serviceIndex);
                        })
                        .catch((error) => {
                            console.log(error);
                            
                            alert('Something went wrong. Please try again a bit later')
                            dialog.close()
                        })

                    })
                    .catch(() => {
                        alert('Something went wrong. Please try again a bit later')
                    });
                    break;
            }
        },
        save(){

            let form  = $('#service-store')
            let action = form.data('action')

            axios.post(form.attr('action'), {
                name: form.find('#name').val()
            })
            .then((response) => {

               let data = response.data

               switch (action) {
                   case 'store':
                        this.services.unshift({id : data.id, name : data.name, count: 0})
                       break;

                    case 'update':

                        let serviceIndex = this.services.findIndex(service => service.id === data.id)

                        this.services[serviceIndex].name = data.name

                       break;
               }

               Event.$emit('modal:hide')
            })
            .catch((error) => {
                Event.$emit('form:errors:show', form, error.response.data.errors)
            })
        },
        getData(url){
            axios.get(url, {})
            .then((response) => {
               Event.$emit('modal:show', response.data)
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
