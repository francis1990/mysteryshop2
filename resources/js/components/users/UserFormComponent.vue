<template>
    <div class="modal fade" id="modalFormUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{title}}</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="closeForm" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="">
                        <div class="box-body">
                            <div v-if="errorMessage!==''" class="alert alert-danger" role="alert">
                                {{errorMessage}}
                            </div>
                            <div class="form-group">
                                <label class="col control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Name" v-model="form.name"
                                           :class="errors.name ? 'is-invalid':''" required>
                                    <span v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col control-label">Surname</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="SurName"
                                           :class="errors.surname ? 'is-invalid':''"
                                           v-model="form.surname">
                                    <span v-if="errors.surname" class="invalid-feedback">{{errors.surname[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" :class="errors.email ? 'is-invalid':''"
                                           placeholder="Email" v-model="form.email" required>
                                    <span v-if="errors.email" class="invalid-feedback">{{errors.email[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col control-label" for="enterprise_id">Enterprise</label>
                                <div class="col-sm-10">
                                    <select name="enterprise_id" class="form-control" id="enterprise_id"
                                            v-model="form.enterprise_id" :class="errors.enterprise_id ? 'is-invalid':''">
                                        <option v-for="enterprise in enterprises.data" :value="enterprise.id">{{enterprise.name}}
                                        </option>
                                    </select>
                                    <span v-if="errors.enterprise_id"
                                          class="invalid-feedback">{{errors.enterprise_id[0]}}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="closeForm">Cancel</button>
                    <a v-if="action==='update'" @click="updateUser" class="btn btn-primary">Save</a>
                    <a v-else @click="createUser" class="btn btn-primary">Save</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


</template>

<script>


    export default {
        name: "UserFormComponent",
        mounted() {
            this.getEnterprises()
        },
        data() {
            return {
                errorMessage: '',
                title: '',
                action: '',
                form: {
                    id: '',
                    name: '',
                    surname: '',
                    email: '',
                    enterprise_id: '',
                },
                errors: [],
                enterprises: [],
            }
        },
        methods: {
            showForm(action, user = null) {
                this.clearForm();
                this.action = action;
                this.title = action === 'update' ? 'Edit' : 'Create';
                if (user) {
                    this.form = {
                        id: user.id,
                        name: user.name,
                        surname: user.surname,
                        email: user.email,
                        enterprise_id: user.enterprise.id,
                    }
                }
                $('#modalFormUser').modal({backdrop: 'static', keyboard: false,'show':true})
            },
            createUser() {
                let url = `cmsapi/users`;
                axios.post(url, this.form)
                    .then(response => {
                        this.closeForm();
                        this.$alert("the element have been created", "Information", "success")
                        this.$emit('loadData')
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message;
                        this.errors = error.response.data.errors;
                    });
            },
            updateUser() {
                let url = `cmsapi/users/${this.form.id}`;
                axios.put(url, this.form)
                    .then(response => {
                        this.closeForm();
                        this.$alert("The element have been updated", "Information", "success")
                        this.$emit('loadData')
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message;
                        this.errors = error.response.data.errors;
                    });
            },
            clearForm() {
                this.errorMessage = '';
                this.title = '';
                this.form = {
                    id: '',
                    name: '',
                    surname: '',
                    email: '',
                    enterprise_id: '',
                };
                this.errors = []
            },
            closeForm() {
                this.clearForm()
                $('#modalFormUser').modal('hide');
            },
            getEnterprises() {
                let url = '/cmsapi/list/enterprises';
                axios.get(url)
                    .then(response => {
                        this.enterprises = response.data
                    })
                    .catch(err => {
                        console.error(err);
                    })
            },
        }
    }
</script>

<style scoped>

</style>
