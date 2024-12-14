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

        <title>New Item</title>

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
        <h1>New Item</h1>
        <fieldset style="width: 30vw;">
        <!-- Form to add a new item. -->
        <form action="{{ route('/items/create/results') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Tell the user the rules of entry. No error message, sorry :( -->
            <label for="itemname">Item Name (must be unique):</label>
            <input type="text" name="itemname" autocomplete="off" maxlength="254" required>
            <br/><br/>
            <label for="categoryid">Category:</label>
            <select name="categoryid" id="categoryid" required> <!-- makes it so the user can't make an item with no categories -->
                @foreach ($allCats as $cat) <!-- Display each category name as an option, with its ID as the value. -->
                <option value="{{ $cat->category_id }}">{{ $cat->category}}</option>
                @endforeach
            </select>
            <br/><br/>
            <label for="desc">Description:</label>
            <input type="text" name="desc" autocomplete="off" maxlength="254" required>
            <br/><br/>
            <label for="price">Price: $</label>
            <!-- Increment by 0.01 allows for floats, regex makes sure its an integer or a float. Sorry, no JS validation. -->
            <input type="number" name="price" autocomplete="off" min="0" step="0.01" pattern="^[\d.]+$" required>
            <br/><br/>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" autocomplete="off" min="0" pattern="^[\d.]+$" required>
            <br/><br/>
            <!-- Display the rules of entry again. -->
            <label for="sku">SKU (must be unique):</label>
            <input type="text" name="sku" autocomplete="off" maxlength="254" required>
            <br/><br/>
            <label for="picture">Image:</label>
            <!-- Encourage the user to upload those file types. -->
            <input type="file" name="picture" accept=".jpeg,.jpg,.png,.gif,.webp" maxlength="254" required>
            <p>Supported file types: .jpeg .jpg .png .gif .webp</p>
            <input type="submit" value="Create Item">
        </form>
        <br/>
        <form action="{{ route('/items') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="submit" value="Cancel">
        </form>
    </fieldset>
    </body>
</html>
