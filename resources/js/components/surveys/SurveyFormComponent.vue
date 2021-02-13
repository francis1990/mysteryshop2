<template>
    <div class="modal fade" id="modalFormSurvey">
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
                                    <input type="text" id="name" class="form-control" placeholder="Name"
                                           v-model="form.name" required
                                           :class="errors.name ? 'is-invalid':''">
                                    <span v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">

                                    <div class="d-flex justify-content-between">
                                        Indicators
                                        <button @click="addNode" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-folder"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Special title treatment</h5>
                                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Special title treatment</h5>
                                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="indicators col-6">
                                        <vue-tree-list
                                            @click="onClick"
                                            :model="indicators"
                                            default-tree-node-name="new node"
                                            default-leaf-node-name="new leaf">
                                        </vue-tree-list>
                                    </div>
                                    <div class="indicators-values col-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="closeForm">Cancel</button>
                    <a v-if="action==='update'" @click="updateItem" class="btn btn-primary">Save</a>
                    <a v-else @click="createItem" class="btn btn-primary">Save</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</template>

<script>
    import {VueTreeList, Tree, TreeNode} from 'vue-tree-list'

    export default {
        name: "SurveyFormComponent",
        components: {
            VueTreeList
        },
        data() {
            return {
                errorMessage: '',
                title: '',
                action: '',
                form: {
                    id: '',
                    name: '',
                },
                errors: [],
                enterprises: [],
                newTree: {},
                indicators: new Tree([
                    /*{
                        name: 'Node 1',
                        id: 1,
                        pid: 0,
                        dragDisabled: true,
                        children: [
                            {
                                name: 'Node 1-2',
                                id: 2,
                                isLeaf: true,
                                pid: 1
                            }
                        ]
                    },
                    {
                        name: 'Node 2',
                        id: 3,
                        pid: 0,
                        dragDisabled: true
                    },
                    {
                        name: 'Node 3',
                        id: 4,
                        pid: 0
                    }*/
                ])
            }
        },
        methods: {
            addNode: function () {
                var node = new TreeNode({name: 'new node', isLeaf: false})
                if (!this.indicators.children) this.indicators.children = []
                this.indicators.addChildren(node)
            },
            onClick(model) {
                console.log(model)
            },
            showForm(action, item = null) {
                this.clearForm();
                this.action = action;
                this.title = action === 'update' ? 'Edit' : 'Create';
                if (item) {
                    this.form = {
                        id: item.id,
                        name: item.name,
                    }
                }
                $('#modalFormSurvey').modal({backdrop: 'static', keyboard: false, 'show': true})
            },
            createItem() {
                let url = `/cmsapi/surveys`;
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
                let url = `/cmsapi/surveys/${this.form.id}`;
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
                };
                this.errors = []
            },
            closeForm() {
                this.clearForm()
                $('#modalFormSurvey').modal('hide');
            },
        }
    }
</script>

<style scoped>

</style>
