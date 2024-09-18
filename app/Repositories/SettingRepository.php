<?php

namespace App\Repositories;

use App\Constants\Constants;
use App\Dto\SiteSettings\BasicInfoDto;
use App\Helper\BaseQuery;
use App\Helper\FileUpload;
use App\Models\Setting;

class SettingRepository
{
    use BaseQuery, FileUpload;

    private $_imgPath = 'settings/';
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
        return $this->_model->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function basic_info(BasicInfoDto $data)
    {
        $dataArray = $data->toArray();
        $dataResult = $this->index();

        if (isset($dataArray['image'])) {
            $existingImage = $dataResult->file()->where('type', 'logo')->first();

            if ($existingImage) {
                $this->deleteFile($existingImage->path);
                $existingImage->delete();
            }

            $profileUpload = $this->uploadFile($dataArray['image'], $this->_imgPath);
            $profileUpload['type'] = Constants::LOGOTYPE;
            $dataResult->file()->create($profileUpload);
        }

        return $dataResult->update($dataArray);
    }
}
