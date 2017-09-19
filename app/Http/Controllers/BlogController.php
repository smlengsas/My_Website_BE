<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

use App\Blog;

class BlogController extends Controller
{

  public function index()
  {
    $blogs = Blog::orderBy('id', 'DESC')->get();

    return Response::json(['blogs' => $blogs]);
  }

  public function store(Request $request)
  {
    $rules = [
      'blogContent' => 'required',
      'blogTitle' => 'required',
      'blogCategory' => 'required'
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if($validator->fails())
    {
      return Response::json(['error' => 'Please fill out all fields.']);
    }

    $blogContent = $request->input('blogContent');
    $blogTitle = $request->input('blogTitle');
    $blogCategory = $request->input('blogCategory');

    $blog = new Blog;
    $blog->content = $blogContent;
    $blog->title = $blogTitle;
    $blog->category = $blogCategory;

    $blog->save();

    return Response::json(['blog' => $blog]);
  }

  public function show($id)
  {
    $blog = Blog::find($id);

    return Response::json(['blog' => $blog]);
  }

  public function getFirst()
  {
    $blog = Blog::first();

    return Response::json(['blog' => $blog]);
  }
}
