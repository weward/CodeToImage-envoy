<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CodeStyleCollection extends ResourceCollection
{
    /**
     * Default collection key
     * 
     * @var $wrap string|null
     */
    public static $wrap = 'data';

    /**
     * The resource that this resource collects
     */
    public $collects = CodeStyleResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  $this->collection; // CodeStyleResource
    }
}
