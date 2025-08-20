import withMainLayout from "../../layouts/withMainLayout";
import ExamCard from "../../components/ExamCard";

function RecentExam() {
     const exams = [];

  return (
    <div className="container mx-auto p-4">
      <h2 className="text-2xl font-bold text-gray-800 mb-4">My Exam</h2>
        <div className="bg-white p-6 rounded-lg shadow-lg">
        <h3 className="text-xl font-semibold mb-4">Exam List</h3>
        <div className="flex-grow h-px bg-gray-200 mb-10"></div>
            <ExamCard exams={exams} showAction={false} />
        </div>
    </div>
  );
}

export default withMainLayout(RecentExam);
