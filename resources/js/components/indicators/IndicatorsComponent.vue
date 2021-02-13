<template>
    <div class="card card-info">
        <!-- Carga de datos -->
        <div v-if="!loaded" class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
        <div class="card-header">
            <h4 class="card-title font-weight-bold">Indicators
                <span v-show="indicators.total" class="right badge badge-dark">{{ indicators.total }}</span>
            </h4>
        </div>
        <div class="card-body">
            <button id="show-modal" class="btn btn-primary btn-sm pull-right" @click="showForm('add')">Add
            </button>
            <indicator-form-component @loadData="getIndicators(1)" ref="formIndicator"></indicator-form-component>
            <indicator-details-component ref="detailsIndicator"></indicator-details-component>
            <div class="pt-2">
                <div v-if="indicators.data.length || !loaded" class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <indicator-item-component
                            v-for="item in indicators.data"
                            v-bind:indicator="item"
                            v-bind:key="item.id"
                            @loadData="getIndicators(1)"
                            @details="showDetails(item)"
                            @updateIndicator="showForm('update',item)">
                        </indicator-item-component>
                        </tbody>
                    </table>
                    <pagination :limit="5" :data="indicators" @pagination-change-page="getIndicators"></pagination>
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
    import IndicatorItemComponent from "./IndicatorItemComponent";
    import IndicatorDetailsComponent from "./IndicatorDetailsComponent";
    import IndicatorFormComponent from "./IndicatorFormComponent";

    export default {
        components: {IndicatorFormComponent, IndicatorDetailsComponent, IndicatorItemComponent},
        mounted() {
            this.getIndicators();
        },
        data() {
            return {
                indicators: {data: []},
                loaded: false,
                showAdd: false,
            }
        },
        methods: {
            getIndicators(page = 1) {
                this.loaded = false;
                let url = '/cmsapi/indicators?page=' + page;
                axios.get(url)
                    .then(response => {
                        this.indicators = response.data
                        this.loaded = true;
                    })
                    .catch(err => {
                        console.error(err);
                    })
            },
            showForm(action, indicator = null) {
                this.$refs.formIndicator.showForm(action, indicator)
            },
            showDetails(item) {
                this.$refs.detailsIndicator.openDetails(item)
            },
        },
    }
</script>
