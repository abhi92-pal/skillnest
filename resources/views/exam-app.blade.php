    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} | Exam Portal</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

        @viteReactRefresh
        @vite(['resources/js/exam-app/main.jsx'])
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Poppins, sans-serif;
            }

            body {
                background: #eef2f7;
            }

            .main-layout {
                display: flex;
                height: 100vh;
            }

            /* SIDEBAR */
            .question-sidebar {
                width: 230px;
                background: #1e1e2f;
                color: white;
                padding: 20px;
            }

            .question-sidebar h3 {
                margin-bottom: 20px;
                text-align: center;
            }

            .q-list {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }

            .q-item {
                padding: 12px;
                background: #34344a;
                border: none;
                color: white;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
            }

            .q-item.active {
                background: #007bff;
            }

            /* RIGHT PANEL */
            .question-panel {
                flex: 1;
                padding: 25px;
            }

            /* TOP BAR */
            .top-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .question-type-tabs {
                display: flex;
                gap: 10px;
            }

            .tab {
                padding: 10px 18px;
                background: #e7e7e7;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
            }

            .tab.active {
                background: #007bff;
                color: white;
            }

            .question-box {
                margin-top: 25px;
                padding: 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            }

            .question-text {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 20px;
            }

            /* MCQ */
            .options {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .option {
                padding: 12px;
                background: #fafafa;
                border-radius: 8px;
                border: 1px solid #ccc;
                cursor: pointer;
            }

            /* SHORT ANSWER */
            .short-block {
                display: none;
                margin-top: 20px;
            }

            .short-input {
                width: 100%;
                padding: 12px;
                border-radius: 8px;
                border: 1px solid #ccc;
                font-size: 16px;
            }

            /* DESCRIPTIVE */
            .descriptive-block {
                display: none;
                margin-top: 20px;
            }

            .descriptive-textarea {
                width: 100%;
                height: 150px;
                padding: 12px;
                border-radius: 8px;
                border: 1px solid #ccc;
                font-size: 16px;
            }

            /* BUTTONS */
            .navigation-buttons {
                margin-top: 30px;
                display: flex;
                justify-content: space-between;
            }

            .btn {
                padding: 12px 28px;
                border-radius: 10px;
                border: none;
                cursor: pointer;
                font-weight: 600;
            }

            .prev {
                background: #6c757d;
                color: white;
            }

            .next {
                background: #28a745;
                color: white;
            }

            /* LEFT SIDEBAR */
            .sidebar {
                width: 240px;
                background: #ffffff;
                border-right: 1px solid #ddd;
                padding: 20px;
            }

            /* Title */
            .side-title {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            /* QUESTION NUMBER GRID */
            .question-number-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
            }

            /* Base Button Style */
            .q-btn {
                width: 45px;
                height: 45px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
                color: white;
            }

            /* Colors */
            .q-btn.unseen {
                background: #9e9e9e;
                /* Gray */
            }

            .q-btn.seen {
                background: #2196f3;
                /* Blue */
            }

            .q-btn.answered {
                background: #4caf50;
                /* Green */
            }

            /* LEGENDS */
            .legend-box {
                margin-top: 25px;
                padding-top: 15px;
                border-top: 1px solid #ccc;
            }

            .legend-item {
                display: flex;
                align-items: center;
                margin-bottom: 8px;
                font-size: 15px;
            }

            .legend {
                width: 18px;
                height: 18px;
                display: inline-block;
                border-radius: 4px;
                margin-right: 10px;
            }

            .legend.unseen {
                background: #9e9e9e;
            }

            .legend.seen {
                background: #2196f3;
            }

            .legend.answered {
                background: #4caf50;
            }

            .exam-container {
                display: flex;
                height: 100vh;
            }

            /* LEFT SIDEBAR */
            .exam-sidebar {
                width: 260px;
                background: #f5f5f5;
                border-right: 1px solid #ddd;
                padding: 20px;
            }

            /* RIGHT CONTENT */
            .exam-content {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* TABS HEADER */
            .section-tabs {
                display: flex;
                gap: 10px;
                padding: 15px 20px;
                border-bottom: 1px solid #ddd;
                background: #fff;
            }

            .section-tabs .tab {
                padding: 8px 16px;
                border: none;
                background: #e9ecef;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 500;
            }

            .section-tabs .tab.active {
                background: #0d6efd;
                color: #fff;
            }

            /* QUESTION AREA */
            .question-wrapper {
                flex: 1;
                padding: 30px;
                overflow-y: auto;
            }
        </style>
    </head>

    <body>
        <div id="app"></div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
        </script>

    </body>

    </html>
