<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

use App\Photo;

class PhotosController extends Controller
{







  public function store(Request $request)
  {
    $rules = [
      'photo' => 'required',
      'photoDescription' => 'required'
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if($validator->fails())
    {
      return Response::json(['error' => 'Please upload image.']);
    }

    $photoInput = $request->file('photo');
    $photoName = $photoInput->getClientOriginalName();
    $photoInput->move("storage/", $photoName);
    $description = $request->input('photoDescription');

    $photo = new Photo;
    $photo->description = $description;
    $photo->photoURL = $request->root(). "/storage/".$photoName;
    $photo->save();

    return Response::json(['success' => 'Your Photo was Uploaded.']);
  }

  public function getPhotos(Request $request)
  {
    $photos = Photo::all();
    return Response::json(['photos' => $photos]);
  }






}
