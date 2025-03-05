<?php

namespace App\Repositories\Dashboard;

class AttributeValueRepository
{
    public function createAttributeValue($attribute, $value) {
        $attribute->attributeValues()->create([
            'value' => $value,
        ]);
    }

    public function deleteAttributeValues($attribute) {
        return $attribute->attributeValues()->delete();
    }
}