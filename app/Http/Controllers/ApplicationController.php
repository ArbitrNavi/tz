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
        $application = Application::where('id', $id)
                        ->update([
                            'comment' => $data['comment'],
                            'status' => StatusState::Resolved,
                            'updated_at' => $this->getCurrentDateTime() // Я знаю что есть какой-то метод touch который типо отмечает обновления но он у меня не заработал и я не могу понять почему, поэтому мне нужен более опытный программист который будет давать по шее за такие моменты
                        ]);

        return response([
            'application' => $application
        ]);
    }
    public function index()
    {
        $data = Application::all();

        return response([
            "data" => $data
        ]);
    }

    function getCurrentDateTime() {
        $currentDateTime = new DateTime();
        return $currentDateTime->format('Y-m-d H:i:s');
    }
}
