<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    <title>Biblioteka publiczna</title>
</head>
<body>
    <header>
        <h2>Miejska Biblioteka Publiczna
            w Książkowicach</h2>
    </header>

    <section id="left-block">
        <h2>Dodaj czytelnika</h2>

        <form action="biblioteka.php" method="POST">
            imię:<input type="text" name="name"> <br>
            nazwisko:<input type="text" name="lastname"> <br>
            rok urodzenia:<input type="number" name="birthYear"> <br> 

            <input type="submit" value="DODAJ" name="submit">

            <?php
                if(empty($_POST['submit']) == false)
                {

                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $birthYear = $_POST['birthYear'];
    
                    echo "Czytelnik: $lastname został dodany do bazy danych";
    
                    $code = substr(strtolower($name), 0, 2) . substr($birthYear, 2, 4) . substr(strtolower($lastname), 0, 2);

                    $conn = mysqli_connect('localhost', 'root', '', 'biblioteka');

                    $query = "INSERT INTO czytelnicy VALUES(null, '$name','$lastname', '$code')";
                    
                    mysqli_query($conn, $query);

                    mysqli_close($conn);
                }

            ?>
        </form>
    </section>

    <section id="middle-block">
        <img src="biblioteka.png" alt="biblioteka">
        <h4>ul. Czytelnicza 25 <br> 12-120 Książkowice <br> tel.: 123123123 <br> e-mail: <a href="mailto:biuro@bib.pl">biuro@bib.pl</a> </h4>

    </section>

    <section id="right-block">
        <h3>Nasi czytelnicy:</h3>
        <ul>
            <?php
                $conn = mysqli_connect('localhost', 'root', '', 'biblioteka');
                
                $query = "SELECT imie, nazwisko FROM czytelnicy";
                $result = mysqli_query($conn, $query);
                
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<li>$row[imie] $row[nazwisko]</li>";
                }

                mysqli_close($conn);
            ?>
        </ul>
    </section>

    <footer>
        <p>Projekt witryny: Franciszek Pawłowski</p>
    </footer>
</body>
</html>