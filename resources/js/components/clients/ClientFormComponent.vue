<template>
    <div class="modal fade" id="modalFormClient">
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
                                <label class="col-sm-2 control-label" for="name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" class="form-control" placeholder="Name" v-model="form.name"
                                           :class="errors.name ? 'is-invalid':''">
                                    <span v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="address">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Address" id="address"
                                           :class="errors.address ? 'is-invalid':''"
                                           v-model="form.address">
                                    <span v-if="errors.address" class="invalid-feedback">{{errors.address[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="contract_number">No Contract</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No Contract" id="contract_number"
                                           :class="errors.contract_number ? 'is-invalid':''"
                                           v-model="form.contract_number">
                                    <span v-if="errors.contract_number" class="invalid-feedback">{{errors.contract_number[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="enterprise_id">Enterprise</label>
                                <div class="col-sm-10">
                                    <select name="enterprise_id" class="form-control"  id="enterprise_id" v-model="form.enterprise_id" :class="errors.enterprise_id ? 'is-invalid':''">
                                        <option v-for="enterprise in enterprises.data" :value="enterprise.id">{{enterprise.name}}</option>
                                    </select>
                                    <span v-if="errors.enterprise_id" class="invalid-feedback">{{errors.enterprise_id[0]}}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="closeForm">Cancelar</button>
                    <a v-if="action==='update'" @click="updateClient" class="btn btn-primary">Guardar</a>
                    <a v-else @click="createClient" class="btn btn-primary">Guardar</a>
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
        name: "ClientFormComponent",
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
                    address: '',
                    contract_number: '',
                    enterprise_id: '',
                },
                errors: [],
                enterprises: [],
            }
        },
        methods: {
            showForm(action, client = null) {
                this.clearForm();
                this.action = action;
                this.title = action === 'update' ? 'Edit' : 'Create';
                if (client) {
                    this.form = {
                        id: client.id,
                        name: client.name,
                        address: client.address,
                        contract_number: client.contract,
                        enterprise_id: client.enterprise.id,
                    }
                }
                $('#modalFormClient').modal({backdrop: 'static', keyboard: false,'show':true})
            },
            createClient() {
                let url = `cmsapi/clients`;
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
            updateClient() {
                let url = `cmsapi/clients/${this.form.id}`;
                axios.put(url, this.form)
                    .then(response => {
                        this.closeForm();
                        this.$alert("the element have been updated", "Information", "success")
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
                    address: '',
                    contract_number: '',
                    enterprise_id: '',
                };
                this.errors = []
            },
            closeForm() {
                this.clearForm()
                $('#modalFormClient').modal('hide');
            },
            getEnterprises(page = 1) {
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
