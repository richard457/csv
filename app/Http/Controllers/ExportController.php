<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Models\Students;
class ExportController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        return view('hello');
    }

    /**
     * View all students found in the database
     */
    public function viewStudents()
    {
        $students = Students::with('course')->get();
        return view('view_students', compact(['students']));
    }

    /**
     * Exports all student data to a CSV file
     */
    public function exportStudentsToCSV($type='csv')
    {
            $students = Students::with('course')->get()->toArray();
            return Excel::create('myCsv',function($excel) use ($data){
                $excel->sheet('myCsv',function($sheet) use ($data){
                    $sheet->fromArray($data);
                });
            })->download((String)$type);
    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     */
    public function exporttCourseAttendenceToCSV($type='csv')
    {
        $students = Students::with('course')->get()->toArray();
            return Excel::create('myCsv',function($excel) use ($data){
                $excel->sheet('myCsv',function($sheet) use ($data){
                    $sheet->fromArray($data);
                });
            })->download((String)$type);
    }
}
