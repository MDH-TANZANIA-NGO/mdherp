<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 6/26/19
 * Time: 9:43 AM
 */

namespace App\Repositories\System\Traits;


use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait DocumentResourceTrait
{
    public function getDocumentResourceInstance($pivot_id)
    {
        return DB::table('document_resource')->where("id", "=", $pivot_id)->first();
    }


    /**
     * @param Model $model
     * @param $input
     * Attach documents i.e TIN, certificates/
     * @throws GeneralException
     */
    public function attachDocuments(Model $model, $input)
    {
        foreach ($input as $key => $value) {
//            if (strlen($key) > 13 || strlen($key)< 15) {
            if (strpos($key, 'document_file') !== false) {
                $document_id = substr($key, 13);
                $key_file_name = 'document_file' . $document_id;
                $file = request()->file($key_file_name);
                $this->checkFileExtension($file);
                $this->checkFileSize($file);
                $this->savingDocument($model, $document_id, $key_file_name);
            }
//            }

        };

    }

    /**
     * Limit File Size
     * @param $file
     * @throws GeneralException
     */
    public function checkFileSize($file)
    {
        if(round($file->getSize() / 1024 / 1024, 1) > 5){
            throw new GeneralException("File size can be more than 5MB");
        }
    }

    /**
     * Allow PDF only
     * @param $file
     * @throws GeneralException
     */
    public function checkFileExtension($file)
    {
        if($file->getMimeType() != "application/pdf"){
            throw new GeneralException("File should be PDF not otherwise");
        }
    }

    /**
     * @param Model $model
     * @param $document_id => document id which is going to be attached i.e. logo, Tin
     * @param $file_key_name => name of input on the create request
     * Attach company document files i.e. tin, logo, certificates.
     */
    public function savingDocument(Model $model, $document_id, $file_key_name)
    {
        DB::transaction(function () use ($model, $file_key_name, $document_id) {
            /*Attach to document pivot table*/
            if (request()->hasFile($file_key_name)) {
                $file = request()->file($file_key_name);
                if ($file->isValid()) {
                    /*Check if already attached - if exist detach*/
                    $this->unlinkAttachmentFile($model, $document_id);
                    /*Save into pivot table*/
                    $model->documents()->syncWithoutDetaching([$document_id => [
                        'name' => $file->getClientOriginalName(),
                        'description' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                        'ext' => $file->getClientOriginalExtension(),
                        'is_active' => 1,
                    ]]);
                }
                $path = $this->base . DIRECTORY_SEPARATOR . $model->id . DIRECTORY_SEPARATOR . $document_id;
                $uploadedDocument = ($model->documents()->where('document_id', $document_id)->count()) ?
                    $model->documents()->where('document_id',$document_id)->first()->pivot : null ;
                /*Unlink if exist*/
                if ($uploadedDocument) {
                    $file_path = $model->attachmentFile($document_id);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                /*Save Document*/
                $this->saveDocument($model, $file_key_name, $path, $uploadedDocument);
            } else {
                return false;
            }
        });

    }

    /* Detach/unlink application attachment and attachment from directory*/
    public function unlinkAttachmentFile(Model $model, $document_id)
    {
        if ($model->documents()->where('document_id', $document_id)->count()){
            /*Detach attachment from dir*/
            $file_path = $model->attachmentFile($document_id);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

}
