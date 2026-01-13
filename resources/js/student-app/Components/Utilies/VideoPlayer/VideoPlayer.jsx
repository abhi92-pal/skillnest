import { useEffect, useRef, useState } from "react";

function VideoPlayer({ src, lessonId }) {
  const videoRef = useRef(null);

  const [watchTime, setWatchTime] = useState(0);
  const [isPlaying, setIsPlaying] = useState(false);

  // Track time every second while playing
  useEffect(() => {
    let interval = null;

    if (isPlaying) {
      interval = setInterval(() => {
        setWatchTime((prev) => prev + 1);
      }, 1000);
    }

    return () => clearInterval(interval);
  }, [isPlaying]);

  const handlePlay = () => {
    setIsPlaying(true);
  };

  const handlePause = () => {
    setIsPlaying(false);
  };

  const handleEnded = () => {
    setIsPlaying(false);
    console.log("Video completed");
  };

  // Example: send watch time to backend
  useEffect(() => {
    return () => {
      console.log("User spent (seconds):", watchTime);

      // API call example
      // fetch("/api/lesson-progress", {
      //   method: "POST",
      //   body: JSON.stringify({
      //     lesson_id: lessonId,
      //     watch_time: watchTime,
      //   }),
      // });
    };
  }, [watchTime, lessonId]);

  return (
    <div>
      <video
        ref={videoRef}
        src={src}
        controls
        width="100%"
        onPlay={handlePlay}
        onPause={handlePause}
        onEnded={handleEnded}
      />

      <p>Watched: {watchTime} seconds</p>
    </div>
  );
}

export default VideoPlayer;
