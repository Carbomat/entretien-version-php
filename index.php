<!DOCTYPE html>
<html>
<head>
    <title>TEST01</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/default.css">
</head>
<body>
    <?php include('menu.html'); ?>
    <div id="toolbar">

</div>
<div  class="container">
      <form style="margin-bottom: 50 px;">
  <div style="margin-top: 50 px;"  class="form-row">
    <div class="col">
      <input  style="margin-bottom: 50 px;" type="text" id="search-cp" class="form-control" placeholder="Recherche par code postale">
    </div>
    <div class="col">
      <input type="text" id="search-insee" style="margin-bottom: 50 px;" class="form-control" placeholder="Recherche par code insee">
    </div>
  </div>
</form>

<div  style="margin-top:50px;"  >
      <button id="remove" class="btn btn-success" >
    <i class="fa fa-trash"></i> Rafraichir la page
  </button>
   <div style="margin-top:50px;cursor:pointer" class="col" id="nombreRaccordableByCodePostal">
    </div>
<div id="map"></div>
</div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
  <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUNwQ3clGV5C3f-dJEFZrFE1jb8eulRNw&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<style>
  .select,
  #locale {
    width: 100%;
  }
  .like {
    margin-right: 10px;
  }
</style>


    <script src="./js/searchcodeinsee.js">/*  Script permettant de faire des recherches par code postal et code insee  */</script>
    <script>

        function buildTable(data, title) {
            let content = document.createElement("div");
            let table_title = document.createElement('h3');
            let table = document.createElement('table');
       

            table_title.innerHTML = title;
            header = Object.keys(data[0]);
            header_html = ["<tr>"];
            for(let i =0; i < header.length; i++) {
                header_html.push("<th>" + header[i] + "</th>");
            }
            header_html.push("</tr>");
            table.innerHTML += header_html.join('');

            for(let i = 0; i < data.length; i++) {
                let content_html = ["<tr>"];
                for(let j=0; j < header.length; j++) {
                    content_html.push("<td>" + data[i][header[j]] + "</td>");
                }
                content_html.push('</tr>');
                table.innerHTML += content_html.join('');
            }
            return [table_title.outerHTML,table.outerHTML].join('');
        }

        function reloadNombreRaccordableByCodePostal() {
            $.ajax({
                method: "POST",
                url: "api/index.php",
                dataType: "json",
                data: {
                    "fonction": "getNombreRaccordableByCodePostal"
                },
                beforeSend: function () {
                    nombreRaccordableByCodePostal.innerHTML = "";
                    nombreRaccordableByCodePostal.innerText = "Chargement des données en cours";
                }
            }).done(function (data) {
                if (data.status == true) {
                    var $table2 = $('#table2')
                    $table2.bootstrapTable({data: data.data})
                    console.log("mat",data)
                        
                    table = buildTable(data.data, "Nombre de raccordable par code postal");
                    nombreRaccordableByCodePostal.innerHTML = table;
                }
            }).fail(function (xhr, textStatus, errorThrown) {
                alert("Une erreur est survenue durant la récupération des données");
            });
        }

        var nombreRaccordableByCodePostal = document.getElementById('nombreRaccordableByCodePostal');

        $(document).ready(function () {
            reloadNombreRaccordableByCodePostal();
         /*  Fonction recherche qui s'active lorsqu'on tape quelque chose dans les input  */ 
          searchcp();
         
        });
    </script>
</body>
</html>
