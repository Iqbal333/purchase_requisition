<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:division-list|division-create|division-edit|division-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:division-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:division-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:division-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Division::latest()->paginate(5);

        return view('division.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('division.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'division_name' => 'required|unique:divisions,division_name',
        ]);

        $division = new Division;
        $division->division_name = $request->division_name;

        $division->save();

        return redirect('division')->with('success', 'Berhasil tambah nama divisi');
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
        $division = Division::findOrFail($id);

        return view('division.edit', compact('division'));
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
        $division = Division::findOrFail($id);

        $request->validate([
            'division_name' => [
                'required',
                Rule::unique('companies', 'division_name')->ignore($division->id)
            ],
            'type' => 'required|in:AKAP,AKDP'
        ]);

        $division->division_name = $request->division_name;

        $division->update();

        return redirect('division')->with('success', 'Berhasil mengubah nama divisi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisi = Division::findOrFail($id);

        $divisi->delete();

        return redirect('division')->with('success', 'Berhasil menghapus nama divisi');
    }
}
