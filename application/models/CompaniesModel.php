<?php

class CompaniesModel
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
     * Get all training companies from database
     */
    public function getAllCompanies()
    {
        $sql = "SELECT user_id, email, training_company.name AS name, image_url FROM training_company JOIN user ON user.id = training_company.user_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Get company from database
     */
    public function getCompany($id)
    {
        $sql = "SELECT user_id, email, training_company.name AS name, image_url FROM (training_company JOIN user ON user.id = training_company.user_id) WHERE training_company.id = $id";
        $query = $this->db->prepare($sql);
        $query->execute();

		// fetch() is the PDO method that gets a result row
        return $query->fetch();
    }

    /**
     * Get companyId from database
     */
    public function getCompanyId($user_id)
    {
        $sql = "SELECT id FROM training_company WHERE user_id = $user_id";
        $query = $this->db->prepare($sql);
        $query->execute();

		// fetch() is the PDO method that gets a result row
        return $query->fetch();
    }

	/**
     * Add a training company to database
     */
    public function addCompany($user_id, $name)
    {
        $sql = "INSERT INTO training_company (user_id, name) VALUES (:user_id, :name)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':name' => $name));
    }

    /**
     * Edit a training company profile in database
     */
    public function editCompanyProfile($user_id, $name)
    {
        $sql = "UPDATE training_company SET name = '$name' WHERE user_id = '$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
    }

    /**
     * Get company's students
     */
    public function getCompanyStudents($id)
    {
        $sql = "select student.user_id, user.name, request.message, request.id, request.status
               from student join user on student.user_id = user.id
               join request on student.user_id = request.student_user_id
               join training_company on training_company.id = request.training_company_id
               Where training_company.user_id = $id";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }

    /**
     * Get company's supervisors
     */
    public function getSupervisorsInfo($id)
    {
        $sql = "
            select DISTINCT user.name, message.id, message.text
            from user join supervisor on user.id = supervisor.user_id
            join student on student.supervisor_user_id = supervisor.user_id
            join training_company on training_company.id = student.training_company_id
            join message on training_company.id = message.training_company_id
            Where training_company.user_id = $id";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }

    /**
     * Check if id is for company
     */
    public function isCompany($id)
    {
        $sql = "
            select id
            from training_company
            where training_company.user_id = $id";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $query->fetchAll();

        return count($result) > 0;
    }

    /**
     * Get company by name
     */
    public function getCompanyName($id)
    {
        $sql = "
            select name
            from training_company
            where training_company.id = $id";

        $query = $this->db->prepare($sql);
        $query->execute();

        $resutl = $query->fetch();

        return $resutl;
    }
}
