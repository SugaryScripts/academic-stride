
import { Bar } from 'react-chartjs-2';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
} from 'chart.js';

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend
);

const BarChart = ({ chartData, title, xAxisLabel, yAxisLabel }) => {
  const options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
      },
      title: {
        display: true,
        text: title,
        font: {
          size: 14,
          weight: 'bold',
        },
        color: '#333',
      },
    },
    scales: {
      x: {
        title: {
          display: true,
          text: xAxisLabel,
          font: {
            size: 12,
            weight: 'bold',
          },
          color: '#555',
        },
        grid: {
          display: false,
        },
        ticks: {
          color: '#555',
        },
      },
      y: {
        title: {
          display: true,
          text: yAxisLabel,
          font: {
            size: 16,
            weight: 'bold',
          },
          color: '#555',
        },
        beginAtZero: true,
        ticks: {
          stepSize: 20,
          color: '#555',
        },
        grid: {
          color: '#e0e0e0',
        },
      },
    },
  };

  return (
    <div style={{ height: '250px' }}>
      <Bar
      data={chartData} options={options}  />
    </div>
  );
};

export default BarChart;
