<template>
    <button
        @click="sendCitaRequest"
        dusk="request-cita"
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
                textBtn: 'Solicitar amistad'
            }
        },
        methods: {
            sendCitaRequest(){
                axios.post(`citas/${this.recipient.name}`)
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
