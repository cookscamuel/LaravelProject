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
        return view('masteritems', ['allItems' => items::all()]);
    }

    public function addCategory() {
        return view('addcat');
    }

    public function addItem() {
        return view('additem');
    }



    public function insertCategory(Request $request) {
        $newCategory = new categories;
        $newCategory->category = $request->categoryname;
        $newCategory->save(); 
        $categories = categories::all();
        return redirect('/categories');
    }

    public function insertItem(Request $request) {
        $newItem = new items;
        // QUERY FOR CATEGORY ID
        $newItem->category_id = 0;
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
        return view('edititem', ['items' => $itemID]); 
    }

    public function editCategory($id) {
        $catID = categories::findOrFail($id);
        return view('editcat', ['categories' => $catID]);
    }

    
}
