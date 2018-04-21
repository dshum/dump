<?php 

namespace App\Http\Plugins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weight;
use Carbon\Carbon;

class WeightChart extends Controller
{
	public function index()
	{
        $scope = [];

        $weights = Weight::orderBy('created_at', 'asc')->get();

        $total = sizeof($weights);

        $labels = [];
        $data1 = [];
        $data2 = [];
        $colors = [];

        $labelsWeekly = [];
        $dataWeeklyMin = [];
        $dataWeeklyMax = [];

        foreach ($weights as $k => $weight) {
            $labels[] = '"'.$weight->created_at->format('m/d').'"';
            $data1[] = $weight->weight;

            if ($k == 0) {
                $data2[$k] = ($weights[0]->weight + $weights[0]->weight + $weights[1]->weight) / 3;
            } elseif ($k == $total - 1) {
                $data2[$k] = ($weights[$total - 2]->weight + $weights[$total - 2]->weight + $weights[$total - 1]->weight) / 3;
            } else {
                $data2[$k] = ($weights[$k - 1]->weight + $weights[$k]->weight + $weights[$k + 1]->weight) / 3;
            }
            
            if ($weight->weight > 93) {
                $colors[] = '"orangered"';
            } elseif ($weight->weight > 92) {
                $colors[] = '"orange"';
            } elseif ($weight->weight > 91) {
                $colors[] = '"skyblue"';
            } else {
                $colors[] = '"yellowgreen"';
            }

            if ($weight->created_at->dayOfWeekIso == 2) {
                $labelsWeekly[] = '"'.$weight->created_at->format('m/d').'"';
                $dataWeeklyMax[] = $weight->weight;
            } elseif ($weight->created_at->dayOfWeekIso == 3) {
                $dataWeeklyMin[] = $weight->weight;
            }
        }

        $labels = implode(', ', $labels);
        $data1 = implode(', ', $data1);
        $data2 = implode(', ', $data2);
        $colors = implode(', ', $colors);
        $labelsWeekly = implode(', ', $labelsWeekly);
        $dataWeeklyMax = implode(', ', $dataWeeklyMax);
        $dataWeeklyMin = implode(', ', $dataWeeklyMin);

        $scope['labels'] = $labels;
        $scope['data1'] = $data1;
        $scope['data2'] = $data2;
        $scope['colors'] = $colors;
        $scope['labelsWeekly'] = $labelsWeekly;
        $scope['dataWeeklyMax'] = $dataWeeklyMax;
        $scope['dataWeeklyMin'] = $dataWeeklyMin;

		return view('plugins.weightChart', $scope);
	}
} 