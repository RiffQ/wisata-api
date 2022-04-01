<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeries = Galery::find();

        return response()->json([
            'data' => $galeries
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $galery = new Galery();

        $request->validate([
            'image' => 'required',
            'place_id' => 'required',
        ]);

        $file = $request->file('image');
        $string = rand(25, 5033);
        $host = $request->getSchemeAndHttpHost();
        $filename = $string . '_' . $file->getClientOriginalName();
        $path = 'images';
        $file->move($path, $filename);
        $galery->img = $host . '/' . $path . '/' . $filename;
        $galery->save();

        return response()->json([
            'message' => 'Successfull created galery',
            'data' => $galery
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $galery = Galery::find($id);

        return response()->json([
            'data' => $galery
        ], 200);
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
        $galery = Galery::find($id);

        $request->validate([
            'image' => 'required',
            'place_id' => 'required',
        ]);

        $file = $request->file('image');
        $string = rand(25, 5033);
        $host = $request->getSchemeAndHttpHost();
        $filename = $string . '_' . $file->getClientOriginalName();
        $path = 'images';
        $file->move($path, $filename);
        $galery->img = $host . '/' . $path . '/' . $filename;
        $galery->save();

        return response()->json([
            'message' => 'Successfull update galery',
            'data' => $galery
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galery = Galery::find($id);
        $galery->delete();

        return response()->json([
            'message' => 'Delete Success'
        ], 200);
    }
}
