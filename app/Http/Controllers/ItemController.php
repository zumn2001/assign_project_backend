<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('category')->paginate(10);
        $paginationData = [
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'per_page' => $items->perPage(),
            'total' => $items->total(),
        ];
        return $this->response('all items' ,['items' => ItemResource::collection($items) , 'pagination' => $paginationData] );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $item = Item::create($data);
        return $this->response( 'Created',new ItemResource($item));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::where('id', $id)->first();
        if (!$item) {
            return $this->error( "item not found",[]);
        }
        return $this->response('Details of item',new ItemResource($item));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request,string $id)
    {
        $item = Item::where('id', $id)->first();
        if (!$item) {
            return $this->error( "item not found",[]);
        }
        $data = $request->validated();
        $item->update($data);
        return $this->response('updated',new ItemResource($item));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::where('id', $id)->first();

        if (!$item) {
            return $this->error("item not found",[]);
        }
        $item->delete();
        return response()->json([
            'condition'=> true,
            'message' => "Delete!",
        ],200);

    }
}
