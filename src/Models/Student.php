<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class Student extends BaseModel
{
    private $student_id;
    private $student_code;
    private $first_name;
    private $last_name;
    private $email;
    private $date_of_birth;
    private $sex;

    // Method to get the student code
    public function getStudentCode()
    {
        return $this->student_code;
    }

    // Method to get the email
    public function getEmail()
    {
        return $this->email;
    }

    // Method to get the full name (first and last name concatenated)
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Method to find a student by their student code
    public function find($student_code)
    {
        $sql = "SELECT * FROM students WHERE student_code = :student_code";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':student_code', $student_code);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Student');
        return $statement->fetch(); // returns a single student object or false if not found
    }

    // Method to fetch all students (already implemented)
    public function all()
    {
        $sql = "SELECT * FROM students"; // Query to fetch all students
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC); // Return the result as an associative array
    }


}
