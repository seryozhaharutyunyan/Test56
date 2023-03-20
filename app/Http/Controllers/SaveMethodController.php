<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveMethod\StoreRequest;
use App\Models\Settings;
use Illuminate\Http\Request;

class SaveMethodController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if (empty($data[$data['name']])) {
            return response(['errors' => [$data['name'] => ["The $data[name] field is required"]]], 422);
        }

        if ($data['name'] === 'database') {
            $value = $data['database'];
        } else {
            $value = $data['email'];
        }

        $setting = Settings::where('name', $data['name'])->first();
        if (!empty($setting)) {
            $setting->update(
                [
                    'name' => $data['name'],
                    'value' => $value
                ]
            );
        } else {
            Settings::Create([
                'name' => $data['name'],
                'value' => $value
            ]);
        }


        return response($setting);
    }
}
