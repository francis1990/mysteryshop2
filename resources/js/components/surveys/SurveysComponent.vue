<template   >
    <div class="card card-info">
        <!-- Carga de datos -->
        <div v-if="!loaded" class="overlay"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
        <div class="card-header">
            <h4 class="card-title font-weight-bold">Surveys
                <span v-show="surveys.total" class="right badge badge-dark">{{ surveys.total }}</span>
            </h4>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button id="show-modal" class="btn btn-primary btn-sm pull-right" @click="showForm('add')">Add
            </button>
            <survey-form-component @loadData="getSurveys(1)" ref="formSurvey"></survey-form-component>
            <survey-details-component ref="detailsSurvey"></survey-details-component>
            <div class="pt-2">
                <div v-if="surveys.data.length || !loaded" class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <survey-item-component
                            v-for="item in surveys.data"
                            v-bind:survey="item"
                            v-bind:key="item.id"
                            @loadData="getSurveys(1)"
                            @details="showDetails(item)"
                            @updateItem="showForm('update',item)">
                        </survey-item-component>
                        </tbody>
                    </table>
                    <pagination :limit="5" :data="surveys" @pagination-change-page="getSurveys"></pagination>
                </div>
                <div v-else class="alert alert-warning text-center">
                    No hay ningún elemento para mostrar
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
</template>
<script>
    import SurveyItemComponent from "./SurveyItemComponent";
    import SurveyDetailsComponent from "./SurveyDetailsComponent";
    import SurveyFormComponent from "./SurveyFormComponent";

    export default {
        components: {SurveyItemComponent, SurveyDetailsComponent, SurveyFormComponent},
        mounted() {
            this.getSurveys()
        },
        data() {
            return {
                surveys: {data: []},
                loaded: false,
                showAdd: false,
            }
        },
        methods: {
            getSurveys(page = 1) {
                this.loaded = false;
                let url = '/cmsapi/surveys?page=' + page;
                axios.get(url)
                    .then(response => {
                        this.surveys = response.data
                        this.loaded = true;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            showForm(action, item = null) {
                this.$refs.formSurvey.showForm(action, item)
            },
            showDetails(item) {
                this.$refs.detailsSurvey.openDetails(item)
            },
        }
    }
</script>
