@extends('admin.layouts.app')
@section('title', 'Add Course')

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
                                <form action="" method="POST" id="createForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name <span class="text-danger">&#42;</span></label>
                                                <input id="name" class="form-control" name="name" type="text"
                                                    placeholder="Enter Name">
                                                <span class="text-danger error name_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="short_description">Short Description <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="short_description" class="form-control" name="short_description"
                                                    type="text" placeholder="Enter Short Description">
                                                <span class="text-danger error short_description_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price <span class="text-danger">&#42;</span></label>
                                                <input id="price" class="form-control" name="price" type="text"
                                                    placeholder="Enter Price">
                                                <span class="text-danger error price_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selling_price">Selling Price <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="selling_price" class="form-control" name="selling_price"
                                                    type="text" placeholder="Enter Selling Price">
                                                <span class="text-danger error selling_price_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration_type">Duration Type <span
                                                        class="text-danger">&#42;</span></label>
                                                <select name="" id="duration_type" name="duration_type"
                                                    class="form-control">
                                                    <option value="">Select Duration Type</option>
                                                    <option value="Hour">Hour</option>
                                                    <option value="Day">Day</option>
                                                    <option value="Month">Month</option>
                                                    <option value="Year">Year</option>
                                                </select>
                                                <span class="text-danger error duration_type_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duration">Durations <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="duration" class="form-control" name="duration" type="text"
                                                    placeholder="Enter Duration">
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
                                                    placeholder="Enter Long Description"></textarea>
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
                                                    type="date">
                                                <span class="text-danger error reg_end_date_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_of_semester">Semester Number <span
                                                        class="text-danger">&#42;</span></label>
                                                <input id="no_of_semester" class="form-control" name="no_of_semester"
                                                    type="text" placeholder="Enter Semester Number">
                                                <span class="text-danger error no_of_semester_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion" id="semesterTopicAccordion"></div>
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

        $(document).on('click', '.add_more', function(){
            const __this = $(this);
            const closestWrap = __this.closest('.sem_topic_wrap');
            let semId = __this.data('semid');
            let lastIteration = parseInt(__this.data('last_iteration'));
            lastIteration++;

            let teacherOptions = '';
            TEACHERS.forEach(teacher => {
                teacherOptions += `<option value="${teacher.id}">${teacher.name}</option>`;
            });

            let topicHtml = `<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="t_name_${semId}_${lastIteration}">Topic Name <span class="text-danger">&#42;</span></label>
                                        <input id="t_name_${semId}_${lastIteration}" class="form-control" name="t_name[${semId}][${lastIteration}]" type="date">
                                        <span class="text-danger error t_name_${semId}_${lastIteration}_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="t_author_${semId}_${lastIteration}">Author <span class="text-danger">&#42;</span></label>
                                        <select name="" id="t_author_${semId}_${lastIteration}" name="t_author[${semId}][${lastIteration}]" class="form-control">
                                            <option value="">Select Author</option>
                                            ${teacherOptions}
                                        </select>
                                        <span class="text-danger error t_author_${semId}_${lastIteration}_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="t_descitpion_${semId}_${lastIteration}">Description <span class="text-danger">&#42;</span></label>
                                        <textarea id="t_descitpion_${semId}_${lastIteration}" class="form-control" name="t_descitpion[${semId}][${lastIteration}]" placeholder="Enter Description"></textarea>
                                        <span class="text-danger error t_descitpion_${semId}_${lastIteration}_error"></span>
                                    </div>
                                </div>
                            </div>`;

            $('.sem_topic_body', closestWrap).append(topicHtml);
            __this.attr('data-last_iteration', lastIteration);
        });
    </script>
@endsection
