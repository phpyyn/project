<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:admin,edit_permission',['only'=>'update']);
        $this->middleware('ability:admin,delete_permission',['only'=>'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perms = Permission::get();
        return view('auth.permissions.index',compact('perms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $perm = Permission::create([
              'name'=>$request->name,
              'display_name'=>$request->display_name,
              'description'=>$request->description
            ]);

      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $perm = Permission::findOrFail($id);


      $perm->name = $request->name;
      $perm->display_name = $request->display_name;
      $perm->description = $request->description;

      $perm->save();

      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $permission = Permission::findOrFail($id);

        $permission->delete();

        return redirect()->back();
    }
}
