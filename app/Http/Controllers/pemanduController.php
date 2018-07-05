<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepemanduRequest;
use App\Http\Requests\UpdatepemanduRequest;
use App\Repositories\pemanduRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class pemanduController extends AppBaseController
{
    /** @var  pemanduRepository */
    private $pemanduRepository;

    public function __construct(pemanduRepository $pemanduRepo)
    {
        $this->pemanduRepository = $pemanduRepo;
    }

    /**
     * Display a listing of the pemandu.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pemanduRepository->pushCriteria(new RequestCriteria($request));
        $pemandus = $this->pemanduRepository->all();

        return view('pemandus.index')
            ->with('pemandus', $pemandus);
    }

    /**
     * Show the form for creating a new pemandu.
     *
     * @return Response
     */
    public function create()
    {
        return view('pemandus.create');
    }

    /**
     * Store a newly created pemandu in storage.
     *
     * @param CreatepemanduRequest $request
     *
     * @return Response
     */
    public function store(CreatepemanduRequest $request)
    {
        $input = $request->all();

        $pemandu = $this->pemanduRepository->create($input);

        Flash::success('Pemandu saved successfully.');

        return redirect(route('pemandus.index'));
    }

    /**
     * Display the specified pemandu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            Flash::error('Pemandu not found');

            return redirect(route('pemandus.index'));
        }

        return view('pemandus.show')->with('pemandu', $pemandu);
    }

    /**
     * Show the form for editing the specified pemandu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            Flash::error('Pemandu not found');

            return redirect(route('pemandus.index'));
        }

        return view('pemandus.edit')->with('pemandu', $pemandu);
    }

    /**
     * Update the specified pemandu in storage.
     *
     * @param  int              $id
     * @param UpdatepemanduRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepemanduRequest $request)
    {
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            Flash::error('Pemandu not found');

            return redirect(route('pemandus.index'));
        }

        $pemandu = $this->pemanduRepository->update($request->all(), $id);

        Flash::success('Pemandu updated successfully.');

        return redirect(route('pemandus.index'));
    }

    /**
     * Remove the specified pemandu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemandu = $this->pemanduRepository->findWithoutFail($id);

        if (empty($pemandu)) {
            Flash::error('Pemandu not found');

            return redirect(route('pemandus.index'));
        }

        $this->pemanduRepository->delete($id);

        Flash::success('Pemandu deleted successfully.');

        return redirect(route('pemandus.index'));
    }
}
