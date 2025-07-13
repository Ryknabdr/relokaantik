<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
// Removed use App\Models\Order; because Order model does not exist

class DashboardController extends Controller
{
    public function index(){
        $productCount = Product::count();
        $categoryCount = Categories::count();
        $orderCount = 0; // Set to 0 or remove if no orders table/model

        return view('dashboard', compact('productCount', 'categoryCount', 'orderCount'));
    }

    public function products(){
        return view('dashboard.products.index');
    }
}
