import React from 'react';

const SemesterAccordion = ({ semesters = [] }) => {
    return (
        <div className="accordion" id="semesterAccordion">
            {semesters.map((semester, index) => {
                const headingId = `heading-${semester.id}`;
                const collapseId = `collapse-${semester.id}`;
                console.log(semester.sem_topics);
                
                return (
                    <div className="accordion-item" key={semester.id}>
                        <h3 className="accordion-header" id={headingId}>
                            <button
                                className={`accordion-button ${index !== 0 ? 'collapsed' : ''}`}
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target={`#${collapseId}`}
                                aria-expanded={index === 0}
                                aria-controls={collapseId}
                            >
                                {semester.name}
                            </button>
                        </h3>

                        <div
                            id={collapseId}
                            className={`accordion-collapse collapse ${index === 0 ? 'show' : ''}`}
                            aria-labelledby={headingId}
                            data-bs-parent="#semesterAccordion"
                        >
                            <div className="accordion-body">
                                {semester.sem_topics?.length ? (
                                    <ul className="list-group list-group-flush">
                                        {semester.sem_topics.map(topic => (
                                            <li
                                                key={topic.id}
                                                className="list-group-item"
                                            >
                                                <h6 className="mb-1">
                                                    {topic.name}
                                                </h6>
                                                <p className="mb-0 text-muted">
                                                    {topic.description}
                                                </p>
                                            </li>
                                        ))}
                                    </ul>
                                ) : (
                                    <p className="text-muted mb-0">
                                        No topics available for this semester.
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>
                );
            })}
        </div>
    );
};

export default SemesterAccordion;
