<template>
    <div class="content-wrapper">

        <!-- BreadCrumb -->
        <bread-crumb></bread-crumb>

        <!-- Main content -->
        <section class="content">

            <transition name="slide-fade" mode="out-in">

                <router-view></router-view>

            </transition>

        </section>
    </div>
</template>

<script>
    import BreadCrumb from './BreadCrumb';

    export default {
        components: {BreadCrumb},
        mounted() {
            this.addRequiredAsterisk()
        },
        methods: {
            addRequiredAsterisk() {
               let inputs= document.getElementsByTagName('input')
                for (let element of inputs) {
                    if(element.hasAttribute('required')){
                      let father= element.parentElement.parentElement.classList.add("item-required")
                        console.log(father)
                    }
                }
            },
        }
    }
</script>

<style>
   form .item-required label:after {
        content: " *";
        color: red;
    }
</style>
