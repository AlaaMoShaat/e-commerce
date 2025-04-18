<?php

namespace App\Repositories\Dashboard;

use App\Models\Attribute;

class AttributeRepository
{
  public function getAllAttributes() {
    return Attribute::with('attributeValues')->get();
  }

  public function getAttribute($id) {
    return Attribute::find($id);
  }

  public function createAttribute($data) {
    return Attribute::create([
        'name' => $data['name'],
    ]);
  }

  public function updateAttribute($attribute, $data) {
    return $attribute->update([
        'name' => $data['name'],
    ]);
  }

  public function deleteAttribute($attribute) {
    return $attribute->delete();
  }
}
