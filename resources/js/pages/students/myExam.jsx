import withMainLayout from "../../layouts/withMainLayout";
import ExamCard from "../../components/ExamCard";
import { Link } from "@inertiajs/react";

function MyExam({ exams }) {

  return (
    <div className="container mx-auto p-4">
        <h2 className="text-2xl font-bold text-gray-800 mb-4">My Exam</h2>
        <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50">
                <tr>
                <th
                    scope="col"
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    Exam
                </th>
                <th
                    scope="col"
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    STARTED AT
                </th>
                <th
                    scope="col"
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    FINISHED AT
                </th>
                <th
                    scope="col"
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    STATUS
                </th>
                </tr>
            </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                    {exams.map((exam) => (
                        <tr key={exam.id}>
                            <td className="px-6 py-4 whitespace-nowrap">
                                <div className="text-sm font-medium text-gray-900">{exam.title}</div>
                            </td>
                            <td className="px-6 py-4 whitespace-nowrap">
                                <div className="text-sm text-gray-900">
                                    {exam.started_at ? new Date(exam.started_at).toLocaleString() : '-'}
                                </div>
                            </td>
                            <td className="px-6 py-4 whitespace-nowrap">
                                <div className="text-sm text-gray-900">
                                    {exam.finished_at ? new Date(exam.finished_at).toLocaleString() : '-'}
                                </div>
                            </td>
                            <td className="px-6 py-4 whitespace-nowrap">
                                <Link
                                        // href={route('student-exam', { exam: exam.id })}
                                    className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        ${exam.is_active === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}`}
                                    >
                                        {exam.is_active}
                                </Link>
                            </td>
                        </tr>
                    ))}
                </tbody>

            </table>
        </div>
    </div>
  );
}

export default withMainLayout(MyExam);
