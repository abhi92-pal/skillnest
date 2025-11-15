    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} | Exam Portal</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        @viteReactRefresh
        @vite(['resources/js/exam-app/main.jsx'])
    </head>

    <body>
        <div id="app"></div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        
    </body>

    </html>
