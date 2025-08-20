import { Link } from "@inertiajs/react";

const ExamCard = ({ exams, showAction }) => {
  return (
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
                {showAction && (
                    <th
                    scope="col"
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                    ACTION
                    </th>
                )}
                </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
                {exams.map((exam) => (
                <tr key={exam.id}>
                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {exam.name}
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {exam.startedAt}
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {exam.finishedAt}
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {exam.status}
                    </td>
                    {showAction && (
                    <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <Link href="/student-exam" className="bg-primary hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full">
                            Start
                        </Link>
                    </td>
                    )}
                </tr>
                ))}
            </tbody>
            </table>
        </div>
  );
};

export default ExamCard;
