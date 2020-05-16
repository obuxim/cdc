<?php

namespace App\Http\Controllers;

use App\Category;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('categories')->get();
        return view('admin.services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.services.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'name' => 'required|max:30',
            'code' => 'required|max:30',
            'category.*' => 'required',
            'regularPrice' => 'required|integer',
            'urgentPrice' => 'required|integer',
            'regularDeliveryTime' => 'required|integer',
            'urgentDeliveryTime' => 'required|integer',
        ));
        if($validator->fails()){
            return redirect((route('admin.service.create')))->withErrors($validator)->withInput();
        }
        try{
            $service = new Service();
            $service->name = $request->input('name');
            $service->code = $request->input('code');
            $service->slug = Str::slug($service->name, '-');
            $service->regularPrice = $request->input('regularPrice');
            $service->urgentPrice = $request->input('urgentPrice');
            $service->regularDeliveryTime = $request->input('regularDeliveryTime');
            $service->urgentDeliveryTime = $request->input('urgentDeliveryTime');
            $service->itemNote = $request->input('description');
            $service->save();
            $categoryIds = $request->input('category');
            $categories = Category::find($categoryIds);
            $service->categories()->attach($categoryIds);

            return redirect(route('admin.service.index'))->with('successes', ['New Service Created!']);
        } catch (InternalErrorException $e){
            $validator->errors()->add('could_not_save', 'Could not create new Service!');
            return redirect((route('admin.service.create')))->withErrors($validator)->withInput();
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
        $service = Service::findOrFail($id);
        return view('admin.services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all();
        return view('admin.services.edit')->with(['service' => $service, 'categories' => $categories]);
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
            'name' => 'required|max:30',
            'code' => 'required|max:30',
            'category.*' => 'required',
            'regularPrice' => 'required|integer',
            'urgentPrice' => 'required|integer',
            'regularDeliveryTime' => 'required|integer',
            'urgentDeliveryTime' => 'required|integer',
        ));
        if($validator->fails()){
            return redirect((route('admin.service.edit', $id)))->withErrors($validator)->withInput();
        }
        try{
            $service = Service::findOrFail($id);
            $service->name = $request->input('name');
            $service->code = $request->input('code');
            $service->slug = Str::slug($service->name, '-');
            $service->regularPrice = $request->input('regularPrice');
            $service->urgentPrice = $request->input('urgentPrice');
            $service->regularDeliveryTime = $request->input('regularDeliveryTime');
            $service->urgentDeliveryTime = $request->input('urgentDeliveryTime');
            $service->itemNote = $request->input('description');
            $service->save();
            $categoryIds = $request->input('category');
            $categories = Category::find($categoryIds);
            $service->categories()->attach($categoryIds);

            return redirect(route('admin.service.show', $id))->with('successes', ['Successfully edited!']);
        } catch (InternalErrorException $e){
            $validator->errors()->add('could_not_save', 'Could not create new Service!');
            return redirect((route('admin.service.edit', $id)))->withErrors($validator)->withInput();
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
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect(route('admin.service.index'))->with('successes', ['Successfully deleted!']);
    }
}
