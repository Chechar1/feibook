<template>
    <div>
        <div class="card border-0 mb-3 shadow-sm" v-for="status in statuses">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded mr-3 shadow-sm" width="40px" src="https://picsum.photos/200" alt="">
                    <div class="">
                        <h5 class="mb-1" v-text="status.user_name"></h5>
                        <div class="small text-muted" v-text="status.ago"></div>
                    </div>
                </div>
                <p class="card-text text-secondary" v-text="status.body"></p>

            </div>
            <div class="card-footer p-2">
                <button class="btn btn-link"
                v-if="status.is_liked"
                dusk="unlike-btn"
                @click="unlike(status)"><strong><i class="fa fa-thumbs-up btn-sm text-primary mr-1"></i>Te gusta</strong></button>
                <BUtton class="btn btn-link far fa-thumbs-up btn-sm text-primary mr-1" v-else dusk="like-btn" @click="like(status)" >Me gusta</BUtton>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                statuses: []
            }
        },
    mounted() {
        axios.get('/statuses')
            .then(res => {
                this.statuses = res.data.data
            })
            .catch(err => {
                console.log(err.response.data);
            });

        EventBus.$on('status-created', status => {
            this.statuses.unshift(status);
        })
    },
    methods: {
        like(status){
            axios.post(`/statuses/${status.id}/likes`)
                .then(res => {
                    status.is_liked = true;
                })
        },
        unlike(status){
                axios.delete(`/statuses/${status.id}/likes`)
                    .then(res => {
                        status.is_liked = false;
                    })
            }

    }
}
</script>

<style scoped>

</style>
