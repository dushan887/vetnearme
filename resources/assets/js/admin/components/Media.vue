<template>
    <div>

        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Extension</th>
                                <th>Uploaded By</th>
                                <th>Date Uploaded</th>
                                <th>Actions</th>
                            </tr>

                            <tr v-for="(file, index) in files" :key=file.id>
                                <th>{{ file.name }}</th>
                                <th>{{ file.extension }}</th>
                                <th>{{ file.user.name }}</th>
                                <th>{{ getHumanDate(file.created_at)  }}</th>
                                <th>
                                    <button type="button" class="btn btn-block btn-danger"
                                    @click="openModal('delete')"
                                    :data-id=file.id>Delete</button>
                                </th>
                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import moment from 'moment'

export default {
    data(){
        return {
            files: []
        }
    },
    methods: {
        getHumanDate : function (date) {
            return moment(date, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
        },
        getAll(){
            axios.get('/admin/media/all', {})
            .then((response) => {
                this.files = response.data
            })
        },
        openModal(action){

            let url;
            let data = {}


            switch (action) {

                case 'delete':
                    let fileID = event.target.dataset.id
                    url = '/admin/media/destroy/' + fileID
                    console.log(url);

                    this.$dialog.confirm('Are you sure you want to delete this file?',{
                        loader: true
                    })
                    .then((dialog) => {

                        axios.post(url, {
                            id: fileID
                        })
                        .then((response) => {

                            let data = response.data
                            dialog.close()

                            let fileIndex = this.files.findIndex(file => fileID)

                            Vue.delete(this.files, fileIndex);

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

        Event.$on('service:save', () => {
            this.save()
        })
    }
}
</script>
