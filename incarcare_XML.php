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
        <h3><b>Incarcati fisierul XML</b></h3>
        <input type="file"  name="document" id="document"><br>
        <input type="submit" style="background-color: dodgerblue; color: white; border: dodgerblue;  margin-top: 20px">
    </form>
    <?php
        // $xml = simplexml_load_file("../proiect-xis/laborator_analize.xml");
        if (isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
            $xml = simplexml_load_file($_FILES['document']['tmp_name']);                        
        
        // $xml=simplexml_load_file("../proiect-xis/laborator_analize.xml") or die("Error: Cannot create object");
        $laborator = $xml->laborator;
        $contact = $laborator->contact;
        echo "<h3>Informatii cabinet:</h3>";
        echo "<p>Nume: $laborator->nume_laborator</p>";
        echo "<p>Contact: telefon $contact->telefon_laborator, email  $contact->email_laborator </p>";
        }

    ?>
    <!-- Tabelul cu medicii din laborator -->
    <br>
    
    <button type="button" class="collapsible">Vizualizare medici</button>
    <div class="content">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Intruduceti nume medic" title="Type in a name" style="padding:5px; margin-top:5px">
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
                    $xml = simplexml_load_file($_FILES['document']['tmp_name']);
               
                //     if(isset($_POST['search'])){
                //         $nume_medic = $_POST['nume'];
                //         foreach ($xml->medici->medic as $medic) {
                //             if(strcmp($medic->nume_medic, $nume_medic)==0){
                //                 echo "Nume: $medic->nume_medic ";
                //                 echo "Prenume: $medic->prenume_medic";
                //                 echo "Varsta: $medic->varsta_medic ";
                //                 echo "Vechime: $medic->vechime";
                //             }

                //     }
                // }
          
            

                foreach ($xml->medici->medic as $medic) {
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
    <!-- Tabelul cu pacientii din laborator -->
    <button type="button" class="collapsible">Vizualizare pacienti</button>
    <div class="content">
    <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Intruduceti nume pacient" title="Type in a name" style="padding:5px; margin-top:5px">
    <h1>Pacienti</h1>
     <div class="table-wrapper-scroll-y custom-scrollbar">
            <table class="table table-bordered" id="myTable2">
                <thead style="background-color: whitesmoke; font-size: 15px">
                <tr>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>CNP</th>
                    <th>Varsta</th>
                    <th>Telefon</th>
                    <th>Sex</th>
                    <th>Email</th>
                    <th>Istoric medical</th>
                </tr>
                </thead>
                <tbody>
                <?php
              if (isset($_FILES['document']) && ($_FILES['document']['error'] == UPLOAD_ERR_OK)) {
                $xml = simplexml_load_file($_FILES['document']['tmp_name']);
                foreach ($xml->pacienti->pacient as $pacient) {
                        echo "<tr>";
                    
                        
                        echo "<td>$pacient->nume_pacient</td>";
                        echo "<td>$pacient->prenume_pacient</td>";
                        echo "<td>$pacient->cnp</td>";
                        echo "<td>$pacient->varsta_pacient</td>";
                        echo "<td>$pacient->telefon_pacient</td>";
                        echo "<td>$pacient->sex</td>";
                        echo "<td>$pacient->email</td>";
                        echo "<td>";
                        foreach ($pacient->istoric_medical->vizita as $vizita){
                            echo "Analiza: $vizita->analiza_pacient <br>";
                            echo "Data efectuare: $vizita->data_efectuare <br>";
                            echo "Rezultat: $vizita->rezultat <br>";
                            echo "<br>";
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
   <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script>
function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
   </div>
</body>
</html>
