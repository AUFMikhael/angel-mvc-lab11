<?php

namespace App\Controllers;

use App\Models\Student;
use App\Controllers\BaseController;

class StudentController extends BaseController
{

    public function list()
    {
        $obj = new Student();
        $students = $obj->all(); // Retrieve all students
    
        // Map 'id' to 'student_id' for consistency with the template
        foreach ($students as &$student) {
            $student['student_id'] = $student['id']; // Add student_id for Mustache
        }
    
        $template = 'students'; // Template name (students.mustache)
        $data = [
            'items' => $students // Passing students as 'items'
        ];
    
        $output = $this->render($template, $data); // Render with Mustache
        return $output;
    }
    
}