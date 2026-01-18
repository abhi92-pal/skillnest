import { useEffect, useRef, useState } from "react";
import * as Routes from '../../../Routes/Routes';
import { useSelector } from "react-redux";
import axios from "axios";

function VideoPlayer({ src, lessonId, watermarkText }) {
    const { token } = useSelector(state => state.auth);
    const videoRef = useRef(null);

    const [watchTime, setWatchTime] = useState(0);
    const [duration, setDuration] = useState(0);

    // Track time every second while playing
    // useEffect(() => {
    //     let interval = null;

    //     if (isPlaying) {
    //         interval = setInterval(() => {
    //             setWatchTime((prev) => prev + 1);
    //         }, 2000);
    //     }

    //     return () => clearInterval(interval);
    // }, [isPlaying]);

    const handleTimeUpdate = () => {
        if (videoRef.current) {
            setWatchTime(videoRef.current.currentTime);
        }
    };

    const handleLoadedMetadata = () => {
        setDuration(videoRef.current.duration);
    };

    // const handlePlay = () => {
    //     setIsPlaying(true);
    // };

    const handlePause = () => {
        // setIsPlaying(false);
        recordProgress(videoRef.current.currentTime);
    };

    const handleEnded = () => {
        // setIsPlaying(false);
        console.log("Video completed");
        recordProgress(duration);
    };

    const recordProgress = (time) => {
        const actionUrl = Routes.COURSE_CONTENT_PROGRESS_RECORD_API.replace('_lessionId_', lessonId);

        axios.post(
                    actionUrl,
                    {
                        progress: Math.floor(time),
                    },
                    {
                        headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "application/json",
                        },
                    }
                );
    }

    useEffect(() => {
        return () => {
            if (videoRef.current) {
                recordProgress(videoRef.current.currentTime);
            }
        };
    }, [lessonId]);

    return (
        <div>
            <video
                ref={videoRef}
                src={src}
                controls
                width="100%"
                // onPlay={handlePlay}
                onPause={handlePause}
                onTimeUpdate={handleTimeUpdate}
                onLoadedMetadata={handleLoadedMetadata}
                onEnded={handleEnded}

                /* 🚫 Disable download & PiP */
                controlsList="nodownload noplaybackrate"
                disablePictureInPicture
                disableRemotePlayback

                /* 🚫 Disable right click */
                onContextMenu={(e) => e.preventDefault()}
            />

            <div
                style={{
                    pointerEvents: 'none',
                    position: 'absolute',
                    top: '35%',
                    left: '50%',
                    transform: 'translate(-50%, -50%) rotate(-30deg)',
                    fontSize: '32px',
                    fontWeight: 'bold',
                    color: 'rgba(255,255,255,0.2)',
                    textShadow: '0 0 10px rgba(0,0,0,0.4)'
                }}
            >
                {watermarkText}
            </div>

            {/* <p>Watched: {watchTime} seconds</p> */}
        </div>
    );
}

export default VideoPlayer;
