<?php

namespace App\Dto;

class ratingDto
{
    public $post_id;
    public $rating;
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
        $this->post_id = $request['post_id'];
        $this->rating = $request ['rating'];
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
            'post_id' => $this->post_id,
            'rating' => $this->rating,
            // 'name' => $this->name,
            // 'image' => $this->file
        ];
    }
}
