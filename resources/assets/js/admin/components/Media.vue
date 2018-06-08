<template>
    <div>

        <div class="col-md-12 clearfix">
            <div class="box">
                <div class="box-body table-responsive no-padding media">
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
                                <th @mouseenter="imagePreview(file, $event)"
                                    @mouseout="removePreview">{{ file.name }}</th>
                                <th>{{ file.extension }}</th>
                                <th>{{ file.user.name }}</th>
                                <th>{{ getHumanDate(file.created_at)  }}</th>
                                <th>

                                    <span v-if="imageExtensions.includes(file.extension)">
                                        <button
                                        type="button"
                                        class="btn btn-sm btn-primary"
                                        @click="openModal('galery')"
                                        v-if="!file.gallery"
                                        data-action=put
                                        :data-id=file.id>Put in gallery</button>

                                        <button
                                        type="button"
                                        class="btn btn-sm btn-primary"
                                        @click="openModal('galery')"
                                        data-action=remove
                                        v-else
                                        :data-id=file.id>Remove from gallery</button>
                                    </span>

                                    <button type="button" class="btn btn-sm btn-danger"
                                    @click="openModal('delete')"
                                    :data-id=file.id>Delete</button>
                                </th>
                            </tr>

                        </tbody>

                    </table>

                    <img class="image-preview-container" style="display:none;" src="">
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
            files: [],
            imageExtensions: ['jpg', 'jpeg', 'png', 'gif']
        }
    },
    methods: {
        getHumanDate(date) {
            return moment(date, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
        },
        imagePreview(file, event) {

            let imageContainer = $('.image-preview-container')
            let folder = file.clinic_id ? '/media/' + file.clinic.name.trim().toLowerCase().replace('/ /g', "_")  :
                '/media/general/'

            if (this.imageExtensions.includes(file.extension))
                imageContainer.attr('src',  folder + file.name).show()

        },
        removePreview(){
            $('.image-preview-container').hide()
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
                case 'galery':

                    if(event.target.dataset.action === 'put'){
                        let countGallery = this.files.filter(file => file.gallery)

                        if(countGallery.length >= 5){
                            alert('You can only have 5 images in the gallery')
                            return
                        }

                    }


                    axios.post('/admin/media/galleryUpdate', {
                            id: event.target.dataset.id
                        })
                        .then((response) => {

                            let data = response.data

                            let fileIndex = this.files.findIndex(file => data.media.id)

                            this.files[fileIndex].gallery = data.media.gallery

                            Event.$emit('message:show', {
                                messageTitle: data.messageTitle,
                                messageText:  data.messageText
                            }, data.class)
                        })
                        .catch((error) => {
                            console.log(error);

                            alert('Something went wrong. Please try again a bit later')
                        })
                    break;
            }
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
