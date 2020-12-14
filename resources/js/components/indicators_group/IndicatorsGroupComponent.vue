<template>
    <div class="card card-info">
        <!-- Carga de datos -->
        <div v-if="!loaded" class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
        <div class="card-header">
            <h4 class="card-title font-weight-bold">Group indicators
                <span v-show="indicators_group.total" class="right badge badge-dark">{{ indicators_group.total }}</span>
            </h4>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button id="show-modal" class="btn btn-primary btn-sm pull-right" @click="showForm('add')">Add
            </button>
            <indicator-group-form-component @loadData="getIndicatorsGroup(1)" ref="formIndicatorGroup"></indicator-group-form-component>
            <indicator-group-details-component ref="detailsIndicatorGroup"></indicator-group-details-component>
            <div class="pt-2">
                <div v-if="indicators_group.data.length || !loaded" class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <indicator-group-item-component
                            v-for="item in indicators_group.data"
                            v-bind:indicator_group="item"
                            v-bind:key="item.id"
                            @loadData="getIndicatorsGroup(1)"
                            @details="showDetails(item)"
                            @updateItem="showForm('update',item)">
                        </indicator-group-item-component>
                        </tbody>
                    </table>
                    <pagination :limit="5" :data="indicators_group" @pagination-change-page="getIndicatorsGroup"></pagination>
                </div>
                <div v-else class="alert alert-warning text-center">
                    No hay ningún elemento para mostrar
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</template>
<script>
    import IndicatorGroupItemComponent from "./IndicatorGroupItemComponent";
    import IndicatorGroupDetailsComponent from "./IndicatorGroupDetailsComponent";
    import IndicatorGroupFormComponent from "./IndicatorGroupFormComponent";

    export default {
        components: {IndicatorGroupItemComponent, IndicatorGroupDetailsComponent,IndicatorGroupFormComponent},
        mounted() {
            this.getIndicatorsGroup()
        },
        data() {
            return {
                indicators_group: {data: []},
                loaded: false,
                showAdd: false,
            }
        },
        methods: {
            getIndicatorsGroup(page = 1) {
                this.loaded = false;
                let url = '/cmsapi/indicator_groups/?page=' + page;
                axios.get(url)
                    .then(response => {
                        this.indicators_group = response.data
                        this.loaded = true;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            showForm(action, item = null) {
                this.$refs.formIndicatorGroup.showForm(action, item)
            },
            showDetails(item) {
                this.$refs.detailsIndicatorGroup.openDetails(item)
            },
        }
    }
</script>
