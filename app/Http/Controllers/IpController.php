<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class IpController extends Controller
{
    public function ipAddress(Request $request)
    {
        $ip_front = $request->input('ip');
        $ip_back = $request->ip();
        $client = Client::where('ip_front', $ip_front)->orWhere('ip_back', $ip_back)->first();
        if (!$client) {
            Client::create([
                'ip_front' => $ip_front,
                'ip_back' => $ip_back,
                'content' => json_encode($request->all())
            ]);
        }
        return response()->json(['success' => true]);
    }
}
