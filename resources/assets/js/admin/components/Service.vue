<template>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Service List</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                    <input type="text"
                        id="search"
                        class="form-control input-sm"
                        placeholder="Search Services"
                        @keyup="search($event.target.value)">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="box-body no-padding">

                <div class="mailbox-controls">

                <div class="btn-group">

                    <button type="button" class="btn btn-default btn-sm" @click="openModal('store')">
                        <i class="fa fa-edit"></i>
                    </button>

                </div>
                <!-- /.btn-group -->
                <button type="button"
                    class="btn btn-default btn-sm"
                    @click="getAll()">
                    <i class="fa fa-refresh"></i>
                </button>

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
                            @click="selectAll($event.target)"
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

                                <button type="button"
                                    class="btn btn-default btn-sm"
                                     @click="openModal('delete')"
                                    :data-id=service.id>
                                    <i class="fa fa-trash-o"></i>
                                </button>
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
        selectAll(element) {
            Event.$emit('select:all', element)
        },
        getAll(){

            let serviceName = $('#search').val()
            let data        = ''

            if(serviceName.length >= 3)
            {
                data = '?name=' + serviceName
            }

            axios.get('/admin/services/all' + data, {})
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

                    element = event.target.tagName === "I" ? event.target.parentNode : event.target

                    url = '/admin/services/edit/' + element.dataset.id
                    this.getData(url)
                    break;

                case 'delete':

                    element = event.target.tagName === "I" ? event.target.parentNode : event.target

                    let serviceID = element.dataset.id

                    url = '/admin/services/destroy/' + serviceID

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
                    .catch((error) => {
                        console.log('Delete canceled')
                    });
                    break;

                case 'priority':

                    let element = event.target.tagName === "I" ? event.target.parentNode : event.target
                    let url     = '/admin/services/changePriorityStatus/' + element.dataset.id

                    this.$dialog.confirm('Are you sure you want to change priority status of this service?',{
                        loader: true
                    }).then((dialog) => {

                        // Only 12 priority services can be present at one time
                        let priorityCount = this.services.filter(service => service.priority === 1)

                        if(priorityCount.length >= 12){
                            alert("You can only have 12 priority services")
                            dialog.close()
                            return
                        }

                        axios.post(url, {
                            id:       element.dataset.id,
                            priority: element.dataset.priority
                        })
                        .then((response) => {

                            let data = response.data
                            dialog.close()

                            let serviceIndex = this.services.findIndex(service => service.id === data.service.id)

                            this.services[serviceIndex].priority = data.service.priority

                            Event.$emit('message:show', {
                                messageTitle: data.messageTitle,
                                messageText:  data.messageText
                            }, data.class)
                        })
                        .catch((error) => {

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

            let form   = $('#service-store')
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
        },
        search(search){

            if(!search.length !== search.length >= 3)
                this.getAll()
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
