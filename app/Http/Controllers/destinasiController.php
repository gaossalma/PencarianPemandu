<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedestinasiRequest;
use App\Http\Requests\UpdatedestinasiRequest;
use App\Repositories\destinasiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class destinasiController extends AppBaseController
{
    /** @var  destinasiRepository */
    private $destinasiRepository;

    public function __construct(destinasiRepository $destinasiRepo)
    {
        $this->destinasiRepository = $destinasiRepo;
    }

    /**
     * Display a listing of the destinasi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->destinasiRepository->pushCriteria(new RequestCriteria($request));
        $destinasis = $this->destinasiRepository->all();

        return view('destinasis.index')
            ->with('destinasis', $destinasis);
    }

    /**
     * Show the form for creating a new destinasi.
     *
     * @return Response
     */
    public function create()
    {
        return view('destinasis.create');
    }

    /**
     * Store a newly created destinasi in storage.
     *
     * @param CreatedestinasiRequest $request
     *
     * @return Response
     */
    public function store(CreatedestinasiRequest $request)
    {
        $input = $request->all();

        $destinasi = $this->destinasiRepository->create($input);

        Flash::success('Destinasi saved successfully.');

        return redirect(route('destinasis.index'));
    }

    /**
     * Display the specified destinasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            Flash::error('Destinasi not found');

            return redirect(route('destinasis.index'));
        }

        return view('destinasis.show')->with('destinasi', $destinasi);
    }

    /**
     * Show the form for editing the specified destinasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            Flash::error('Destinasi not found');

            return redirect(route('destinasis.index'));
        }

        return view('destinasis.edit')->with('destinasi', $destinasi);
    }

    /**
     * Update the specified destinasi in storage.
     *
     * @param  int              $id
     * @param UpdatedestinasiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedestinasiRequest $request)
    {
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            Flash::error('Destinasi not found');

            return redirect(route('destinasis.index'));
        }

        $destinasi = $this->destinasiRepository->update($request->all(), $id);

        Flash::success('Destinasi updated successfully.');

        return redirect(route('destinasis.index'));
    }

    /**
     * Remove the specified destinasi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $destinasi = $this->destinasiRepository->findWithoutFail($id);

        if (empty($destinasi)) {
            Flash::error('Destinasi not found');

            return redirect(route('destinasis.index'));
        }

        $this->destinasiRepository->delete($id);

        Flash::success('Destinasi deleted successfully.');

        return redirect(route('destinasis.index'));
    }
}
