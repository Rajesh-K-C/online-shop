<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records'] = Setting::all();
        return view('backend.setting.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSettingRequest $request)
    {
        $request->request->add(['created_by' => Auth::user()->id]);
        $record = Setting::create($request->all());
        if ($record) {
            $request->session()->flash('success', 'Setting Created Successfully');
            return redirect(route('backend.setting.index'));
        } else {
            $request->session()->flash('error', 'Setting Creation Failed');
            return redirect(route('backend.setting.create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
