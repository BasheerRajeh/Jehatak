<?php

class SupervisorsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all supervisors from database
     */
    public function getAllSupervisors()
    {
        $sql = "SELECT user_id, name, email FROM supervisor JOIN user ON supervisor.user_id = user.id";
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
     * Get supervisor from database
     */
    public function getSupervisor($user_id)
    {
        $sql = "SELECT national_id ,user.name
                FROM supervisor join user on supervisor.user_id = user.id
                WHERE user_id = $user_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch is the PDO method that gets a result row
        return $query->fetch();
    }

    /**
     * Get student's supervisor
     */
    public function getSupervisorStudents($id)
    {
        $sql = "
            select user.name as name, training_company.name as company, training_company.id as comId
            from student join user on user.id = student.user_id
            join training_company on training_company.id = student.training_company_id
            where student.supervisor_user_id = $id";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }

    /**
     * Add a supervisor to database
     */
    public function addSupervisor($user_id, $national_id)
    {
        $sql = "INSERT INTO supervisor (user_id, national_id) VALUES (:user_id, :national_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':national_id' => $national_id));
    }

    /**
     * Edit a supervisor profile in database
     */
    public function editSupervisorProfile($id, $n_id)
    {
        if (isset($n_id)) {
            $sql = "UPDATE supervisor SET national_id = '$n_id' WHERE user_id = '$id'";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
    }
}
