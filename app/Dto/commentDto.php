<?php

namespace App\Dto;

class commentDto
{
    public $user_id;
    public $post_id;
    public $content;

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
        $this->user_id = $request['user_id'];
        $this->post_id = $request['post_id'];
        $this->content = $request['content'];

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

            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'content' => $this->content,
            // 'name' => $this->name,
            // 'image' => $this->file
        ];
    }
}
