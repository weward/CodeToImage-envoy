<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\CodeLanguageCollection;
use App\Services\User\CodeLanguageService;
use Illuminate\Http\Request;

class CodeLanguageController extends Controller
{
    public function __construct(protected CodeLanguageService $service) {}

    public function index()
    {
        $data = $this->service->getcodeLanguages();

        return response()->jsonApi(new CodeLanguageCollection($data), 200);
    }
}
