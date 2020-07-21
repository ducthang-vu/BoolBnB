<template>
    <div>
        <h1>Statistiche per l'appartamento # {{ flat_id }}</h1>
        <chart v-bind:props="visualisations_props"></chart>
        <chart v-bind:props="requests_props"></chart>
    </div>

</template>

<script>
    import chart from './components/chart'

    export default {
        data() {
            return {
                flat_id:  window.location.href.match(/flats\/(\d\d)/)[1],
                visualisations_props: {
                    title: "visualisations",
                    visualisations: {}
                },
                requests_props: {
                    title: "requests",
                    requests: {}
                }
            }
        },
        mounted() {
            const api_url = window.location.protocol + "//" + window.location.host + '/api/statistics/?flat_id='
            axios.get(api_url + this.flat_id)
                .then(response => {
                    this.visualisations_props.visualisations = response.data.visualisations
                    this.requests_props.requests = response.data.requests
                })
                .catch(function (e) {
                    console.log(e);
                })
        },
        components: {chart},
    }
</script>

<style scoped>

</style>
