<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records'] = Category::all();
        return view('backend.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);
        if ($request->hasFile('thumbnail_file')) {
            $thumbnail_file = $request->file('thumbnail_file');
            $filename = time() . '.' . $thumbnail_file->getClientOriginalExtension();
            $thumbnail_file->move(public_path('assets/images/category'), $filename);
            $request->request->add(['thumbnail' => $filename]);
        }
        $record = Category::create($request->all());
        if ($record) {
            $request->session()->flash('success', 'Category Created Successfully');
            return redirect(route('backend.category.index'));
        } else {
            $request->session()->flash('error', 'Category Creation Failed');
            return redirect(route('backend.category.create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['record'] = Category::find($id);
        if ($data['record'] == null) {
//            abort(404);
            \request()->session()->flash('error', 'Category Not Found');
            return redirect(route('backend.category.index'));
        }
        return view('backend.category.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['record'] = Category::find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', 'Category Not Found');
            return redirect(route('backend.category.index'));
        }
        return view('backend.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $data['record'] = Category::find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', 'Category Not Found');
            return redirect(route('backend.category.index'));
        }
        if ($request->hasFile('thumbnail_file')) {
            $thumbnail_file = $request->file('thumbnail_file');
            $filename = time() . '.' . $thumbnail_file->getClientOriginalExtension();
            $thumbnail_file->move(public_path('assets/images/category'), $filename);
            $request->request->add(['thumbnail' => $filename]);
            unlink(public_path('assets/images/category/' . $data['record']->thumbnail));
        }
        $request->request->add(['updated_by' => auth()->user()->id]);

        if ($data['record']->update($request->all())) {
            $request->session()->flash('success', 'Category Updated Successfully');
            return redirect(route('backend.category.index'));
        } else {
            $request->session()->flash('error', 'Category Update Failed');
            return redirect(route('backend.edit.create'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['record'] = Category::find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', 'Category Not Found');
            return redirect(route('backend.category.index'));
        }else{
            if ($data['record']->delete()) {
                \request()->session()->flash('success', 'Category Deleted Successfully');
            }else{
                request()->session()->flash('error', 'Category Deletion Failed');
            }
            return redirect()->route('backend.category.index');
        }
    }
}
