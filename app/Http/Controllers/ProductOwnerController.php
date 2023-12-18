<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOwner;
use App\Models\User;

class ProductOwnerController extends Controller
{
    public function index()
    {
        $productOwners = ProductOwner::with('user')->get();
        return response()->json(['productOwners' => $productOwners], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:product_owners,user_id',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $productOwner = new ProductOwner();
        $productOwner->user()->associate($user);
        $productOwner->save();

        return response()->json(['productOwner' => $productOwner, 'message' => 'Product Owner Created Successfully!'], 201);
    }

    public function show($id)
    {
        $productOwner = ProductOwner::with('user')->find($id);

        if (!$productOwner) {
            return response()->json(['message' => 'Product Owner not found'], 404);
        }

        return response()->json(['productOwner' => $productOwner], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:product_owners,user_id,' . $id,
        ]);

        $productOwner = ProductOwner::find($id);

        if (!$productOwner) {
            return response()->json(['message' => 'Product Owner not found'], 404);
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $productOwner->user()->associate($user);
        $productOwner->save();

        return response()->json(['message' => 'Product Owner Updated Successfully!'], 200);
    }

    public function destroy($id)
    {
        $productOwner = ProductOwner::find($id);

        if (!$productOwner) {
            return response()->json(['message' => 'Product Owner not found'], 404);
        }

        $productOwner->delete();

        return response()->json(['message' => 'Product Owner Deleted Successfully!'], 200);
    }
}
