<?php

namespace App\Http\Controllers\Web\Requisition\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisition\Item\RequisitionItemRequest;
use App\Models\Requisition\Requisition;
use App\Repositories\Requisition\Equipment\EquipmentRepository;
use App\Repositories\Requisition\Item\RequisitionItemRepository;
use App\Repositories\System\DistrictRepository;
use Illuminate\Http\Request;

class RequisitionItemController extends Controller
{
    protected $items;
    protected $districts;
    protected $equipments;

    public function __construct()
    {
        $this->items = (new RequisitionItemRepository());
        $this->districts = (new DistrictRepository());
        $this->equipments = (new EquipmentRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RequisitionItemRequest $request, Requisition $requisition)
    {
        $this->items->store($requisition, $request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($uuid,$send)
    {
        return view('requisition.procurement.forms.edit')
            ->with('send', $send)
            ->with('item', $this->items->findByUuid($uuid))
            ->with('equipments', $this->equipments->getQuery()->get()->pluck('title','id'))
            ->with('districts', $this->districts->getForPluck());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $uuid, $send)
    {
        $item = $this->items->findByUuid($uuid);
        $this->items->update($uuid,$request->all());
        if($send == 'view')
            return redirect()->route('requisition.show', $item->requisition);
        return redirect()->route('requisition.initiate', $item->requisition);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
