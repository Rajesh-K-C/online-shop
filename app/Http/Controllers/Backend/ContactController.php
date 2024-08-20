<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public string $model_name = 'Contact';
    public string $base_route = 'backend.contact.';
    public string $base_view_folder = 'backend.contact.';

    public Contact $model;

    public function __construct()
    {
        $this->model = new Contact();
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
