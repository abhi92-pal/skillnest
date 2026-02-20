<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lession;
use App\Models\Coursecategory;
use App\Models\Semester;
use App\Models\SemesterTopic;
use App\Models\Topic;
use App\Models\User;
use App\Models\Order;
use App\Models\StudentLession;
use App\Models\Studentcourse;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    public function index(Request $request){
        $search_orderno = $request->order_number;
        $orders = Order::when($search_orderno, function($query, $search_orderno){
                                $query->where('orderno', 'like', '%' . $search_orderno . '%');
                            })->latest()->paginate(10);
                            
        return view('admin.order.index', compact('orders', 'search_orderno'));
    }


    public function changeStatus(Order $order, $status){

        $auth_student = User::find($order->user_id)->student;
        $auth_student_id = $auth_student->id;

        do {
            $year = date('Y');
            $roll_number = $year . '-' . strtoupper(Str::random(10));
        } while (Studentcourse::where('roll_no', $roll_number)->exists());

        if($status == 'Approve'){
            $message = 'The order has been approved successfully.';


            $lessions = Lession::whereIn(
                'topic_id',
                Topic::where('course_id', $order->course_id)->pluck('id')
            )->get();

            if($lessions->count()){
                foreach($lessions as $lession){
                    $studentLesson = StudentLession::create([
                                                        'lession_id' => $lession->id,
                                                        'student_id' => $auth_student_id,
                                                        'status' => 'Not Started',
                                                        'progress' => 0,
                                                    ]);
                }
            }

            Studentcourse::create([
                                    'student_id' => $auth_student_id,
                                    'course_id' => $order->course_id,
                                    'roll_no' => $roll_number,
                                ]);



            $order->update([
                                'status' => 'Approved'
                            ]);

            return response()->json(['message' => $message]);
        }else{

            $order->update([
                                'status' => 'Rejected'
                            ]);
            return response()->json(['message' => 'The order has been rejected successfully.']);
        }

    }
}
