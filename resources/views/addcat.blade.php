<!--
    Author: Samuel Cook
    Date: December 12, 2024
    Sorry for clunkiness, this was all new to me.
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>New Category</title>

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
        <h1>New Category</h1>
        <!-- Form for adding a new category. -->
        <form action="{{ route('/categories/create/results') }}" method="post" accept-charset="UTF-8" style="width: 20vw;">
            {{ csrf_field() }}

            <!-- Instead of error messages, I just tell the user when they enter. -->
            <label for="categoryname">Category Name (must be unique)</label>
            <input type="text" name="categoryname" autocomplete="off" maxlength="254" required>
            <br/><br/>
            <input type="submit" value="Create Category">
        </form>
        <br/>
        <form action="{{ route('/categories') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
                <input type="submit" value="Cancel">
                <!-- I wasn't sure of a better way to do this at the start, so there are forms everywhere. -->
        </form>
    </body>
</html>
