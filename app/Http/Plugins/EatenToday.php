<?php 

namespace App\Http\Plugins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EatenFoodstuff;
use Carbon\Carbon;

class EatenToday extends Controller
{
	public function index()
	{
        $scope = [];

        $today = Carbon::today();
        $total = 0;

        $eatenFoodstuffs = EatenFoodstuff::where('created_at', '>', $today)->get();

        foreach ($eatenFoodstuffs as $eatenFoodstuff) {
            $calories = $eatenFoodstuff->foodstuff ? 
                $eatenFoodstuff->grams * $eatenFoodstuff->foodstuff->calories / 100
                : 0;

            $total += $calories;
        }

        $total = round($total);

        $scope['total'] = $total;

		return view('plugins.eatenToday', $scope);
	}

} 