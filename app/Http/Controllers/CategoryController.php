<?php
// I called this category controller at the start, but it handles every single function used by every route.
// This probably isn't best practice, but 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\items;

class CategoryController extends Controller
{
    public function showLanding() {
        return redirect('/');
    }

    public function showMasterCat() {
        return view('mastercat', ['allCats' => categories::all()]);
    }

    public function showMasterItems() {
        $allCats = categories::all();
        return view('masteritems', ['allItems' => items::all(), 'allCats' => $allCats]);
    }

    public function addCategory() {
        return view('addcat');
    }

    public function addItem() {
        $allCats = categories::all();
        return view('additem', ['allCats' => $allCats]);
    }



    public function insertCategory(Request $request) {
        $duplicate = categories::where('category', $request->categoryname)->first(); // Check if the category already exists
        if ($duplicate) {
            return redirect('/categories');
        }
        else {
            $newCategory = new categories;
            $newCategory->category = $request->categoryname;
            $newCategory->save(); 
            $categories = categories::all();
            return redirect('/categories');
        }
    }

    public function insertItem(Request $request) {
        $duplicateName = items::where('name', $request->itemname)->first(); // Check if the name already exists
        $duplicateSKU = items::where('sku', $request->sku)->first(); // Check if the SKU already exists
        if ($duplicateName || $duplicateSKU) { // Check if the SKU or name already exists
            return redirect('/items');
        }
        $newItem = new items;
        $newItem->category_id = $request->categoryid;
        $newItem->name = $request->itemname;
        $newItem->description = $request->desc;
        $newItem->price = $request->price;
        $newItem->quantity = $request->quantity;
        $newItem->sku = $request->sku;
        
        // $request->validate(['picture' => 'required|image|mimes:webp,jpeg,png,jpg,gif']);
        // I couldn't get this to work, when it failed it just broke.
        // I tried with try-catch, but it just didn't happen.
        // I just made it so they can upload any file they want.
        $image = $request->file('picture');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $newItem->picture_path = 'images/' . $imageName;
        $newItem->save();
        $items = items::all();
        return redirect('/items');
        

    }

    public function editItem($id) { 
        $itemID = items::findOrFail($id); 
        $allCats = categories::all();
        return view('edititem', ['items' => $itemID, 'allCats' => $allCats]);
    }

    public function editCategory($id) {
        $catID = categories::findOrFail($id);
        return view('editcat', ['categories' => $catID]);
    }


    public function alterItem(Request $request, $id) {

        $duplicateName = items::where('name', $request->itemname)->where('item_id', '!=', $id)->first(); // Check if the name already exists and is another item
        $duplicateSKU = items::where('sku', $request->sku)->where('item_id', '!=', $id)->first(); // Check if the SKU already exists and is another item
        if ($duplicateName || $duplicateSKU) { 
            return redirect('/items');
        }

        $editItem = items::findOrFail($id);
        $editItem->category_id = $request->categoryid;
        $editItem->name = $request->itemname;
        $editItem->description = $request->desc;
        $editItem->price = $request->price;
        $editItem->quantity = $request->quantity;
        $editItem->sku = $request->sku;
        if ($request->picture != null) {
            $image = $request->file('picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $editItem->picture_path = 'images/' . $imageName;
        }
        $editItem->save();
        return redirect('/items');
    }

    public function alterCategory(Request $request, $id) {
        $duplicate = categories::where('category', $request->categoryname)->first(); // Check if the category already exists
        if ($duplicate) {
            return redirect('/categories');
        }
        $editCategory = categories::findOrFail($id);
        $editCategory->category = $request->categoryname;
        $editCategory->save();

        return redirect('/categories');
    }

    public function deleteItem($id) {
        $deleteItem = items::findOrFail($id);
        unlink(public_path($deleteItem->picture_path));
        $deleteItem->delete();
        return redirect('/items');
    }

    
}
