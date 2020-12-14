<template>
    <div class="modal fade" id="modalFormIndicatorGroup">
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
                                <label class="col control-label" for="name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" class="form-control" placeholder="Name" v-model="form.name"
                                           :class="errors.name ? 'is-invalid':''" required>
                                    <span v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col control-label" for="description">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Address" id="description"
                                           :class="errors.description ? 'is-invalid':''" required
                                           v-model="form.description">
                                    <span v-if="errors.description" class="invalid-feedback">{{errors.description[0]}}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="closeForm">Cancelar</button>
                    <a v-if="action==='update'" @click="updateItem" class="btn btn-primary">Guardar</a>
                    <a v-else @click="createItem" class="btn btn-primary">Guardar</a>
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
        name: "IndicatorGroupFormComponent",
        data() {
            return {
                errorMessage: '',
                title: '',
                action: '',
                form: {
                    id: '',
                    name: '',
                    description: '',
                },
                errors: [],
                enterprises: [],
            }
        },
        methods: {
            showForm(action, item = null) {
                this.clearForm();
                this.action = action;
                this.title = action === 'update' ? 'Edit' : 'Create';
                if (item) {
                    this.form = {
                        id: item.id,
                        name: item.name,
                        description: item.description,
                    }
                }
                $('#modalFormIndicatorGroup').modal({backdrop: 'static', keyboard: false,'show':true})
            },
            createItem() {
                let url = `/cmsapi/indicator_groups`;
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
            updateItem() {
                let url = `/cmsapi/indicator_groups/${this.form.id}`;
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
                    description: '',
                };
                this.errors = []
            },
            closeForm() {
                this.clearForm()
                $('#modalFormIndicatorGroup').modal('hide');
            },
        }
    }
</script>

<style scoped>

</style>
