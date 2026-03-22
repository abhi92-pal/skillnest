@extends('admin.layouts.app')
@section('title', 'Student Courses')

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
                                {{-- <a href="{{ route('admin.course.create') }}" class="btn btn-danger waves-effect waves-light mb-3">
                                    <i class="mdi mdi-plus-circle me-1"></i>
                                    Add Course
                                </a> --}}
                                <table id="ddDataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Duraion</th>
                                            <th>Order No</th>
                                            <th>Purchase Price</th>
                                            <th>Purchase Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($courses as $course)
                                            @php
                                                $order = $course->orders->first();   
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="width: 36px;">
                                                    <img src="{{ $course->file_path ?  asset('storage/' . $course->file_path) : asset('storage/images/1763276177.png') }}" alt="course-img" title="course-img" class="rounded-circle avatar-sm">
                                                    {{ $course->name }}
                                                </td>
                                                <td>{{ $course->duration }} {{ $course->duration_type }}</td>
                                                <td>{{ $order?->orderno ?? '-' }}</td>
                                                <td>{{ number_format($order?->price, 2) }}</td>
                                                <td>{{ $order ? date('d/m/Y', strtotime($order->created_at)) : '' }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                        </div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                            <a href="{{ route('admin.student.course.details', [$student->id, $course->id]) }}" class="dropdown-item view-btn"><i class="fas fa-info mr-3"></i>View Details</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse 
                                    </tbody>    
                                        

                                </table>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
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
        /*
        $(document).on('click', '.change_status', function(){
            const __this = $(this);
            const actionUrl = __this.data('url');

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'You want to change the status!',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, change it!"
            }).then((response) => {
                if(response.isConfirmed){
                    $.ajax({
                        method: 'POST',
                        data: {},
                        url: actionUrl,
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
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
        */
    });
</script>
@endsection