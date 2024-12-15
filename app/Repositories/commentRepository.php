<?php

namespace App\Repositories;

use App\Dto\commentDto;
use App\Models\comment;

class commentRepository extends BaseRepository
{
    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(comment $model)
    {
        $this->setModel($model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(commentDto $data)
    {
        // dd($data);
        $dataArray = $data->toArray();
     

        $dataResult = $this->add($this->_model, $dataArray);

       

        return true;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, commentDto $data)
    {
        $result = $this->checkRecord($id);

        $dataArray = $data->toArray();
        return $result->update($dataArray);
    }
}
