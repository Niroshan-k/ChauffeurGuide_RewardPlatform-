<?php

// app/Http/Controllers/RedemptionController.php

namespace App\Http\Controllers;

use App\Models\Redemption;
use App\Models\Guide;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RedemptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'guide_id' => 'required|exists:guides,id',
            'points' => 'required|integer|min:1',
        ]);

        $guide = Guide::findOrFail($request->guide_id);
        $remaining = $guide->pointsRemaining();

        if ($request->points > $remaining) {
            return response()->json(['message' => 'Not enough points.'], 400);
        }

        $redemption = Redemption::create([
            'guide_id' => $guide->id,
            'points' => $request->points,
            'redeemed_at' => Carbon::now(),
        ]);

        // TODO: Send WhatsApp notification to admin and guide

        return response()->json(['message' => 'Points redeemed.', 'redemption' => $redemption]);
    }

    public function history($guideId)
    {
        return Redemption::where('guide_id', $guideId)->orderByDesc('redeemed_at')->get();
    }
}
