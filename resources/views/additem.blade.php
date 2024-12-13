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
        <form action="{{ route('/items/create/results') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}

            <label for="itemname">Item Name:</label>
            <input type="text" name="itemname" autocomplete="off" required>
            <br/><br/>
            <label for="categoryid">Category:</label>
            <select name="categoryid" id="categoryid">
                @foreach ($allCats as $cat)
                <option value="{{ $cat->category_id }}">{{ $cat->category}}</option>
                @endforeach
            </select>
            <br/><br/>
            <label for="desc">Description:</label>
            <input type="text" name="desc" autocomplete="off" required>
            <br/><br/>
            <label for="price">Price: $</label>
            <input type="number" name="price" autocomplete="off" min="0" step="0.01" pattern="^[\d.]+$" required>
            <br/><br/>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" autocomplete="off" min="0" pattern="^[\d.]+$" required>
            <br/><br/>
            <label for="sku">SKU:</label>
            <input type="text" name="sku" autocomplete="off" required>
            <br/><br/>
            <label for="picture">Image:</label>
            <input type="file" name="picture" accept=".jpeg,.jpg,.png,.gif,.webp" required>
            <p><i>Supported file types: .jpeg .jpg .png .gif .webp</i></p>
            <br/><br/>
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
