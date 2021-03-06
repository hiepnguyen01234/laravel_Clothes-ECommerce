<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $products = DB::table('products')->get();
            return view('home')->with('products', $products);
        } catch (Exception $e) {
            // To save message to session just only once time
            // after request, and this will be automatically cleaned
            session()->flash('message', $e->getMessage());
        }
    }
}
