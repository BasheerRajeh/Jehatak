<?php

class UsersModel
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
     * Get all users from database
     */
    public function getAllUsers()
    {
        $sql = "SELECT id, email, password, name, image_url, role_id FROM user";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
	
	/**
     * Get last insert id from database
     */
    public function getLastInsertId()
    {
        $sql = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch is the PDO method that gets a result row
        return $query->fetch()->id;
    }
	
    /**
     * Add a user to database
     */
    public function addUser($email, $password, $name, $image_url, $role_id)
    {
        $sql = "INSERT INTO user (email, password, name, image_url, role_id) VALUES (:email, :password, :name, :image_url, :role_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':email' => $email, ':password' => $password, ':name' => $name, ':image_url' => $image_url, ':role_id' => $role_id));
    }
	
    /**
     * Get user from database
     */
    public function getUser($id)
    {
        $sql = "SELECT id, email, password, name, image_url, role_id FROM user WHERE id = $id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch is the PDO method that gets a result row
        return $query->fetch();
    }

	/**
     * Edit a user profile in database
     */
    public function editUserProfile($id, $name, $email, $hash, $image_url)
    {
		$sql = "UPDATE user SET name = '$name' WHERE id = '$id'";
        $query = $this->db->prepare($sql);
        $query->execute();
		
		$sql = "UPDATE user SET email = '$email' WHERE id = '$id'";
        $query = $this->db->prepare($sql);
        $query->execute();
		
		$sql = "UPDATE user SET password = '$hash' WHERE id = '$id'";
        $query = $this->db->prepare($sql);
        $query->execute();
		
		$sql = "UPDATE user SET image_url = '$image_url' WHERE id = '$id'";
        $query = $this->db->prepare($sql);
        $query->execute();
    }
}
