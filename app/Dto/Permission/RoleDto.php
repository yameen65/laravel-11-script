<?php

namespace App\Dto\Permission;

class RoleDto
{
    // here create public properties same name with database column.
    public readonly string $name;
    public readonly string $guard_name;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct($request)
    {
        $this->name = $request['name'];
        $this->guard_name = 'web';
    }

    public static function fromRequest($request)
    {
        return new self($request);
    }

    public function toArray()
    {
        $return = [
            'name' => $this->name,
            'guard_name' => $this->guard_name,
        ];

        return $return;
    }
}
