<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createbahasa_pemanduRequest;
use App\Http\Requests\Updatebahasa_pemanduRequest;
use App\Repositories\bahasa_pemanduRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class bahasa_pemanduController extends AppBaseController
{
    /** @var  bahasa_pemanduRepository */
    private $bahasaPemanduRepository;

    public function __construct(bahasa_pemanduRepository $bahasaPemanduRepo)
    {
        $this->bahasaPemanduRepository = $bahasaPemanduRepo;
    }

    /**
     * Display a listing of the bahasa_pemandu.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bahasaPemanduRepository->pushCriteria(new RequestCriteria($request));
        $bahasaPemandus = $this->bahasaPemanduRepository->all();

        return view('bahasa_pemandus.index')
            ->with('bahasaPemandus', $bahasaPemandus);
    }

    /**
     * Show the form for creating a new bahasa_pemandu.
     *
     * @return Response
     */
    public function create()
    {
        return view('bahasa_pemandus.create');
    }

    /**
     * Store a newly created bahasa_pemandu in storage.
     *
     * @param Createbahasa_pemanduRequest $request
     *
     * @return Response
     */
    public function store(Createbahasa_pemanduRequest $request)
    {
        $input = $request->all();

        $bahasaPemandu = $this->bahasaPemanduRepository->create($input);

        Flash::success('Bahasa Pemandu saved successfully.');

        return redirect(route('bahasaPemandus.index'));
    }

    /**
     * Display the specified bahasa_pemandu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            Flash::error('Bahasa Pemandu not found');

            return redirect(route('bahasaPemandus.index'));
        }

        return view('bahasa_pemandus.show')->with('bahasaPemandu', $bahasaPemandu);
    }

    /**
     * Show the form for editing the specified bahasa_pemandu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            Flash::error('Bahasa Pemandu not found');

            return redirect(route('bahasaPemandus.index'));
        }

        return view('bahasa_pemandus.edit')->with('bahasaPemandu', $bahasaPemandu);
    }

    /**
     * Update the specified bahasa_pemandu in storage.
     *
     * @param  int              $id
     * @param Updatebahasa_pemanduRequest $request
     *
     * @return Response
     */
    public function update($id, Updatebahasa_pemanduRequest $request)
    {
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            Flash::error('Bahasa Pemandu not found');

            return redirect(route('bahasaPemandus.index'));
        }

        $bahasaPemandu = $this->bahasaPemanduRepository->update($request->all(), $id);

        Flash::success('Bahasa Pemandu updated successfully.');

        return redirect(route('bahasaPemandus.index'));
    }

    /**
     * Remove the specified bahasa_pemandu from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bahasaPemandu = $this->bahasaPemanduRepository->findWithoutFail($id);

        if (empty($bahasaPemandu)) {
            Flash::error('Bahasa Pemandu not found');

            return redirect(route('bahasaPemandus.index'));
        }

        $this->bahasaPemanduRepository->delete($id);

        Flash::success('Bahasa Pemandu deleted successfully.');

        return redirect(route('bahasaPemandus.index'));
    }
}
