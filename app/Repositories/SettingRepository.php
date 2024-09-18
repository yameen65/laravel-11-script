<?php

namespace App\Repositories;

use App\Dto\SettingDto;
use App\Helper\BaseQuery;
use App\Helper\FileUpload;
use App\Models\Setting;

class SettingRepository
{
    use BaseQuery, FileUpload;

    private $_imgPath = 'files/';
    private $_model = null;

    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Setting $model)
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingDto $data)
    {
        $dataArray = $data->toArray();
        $image = $dataArray['image'];

        unset($dataArray['image']);

        $dataResult = $this->add($this->_model, $dataArray);

        if ($image != null) {
            $imageUploaded = $this->uploadFile($image, $this->_imgPath);
            $dataResult->images()->create($imageUploaded);
        }

        return true;
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
    public function update($id, SettingDto $data)
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
