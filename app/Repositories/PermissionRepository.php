<?php

namespace App\Repositories;

use App\Dto\Permission\PermissionDto;
use App\Dto\Permission\PermissionUpdateDto;
use App\Helper\BaseQuery;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    use BaseQuery;

    private $_model = null;

    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Permission $model)
    {
        $this->_model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->get_all($this->_model);
    }

    public function getByColumn($columnArr)
    {
        return $this->get_by_column($this->_model, $columnArr);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionDto $data)
    {
        $dataArray = $data->toArray();
        return $this->add($this->_model, $dataArray);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->get_by_id($this->_model, $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, PermissionUpdateDto $data)
    {
        $result = $this->checkRecord($id);

        $dataArray = $data->toArray();
        return $result->update($dataArray);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->checkRecord($id);
        return $result->delete();
    }

    public function assignPermission($permission, $role)
    {
        return $role->syncPermissions($permission);
    }

    private function checkRecord($id)
    {
        $result = $this->show($id);

        if ($result == null) {
            return null;
        }

        return $result;
    }
}
