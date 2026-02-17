import React, { useState, useEffect } from "react";
import QuestionSidebar from "../Questions/QuestionSidebar";
import QuestionPanel from "../Questions/QuestionPanel";
import { useDispatch, useSelector } from "react-redux";
import { fetchQuestions } from "../../store/actions/index";
import FullPageLoader from "../Utilities/FullPageLoader/FullPageLoader";
import { logout } from '../../store/actions/index';

const QuestionPaper = () => {
    const dispatch = useDispatch();
    const { loading, data } = useSelector((state) => state.exam);

    useEffect(() => {
        dispatch(fetchQuestions("019c61a1-f52e-7101-bee2-8c44921069d9"));
    }, [dispatch]);

    const examData = data || null;
    const sections = examData?.sections || [];

    const [activeSectionIndex, setActiveSectionIndex] = useState(0);
    const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
    const [answers, setAnswers] = useState({});
    const [questionStatus, setQuestionStatus] = useState({});

    const activeSection = sections[activeSectionIndex];
    const questions = activeSection?.questions || [];
    const currentQuestion = questions[currentQuestionIndex];

    const handleAnswerChange = (questionId, value) => {
        setAnswers((prev) => ({
            ...prev,
            [questionId]: value,
        }));

        setQuestionStatus((prev) => ({
            ...prev,
            [`${activeSectionIndex}-${currentQuestionIndex}`]: "answered",
        }));
    };

    const handleQuestionClick = (index) => {
        setCurrentQuestionIndex(index);
        setQuestionStatus((prev) => ({
            ...prev,
            [`${activeSectionIndex}-${index}`]: "seen",
        }));
    };

    const nextQuestion = () => {
        const isLastQuestionInSection =
            currentQuestionIndex === questions.length - 1;

        const isLastSection =
            activeSectionIndex === sections.length - 1;

        // If last question of last section → Submit
        if (isLastQuestionInSection && isLastSection) {
            handleSubmit();
            return;
        }

        // If last question of section → Move to next section
        if (isLastQuestionInSection) {
            setActiveSectionIndex((prev) => prev + 1);
            setCurrentQuestionIndex(0);
            return;
        }

        // Normal next
        setCurrentQuestionIndex((prev) => prev + 1);
    };

    const prevQuestion = () => {
        const isFirstQuestion = currentQuestionIndex === 0;

        const isFirstSection = activeSectionIndex === 0;

        // If first question of first section → do nothing
        if (isFirstQuestion && isFirstSection) return;

        // If first question → Move to previous section last question
        if (isFirstQuestion) {
            const previousSectionIndex = activeSectionIndex - 1;
            const previousSectionQuestions =
                sections[previousSectionIndex].questions;

            setActiveSectionIndex(previousSectionIndex);
            setCurrentQuestionIndex(previousSectionQuestions.length - 1);
            return;
        }

        // Normal previous
        setCurrentQuestionIndex((prev) => prev - 1);
    };

    const handleSubmit = () => {
        console.log("Submitting answers:", answers);

        if(confirm('Are you sure, You want to submit! You won\'t be able re-attempt')){
            alert('Submitted successfully');
            dispatch(logout());
        }
    };

    if (loading) return <FullPageLoader />;

    if (!currentQuestion) return <div>No Questions Available</div>;

    return (
        <div className="exam-container">
            {/* LEFT SIDEBAR */}
            <div className="exam-sidebar">
                <QuestionSidebar
                    totalQuestions={questions.length}
                    questionStatus={questionStatus}
                    activeSectionIndex={activeSectionIndex}
                    onQuestionClick={handleQuestionClick}
                />
            </div>

            {/* RIGHT CONTENT */}
            <div className="exam-content">
                {/* SECTION TABS HEADER */}
                <div className="section-tabs">
                    {sections.map((section, index) => (
                        <button
                            key={section.question_type_id}
                            className={`tab ${activeSectionIndex === index ? "active" : ""
                                }`}
                            onClick={() => {
                                setActiveSectionIndex(index);
                                setCurrentQuestionIndex(0);
                            }}
                        >
                            {section.question_type_name}
                        </button>
                    ))}
                </div>

                {/* QUESTION PANEL */}
                <div className="question-wrapper">
                    <QuestionPanel
                        question={currentQuestion}
                        questionNumber={currentQuestionIndex + 1}
                        totalQuestions={questions.length}
                        answer={answers[currentQuestion.question_id]}
                        onAnswerChange={handleAnswerChange}
                        duration={examData?.duration || 0}
                        onNext={nextQuestion}
                        onPrev={prevQuestion}
                        isLastQuestion={
                            activeSectionIndex === sections.length - 1 &&
                            currentQuestionIndex === questions.length - 1
                        }
                    />
                </div>
            </div>
        </div>
    );
};

export default QuestionPaper;
