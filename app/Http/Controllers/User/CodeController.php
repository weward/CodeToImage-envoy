<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CodeRequest;
use App\Http\Resources\CodeCollection;
use App\Http\Resources\CodeResource;
use App\Models\Code;
use App\Services\User\CodeService;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    protected $service;

    public function __construct(CodeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $res = $this->service->getCodes();

        return response()->jsonApi(new CodeCollection($res), 200);
    }

    public function store(CodeRequest $request)
    {
        $res = $this->service->save($request);

        return response()->jsonApi($res, "Saving Failed!");
    }

    public function view(Request $request, Code $code)
    {
        return response()->jsonApi(new CodeResource($code), "Entity not found!", 404);
    }

    public function update(CodeRequest $request, Code $code)
    {
        $res = $this->service->update($request, $code);

        return response()->jsonApi(new CodeResource($res), "Updating failed!");
    }

    public function destroy(Request $request, Code $code)
    {
        info($code);
        $res = $this->service->destroy($code->id);

        return $res 
            ? response()->jsonApi("Deleted successfully!", 200)
            : response()->jsonApi("Failed to delete!", 500);

    }

}
