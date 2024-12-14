<?php
// I called this category controller at the start, but it handles every single function used by every route.
// This probably isn't best practice, but this is all new information to me.
namespace App\Http\Controllers;


// Author: Samuel Cook
// Date: December 12, 2024
// Sorry for clunkiness, this was all new to me.

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\items;

class CategoryController extends Controller
{
    // Simple redirect function to direct users to the landing page.
    public function showLanding() {
        return redirect('/');
    }

    // Show the master list of categories
    public function showMasterCat() {
        return view('mastercat', ['allCats' => categories::all()]);
    }

    // Show the master list of items
    public function showMasterItems() {
        $allCats = categories::all();
        return view('masteritems', ['allItems' => items::all(), 'allCats' => $allCats]);
        // Categories are required for accessible viewing for the user.
        // It's so the user doesn't see category 1,2,4, they see the name
        // of the category.
    }

    // Show the view for adding a new category.
    public function addCategory() {
        return view('addcat');
    }

    // Show the view for adding a new item.
    public function addItem() {
        $allCats = categories::all(); // Required to populate the dropdown menu.
        return view('additem', ['allCats' => $allCats]);
    }

    // Used to actually add a new category to the database.
    public function insertCategory(Request $request) {
        $duplicate = categories::where('category', $request->categoryname)->first(); // Check if the category already exists
        if ($duplicate) { // Check to see if this category name already exists.
            return redirect('/categories'); // Redirect.
        } // I ran out of time to add error messages or highlighting for the user.
        else {
            $newCategory = new categories; // Make a new entry in categories.
            $newCategory->category = $request->categoryname; // Set the category as the user's input.
            $newCategory->save(); // Save it to the database.
            return redirect('/categories'); // Return to category master list.
        }
    }

    // Used to add a new item to the database.
    public function insertItem(Request $request) {
        $duplicateName = items::where('name', $request->itemname)->first(); // Check if the name already exists
        $duplicateSKU = items::where('sku', $request->sku)->first(); // Check if the SKU already exists
        if ($duplicateName || $duplicateSKU) { // Check if the SKU or name already exists
            return redirect('/items'); // Go away!
        }
        $newItem = new items; // Make a new item.
        $newItem->category_id = $request->categoryid; // Fill in the columns with the relevant information.
        $newItem->name = $request->itemname;
        $newItem->description = $request->desc;
        $newItem->price = $request->price;
        $newItem->quantity = $request->quantity;
        $newItem->sku = $request->sku;
        
        // $request->validate(['picture' => 'required|image|mimes:webp,jpeg,png,jpg,gif']);
        // I couldn't get this to work, when it failed it just broke.
        // I tried with try-catch, but it just didn't happen.
        // I just made it so they can upload any file they want.
        // At least the alt text on each image is the item name.

        $image = $request->file('picture'); // Create a variable to hold the file uploaded by the user.
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Rename it to be always unique.
        $image->move(public_path('images'), $imageName); // Move the uploaded file to public/images/
        $newItem->picture_path = 'images/' . $imageName; // Store the path to the database.
        $newItem->save(); // Save the item.
        return redirect('/items'); // Return to item master list.
        
    }

    // Used to bring up the editing screen for a specific item.
    public function editItem($id) { 
        $itemID = items::findOrFail($id); // Get the specific ID for the entry that was clicked.
        $allCats = categories::all(); // Get all categories for the dropdown.
        return view('edititem', ['items' => $itemID, 'allCats' => $allCats]); // Go to the editing screen.
    }

    // Used to display the editing screen for a specific category.
    public function editCategory($id) {
        $catID = categories::findOrFail($id); // Get the specific ID for the entry that was clicked.
        return view('editcat', ['categories' => $catID]); // Go to the editing screen.
    }

    // Used to actually alter an entry in the items table.
    public function alterItem(Request $request, $id) {

        $duplicateName = items::where('name', $request->itemname)->where('item_id', '!=', $id)->first(); // Check if the name already exists and is another item
        $duplicateSKU = items::where('sku', $request->sku)->where('item_id', '!=', $id)->first(); // Check if the SKU already exists and is another item
        if ($duplicateName || $duplicateSKU) { 
            return redirect('/items');
        } // This allows for edits where the name or sku do not change.

        $editItem = items::findOrFail($id); // Get the ID of the item that is edited.
        $editItem->category_id = $request->categoryid; // Fill it with all the entered info.
        $editItem->name = $request->itemname;
        $editItem->description = $request->desc;
        $editItem->price = $request->price;
        $editItem->quantity = $request->quantity;
        $editItem->sku = $request->sku;
        if ($request->picture != null) { // If there's a new picture...
            unlink(public_path($editItem->picture_path)); // Delete the old picture.
            $image = $request->file('picture'); // Get the file as a variable.
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Set the name to the unique time.
            $image->move(public_path('images'), $imageName); // Upload the picture to images.
            $editItem->picture_path = 'images/' . $imageName; // Set the database file location to the new picture location.
        }
        $editItem->save(); // Save.
        return redirect('/items'); // Get out of here!
    }

    // Actually alter an entry in the categories table.
    public function alterCategory(Request $request, $id) {
        $duplicate = categories::where('category', $request->categoryname)->first(); // Check if the category already exists
        if ($duplicate) {
            return redirect('/categories');
        } // Since this one is only one field, and I ran out of time for better user feedback,
          // I am only checking for other occurences of this category name.
        $editCategory = categories::findOrFail($id);
        $editCategory->category = $request->categoryname; // Update it.
        $editCategory->save(); // Save it.
        return redirect('/categories'); // Redirect it.
    }

    // Used when deleting an item.
    public function deleteItem($id) {
        $deleteItem = items::findOrFail($id); // Fetch the id of the specific item up on the chopping block.
        unlink(public_path($deleteItem->picture_path)); // Delete the picture.
        $deleteItem->delete(); // Delete the item.
        return redirect('/items'); // Go back to item master list.
    }

    
}
