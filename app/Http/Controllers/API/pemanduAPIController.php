<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepemanduAPIRequest;
use App\Http\Requests\API\UpdatepemanduAPIRequest;
use App\Models\pemandu;
use App\Repositories\pemanduRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class pemanduController
 * @package App\Http\Controllers\API
 */

class pemanduAPIController extends AppBaseController
{
    /** @var  pemanduRepository */
    private $pemanduRepository;

    public function __construct(pemanduRepository $pemanduRepo)
    {
        $this->pemanduRepository = $pemanduRepo;
    }

    /**
     * Display a listing of the pemandu.
     * GET|HEAD /pemandus
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pemanduRepository->pushCriteria(new RequestCriteria($request));
        $this->pemanduRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pemandus = $this->pemanduRepository->all();

        return $this->sendResponse($pemandus->toArray(), 'Pemandus retrieved successfully');
    }

    /**
     * Store a newly created pemandu in storage.
     * POST /pemandus
     *
     * @param CreatepemanduAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepemanduAPIRequest $request)
    {
        $input = $request->all();

        $pemandus = $this->pemanduRepository->create($input);

        return $this->sendResponse($pemandus->toArray(), 'Pemandu saved successfully');
    }

    /**
     * Display the specified pemandu.
     * GET|HEAD /pemandus/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var pemandu $pemandu */
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            return $this->sendError('Pemandu not found');
        }

        return $this->sendResponse($pemandu->toArray(), 'Pemandu retrieved successfully');
    }

    /**
     * Update the specified pemandu in storage.
     * PUT/PATCH /pemandus/{id}
     *
     * @param  int $id
     * @param UpdatepemanduAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepemanduAPIRequest $request)
    {
        $input = $request->all();

        /** @var pemandu $pemandu */
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            return $this->sendError('Pemandu not found');
        }

        $pemandu = $this->pemanduRepository->update($input, $id);

        return $this->sendResponse($pemandu->toArray(), 'pemandu updated successfully');
    }

    /**
     * Remove the specified pemandu from storage.
     * DELETE /pemandus/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var pemandu $pemandu */
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            return $this->sendError('Pemandu not found');
        }

        $pemandu->delete();

        return $this->sendResponse($id, 'Pemandu deleted successfully');
    }
}
