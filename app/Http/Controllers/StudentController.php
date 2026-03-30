<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $response = Http::post('https://quiztoxml.ucas.edu.ps/api/login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $data =  $response->json();
        if ($data['success'] == false) {
            return response()->json([
                'message' => $data['message']
            ]);
        }

       
        $student = new student();

        $student->student_number = $data['data']['user_id'];
        $student->student_name   = $data['data']['user_ar_name'];
        $student->token          = $data['Token'];

        $student->save();

        return response()->json([
            'message' => 'تم تسجيل الدخول وتخزين البيانات بنجاح'
        ]);
    }

    public function sign_up(Request $request)
    {
        $response = Http::post('https://quiztoxml.ucas.edu.ps/api/get-table', [
            'student_number' => $request->student_number,
            'token' => $request->token,
        ]);
        

        return  $response->json();
    }
    
    public function index()
    {
        //
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
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        //
    }
}