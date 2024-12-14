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
        <!-- Display all items in a table. -->
        <table id="allitems" border="1">
            <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>On-Hand</th>
            <th>SKU</th>
            <th>Image</th>
            </tr>
            <!-- Display every item. -->
            @foreach ($allItems as $item)
            <tr>
            <td>{{ $item->item_id }}</td>
            <!-- Display the name of the category rather than the ID -->
            <td>{{ $allCats[$item->category_id - 1]->category }}</td> 
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>${{ $item->price }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->sku }}</td>
            <!-- Display the image path as an image. -->
            <td><img src="{{ $item->picture_path }}" alt="{{ $item->name }}" width="100vw" height="100vw"></td>
            <td>
            <!-- Edit button for the unique ID for each item. -->
            <form action="{{ route('/items/{id}/edit', ['id' => $item->item_id]) }}" method="post" accept-charset="UTF-8">
                {{ csrf_field() }}
                <input type="submit" value="Edit">
            </form>
            </td>
            <td>
            <!-- Delete button for each item using its unique ID. -->
            <form id="deleteform-{{ $item->item_id }}" action="{{ route('/items/{id}/delete', ['id' => $item->item_id]) }}" method="post" accept-charset="UTF-8">
                {{ csrf_field() }}
                <!-- Button that will execute my JS function to confirm deletion. -->
                <button type="button" onclick="deleteItem({{ json_encode($item->name) }}, {{ json_encode($item->item_id) }})">Delete</button>
            </form>
            </td>
            </tr>
            @endforeach
        </table>
        <br/>
        <!-- Add a new item button. -->
        <form action="{{ route('/items/create') }}" method="post" accept-charset="UTF-8" style="width: 20vw;">
            {{ csrf_field() }}
                <input type="submit" value="Add New Item">
        </form>
        <br/>
        <form action="{{ route('/') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
                <input type="submit" value="Main Menu">
        </form>
        <!-- JS function that makes a popup confirming if the user wants to delete an item. -->
        <script>
        function deleteItem(itemname, itemid) {
            var formID = "deleteform-" + itemid; // Get the unique ID from the specific delete button form.
            var deleteform = document.getElementById(formID); // Target the specific form.
            if (confirm("Are you sure you want to delete " + itemname + " from the list?")) { // If they click yes.
                deleteform.submit(); // Submit the form.
            }
        }
        </script>
    </body>
</html>
