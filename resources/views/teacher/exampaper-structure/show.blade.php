@extends('teacher.layouts.app')
@section('title', $exampaper->name)

@section('css')
    <style>
        .bs-example-form .input-group {
            margin-bottom: 10px;
        }

        .input-group {
            position: relative;
            display: table;
            border-collapse: separate;
        }

        .input-group-addon:first-child {
            border-right: 0;
        }

        .input-group .form-control:first-child,
        .input-group-addon:first-child,
        .input-group-btn:first-child>.btn,
        .input-group-btn:first-child>.btn-group>.btn,
        .input-group-btn:first-child>.dropdown-toggle,
        .input-group-btn:last-child>.btn-group:not(:last-child)>.btn,
        .input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .input-group-addon,
        .input-group-btn {
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }

        .input-group .form-control,
        .input-group-addon,
        .input-group-btn {
            display: table-cell;
        }

        .input-group {
            position: relative;
            display: table;
            border-collapse: separate;
        }
    </style>

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
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <strong>Course: </strong> {{ $exampaper->course->name }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Topic: </strong> {{ $exampaper->topic->name }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Semester: </strong> {{ $exampaper->semester->name }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <strong>Examslot: </strong>
                                        {{ date('d/m/Y h:i A', strtotime($exampaper->examslot->starts_at)) }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Duration: </strong> {{ $exampaper->duration }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Total Marks: </strong> {{ $exampaper->total_marks }}
                                    </div>
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                        <div class="card">
                            <div class="card-body">
                                <form action="">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        @forelse($questiontypes as $questiontype)
                                            <li role="presentation"
                                                class="{{ $loop->iteration == 1 ? 'active pl-2' : '' }} mr-2 border-right pr-2">
                                                <a href="#tab_el_{{ $questiontype->id }}"
                                                    aria-controls="tab_el_{{ $questiontype->id }}" role="tab"
                                                    data-toggle="tab">{{ $questiontype->name }}</a>
                                            </li>
                                        @empty
                                        @endforelse
                                        {{-- <li role="presentation" class="mr-2"><a href="#profile" aria-controls="profile" role="tab"
                                                data-toggle="tab">Profile</a></li>
                                        <li role="presentation" class="mr-2"><a href="#messages" aria-controls="messages" role="tab"
                                                data-toggle="tab">Messages</a></li>
                                        <li role="presentation" class="mr-2"><a href="#settings" aria-controls="settings" role="tab"
                                                data-toggle="tab">Settings</a></li> --}}
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        @include('teacher.exampaper-structure.partials.create-questions', [
                                            'questiontypes' => $questiontypes,
                                        ])
                                    </div>

                                    <button class="btn btn-success">Save</button>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            /*
            $(document).on('click', '.freeze_btn', function(){
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
                    if(response.isConfirmed){
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
            */
        });
    </script>
@endsection
