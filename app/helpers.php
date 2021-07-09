<?php
//This function required intervention image library
use Illuminate\Support\Facades\Log;

function SaveImageAllSizes($request, $dir){
    $lg_image = Image::make($request->file('image'))->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($request->file('image'))->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($request->file('image'))->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($request->file('image'))->fit(50);
    $xs_image->response('png');

    $image_name = $request->image->hashName();

    //$request->file('image')->store($dir, ['disk' => 'public']);
     // for local
     Storage::disk('public')->put('lg/' .$dir . $image_name, $lg_image);
     Storage::disk('public')->put('md/' .$dir. $image_name, $md_image);
     Storage::disk('public')->put('sm/' .$dir. $image_name, $sm_image);
     Storage::disk('public')->put('xs/'.$dir . $image_name, $xs_image);
    //for s3 bucket
    /*Storage::disk('s3')->put('lg/' .$dir . $image_name, $lg_image);
    Storage::disk('s3')->put('md/' .$dir. $image_name, $md_image);
    Storage::disk('s3')->put('sm/' .$dir. $image_name, $sm_image);
    Storage::disk('s3')->put('xs/'.$dir . $image_name, $xs_image);*/
}

function SaveJsonImageAllSizes($image_base64, $dir, $image_path){
    $lg_image = Image::make($image_base64)->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($image_base64)->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($image_base64)->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($image_base64)->fit(50);
    $xs_image->response('png');

    $image_name = $image_path;

    //$request->file('image')->store($dir, ['disk' => 'public']);
    // for local
    /*Storage::disk('public')->put('lg/'  . $image_name, $lg_image);
    Storage::disk('public')->put('md/' . $image_name, $md_image);
    Storage::disk('public')->put('sm/' . $image_name, $sm_image);
    Storage::disk('public')->put('xs/' . $image_name, $xs_image);*/
    //for s3 bucket
    Storage::disk('s3')->put('lg/'  . $image_name, $lg_image);
    Storage::disk('s3')->put('md/' . $image_name, $md_image);
    Storage::disk('s3')->put('sm/' . $image_name, $sm_image);
    Storage::disk('s3')->put('xs/' . $image_name, $xs_image);
}

//store posts Images
function SavePostJsonImageAllSizes($image_base64, $dir, $image_path){
    $lg_image = Image::make($image_base64)->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($image_base64)->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($image_base64)->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($image_base64)->fit(50);
    $xs_image->response('png');

    $image_name = $image_path;

    //$request->file('image')->store($dir, ['disk' => 'public']);
    // for local
    /*Storage::disk('public')->put('lg/'  . $image_name, $lg_image);
    Storage::disk('public')->put('md/' . $image_name, $md_image);
    Storage::disk('public')->put('sm/' . $image_name, $sm_image);
    Storage::disk('public')->put('xs/' . $image_name, $xs_image);*/
    //for s3 bucket
    Storage::disk('s3')->put('lg/'  . $image_name, $lg_image);
    Storage::disk('s3')->put('md/' . $image_name, $md_image);
    Storage::disk('s3')->put('sm/' . $image_name, $sm_image);
    Storage::disk('s3')->put('xs/' . $image_name, $xs_image);
}

function UpdateImageAllSizes($request, $dir, $old_image){
    //Delete old images
    	Storage::disk('public')->delete('lg/' . $old_image);
        Storage::disk('public')->delete('md/' . $old_image);
        Storage::disk('public')->delete('sm/' . $old_image);
        Storage::disk('public')->delete('xs/' . $old_image);
    //for s3 bucket
    /*Storage::disk('s3')->delete('lg/' . $old_image);
    Storage::disk('s3')->delete('md/' . $old_image);
    Storage::disk('s3')->delete('sm/' . $old_image);
    Storage::disk('s3')->delete('xs/' . $old_image);*/
    $lg_image = Image::make($request->file('profile_pic'))->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($request->file('profile_pic'))->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($request->file('profile_pic'))->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($request->file('profile_pic'))->fit(50);
    $xs_image->response('png');

    $image_name = $request->profile_pic->hashName();

     Storage::disk('public')->put('lg/' .$dir . $image_name, $lg_image);
     Storage::disk('public')->put('md/' .$dir. $image_name, $md_image);
     Storage::disk('public')->put('sm/' .$dir. $image_name, $sm_image);
     Storage::disk('public')->put('xs/'.$dir . $image_name, $xs_image);
    //for s3 bucket
    /*Storage::disk('s3')->put('lg/' .$dir . $image_name, $lg_image);
    Storage::disk('s3')->put('md/' .$dir. $image_name, $md_image);
    Storage::disk('s3')->put('sm/' .$dir. $image_name, $sm_image);
    Storage::disk('s3')->put('xs/'.$dir . $image_name, $xs_image);*/
}

