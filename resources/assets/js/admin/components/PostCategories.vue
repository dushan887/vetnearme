<template>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Post Categories List</h3>

                <div class="box-tools pull-right">
                    <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search Post Categories">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="box-body no-padding">

                <div class="mailbox-controls">

                <div class="btn-group">

                    <button type="button" class="btn btn-default btn-sm" @click="openModal('create')">
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
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr :id="'entryid-' + category.id"
                            v-for="(category, index) in categories" :key="category.id">
                            <td>
                                <input
                                type="checkbox"
                                name="selected[]"
                                :value="category.id"
                                role="selectAll">
                            </td>
                            <td>{{ category.name }}</td>
                            <td>

                                <button type="button"
                                    class="btn btn-default btn-sm"
                                    @click="openModal('edit')"
                                    :data-id=category.id
                                ><i class="fa fa-edit"></i></button>

                                <button type="button"
                                    class="btn btn-default btn-sm"
                                     @click="openModal('delete')"
                                    :data-id=category.id>
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
            categories: []
        }
    },
    methods: {
        getAll(){
            axios.get('/admin/post-categories/all', {})
            .then((response) => {
                this.categories = response.data
            })
        },
        save(){

            let form   = $('#post-category')
            let action = form.data('action')

            axios.post(form.attr('action'), {
                name: form.find('#name').val()
            })
            .then((response) => {

               let data = response.data

               switch (action) {
                   case 'store':
                        this.categories.unshift({id : data.category.id, name : data.category.name})
                       break;

                    case 'update':

                        let index = this.categories.findIndex(category => category.id === data.category.id)

                        this.categories[index].name = data.category.name

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
        openModal(action){

            let url;
            let data = {}

            switch (action) {

                case 'create':
                    url = '/admin/post-categories/create'
                    this.getData(url)
                    break;

                case 'edit':

                    let element = event.target.tagName === "I" ? event.target.parentNode : event.target

                    url = '/admin/post-categories/edit/' + element.dataset.id
                    this.getData(url)
                    break;

                case 'delete':

                    let categoryID = event.target.dataset.id
                    url = '/admin/post-categories/destroy/' + categoryID

                    this.$dialog.confirm('Are you sure you want to delete this category?',{
                        loader: true
                    })
                    .then((dialog) => {

                        axios.post(url, {
                            id: categoryID
                        })
                        .then((response) => {

                            let data = response.data
                            dialog.close()

                            let index = this.categories.findIndex(category => categoryID)

                            Vue.delete(this.categories, index);

                            Event.$emit('message:show', {
                                messageTitle: data.messageTitle,
                                messageText:  data.messageText
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
                    break;
            }
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

        Event.$on('post-category:save', () => {
            this.save()
        })

    }
}
</script>
