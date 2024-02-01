<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    //

    public function index()
    {
        $data = array(
            'title' => 'Setting Diskon',
            'data_diskon' => Diskon::all(),
        );
        return view('admin.master.setdiskon.list', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'total_belanja' => 'required|numeric',
            'diskon' => 'required|numeric',
        ]);

        Diskon::where('id', $id)->update([
            'total_belanja' => $request->total_belanja,
            'diskon' => $request->diskon,
        ]);

        return redirect('/setdiskon')->with('success', 'Diskon updated successfully');
    }
}
