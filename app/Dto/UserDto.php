<?php

namespace App\Dto;

class UserDto
{
    public ?string $first_name;
    public ?string $last_name;
    public ?string $email;
    public ?string $phone;
    public ?string $password;
    public $file;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct($request)
    {
        $this->first_name = $request['first_name'] ?? null;
        $this->last_name = $request['last_name'] ?? null;
        $this->email = $request['email'] ?? null;
        $this->phone = $request['phone'] ?? null;
        $this->password = $request['password'] ?? null;
        $this->file = isset(request()->file) ? request()->file : null;
    }

    public static function fromRequest($request)
    {
        return new self($request);
    }

    public function toArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'image' => $this->file
        ];
    }
}
