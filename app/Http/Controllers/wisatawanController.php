<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatewisatawanRequest;
use App\Http\Requests\UpdatewisatawanRequest;
use App\Repositories\wisatawanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class wisatawanController extends AppBaseController
{
    /** @var  wisatawanRepository */
    private $wisatawanRepository;

    public function __construct(wisatawanRepository $wisatawanRepo)
    {
        $this->wisatawanRepository = $wisatawanRepo;
    }

    /**
     * Display a listing of the wisatawan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->wisatawanRepository->pushCriteria(new RequestCriteria($request));
        $wisatawans = $this->wisatawanRepository->all();

        return view('wisatawans.index')
            ->with('wisatawans', $wisatawans);
    }

    /**
     * Show the form for creating a new wisatawan.
     *
     * @return Response
     */
    public function create()
    {
        return view('wisatawans.create');
    }

    /**
     * Store a newly created wisatawan in storage.
     *
     * @param CreatewisatawanRequest $request
     *
     * @return Response
     */
    public function store(CreatewisatawanRequest $request)
    {
        $input = $request->all();

        $wisatawan = $this->wisatawanRepository->create($input);

        Flash::success('Wisatawan saved successfully.');

        return redirect(route('wisatawans.index'));
    }

    /**
     * Display the specified wisatawan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            Flash::error('Wisatawan not found');

            return redirect(route('wisatawans.index'));
        }

        return view('wisatawans.show')->with('wisatawan', $wisatawan);
    }

    /**
     * Show the form for editing the specified wisatawan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            Flash::error('Wisatawan not found');

            return redirect(route('wisatawans.index'));
        }

        return view('wisatawans.edit')->with('wisatawan', $wisatawan);
    }

    /**
     * Update the specified wisatawan in storage.
     *
     * @param  int              $id
     * @param UpdatewisatawanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatewisatawanRequest $request)
    {
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            Flash::error('Wisatawan not found');

            return redirect(route('wisatawans.index'));
        }

        $wisatawan = $this->wisatawanRepository->update($request->all(), $id);

        Flash::success('Wisatawan updated successfully.');

        return redirect(route('wisatawans.index'));
    }

    /**
     * Remove the specified wisatawan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $wisatawan = $this->wisatawanRepository->findWithoutFail($id);

        if (empty($wisatawan)) {
            Flash::error('Wisatawan not found');

            return redirect(route('wisatawans.index'));
        }

        $this->wisatawanRepository->delete($id);

        Flash::success('Wisatawan deleted successfully.');

        return redirect(route('wisatawans.index'));
    }
}
