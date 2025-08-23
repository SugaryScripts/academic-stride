import { useState, useEffect } from 'react';
import PaginationControls from '@/layouts/PaginationControls';
import { Progress } from '@/components/ui/progress';
import withMainLayout from '@/layouts/withMainLayout';

const questions = [
  {
    id: 1,
    text: "Saat debat kelas, Rani berkata, 'Pendapat kamu salah total. Kamu tidak paham materi, jadi jangan banyak bicara.' tersebut menunjukkan penggunaan bahasa yang tidak santun. Kalimat tersebut akan lebih sesuai dengan prinsip komunikasi santun jika diubah menjadi ...",
    options: [
      "Kamu salah, tidak usah ikut diskusi kalau tidak paham.",
      "Saya rasa pendapatmu tidak tepat, mari kita kaji kembali bersama.",
      "Pendapatmu tidak bisa diterima, diam saja dulu.",
      "Kamu tidak tahu apa-apa, sebaiknya diam.",
      "Sudah jelas salah, tidak perlu dijelaskan lagi."
    ],
  },
  ...Array(19).fill({
    id: 2,
    text: "Contoh soal selanjutnya...",
    options: ["Pilihan A", "Pilihan B", "Pilihan C", "Pilihan D", "Pilihan E"],
  }),
];

const StudentExam = () => {
  const [remainingTime, setRemainingTime] = useState(null);
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const totalTime = 30 * 60;
  const countdownKey = 'countdown_end_time';

  useEffect(() => {
    let intervalId;

    const initializeTimer = () => {
      let endTime = localStorage.getItem(countdownKey);

      if (!endTime) {
        endTime = new Date().getTime() + totalTime * 1000;
        localStorage.setItem(countdownKey, endTime);
      } else {
        endTime = parseInt(endTime, 10);
      }

      intervalId = setInterval(() => {
        const now = new Date().getTime();
        const timeLeft = Math.max(0, Math.floor((endTime - now) / 1000));
        setRemainingTime(timeLeft);

        if (timeLeft <= 0) {
          clearInterval(intervalId);
          localStorage.removeItem(countdownKey);
        }
      }, 1000);
    };

    initializeTimer();

    return () => clearInterval(intervalId);
  }, [totalTime]);

  const formatTime = (seconds) => {
    const minutes = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
  };

  const handleNextQuestion = () => {
    if (currentQuestion < questions.length - 1) {
      setCurrentQuestion(prev => prev + 1);
    }
  };

  const handlePreviousQuestion = () => {
    if (currentQuestion > 0) {
      setCurrentQuestion(prev => prev - 1);
    }
  };

  if (remainingTime === null) {
    return <div className="flex justify-center items-center h-screen text-lg font-bold">Loading...</div>;
  }

  const progressValue = ((currentQuestion + 1) / questions.length) * 100;

  return (
    <div className="flex justify-center items-center min-h-screen p-5 bg-gray-100">
      <div className="container max-w-2xl w-full bg-white rounded-lg shadow-md p-6">
        <div className="flex justify-between items-center mb-5">
          <div className="text-gray-500">
            Question {currentQuestion + 1} of {questions.length}
          </div>
          <div className="bg-primary py-2 px-4 rounded-md font-bold text-white">
            {formatTime(remainingTime)}
          </div>
        </div>

        {/* Progress Bar */}
        <div className="mb-5">
          <Progress value={progressValue} className="h-2" />
        </div>

        {/* Soal yang ditampilkan berdasarkan state currentQuestion */}
        <div className="border border-gray-300 rounded-lg p-5 mb-5">
          <div className="flex items-start gap-4 mb-4">
            <div className="text-gray-500 text-lg font-bold">{questions[currentQuestion].id}.</div>
            <div className="text-lg leading-relaxed">{questions[currentQuestion].text}</div>
          </div>
          <ul className="list-none p-0 m-0">
            {questions[currentQuestion].options.map((option, index) => (
              <li
                key={index}
                className="border border-gray-300 rounded-md p-4 mb-3 cursor-pointer flex items-center transition-colors duration-200 hover:bg-gray-50"
              >
                <input
                  type="radio"
                  name="question-1"
                  className="mr-4"
                />
                <span className="text-gray-800">
                  {String.fromCharCode(65 + index)}. {option}
                </span>
              </li>
            ))}
          </ul>
        </div>

        {/* Komponen Pagination */}
        <div className="flex justify-center items-center mt-5">
         <PaginationControls
          totalQuestions={questions.length}
          currentQuestion={currentQuestion}
          onPageChange={setCurrentQuestion}
        />
        </div>
      </div>
    </div>
  );
};

export default withMainLayout(StudentExam, true);
