<?php

class StudentsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
	
	/**
     * Get all students from database
     */
    public function getAllStudents()
    {
        $sql = "SELECT id, name, email, universe_id FROM student JOIN user ON user.id = student.user_id ORDER BY id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Get accepted students from database
     */
    public function getAcceptedStudents()
    {
        $sql = "SELECT user.id AS student_id, user.name AS student_name, training_company.name AS training_company_name, speciality.name AS speciality_name, supervisor_user_id FROM (student JOIN user JOIN speciality ON user.id = student.user_id and student.speciality_id = speciality.id) JOIN training_company ON training_company.id = student.training_company_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * Get student from database
     */
    public function getStudent($user_id)
    {
        $sql = "SELECT universe_id, national_id, speciality_id, rate, training_company_id FROM student WHERE user_id = $user_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch is the PDO method that gets a result row
        return $query->fetch();
    }
	
	/**
     * Add a student to database
     */
    public function addStudent($user_id)
    {
        $sql = "INSERT INTO student (user_id) VALUES (:user_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
    }

    /**
     * Assign supervisor to student
     */
    public function assignSupervisor($user_id, $supervisor_id)
    {
		$sql = "UPDATE student SET supervisor_user_id = '$supervisor_id' WHERE user_id = '$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
    }

    /**
     * Assign training company to student
     */
    public function assignTrainingCompany($user_id, $training_id)
    {
		$sql = "UPDATE student SET training_company_id = '$training_id' WHERE user_id = '$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
    }

    /**
     * Check if student has accepted request or pending request
     */
    public function checkRequest($user_id){

        $sql = "
            select request.status
            from request join student on request.student_user_id = student.user_id
            where student.user_id = $user_id
            ORDER BY id DESC LIMIT 1;
        ";

        $query = $this->db->prepare($sql);

        $query->execute();

        $result = $query->fetch();

        return $result;

    }

    /**
     * Edit a student profile in database
     */
    public function editStudentProfile($id, $u_id, $n_id, $rate, $spec)
    {
        if (isset($u_id)) {
            $sql = "UPDATE student SET universe_id = '$u_id' WHERE user_id = '$id'";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
		
        if (isset($n_id)) {
            $sql = "UPDATE student SET national_id = '$n_id' WHERE user_id = '$id'";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
		
        if (isset($rate)) {
            $sql = "UPDATE student SET rate = '$rate' WHERE user_id = '$id'";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
		
        if (isset($spec)) {
            $sql = "UPDATE student SET speciality_id = '$spec' WHERE user_id = '$id'";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
    }
}
