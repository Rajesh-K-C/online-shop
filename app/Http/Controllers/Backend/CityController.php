<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public string $model_name = 'City';
    public string $base_route = 'backend.city.';
    public string $base_view_folder = 'backend.city.';

    public City $model;

    public function __construct()
    {
        $this->model = new City();
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
        $data['records'] = District::all();
        return view($this->base_view_folder . 'create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);
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
        $data['districts'] = District::all();
        return view($this->base_view_folder . 'edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }
        $request->request->add(['updated_by' => Auth::user()->id]);
        if ($data['record']->update($request->all())) {
            $request->session()->flash('success', $this->model_name . ' Updated Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
            return redirect(route($this->base_route . 'edit'));
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
}
