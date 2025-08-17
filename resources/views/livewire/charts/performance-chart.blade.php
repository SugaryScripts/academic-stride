<?php

use function Livewire\Volt\{state, mount};

state(['chartData', 'chartLabels']);

mount(function ($chartData, $chartLabels) {
    $this->chartData = $chartData;
    $this->chartLabels = $chartLabels;
});

?>

<div wire:ignore>
    <div id="performance-histogram" style="height: {{ max(400, count($chartData) * 50) }}px;"></div>
</div>

@script
<script>
const chartData = @json($chartData);
const chartLabels = @json($chartLabels);
const chartId = 'performance-histogram-' + Math.random().toString(36).substr(2, 9);
document.querySelector('#performance-histogram').id = chartId;

const colors = chartData.map(score => {
    if (score == 100) return '#0d6efd';
    if (score >= 80) return '#28a745';
    if (score >= 60) return '#ffc107';
    return '#dc3545';
});

var options = {
    chart: {
        height: Math.max(400, chartData.length * 50),
        type: 'bar',
        toolbar: { show: true }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '60%',
            endingShape: 'rounded',
            dataLabels: { position: 'top' }
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) { return val + '%'; },
        offsetY: -20,
        style: { fontSize: '12px', fontWeight: 'bold', colors: ['#304758'] }
    },
    series: [{ name: 'Performance Score', data: chartData }],
    colors: colors,
    fill: { type: 'solid' },
    xaxis: {
        categories: chartLabels,
        labels: { rotate: -45, style: { fontSize: '11px' } }
    },
    yaxis: {
        min: 0, max: 100,
        labels: { formatter: function (val) { return val + '%'; } }
    },
    tooltip: {
        y: {
            formatter: function (val, { dataPointIndex }) {
                const grade = val == 100 ? 'Perfect' :
                            val >= 80 ? 'Good' :
                            val >= 60 ? 'Needs Improvement' : 'Requires Attention';
                return `Score: ${val}%<br>Grade: ${grade}`;
            }
        }
    }
};

const chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
chart.render();
</script>
@endscript