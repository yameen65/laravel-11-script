<?php

namespace App\Dto;

class postDto
{
    public $tittle;
    public $content;
    public $image;
    // here create public properties same name with database column.
    // public readonly string $name;
    // public $file;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct($request)
    {
        $this->tittle = $request['tittle'];
        $this->content = $request['content'];
        $this->image = $request['image'];
        // here add all fields which are comming from request and assign it to database column names
        // $this->name = $request['name'];
        // $this->file = isset(request()->file) ? request()->file : null;
    }

    public static function fromRequest($request)
    {

        return new self($request);
    }

    public function toArray()
    {
        return [
            'tittle' => $this->tittle,
            'content' => $this->content,
            'image' => $this->image,
            // 'name' => $this->name,
            // 'image' => $this->file
        ];
    }
}
