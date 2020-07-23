<template>
  <div class="statistic-container d-flex s-center p-25">
    <h1 class="text-center mb-30">Statistiche per l'appartamento #{{ flat_id }}</h1>
    <chart class="chart" v-bind:props="visualisations_props"></chart>
    <chart class="chart" v-bind:props="requests_props"></chart>
  </div>
</template>

<script>
import chart from "./components/chart";

export default {
  data() {
    return {
      flat_id: window.location.href.match(/flats\/(\d+)/)[1],
      visualisations_props: {
        title: "visualisations",
        visualisations: {}
      },
      requests_props: {
        title: "requests",
        requests: {}
      }
    };
  },
  mounted() {
    const api_url =
      window.location.protocol +
      "//" +
      window.location.host +
      "/api/statistics/?flat_id=";
    axios
      .get(api_url + this.flat_id)
      .then(response => {
        this.visualisations_props.visualisations = response.data.visualisations;
        this.requests_props.requests = response.data.requests;
      })
      .catch(function(e) {
        console.log(e);
      });
  },
  components: { chart }
};
</script>

<style scoped>
.statistic-container {
  flex-wrap: wrap;
}

.chart {
  flex-basis: 100%;
  flex-shrink: 0;
}

h1 {
  flex-basis: 100%;
}

@media (min-width: 992px) {
  .chart {
    flex-basis: 49%;
  }
}
</style>
