@extends('admin.layouts.app')
@section('title', 'View Course')

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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <p>{{ $course->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <p>{{ $course->short_description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <p>
                                                @foreach ($course->coursecategories as $category)
                                                    {{ $category->name }} @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_pic">Course Picture</label>
                                            <img src="{{ $course->file_path ? asset('storage/' . $course->file_path) : asset('storage/images/1763276177.png') }}"
                                                alt="course-img" title="course-img" class="mt-2 avatar-xl">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <p>₹ {{ number_format($course->price, 2) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="selling_price">Selling Price</label>
                                            <p>₹ {{ number_format($course->selling_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <p>{{ $course->duration }} {{ $course->duration_type }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_of_semester">Semester Number</label>
                                            <p>{{ $course->no_of_semesters }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="long_description">Long Description</label>
                                            <p>{{ $course->long_description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="reg_end_date">Registration End Date</label>
                                            <p>{{ date('F d, Y', strtotime($course->reg_end_date)) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>

                                <!-- Display Semesters and Topics -->
                                <div class="accordion" id="semesterTopicAccordion">
                                    @forelse($semesters as $semester)
                                        <div class="card">
                                            <div class="card-header p-0" id="heading_sem_{{ $loop->iteration }}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_sem_{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse_sem_{{ $loop->iteration }}">
                                                        {{ $semester->name }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse_sem_{{ $loop->iteration }}" class="collapse show" aria-labelledby="heading_sem_{{ $loop->iteration }}" data-parent="#semesterTopicAccordion">
                                                <div class="card-body sem_topic_wrap">
                                                    @forelse($semester->sem_topics as $sem_topic)
                                                        <div class="card p-2 shadow">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3>
                                                                        Topic Details
                                                                    </h3>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Topic Name:</strong> {{ $sem_topic->name }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Author:</strong>
                                                                        @if ($sem_topic->author_id)
                                                                            {{ $sem_topic->author->name }}
                                                                        @else
                                                                            Not Assigned
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <p><strong>Description:</strong>
                                                                        {{ $sem_topic->description }}</p>
                                                                </div>
                                                               <!-- ACTION BUTTONS -->
                                                                <div class="col-md-12 text-right mt-2">
                                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm">
                                                                        <i class="fa fa-eye"></i> View Lessions
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">
                                                                        <i class="fa fa-pen"></i> Set Exam Slots
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div>No topics found</div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center">No semesters found</div>
                                    @endforelse
                                </div>

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
        const TEACHERS = @json($teachers);

        $('#no_of_semester').on('change', function() {
            const semNumber = parseInt($(this).val());
            if (semNumber > 0) {
                let formData = new FormData();
                formData.append('semesters', semNumber);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.course.get-topic-structure') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        $('#semesterTopicAccordion').html(response.html);
                    },
                    error: function(data) {
                        var response = data.responseJSON;

                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        });
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Semester number must a valid number and greater than 0'
                });
            }
        });

        $(document).on('click', '.add_more', function() {
            const __this = $(this);
            const closestWrap = __this.closest('.sem_topic_wrap');
            let semId = __this.data('semid');
            let lastIteration = parseInt(__this.data('last_iteration'));
            lastIteration++;

            let teacherOptions = '';
            TEACHERS.forEach(teacher => {
                teacherOptions += `<option value="${teacher.id}">${teacher.name}</option>`;
            });

            let topicHtml = `<div class="row topic_item">
                                <div class="col-md-12">
                                    <h3>
                                        Topic Details
                                        <a href="javascript:void(0)" class="btn btn-danger delete_item"><i class="fa fa-times"></i></a>
                                    </h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="t_name_${semId}_${lastIteration}">Topic Name <span class="text-danger">&#42;</span></label>
                                        <input id="t_name_${semId}_${lastIteration}" class="form-control" name="t_name[${semId}][${lastIteration}]" type="text">
                                        <span class="text-danger error t_name_${semId}_${lastIteration}_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="t_author_${semId}_${lastIteration}">Author <span class="text-danger">&#42;</span></label>
                                        <select id="t_author_${semId}_${lastIteration}" name="t_author[${semId}][${lastIteration}]" class="form-control">
                                            <option value="">Select Author</option>
                                            ${teacherOptions}
                                        </select>
                                        <span class="text-danger error t_author_${semId}_${lastIteration}_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="t_description_${semId}_${lastIteration}">Description <span class="text-danger">&#42;</span></label>
                                        <textarea id="t_description_${semId}_${lastIteration}" class="form-control" name="t_description[${semId}][${lastIteration}]" placeholder="Enter Description"></textarea>
                                        <span class="text-danger error t_description_${semId}_${lastIteration}_error"></span>
                                    </div>
                                </div>
                            </div>`;

            $('.sem_topic_body', closestWrap).append(topicHtml);
            __this.attr('data-last_iteration', lastIteration);
        });

        $(document).on('click', '.delete_item', function() {
            $(this).closest('.topic_item').remove();
        });

        $(document).ready(function() {
            $('#category').select2({
                placeholder: 'Select Category'
            });

            $(document).on('click', '.submitBtn', function() {
                $('form#updateForm').submit();
            });

            $('form#updateForm').on('submit', function() {
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

                        window.location.href = response.redirect_url;
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
