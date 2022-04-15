<?php

namespace App\Http\Controllers;

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
        // check user's role,
        // if not admin then redirect home page
        if (auth()->user()->name != 1) {
            return view('home');
        }

        // if user is admin,
        // redirect to list product manager
        $products = DB::table('products')->get();
        return view('frontend.product.list')->with('products', $products);
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
        if ($validator->fails()) {
            return redirect('product/create')
                ->withErrors($validator)
                ->withInput();
        } else {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Not yet
        return ('PLEASE TRY AGAIN LATER!');
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
        if ($validator->fails()) {
            return redirect('product/create')
                ->withErrors($validator)
                ->withInput();
        } else {
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

                return view('frontend.product.edit')
                    ->with(compact('product'))
                    ->with('message', 'UPDATED PRODUCT SUCCESSFULLY!');
            }
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
        //
    }
}
