<?php

namespace App\Http\Controllers;

use App\Dto\Permission\PermissionDto;
use App\Dto\Permission\PermissionUpdateDto;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\PermissionUpdateRquest;
use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PermissionController extends Controller
{
    private $_repo = null;
    private $_directory = 'auth.pages.permissions';
    private $_route = 'permissions';

    public function __construct(PermissionRepository $repo)
    {
        $this->_repo = $repo;
    }

    public function index()
    {
        $data['all'] = $this->_repo->index();
        return view($this->_directory . '.all', compact('data'));
    }

    public function create()
    {
        return view($this->_directory . '.create');
    }

    public function store(PermissionRequest $request)
    {
        try {
            $this->_repo->store(PermissionDto::fromRequest($request->validated()));
            return redirect()->route($this->_route . '.index')->with('success', 'Successfully created.');
        } catch (\Throwable $th) {
            return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong..');
        }
    }

    public function show($id)
    {
        $data = $this->_repo->show($id);

        if ($data == null) {
            abort(404);
        }

        return view($this->_directory . '.show', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->_repo->show($id);

        if ($data == null) {
            abort(404);
        }

        return view($this->_directory . '.edit', compact('data'));
    }

    public function update(PermissionUpdateRquest $request, $id)
    {
        try {
            $this->_repo->update($id, PermissionUpdateDto::fromRequest($request->validated()));
            return redirect()->route($this->_route . '.index')->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd($message);
            if ($th instanceof NotFoundHttpException) {
                return redirect()->route($this->_route . '.index')->with('error', $message);
            } else {
                return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong..');
            }
        }
    }

    public function destroy($id)
    {
        try {
            $this->_repo->destroy($id);
            return redirect()->route($this->_route . '.index')->with('success', 'Deleted succesfully');
        } catch (\Throwable $th) {
            if ($th instanceof NotFoundHttpException) {
                $message = $th->getMessage(); // Get the exception message
                return redirect()->route($this->_route . '.index')->with('error', $message);
            } else {
                return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong..');
            }
        }
    }

    private function checkRole($roleId)
    {
        $roleRepo = new RoleRepository(new Role());
        $role = $roleRepo->show($roleId);

        if ($role == null) {
            abort(404, 'Role not found');
        }

        return $role;
    }

    public function assign_permission($roleId)
    {
        $role = $this->checkRole($roleId);

        $permissions = $this->_repo->getByColumn(['guard_name' => 'web']);
        return view($this->_directory . '.assign_permission', compact('permissions', 'role'));
    }

    public function assign_permission_store($roleId)
    {
        $role = $this->checkRole($roleId);

        try {
            $this->_repo->assignPermission(request()->input('permission', []), $role);
            return redirect()->back()->with('success', 'Permission Assign succesfully');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if ($th instanceof NotFoundHttpException) {
                return redirect()->back()->with('error', $message);
            } else {
                return redirect()->back()->with('error', 'Something went wrong..');
            }
        }
    }
}
