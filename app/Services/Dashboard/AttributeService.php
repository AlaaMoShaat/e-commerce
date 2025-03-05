<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\AttributeRepository;
use App\Repositories\Dashboard\AttributeValueRepository;

class AttributeService
{
    protected $attributeRepository;
    protected $attributeValueRepository;
    public function __construct(AttributeRepository $attributeRepository, AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function getAttribute($id) {
        return $this->attributeRepository->getAttribute($id) ?? abort(404, 'Attribute not found');
    }

    public function getAttributes() {
        return $this->attributeRepository->getAllAttributes();
    }

    public function getAttributesForDataTable () {
        $attributes = $this->attributeRepository->getAllAttributes();
        return DataTables::of($attributes)->addIndexColumn()
        ->addColumn('name', function($attribute){
            return $attribute->getTranslation('name', app()->getLocale());
        })
        ->addColumn('attributeValues', function($attribute) {
            return view('dashboard.products.attributes.datatables.attribute-values', compact('attribute'));
        })
        ->addColumn('actions', function ($attribute) {
            return view('dashboard.products.attributes.datatables.actions', compact('attribute'));
        })->make(true);
    }

    public function createAttribute($data) {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->createAttribute($data);
            foreach ($data['value'] as $value) {
               $this->attributeValueRepository->createAttributeValue($attribute, $value);
            }
            DB::commit();
            return $attribute;
        }catch(\Exception $e) {
            DB::rollBack();
            throw $e;
            Log::error("error attributes product", $e->getMessage());
            return false;
         }
    }

    public function updateAttribute($id, $data) {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->getAttribute($id);
            $this->attributeRepository->updateAttribute($attribute, $data);
            $this->attributeValueRepository->deleteAttributeValues($attribute);
            foreach ($data['value'] as $value) {
               $this->attributeValueRepository->createAttributeValue($attribute, $value);
            }
            DB::commit();
            return $attribute;
        }catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            Log::error("error updating attribute", $e->getMessage());
            return false;
        }
    }

    public function deleteAttribute($id) {
        $attribute = self::getAttribute($id);
        return $this->attributeRepository->deleteAttribute($attribute); //cascade on deleta for attributesValues

    }
}