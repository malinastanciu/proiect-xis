<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./dashboard.css">
    <link rel="stylesheet" href="./bootstrap_v341.min.css">
    <style>
        .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        }

        .active, .collapsible:hover {
        background-color: #555;
        }

        .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
        }
        form{
            width: 400px;
            margin-top: 20px;
            padding: 10px;
            height: 200px;
            background-color: #dddddd;
            border-radius: 10px;
        }
        input{
            width: 100%;
            clear: both;
            height: 30px;
        }
        p{
            font-size: 15px;
            margin-top: -3px;
        }
    </style>

</head>
<title>
    Dashboard
</title>
<body>
<div class="topnav">
  <a href="./dashboard.php">Acasa</a>
  <a href="./incarcare_XML.php">Incarcare XML</a>
  <a href="./incarcare_Json.php">Incarcare JSON</a>
  <a href="./vizualizare_tabel.php">Vizualizare tabele</a>
</div>
    <form action="" method="POST" enctype="multipart/form-data" style="margin-left:5px">
        <h3><b>Incarcati fisierul Json</b></h3>
        <input type="file"  name="document" id="document"><br>
        <input type="submit" style="background-color: dodgerblue; color: white; border: dodgerblue;  margin-top: 20px">
    </form>
    <br>
    <?php
        if (isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
            $json1 = file_get_contents($_FILES['document']['tmp_name']);   
            $json = json_decode($json1);             
        
        // $xml=simplexml_load_file("../proiect-xis/laborator_analize.xml") or die("Error: Cannot create object");
        $laborator = $json->laborator;
        $contact = $laborator->contact;
        echo "<h3>Informatii cabinet:</h3>";
        echo "<p>Nume: $laborator->nume_laborator</p>";
        echo "<p>Contact: telefon $contact->telefon_laborator, email  $contact->email_laborator </p>";
        }

    ?>

<!-- Tabelul cu analizele din laborator -->
    <button type="button" class="collapsible">Vizualizare categorii de analize</button>
    <div class="content">
        <h1><b>Categorii de analize</b></h1>
        <?php
         if (isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
            $json1 = file_get_contents($_FILES['document']['tmp_name']);   
            $json = json_decode($json1); 

        foreach ($json->categorii as $categorie) {
            echo "<h1>$categorie->nume_categorie</h1>";
            echo "<h3>Analize:</h3>";
            foreach ($categorie->analize as $analiza){
                echo "<b>Nume analiza:</b> $analiza->nume_analiza<br>";
                echo "<b>Descriere:</b> $analiza->descriere<br>";
                echo "<b>Indicatii:</b> $analiza->indicatii<br>";
                echo "<b>Pret:</b> $analiza->pret de lei<br>";
                echo "<b>Interpretare nivel scazut</b><br>";
                echo "<b>Valoare:</b>";
                echo $analiza->interpretare->nivel_scazut->valoare_ns;
                echo "<br>";
                echo "<b>Boala:</b>";
                echo $analiza->interpretare->nivel_scazut->boala_ns;
                echo "<br>";
                echo "<b>Interpretare nivel ridicat</b><br>";
                echo "<b>Valoare:</b>";
                echo $analiza->interpretare->nivel_ridicat->valoare_nr;
                echo "<br>";
                echo "<b>Boala:</b>";
                echo $analiza->interpretare->nivel_ridicat->boala_nr;
                echo "<br>";
                echo "<br>";
                echo "<br>";
            }
        }
    }
        ?>
     </div>

    <!-- Tabelul cu medicii din laborator -->
    <br>
    <button type="button" class="collapsible">Vizualizare medici</button>
    <div class="content">
    <h1>Medici</h1>
     <div class="table-wrapper-scroll-y custom-scrollbar">
            <table class="table table-bordered" id="myTable">
                <thead style="background-color: whitesmoke; font-size: 15px">
                <tr>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Varsta</th>
                    <th>Vechime</th>
                    <th>Specializari</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
                    $json1 = file_get_contents($_FILES['document']['tmp_name']);   
                    $json = json_decode($json1);   
               
          
            

                foreach ($json->medici as $medic) {
                        echo "<tr>";
                    
                        
                        echo "<td>$medic->nume_medic</td>";
                        echo "<td>$medic->prenume_medic</td>";
                        echo "<td>$medic->varsta_medic</td>";
                        echo "<td>$medic->vechime</td>";
                        echo "<td>";
                        foreach ($medic->specializare as $specializare){
                            echo "$specializare <br>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

   <script>
       var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
              content.style.display = "none";
            } else {
              content.style.display = "block";
            }
          });
        }
   </script>
   </div>
</body>
</html>
