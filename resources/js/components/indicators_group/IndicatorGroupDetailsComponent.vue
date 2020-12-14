<template>
    <div class="modal fade" id="modalIndicatorGroupDetails">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Group indicator Details</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{indicator_group.name}}</dd>
                        <dt>Description</dt>
                        <dd>{{indicator_group.description}}</dd>
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
        name: "IndicatorGroupDetails",
        data() {
            return {
                indicator_group: []
            }
        },
        methods: {
            openDetails( item) {
                this.indicator_group = item;
                $('#modalIndicatorGroupDetails').modal({backdrop: 'static', keyboard: false, 'show': true})
            },
            closeModal() {
                $('#modalIndicatorGroupDetails').modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>
