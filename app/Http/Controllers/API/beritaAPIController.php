<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateberitaAPIRequest;
use App\Http\Requests\API\UpdateberitaAPIRequest;
use App\Models\berita;
use App\Repositories\beritaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class beritaController
 * @package App\Http\Controllers\API
 */

class beritaAPIController extends AppBaseController
{
    /** @var  beritaRepository */
    private $beritaRepository;

    public function __construct(beritaRepository $beritaRepo)
    {
        $this->beritaRepository = $beritaRepo;
    }

    /**
     * Display a listing of the berita.
     * GET|HEAD /beritas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->beritaRepository->pushCriteria(new RequestCriteria($request));
        $this->beritaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $beritas = $this->beritaRepository->all();

        return $this->sendResponse($beritas->toArray(), 'Beritas retrieved successfully');
    }

    /**
     * Store a newly created berita in storage.
     * POST /beritas
     *
     * @param CreateberitaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateberitaAPIRequest $request)
    {
        $input = $request->all();

        $beritas = $this->beritaRepository->create($input);

        return $this->sendResponse($beritas->toArray(), 'Berita saved successfully');
    }

    /**
     * Display the specified berita.
     * GET|HEAD /beritas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var berita $berita */
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            return $this->sendError('Berita not found');
        }

        return $this->sendResponse($berita->toArray(), 'Berita retrieved successfully');
    }

    /**
     * Update the specified berita in storage.
     * PUT/PATCH /beritas/{id}
     *
     * @param  int $id
     * @param UpdateberitaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateberitaAPIRequest $request)
    {
        $input = $request->all();

        /** @var berita $berita */
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            return $this->sendError('Berita not found');
        }

        $berita = $this->beritaRepository->update($input, $id);

        return $this->sendResponse($berita->toArray(), 'berita updated successfully');
    }

    /**
     * Remove the specified berita from storage.
     * DELETE /beritas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var berita $berita */
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            return $this->sendError('Berita not found');
        }

        $berita->delete();

        return $this->sendResponse($id, 'Berita deleted successfully');
    }
}
