<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

</style>
<template>
    <div class="container">
          <!-- <div class="row justify-content-center"> -->
        <div class="row">
            <div class="col-md-12 mt-3">
                <!-- <div class="card">
                    <div class="card-header">Profile Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div> -->
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <!-- <div class="widget-user-header text-white" style="background: url('../dist/img/photo1.png') center center;"> -->
                    <div class="widget-user-header text-white" style="background: url('./img/alien.jpg')">
                <h3 class="widget-user-username ">{{this.form.name}}</h3>
                <h5 class="widget-user-desc ">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <!-- <img class="img-circle" src="../dist/img/user3-128x128.jpg" alt="User Avatar"> -->
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            </div>
  <div class="col-md-12">
        <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->

                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group ">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-12">
                          <input type="email" v-model="form.name" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group ">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-12">
                          <input type="email" v-model="form.email"  class="form-control" id="inputEmail" :class="{'is-invalid':form.errors.has('email')}" placeholder="Email">
                        </div>
                      </div>
                        <div class="form-group ">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-12">
                             <input type="password" v-model="form.password" class="form-control" id="inputPassword" placeholder="password">
                           <!-- <textarea class="form-control"  v-model="form.password" id="inputPassword" placeholder="Password"></textarea> -->
                        </div>
                      </div>
                         <div class="form-group ">
                        <label for="inputType" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-12">
                           <!-- <textarea class="form-control"  v-model="form.type" id="inputType" placeholder="Type"></textarea> -->
                           <input type="text" v-model="form.type" class="form-control" id="inputType" placeholder="Type">
                        </div>
                      </div>
                         <div class="form-group ">
                        <label for="inputBio" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-12">
                           <!-- <textarea class="form-control"  v-model="form.type" id="inputType" placeholder="Type"></textarea> -->
                           <input type="text" v-model="form.bio" class="form-control" id="inputBio" placeholder="bio">
                        </div>
                      </div>
                      <div class="form-group ">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group ">
                        <label for="photo" class="col-sm-2 col-form-label">Profile Photo</label>
                        <div class="col-sm-12">
                          <input type="file"  @change="updateProfile" class="form-input" name="photo">
                        </div>
                      </div>
                      <div class="form-group ">
                        <label for="passpord" class="col-sm-2 col-form-label">Passport (leave empty if not changed) </label>
                        <div class="col-sm-12">
                          <input type="passpord" class="form-control" id="passpord" placeholder="Passport">
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group ">
                        <div class="col-offset-sm-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
                return {
                    // profile: {},
                     form: new Form(
                    {
                        id: '',
                        name: '',
                        email: '',
                        password: '',
                        type: '',
                        bio: '',
                        photo: ''

                    }
                )
                }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
                getProfilePhoto()
                {

                let photo =(this.form.photo.length > 200 ) ? this.form.photo : "img/profile/"+ this.form.photo;
                return photo;
           // return "img/profile/"+ this.form.photo;

                }

                    ,
                updateInfo()
                {

                         this.$Progress.start();
                          this.form.put('api/profile');
                           then(()=> {
                                 Fire.$emit('AfterCreate');
                          this.$Progress.finish();
                }).
                 catch(()=> {
                       this.$Progress.fail();
                });
                },

                 updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }

                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        ,

    },
     created()
        {
                //  axios.get("api/profile").then(({data}) => (this.form.fill(data)));
            //   axios.get("api/profile").then(({data}) => (this.profile = data.data));
                axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
