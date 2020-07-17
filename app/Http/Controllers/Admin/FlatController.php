<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Flat;
use App\Service;

class FlatController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.flats.create', compact('services'));
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
        $latlong = explode(',', $request->latlong);
        $new_flat = new Flat();
        $new_flat->user_id = Auth::id();
        $new_flat->lat = $latlong[0];
        $new_flat->lng = $latlong[1];
        $data['image'] = Storage::disk('public')->put('images', $data['image']);
        $new_flat->image = $data['image'];

        $new_flat->fill($data);
        $saved = $new_flat->save();

        if ($saved) {
            if (!empty($data['services'])) {
                $new_flat->services()->attach($data['services']);
            }
            return redirect()->route('admin.home')->with('flat-saved', $new_flat->title);
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
    public function edit(Flat $flat)
    {
        $services = Service::all();

        return view('admin.flats.edit', compact('flat', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        $request->validate($this->validateRules());

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // get lat long
        $latlong = explode(',', $request->input('latlong'));
        $flat->lat = $latlong[0];
        $flat->lng = $latlong[1];

        // set immagine
        // delete vecchia immagine
        if (!empty($flat->image)) {
            Storage::disk('public')->delete($flat->image);
        }
        // store nuova immagine
        $data['image'] = Storage::disk('public')->put('images', $data['image']);
        $flat->image = $data['image'];

        $updated = $flat->update($data);

        if ($updated) {
            if (!empty($data['services'])) {
                $flat->services()->sync($data['services']);
            } else {
                $flat->services()->detach();
            }

            return redirect()->route('admin.flats.show', $flat->id)->with('flat-updated', $flat->title);
        }
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

        $deleted = $flat->delete();

        if($deleted) {
            Storage::disk('public')->delete($flat->image);

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
            'image' => 'required|image',
            'services.*' => 'exists:services,id'
        ];
    }
}
