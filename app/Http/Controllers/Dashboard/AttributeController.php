<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\AttributeService;
use App\Http\Requests\Dashboard\AttributeRequest;

class AttributeController extends Controller
{
    protected $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }
    public function index()
    {
        return view('dashboard.products.attributes.index');
    }

    public function getAllAttributes() {
        return $this->attributeService->getAttributesForDataTable();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->only(['name', 'value']);
        $attribute = $this->attributeService->createAttribute($data);

        if(!$attribute) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 500);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, string $id)
    {
        $data = $request->only(['name', 'value']);
        $attribute = $this->attributeService->updateAttribute($id, $data);
        if(!$attribute) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 500);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = $this->attributeService->deleteAttribute($id);
        if (!$attribute) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }
}