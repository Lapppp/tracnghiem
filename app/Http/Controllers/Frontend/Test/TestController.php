<?php

namespace App\Http\Controllers\Frontend\Test;

use App\Http\Controllers\Controller;
use App\Repositories\Quiz\TestRepository;
use Illuminate\Http\Request;

class TestController extends Controller
{

    private $data = [];
    protected $testRepository;
    public function __construct(TestRepository $testRepository){
        $this->testRepository = $testRepository;
    }
    public function index( Request $request ){
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
       // \Mail::to('khanhnam99@gmail.com')->send(new \App\Mail\MyTestMail($details));

       // dd("Email is Sent.");
    }
}
