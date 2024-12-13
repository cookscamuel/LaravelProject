<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Items</title>

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
        <h1>Items</h1>
        <table id="allitems" border="1">
            <tr>
            <th>ID</th>
            <th>Item Name</th>
            </tr>
            @foreach ($allItems as $item)
            <tr>
            <td>{{ $item->item_id }}</td>
            <td>{{ $item->category_id }}</td>
            <!-- CONVERT IT TO THE CATGEORY NAME WITH OTHER TABLE -->
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>${{ $item->price }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->sku }}</td>
            <td>{{ $item->picture_path }}</td>
            <!-- WRAP IN IMAGE TAG -->
            <td>Edit</td>
            <td>Delete</td>
            </tr>
            @endforeach
        </table>
        <br/>
        <form action="{{ route('/items/create') }}" method="post" accept-charset="UTF-8" style="width: 20vw;">
            {{ csrf_field() }}
                <input type="submit" value="Add New Item">
        </form>
        <br/>
        <form action="{{ route('/') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
                <input type="submit" value="Main Menu">
        </form>
    </body>
</html>
