<?php

namespace App\Http\Controllers;

use App\Dto\ratingDto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ratingRequest;
use App\Repositories\ratingRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ratingController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(ratingRepository $repo)
    {
        $this->setRepo($repo, 'rating', 'ratings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ratingRequest $request)
    {
        try {
            $this->_repo->store(ratingDto::fromRequest($request->validated()));
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
    public function update(ratingRequest $request, $id)
    {
        try {
            $this->_repo->update($id, ratingDto::fromRequest($request->validated()));
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
