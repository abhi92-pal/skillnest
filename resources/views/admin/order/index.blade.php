@extends('admin.layouts.app')
@section('title', 'View Orders')

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
                                            <th>Order No.</th>
                                            <th>Purchased By</th>
                                            <th>Course</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->orderno }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->course->name }}</td>
                                                <td>{{ number_format($order->price, 2) }}</td>
                                                <td>
                                                    @if ($order->status == 'Approved')
                                                        <span class="badge badge-success">Approved</span>
                                                    @elseif($order->status == 'Pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                        </div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                            @if($order->status == 'Pending')
                                                                <a href="javascript:void(0)" class="dropdown-item change_status" data-url="{{ route('admin.order.change-status', ['order' => $order->id, 'status' => 'Approve']) }}">Approve</a>
                                                                <a href="javascript:void(0)" class="dropdown-item change_status" data-url="{{ route('admin.order.change-status', ['order' => $order->id, 'status' => 'Reject']) }}">Reject</a>
                                                            @endif
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
    });
</script>
@endsection