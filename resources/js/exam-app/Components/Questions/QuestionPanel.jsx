import React, { useState, useEffect } from "react";

const QuestionPanel = ({
    question,
    questionNumber,
    totalQuestions,
    answer,
    onAnswerChange,
    duration,
    onNext,
    onPrev,
    isLastQuestion
}) => {
    const [timeLeft, setTimeLeft] = useState(duration * 60);

    useEffect(() => {
        const timer = setInterval(() => {
            setTimeLeft((prev) => (prev > 0 ? prev - 1 : 0));
        }, 1000);

        return () => clearInterval(timer);
    }, []);

    const formatTime = (seconds) => {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    };

    const renderInputByType = () => {
        // MCQ
        if (question.options && question.options.length > 0) {
            return (
                <div className="options">
                    {question.options.map((opt) => (
                        <label key={opt.option_id}>
                            <input
                                type="radio"
                                name={question.question_id}
                                value={opt.option_id}
                                checked={answer === opt.option_id}
                                onChange={(e) =>
                                    onAnswerChange(
                                        question.question_id,
                                        e.target.value
                                    )
                                }
                            />
                            {opt.option_text}
                        </label>
                    ))}
                </div>
            );
        }

        // Short Question
        if (question.marks === 5) {
            return (
                <textarea
                    rows={10}
                    className="short-input"
                    value={answer || ""}
                    onChange={(e) =>
                        onAnswerChange(question.question_id, e.target.value)
                    }
                />
            );
        }

        // Descriptive
        return (
            <textarea
                className="descriptive-textarea"
                rows={10}
                value={answer || ""}
                onChange={(e) =>
                    onAnswerChange(question.question_id, e.target.value)
                }
            />
        );
    };

    return (
        <section className="question-panel">
            <div className="top-bar">
                <div>
                    Question {questionNumber} / {totalQuestions}
                </div>

                <div className="timer">
                    ⏳ {formatTime(timeLeft)}
                </div>
            </div>

            <div className="question-box">
                <p className="question-text">
                    {question.question} ({question.marks} Marks)
                </p>

                {renderInputByType()}

                <div className="navigation-buttons">
                    <button className="btn btn-warning" onClick={onPrev}>Previous</button>
                    <button className="btn btn-success" onClick={onNext}>
                        {isLastQuestion ? "Submit" : "Next"}
                    </button>
                </div>
            </div>
        </section>
    );
};

export default QuestionPanel;
