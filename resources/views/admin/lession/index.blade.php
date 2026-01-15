@extends('admin.layouts.app')
@section('title', 'View Lessions')

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
                                {{-- <a href="" class="btn btn-danger waves-effect waves-light mb-3">
                                    <i class="mdi mdi-plus-circle me-1"></i>
                                    Add Course
                                </a> --}}
                                <table id="ddDataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Content</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($lessions as $lession)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="width: 36px;">
                                                    {{ $lession->name }}
                                                </td>
                                                <td>{{ $lession->description }}</td>
                                                <td>{{ $lession->type }}</td>
                                                <td>
                                                    {{-- <a href="{{ asset('storage/images/lessions/' . $lession->content_url) }}" target="_blank"><i class="mdi mdi-eye me-1"></i></a> --}}
                                                    <a href="{{ route('admin.lession.get-content', $lession->id) }}" target="_blank"><i class="mdi mdi-eye me-1"></i></a>
                                                </td>
                                                <td>{{ $lession->duration }}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $lessions->appends(request()->query())->links() }}
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
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '.freeze_btn', function() {
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
                    if (response.isConfirmed) {
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
                                }, 2000);
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

            $(document).on('click', '.delete_btn', function() {
                const __this = $(this);
                const actionUrl = __this.data('url');

                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You want to delete it',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((response) => {
                    if (response.isConfirmed) {
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
                                }, 2000);
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
