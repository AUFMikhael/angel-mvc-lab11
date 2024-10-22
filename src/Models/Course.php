<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class Course extends BaseModel
{
    private $course_id;
    private $course_name;
    private $course_code;
    private $description;
    private $credits;
    private $department;

    // Method to get the course code
    public function getCourseCode()
    {
        return $this->course_code;
    }

    // Method to get the course name
    public function getCourseName()
    {
        return $this->course_name;
    }

    // Method to find a specific course by its course code
    public function find($course_code)
    {
        $sql = "SELECT * FROM courses WHERE course_code = :course_code";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':course_code', $course_code);
        $statement->execute();
        return $statement->fetchObject('\App\Models\Course'); // returns a course object or false if not found
    }

    // Method to fetch all courses and the number of enrolled students for each course
    public function all()
    {
        $sql = "
            SELECT 
                c.*, 
                COUNT(ce.student_code) AS enrolled_students
            FROM 
                courses c
            LEFT JOIN 
                course_enrollments ce ON c.course_code = ce.course_code
            GROUP BY 
                c.course_code
        ";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, '\App\Models\Course');
    }

    // Method to get all students enrolled in a specific course
    public function getEnrolees($course_code)
    {
        $sql = "
            SELECT 
                s.*
            FROM 
                course_enrollments AS ce
            LEFT JOIN 
                students AS s ON s.student_code = ce.student_code
            WHERE 
                ce.course_code = :course_code
        ";
        $statement = $this->db->prepare($sql);
        $statement->execute(['course_code' => $course_code]);
        return $statement->fetchAll(PDO::FETCH_CLASS, '\App\Models\Student'); // returns list of students
    }
    
}
