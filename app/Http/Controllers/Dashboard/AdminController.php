<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Dashboard\AdminService;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Services\Dashboard\AuthorizationService;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $adminService, $authorizationService;
    public function __construct(AdminService $adminService, AuthorizationService $authorizationService)
    {
        $this->adminService = $adminService;
        $this->authorizationService = $authorizationService;
    }
    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authorizations = $this->authorizationService->getRoles();
        return view('dashboard.admins.create', compact('authorizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->only(['name', 'email', 'password', 'role_id', 'status', 'phone']);
        $admin = $this->adminService->createAdmin($data);
        if (!$admin) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        $authorizations = $this->authorizationService->getRoles();
        if ($id == auth('admin')->user()->id) {
            abort(404);
        }
        return view('dashboard.admins.edit', compact(['admin', 'authorizations']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'email', 'password', 'role_id', 'status', 'phone']);
        $admin = $this->adminService->updateAdmin($data, $id);
        if (!$admin) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = $this->adminService->deleteAdmin($id);
        if (!$admin) {
            return redirect()->back()->with('error', __('messages.delete_rlated_admins'));
        }

        return redirect()->back()->with('success', __('messages.success_msg'));
    }

    public function changeStatus($id)
    {
        $admin = $this->adminService->changeStatus($id);
        if (!$admin) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}