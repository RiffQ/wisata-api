<?php

namespace App\Http\Controllers;

use App\Models\Place;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::with('gallery')->get();

        return response()->json([
            'data' => $places
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
        $place = new Place();

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'desc' => 'required',
            'open_day' => 'required',
            'open_time' => 'required',
            'ticket_price' => 'required',
        ]);

        $file = $request->file('image');
        if($file != null){
            $string = rand(25,5033);
            $host = $request->getSchemeAndHttpHost();
            $filename = $string . '_' . $file->getClientOriginalName();
            $path = 'images';
            $file->move($path, $filename);
            $place->img = $host . '/'. $path . '/' . $filename;
        }

        $place->name = $request->name;
        $place->location = $request->location;
        $place->desc = $request->desc;
        $place->open_day = $request->open_day;
        $place->open_time = $request->open_time;
        $place->ticket_price = $request->ticket_price;
        $place->save();

        return response()->json([
            'message' => 'Image Create Successfully',
            'data' => $place
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
        $place = Place::where('id', $id)->first();
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
        $place = Place::find($id);

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'desc' => 'required',
            'open_day' => 'required',
            'open_time' => 'required',
            'ticket_price' => 'required',
        ]);

        $place->name = $request->name;
        $place->location = $request->location;
        $place->desc = $request->desc;
        $place->open_day = $request->open_day;
        $place->open_time = $request->open_time;
        $place->ticket_price = $request->ticket_price;

        $file = $request->file('image');
        if($file != null){
            $string = rand(25,5033);
            $host = $request->getSchemeAndHttpHost();
            $filename = $string . '_' . $file->getClientOriginalName();
            $path = 'images';
            $file->move($path, $filename);
            $place->img = $host . '/'. $path . '/' . $filename;
        }

        $place->save();

        return response()->json([
            'message' => 'Place Update Successfully',
            'data' => $place
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
        $place = Place::find($id);
        $place->delete();

        return response()->json([
            'message' => 'Place Delete Successfully',
            'data' => $place
        ], 200);
    }
}
