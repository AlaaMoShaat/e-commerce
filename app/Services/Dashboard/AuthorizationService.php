<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\AuthorizationRepository;

class AuthorizationService
{
    /**
     * Create a new class instance.
     */
    protected $authorizationRepository;
    public function __construct(AuthorizationRepository $authorizationRepository)
    {
        $this->authorizationRepository = $authorizationRepository;
    }

    public function getRole($id)
    {
        return $this->authorizationRepository->getRole($id);
    }
    public function getRoles()
    {
        return $this->authorizationRepository->getRoles();
    }

    public function createRole($request)
    {
        $role = $this->authorizationRepository->createRole($request);
        return $role;
    }

    public function updateRole($request, $id)
    {
        $role = $this->authorizationRepository->getRole($id);
        if (!$role) {
            return false;
        }
        return $this->authorizationRepository->updateRole($request, $role);
    }

    public function deleteRole($id)
    {
        $role = $this->authorizationRepository->getRole($id);
        if (!$role || $role->admins->count() > 0) {
            return false;
        }
        return $this->authorizationRepository->deleteRole($id);
    }
}
