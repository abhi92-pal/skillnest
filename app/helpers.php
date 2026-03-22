<?php

use App\Models\Lession;
use App\Models\StudentLession;
use App\Models\Topic;

if(!function_exists('getSemesterWiseProgress')){
    function getSemesterWiseProgress($studentId, $courseId, $semesterId){
        $topicIds = Topic::where('course_id', $courseId)->whereHas('semester_topics', fn($q) => $q->where('semester_id', $semesterId) )->pluck('id')->toArray();
        $lessonIds = Lession::whereIn('topic_id', $topicIds)->pluck('id')->toArray();

        $full_progress = count($lessonIds) * 100;
        $studentlessonProgress = StudentLession::where('student_id', $studentId)->whereIn('lession_id', $lessonIds)->whereIn('status', ['In Progress', 'Completed'])->sum('progress');

        return round(($studentlessonProgress / $full_progress) * 100);
    }
}

?>