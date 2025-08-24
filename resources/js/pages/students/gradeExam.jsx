import withMainLayout from "../../layouts/withMainLayout";
import BarChart from "../chart/BarChart";

function GradeExam() {
  const chartData = {
    labels: ['Sosial', 'Fisika', 'MTK'],
    datasets: [
      {
        label: 'Score %',
        data: [50, 100, 75],
        backgroundColor: 'rgba(183, 32, 32, 0.8)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
      },
    ],
  };

  return (
    <div className="container mx-auto p-4">
      <h2 className="text-2xl font-bold text-gray-800 mb-4">Detail Grade</h2>

      <div className="bg-white p-10 rounded-lg shadow-lg mb-10 max-w-7xl">
        <h3 className=" font-semibold">Academic Performance Overview</h3>
        <span className="text-xs ">Comprehensive analysis of exam performance across subjects</span>
        <div className="flex-grow h-px mt-4 bg-gray-200 mb-10"></div>

        <BarChart
          chartData={chartData}
          title=""
          xAxisLabel="Subject (SMA)"
          yAxisLabel="Persentage"
        />
      </div>

      <div className="bg-white p-6 rounded-lg shadow-lg mb-10 max-w-7xl">
        <h3 className=" font-semibold">Academic Performance Overview</h3>
        <span className="text-xs ">Comprehensive analysis of exam performance across subjects</span>
        <div className="flex-grow h-px mt-4 bg-gray-200 mb-10"></div>
      </div>

      <div className="bg-white p-6 rounded-lg shadow-lg mb-10 max-w-7xl">
        <h3 className=" font-semibold">Academic Performance Overview</h3>
        <span className="text-xs ">Comprehensive analysis of exam performance across subjects</span>
        <div className="flex-grow h-px mt-4 bg-gray-200 mb-10"></div>
      </div>
    </div>
  );
}

export default withMainLayout(GradeExam);
