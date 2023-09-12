<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationCreateRequest;
use App\Http\Requests\ApplicationUpdateRequest;
use App\Services\ApplicationService;

class ApplicationController extends Controller
{
    private ApplicationService $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function store(ApplicationCreateRequest $request)
    {
        $application = $this->applicationService->createApplication($request->validated());

        return response([
            'data' => $application
        ]);
    }

    public function update(ApplicationUpdateRequest $request, $id)
    {
        if ($this->applicationService->responseApplication($request, $id)) {
            return response()->json(['message' => 'Заявка успешно обновлена']);
        } else {
            return response()->json(['message' => 'Заявка не найдена'], 404);
        }
    }

    public function index($status = null)
    {
        return response([
            'data' => $this->applicationService->getApplications($status),
        ]);
    }
}
