<?php

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
        // SAVE PICTURE AND THEN UPLOAD THE PATH TO THE PICTURE
        $newItem->picture_path = "IMAGE LINK";
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

    
}
