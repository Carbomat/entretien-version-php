


  
   function reloadcsv() {
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
                    
                    table = buildTable(data.data, "Nombre de raccordable par code postal");
                    nombreRaccordableByCodePostal.innerHTML = table;
                }
            }).fail(function (xhr, textStatus, errorThrown) {
                alert("Une erreur est survenue durant la récupération des données");
            });
        }
           function searchcodeinsee(search) {
            $.ajax({
                method: "GET",
                url: "https://datanova.laposte.fr/api/records/1.0/search//?dataset=laposte_hexasmal&q=974&rows=1000",
                dataType: "json",
                data: {
                    "fonction": "getNombreRaccordablefor1CodePostal",
                    
                },
                beforeSend: function () {
                    nombreRaccordableByCodePostal.innerHTML = "";
                    nombreRaccordableByCodePostal.innerText = "Chargement des données en cours";
                }
            }).done(function (data) {
                
              
              // let tab2[] = data.records
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
            }).done(function (data2) {
                if (data2.status == true) {
                     console.log(data.records)
                    /*  */
                        let tabtest = []
  let somme=0
                     data.records.map(element => {
    element.fields.somme=0
   
   //CONDITIONS POUR FILTRER PAR NUMERO INSEE 
    if(element.fields.code_commune_insee == search){
      console.log(element.fields.code_postal)
      //CONDITIONS POUR SUPPRIMER LES DOUBLONS PAR CODE POSTAL
      if(tabtest.find(x => x.code_postal === element.fields.code_postal)==undefined)
      {
        
        data2.data.map(y => {
            if(element.fields.code_postal == y.CP){
             element.fields.somme = element.fields.somme + parseInt(y.NB_RACCORDABLE)
            }
        })
        somme = element.fields.somme + somme
      tabtest.push(element.fields)

    }
    }
  })
                     console.log("i hope",tabtest)
                    table = buildTable(tabtest, "Nombre de raccordable par code postal");
                    nombreRaccordableByCodePostal.innerHTML = table;
                }
            }).fail(function (xhr, textStatus, errorThrown) {
                alert("Une erreur est survenue durant la récupération des données");
            });
               
            }).fail(function (xhr, textStatus, errorThrown) {
                alert("Une erreur est survenue durant la récupération des données");
            });
        }
         function searchcodep(search) {
            $.ajax({
                method: "POST",
                url: "api/index.php",
                dataType: "json",
                data: {
                    "fonction": "getNombreRaccordablefor1CodePostal",
                    "datasearch":search
                },
                beforeSend: function () {
                    nombreRaccordableByCodePostal.innerHTML = "";
                    nombreRaccordableByCodePostal.innerText = "Chargement des données en cours";
                }
            }).done(function (data) {
                if (data.status == true) {
                    let tab = [{
     
        'CP': '',
        'NB_RACCORDABLE': ''
      }]
                    data.data.map(x => {
                        console.log("truetest",x.CP)
                        if(x.CP == search){
                        tab.push(x)
                    }
                    })
                   
                    table = buildTable(tab, "Nombre de raccordable par code postal");
                    nombreRaccordableByCodePostal.innerHTML = table;
                }
            }).fail(function (xhr, textStatus, errorThrown) {
                alert("Une erreur est survenue durant la récupération des données");
            });
        }
function searchcp(){
$('#search-insee').keyup(function(){
   
 
    var search = $(this).val();
      var data2 = [
      {
     
        'CP': 'Item 974',
        'NB_RACCORDABLE': 'test'
      },
      {

        'CP': 'Item 1',
        'NB_RACCORDABLE': 'halal'
      },
      
    ]
       
    
    if(search != ""){
    
          console.log(search)
          console.log(data2)
         // table = buildTable(data2, "Nombre de raccordable par code postal");
          //          nombreRaccordableByCodePostal.innerHTML = table;
         searchcodeinsee(search);
                 console.log(data) 
    } else {
      
           reloadcsv()
                   
    }

  })


  $('#search-cp').keyup(function(){
   
 
    var search = $(this).val();
      var data2 = [
      {
     
        'CP': 'Item 974',
        'NB_RACCORDABLE': 'test'
      },
      {

        'CP': 'Item 1',
        'NB_RACCORDABLE': 'halal'
      },
      
    ]
       
    
    if(search != ""){
    
          console.log(search)
          console.log(data2)
         // table = buildTable(data2, "Nombre de raccordable par code postal");
          //          nombreRaccordableByCodePostal.innerHTML = table;
         searchcodep(search);
                 console.log(data) 
    } else {
      
           reloadtest()
                   
    }

  })



    }

