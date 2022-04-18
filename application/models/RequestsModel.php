<?php

class RequestsModel
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
     * Get all requests from database
     */
    public function getAllRequests()
    {
        $sql = "SELECT id, status, message, student_user_id, training_company_id FROM request";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a request to database
     */
    public function addRequest($status, $message, $student_user_id, $training_company_id)
    {
        $sql = "INSERT INTO request (status, message, student_user_id, training_company_id) VALUES (:status, :message, :student_user_id, :training_company_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':status' => $status, ':message' => $message, ':student_user_id' => $student_user_id, ':training_company_id' => $training_company_id));
    }

    /**
     * Edit a request status to Accepted
     */
    public function acceptRequest($id)
    {
        $sql = "update request
                set status = 'Accepted'
                where id = $id
                ";

        $query = $this->db->prepare($sql);
        $query->execute();
    }

    /**
     * Edit a request status to Rejected
     */
    public function rejectRequest($id)
    {
        $sql = "update request
                set status = 'Rejected'
                where id = $id
                ";

        $query = $this->db->prepare($sql);
        $query->execute();
    }

    /**
     * Get studentId from database
     */
    public function getStudentId($request_id)
    {
        $sql = "SELECT student_user_id FROM request WHERE id = $request_id";
        $query = $this->db->prepare($sql);
        $query->execute();

		// fetch() is the PDO method that gets a result row
        return $query->fetch();
    }
}
