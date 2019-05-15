<template>
    <div v-if="localCitaStatus === 'pending'">
        <span v-text="sender.name"></span> quiere tener una cita
        <button @click="acceptCitaRequest">Aceptar solicitud</button>
    </div>
    <div v-else>
        Tú y <span v-text="sender.name"></span> pueden concretar una cita
    </div>
</template>

<script>
    export default {
        props:{
            sender: {
                type: Object,
                required: true
            },
            citaStatus: {
                type: String,
                required: true
            }
        },
        data(){
            return {
                localCitaStatus: this.itaStatus
            }
        },
        methods:{
            acceptCitaRequest(){
                axios.post(`/accept-citas/${this.sender.name}`)
                    .then(res => {
                        this.localCitaStatus = 'accepted'
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
