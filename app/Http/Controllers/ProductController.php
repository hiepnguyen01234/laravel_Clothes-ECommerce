<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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

            // check user's role,
            // if not admin then redirect home page
            if (auth()->user()->name != 1) {
                return view('home')->with('products', $products);
            }

            // if user is admin,
            // redirect to list product manager
            return view('frontend.product.list')->with('products', $products);
        } catch (Exception $e) {
            // To save message to session just only once time
            // after request, and this will be automatically cleaned
            // -- Other Way --
            // return view('ViewName')->with('message', $e->getMessage());
            session()->flash('message', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect to product create page
        return view('frontend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validator process
        $validator = Validator::make($request->all(), [
            'name'       => 'required|max:255',
            'price'      => 'required|numeric',
            'content'    => 'required',
            'image_path' => 'required'
        ]);

        // information check
        // --★ Note: method withErrors ★--
        // Render to web page an array variable name: "errors".
        if ($validator->fails()) {
            return redirect('product/create')
                ->withErrors($validator)
                ->withInput();
        }

        // save product's information to database
        $active = $request->has('active') ? 1 : 0;
        $product_id = DB::table('products')->insertGetId([
            'name'       => $request->input('name'),
            'price'      => $request->input('price'),
            'content'    => $request->input('content'),
            'image_path' => $request->input('image_path'),
            'active'     => $active
        ]);

        // return to product's create page
        return view('frontend.product.create')
            ->with('message', 'CREATED PRODUCT SUCCESSFULLY WITH ID: ' . $product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Search product in database
            $product = DB::table('products')->find($id);

            // return to product's create page
            // --★ Note: method compact ★--
            // I think it will build a variable to render to web page
            // with same name with the defined variable in this method.
            // The same way may be like: "->with('product', $product);".
            return view('frontend.product.show')->with(compact('product'));
        } catch (Exception $e) {
            return view('frontend.product.show')->with('message', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Edit product detail
        // --★ Note: method compact ★--
        // I think it will build a variable to render to web page
        // with same name with the defined variable in this method.
        // The same way may be like: "->with('product', $product);".
        $product = DB::table('products')->find($id);
        return view('frontend.product.edit')->with(compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validator process
        $validator = Validator::make($request->all(), [
            'name'       => 'required|max:255',
            'price'      => 'required|numeric',
            'content'    => 'required',
            'image_path' => 'required'
        ]);

        // information check
        // --★ Note: method withErrors ★--
        // Render to web page an array variable name: "errors".
        if ($validator->fails()) {
            return redirect('product/create')
                ->withErrors($validator)
                ->withInput();
        }

        //update product detail
        $active = $request->has('active') ? 1 : 0;
        $updated = DB::table('products')
            ->where('id', '=', $id)
            ->update([
                'name'       => $request->input('name'),
                'price'      => $request->input('price'),
                'content'    => $request->input('content'),
                'image_path' => $request->input('image_path'),
                'active'     => $active,
                'updated_at' => \Carbon\Carbon::now()
            ]);

        // go to view edit page
        if ($updated) {
            // get product detail
            $product = DB::table('products')->find($id);

            // --★ Note: method compact ★--
            // I think it will build a variable to render to web page
            // with same name with the defined variable in this method.
            // The same way may be like: "->with('product', $product);".
            return view('frontend.product.edit')
                ->with(compact('product'))
                ->with('message', 'UPDATED PRODUCT SUCCESSFULLY!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // get product detail
            $product = DB::table('products')->find($id);

            // Check product information,
            // if "active" is ready fail, show a warning message to user
            if ($product->active == 0) {
                return view('frontend.product.show')
                    ->with(compact('product'))
                    ->with('dangerMessage', 'THIS PRODUCT HAD BEEN DELETED BEFORE!');
            }

            // update product detail
            $updated = DB::table('products')
                ->where('id', '=', $id)
                ->update([
                    'active'     => 0,
                    'updated_at' => \Carbon\Carbon::now()
                ]);

            // go to view edit page
            if ($updated) {
                // --★ Note: method compact ★--
                // I think it will build a variable to render to web page
                // with same name with the defined variable in this method.
                // The same way may be like: "->with('product', $product);".
                return view('frontend.product.show')
                    ->with(compact('product'))
                    ->with('successMessage', 'DELETED PRODUCT SUCCESSFULLY!');
            }
        } catch (Exception $e) {
            return view('frontend.product.show')->with('dangerMessage', $e->getMessage());
        }
    }
}
