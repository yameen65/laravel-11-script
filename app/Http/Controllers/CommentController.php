<?php

namespace App\Http\Controllers;

use App\Dto\commentDto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\commentRequest;
use App\Repositories\commentRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class commentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(commentRepository $repo)
    {
        $this->setRepo($repo, 'comment', 'comments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(commentRequest $request)
    {
        // dd($request->validated());
        try {
            $this->_repo->store(commentDto::fromRequest($request->validated()));
            return redirect()->back()->with('success', 'Successfully created.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong..');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request Validation $validation
     * @return \Illuminate\Http\Response
     */
    public function update(commentRequest $request, $id)
    {
        try {
            $this->_repo->update($id, commentDto::fromRequest($request->validated()));
            return redirect()->back()->with('success', 'Updated succesfully');
        } catch (\Throwable $th) {
            if ($th instanceof NotFoundHttpException) {
                $message = $th->getMessage(); // Get the exception message
                return redirect()->back()->with('error', $message);
            } else {
                return redirect()->back()->with('error', 'Something went wrong..');
            }
        }
    }
}
