<template>

    <div>

        <section class="content-header">
            <h1>
                Practices
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Practices</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <!-- SIDEBAR START -->
                <div class="col-md-3">

                    <a href="/admin/clinics/create" class="btn btn-primary btn-block margin-bottom">Add New Practice</a>

                    <a href="/admin/clinics/export" class="btn btn-info btn-block margin-bottom"
                    aria-label="Left Align">Export Practices</a>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <h3 class="box-title">Filters</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        </div>
                        <div class="box-body">
                        <div class="form-group">
                            <label for="filter-opt3">Show entries:</label>
                            <select class="form-control" id="filter-opt3">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-opt1">Practice type:</label>
                            <select class="form-control" id="filter-opt1">
                            <option>Any</option>
                            <option>General practice</option>
                            <option>Specialist and Emergency </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-opt2">Subscribed practice:</label>
                            <select class="form-control" id="filter-opt2">
                            <option>Any</option>
                            <option>Yes</option>
                            <option>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-opt5">Assigned admin:</label>
                            <select class="form-control" id="filter-opt5">
                            <option>Any</option>
                            <option>Yes</option>
                            <option>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-opt4">Country:</label>
                            <select class="form-control" id="filter-opt4">
                            <option>Any</option>
                            <option>Australia</option>
                            <option>New Zealand</option>
                            </select>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">
                            <i class="fa fa-filter"></i> Apply Filter</button>
                        </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                    </div>
                    <!-- SIDEBAR END -->

                    <!-- CLINICS LIST START -->
                    <div class="col-md-9">
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <h3 class="box-title">Practice List</h3>

                                <div class="box-tools pull-right">
                                    <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Practice">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
                                </div>
                                <!-- /.box-tools -->
                            </div>


                            <div class="box-body no-padding">

                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                        <i class="fa fa-square-o"></i>
                                    </button>
                                    <div class="btn-group">

                                    <button type="button" class="btn btn-default btn-sm"
                                        onclick='window.location.href=/admin/clinics/create'>
                                        <i class="fa fa-envelope-o"></i>
                                    </button>

                                    <button type="button"
                                        class="btn btn-default btn-sm"
                                        @click="openModal('delete-multiple')">
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
                                    data-url="/admin/clinics/destroy"
                                    data-text="clinic(s)"
                                >

                                    <thead>
                                        <tr>
                                        <td width="35">
                                            <input type="checkbox"
                                            role="selectAll"
                                            value=null
                                            @click="selectAll($event.target)">
                                        </td>
                                        <th>Logo</th>
                                        <th>Clinic</th>
                                        <th>Administrator</th>
                                        <th>Subscription</th>
                                        <th>Country</th>
                                        <th width="150">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr v-for="clinic in clinics"
                                            :key="clinic.id"
                                            :id="'entryid-' + clinic.id"
                                        >
                                            <td width="35">
                                                <input
                                                type="checkbox"
                                                name="selected[]"
                                                :value="clinic.id"
                                                role="selectAll">
                                            </td>

                                            <td width="47">
                                                <img :src="clinicLogo(clinic)"
                                                    :alt="clinic.name + 'Logo'" width="30" height="30">
                                            </td>

                                            <td>{{ clinic.name }}</td>
                                            <td>{{ clinic.owner ? clinic.owner.last_name : "Doesn't have an owner" }}</td>
                                            <td>{{ clinic.subscribe ? 'Yes' : 'No' }}</td>
                                            <td>{{ clinic.country.name }}</td>

                                            <td width="150">
                                                <div class="btn-group pull-right">

                                                    <button type="button"
                                                    class="btn btn-default btn-sm"
                                                        @click='redirect("show", clinic)'>
                                                        <i class="fa fa-eye"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-default btn-sm"
                                                        @click='redirect("edit", clinic)'>
                                                    <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-default btn-sm"
                                                        :data-id="clinic.id"
                                                    >
                                                        <i class="fa fa-trash-o"
                                                            data-text="clinic"
                                                            @click="openModal('delete-single')"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                        <td width="35">
                                            <input type="checkbox"
                                            value=null
                                            role="selectAll"
                                            @click="selectAll($event.target)">
                                        </td>
                                        <th>Logo</th>
                                        <th>Clinic</th>
                                        <th>Administrator</th>
                                        <th>Subscription</th>
                                        <th>Country</th>
                                        <th width="150">Action</th>
                                        </tr>
                                    </tfoot>

                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- CLINICS LIST END -->
            </div>

        </section>

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
        selectAll(target){
            Event.$emit('select:all', target)
        },
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
        },
        openModal(action){

            let url;
            let data = {}

            switch (action) {
                case 'delete-single':

                    let element = event.target.tagName === "I" ? event.target.parentNode : event.target

                    Event.$emit('delete:entry', element)

                    break;

                case 'delete-multiple':

                    Event.$emit('delete:multiple')

                    break;

            }
        },
        clinicLogo(clinic){
            return  clinic.logo ? '/img/logo/' + clinic.logo : 'http://via.placeholder.com/160x160'
        },
        redirect(action, clinic){
            window.location.href="/admin/clinics/" + action + "/" + clinic.id
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
