<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationCreateRequest;
use App\Models\Application;
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
    public function update()
    {

    }
    public function index()
    {

    }
}
