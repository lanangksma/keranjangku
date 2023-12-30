<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $users = User::all();

        return view('dashboard.dashboard', ['products' => $products, 'categories' => $categories, 'users' => $users]);
    }
}
