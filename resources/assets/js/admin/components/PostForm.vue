<template>
    <div>
        <section class="content-header">

            <h1>New Post</h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Post</a></li>
                <li class="active">New Post</li>
            </ol>

        </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <form role="form"
          :action="action"
          enctype="multipart/form-data"
          method="post"
          id="post-form">
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">New Post</h3>
              </div>
              <!-- /.box-header -->

              <div class="box-body">

                <div class="form-group" data-group=title>
                  <input class="form-control" name="title" id="title" placeholder="Title"
                  @keyup="titleAction"
                  v-model="post.title">
                </div>

                <div class="form-group" data-group=permalink>
                  <input class="form-control" name=permalink id="permalink"
                  placeholder="permalink"
                  v-model=post.permalink>
                </div>

                <div class="form-group" data-group=body>
                  <textarea id="body" name="body" class="form-control"
                  style="height: 300px"
                   v-model=post.body></textarea>
                </div>

              </div>
              <!-- /.box-body -->

            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->

        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Status</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <a href="#"
                @click="save('publish')"
                class="btn btn-success btn-block">Publish</a>
              <a href="#"
                 @click="save('draft')"
                class="btn btn-primary btn-block">Draft</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

          <div class="box box-solid">

            <div class="box-header with-border">
              <h3 class="box-title">Category</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="box-body">

              <div class="form-group">
                <select
                  name="category_id"
                  id="category_id"
                  class="form-control">
                    <option
                      v-for="category in categories"
                      :key=category.id
                      :value="category.id">{{ category.name }}</option>
                </select>
              </div>

              <div class="form-group" data-group=name>

                <div class="col-xs-9 no-padding">
                  <input type="text"
                    name="category_name"
                    id=category_name
                    class="form-control"
                    placeholder="Enter New Categorie">
                </div>

                <div class="col-xs-3 no-padding">
                  <button type="button"
                  class="btn btn-square btn-block btn-primary"
                  @click="newCategory"
                  style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                    <i class="fa fa-plus"
                    @click="newCategory"></i>
                </button>

                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

          <div class="box box-solid">

            <div class="box-header with-border">
              <h3 class="box-title">Cover Image</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="box-body">
              <div class="form-group">
                  <label for="cover_image">File input</label>
                  <input type="file" id="cover_image" name="cover_image">
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

           <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Expert</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group" data-group=expert>
                <textarea
                  :value=post.expert
                  class="form-control" name=expert id=expert rows="3" placeholder="Enter ..." ></textarea>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

        </div>
        <!-- /.col -->
        </form>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    </div>
</template>

<script>
export default {
  props: {
    postid: {
      default: null
    }
  },
  data(){
      return {
          post: {
            title: '',
            permalink: '',
            body: '',
            expert: '',
            status: '',
            cover_image: '',
            category_id: null,
          },
          categories:[],
          action: this.postid ? '/admin/posts/update/' + this.postid : '/admin/posts/store',
          form: $('#post-form')
      }
  },
  methods: {
    titleAction(){

      if(!this.postid){
        let title = event.target.value

        this.post.permalink = title.toLowerCase().split(' ').join('-');

        this.post.expert    = title
      }
    },
    getCategories(){
      axios.get('/admin/post-categories/all', {})
          .then((response) => {
              this.categories = response.data
          })
    },
    save(status){

      let postData = new FormData()
      let cover    = document.getElementById("cover_image")

      postData.set('title', this.post.title)
      postData.set('permalink', this.post.permalink)
      postData.set('body', this.post.body)
      postData.set('expert', this.post.expert)
      postData.set('status', status === 'publish' ? 1 : 0)
      postData.set('category_id', $('#category_id').val())
      postData.append("cover_image", cover_image.files[0])

      axios.post(this.action, postData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
     })
      .then(function (response) {
          //handle success
          console.log(response);
      })
      .catch(function (error) {
          Event.$emit('form:errors:show', this.form, error.response.data.errors)
      });

    },
    newCategory(){

      let categoryName = $('#category_name').val()

      axios.post('/admin/post-categories/store', {
          name: categoryName
      })
      .then((response) => {

        let data = response.data

        this.categories.unshift({id : data.category.id, name : data.category.name})

        $('#category_name').val('')

        Event.$emit('message:show', {
                        messageTitle: data.messageTitle,
                        messageText:  data.messageText
                }, data.class)
      })
      .catch((error) => {
          Event.$emit('form:errors:show', this.form, error.response.data.errors)
      })

    }
  },
  mounted(){
    this.getCategories()
  }
}
</script>

