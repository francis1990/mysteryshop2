<template>
    <div class="modal fade" id="modalClientDetails">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Client Details</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{client.name}}</dd>
                        <dt>Address</dt>
                        <dd>{{client.address}}</dd>
                        <dt>No Contract</dt>
                        <dd>{{client.contract}}</dd>
                        <dt>Enterprise</dt>
                        <dd v-if="client.enterprise">{{client.enterprise.name}}</dd>
                        <dd v-else>-</dd>
                    </dl>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" @click="closeModal">Close</button>
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
        name: "ClientDetailsComponent",
        data() {
            return {
                client: []
            }
        },
        methods: {
            openDetails( client) {
                this.client = client;
                $('#modalClientDetails').modal({backdrop: 'static', keyboard: false, 'show': true})
            },
            closeModal() {
                $('#modalClientDetails').modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>
