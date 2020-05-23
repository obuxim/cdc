<?php

namespace App\Http\Controllers;

use App\Orderstatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderstatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderstatuses = Orderstatus::all();
        return view('admin.orderstatuses.index')->with('orderstatuses', $orderstatuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orderstatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderstatuses = Orderstatus::all();
        $validator = Validator::make($request->all(), array(
           'title' => 'required|string|max:30'
        ));
        if($validator->fails()){
            return redirect(route('admin.orderstatus.create'))->withErrors($validator)->withInput();
        }
        $orderstatus = new Orderstatus();
        $orderstatus->title = $request->input('title');
        $orderstatus->slug = Str::slug($orderstatus->title, '-');
        if(count($orderstatuses) == 0){
            $orderstatus->isDefault = true;
        }
        $existingOrderstatus = Orderstatus::where('slug', $orderstatus->slug)->find(1);
        if($existingOrderstatus){
            dd($existingOrderstatus);
            $validator->errors()->add('already_exists', 'Order Status already exists!');
            return redirect(route('admin.orderstatus.create'))->withErrors($validator)->withInput();
        }
        try{
            $orderstatus->save();
            return redirect(route('admin.orderstatus.index'))->with('successes', ['Order Status added successfully!']);
        }catch (QueryException $e){
            dd($e);
            $validator->errors()->add('database_issue', 'Order Status could not be saved due to database issue!');
            return redirect(route('admin.orderstatus.create'))->withErrors($validator)->withInput();
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
        $existingOrderstatus = Orderstatus::where('id', $id)->find(1);
        $validator = Validator::make([], []);
        if(!$existingOrderstatus){
            $validator->errors()->add('not_found', 'Order Status does not exists!');
        }
        return view('admin.orderstatuses.edit')->with('orderstatus', $existingOrderstatus);
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
        $validator = Validator::make($request->all(), array(
           'title' => 'required|string|max:30'
        ));
        if($validator->fails()){
            return redirect(route('admin.orderstatus.edit', $id))->withErrors($validator)->withInput();
        }
        $existingOrderstatus = Orderstatus::where('id', $id)->find(1);
        if(!$existingOrderstatus){
            $validator->errors()->add('not_found', 'Order Status does not exists!');
            return redirect(route('admin.orderstatus.edit', $id))->withErrors($validator)->withInput();
        }
        $existingOrderstatus->title = $request->input('title');
        $existingOrderstatus->slug = Str::slug($existingOrderstatus->title, '-');
        try{
            $existingOrderstatus->save();
            return redirect(route('admin.orderstatus.index'))->with('successes', ['Order Status successfully updated!']);
        }catch (QueryException $e){
            $validator->errors()->add('database_issue', 'Order Status could not be saved due to database issue!');
            return redirect(route('admin.orderstatus.edit', $id))->withErrors($validator)->withInput();
        }
    }

    public function makedefault($id)
    {
        $validator = Validator::make([],[]);
        $orderstatus = Orderstatus::findOrFail($id);
        if(!$orderstatus){
            $validator->errors()->add('not_found', 'Order Status you are trying to delete does not exist!');
            return redirect(route('admin.orderstatus.index'))->withErrors($validator);
        }
        $orderstatuses = Orderstatus::all();
        foreach ($orderstatuses as $orderStatus){
            $orderStatus->isDefault = false;
            $orderStatus->save();
        }
        $orderstatus->isDefault = true;
        $orderstatus->save();
        return redirect(route('admin.orderstatus.index'))->with('successes', ["$orderstatus->title made default!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validator = Validator::make([],[]);
        $orderstatus = Orderstatus::where('id', $id)->find(1);
        if(!$orderstatus){
            $validator->errors()->add('not_found', 'Order Status you are trying to delete does not exist!');
            return redirect(route('admin.orderstatus.index'))->withErrors($validator);
        }
        try{
            $orderstatus->delete();
            return redirect(route('admin.orderstatus.index'))->with('successes', ['Order Status successfully deleted!']);
        }catch (QueryException $e){
            $validator->errors()->add('database_issue', 'Could not delete Order Status due to database error!');
            return redirect(route('admin.orderstatus.index'))->withErrors($validator);
        }
    }
}
