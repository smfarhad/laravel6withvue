<template>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 ">
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle"
                              :src="showProfileImage()"
                              alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"> {{form.name}} </h3>

                        <p class="text-muted text-center">
                            <span v-for="userType of userTypes" :key="userType.id" v-show="(form.type == userType.id) ? true : false" > {{userType.name}} </span>
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b>Followers</b> <a class="float-right">1,322</a>
                          </li>
                          <li class="list-group-item">
                            <b>Following</b> <a class="float-right">543</a>
                          </li>
                          <li class="list-group-item">
                            <b>Friends</b> <a class="float-right">13,287</a>
                          </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>
                        <p class="text-muted">
                          B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted">Malibu, California</p>
                        <hr>
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                        <p class="text-muted">
                          <span class="tag tag-danger">UI Design</span>
                          <span class="tag tag-success">Coding</span>
                          <span class="tag tag-info">Javascript</span>
                          <span class="tag tag-warning">PHP</span>
                          <span class="tag tag-primary">Node.js</span>
                        </p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-9">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                          <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                              <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/images/profile.png" alt="user image">
                                <span class="username">
                                  <a href="#">Jonathan Burke Jr.</a>
                                  <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                              </div>
                              <!-- /.user-block -->
                              <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                              </p>

                              <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                <span class="float-right">
                                  <a href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                  </a>
                                </span>
                              </p>

                              <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                              <div class="user-block">
                                <img class="img-circle img-bordered-sm" :src="showProfileImage" alt="User Image">
                                <span class="username">
                                  <a href="#">Sarah Ross</a>
                                  <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Sent you a message - 3 days ago</span>
                              </div>
                              <!-- /.user-block -->
                              <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                              </p>

                              <form class="form-horizontal">
                                <div class="input-group input-group-sm mb-0">
                                  <input class="form-control form-control-sm" placeholder="Response">
                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-danger">Send</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <!-- // post -->
                          </div>
                        

                          <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                              <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                  <input v-model="form.name"
                                        :class="{ 'is-invalid': form.errors.has('name') }" 
                                        class="form-control" type="name" id="name" placeholder="Name">
                                  <has-error :form="form" field="name"></has-error>
                                </div>
                              </div>
                          
                              
                              <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                  <input v-model="form.email" 
                                        :class="{ 'is-invalid': form.errors.has('email') }" 
                                        type="email" class="form-control" id="email" placeholder="Email">
                                  <has-error :form="form" field="email"></has-error>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="profileImage" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                  <div class="custom-file">
                                    <input @change="updateProfileImage"  
                                          type="file"  id="profileImage" name="" placeholder="Profile Image">
                                  </div>
                                </div>
                              </div>               

                              <div class="form-group row">
                                <label for="bioData" class="col-sm-2 col-form-label">Short Biodata</label>
                                <div class="col-sm-10">
                                  <textarea v-model="form.bioData" 
                                            :class="{ 'is-invalid': form.errors.has('bioData') }" 
                                            class="form-control" id="bioData" placeholder="Please describe yourself shortly"></textarea>
                                  <has-error :form="form" field="bioData"></has-error>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                  <input v-model="form.password" 
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                        type="password" class="form-control" id="password" placeholder="Password">
                                  <has-error :form="form" field="password"></has-error>
                                </div>
                              </div>
                              

                              <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                  <button @click.prevent="updateInfo" type="submit" 
                                  class="btn btn-danger">Update</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                      </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div><!-- /.container-fluid -->
            </section>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return { 
             userTypes: userTypes,
             form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bioData: '',
                    photo: ''
                })
          }
        },
        mounted() {
          //  console.log( userTypes );
        },
        methods:{
          showProfileImage(){
                let profileImage = "profile.png";
                if(this.form.photo == profileImage || this.form.photo == ""){
                  this.form.photo = profileImage;
                }
                return "/images/profile/"+this.form.photo;
          },
          updateProfileImage(element){
              let file = element.target.files[0];
             
              let reader = new FileReader();

             if(file['size'] < 2111775){   
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file); 
              } else{
                  Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Your are uploading a large file',
                  })
              }
          },
          updateInfo(){
            this.$Progress.start();
            this.form.put('/api/profile')
            .then(()=>{
                this.$Progress.finish();
            })
            .catch(()=>{
               this.$Progress.fail();
            });
          }
        },
        created(){
          axios.get('/api/profile')
          .then(({data})=>(this.form.fill(data)));
        }
    }
</script>
