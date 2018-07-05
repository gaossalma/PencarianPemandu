<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebahasaAPIRequest;
use App\Http\Requests\API\UpdatebahasaAPIRequest;
use App\Models\bahasa;
use App\Repositories\bahasaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class bahasaController
 * @package App\Http\Controllers\API
 */

class bahasaAPIController extends AppBaseController
{
    /** @var  bahasaRepository */
    private $bahasaRepository;

    public function __construct(bahasaRepository $bahasaRepo)
    {
        $this->bahasaRepository = $bahasaRepo;
    }

    /**
     * Display a listing of the bahasa.
     * GET|HEAD /bahasas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bahasaRepository->pushCriteria(new RequestCriteria($request));
        $this->bahasaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bahasas = $this->bahasaRepository->all();

        return $this->sendResponse($bahasas->toArray(), 'Bahasas retrieved successfully');
    }

    /**
     * Store a newly created bahasa in storage.
     * POST /bahasas
     *
     * @param CreatebahasaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebahasaAPIRequest $request)
    {
        $input = $request->all();

        $bahasas = $this->bahasaRepository->create($input);

        return $this->sendResponse($bahasas->toArray(), 'Bahasa saved successfully');
    }

    /**
     * Display the specified bahasa.
     * GET|HEAD /bahasas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var bahasa $bahasa */
        $bahasa = $this->bahasaRepository->findWithoutFail($id);

        if (empty($bahasa)) {
            return $this->sendError('Bahasa not found');
        }

        return $this->sendResponse($bahasa->toArray(), 'Bahasa retrieved successfully');
    }

    /**
     * Update the specified bahasa in storage.
     * PUT/PATCH /bahasas/{id}
     *
     * @param  int $id
     * @param UpdatebahasaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebahasaAPIRequest $request)
    {
        $input = $request->all();

        /** @var bahasa $bahasa */
        $bahasa = $this->bahasaRepository->findWithoutFail($id);

        if (empty($bahasa)) {
            return $this->sendError('Bahasa not found');
        }

        $bahasa = $this->bahasaRepository->update($input, $id);

        return $this->sendResponse($bahasa->toArray(), 'bahasa updated successfully');
    }

    /**
     * Remove the specified bahasa from storage.
     * DELETE /bahasas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var bahasa $bahasa */
        $bahasa = $this->bahasaRepository->findWithoutFail($id);

        if (empty($bahasa)) {
            return $this->sendError('Bahasa not found');
        }

        $bahasa->delete();

        return $this->sendResponse($id, 'Bahasa deleted successfully');
    }
}
