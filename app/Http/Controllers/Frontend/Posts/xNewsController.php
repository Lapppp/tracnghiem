<?php

namespace App\Http\Controllers\Frontend\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class xNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //https://hackthestuff.com/article/laravel-8-file-upload-and-download-example
        //$filePath = public_path("avatar/2021/12/13/p3aDKcTpNDiDQCpWBJmskgGz9VTvmCE6wr1AowDb.png");
        $filePath = storage_path('app/public/avatar/2021/12/13/ThoiGianThucHien.pdf');
        $headers = [
            'Content-Type: application/pdf',
            'Content-Type: image/png',
            'Content-Type: image/jpeg',
            'Content-Type: application/vnd.msword',
            'Content-Type: application/vnd.ms-excel',
            'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Type: application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'Content-Type: application/x-rar-compressed',
            'Content-Type: application/octet-stream',
            'Content-Type: application/zip',
            'Content-Type: application/x-zip-compressed',
            'Content-Type: multipart/x-zip',
            'Content-Type: application/x-rar',
            'Content-Type: application/vnd.rar',
        ];
       // header("Content-Type: image/png");
        $fileName = time().'.pdf';
        if (file_exists($filePath)){
            return response()->download($filePath, $fileName, $headers);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
