<?php

namespace App\Http\Controllers;

use App\Dto\Permission\RoleDto;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleController extends Controller
{
    private $_repo = null;
    private $_directory = 'auth.pages.roles';
    private $_route = 'roles';

    public function __construct(RoleRepository $repo)
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

    public function store(RoleRequest $request)
    {
        try {
            $this->_repo->store(RoleDto::fromRequest($request->validated()));
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

    public function update(RoleRequest $request, $id)
    {
        try {
            $this->_repo->update($id, RoleDto::fromRequest($request->validated()));
            return redirect()->route($this->_route . '.index')->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            if ($th instanceof NotFoundHttpException) {
                $message = $th->getMessage(); // Get the exception message
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
}
