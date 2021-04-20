<!-- ESEMPIO curl --header "Content-Type: application/json" --request POST --data '{"_name":"Ciccio", "_surname":"Benve"}' http://localhost:8080  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>API REST PHP</title>
</head>
<body>
    <form action="student.php" method="GET">
        <label for="text_get_all">GET DI TUTTI GLI STUDENTI</label>
        <button type="submit" class="btn btn-primary">PROVA GET (Tutti)</button><br><br>
        
        <label for="text_get">GET DI UNO STUDENTE</label>
        <select name="id">
            <option selected disabled hidden value="">Id Studente</option>
            <?php
                include('./class/DBConnection.php');

                $db = new DBConnection;
                $db = $db->returnConnection();
                $sql = "SELECT id FROM student ORDER BY id ASC;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                foreach($result as $key)
                {   
                    echo '<option value="' . $key['id'] . '">' . $key['id'] . '</option>';
                }   
            ?>
        </select>
        <button type="submit" class="btn btn-primary">GET DI UNO STUDENTE</button>
    </form> 
    <br><br>
    <form action="student.php" method="POST">
        <legend>Inserisci studente</legend>
        <label id="text_name">Nome:</label>
        <input type="text" name="name" required><br>
        <label id="text_surname" >Cognome:</label>
        <input type="text" required name="surname"><br>
        <label for="text_sidi_cod">Sidi cod:</label>
        <input type="text" name="sidi_code" required><br>
        <label for="text_tax_cod">Tax cod:</label>
        <input type="text" name="tax_code" required><br>
        <button type="submit" class="btn btn-primary">Aggiungi</button>
        <button type="reset" class="btn btn-danger">Annulla</button> 
    </form>
</body>
</html>