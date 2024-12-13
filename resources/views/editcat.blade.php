<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit Category</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
            </style>
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <h1>Edit Category</h1>
        <form action="{{ route('/categories/create/results') }}" method="post" accept-charset="UTF-8" style="width: 20vw;">
            {{ csrf_field() }}

            <label for="categoryname">Category Name</label>
            <input type="text" name="categoryname" autocomplete="off" value="{{ $categories->category }}" required>
            <br/><br/>
            <input type="submit" value="Confirm Changes">
        </form>
        <br/>
        <form action="{{ route('/categories') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
                <input type="submit" value="Cancel">
        </form>
    </body>
</html>
