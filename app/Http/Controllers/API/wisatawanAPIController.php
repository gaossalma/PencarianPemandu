<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatewisatawanAPIRequest;
use App\Http\Requests\API\UpdatewisatawanAPIRequest;
use App\Models\wisatawan;
use App\Repositories\wisatawanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class wisatawanController
 * @package App\Http\Controllers\API
 */

class wisatawanAPIController extends AppBaseController
{
    /** @var  wisatawanRepository */
    private $wisatawanRepository;

    public function __construct(wisatawanRepository $wisatawanRepo)
    {
        $this->wisatawanRepository = $wisatawanRepo;
    }

    /**
     * Display a listing of the wisatawan.
     * GET|HEAD /wisatawans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->wisatawanRepository->pushCriteria(new RequestCriteria($request));
        $this->wisatawanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $wisatawans = $this->wisatawanRepository->all();

        return $this->sendResponse($wisatawans->toArray(), 'Wisatawans retrieved successfully');
    }

    /**
     * Store a newly created wisatawan in storage.
     * POST /wisatawans
     *
     * @param CreatewisatawanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatewisatawanAPIRequest $request)
    {
        $input = $request->all();

        $wisatawans = $this->wisatawanRepository->create($input);

        return $this->sendResponse($wisatawans->toArray(), 'Wisatawan saved successfully');
    }

    /**
     * Display the specified wisatawan.
     * GET|HEAD /wisatawans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var wisatawan $wisatawan */
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            return $this->sendError('Wisatawan not found');
        }

        return $this->sendResponse($wisatawan->toArray(), 'Wisatawan retrieved successfully');
    }

    /**
     * Update the specified wisatawan in storage.
     * PUT/PATCH /wisatawans/{id}
     *
     * @param  int $id
     * @param UpdatewisatawanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatewisatawanAPIRequest $request)
    {
        $input = $request->all();

        /** @var wisatawan $wisatawan */
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            return $this->sendError('Wisatawan not found');
        }

        $wisatawan = $this->wisatawanRepository->update($input, $id);

        return $this->sendResponse($wisatawan->toArray(), 'wisatawan updated successfully');
    }

    /**
     * Remove the specified wisatawan from storage.
     * DELETE /wisatawans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var wisatawan $wisatawan */
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            return $this->sendError('Wisatawan not found');
        }

        $wisatawan->delete();

        return $this->sendResponse($id, 'Wisatawan deleted successfully');
    }
}
