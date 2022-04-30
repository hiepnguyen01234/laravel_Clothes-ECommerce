<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class DefaultViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // get product list from database
            $products = DB::table('products')->get();
            return view('home')->with('products', $products);
        } catch (Exception $e) {
            // To save message to session just only once time
            // after request, and this will be automatically cleaned
            // -- Other Way --
            // return view('ViewName')->with('message', $e->getMessage());
            session()->flash('message', $e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToAdminPage()
    {
        // return to admin manage page
        return view('frontend\admin\dashboard');
    }
}
