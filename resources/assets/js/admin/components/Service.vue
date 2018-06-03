<template>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Service List</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search Services">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="box-body no-padding">

                <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">

                    <button type="button" class="btn btn-default btn-sm" @click="openModal('store')">
                    <i class="fa fa-edit"></i>
                    </button>

                    <button type="button"
                    class="btn btn-default btn-sm"
                    >
                    <i class="fa fa-trash-o"></i>
                    </button>

                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>

                <div class="pull-right"></div>
                <!-- /.pull-right -->
              </div>

            </div>

            <div class="table-responsive">

                <table id="practice_table"
                  class="table table-bordered table-striped table-content"
                  data-url="/admin/services/destroy"
                  data-text="clinic"
                >

                    <thead>
                        <tr>
                            <td width="35">
                            <input type="checkbox"
                            role="selectAll"
                            value=null
                            >
                            </td>
                            <th>Name</th>
                            <th>Count</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr :id="'entryid-' + service.id"
                            v-for="(service, index) in services" :key="service.id">
                            <td>
                                <input
                                type="checkbox"
                                name="selected[]"
                                :value="service.id"
                                role="selectAll">
                            </td>
                            <td>{{ service.name }}</td>
                            <td>{{ service.count }}</td>
                            <td>

                                <button type="button"
                                    class="btn btn-default btn-sm"
                                    @click="openModal('priority')"
                                    :data-id=service.id
                                    :data-priority=service.priority
                                    title="Priority Status"
                                >
                                    <i class="fa fa-check-circle" v-if="service.priority"></i>
                                    <i class="fa fa-circle-o" v-else></i>
                                </button>

                                <button type="button"
                                    class="btn btn-default btn-sm"
                                    @click="openModal('edit')"
                                    :data-id=service.id
                                ><i class="fa fa-edit"></i></button>
                            </td>

                        </tr>
                    </tbody>

                </table>
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

                    url = '/admin/services/destroy/' + event.target.dataset.id

                    this.$dialog.confirm('Are you sure you want to delete this service?',{
                        loader: true
                    })
                    .then((dialog) => {

                        axios.post(url, {
                            id: serviceID
                        })
                        .then((response) => {

                            let data = response.data
                            dialog.close()

                            let serviceIndex = this.services.findIndex(service => serviceID)

                            Vue.delete(this.services, serviceIndex);

                            Event.$emit('message:show', {
                                messageTitle: data.messageTitle,
                                messageText:  data.messageText
                            }, data.class)
                        })
                        .catch((error) => {

                            alert('Something went wrong. Please try again a bit later')
                            dialog.close()
                        })

                    })
                    .catch(() => {
                        console.log('Delete canceled')
                    });
                    break;

                case 'priority':

                    let element = event.target
                    let url     = '/admin/services/changePriorityStatus/' + element.dataset.id

                    this.$dialog.confirm('Are you sure you want to change priority status of this service?',{
                        loader: true
                    }).then((dialog) => {

                        axios.post(url, {
                            id:       element.dataset.id,
                            priority: element.dataset.priority
                        })
                        .then((response) => {

                            let data = response.data
                            dialog.close()

                            let serviceIndex = this.services.findIndex(service => serviceID)

                            Vue.delete(this.services, serviceIndex);

                            Event.$emit('message:show', {
                                messageTitle: data.messageTitle,
                                messageText:  data.messageText
                            }, data.class)
                        })
                        .catch((error) => {

                            alert('Something went wrong. Please try again a bit later')
                            dialog.close()
                        })

                    })
                    .catch(() => {
                        console.log('Changing status canceled')
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
                        this.services.unshift({id : data.service.id, name : data.service.name, count: 0})
                       break;

                    case 'update':

                        let serviceIndex = this.services.findIndex(service => service.id === data.service.id)

                        this.services[serviceIndex].name = data.service.name

                       break;
               }

               Event.$emit('modal:hide')

               Event.$emit('message:show', {
                                messageTitle: data.messageTitle,
                                messageText:  data.messageText
                        }, data.class)
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
