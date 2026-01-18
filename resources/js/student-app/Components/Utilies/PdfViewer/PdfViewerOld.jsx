import React from 'react';

const PdfViewer = ({ src, watermarkText }) => {
    return (
        <div style={{ position: 'relative', height: '600px' }}>

            {/* PDF */}
            <iframe
                src={src}
                title="PDF Viewer"
                width="100%"
                height="100%"
                style={{ border: 'none' }}
            />

            {/* Watermark */}
            <div
                style={{
                    pointerEvents: 'none',
                    position: 'absolute',
                    inset: 0,
                    backgroundImage: `
                                    repeating-linear-gradient(
                                    -30deg,
                                    rgba(0,0,0,0.08),
                                    rgba(0,0,0,0.08) 1px,
                                    transparent 1px,
                                    transparent 120px
                                    )
                                `,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '36px',
                    fontWeight: 'bold',
                    color: 'rgba(0,0,0,0.12)',
                    textTransform: 'uppercase'
                }}
            >
                {watermarkText}
            </div>
        </div>
    );
};

export default PdfViewer;