function UpdateJsonImageAllSizes($image_base64, $dir, $image_path ,$old_image){
    //Delete old images
    /*Storage::disk('public')->delete('lg/' . $old_image);
    Storage::disk('public')->delete('md/' . $old_image);
    Storage::disk('public')->delete('sm/' . $old_image);
    Storage::disk('public')->delete('xs/' . $old_image);*/
    //for s3 bucket
    Storage::disk('s3')->delete('lg/' . $old_image);
    Storage::disk('s3')->delete('md/' . $old_image);
    Storage::disk('s3')->delete('sm/' . $old_image);
    Storage::disk('s3')->delete('xs/' . $old_image);

    $lg_image = Image::make($image_base64)->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($image_base64)->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($image_base64)->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($image_base64)->fit(50);
    $xs_image->response('png');

    $image_name = $image_path;

    /*Storage::disk('public')->put('lg/'  . $image_name, $lg_image);
    Storage::disk('public')->put('md/' . $image_name, $md_image);
    Storage::disk('public')->put('sm/' . $image_name, $sm_image);
    Storage::disk('public')->put('xs/' . $image_name, $xs_image);*/
    //for s3 bucket
    Storage::disk('s3')->put('lg/' . $image_name, $lg_image);
    Storage::disk('s3')->put('md/' . $image_name, $md_image);
    Storage::disk('s3')->put('sm/' . $image_name, $sm_image);
    Storage::disk('s3')->put('xs/'. $image_name, $xs_image);
}

function SaveBannerAllSizes($request, $dir){
    $lg_image = Image::make($request->file('bannerupload'))->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($request->file('bannerupload'))->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($request->file('bannerupload'))->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($request->file('bannerupload'))->fit(50);
    $xs_image->response('png');

    $image_name = $request->bannerupload->hashName();

    //$request->file('image')->store($dir, ['disk' => 'public']);
    /* // for local
     Storage::disk('public')->put('lg/' .$dir . $image_name, $lg_image);
     Storage::disk('public')->put('md/' .$dir. $image_name, $md_image);
     Storage::disk('public')->put('sm/' .$dir. $image_name, $sm_image);
     Storage::disk('public')->put('xs/'.$dir . $image_name, $xs_image);*/
    //for s3 bucket
    Storage::disk('s3')->put('lg/' .$dir . $image_name, $lg_image);
    Storage::disk('s3')->put('md/' .$dir. $image_name, $md_image);
    Storage::disk('s3')->put('sm/' .$dir. $image_name, $sm_image);
    Storage::disk('s3')->put('xs/'.$dir . $image_name, $xs_image);
}

function UpdateBannerAllSizes($request, $dir, $old_image){
    //Delete old images
    Storage::disk('public')->delete($dir . $old_image);
    Storage::disk('public')->delete($dir . 'lg/' . $old_image);
    Storage::disk('public')->delete($dir . 'md/' . $old_image);
    Storage::disk('public')->delete($dir . 'sm/' . $old_image);
    Storage::disk('public')->delete($dir . 'xs/' . $old_image);

    $lg_image = Image::make($request->file('banner'))->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($request->file('banner'))->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($request->file('banner'))->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($request->file('banner'))->fit(50);
    $xs_image->response('png');

    $image_name = $request->banner->hashName();

    $request->file('banner')->store($dir, ['disk' => 'public']);
    Storage::disk('public')->put($dir . 'lg/' . $image_name, $lg_image);
    Storage::disk('public')->put($dir . 'md/' . $image_name, $md_image);
    Storage::disk('public')->put($dir . 'sm/' . $image_name, $sm_image);
    Storage::disk('public')->put($dir . 'xs/' . $image_name, $xs_image);
}

function SavePhotoAllSizes($request, $dir){

    $lg_image = Image::make($request->file('photo'))->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($request->file('photo'))->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($request->file('photo'))->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($request->file('photo'))->fit(50);
    $xs_image->response('png');

    $image_name = $request->photo->hashName();

    $request->file('photo')->store($dir, ['disk' => 'public']);
    Storage::disk('public')->put($dir . 'lg/' . $image_name, $lg_image);
    Storage::disk('public')->put($dir . 'md/' . $image_name, $md_image);
    Storage::disk('public')->put($dir . 'sm/' . $image_name, $sm_image);
    Storage::disk('public')->put($dir . 'xs/' . $image_name, $xs_image);
}

function UpdatePhotoAllSizes($request, $dir, $old_image){
    //Delete old images
    Storage::disk('public')->delete($dir . $old_image);
    Storage::disk('public')->delete($dir . 'lg/' . $old_image);
    Storage::disk('public')->delete($dir . 'md/' . $old_image);
    Storage::disk('public')->delete($dir . 'sm/' . $old_image);
    Storage::disk('public')->delete($dir . 'xs/'. $old_image);

    $lg_image = Image::make($request->file('photo'))->fit(400);
    $lg_image->response('png');

    $md_image = Image::make($request->file('photo'))->fit(200);
    $md_image->response('png');

    $sm_image = Image::make($request->file('photo'))->fit(100);
    $sm_image->response('png');

    $xs_image = Image::make($request->file('photo'))->fit(50);
    $xs_image->response('png');

    $image_name = $request->photo->hashName();

    $request->file('photo')->store($dir, ['disk' => 'public']);
    Storage::disk('public')->put($dir . 'lg/' . $image_name, $lg_image);
    Storage::disk('public')->put($dir . 'md/' . $image_name, $md_image);
    Storage::disk('public')->put($dir . 'sm/' . $image_name, $sm_image);
    Storage::disk('public')->put($dir . 'xs/' . $image_name, $xs_image);
}

