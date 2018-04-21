<?php 

namespace App\Http\Plugins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Earning;
use Carbon\Carbon;

class OlyaEarnings extends Controller
{
	public function index()
	{
        $scope = [];

        $total = Earning::sum('price');

        $scope['total'] = $total;

		return view('plugins.olyaEarnings', $scope);
	}
} 