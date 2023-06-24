<?php
/*Create Api For Students */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller {
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    /*Show all student data*/
    public function index() {
      $students = Student::all();
      return response()->json([
          'status'=>200,
          'students'=>$students
      ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /*Add Student Information */
    public function store(Request $request) {

        $validator = validator::make($request->all(), [
            'usr_name' => ['required', 'min:2', 'max:100'],
            'usr_email' => ['required', 'unique:gur_student', 'max:100'],
            'usr_phone' => ['required', 'unique:gur_student', 'min:10', 'max:10'],
        ]);  /*Add Student Information Validation*/
        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        } else {

            $studentObj = new Student();            /*Call Student Model and Create an object*/
            $studentObj->usr_name = $request->usr_name;                /*set user name*/
            $studentObj->usr_email = $request->usr_email;              /*set user email*/
            $studentObj->usr_phone = $request->usr_phone;              /*set user phone*/
            $studentObj->usr_status = $request->usr_status;            /*set user status*/
            $studentObj->save();                     /* Store Student Information Function */
            return response()->json([
                'status' => 200,
                'message' => 'Student Create Successfully',
            ], 200);/* Send Response */
        }
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $student = Student::find($id);
        if(!empty($student))
        {
            return response()->json([
                'status'=>200,
                'students'=>$student
            ]);
        }else
        {
            return response()->json([
                'status'=>404,
                'students'=>"Id is not found"
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
//        print_r($request->usr_name);die;
        $student = Student::find($id);
        if(!empty($student))
        {
            $student->usr_name = $request->usr_name;                /*set user name*/
            $student->usr_email = $request->usr_email;              /*set user email*/
            $student->usr_phone = $request->usr_phone;              /*set user phone*/
            $student->usr_status = $request->usr_status;            /*set user status*/
            $student->update();
            return response()->json([
                'status'=>200,
                'students'=>"Student Update Successfully."
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'students'=>"Id is not found"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
