<?php

namespace App\Controllers;

use App\Models\Course;
use App\Controllers\BaseController;

class CourseController extends BaseController
{
    public function list()
    {
        $obj = new Course();
        $courses = $obj->all(); // Fetch all courses and their enrollees count

        $template = 'courses'; // Use the courses.mustache template
        $data = [
            'items' => $courses // Pass courses to the template as 'items'
        ];

        return $this->render($template, $data);
    }
}
