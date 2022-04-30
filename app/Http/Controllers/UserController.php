<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
            $users = DB::table('users')->get();

            // check user's role,
            // if not admin then redirect home page
            if (auth()->user()->name != 1) {
                return redirect('/home');;
            }

            // if user is admin,
            // redirect to list product manager
            return view('frontend.user.listUser')->with(compact('users'));
        } catch (Exception $e) {
            // To save message to session just only once time
            // after request, and this will be automatically cleaned
            // -- Other Way --
            // return view('ViewName')->with('message', $e->getMessage());
            session()->flash('dangerMessage', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Not yet
        return "Create New User Page! (Not Yet)";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Not yet
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
        return "Show User Detail Page! (Not Yet)";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Not yet
        return "Update User Page! (Not Yet)";
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
        // Not yet
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Not yet
        return "Delete User Page! (Not Yet)";
    }
}
