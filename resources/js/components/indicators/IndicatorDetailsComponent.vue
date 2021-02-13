<template>
    <div class="modal fade" id="modalIndicatorDetails">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Indicator Details</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{enterprise.name}}</dd>
                        <dt>Description</dt>
                        <dd>{{enterprise.description}}</dd>
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
        name: "IndicatorDetailsComponent",
        data() {
            return {
                enterprise: []
            }
        },
        methods: {
            openDetails( enterprise) {
                this.enterprise = enterprise;
                $('#modalIndicatorDetails').modal({backdrop: 'static', keyboard: false, 'show': true})
            },
            closeModal() {
                $('#modalIndicatorDetails').modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>
