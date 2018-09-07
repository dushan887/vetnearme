<template>
    <div>
        <section class="content-header">
            <h1>Posts</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Posts</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <div class="col-md-3">

                    <a href="'/admin/posts/create'" class="btn btn-primary btn-block margin-bottom">New Post</a>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        </div>
                        <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="mailbox.html"><i class="fa fa-file"></i> Posts</a></li>
                            <li><a href="#"><i class="fa fa-file-o"></i> Draft</a></li>
                            </li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <div class="box box-solid">

                        <form id=filter role=form>

                            <div class="box-header with-border">

                                <h3 class="box-title">Filters</h3>

                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                             <div class="box-body">

                                <div class="form-group">
                                    <label for="limit">Show entries:</label>
                                    <select class="form-control" name=limit id="limit">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label for="author">Author</label>
                                    <select class="form-control" name=author id="author">
                                    <option value="any">any</option>
                                    <option v-for="author in authors"
                                        :value="author.id"
                                        :key="author.id">{{ author.first_name + ' ' + author.last_name }}</option>
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name=status id="status">
                                        <option value="any">Any</option>
                                        <option value="1">Published</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date:</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right datepicker" name=date
                                        value="" id="date" type="text">
                                    </div>
                                </div>

                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"
                                        @click.prevent="getAll()">
                                        <i class="fa fa-filter"></i> Apply Filter</button>
                                </div>

                             </div>

                        </form>

                    </div>
                </div>

                <div class="col-md-9">

                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title">Post List</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text"
                                    id="search"
                                    @keyup="search($event.target.value)"
                                    class="form-control input-sm" placeholder="Search Posts">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>

                        </div>

                        <div class="mailbox-controls">

                            <div class="btn-group">
                                <a type="button" class="btn btn-default btn-sm"
                                    href="/admin/posts/create">
                                    <i class="fa fa-envelope-o"></i>
                                </a>

                            <button type="button"
                                    class="btn btn-default btn-sm"
                                    @click="openModal('delete-multiple')">
                                    <i class="fa fa-trash-o"></i>
                                </button>

                            </div>

                            <button type="button" class="btn btn-default btn-sm"
                                @click="this.getAll()">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <div class="pull-right"></div>
                        </div>

                        <div class="table-responsive">
                            <table
                                id="practice_table"
                                class="table table-bordered table-striped table-content"
                                data-url="/admin/posts/destroy"
                                data-text="post(s)">

                                <thead>
                                    <tr>
                                        <td width="35">
                                            <input type="checkbox"
                                            role="selectAll"
                                            value=null
                                            @click="selectAll($event.target)">
                                        </td>
                                        <th>Img</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Published Date</th>
                                        <th>Status</th>
                                        <th width="115">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr v-for="post in posts"
                                        :key=post.id
                                        :id="'entryid-' + post.id">
                                        <td width="35">
                                            <input
                                            type="checkbox"
                                            name="selected[]"
                                            :value="post.id"
                                            role="selectAll">
                                        </td>

                                        <td width="47">
                                            <img :src="coverImage(post)"
                                            alt="Cover Image" width="30" height="30">
                                        </td>

                                        <td>{{ post.title }}</td>
                                        <td>{{ post.user.first_name + ' ' + post.user.last_name  }}</td>
                                        <td>{{ getHumanDate(post.created_at)  }}</td>
                                        <td>{{ post.status ? 'Published' : "Draft" }}</td>
                                        <td>

                                            <div class="btn-group pull-right">
                                                <a type="button"
                                                    class="btn btn-default btn-sm"
                                                    :href="'/admin/posts/show/' + post.id">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a type="button" class="btn btn-default btn-sm"
                                                    :href="'/admin/posts/edit/' + post.id">
                                                <i class="fa fa-edit"></i>
                                                </a>

                                                <button type="button"
                                                    class="btn btn-default btn-sm"
                                                    :data-id="post.id"
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
                                        <th>Img</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Published Date</th>
                                        <th>Status</th>
                                        <th width="115">Action</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right" v-if="pagination.pages">
                                <li><a href="#" @click.prevent="getAll(pagination.prevPage)">«</a></li>

                                <li v-for="n in pagination.pages" :key="n">
                                    <a href="#"
                                        @click.prevent="getAll(n)">{{ n }}</a>
                                </li>

                                <li><a href="#" @click.prevent="getAll(pagination.nextPage)">»</a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
</template>

<script>

import moment from 'moment'

export default {
    data(){
        return {
            firstLoad: true,
            posts: [],
            authors: [],
            link: '/admin/posts/getAll',
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
        coverImage(post){
            return post.cover_image ?  '/postsCover/'  + post.cover_image : "http://via.placeholder.com/160x160"
        },
        getHumanDate(date) {
            return moment(date, 'YYYY-MM-DD HH:mm:ss').format('DD.MMMM, YYYY');
        },
        getAll(page){

            if(page === null || this.pagination.currentPage === page)
                return

            let filterForm = $('#filter')
            let postName   = $('#search').val()
            let data       = {}

            if(postName.length >= 3)
            {
                data.name = postName
            }

            if(filterForm.find("#date").val() !== ''){
                data.date = filterForm.find('#date').data('datepicker').getFormattedDate('yyyy-mm-dd')
            }

            data.author = filterForm.find('#author').val()
            data.limit  = filterForm.find('#limit').val()
            data.status = filterForm.find('#status').val()
            data.page   = page || 1

            axios.get(this.link, {
                params: data
            })
            .then((response) => {

                this.posts   = response.data.posts.data

                if(this.firstLoad)
                    this.authors = response.data.authors

                this.pagination.pages       = response.data.posts.last_page
                this.pagination.currentPage = response.data.posts.current_page

                this.pagination.prevPage    = response.data.posts.current_page === 1
                    ? null : response.data.posts.current_page - 1

                this.pagination.nextPage    = response.data.posts.last_page === response.data.posts.current_page
                    ? null : response.data.posts.current_page + 1

                this.firstLoad = false
            })

        },
        search(search){

            if(!search.length !== search.length >= 3)
                this.getAll()
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
        paginationLink(n){
            if(n === this.pagination.currentPage)
                return null

            return "/admin/posts/getAll?page=" + n
        }
    },
    mounted(){
        this.getAll()
    }
}
</script>
