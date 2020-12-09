<template>
    <div class="card card-info">
        <!-- Carga de datos -->
        <div v-if="!loaded" class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>

        <div class="card-header">
            <h4 class="card-title font-weight-bold">Client
                <span v-show="clients.total" class="right badge badge-dark">{{ clients.total }}</span>
            </h4>
        </div>
        <div class="card-body">
            <button id="show-modal" class="btn btn-primary btn-sm pull-right" @click="showForm('add')">Add
            </button>
            <client-form-component @loadData="getClients(1)" ref="formClient"></client-form-component>
            <client-details-component ref="detailsClient"></client-details-component>
            <div v-if="clients.data.length || !loaded" class="table-responsive pt-2">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>N. contract</th>
                        <th>Enterprise</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <client-item-component
                        v-for="item in clients.data"
                        v-bind:client="item"
                        v-bind:key="item.id"
                        @loadData="getClients(1)"
                        @details="showDetails(item)"
                        @updateClient="showForm('update',item)">
                    </client-item-component>
                    </tbody>
                </table>
                <pagination :limit="5" :data="clients" @pagination-change-page="getClients"></pagination>
            </div>

            <div v-else class="alert alert-warning text-center">
                No hay ningún elemento para mostrar
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            Footer
        </div>

    </div>
</template>
<script>
    import ClientItemComponent from "./ClientItemComponent";
    import ClientDetailsComponent from "./ClientDetailsComponent";
    import ClientFormComponent from "./ClientFormComponent";

    export default {
        components: {ClientFormComponent, ClientDetailsComponent,ClientItemComponent},
        mounted() {
            this.getClients()
        },

        data() {
            return {
                clients: {data: []},
                loaded: false,
                showAdd: false,
            }
        },
        methods: {
            getClients(page = 1) {
                this.loaded = false;
                let url = '/cmsapi/clients?page=' + page;
                axios.get(url)
                    .then(response => {
                        this.clients = response.data
                        this.loaded = true;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            showForm(action, client = null) {
                this.$refs.formClient.showForm(action, client)
            },
            showDetails(item) {
                this.$refs.detailsClient.openDetails(item)
            },
        }
    }
</script>
