@extends('admin.layouts.app')
@section('title', 'View Student Course')

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

                                <!-- Display Semesters and Topics -->
                                <div class="accordion" id="semesterTopicAccordion">
                                    @forelse($semesters as $semester)
                                        <div class="card">
                                            <div class="card-header p-0" id="heading_sem_{{ $loop->iteration }}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse_sem_{{ $loop->iteration }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapse_sem_{{ $loop->iteration }}">
                                                        <strong>{{ $semester->name }}</strong>
                                                        <div>
                                                            @php
                                                                $progress = getSemesterWiseProgress($student->id, $course->id, $semester->id);
                                                            @endphp
                                                            Progress: <strong class="@if($progress > 50) text-success @else text-danger @endif">{{ $progress }}%</strong>
                                                        </div>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse_sem_{{ $loop->iteration }}" class="collapse show"
                                                aria-labelledby="heading_sem_{{ $loop->iteration }}"
                                                data-parent="#semesterTopicAccordion">
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
                                                                @if ($sem_topic->lessions->count())
                                                                    <div class="col-md-12">
                                                                        <h4>Lessons</strong></h4>
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Sl No</th>
                                                                                    <th>Name</th>
                                                                                    <th>Type</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($sem_topic->lessions as $lession)
                                                                                    <tr>
                                                                                        <td>{{ $loop->iteration }}</td>
                                                                                        <td>{{ $lession->name }}</td>
                                                                                        <td>{{ $lession->type }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endif
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

@endsection
