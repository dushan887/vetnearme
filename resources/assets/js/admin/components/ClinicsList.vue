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

                        <form action="/admin/clinics/get"
                            id="filter-form"
                            role=form>

                            <input type="hidden" name="has-filter" id="has-filter" value="false">
                            <div class="box-header with-border">
                                <h3 class="box-title">Filters</h3>

                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="limit">Show entries:</label>
                                    <select class="form-control" name=limit id="limit">
                                        <option value="10">10</option>
                                        <option value="20">25</option>
                                        <option value="30">50</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="type">Practice type:</label>
                                    <select class="form-control" name=type id="type">
                                        <option value="any">Any</option>
                                        <option value="general_practice">General practice</option>
                                        <option value="specialist_and_emergency">Specialist and Emergency </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subscribed">Subscribed practice:</label>
                                    <select class="form-control" name=subscribed id="subscribed">
                                        <option value=any>Any</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="has-admin">Assigned admin:</label>
                                    <select class="form-control" name="has-admin" id="has-admin">
                                        <option value="any">Any</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="country">Country:</label>
                                    <select class="form-control" name=country id="country">
                                        <option value="any">Any</option>
                                        <option value="australia">Australia</option>
                                        <option value="new zealand">New Zealand</option>
                                    </select>
                                </div>

                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary" @click.prevent="filter()">
                                    <i class="fa fa-filter"></i> Apply Filter</button>
                                </div>

                            </div>

                        </form>
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
                                    <input type="text"
                                        class="form-control input-sm"
                                        id="search"
                                        name="search"
                                        @keyup="search($event.target.value)"
                                        placeholder="Search Practice">
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
                                        @click="openModal('delete-multiple', $event)">
                                        <i class="fa fa-trash-o"></i>
                                    </button>

                                    </div>
                                    <!-- /.btn-group -->
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fa fa-refresh"></i>
                                    </button>
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

                                                    <a type="button"
                                                        class="btn btn-default btn-sm"
                                                        rel="noopener noreferrer"
                                                        target="_blank"
                                                        :href="'/clinic/' + clinic.name.toLowerCase().replace(/\s/g, '-')"
                                                    >
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <button type="button" class="btn btn-default btn-sm"
                                                        @click='redirect("edit", clinic)'>
                                                    <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-default btn-sm"
                                                        :data-id="clinic.id"
                                                        @click="openModal('delete-single', $event)"
                                                    >
                                                        <i class="fa fa-trash-o"
                                                            data-text="clinic"
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

                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right" v-if="pagination.pages">
                                    <li><a href="#" @click.prevent="getClinics(pagination.prevPage)">«</a></li>

                                    <li v-for="n in pagination.pages" :key="n">
                                        <a href="#"
                                            @click.prevent="getClinics(paginationLink(n))">{{ n }}</a>
                                    </li>

                                    <li><a href="#" @click.prevent="getClinics(pagination.nextPage)">»</a></li>
                                </ul>
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
            clinics: [],
            pagination: {
                pages: 0,
                currentPage: 0,
                prevPage: '',
                nextPage: ''
            }
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
        getClinics(href){

            if(!href)
                return

            let filterForm = $('#filter-form')
            let hasFilters = filterForm.find('#has-filter').val()
            let nameSearch = $('#search').val()

            let additionalData = hasFilters === 'true' ? '&' + filterForm.serialize() : ''

            if(nameSearch.length >= 3 ){
                additionalData += additionalData !== '' ? '&name=' + nameSearch : '?name=' + nameSearch
            }

            axios.get(href + additionalData, {
                params: {role: this.clinicrole}
            })
            .then((response) => {
                this.populateClinics(response.data)
            })
        },
        populateClinics(data){
            this.pagination.pages       = data.last_page
            this.pagination.currentPage = data.current_page
            this.pagination.prevPage    = data.prev_page_url
            this.pagination.nextPage    = data.next_page_url

            this.clinics = data.data
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
        openModal(action, event){

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
        },
        paginationLink(n){
            if(n === this.pagination.currentPage)
                return null

            return "/admin/clinics/get?page=" + n
        },
        filter(){

            let form = $('#filter-form')

            axios.get(form.attr('action') + '?' + form.serialize(), {})
            .then((response) => {
                this.populateClinics(response.data)

                form.find('#has-filter').val('true')
            })

        },
        search(search){

            if(!search.length !== search.length >= 3)
                this.getClinics('/admin/clinics/get')
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
        this.getClinics('/admin/clinics/get')
    }
}
</script>
