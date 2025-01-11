<?php

namespace App\Repositories\Dashboard;

use App\Models\Authorization;

class AuthorizationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function getRole($id)
    {
        return Authorization::find($id);
    }
    public function getRoles()
    {
        return Authorization::orderBy('id', 'desc')->paginate(6);
    }
    public function createRole($request)
    {
        $role = Authorization::create([
            'role' => [
                'ar' => $request->role['ar'],
                'en' => $request->role['en'],
            ],
            'permession' => json_encode($request->permessions),
        ]);
        return $role;
    }

    public function updateRole($request, $role)
    {
        $role = $role->update([
            'role' => $request->role, // no problem
            'permession' => json_encode($request->permessions),
        ]);
        return $role;
    }
    public function deleteRole($role)
    {
        return $role->delete();
    }
}