<?php

namespace App\Repositories;

use App\Helpers\StatusState;
use App\Http\Controllers\MailController;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;

class ApplicationRepository implements ApplicationRepositoryInterface
{

    public function create($data)
    {
        return Application::create($data);
    }

    public function all()
    {
        return Application::all();
    }

    public function getById($id)
    {
        return Application::where('id', $id)->first();
    }

    public function response(Application $application, $data)
    {
        $application->update([
            'comment' => $data['comment'],
            'status' => StatusState::Resolved,
        ]);
        $application->touch();
        MailController::send($application->email, $application->name, $data['comment']);
    }

    public function filterByStatus(string $status)
    {
        return Application::where('status', $status)->get();
    }
}
