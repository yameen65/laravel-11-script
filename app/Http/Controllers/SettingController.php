<?php

namespace App\Http\Controllers;

use App\Dto\SiteSettings\BasicInfoDto;
use App\Dto\SiteSettings\SmtpDto;
use App\Repositories\SettingRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettings\BasicInfoRequest;
use App\Http\Requests\SiteSettings\SmtpRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingController extends Controller
{
    private $_repo = null;
    private $_directory = 'auth.pages.settings';

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(SettingRepository $repo)
    {
        $this->_repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->_repo->index();
        return view($this->_directory . '.setting', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request Validation $validation
     * @return \Illuminate\Http\Response
     */
    public function basic_info(BasicInfoRequest $request)
    {
        try {
            $this->_repo->basic_info(BasicInfoDto::fromRequest($request->validated()));
            return redirect()->back()->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd($message);
            if ($th instanceof NotFoundHttpException) {
                return redirect()->back()->with('error', $message);
            } else {
                return redirect()->back()->with('error', 'Something went wrong..');
            }
        }
    }

    public function social_logins_index()
    {
        $data = $this->_repo->index();
        return view($this->_directory . '.social_logins', compact('data'));
    }

    public function social_logins_update() {}

    public function smtp_index()
    {
        $data = $this->_repo->index();
        return view($this->_directory . '.smtp', compact('data'));
    }

    public function smtp_update(SmtpRequest $request)
    {
        try {
            $this->_repo->smtp_update(SmtpDto::fromRequest($request->validated()));
            return redirect()->back()->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            dd($message);
            if ($th instanceof NotFoundHttpException) {
                return redirect()->back()->with('error', $message);
            } else {
                return redirect()->back()->with('error', 'Something went wrong..');
            }
        }
    }

    public function payments_index()
    {
        $data = $this->_repo->index();
        return view($this->_directory . '.payments', compact('data'));
    }

    public function payments_update() {}
}
