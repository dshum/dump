<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
	public function __construct()
	{
		// $this->middleware('guest');
	}

	public function index(Request $request)
	{
		$scope = [];

		if ($request->has('make_test_error')) {
			1/0;
		}

		return view('welcome', $scope);
	}
} 