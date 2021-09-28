<?php

namespace App\Repositories\System;

use App\Models\System\Country;
use App\Models\System\DocumentGroup;
use App\Repositories\BaseRepository;

class DocumentGroupRepository extends BaseRepository
{
    const MODEL = DocumentGroup::class;


    /**
     * @param $id
     * @return mixed
     * Get documents belong to document group provided
     */
    public function getDocumentsByGroup($id)
    {
        $document_group = $this->find($id);
        $documents = $document_group->documents;
        return $documents;
    }




}