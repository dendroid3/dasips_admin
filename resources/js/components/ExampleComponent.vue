<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-success">
                <div class="">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        {{ message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                message: 'Hello Vue!'
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
