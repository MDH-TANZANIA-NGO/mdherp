<?php


namespace App\Repositories\System;


use App\Models\System\Holiday;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HolidayRepository extends BaseRepository
{
    const MODEL = Holiday::class;

    public function getQuery()
    {
        return $this->query()->select([
            'id',
            'title',
            'description',
            'date'
        ]);
    }

    public function getCurrent()
    {
        return $this->query()
            ->whereYear('date', Carbon::now()->format('Y'))
            ->where('isactive', 1)
            ->orderBy('date', 'asc')
            ->get();
    }

    public function update($inputs, $id)
    {
        return DB::transaction(function () use ($inputs, $id){
           return $this->query()->find($id)->update([
              'title' => $inputs['title'],
              'date' => $inputs['date']
           ]);
        });
    }

    public function checkIfDateIsHoliday($date)
    {
        return $this->getQuery()->whereDate('date', $date)->count();
    }

}
