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
        <form action="{{ route('/items/create/results') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}

            <label for="itemname">Item Name:</label>
            <input type="text" name="itemname" autocomplete="off" value="{{ $items->name }}" required>
            <br/><br/>
            <label for="categoryid">Category:</label>
            <select name="categoryid" id="categoryid">
                <option value="volvo">USE PHP TO QUERY FOR CATEGORY IDS</option>
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
            <label for="sku">SKU:</label>
            <input type="text" name="sku" autocomplete="off" value="{{ $items->sku }}" required>
            <br/><br/>
            <label for="picture">Image:</label>
            <input type="file" name="picture" required>
            <br/><br/>
            <input type="submit" value="Confirm Changes">
        </form>
        <br/>
        <form action="{{ route('/items') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="submit" value="Cancel">
        </form>
    </fieldset>
    </body>
</html>
