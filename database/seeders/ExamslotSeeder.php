<?php

namespace Database\Seeders;

use App\Models\Examslot;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = Topic::get();
        if($topics->count()){
            foreach($topics as $topic){
                foreach($topic->semester_topics as $semester_topic){
                    for ($i = 0; $i < 3; $i++) {

                        // $startsAt = Carbon::now()->addDays(30 + $i)->setTime(9 + $i, 0, 0);
                        $startsAt = Carbon::now()->addDays(30)->setTime(9 + ($i*2), 0, 0);

                        Examslot::firstOrCreate(
                            [
                                'semester_id' => $semester_topic->semester_id,
                                'topic_id'    => $semester_topic->topic_id,
                                'starts_at'   => $startsAt,
                            ],
                            [
                                'max_candidate' => 30,
                                'rem_seat'      => 30,
                            ]
                        );
                    }
                }
            }

        }
    }
}
