<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TestBoalt</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('assets/style.css') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">TestBoalt</div>
                <div class="links">
                    <a href="https://github.com/walkovik/testboalt">Github & README</a>
                    <a href="#"
                       title="Download Postman File">Postman Files</a>
                    <a href="http://localhost:8000/api/documentation"
                       title="must run php artisan serve first">Swagger Documentation</a>
                </div>
            </div>
        </div>
    </body>
</html>
