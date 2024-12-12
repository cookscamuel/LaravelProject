<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\categories;
use App\models\items;

class CategoryController extends Controller
{
    public function showLanding() {
        return redirect('/');
    }

    public function showMasterCat() {
        return redirect('/categories');
    }

    public function showMasterItems() {
        return redirect('/items');
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
        return view('newcatresults');
    }

    // public function insertItem(Request $request) {
    //     $newItem = new items;
    //     $newItem->
    // }
    
}
