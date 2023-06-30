<?php

namespace App\Http\Controllers;

use App\Models\sampah;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sampah = sampah::all();

        if($sampah)
        {
            return ApiFormatter::createApi(200, 'success', $sampah);
        } else {
            return ApiFormatter::createApi(400, 'Failed');

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function token()
    {
        return csrf_token();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'kepala_keluarga' => 'required',
                'no_rumah' => 'required',
                'rt_rw' => 'required',
                'total_karung_sampah' => 'required',
                'tanggal_pengangkutan' => 'required',

            ]);

            $sampah = sampah::create([
                'kepala_keluarga' => $request->kepala_keluarga,
                'no_rumah' => $request->no_rumah,
                'rt_rw' => $request->rt_rw,
                'total_karung_sampah' => $request->total_karung_sampah,
                'kriteria' => $request->total_karung_sampah > 3 ? 'collapse' : 'standar',
                'tanggal_pengangkutan' => $request->tanggal_pengangkutan,

            ]);

            $saved = sampah::where('id', $sampah->id)->first();

            if($saved)
            {
                return ApiFormatter::createApi(200, 'Berhasil Menambahkan Data!', $saved);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
    
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(sampah $sampah, $id)
    {
        try{
            $show = sampah::where('id', $id)->first();

            if($show)
            {
                return ApiFormatter::createApi(200, 'success', $show);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
    
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sampah $sampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sampah $sampah, $id)
    {
        try {
            $request->validate([
                'kepala_keluarga' => 'required',
                'no_rumah' => 'required',
                'rt_rw' => 'required',
                'total_karung_sampah' => 'required',
                'tanggal_pengangkutan' => 'required',

            ]);

            $sampah = sampah::findOrFail($id);

            $sampah->update([
                'kepala_keluarga' => $request->kepala_keluarga,
                'no_rumah' => $request->no_rumah,
                'rt_rw' => $request->rt_rw,
                'total_karung_sampah' => $request->total_karung_sampah,
                'kriteria' => $request->total_karung_sampah > 3 ? 'collapse' : 'standar',
                'tanggal_pengangkutan' => $request->tanggal_pengangkutan,

            ]);

            $update = sampah::where('id', $sampah->id)->first();

            if($update)
            {
                return ApiFormatter::createApi(200, 'data diupdate!', $update);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
    
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sampah $sampah, $id)
    {
        try{
            $delete = sampah::where('id', $id);
            $sampah = $delete->delete();

            if($sampah)
            {
                return ApiFormatter::createApi(200, 'Berhasil Menghapus Data!', $sampah);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
    
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);

        }
    }

    public function trash()
    {
        try{
           $trash = sampah::onlyTrashed()->get();

            if($trash)
            {
                return ApiFormatter::createApi(200, 'success', $trash);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
    
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);

        }
    }

    public function restore($id)
    {
        try{
            $trash = sampah::onlyTrashed()->where('id', $id);
            $restore = $trash->restore(); 
        
            if($restore)
            {
                return ApiFormatter::createApi(200, 'Data dikembalikan!', $restore);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
    
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error);

        }
    }

    public function deletePermanent($id)
        {
            try{
                $trash = sampah::onlyTrashed()->where('id', $id);
                $permanent = $trash->forceDelete(); 
            
                if($permanent)
                {
                    return ApiFormatter::createApi(200, 'Data dihapus Secara Permanent!', $permanent);
                } else {
                    return ApiFormatter::createApi(400, 'Failed');
        
                }
            } catch (Exception $error) {
                return ApiFormatter::createApi(400, 'failed', $error);
    
            } 
        }
}
