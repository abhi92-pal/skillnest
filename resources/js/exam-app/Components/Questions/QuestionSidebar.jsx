const QuestionSidebar = ({
    totalQuestions,
    questionStatus,
    activeSectionIndex,
    onQuestionClick,
}) => {
    return (
        <aside className="sidebar">
            <h3>Questions</h3>

            <div className="question-number-grid">
                {Array.from({ length: totalQuestions }, (_, index) => {
                    const status =
                        questionStatus[`${activeSectionIndex}-${index}`] ||
                        "unseen";

                    return (
                        <button
                            key={index}
                            className={`q-btn ${status}`}
                            onClick={() => onQuestionClick(index)}
                        >
                            {index + 1}
                        </button>
                    );
                })}
            </div>
        </aside>
    );
};

export default QuestionSidebar;
