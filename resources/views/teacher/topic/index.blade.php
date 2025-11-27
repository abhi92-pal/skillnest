@extends('teacher.layouts.app')
@section('title', 'View Tpics')

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
                                            <th>Cource</th>
                                            <th>Description</th>
                                            <th>Lession</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($topics as $topic)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="width: 36px;">
                                                    {{ $topic->name }}
                                                </td>
                                                <td>{{ $topic->course->name }}</td>
                                                <td>{{ $topic->description }}</td>
                                                <td>
                                                    <a href="{{ route('teacher.lession.index', $topic->id) }}"
                                                        class="btn btn-outline-pink waves-effect waves-light mb-3"
                                                        data-url="{{ route('teacher.lession.store', $topic->id) }}">
                                                        <i class="mdi mdi-eye me-1"></i>
                                                        {{ $topic->lessions()->count() }} View Lessions
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="jasvascript:void(0);"
                                                        class="btn btn-outline-success waves-effect waves-light mb-3 add-lession-btn"
                                                        data-url="{{ route('teacher.lession.store', $topic->id) }}">
                                                        <i class="mdi mdi-plus-circle me-1"></i>
                                                        Add Lession
                                                    </a>
                                                    {{-- <div class="dropdown">
                                                        <div class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                        </div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                             <a href="" class="dropdown-item view-btn"><i class="fas fa-info mr-3"></i>View Details</a>
                                                            <a href="{{ route('teacher.topic.index', $topic->id) }}" class="dropdown-item edit-btn"><i class="far fa-edit text-info mr-3"></i>View Topics</a>
                                                        </div>
                                                    </div> --}}
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>


                                </table>

                                {{ $topics->appends(request()->query())->links() }}
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>

    <!-- Add modal -->
    <div class="modal fade" id="Add-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <form id="createForm" class="" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">&#42;</span></label>
                            <input id="name" class="form-control" name="name" type="text" placeholder="Name">
                            <span class="text-danger error name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">&#42;</span></label>
                            <input id="description" class="form-control" name="description" type="text" placeholder="Description">
                            <span class="text-danger error description_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Type <span class="text-danger">&#42;</span></label>
                            <select id="type" class="form-control" name="type">
                                <option value="">Select Type</option>
                                <option value="Video">Video</option>
                                <option value="Text">Text</option>
                                {{-- <option value="Quiz">Quiz</option> --}}
                            </select>
                            <span class="text-danger error type_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="image">Content <span class="text-danger">&#42;</span></label>
                            <input id="image" class="form-control" name="content" type="file"
                                placeholder="Content">
                            <span class="text-danger error content_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration <span class="text-danger">&#42;</span></label>
                            <input id="duration" class="form-control" name="duration" type="text" placeholder="Duration">
                            <span class="text-danger error duration_error"></span>
                        </div>

                        <button type="submit" class="btn btn-info submitBtn">Submit</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '.add-lession-btn', function() {
                var url = $(this).data('url');
                $('#createForm').attr('action', url);
                $('#Add-modal').modal('show');
            });

            $(document).on('click', '.submitBtn', function() {
                $('form#createForm').submit();
            });

            $('form#createForm').on('submit', function() {
                const submitBtn = $('.submitBtn');
                const btnText = submitBtn.text();
                submitBtn.html(
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

                        submitBtn.html(btnText);

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

                        submitBtn.html(btnText).attr('disabled', false);
                    }

                });

                return false;
            });

            $(document).on('click', '.add-lession-btn', function() {
                var name = $(this).data('name');
                var email = $(this).data('email');
                var status = $(this).data('status');
                var url = $(this).data('url');

                $('#edit_name').val(name);
                $('#edit_email').val(email);
                $('#edit_status').val(status).trigger('change');
                $('#editForm').attr('action', url);
                // You can set the id in a hidden input field if needed

                $('#edit-modal').modal('show');
            });

            $(document).on('click', '.updateBtn', function() {
                $('form#editForm').submit();
            });

            $('form#editForm').on('submit', function() {
                const submitBtn = $('.updateBtn');
                const btnText = submitBtn.text();
                submitBtn.html(
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

                        submitBtn.html(btnText);

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

                        submitBtn.html(btnText).attr('disabled', false);
                    }

                });

                return false;
            });
        });
    </script>
@endsection
