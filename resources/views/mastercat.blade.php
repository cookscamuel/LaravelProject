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

        <title>Categories</title>

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
        <h1>Categories</h1>
        <!-- Display all catgories nicely in a table. -->
        <table id="allcategories" border="1">
            <tr>
            <th>ID</th>
            <th>Category Name</th>
            </tr>
            <!-- Loop through all catagories and make cells for them. -->
            @foreach ($allCats as $cat)
            <tr>
            <td>{{ $cat->category_id }}</td>
            <td>{{ $cat->category }}</td>
            <td>
            <!-- Make an edit button for each category, uses its unique ID. -->
            <form action="{{ route('/categories/{id}/edit', ['id' => $cat->category_id]) }}" method="post" accept-charset="UTF-8">
                {{ csrf_field() }}
                <input type="submit" value="Edit">
            </form>
            </td>
            </tr>
            @endforeach
        </table>
        <br/>
        <!-- Add new category button. -->
        <form action="{{ route('/categories/create') }}" method="post" accept-charset="UTF-8" style="width: 20vw;">
            {{ csrf_field() }}
                <input type="submit" value="Add New Category">
        </form>
        <br/>
        <form action="{{ route('/') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
                <input type="submit" value="Main Menu">
        </form>
    </body>
</html>
