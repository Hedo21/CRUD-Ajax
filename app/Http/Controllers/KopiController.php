<?php

namespace App\Http\Controllers;

use App\Models\kopi;
use Illuminate\Http\Request;
use yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class KopiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kopi');
    }

    public function yajra()
    {
        $kopis = kopi::select(['id', 'jenis_kopi', 'jumlah', 'asal', 'owner'])->with(['kopi_owner']);
        return DataTables::of($kopis)
            ->addColumn('action', function ($data) {
                $button = '<a href="javascript:void(0)" id="btn-update" data-id="' . $data->id . '" class="btn btn-success">Update</a>';
                $button .= '<a href="javascript:void(0)" id="btn-delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</a>';
                return $button;
            })->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_kopi' => 'required',
            'jumlah' => 'required',
            'asal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $tambah = kopi::updateOrCreate([
                'jenis_kopi' => $request->jenis_kopi,
                'jumlah' => $request->jumlah,
                'asal' => $request->asal,
            ]);
            if ($tambah) {
                return response()->json([
                    'success' => true,
                    'kopis' => $tambah,
                    'message' => 'Berhasil Ditambah!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Ditambah!',
                ], 401);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kopi  $kopi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kopi = kopi::find($id);
        return response()->json([
            'success' => true,
            'message' => 'detail data',
            'data' => $kopi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kopi  $kopi
     * @return \Illuminate\Http\Response
     */
    public function edit(kopi $kopi)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kopi  $kopi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_kopi' => 'required',
            'jumlah' => 'required',
            'asal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $kopi = kopi::find($id);
            $kopi->update([
                'jenis_kopi' => $request->jenis_kopi,
                'jumlah' => $request->jumlah,
                'asal' => $request->asal,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate',
                'data' => $kopi,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kopi  $kopi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kopi::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Dihapus',
        ]);
    }
}
