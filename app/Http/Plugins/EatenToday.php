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

        $pictures = [];
        $total = 0;
        $prev = null;

        $today = Carbon::now()->hour < 6
            ? Carbon::yesterday()->hour(6) 
            : Carbon::today()->hour(6);

        $eatenFoodstuffs = EatenFoodstuff::where('created_at', '>', $today)->
            orderBy('created_at', 'desc')->get();

        foreach ($eatenFoodstuffs as $eatenFoodstuff) {
            if (! $eatenFoodstuff->foodstuff) continue;

            $foodstuff = $eatenFoodstuff->foodstuff;

            $calories = $eatenFoodstuff->grams * $foodstuff->calories / 100;

            $diff = $prev 
                ? $eatenFoodstuff->created_at->diffInMinutes($prev->created_at)
                : 0;

            $pictures[] = [
                'name' => $foodstuff->name,
                'picture' => property($foodstuff, 'picture')->src('thumbnail'),
                'grams' => $eatenFoodstuff->grams,
                'calories' => round($calories, 1),
                'diff' => $diff,
            ];

            $total += $calories;

            $prev = $eatenFoodstuff;
        }

        $total = round($total);

        $scope['total'] = $total;
        $scope['pictures'] = $pictures;

		return view('plugins.eatenToday', $scope);
	}
} 