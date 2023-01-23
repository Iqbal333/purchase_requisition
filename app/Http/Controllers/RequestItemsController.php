<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Item;
use App\Models\RequestItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:request_items-list|request_items-create|request_items-edit|request_items-delete', ['only' => ['index','show']]);
        $this->middleware('permission:request_items-create', ['only' => ['create','store']]);
        $this->middleware('permission:request_items-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:request_items-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::id();
        $request_items = RequestItem::where('user_id', '=', $user)->latest()->get();

        return view('request_items.index', compact('request_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request_items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //'price' => (float) str_replace('.', '', $request->price),
        $this->validate($request, [
            'user_id' => 'required',
            'division_id' => 'required',
            'request_no' => 'required|min:5|max:20|unique:requests,request_no',
            'description' => 'required',

            'item' => 'required|array',
            'item.*' => 'required|string|max:50',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|numeric',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric',
            'total' => 'required|array',
            'total.*' => 'required|numeric',
            'remark' => 'required|array',
            'remark.*' => 'nullable|string|min:5|max:50',
        ]);

        DB::beginTransaction();

        try {
            $request_items = new RequestItem;

            $request_items->user_id = $request->user_id;
            $request_items->division_id = $request->division_id;
            $request_items->request_no = $request->request_no;
            $request_items->description = $request->description;
            $request_items->status = $request->status;

            $request_items->save();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/request_items')->withInput()->with('error-msg', 'Gagal Simpan Permintaan Barang');
        }

        try {
            foreach ($request->item as $key => $val) {
                $items[] = [
                    'request_item_id' => $request_items->id,
                    'item' => $request->item[$key],
                    'qty' => $request->qty[$key],
                    'unit_price' => $request->unit_price[$key],
                    'total' => $request->total[$key],
                    'remark' => $request->remark[$key],
                ];
            }


            // Penjelasan items() adalah relasi

            $request_items->items()->insert($items);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/request_items')->withInput()->with('error-msg', 'Gagal Simpan Item');
        }

        DB::commit();

        return redirect('/request_items')->with('success-msg', 'Berhasil mengajukan permintaan barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $divisions = Division::get();
        $request_items = RequestItem::with('items')->findOrFail($id);

        return view('request_items.show', compact('divisions', 'request_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisions = Division::get();
        $request_items = RequestItem::with('items')->findOrFail($id);

        return view('request_items.edit', compact('divisions', 'request_items'));
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
        $request_items = RequestItem::findOrFail($id);

        $this->validate($request, [
            'request_no' => 'required|min:5|max:20',
            'user_id' => 'required',
            'division_id' => 'required',
            'description' => 'required',

            'item' => 'required|array',
            'item.*' => 'required|string|max:50',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|numeric',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric',
            'total' => 'required|array',
            'total.*' => 'required|numeric',
            'remark' => 'required|array',
            'remark.*' => 'nullable|string|min:5|max:50',
        ]);

        DB::beginTransaction();

        try {

            $request_items->user_id = $request->user_id;
            $request_items->division_id = $request->division_id;
            $request_items->request_no = $request->request_no;
            $request_items->description = $request->description;
            $request_items->status = $request->status;

            $request_items->update();
        } catch (\Exception $e) {
            DB::rollback();
            // dd($request_items);
            return redirect('/request_items')->withInput()->with('error-msg', 'Gagal Update Request Items');
        }

        try {
            foreach ($request->item as $key => $val) {
                $items[] = [
                    'request_item_id' => $request_items->id,
                    'item' => $request->item[$key],
                    'qty' => $request->qty[$key],
                    'unit_price' => $request->unit_price[$key],
                    'total' => $request->total[$key],
                    'remark' => $request->remark[$key],
                ];
            }

            // Penjelasan items() adalah relasi

            $request_items->items()->delete();
            $request_items->items()->insert($items);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/request_items')->withInput()->with('error-msg', 'Gagal Update Item');
        }

        DB::commit();

        return redirect('/request_items')->with('success-msg', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::get();
        $request_items = RequestItem::findOrFail($id);
        $request_items->delete([$request_items, $item]);

        return redirect('/request_items')->with('success-msg', 'Berhasil menghapus data permintaan barang');
    }
}
