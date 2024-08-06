<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\State;

class StateController extends Controller
{

    public string $model_name = 'State';
    public string $base_route = 'backend.state.';
    public string $base_view_folder = 'backend.state.';

    public State $model;

    public function __construct()
    {
        $this->model = new State();
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
    public function store(StateRequest $request)
    {
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
    public function update(StateRequest $request, string $id)
    {
        $data['record'] = $this->model->find($id);
        if ($data['record'] == null) {
            \request()->session()->flash('error', $this->model_name . ' Not Found');
            return redirect(route($this->base_route . 'index'));
        }

        if ($data['record']->update($request->all())) {
            $request->session()->flash('success', $this->model_name . ' Updated Successfully');
            return redirect(route($this->base_route . 'index'));
        } else {
            $request->session()->flash('error', $this->model_name . ' Update Failed');
            return redirect(route($this->base_route .'edit'));
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
