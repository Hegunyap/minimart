<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        echo json_encode($setting);
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
        $setting = Setting::find($id);
        $setting->nama_perusahaan = $request['nama'];
        $setting->alamat = $request['alamat'];
        $setting->telepon = $request['telepon'];
        $setting->tipe_nota = $request['tipe_nota'];

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $nama_gambar = "logo.".$file->getClientOriginalExtension();

            $lokasi = public_path('images');

            $file->move($lokasi, $nama_gambar);

            $setting->logo = $nama_gambar;
        }

        if($request->hasFile('kartu_member')){
            $file = $request->file('kartu_member');
            $nama_gambar = "card.".$file->getClientOriginalExtension();
            $lokasi = public_path('images');

            $file->move($lokasi, $nama_gambar);
            $setting->kartu_member = $nama_gambar;
        }
        $setting->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
