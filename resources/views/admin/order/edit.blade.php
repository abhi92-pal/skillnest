@extends('admin.layouts.app')
@section('title', 'View/Edit Course')

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
                                <form action="{{ route('admin.course.update', $course->id) }}" method="POST"
                                    id="updateForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name <span class="text-danger">&#42;</span></label>
                                                <input id="name" class="form-control" name="name" type="text"
                                                    placeholder="Enter Name" value="{{ $course->name }}">
                                                <span class="text-danger error name_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="short_description">Short Description <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="short_description" class="form-control" name="short_description"
                                                    type="text" placeholder="Enter Short Description"
                                                    value="{{ $course->short_description }}">
                                                <span class="text-danger error short_description_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category <span
                                                        class="text-danger">&#42;</span></label>
                                                @php
                                                    $coursecategoryIds = $course->coursecategories
                                                        ->pluck('id')
                                                        ->toArray();
                                                @endphp
                                                <select id="category" name="category[]" class="form-control" multiple>
                                                    <option value="">Select Category</option>
                                                    @forelse($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if (in_array($category->id, $coursecategoryIds)) selected @endif>
                                                            {{ $category->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <span class="text-danger error category_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_pic">Course Picture </label>
                                                <input id="course_pic" class="form-control" name="course_pic"
                                                    type="file">
                                                <span class="text-danger error course_pic_error"></span>
                                                <img src="{{ $course->file_path ? asset('storage/' . $course->file_path) : asset('storage/images/1763276177.png') }}"
                                                    alt="course-img" title="course-img" class="mt-2 avatar-xl">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price <span class="text-danger">&#42;</span></label>
                                                <input id="price" class="form-control" name="price" type="text"
                                                    placeholder="Enter Price" value="{{ $course->price }}">
                                                <span class="text-danger error price_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selling_price">Selling Price <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="selling_price" class="form-control" name="selling_price"
                                                    type="text" placeholder="Enter Selling Price"
                                                    value="{{ $course->selling_price }}">
                                                <span class="text-danger error selling_price_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration_type">Duration Type <span
                                                        class="text-danger">&#42;</span></label>
                                                <select id="duration_type" name="duration_type" class="form-control">
                                                    <option value="">Select Duration Type</option>
                                                    <option @if ($course->duration_type == 'Hour') selected @endif
                                                        value="Hour">Hour</option>
                                                    <option @if ($course->duration_type == 'Day') selected @endif
                                                        value="Day">Day</option>
                                                    <option @if ($course->duration_type == 'Month') selected @endif
                                                        value="Month">Month</option>
                                                    <option @if ($course->duration_type == 'Year') selected @endif
                                                        value="Year">Year</option>
                                                </select>
                                                <span class="text-danger error duration_type_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration">Durations <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="duration" class="form-control" name="duration"
                                                    type="text" placeholder="Enter Duration"
                                                    value="{{ $course->duration }}">
                                                <span class="text-danger error duration_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="long_description">Long Description <span
                                                        class="text-danger">&#42;</span></label>
                                                <textarea name="long_description" class="form-control" id="long_description" rows="5"
                                                    placeholder="Enter Long Description">{{ $course->long_description }}</textarea>
                                                <span class="text-danger error long_description_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="reg_end_date">Registraion End Date <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="reg_end_date" class="form-control" name="reg_end_date"
                                                    type="date"
                                                    value="{{ date('Y-m-d', strtotime($course->reg_end_date)) }}">
                                                <span class="text-danger error reg_end_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_of_semester">Semester Number <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="no_of_semester" class="form-control" name="no_of_semester"
                                                    type="text" placeholder="Enter Semester Number"
                                                    value="{{ $course->no_of_semesters }}">
                                                <span class="text-danger error no_of_semester_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion" id="semesterTopicAccordion">
                                        @forelse($semesters as $semester)
                                            <div class="card">
                                                <div class="card-header p-0" id="heading_sem_{{ $loop->iteration }}">
                                                    <input type="hidden" name="t_sem[]" value="{{ $semester->id }}">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                                            data-target="#collapse_sem_{{ $loop->iteration }}" aria-expanded="true"
                                                            aria-controls="collapse_sem_{{ $loop->iteration }}">
                                                            {{ $semester->name }}
                                                        </button>
                                                    </h2>
                                                </div>

                                                <div id="collapse_sem_{{ $loop->iteration }}" class="collapse show"
                                                    aria-labelledby="heading_sem_{{ $loop->iteration }}" data-parent="#semesterTopicAccordion">
                                                    <div class="card-body sem_topic_wrap">
                                                        @forelse($semester->sem_topics as $key => $sem_topic)
                                                            <div class="sem_topic_body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h3>
                                                                            Topic Details
                                                                            @if($key > 0)
                                                                                <a href="javascript:void(0)" class="btn btn-danger delete_item"><i class="fa fa-times"></i></a>
                                                                            @endif
                                                                        </h3>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="t_name_{{ $semester->id }}_{{ $key }}">Topic Name <span class="text-danger">&#42;</span></label>
                                                                            <input id="t_name_{{ $semester->id }}_{{ $key }}" class="form-control" name="t_name[{{ $semester->id }}][{{ $key }}]" type="text" value="{{ $sem_topic->name }}">
                                                                            <span class="text-danger error t_name_{{ $semester->id }}_{{ $key }}_error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="t_author_{{ $semester->id }}_{{ $key }}">Author <span class="text-danger">&#42;</span></label>
                                                                            <select id="t_author_{{ $semester->id }}_{{ $key }}" name="t_author[{{ $semester->id }}][{{ $key }}]" class="form-control">
                                                                                <option value="">Select Author</option>
                                                                                @forelse($teachers as $teacher)
                                                                                    <option value="{{ $teacher->id }}" @if($sem_topic->author_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                                                                @empty
                                                                                @endforelse
                                                                            </select>
                                                                            <span class="text-danger error t_author_{{ $semester->id }}_{{ $key }}_error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="t_description_{{ $semester->id }}_{{ $key }}">Description <span class="text-danger">&#42;</span></label>
                                                                            <textarea id="t_description_{{ $semester->id }}_{{ $key }}" class="form-control" name="t_description[{{ $semester->id }}][{{ $key }}]" placeholder="Enter Description">{{ $sem_topic->description }}</textarea>
                                                                            <span class="text-danger error t_description_{{ $semester->id }}_{{ $key }}_error"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                        <button type="button" class="btn btn-success add_more" data-last_iteration="{{ ($semester->sem_topics->count() - 1) }}" data-semid="{{ $semester->id }}">+ Add More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center">No semester found</div>
                                        @endforelse


                                    </div>
                                    <button type="submit" class="btn btn-info submitBtn">Submit</button>
                                </form>

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
