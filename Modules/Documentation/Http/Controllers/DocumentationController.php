<?php

namespace Modules\Documentation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DocumentationController extends Controller
{

    public function index()
    {
        return view('documentation::docs.index');
	}
	
}
