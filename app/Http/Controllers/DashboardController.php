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
        if (auth()->guest()) {
            return redirect()->route('home');
        }

        if (auth()->user()->email !== 'lanangkusuma10@gmail.com') {
            return redirect()->route('home');
        }

        $products = Product::all();
        $categories = Category::all();
        $users = User::count();

        return view('dashboard.dashboard', ['products' => $products, 'categories' => $categories, 'users' => $users]);
    }
}
