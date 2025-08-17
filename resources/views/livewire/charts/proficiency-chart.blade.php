<?php

use function Livewire\Volt\{state, mount};

state(['proficiencyData']);

mount(function ($proficiencyData) {
    $this->proficiencyData = $proficiencyData;
});

?>

<div wire:ignore>
    <div id="proficiency-chart" style="height: 400px;"></div>
</div>

@script
<script>
const proficiencyData = @json($proficiencyData);
const chartId = 'proficiency-chart-' + Math.random().toString(36).substr(2, 9);
document.querySelector('#proficiency-chart').id = chartId;

const proficiencyOptions = {
    chart: {
        height: 400,
        type: 'bar',
        toolbar: { show: true }
    },
    plotOptions: {
        bar: {
            horizontal: true,
            columnWidth: '60%',
            endingShape: 'rounded'
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) { return val + '%'; }
    },
    series: [{
        name: 'Proficiency Score',
        data: proficiencyData.map(item => item.score)
    }],
    colors: proficiencyData.map(item => {
        if (item.score == 100) return '#0d6efd';
        if (item.score >= 80) return '#28a745';
        if (item.score >= 60) return '#ffc107';
        return '#dc3545';
    }),
    fill: { type: 'solid' },
    xaxis: {
        categories: proficiencyData.map(item => `Proficiency ${item.no}`),
        title: { text: 'Score Percentage (%)' }
    },
    yaxis: {
        title: { text: 'Proficiency Parameters' }
    },
    tooltip: {
        y: {
            formatter: function (val, { dataPointIndex }) {
                const item = proficiencyData[dataPointIndex];
                const status = val == 100 ? 'Perfect' :
                             val >= 80 ? 'Good' :
                             val >= 60 ? 'Needs Improvement' : 'Requires Attention';
                return `Score: ${val}% (${item.correct}/${item.total} correct)<br>Status: ${status}`;
            }
        }
    }
};

const proficiencyChart = new ApexCharts(document.querySelector(`#${chartId}`), proficiencyOptions);
proficiencyChart.render();
</script>
@endscript