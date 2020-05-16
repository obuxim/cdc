<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Exception\UnsupportedOperationException;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
           'title' => 'required|max:30'
        ]);
        $validation = Validator::make($request->all(),array(
           'title' => 'required|max:30',
        ));

        $category = new Category();
        $category->title = $request->input('title');
        $category->slug = Str::slug($request->input('title'), '-');
        $duplicateCategory = Category::where('slug', $category->slug)->first();
        if($duplicateCategory != null){
            $validation -> errors() -> add('duplicate_entry', 'Category already exists!');
            return redirect(route('admin.category.create'))->withErrors($validation)->withInput();
        }
        try{
            $category->save();
            return redirect(route('admin.category.index'))->with('successes', array('New category added!'));
        } catch (QueryException $e) {
            $validation->errors()->add('could_not_save', 'Could not save to database!');
            return redirect(route('admin.category.create'))->withErrors($validation)->withInput();
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
        try{
            $category = Category::findOrFail($id);
            return view('admin.categories.edit')->with('category', $category);
        }catch(QueryException $e){
            $validation = Validator::make([],[]);
            $validation->errors()->add('could_not_edit', 'Could not find the service to edit in database!');
            return redirect()->route('admin.category.index')->withErrors($validation)->withInput();
        }
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
        $validation = Validator::make($request->all(), array(
           'title' => 'required|max:30'
        ));
        if($validation->fails()){
            return back()->withInput();
        }
        try{
            $category = Category::findOrFail($id);
            $category->title = $request->input('title');
            $category->slug = Str::slug($request->input('title'),'-');
            $category->save();
            return redirect()->route('admin.category.index')->with('successes', ['Successfully updated!']);
        } catch (QueryException $e){
            $validation->errors()->add('could_not_find', 'Service is not in the database anymore!');
            return redirect()->route('admin.category.index')->withErrors($validation)->withInput();
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
        $validation = Validator::make([], []);
        try{
            $category = Category::findOrFail($id);
            try{
                $category->delete();
                return redirect(route('admin.category.index'))->with('success', 'Successfully deleted!');
            } catch (UnsupportedOperationException $e){
                $validation->errors()->add('not_deleted', 'Could not delete!');
                return redirect(route('admin.category.index'))->withErrors($validation);
            }
        } catch (ModelNotFoundException $e) {
            dd(get_class_methods($e));
            dd($e);
        }
    }
}
