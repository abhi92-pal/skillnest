@extends('admin.layouts.app')
@section('title', 'Add Exam Paper Structure')

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
                                <form action="{{ route('admin.exampaper-structure.store') }}" method="POST" id="createForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name <span class="text-danger">&#42;</span></label>
                                                <input id="name" class="form-control" name="name" type="text" placeholder="Enter Name">
                                                <span class="text-danger error name_error"></span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="short_description">Short Description <span class="text-danger">&#42;</span></label>
                                                <input id="short_description" class="form-control" name="short_description" type="text" placeholder="Enter Short Description">
                                                <span class="text-danger error short_description_error"></span>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course">Course <span class="text-danger">&#42;</span></label>
                                                <select id="course" name="course" class="form-control">
                                                    <option value="">Select Course</option>
                                                    @forelse($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <span class="text-danger error course_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="semester">Semester <span class="text-danger">&#42;</span></label>
                                                <select id="semester" name="semester" class="form-control">
                                                    <option value="">Select Semester</option>
                                                </select>
                                                <span class="text-danger error semester_error"></span>
                                            </div>
                                        </div>                                        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="topic">Topic <span class="text-danger">&#42;</span></label>
                                                <select id="topic" name="topic" class="form-control">
                                                    <option value="">Select Topic</option>
                                                </select>
                                                <span class="text-danger error topic_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="examslot">Examslot <span class="text-danger">&#42;</span></label>
                                                <select id="examslot" name="exam_slot" class="form-control">
                                                    <option value="">Select examslot</option>
                                                </select>
                                                <span class="text-danger error exam_slot_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration">Duration (In Min)<span class="text-danger">&#42;</span></label>
                                                <input id="duration" class="form-control" name="duration" type="text" placeholder="Duration (In Min)">
                                                <span class="text-danger error duration_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="grace_period">Grace Period (In Min)<span class="text-danger">&#42;</span></label>
                                                <input id="grace_period" class="form-control" name="grace_period" type="text" placeholder="Grace Period (In Min)">
                                                <span class="text-danger error grace_period_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="paper_total_marks">Total Marks<span class="text-danger">&#42;</span></label>
                                                <input id="paper_total_marks" class="form-control" name="paper_total_marks" type="text" placeholder="Total Marks">
                                                <span class="text-danger error paper_total_marks_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_gradable">Is Gradable <span class="text-danger">&#42;</span></label>
                                                <select id="is_gradable" name="is_gradable" class="form-control">
                                                    <option value="">Select Is Gradable</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <span class="text-danger error is_gradable_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @forelse($questiontypes as $questiontype)
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="question_type_{{ $questiontype->id }}">Question Type <span class="badge badge-primary">{{ $loop->iteration }}</span><span class="text-danger">&#42;</span></label>
                                                        <span id="question_type_{{ $questiontype->id }}" class="form-control">{{ $questiontype->name }}</span>
                                                        <input name="question_type[{{ $questiontype->id }}]" type="hidden" value="{{ $questiontype->id }}">
                                                        <span class="text-danger error question_type_{{ $questiontype->id }}_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="total_marks_{{ $questiontype->id }}">Total Marks <span class="text-danger">&#42;</span></label>
                                                        <input id="total_marks_{{ $questiontype->id }}" class="form-control" name="total_marks[{{ $questiontype->id }}]" type="text" placeholder="Total Marks">
                                                        <span class="text-danger error total_marks_{{ $questiontype->id }}_error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="total_question_{{ $questiontype->id }}">Total Questions <span class="text-danger">&#42;</span></label>
                                                        <input id="total_question_{{ $questiontype->id }}" class="form-control" name="total_question[{{ $questiontype->id }}]" type="text" placeholder="Total Question">
                                                        <span class="text-danger error total_question_{{ $questiontype->id }}_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="evaluated_question_number{{ $questiontype->id }}">Evaluated Question Numbers<span class="text-danger">&#42;</span></label>
                                                        <input id="evaluated_question_number{{ $questiontype->id }}" class="form-control" name="evaluated_question_number[{{ $questiontype->id }}]" type="text">
                                                        <span class="text-danger error evaluated_question_number_{{ $questiontype->id }}_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="short_description_{{ $questiontype->id }}">Short Description <span class="text-danger">&#42;</span></label>
                                                        <input id="short_description_{{ $questiontype->id }}" class="form-control" name="short_description[{{ $questiontype->id }}]" type="text" placeholder="Short Description">
                                                        <span class="text-danger error short_description_{{ $questiontype->id }}_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

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
        $('#course').on('change', function() {
            $('#semester').html(`<option value="">Select Semester</option>`).trigger('change.select2');
            $('#topic').html(`<option value="">Select Topic</option>`).trigger('change.select2');
            $('#examslot').html(`<option value="">Select Examslot</option>`).trigger('change.select2');
            const course = $(this).val();
            let formData = new FormData();
                formData.append('course', course);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.exampaper-structure.get.semesters') }}",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    let semesters = response.semesters;
                    let semesterHtml = `<option value="">Select Semester</option>`;
                    if(semesters.length > 0){
                        semesters.forEach(semester => {
                            semesterHtml += `<option value="${semester.id}">${semester.name}</option>`;
                        });
                    }

                    $('#semester').html(semesterHtml).trigger('change.select2');
                },
                error: function(data) {
                    var response = data.responseJSON;

                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            });
        });
        
        $('#semester').on('change', function() {
            $('#topic').html(`<option value="">Select Topic</option>`).trigger('change.select2');
            $('#examslot').html(`<option value="">Select Examslot</option>`).trigger('change.select2');
            const semester = $(this).val();
            const course = $('#course').val();
            let formData = new FormData();
                formData.append('course', course);
                formData.append('semester', semester);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.exampaper-structure.get.topics') }}",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    let topics = response.topics;
                    let topicHtml = `<option value="">Select Topic</option>`;
                    if(topics.length > 0){
                        topics.forEach(topic => {
                            topicHtml += `<option value="${topic.id}">${topic.name}</option>`;
                        });
                    }

                    $('#topic').html(topicHtml).trigger('change.select2');
                },
                error: function(data) {
                    var response = data.responseJSON;

                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            });
        });
        
        $('#topic').on('change', function() {
            $('#examslot').html(`<option value="">Select Examslot</option>`).trigger('change.select2');
            const topic = $(this).val();
            const semester = $('#semester').val();
            let formData = new FormData();
                formData.append('topic', topic);
                formData.append('semester', semester);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.exampaper-structure.get.examslots') }}",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    let examslots = response.examslots;
                    let examslotHtml = `<option value="">Select Examslot</option>`;
                    if(examslots.length > 0){
                        examslots.forEach(examslot => {
                            examslotHtml += `<option value="${examslot.id}">${examslot.formatted_starts_at}</option>`;
                        });
                    }

                    $('#examslot').html(examslotHtml).trigger('change.select2');
                },
                error: function(data) {
                    var response = data.responseJSON;

                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#semester').select2({
                placeholder: 'Select Semester'
            });
            $('#course').select2({
                placeholder: 'Select Course'
            });
            $('#topic').select2({
                placeholder: 'Select Topic'
            });
            $('#examslot').select2({
                placeholder: 'Select Examslot'
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
