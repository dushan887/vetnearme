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

                <select :name="selectName()"
                    id="clinic"
                    class="form-control"
                    size="10">
                    <option :value="clinic.id"
                        :selected="isAssigned(clinic.users)"
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
    props: ['clinicrole', 'userid'],
    data(){
        return {
            searchValue: '',
            clinics: []
        }
    },
    methods: {
        selectName(){
            switch (this.clinicrole) {
                case 'owner':
                    return 'clinic_owner'
                    break;

                case 'user':
                    return 'clinic_user'
                    break;

                default:
                    return 'clinic_user'
                    break;
            }
        },
        search(value){
            this.searchValue = value
        },
        getClinics(){

            axios.get('/admin/clinics/get', {
                params: {role: this.clinicrole}
            })
            .then((response) => {
                this.clinics = response.data
            })
        },
        isAssigned(users){

            let isMember = false
            users.filter(user => {
                if(user.id === this.userid){
                    isMember = true
                }
            })

            return isMember
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
