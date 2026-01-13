import React from 'react';
import Accordion from '../Utilies/Accordion/Accordion';

const SemesterAccordion = ({ semesters = [] }) => {
    const containerStyle = {
                    background: 'linear-gradient(135deg, #ce4be8 0%, #207ce5 100%)',
                    padding: '20px',
                    borderRadius: '8px',
                    textAlign: 'center',
                    marginBottom: '5px'
                };
    const container2Style = {
                    // background: 'linear-gradient(135deg, #ce4be8 0%, #207ce5 100%)',
                    background: 'rgb(173 195 221)',
                    padding: '10px',
                    borderRadius: '8px',
                    // textAlign: 'center',
                    marginBottom: '5px'
                };
    return (
        <Accordion
            accordionHeadingStyle={containerStyle}
            id="semesterAccordion"
            items={semesters}
            renderHeader={(semester) => (
                <span className="text-white fw-bold">{semester.name}</span>
            )}
            renderBody={(semester) => (
                semester.sem_topics.length == 0 
                    ? (
                        <p>Content has not been uploaded yet.</p>
                    ) : (
                        // <Accordion
                        //     topics={semester.sem_topics || []}
                        //     parentId={semester.id}
                        // />

                        <Accordion
                            accordionHeadingStyle={container2Style}
                            id={`lessonAccordion-${semester.id}`}
                            items={semester.sem_topics || []}
                            renderHeader={(topic) => (
                                <strong className='text-white'>{topic.name}</strong>
                            )}
                            renderBody={(topic) => (
                                <>
                                <p className="text-muted">{topic.description}</p>

                                {topic.lessions?.length ? (
                                    <div className="row">
                                    {topic.lessions.map((lesson) => (
                                        <div key={lesson.id} className="col-md-3 card m-2 p-2">
                                        <strong>{lesson.name}</strong>
                                        <p className="mb-0">
                                            Content Type:{" "}
                                            {lesson.type === "Text"
                                            ? "PDF"
                                            : lesson.type === "Video"
                                            ? "Video"
                                            : lesson.type}
                                        </p>
                                        </div>
                                    ))}
                                    </div>
                                ) : (
                                    <p>Content has not been uploaded yet.</p>
                                )}
                                </>
                            )}
                            />

                    )
            )}
        />
    );
};

export default SemesterAccordion;
