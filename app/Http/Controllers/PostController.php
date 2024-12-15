<?php

namespace App\Http\Controllers;

use App\Dto\postDto;
use Illuminate\Http\Request;
use App\Http\Requests\postRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\postRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class postController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(postRepository $repo)
    {
        $this->setRepo($repo, 'post', 'posts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {

            $this->_repo->store(PostDto::fromRequest($request->validated()));
            return redirect()->route($this->_route . '.index')->with('success', 'Successfully created.');
        } catch (\Throwable $th) {
            Log::error('Post creation error: ', ['error' => $th->getMessage()]);
            return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong. Please try again.');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request Validation $validation
     * @return \Illuminate\Http\Response
     */
    public function update(postRequest $request, $id)
    {
        try {
            $this->_repo->update($id, postDto::fromRequest($request->validated()));
            return redirect()->route($this->_route . '.index')->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            if ($th instanceof NotFoundHttpException) {
                $message = $th->getMessage();
                return redirect()->route($this->_route . '.index')->with('error', $message);
            } else {
                return redirect()->route($this->_route . '.index')->with('error', 'Something went wrong..');
            }
        }
    }
}
