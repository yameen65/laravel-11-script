<?php

namespace App\Repositories;

use App\Dto\postDto;
use App\Models\post;

class postRepository extends BaseRepository
{
    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(post $model)
    {
        $this->setModel($model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostDto $data)
    {
        $dataArray = $data->toArray();

        if (isset($dataArray['image']) && $dataArray['image']) {
            $extension = $dataArray['image']->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $path = $dataArray['image']->storeAs('uploads', $imageName, 'public');
            $dataArray['image'] = $path;
        }

        return $this->add($this->_model, $dataArray);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update($id, postDto $data)
    {
        $result = $this->checkRecord($id);

        $dataArray = $data->toArray();
        return $result->update($dataArray);
    }
}
