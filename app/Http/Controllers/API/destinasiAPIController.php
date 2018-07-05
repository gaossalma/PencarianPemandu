<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedestinasiAPIRequest;
use App\Http\Requests\API\UpdatedestinasiAPIRequest;
use App\Models\destinasi;
use App\Repositories\destinasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class destinasiController
 * @package App\Http\Controllers\API
 */

class destinasiAPIController extends AppBaseController
{
    /** @var  destinasiRepository */
    private $destinasiRepository;

    public function __construct(destinasiRepository $destinasiRepo)
    {
        $this->destinasiRepository = $destinasiRepo;
    }

    /**
     * Display a listing of the destinasi.
     * GET|HEAD /destinasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->destinasiRepository->pushCriteria(new RequestCriteria($request));
        $this->destinasiRepository->pushCriteria(new LimitOffsetCriteria($request));
        $destinasis = $this->destinasiRepository->all();

        return $this->sendResponse($destinasis->toArray(), 'Destinasis retrieved successfully');
    }

    /**
     * Store a newly created destinasi in storage.
     * POST /destinasis
     *
     * @param CreatedestinasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedestinasiAPIRequest $request)
    {
        $input = $request->all();

        $destinasis = $this->destinasiRepository->create($input);

        return $this->sendResponse($destinasis->toArray(), 'Destinasi saved successfully');
    }

    /**
     * Display the specified destinasi.
     * GET|HEAD /destinasis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var destinasi $destinasi */
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            return $this->sendError('Destinasi not found');
        }

        return $this->sendResponse($destinasi->toArray(), 'Destinasi retrieved successfully');
    }

    /**
     * Update the specified destinasi in storage.
     * PUT/PATCH /destinasis/{id}
     *
     * @param  int $id
     * @param UpdatedestinasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedestinasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var destinasi $destinasi */
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            return $this->sendError('Destinasi not found');
        }

        $destinasi = $this->destinasiRepository->update($input, $id);

        return $this->sendResponse($destinasi->toArray(), 'destinasi updated successfully');
    }

    /**
     * Remove the specified destinasi from storage.
     * DELETE /destinasis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var destinasi $destinasi */
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            return $this->sendError('Destinasi not found');
        }

        $destinasi->delete();

        return $this->sendResponse($id, 'Destinasi deleted successfully');
    }
}
