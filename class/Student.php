<?php
  include("DBConnection.php");
  
  class Student 
  {
    private $db;
    public $_id;
    public $_name;
    public $_surname;
    public $_sidiCode;
    public $_taxCode;

    public function __construct() {
      $this->db = new DBConnection();
      $this->db = $this->db->returnConnection();
    }

    //Get 
    public function find($id){
      $sql = "SELECT * FROM student WHERE id=:id;";
      $stmt = $this->db->prepare($sql);
      $data = [
        'id' => $id
      ];
      $stmt->execute($data);
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $result;
    }
    //Get all
    public function all(){
      $sql = "SELECT * FROM student;";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $result;
    }
    
    //Add 
    public function add($student){
      $sql = "INSERT INTO student (id, name, surname, sidi_code, tax_code) VALUES (:id, :name, :surname, :sidi_code, :tax_code);";
      $stmt = $this->db->prepare($sql);
      $data = [
        'id' => $student->_id,
        'name' => $student->_name,
        'surname' => $student->_surname,
        'sidi_code' => $student->_sidiCode,
        'tax_code' => $student->_taxCode
      ];
      $stmt->execute($data);
    }

    //Delete 
    public function delete($id){
      $sql = "DELETE FROM student WHERE id=:id;";
      $stmt = $this->db->prepare($sql);
      $data = [
        'id' => $id
      ];
      $stmt->execute($data);
    }

    //Update 
    public function update($student){
      $sql = "UPDATE student SET name = :name, surname = :surname, sidi_code = :sidi_code, tax_code = :tax_code WHERE id = :id;";
      $stmt = $this->db->prepare($sql);
      $data = [
        'id' => $student->_id,
        'name' => $student->_name,
        'surname' => $student->_surname,
        'sidi_code' => $student->_sidiCode,
        'tax_code' => $student->_taxCode
      ];
      $stmt->execute($data);
    }
  }
?>
