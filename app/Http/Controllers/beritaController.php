<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateberitaRequest;
use App\Http\Requests\UpdateberitaRequest;
use App\Repositories\beritaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class beritaController extends AppBaseController
{
    /** @var  beritaRepository */
    private $beritaRepository;

    public function __construct(beritaRepository $beritaRepo)
    {
        $this->beritaRepository = $beritaRepo;
    }

    /**
     * Display a listing of the berita.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->beritaRepository->pushCriteria(new RequestCriteria($request));
        $beritas = $this->beritaRepository->all();

        return view('beritas.index')
            ->with('beritas', $beritas);
    }

    /**
     * Show the form for creating a new berita.
     *
     * @return Response
     */
    public function create()
    {
        return view('beritas.create');
    }

    /**
     * Store a newly created berita in storage.
     *
     * @param CreateberitaRequest $request
     *
     * @return Response
     */
    public function store(CreateberitaRequest $request)
    {
        $input = $request->all();

        $berita = $this->beritaRepository->create($input);

        Flash::success('Berita saved successfully.');

        return redirect(route('beritas.index'));
    }

    /**
     * Display the specified berita.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            Flash::error('Berita not found');

            return redirect(route('beritas.index'));
        }

        return view('beritas.show')->with('berita', $berita);
    }

    /**
     * Show the form for editing the specified berita.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            Flash::error('Berita not found');

            return redirect(route('beritas.index'));
        }

        return view('beritas.edit')->with('berita', $berita);
    }

    /**
     * Update the specified berita in storage.
     *
     * @param  int              $id
     * @param UpdateberitaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateberitaRequest $request)
    {
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            Flash::error('Berita not found');

            return redirect(route('beritas.index'));
        }

        $berita = $this->beritaRepository->update($request->all(), $id);

        Flash::success('Berita updated successfully.');

        return redirect(route('beritas.index'));
    }

    /**
     * Remove the specified berita from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $berita = $this->beritaRepository->findWithoutFail($id);

        if (empty($berita)) {
            Flash::error('Berita not found');

            return redirect(route('beritas.index'));
        }

        $this->beritaRepository->delete($id);

        Flash::success('Berita deleted successfully.');

        return redirect(route('beritas.index'));
    }
}
