<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createbahasa_pemanduAPIRequest;
use App\Http\Requests\API\Updatebahasa_pemanduAPIRequest;
use App\Models\bahasa_pemandu;
use App\Repositories\bahasa_pemanduRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class bahasa_pemanduController
 * @package App\Http\Controllers\API
 */

class bahasa_pemanduAPIController extends AppBaseController
{
    /** @var  bahasa_pemanduRepository */
    private $bahasaPemanduRepository;

    public function __construct(bahasa_pemanduRepository $bahasaPemanduRepo)
    {
        $this->bahasaPemanduRepository = $bahasaPemanduRepo;
    }

    /**
     * Display a listing of the bahasa_pemandu.
     * GET|HEAD /bahasaPemandus
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bahasaPemanduRepository->pushCriteria(new RequestCriteria($request));
        $this->bahasaPemanduRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bahasaPemandus = $this->bahasaPemanduRepository->all();

        return $this->sendResponse($bahasaPemandus->toArray(), 'Bahasa Pemandus retrieved successfully');
    }

    /**
     * Store a newly created bahasa_pemandu in storage.
     * POST /bahasaPemandus
     *
     * @param Createbahasa_pemanduAPIRequest $request
     *
     * @return Response
     */
    public function store(Createbahasa_pemanduAPIRequest $request)
    {
        $input = $request->all();

        $bahasaPemandus = $this->bahasaPemanduRepository->create($input);

        return $this->sendResponse($bahasaPemandus->toArray(), 'Bahasa Pemandu saved successfully');
    }

    /**
     * Display the specified bahasa_pemandu.
     * GET|HEAD /bahasaPemandus/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var bahasa_pemandu $bahasaPemandu */
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            return $this->sendError('Bahasa Pemandu not found');
        }

        return $this->sendResponse($bahasaPemandu->toArray(), 'Bahasa Pemandu retrieved successfully');
    }

    /**
     * Update the specified bahasa_pemandu in storage.
     * PUT/PATCH /bahasaPemandus/{id}
     *
     * @param  int $id
     * @param Updatebahasa_pemanduAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatebahasa_pemanduAPIRequest $request)
    {
        $input = $request->all();

        /** @var bahasa_pemandu $bahasaPemandu */
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            return $this->sendError('Bahasa Pemandu not found');
        }

        $bahasaPemandu = $this->bahasaPemanduRepository->update($input, $id);

        return $this->sendResponse($bahasaPemandu->toArray(), 'bahasa_pemandu updated successfully');
    }

    /**
     * Remove the specified bahasa_pemandu from storage.
     * DELETE /bahasaPemandus/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var bahasa_pemandu $bahasaPemandu */
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            return $this->sendError('Bahasa Pemandu not found');
        }

        $bahasaPemandu->delete();

        return $this->sendResponse($id, 'Bahasa Pemandu deleted successfully');
    }
}
