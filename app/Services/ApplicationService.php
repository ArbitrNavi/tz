<?php

namespace App\Services;

use App\Http\Requests\ApplicationUpdateRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Database\Eloquent\Collection;

class ApplicationService
{
    private ApplicationRepository $applicationRepository;

    public function __construct(
        ApplicationRepository $applicationRepository
    )
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function createApplication($data): Application
    {
        return $this->applicationRepository->create($data);
    }

    public function getAllApplications(): Collection
    {
        return $this->applicationRepository->all();
    }

    public function getApplicationById(int $id)
    {
        return $this->applicationRepository->getById($id);
    }

    public function responseApplication(ApplicationUpdateRequest $request, $id): bool
    {
        $data = $request->validated();

        $application = $this->applicationRepository->getById($id);

        if ($application) {
            $this->applicationRepository->response($application, $data);
            return true;
        } else {
            return false;
        }
    }

    public function getApplications($status)
    {
        $applications = [];

        if ($status) {
            $applications = $this->applicationRepository->filterByStatus($status);
        } else {
            $applications = $this->applicationRepository->all();
        }

        return $applications;
    }
}
