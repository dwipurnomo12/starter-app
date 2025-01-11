<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit info app', ['only' => ['index']]);
    }

    public function index()
    {
        $application = Website::first();
        return view('aplikasi.index', [
            'application'   => $application
        ]);
    }

    public function update(Request $request, $id)
    {
        $application = Website::find($id);
        $validator = Validator::make($request->all(), [
            'website_name'      => 'required',
            'website_logo'      => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'meta_description'  => 'required'
        ], [
            'website_name.required'     => 'Form wajib diisi!',
            'website_logo.mimes'        => 'Format gambar tidak benar. Gunakan format png,jpg,jpeg,webp!',
            'website_logo.max'          => 'Size gambar melebihi batas. Maksimal 2mb!',
            'meta_description.required' => 'Form wajib diisi!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('website_logo')) {
            $path           = 'website-logo/';
            $file           = $request->file('website_logo');
            $extension      = $file->getClientOriginalExtension();
            $fileName       = uniqid() . '.' . $extension;
            $website_logo   = $file->storeAs($path, $fileName, 'public');

            if ($application->website_logo) {
                Storage::disk('public')->delete($application->website_logo);
            }
        } else {
            $website_logo   = $application->website_logo;
        }

        $application->update([
            'website_name'      => $request->website_name,
            'website_logo'      => $website_logo,
            'meta_description'  => $request->meta_description
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}
