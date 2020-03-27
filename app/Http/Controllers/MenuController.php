<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Menu;

class MenuController extends Controller
{
    /**
     * Display the list of Menu resources for a given Restaurant

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            if ($restaurant = Restaurant::find($id)) {
               $menus = $restaurant->menus;
               return response()->json($menus, 200);
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
     * Create a Menu resource for a given Restaurant.

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
    	try {
            if ($restaurant = Restaurant::find($id)) {
            	$result = $request->validate([
	                'name' => 'required',
	                'description' => 'required',
	                'price' => 'required',
            	]);
            	if (isset($result->errors)) {
                	return response()->json($result, 400);
            	}
               $menu = $restaurant->menus()->create($request->all());
               return response()->json($menu, 201);
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
     * Update a Menu resource for a given Restaurant.

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $restaurant_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $restaurant_id, $id)
    {
        try {
        	$menu = Menu::where('id', $id)->where('restaurant_id', $restaurant_id)->first();
        	if ($menu == null) {
        		return response()->json(['error'=>'Bad request'], 400);
        	}
        	$result = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required'
            ]);
            if (isset($result->errors)) {
                return response()->json($result, 400);
            }
        	$menu->update($request->all());
        	return response()->json(['message'=>'Menu successfully updated'], 200);
        }
        catch (Exception $e) {
            return response()->json(['error'=>'Internal Server Error'], 500);
        }
    }
    /**
     * Delete a Menu resource for a given Restaurant.

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $restaurant_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($restaurant_id, $id)
    {
        try {
        	$menu = Menu::where('id', $id)->where('restaurant_id', $restaurant_id)->first();
        	if ($menu == null) {
        		return response()->json(['error'=>'Bad request'], 400);
        	}
        	$menu->delete();
        	return response()->json(['message'=>'Menu successfully deleted'], 200);
        }
        catch (Exception $e) {
            return response()->json(['error'=>'Internal Server Error'], 500);
        }
    }
}
