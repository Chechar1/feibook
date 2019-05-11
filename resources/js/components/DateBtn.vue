<template>
    <button
        @click="sendDateRequest"
        dusk="request-date"
    >
        {{ textBtn }}
    </button>
</template>

<script>
    export default {
        props: {
            recipient: {
                type: Object,
                required: true
            }
        },
        data(){
            return {
                textBtn: 'Quiero una cita'
            }
        },
        methods: {
            sendDateRequest(){
                axios.post(`dates/${this.recipient.name}`)
                    .then(res => {
                        this.textBtn = 'Solicitud enviada';
                    })
                    .catch(err => {
                        console.log(err.response.data);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
