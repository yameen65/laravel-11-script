<?php

namespace App\Repositories;

use App\Dto\RoleDto;
use App\Helper\BaseQuery;
use App\Models\Role;

class RoleRepository
{
    use BaseQuery;

    private $_model = null;

    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Role $model)
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

    public function get_all_roles()
    {
        return $this->_model->where('name', '!=', 'admin')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleDto $data)
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
    public function update($id, RoleDto $data)
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

    private function checkRecord($id)
    {
        $result = $this->show($id);

        if ($result == null) {
            return null;
        }

        return $result;
    }
}
