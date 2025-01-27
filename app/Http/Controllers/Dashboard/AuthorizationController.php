<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Authorization;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\AuthorizationService;
use App\Http\Requests\Dashboard\AuthorizationRequest;

class AuthorizationController extends Controller
{
    protected $authorizationService;
    public function __construct(AuthorizationService $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorizations = $this->authorizationService->getRoles();
        return view('dashboard.roles.index', compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
        $role = $this->authorizationService->createRole($request);
        if (!$role) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }

        return redirect()->route('dashboard.roles.index')->with('success', __('messages.success_msg'));
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
        $role = $this->authorizationService->getRole($id);
        if (!$role) {
            return redirect()->back()->with('error', __('messages.not_found'));
        }
        return view('dashboard.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorizationRequest $request, string $id)
    {
        $role = $this->authorizationService->updateRole($request, $id);
        if (!$role) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = $this->authorizationService->deleteRole($id);
        if (!$role) {
            return response()->json(['status' => false, 'message' => __('messages.delete_rlated_admins')]);
        }

        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }
}