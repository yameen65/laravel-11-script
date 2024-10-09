<?php

namespace App\Http\Controllers;

use App\Dto\SiteSettings\BasicInfoDto;
use App\Dto\SiteSettings\SmtpDto;
use App\Dto\SiteSettings\SocialDto;
use App\Helper\Exception;
use App\Repositories\SettingRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettings\BasicInfoRequest;
use App\Http\Requests\SiteSettings\SmtpRequest;
use App\Http\Requests\SiteSettings\SocialLoginRequest;
use Illuminate\Http\Request;

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
    public function index($blade)
    {
        try {
            $view = $this->_directory . '.' . $blade;

            $data = $this->_repo->index();
            return view($view, compact('data'));
        } catch (\Throwable $th) {
            return Exception::handle($th);
        }
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
            return Exception::handle($th);
        }
    }

    public function social_logins_update(SocialLoginRequest $request)
    {
        try {
            $this->_repo->social_update(SocialDto::fromRequest($request->validated()));
            return redirect()->back()->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            return Exception::handle($th);
        }
    }

    public function smtp_update(SmtpRequest $request)
    {
        try {
            $this->_repo->smtp_update(SmtpDto::fromRequest($request->validated()));
            return redirect()->back()->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            return Exception::handle($th);
        }
    }

    public function payments_update() {}

    public function clear_cache()
    {
        try {
            $this->_repo->clear_cache();
            return redirect()->back()->with('success', 'All cache cleared for your website.');
        } catch (\Throwable $th) {
            return Exception::handle($th);
        }
    }
}
