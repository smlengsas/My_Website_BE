<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use response;
use Purifier;

class BlogController extends Controller
{
  public function index ()
  {
    $data = "  ";

    return Response::json(['data' => $data]);
  }
}
