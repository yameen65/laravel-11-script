<?php

namespace App\Repositories;

use App\Constants\Constants;
use App\Dto\UserDto;
use App\Events\PackageTrial;
use App\Models\User;
use App\Mail\VerificationPhone;
use App\Helper\BaseQuery;
use App\Helper\Helpers;
use App\Helper\FileUpload;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Mail;

class UserRepository
{
    use BaseQuery, FileUpload, Helpers;

    private $_imgPath = 'users/';
    private $_model = null;
    private $_model1 = null;

    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct()
    {
        $this->_model = new User();
        $this->_model1 = new VerificationCode();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->get_all($this->_model);
    }

    public function get_all_users()
    {
        return $this->_model->whereHas('roles', function ($q) {
            $q->where('name', request()->type);
        })->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        $dataArray = $data->toArray();
        $roleId = $dataArray['type'];

        $roleName = Role::whereId($roleId)->pluck('name')->first();

        if (is_null($roleName)) {
            throw new NotFoundHttpException('The specified role does not exist.'); // Throw a custom exception
        }

        unset($dataArray['type']);

        if (isset($dataArray['password'])) {
            $dataArray['password'] = Hash::make($dataArray['password']);
        }

        $user = $this->add($this->_model, $dataArray);
        $user->assignRole($roleName);

        if (isset($dataArray['image'])) {
            $profileUpload = $this->uploadFile($dataArray['image'], $this->_imgPath);
            $profileUpload['type'] = Constants::PROFILETYPE;
            $user->file()->create($profileUpload);
        }

        return $user;
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
    public function update($id, UserDto $data)
    {
        $dataArray = $data->toArray();

        unset($dataArray['email']);

        if (isset($dataArray['password'])) {
            $dataArray['password'] = Hash::make($dataArray['password']);
        }

        $dataResult = $this->get_by_id($this->_model, $id);

        if (isset($dataArray['image'])) {
            $existingImage = $dataResult->file()->first();

            if ($existingImage) {
                $this->deleteFile($existingImage->path);
                $existingImage->delete();
            }

            $profileUpload = $this->uploadFile($dataArray['image'], $this->_imgPath);
            $profileUpload['type'] = Constants::PROFILETYPE;
            $dataResult->file()->create($profileUpload);
        }

        $dataResult->update($dataArray);

        return $dataResult;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->delete($this->_model, $id);
    }

    public function validateEmail($email)
    {
        $data = $this->get_by_column_single($this->_model, ['email' => $email]);

        if ($data == null) {
            return false;
        } else {
            return true;
        }
    }

    public function generateCode($formattedPhoneNumber)
    {
        $formattedPhoneNumber = $this->isValidPhoneNumber($formattedPhoneNumber);
        $code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $this->sendOtpViaTwilio($formattedPhoneNumber, $code);
        return $code;
    }


    public function sendOtp($id, $email, UserDto $data)
    {
        $dataArray = $data->toArray();
        unset($dataArray['first_name']);
        unset($dataArray['last_name']);
        unset($dataArray['email']);
        unset($dataArray['languages']);

        $dataResult = $this->get_by_id($this->_model, $id);
        $dataResult->update($dataArray);
        $formattedPhoneNumber = $dataResult->phone;

        $code = $this->generateCode($formattedPhoneNumber);

        Mail::to($email)->send(new VerificationPhone($code, $id));
        return true;
    }

    public function verify($id, $code)
    {
        $data = $this->get_by_column_single($this->_model1, ['user_id' => $id, 'code' => $code]);

        if (!$data) {
            return null;
        } else {
            $data->delete();
        }
        $expired_time = Carbon::now()->diffInSeconds($data->created_at);
        if ($expired_time * (-1) > 60) {
            $data->delete();
            return response()->json(['error' => 'Verification code has expired, please resend'], 400);
        }
        return $data;
    }

    public function updateLanguages($id, UserDto $data)
    {

        $dataArray = $data->toArray();
        unset($dataArray['first_name']);
        unset($dataArray['last_name']);
        unset($dataArray['email']);
        unset($dataArray['phone']);
        $dataResult = $this->get_by_id($this->_model, $id);
        $dataResult->update($dataArray);
        return $dataResult;
    }

    public function purchaseSubscription($id, UserDto $data)
    {
        $dataArray = $data->toArray();
        unset($dataArray['first_name']);
        unset($dataArray['last_name']);
        unset($dataArray['email']);
        unset($dataArray['phone']);
        $dataResult = $this->get_by_id($this->_model, $id);
        $dataResult->update($dataArray);

        if (isset($dataArray['billing_cycle'])) {
            event(new PackageTrial($dataResult));
            return $dataResult;
        }

        return $dataResult;
    }
}
