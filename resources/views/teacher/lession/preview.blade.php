@extends('teacher.layouts.app')
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
                                <div id="player"></div>
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
            loadContent();
        });

        function loadContent() {
            // fetch('/api/content/{{ $lession->id }}', {
            fetch("{{ route('api.content.get', $lession->id) }}", {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.type === 'Video') {
                    document.getElementById('player').innerHTML = `
                        <video controls width="800"
                            controlsList="nodownload"
                            oncontextmenu="return false">
                            <source src="${data.stream_url}" type="video/mp4">
                        </video>
                    `;
                } else {
                    document.getElementById('player').innerHTML = `
                        <iframe src="${data.stream_url}" width="100%" height="600"></iframe>
                    `;
                }
            });
        }
    </script>
@endsection
