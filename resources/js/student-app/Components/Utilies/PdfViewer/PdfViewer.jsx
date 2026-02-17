import { Document, Page, pdfjs } from 'react-pdf';
import { useEffect, useRef, useState } from 'react';
import 'react-pdf/dist/Page/TextLayer.css';
import 'react-pdf/dist/Page/AnnotationLayer.css';

import { useSelector } from "react-redux";

import * as Routes from '../../../Routes/Routes';
import axios from 'axios';

pdfjs.GlobalWorkerOptions.workerSrc = new URL(
  'pdfjs-dist/build/pdf.worker.min.mjs',
  import.meta.url
).toString();

const PdfViewer = ({ src, watermarkText, lessonId, callBackHandler }) => {
    const { token } = useSelector(state => state.auth);
    const containerRef = useRef(null);

    const [numPages, setNumPages] = useState(0);
    const [containerWidth, setContainerWidth] = useState(0);

    const [currentPage, setCurrentPage] = useState(1);
    const [maxPageReached, setMaxPageReached] = useState(1);

    const onLoadSuccess = ({ numPages }) => {
        setNumPages(numPages);
    };

    useEffect(() => {
        if (!containerRef.current) return;

        const resizeObserver = new ResizeObserver(entries => {
        setContainerWidth(entries[0].contentRect.width);
        });

        resizeObserver.observe(containerRef.current);
        return () => resizeObserver.disconnect();
    }, []);

    useEffect(() => {
        const el = containerRef.current;
        if (!el) return;

        const onScroll = () => {
            const pages = el.querySelectorAll('.react-pdf__Page');

            let visible = 1;
            pages.forEach((page, index) => {
                const rect = page.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.6) {
                    visible = index + 1;
                }
            });

            setCurrentPage(visible);
            setMaxPageReached(prev => Math.max(prev, visible));
        };

        el.addEventListener('scroll', onScroll);
        return () => el.removeEventListener('scroll', onScroll);
    }, []);

    useEffect(() => {
        if (!numPages) return;

        const progress = Math.round((maxPageReached / numPages) * 100);

        const payload = {
            lessonId,
            currentPage,
            maxPageReached,
            totalPages: numPages,
            progress,
            completed: maxPageReached === numPages,
        };

        console.log('PDF progress:', payload);

        const actionUrl = Routes.COURSE_CONTENT_PROGRESS_RECORD_API.replace('_lessionId_', lessonId);

        axios.post(
                    actionUrl,
                    {
                        progress: progress,
                    },
                    {
                        headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "application/json",
                        },
                    }
                ).then((response) => {
                    if(response.data){
                        const progressStatus = response.data.data.progress_status;
                        if(callBackHandler){
                            callBackHandler(lessonId, progressStatus)
                        }
                    }
                });

    }, [maxPageReached, numPages]);

    return (
        <div style={{ position: 'relative', height: '600px' }}>
            <div
                ref={containerRef}
                style={{ height: '100%', overflowY: 'auto' }}
            >
                <Document file={src} onLoadSuccess={onLoadSuccess}>
                    {Array.from(new Array(numPages), (_, i) => (
                        <Page 
                            key={i} 
                            pageNumber={i + 1}
                            width={containerWidth}
                            renderTextLayer={false}
                            renderAnnotationLayer={false}
                        />
                    ))}
                </Document>
            </div>

            {/* Watermark */}
            <div
                style={{
                    pointerEvents: 'none',
                    position: 'absolute',
                    inset: 0,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '36px',
                    fontWeight: 'bold',
                    color: 'rgba(0,0,0,0.12)',
                }}
            >
                {watermarkText}
            </div>
        </div>
    );
};

export default PdfViewer;
