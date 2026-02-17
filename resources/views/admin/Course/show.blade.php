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
                                                                    <a href="{{ route('admin.lession.index', $sem_topic->id) }}" class="btn btn-info btn-sm">
                                                                        <i class="fa fa-eye"></i> View Lessions
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm manage_examslot_btn" data-topic="{{ $sem_topic->id }}" data-semester="{{ $semester->id }}">
                                                                        <i class="fa fa-pen"></i> Manage Exam Slots
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

        <!-- Add modal -->
        <div class="modal fade" id="slotModal" tabindex="-1" role="dialog" aria-labelledby="slotModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <h3>Manage Exam Slots</h3>
                        <form id="slotForm" class="" action="{{ route('admin.examslot.manage') }}" method="post">
                            @csrf
                            <input type="hidden" name="slot_id" id="slot_id">
                            <input type="hidden" name="semester" id="semester_inp">
                            <input type="hidden" name="topic" id="topic_inp">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exam_slot">Slot <span class="text-danger">&#42;</span></label>
                                        <input id="exam_slot" class="form-control" name="exam_slot" type="text" placeholder="Name" readonly>
                                        <span class="text-danger error exam_slot_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max_candidate">Max Candidate <span class="text-danger">&#42;</span></label>
                                        <input id="max_candidate" class="form-control" name="max_candidate" type="text" placeholder="Max Candidate">
                                        <span class="text-danger error max_candidate_error"></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info submitBtn">Submit</button>
                            <button type="button" class="btn btn-danger cancel_edit" style="display: none;">Cancel</button>
                        </form>
                        <div>
                            <h4>Exam Slots</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Slot</th>
                                            <th>Max Candidate</th>
                                            <th>Remaining Seat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="savedExamSlots">
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /edit modal -->

    </div>
@endsection

@section('js')
    <script>
        const currentDatetime = "{{ date('Y-m-d H:i:s') }}";
        $(document).on('click', '.edit_slot', function() {
            const __this = $(this);
            const startsAt = __this.data('starts_at');
            const slotId = __this.data('id');
            const maxCandidate = __this.data('max_candidate');

            $('#slot_id').val(slotId);
            // $('#exam_slot').val(startsAt);
            $('#max_candidate').val(maxCandidate);
            $('.cancel_edit').show();
            initiateDtPicker(startsAt);
            
        });

        $(document).on('click', '.cancel_edit', function() {
            const __this = $(this);

            $('#slot_id').val('');
            $('#max_candidate').val('');
            $('.cancel_edit').hide();
            initiateDtPicker(currentDatetime);
            
        });

        $(document).on('click', '.delete_item', function(){
            const __this = $(this);
            const actionUrl = __this.data('url');

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'You want to delete the slot!',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
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

                            __this.closest('tr').remove();
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

        $(document).ready(function() {
            $('.manage_examslot_btn').on('click', function() {
                const __this = $(this);
                const semester = __this.data('semester');
                const topic = __this.data('topic');

                $('#semester_inp').val(semester);
                $('#topic_inp').val(topic);
                $('#slot_id').val('');

                let formData = new FormData();
                formData.append('semester', semester);
                formData.append('topic', topic);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.examslot.index') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        $('#savedExamSlots').html(response.data.html);
                        $('#slotModal').modal('show');
                        initiateDtPicker(currentDatetime);
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

            $('form#slotForm').on('submit', function() {
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
                        setTimeout(() => {
                            location.reload(true);
                        }, 1500);
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

        function initiateDtPicker(forDateTime){
            forDateTime = moment(forDateTime, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY hh:mm A");
            $('#exam_slot').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: {{ date('Y') - 1 }},
                startDate: forDateTime,
                // startDate: moment().startOf('hour'),
                // endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'DD/MM/YYYY hh:mm A'
                }
            });

            $('#exam_slot').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY hh:mm A'));
                // $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

        }
    </script>
@endsection
