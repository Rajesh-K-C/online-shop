<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public string $model_name = 'Category';
    public string $base_route = 'backend.category.';
    public string $base_view_folder = 'backend.category.';
    public string $base_image_folder = 'assets/images/category';

    public Category $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records'] = $this->model->all();
        return view($this->base_view_folder . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->base_view_folder . 'create');
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
            $thumbnail_file->move($this->base_image_folder, $filename);
            $request->request->add(['thumbnail' => $filename]);
        }
        $record = $this->model->create($request->all());
        if ($record) {
            $request->session()->flash('success', $this->model_name . ' Created Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Creation Failed');
            return redirect(route($this->base_route . 'create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
//            abort(404);
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        return view($this->base_view_folder . 'show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        return view($this->base_view_folder . 'edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        if ($request->hasFile('thumbnail_file')) {
            $thumbnail_file = $request->file('thumbnail_file');
            $filename = time() . '.' . $thumbnail_file->getClientOriginalExtension();
            $thumbnail_file->move(public_path($this->base_image_folder), $filename);
            $request->request->add(['thumbnail' => $filename]);
            unlink(public_path($this->base_image_folder . '/' . $data['record']->thumbnail));
        }
        $request->request->add(['updated_by' => auth()->user()->id]);

        if ($data['record']->update($request->all())) {
            $request->session()->flash('success', $this->model_name . ' Updated Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
            return redirect(route('backend.edit.create'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        } else {
            if ($data['record']->delete()) {
                \request()->session()->flash('success', $this->model_name . ' Deleted Successfully');
            } else {
                request()->session()->flash('error', $this->model_name . ' Deletion Failed');
            }
            return redirect()->route($this->base_route . 'index');
        }
    }

    public function trash()
    {
        $data['records'] = $this->model->onlyTrashed()->get();
        return view($this->base_view_folder . 'trash', compact('data'));
    }

    public function restore($id)
    {
//        $data['record'] = $this->>$this->model->onlyTrashed()->find($id);
        $data['record'] = $this->model->where('id', $id)->onlyTrashed()->first();
        if ($data['record']->restore()) {
            \request()->session()->flash('success', $this->model_name . ' Restored Successfully');
        } else {
            \request()->session()->flash('error', $this->model_name . ' Restore Failed');
        }
        return redirect()->route($this->base_route . 'trash');
    }

    public function remove($id)
    {
        $data['record'] = $this->model->where('id', $id)->onlyTrashed()->first();
        if ($data['record']->forceDelete()) {
            \request()->session()->flash('success', $this->model_name . ' Deleted Successfully');
            if ($data['record']->thumbnail && file_exists($this->base_image_folder . '/' . $data['record']->thumbnail)) {
                unlink(public_path($this->base_image_folder . '/' . $data['record']->thumbnail));
            }
        } else {
            \request()->session()->flash('error', $this->model_name . ' Deletion Failed');
        }

        return redirect()->route($this->base_route . 'trash');
    }
}
