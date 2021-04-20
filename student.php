<?php
  include('./class/Student.php');
  $method = $_SERVER["REQUEST_METHOD"];
  $student = new Student();

  switch($method) {
    case 'GET':
      $id = $_GET['id'];
      if (isset($id)) 
      {
        $student = $student->find($id);
        $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      }else 
      {
        $students = $student->all();
        $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
      }
      header("Content-Type: application/json");
      echo($js_encode);
      break;

    case 'POST': 
      $numStudent = count($student->all());
      $result = $student->all();

      $student->_id = $result[$numStudent-1]['id']+1;
      $student->_name = $_POST["name"];
      $student->_surname = $_POST["surname"];
      $student->_sidiCode = $_POST["sidi_code"];
      $student->_taxCode = $_POST["tax_code"];
      $student->add($student);
      echo "Studente inserito correttamente";
      break;

    case 'DELETE': 
      $URI = explode('/', $_SERVER["REQUEST_URI"]); 
      $student->delete($URI[count($URI)-1]);
      echo "Studente eliminato correttamente";
      break;

    case 'PUT': 
      $URI = explode('/', $_SERVER["REQUEST_URI"]);  
      if(count($URI) != 0)
      {
        $body = file_get_contents("php://input");
        $js_decoded = json_decode($body, true);

        $student->_id = $URI[count($URI)-1];
        $student->_name = $js_decoded["_name"];
        $student->_surname = $js_decoded["_surname"];
        $student->_sidiCode = $js_decoded["_sidiCode"];
        $student->_taxCode = $js_decoded["_taxCode"];
        $student->update($student);
        echo "Dati studente modificati";
      }
      else echo "ID non inserito";
      break;

    default: 
      echo "Metodo non valido"; 
      break;
  }
?>
