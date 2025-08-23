import withMainLayout from "../../layouts/withMainLayout";
import ExamCard from "../../components/ExamCard";

function MyExam() {
  const exams = [
    {
      id: 1,
      name: 'Ujian Sosiologi - Sekolah Menengah Atas',
      startedAt: '2025-08-18 23:31',
      finishedAt: '-',
      status: 'OPEN',
    },
    {
      id: 2,
      name: 'Ujian Indonesian - Sekolah Menengah Atas',
      startedAt: '-',
      finishedAt: '-',
      status: 'OPEN',
    },
    {
      id: 3,
      name: 'Ujian Geografi - Sekolah Menengah Atas',
      startedAt: '-',
      finishedAt: '-',
      status: 'OPEN',
    },
  ];

  return (
    <div className="container mx-auto p-4">
      <h2 className="text-2xl font-bold text-gray-800 mb-4">My Exam</h2>
        <div className="bg-white p-6 rounded-lg shadow-lg">
        <h3 className="text-xl font-semibold mb-4">Exam</h3>
        <div className="flex-grow h-px bg-gray-200 mb-10"></div>
            <ExamCard exams={exams} showAction={true} />
        </div>
    </div>
  );
}

export default withMainLayout(MyExam);
