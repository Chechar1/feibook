<template>
<div>
        <div v-if="localCitaStatus === 'pending'">
            <span v-text="sender.name"></span> quiere tener una cita
            <button @click="acceptCitaRequest">Aceptar solicitud</button>
            <button dusk="deny-cita" @click="denyCitaRequest">Denegar solicitud</button>
        </div>
        <div v-else-if="localCitaStatus === 'accepted'">
            Tú y <span v-text="sender.name"></span> pueden concretar una cita
        </div>
        <div v-else-if="localCitaStatus === 'denied'">
            Solicitud denegada de <span v-text="sender.name"></span>
        </div>
        <div v-if="localCitaStatus === 'deleted'">Solicitud eliminada</div>
        <button v-else dusk="delete-cita" @click="deleteCita">Eliminar</button>
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
            },
            deleteCita(){
                axios.delete(`/citas/${this.sender.name}`)
                    .then(res => {
                        this.localCitaStatus = res.data.cita_status
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
