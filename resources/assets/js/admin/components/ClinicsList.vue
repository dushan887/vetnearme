<template>

    <div>
        <div class="form-group has-warning">
            <label for="asignClinic" class="col-sm-2 control-label">Clinic</label>

            <div class="col-sm-10">
                <input type="text"
                    class="form-control"
                    id="asignClinic"
                    @input="search($event.target.value)"
                    placeholder="Clinic Name">
            </div>
        </div>

        <div class="form-group">
            <label for=clinic class="col-sm-2 control-label">Clinics</label>
            <div class="col-sm-10">

                <select name="clinic" id="clinic" class="form-control" size="10">
                    <option :value="clinic.id"
                        :selected="clinic.owner_id === userid"
                        v-for="clinic in filteredList"
                        :key="clinic.id" >
                        {{clinic.name}}
                    </option>
                </select>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: ['userid'],
    data(){
        return {
            searchValue: '',
            clinics: []
        }
    },
    methods: {
        search(value){
            this.searchValue = value
        },
        getClinics(){
            axios.get('/admin/clinics/all', {})
            .then((response) => {
                this.clinics = response.data
            })
        }
    },
    computed: {
        filteredList() {

            return this.clinics.filter(clinic => {
                return clinic.name.toLowerCase().includes(this.searchValue.toLowerCase())
            })
        }
    },
    mounted(){
        this.getClinics()
    }
}
</script>
