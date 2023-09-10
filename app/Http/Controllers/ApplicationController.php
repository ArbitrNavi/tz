<?php

namespace App\Http\Controllers;

use App\Helpers\StatusState;
use App\Http\Requests\ApplicationCreateRequest;
use App\Models\Application;
use DateTime;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(ApplicationCreateRequest $request)
    {
        $data = $request->validated();

        $application = Application::create($data);

        return response([
            'data' => $application
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        /** @var Application $application */
        $application = Application::where('id', $id)->first();

        if ($application) {
            $application->update([
                'comment' => $data['comment'],
                'status' => StatusState::Resolved,
            ]);

            $application->touch();

            MailController::send($application->email, $application->name, $data['comment']);

            return response()->json(['message' => 'Заявка успешно обновлена']);
        } else {
            return response()->json(['message' => 'Заявка не найдена'], 404);
        }
    }

    public function index($status = null)
    {
        $requests = Application::query();

        if ($status) {
            $requests->where('status', $status);
        }

        $requests = $requests->get();

        return response($requests);
    }
}
