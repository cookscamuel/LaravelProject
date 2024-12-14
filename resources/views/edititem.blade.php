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

        <title>Edit Item</title>

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
        <h1>Edit Item</h1>
        <fieldset style="width: 30vw;">
        <!-- Form for editing a specific item and sending it away for inspection. -->
        <form action="{{ route('/items/{id}/edit/results', ['id' => $items->item_id]) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Rules rules rules. -->
            <label for="itemname">Item Name (must be unique):</label>
            <input type="text" name="itemname" autocomplete="off" value="{{ $items->name }}" required>
            <br/><br/>
            <label for="categoryid">Category:</label>
            <select name="categoryid" id="categoryid">
                @foreach ($allCats as $cat)
                    @if ($cat->category_id == $items->category_id) <!-- check to see if the option is the one that is already selected -->
                        <option value="{{ $cat->category_id }}" selected>{{ $cat->category }}</option> <!-- make it the selected one -->
                    @else
                        <option value="{{ $cat->category_id }}">{{ $cat->category }}</option> <!-- add all the others as options -->
                    @endif
                @endforeach
            </select>
            <br/><br/>
            <label for="desc">Description:</label>
            <input type="text" name="desc" autocomplete="off" value="{{ $items->description }}" required>
            <br/><br/>
            <label for="price">Price: $</label>
            <input type="number" name="price" autocomplete="off" min="0" step="0.01" pattern="^[\d.]+$" value="{{ $items->price }}" required>
            <br/><br/>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" autocomplete="off" min="0" pattern="^[\d.]+$" value="{{ $items->quantity }}" required>
            <br/><br/>
            <!-- There are rules, you know. -->
            <label for="sku">SKU (must be unique):</label>
            <input type="text" name="sku" autocomplete="off" value="{{ $items->sku }}" required>
            <br/><br/>
            <label>Current Image:</label>
            <br/>
            <img src="{{ asset($items->picture_path) }}" alt="Product" width="100vw" height="100vw">
            <br/><br/>
            <label for="picture">Change Image:</label>
            <input type="file" name="picture" accept=".jpeg,.jpg,.png,.gif,.webp" maxlength="254">
            <p>Supported file types: .jpeg .jpg .png .gif .webp</p>
            <input type="submit" value="Confirm Changes">
        </form>
        <br/>
        <!-- In case it isn't clear, all of these bottom forms are for going back from whence the user came. -->
        <form action="{{ route('/items') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="submit" value="Cancel">
        </form>
    </fieldset>
    </body>
</html>
