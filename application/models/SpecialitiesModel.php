<?php

class SpecialitiesModel
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
     * Get all specialities from database
     */
    public function getAllSpecialities()
    {
        $sql = "SELECT id, name FROM speciality";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a speciality to database
     */
    public function addSpeciality($name)
    {
        $sql = "INSERT INTO speciality (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name));
    }
}
