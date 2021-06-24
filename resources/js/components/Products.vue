<template>
    <div class="container">
        <!-- {{--  <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div> --}} -->
        <div class="row mt-15" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Table</h3>

                        <div class="card-tools">
                            <!--  <div class="input-group input-group-sm" style="width: 150px;">
                     <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                     <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                  </div> -->
                            <!-- <button class="btn btn-success" data-toggle="modal"
                  data-target="#addNew" >Add New <i class="fas  fa-user-plus fa-fw"></i> </button> -->
                            <button class="btn btn-success" @click="newModal()">
                                Add New <i class="fas  fa-user-plus fa-fw"></i>
                            </button>
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
                                    <th>Image</th>
                                    <th>Registerd At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <!-- <div v-for="item in items" :key="item.id">
                        {{item}}
                   </div> -->
                            <tbody>
                                <tr v-for="product in Products.data" :key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.email }}</td>
                                    <!-- <td>{{ product.image | uptext }}</td> -->
                                  <td>   <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar"></td>
                                    <td>{{ product.created_at | myDate }}</td>
                                    <!-- <td><span class="tag tag-success">Approved</span></td> -->
                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a
                                            href="#"
                                            @click="deleteUser(user.id)"
                                        >
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <!-- <ul>

                                 <li v-for="post in laravelData.data" :key="post.id">{{ post.title }}</li>
                        </ul> -->
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row mt-15" v-if="! $gate.isAdminOrAuthor()" >
            <not-found></not-found>
        </div>
        <div
            class="modal fade"
            id="addNew"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="addNewLabel"
                            v-show="!editmode"
                        >
                            Add New User
                        </h5>
                        <h5
                            class="modal-title"
                            id="addNewLabel"
                            v-show="editmode"
                        >
                            Update User
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        @submit.prevent="editmode ? updateUser() : createUser()"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    placeholder="Enter user"
                                />
                                <div
                                    v-if="form.errors.has('name')"
                                    v-html="form.errors.get('name')"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    v-model="form.email"
                                    type="text"
                                    name="email"
                                    placeholder="Email Address"
                                />
                                <div
                                    v-if="form.errors.has('email')"
                                    v-html="form.errors.get('email')"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    v-model="form.bio"
                                    type="text"
                                    name="bio"
                                    placeholder="short bio for user"
                                />
                                <div
                                    v-if="form.errors.has('bio')"
                                    v-html="form.errors.get('bio')"
                                />
                            </div>
                            <div class="form-group">
                                <select
                                    name="type"
                                    v-model="form.type"
                                    id="type"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('type')
                                    }"
                                >
                                    <option value="">Select User Role </option>
                                    <option value="admin">Admin </option>
                                    <option value="user">Standard User </option>
                                    <option value="author"> Author </option>
                                </select>
                                <div
                                    v-if="form.errors.has('type')"
                                    v-html="form.errors.get('type')"
                                />
                                <!-- <has-error :form="form" field="type"></has-error> -->
                            </div>
                            <div class="form-group">
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    placeholder="Enter Password"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.get(
                                            'password'
                                        )
                                    }"
                                />
                                <div
                                    v-if="form.errors.has('password')"
                                    v-html="form.errors.get('password')"
                                />
                                <!-- <div v-if="form.errors.has('password')" v-html="form.errors.has('password')" /> -->
                                <!-- <has-error :form="form" field="password"></has-error> -->
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                v-show="editmode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Update
                            </button>
                            <button
                                v-show="!editmode"
                                type="submit"
                                class="btn btn-primary"
                            >
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editmode: false,
            users: {},
            form: new Form({
                id: "",
                name: "",
                email: "",
                password: "",
                type: "",
                bio: "",
                photo: ""
            })
        }
    },
    methods: {
           getProfilePhoto()
                {

                let photo =(this.form.photo.length > 200 ) ? this.form.photo : "img/product/"+ this.form.photo;
                return photo;
           // return "img/profile/"+ this.form.photo;

                },
         getResults(page = 1) {
			axios.get('api/user?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		}
        ,
        updateUser() {
            this.$Progress.start();
            console.log("editing Data");
            this.form
                .put("api/user/" + this.form.id)
                .then(() => {
                    $("#addNew").modal("hide");
                    Swal.fire(
                        "Updated!",
                        "Your file has been updated.",
                        "success"
                    );

                    this.$Progress.finish();
                    Fire.$emit("AfterCreate");
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        editModal(user) {
            this.editmode = true;
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(user);
        },
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },

        deleteUser(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    // Send request to the server
                    this.form
                        .delete("api/user/" + id)
                        .then(() => {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            Fire.$emit("AfterCreate");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Failed !",
                                " There was something wrong. ",
                                "warning"
                            );
                        });
                }
            });
        },
        loadUsers() {
            // this.form.post('api/user');
            // axios.get("api/user").then(({data})=> (this.users = data));
        if (this.$gate.isAdminOrAuthor())
        {
         axios.get("api/user").then(({ data }) => (this.users = data));
        }
        },
        createUser() {
            this.$Progress.start();
            this.form.post("api/user")
                .then(() => {
                    Fire.$emit("AfterCreate");
                    $("#addNew").modal("hide");

                    Toast.fire({
                        icon: "success",
                        title: " User created  in successfully"
                    });
                    this.$Progress.finish();
                })
                .catch(() => {});
        }
    },
    //   mounted() {
    //     console.log('Component mounted.')
    // }
    created() {
         this.loadUsers();
            Fire.$on("searching", () => {
                // let query="";
                let query=this.$parent.search;
            axios.get('api/findUser?q='+query).
            then((data) => {
                this.users = data.data
            }).
            catch(() =>
                    {

            })
        });
        Fire.$on("AfterCreate", () => {
            this.loadUsers();
        });
        // setInterval(() => this.loadUsers(),3000);
    },
};
</script>
