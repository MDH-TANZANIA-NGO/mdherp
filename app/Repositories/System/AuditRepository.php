<?php


namespace App\Repositories\System;


use Illuminate\Support\Facades\DB;

class AuditRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return DB::table('audits')
            ->leftjoin('users', 'users.id', 'audits.user_id');
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function getAll()
    {
        return $this->query()->select([
            DB::raw("concat_ws(',', audits.auditable_type, audits.auditable_id) AS model"),
            DB::raw('audits.event AS action'),
            DB::raw("concat_ws(' ', users.first_name, users.last_name, users.uni) AS user"),
            DB::raw('audits.created_at AS time'),
            DB::raw('audits.old_values AS old_values'),
            DB::raw('audits.new_values AS new_values'),
            DB::raw('audits.user_agent AS device'),
            DB::raw('audits.url AS url')
        ])
            ->orderBy('audits.id', 'desc');
    }

}
