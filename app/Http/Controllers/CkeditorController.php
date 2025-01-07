<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('upload')->move(public_path('uploads'), $fileName);
                $url = asset('public/uploads/' . $fileName);

                return response()->json(['fileName' => $fileName, 'uploaded' => true, 'url' => $url]);
            }

            return response()->json(['uploaded' => false], 400);
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Upload Blog Image', 'error' => $e->getMessage()]);
        }
    }
}
