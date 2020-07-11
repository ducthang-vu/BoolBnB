<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Flat;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.flats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validateRules());
        $data = $request->all();

        // get lat long
        $latlong = explode(',', $request->input('latlong'));
    
        // set image
        $data['image'] = Storage::put('images', $data['image']);

        $new_flat = new Flat();
        $new_flat->user_id = Auth::id();
        $new_flat->fill($data);
        $new_flat->lat = $latlong[0];
        $new_flat->lng = $latlong[1];
        
        $saved = $new_flat->save();

        if ($saved) {
            if (!empty($data['services'])) {
                $new_flat->services()->attach($data['services']);
            }

            return redirect()->route('home')->with('saved-flat', $new_flat->title);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        return view('admin.flats.show', compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        if (empty($flat)){
            abort('404');
        }

        $id = $flat->id;

        $flat->sponsorships()->detach();
        $flat->services()->detach();
        // $flat->request()->

        $deleted = $flat->delete();

        if($deleted) {
            return redirect()->route('admin.home')->with('flat-deleted', $id);
        }
    }

    /**
     * Validation rules
     */
    private function validateRules()
    {
        return [
            'title' => 'required|min:1|max:255',
            'description' => 'required|min:1|max:500',
            'number_of_rooms' => 'required|min:1|max:10',
            'number_of_beds' => 'required|min:1|max:30',
            'number_of_bathrooms' => 'required|min:1|max:10',
            'square_meters' => 'required|min:1|max:999',
            'image' => 'image',
            'services.*' => 'exists:services,id'
        ];
    }
}
