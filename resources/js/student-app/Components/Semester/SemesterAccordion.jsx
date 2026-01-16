import React, { useRef, useState, useEffect } from 'react';
import Accordion from '../Utilies/Accordion/Accordion';
import VideoPlayer from '../Utilies/VideoPlayer/VideoPlayer';
import PdfViewer from '../Utilies/PdfViewer/PdfViewer';
import FullPageLoader from '../Utilies/FullPageLoader/FullPageLoader';
import { useDispatch, useSelector } from 'react-redux';
import { fetchLessonContent } from '../../store/actions/index';

const SemesterAccordion = ({ semesters = [] }) => {
    const playerRef = useRef(null);
    const dispatch = useDispatch();
    const { contentLoading, streamUrl, lessonType } = useSelector(state => state.myCourseDetail);
    const [selectedLesson, setSelectedLesson] = useState(null);
    const containerStyle = {
                    background: 'linear-gradient(135deg, #ce4be8 0%, #207ce5 100%)',
                    padding: '20px',
                    borderRadius: '8px',
                    textAlign: 'center',
                    marginBottom: '5px'
                };
    const container2Style = {
                    background: 'rgb(173 195 221)',
                    padding: '10px',
                    borderRadius: '8px',
                    marginBottom: '5px'
                };

    useEffect(() => {
        
        if (streamUrl && playerRef.current) {
            const yOffset = -80; // adjust as needed
            const y =
                playerRef.current.getBoundingClientRect().top +
                window.pageYOffset +
                yOffset;

            window.scrollTo({ top: y, behavior: 'smooth' });
        }
    }, [streamUrl]);

    const lessionPlayerHandler = (lesson) => {
        setSelectedLesson(lesson);
        dispatch(fetchLessonContent(lesson));
    }

    return (
        <>
            {contentLoading ? <FullPageLoader /> : ''}

            <div ref={playerRef} className='mb-3'>
                {streamUrl && (
                    <div className="mt-4">
                        <h5>Now Playing: {selectedLesson?.name}</h5>
                        {lessonType === 'Video' && (
                            <VideoPlayer
                                src={streamUrl}
                                lessonId={selectedLesson?.id}
                                autoPlay
                                watermarkText="SkillNest"
                            />
                        )}

                        {(lessonType === 'Text') && (
                            <PdfViewer src={streamUrl} watermarkText="SkillNest" />
                        )}
                        
                    </div>
                    )
                }
            </div>

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
                                            <div key={lesson.id} 
                                                className="col-md-3 card m-2 p-2" 
                                                style={{cursor: 'pointer'}}
                                                onClick={() => {
                                                    lessionPlayerHandler(lesson);
                                                }}>
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
        </>
    );
};

export default SemesterAccordion;
