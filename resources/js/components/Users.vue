<template>
    <div class="row">
        <div class="col-12" v-if="$gate.isAdmin()">
        <div class="card">
            <div class="card-header">
            <h2 class="card-title">
                User Table
            </h2>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">     -->
                     <button type="button" class="btn btn-primary" @click="newModal">     
                    Add New 
                    <i class="fas fa-user-plus fa-fw"></i>
                    </button>
                </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Joined At</th>
                    <th>Modify</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}  </td>
                    <td>{{user.name}} </td>
                    <td> {{user.email}} </td>
                    
                    <td>
                        <span v-if="user.type == 1">  Admin  </span>
                        <span v-if="user.type == 2">  Statdered User  </span>
                        <span v-if="user.type == 3">  Author  </span>
                    </td>
                    <td> {{user.created_at | momentDate}} </td>
                    <td>
                        <a class="text-info" href="#"  @click="editModal(user)">
                            <i class="fas fa-edit fa-fw fa-1"></i>
                        </a> 
                        <a  class="text-danger"  href="#"  @click="deleteUser(user.id)">
                            <i class="fas fa-trash fa-fw fa-1"></i>
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>

        <!-- Add  Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-if="editMode" class="modal-title" id="addUserModalTitle"> Update User </h5>
                <h5 v-else class="modal-title" id="addUserModalTitle">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form @submit.prevent="editMode ? updateUser() :createUser()">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Name" id="name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.email" type="email" name="email" 
                        placeholder="Email Address" id="email"
                         class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.bioData" type="bio" name="bioData" 
                        placeholder="Describe yoursellf word in " id="bioData" class="form-control" 
                        :class="{ 'is-invalid': form.errors.has('bioData') }"></textarea>
                        <has-error :form="form" field="bioData"></has-error>
                    </div>
                    <div class="form-group">
                        <select v-model="form.type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }"> 
                            <option value="">Select User Role</option>
                            <option  v-for="type in userTypes" :value="type.id" :key=type.id> {{ type.name }}</option>
                             
                        </select>
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div v-show="!editMode" class="form-group">
                        <input v-model="form.password" type="password" name="password" placeholder="Password" id="password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button v-if="editMode" type="submit" class="btn btn-sm btn-warning">Update</button>
                    <button v-else type="submit" class="btn btn-sm btn-primary">Create</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                editMode: true,
                userTypes: [
                    {id:1, name:'Admin'},
                    {id:2, name:'Standered User'},
                    {id:3, name:'Author'}

                ],
                users:{},
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
        },methods: {
            editModal(user){
                this.editMode = true 
                this.form.reset();
                $('#addUserModal').modal('show')
                this.form.fill(user);
            },
            newModal(){
                this.editMode = false
                this.form.reset();
                $('#addUserModal').modal('show')
            },
            loadUsers(){
                if(this.$gate.isAdmin()){
                    axios.get('/api/user').then(({data}) => (this.users = data.data));
                }
                
            },
            updateUser(){
               this.$Progress.start();
                this.form.put('/api/user/'+this.form.id)
                    .then(()=>{
                        $('#addUserModal').modal('hide')
                        Swal.fire(
                            'Updated!',
                            'Information has beed updated.',
                            'success'
                            )
                         $('#addUserModal').modal('hide')    
                        Fire.$emit('refresh');
                        this.$Progress.finish()
                    })
                     .catch();
            },
            createUser(){   
                
                this.$Progress.start();
                this.form.post('/api/user')
                    .then(()=>{
                        Fire.$emit('AfterCreate');
                        $('#addUserModal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'User created successfully'
                        });
                        this.$Progress.finish()
                    })
                    .catch(()=>{

                    })  
            },
            deleteUser(id){
                Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {

                                // send delete request 
                                this.form.delete('/api/user/'+id)
                                    .then(()=>{
                                        if(result.value){
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                                )
                                            Fire.$emit('refresh');
                                        }
                                    })
                                    .catch(()=>{
                                          Swal.fire(
                                            'Failed!',
                                            'There is an error .',
                                            'warning'
                                            )
                                    })


                            })
            }
        },
        created() { 
            this.loadUsers();
            Fire.$on('refresh', () => { 
                this.loadUsers();
            });
        }
    }
</script>
