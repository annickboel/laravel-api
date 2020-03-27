<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display the list of Restaurant resources
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            $restaurants = Restaurant::all();
            return response($restaurants, 200);
        }
        catch (Exception $e) {
            return response()->json(['error'=>'Internal Server Error'], 500);
        }

    }
    /**
     * Create a Restaurant resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $result = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'grade' => 'required',
                'localization' => 'required',
                'phone_number' => 'required',
                'website' => 'required',
                'hours' => 'required'
            ]);
            if (isset($result->errors)) {
                return response()->json($result, 400);
            }
            $restaurant = Restaurant::create($request->all());
            return response()->json($restaurant, 201);
        }
        catch (Exception $e) {
            return response()->json(['error'=>'Internal Server Error'], 500);
        }
       
    }
    /**
     *  Update a Restaurant resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $result = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'grade' => 'required',
                'localization' => 'required',
                'phone_number' => 'required',
                'website' => 'required',
                'hours' => 'required'
            ]);
            if (isset($result->errors)) {
                return response()->json($result, 400);
            }
            if ($restaurant = Restaurant::find($id)) {
                $restaurant->update($request->all());
                return response()->json($restaurant, 200);
            }
            else {
                return response()->json(['error'=>'Bad request'], 400);
            }
        }
        catch (Exception $e) {
            return response()->json(['error'=>'Internal Server Error'], 500);
        }
    }
    /**
     * Delete a Restaurant resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($restaurant = Restaurant::find($id)) {
                $restaurant->delete();
                return response()->json(['message'=>'Restaurant successfully delete'], 200);
            }
            else {
                return response()->json(['error'=>'Bad Request'], 400);
            } 
        }
        catch (Exception $e) {
            return response()->json(['error'=>'Internal Server Error'], 500);
        }
    }
}
