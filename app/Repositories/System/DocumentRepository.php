<?php

namespace App\Repositories\System;


use App\Models\System\Document;
use App\Repositories\BaseRepository;

class DocumentRepository extends BaseRepository
{
    const MODEL = Document::class;




    public function getDocumentsByGroupFilter(array $filter)
    {
        $documents = $this->query()
            ->where('isactive',1)
            ->whereHas('documentGroup', function ($query) use($filter){
            $query->whereIn('document_group_id', $filter);
        })->get();
        return $documents;
    }

}