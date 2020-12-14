<template>
    <tr>
        <td>{{indicator_group.name}}</td>
        <td>{{indicator_group.description}}</td>
        <td>
            <a href="#"><i class="text-primary fa fa-eye" @click="$emit('details')"></i></a>
            <a class="text-success fa fa-pen" @click="$emit('updateItem')"></a>
            <a class="text-danger fa fa-trash" @click="deleteItem(indicator_group.id)" ></a>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "IndicatorGroupItemComponent",
        props: ['indicator_group'],
        data(){
            return {
            }
        },
        methods:{
            deleteItem(item) {
                this.$confirm("Are you sure do you want delete this item?","Question","question").then(() => {
                    let url = `/cmsapi/indicator_groups/${item}`;
                    axios.delete(url)
                        .then(response => {
                            this.$alert("the element have been removed","Information","success" )
                            this.$emit('loadData')
                        })
                        .catch(err => {
                            this.$alert("An error has occurred", "Error", "error")
                            console.error(err);
                        });
                });
            }
        }
    }
</script>

<style scoped>

</style>
