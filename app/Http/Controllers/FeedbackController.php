<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreRequest;
use App\Mail\FeedbackMail;
use App\Models\Feedback;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $text = date('d.m.Y H:i:s') . "=> name: $data[name] pone: $data[pone] appeal: $data[appeal]\n\n";

        $path = storage_path('log.txt');
        if (!file_exists($path)) {
            file_put_contents($path, $text);
        } else {
            $content = file_get_contents($path);
            $content .= $text;
            file_put_contents($path, $content);
        }

        $settings = Settings::all();
        foreach ($settings as $setting) {
            if ($setting->name === 'email') {
                Mail::to($setting->value)->send(new FeedbackMail($text));
            } else if ($setting->name === 'database') {
                $set = explode('/', $setting->value);
                $x = trim($set[1]);
                DB::connection()
                    ->table(trim($set[0]) . "." . trim($set[1]))
                    ->insert($data);
            }
        }

        Feedback::create($data);
    }
}
