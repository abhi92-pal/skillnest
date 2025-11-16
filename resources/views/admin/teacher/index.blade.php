@extends('admin.layouts.app')
@section('title', 'View Teachers')

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
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light mb-3"
                                    data-toggle="modal" data-target="#Add-modal">
                                    <i class="mdi mdi-plus-circle me-1"></i>
                                    Add Teacher
                                </a>
                                <table id="ddDataTable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($teachers as $teacher)
                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="{{ $teacher->profile_pic ?  asset('storage/images/teachers' . $teacher->profile_pic) : asset('storage/images/1763276177.png') }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm">
                                                </td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>
                                                    @if ($teacher->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                        </div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                            <a href="" class="dropdown-item view-btn"><i class="fas fa-info mr-3"></i>View Details</a>
                                                            <a href="" class="dropdown-item edit-btn"><i class="far fa-edit text-info mr-3"></i>Edit</a>
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

                <!-- edit modal -->
                <div class="modal fade" id="Add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-4">
                                <form id="createForm" class="" action="{{ route('admin.teacher.store') }}"
                                    method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">&#42;</span></label>
                                        <input id="name" class="form-control" name="name" type="text"
                                            placeholder="Name">
                                            <span class="text-danger error name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">&#42;</span></label>
                                        <input id="email" class="form-control" name="email" type="text"
                                            placeholder="Email">
                                            <span class="text-danger error email_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Profile Picture <span class="text-danger">&#42;</span></label>
                                        <input id="image" class="form-control" name="profile_pic" type="file"
                                            placeholder="Profile Picture">
                                            <span class="text-danger error profile_pic_error"></span>
                                    </div>
                                    <button type="submit" class="btn btn-info submitBtn">Submit</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- /edit modal -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.submitBtn', function() {
                $('form#createForm').submit();
            });

            $('form#createForm').on('submit', function() {
                $('.submitBtn').html(
                    '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden"></span></div>'
                    ).attr('disabled', true);
                var formData = new FormData(this);
                $('.error').html('');
                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: $(this).attr('action'),
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                    dataType: 'json',
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });

                        $('.submitBtn').html('Save');

                        // window.location.href = response.redirect_url;
                        window.location.reload(true);
                    },
                    error: function(data) {
                        var response = data.responseJSON;

                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        });

                        $.each(response.errors, function(index, value) {
                            $('.' + index + '_error').text(value);
                        });

                        $('.submitBtn').html('Save').attr('disabled', false);
                    }

                });

                return false;
            });
        });
    </script>
@endsection
