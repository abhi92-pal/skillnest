@extends('teacher.layouts.app')
@section('title', 'View Exam Paper Structure')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">@yield('title')</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="ddDataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>For</th>
                                            <th>Duraion</th>
                                            <th>Total Marks</th>
                                            <th>Exam Slot</th>
                                            <th>Is Gradable</th>
                                            <th>Is Freezed</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($exampapers as $exampaper)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $exampaper->name }}</td>
                                                <td>
                                                    {{ $exampaper->course->name }}<br>
                                                    {{ $exampaper->topic->name }} - {{ $exampaper->semester->name }}
                                                </td>
                                                <td>{{ $exampaper->duration }} Min</td>
                                                <td>
                                                    {{ $exampaper->total_marks }}
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y h:i A', strtotime($exampaper->examslot->starts_at)) }}
                                                </td>
                                                <td>
                                                    {{ $exampaper->is_gradable }}
                                                </td>
                                                <td>
                                                    @if ($exampaper->is_question_freezed == 'Yes')
                                                        <span class="badge badge-success">Freezed</span>
                                                    @else
                                                        <span class="badge badge-danger">Not Freezed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                        </div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                            <a href="{{ route('teacher.exampaper-structure.show', $exampaper->id) }}" class="dropdown-item view-btn"><i class="fas fa-info mr-3"></i>View Details</a>
                                                            <a href="javascript:void(0)" class="dropdown-item freeze_btn" data-url="{{ route('teacher.exampaper-question.freeze', $exampaper->id) }}"><i class="far fa-snowflake text-info mr-3"></i>Freeze</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="8">No data found</td>
                                            </tr>
                                        @endforelse 
                                    </tbody>    
                                        

                                </table>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                        {{ $exampapers->appends(request()->input())->links() }}
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $(document).on('click', '.freeze_btn', function(){
            const __this = $(this);
            const actionUrl = __this.data('url');

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'You want to freeze it',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, freeze it!"
            }).then((response) => {
                if(response.isConfirmed){
                    $.ajax({
                        method: 'POST',
                        data: {},
                        url: actionUrl,
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message,
                            });
                            
                            setTimeout(() => {
                                location.reload(true);
                            }, 2500);
                        },
                        error: function(data) {
                            var response = data.responseJSON;

                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            });
                        }

                    });
                }
            });
        });
    });
</script>
@endsection