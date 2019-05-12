<template>
    <button
        @click="toggleCitaStatus"
    >
        {{ getText }}
    </button>
</template>

<script>
    export default {
        props: {
            recipient: {
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
                localCitaStatus: this.citaStatus
            }
        },
        methods: {
            toggleCitaStatus(){
                let method = this.getMethod();

                axios[method](`citas/${this.recipient.name}`)
                    .then(res => {
                        this.textBtn = 'Solicitud enviada';
                        this.localCitaStatus = res.data.Cita_status;
                    })
                    .catch(err => {
                        console.log(err.response.data);
                    })
            },
            getMethod(){
                if (this.localCitaStatus === 'pending')
                {
                    return 'delete';
                }
                return 'post';
            }
        },
        computed: {
            getText(){
                if (this.localCitaStatus === 'pending')
                {
                    return 'Cancelar solicitud';
                }
                return 'Quiero una cita';
            }
        }
    }
</script>

<style scoped>

</style>
