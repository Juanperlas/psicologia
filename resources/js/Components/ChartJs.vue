<script setup>
import Chart from "chart.js/auto";
import { onMounted, ref } from "vue";

const props = defineProps({
    chartData: Array,
    chartLabels: Array,
    chartLabel: String,
    chartColors: Array, // Add this line
});

const chart = ref(null);

onMounted(() => {
    const ctx = chart.value;
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [props.chartLabel],
            datasets: props.chartData.map((data, index) => ({
                label: props.chartLabels[index],
                data: [data],
                backgroundColor: props.chartColors[index],
            })),
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});
</script>

<template>
    <div>
        <canvas ref="chart"></canvas>
    </div>
</template>
