<?php

namespace App\Repositories;

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
}
