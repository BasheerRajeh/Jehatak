<?php

class MessagesModel
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
     * Get all messages from database
     */
    public function getAllMessages()
    {
        $sql = "SELECT id, text, training_company_id FROM message";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a message to database
     */
    public function addMessage($text, $training_company_id)
    {
        $sql = "INSERT INTO message (text, training_company_id) VALUES (:text, :training_company_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':text' => $text, ':training_company_id' => $training_company_id));
    }
}
