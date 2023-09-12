<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\ApplicationUpdateRequest;
use App\Models\Application;

interface ApplicationRepositoryInterface
{

    public function all();

    public function create($data);

    public function getById($id);

    public function response(Application $application, ApplicationUpdateRequest $data);

    public function filterByStatus(string $status);

}
