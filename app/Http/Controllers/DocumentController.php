<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DocumentController extends Controller
{
    use  ApiResponseTrait;


    public function index()
    {
        $document = DocumentResource::collection(Document::get());
        return $this->apiResponse($document, 'ok', 200);
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make( $input, [
            'name' =>['nullable',],
            'applicant_id' =>'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $file_name=$this->saveImage($request->name,'images/applicant');

        $document =Document::query()->create([
            'name'=>$file_name,
            'applicant_id'=>$request->applicant_id,
        ]);
        if ($document) {
            return $this->apiResponse(new  DocumentResource($document), 'the document  save', 201);
        }
        return $this->apiResponse(null, 'the document  not save', 400);
    }
    public function show($id)
    {
        $document= Document::find($id);
        if($document){
            return $this->apiResponse(new  DocumentResource($document) , 'ok' ,200);
        }
        return $this->apiResponse(null ,'the document not found' ,404);
    }

    public function update(Request $request,  $id)
    {
        $document= Document::find($id);
        if(!$document)
        {
            return $this->apiResponse(null ,'the document not found ',404);
        }

          $document->update($request->all());
          $file_name=$this->saveImage($request->name,'images/applicant');
           $document->name= $file_name;
           $document->update(['name' => $file_name]);

        if($document)
        {return $this->apiResponse(new  DocumentResource($document) , 'the document update',201); }
    }
    public function destroy($id)
    {
        $document= Document::find($id);
        if(!$document)
        {
            return $this->apiResponse(null ,'the document not found ',404);
        }
        $document->delete($id);
        if($document)
            return $this->apiResponse(null ,'the document deleted ',200);
    }
}
