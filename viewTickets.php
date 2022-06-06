<?php

include_once("template.php");
include_once("session.php");
include_once("conDB.php");
include_once("showTextLimit.php");
include_once("getTicketContent.php");
session_start();

?>

<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://kit.fontawesome.com/0adc6b23f3.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="laroda.jpg" type="image/x-icon">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="getTicketContent.js"></script>
  <script type="text/javascript" src="toggleTicketView.js"></script>
  <script type="text/javascript" src="switchDev.js"></script>

</head>

<?php
if (!$_SESSION['is_auth'] || !$_SESSION['is_admin']) { ?>
  <title>La Roda - 404 :(</title>
  <div style="position: fixed; bottom: 290px; right: 720; width: -110px; text-align:left;">
    <div class="ErrorContainer">
      <strong style="font-size:10vw">404 </strong>
      <p>La page que vous demandez n'est pas acessible
    </div>
    <center><a class="button button1" href="main.php"></i> Revenir au menu</a>
      <center>
  </div> <?php } ?>

<?php
if ($_SESSION['is_auth'] && $_SESSION['is_admin']) {
?>

  <title>Gestion de tickets</title>

  <!-- GET NEW TICKETS -->

  <script>
    let lastTicketList = [];
    loadTickets();
    setInterval('loadTickets()', 2500);

    function loadTickets() {

      $.ajax({
        url: "getTicketsList.php",
        type: "POST",
        data: "statut=0",
        success: function(lignephp) {
          // console.log(JSON.parse(lignephp))
          lignephp = JSON.parse(lignephp);

          var test = getSignature(lastTicketList)
          var test2 = getSignature(lignephp)

          lastTicketList = lignephp;


          let messages = document.getElementsByClassName('newTicketContainer')[0];
          let getNewTicketsCount = document.getElementById('nbNewTickets');

          getNewTicketsCount.innerHTML = lignephp.length;

          if (test != test2) {

            //console.log("loaded")
            if (lignephp.length > 0) {
              messages.innerHTML = '';
              for (let item in lignephp) {

                if (lignephp[item][4] == 0) {

                  //Displayed on ticket
                  let ligne = document.createElement('p');
                  let statut = document.createElement('span');
                  let id = document.createElement('span');
                  let contexte = document.createElement('span');
                  let date = document.createElement('span');
                  let toolTip = document.createElement('div');
                  let displayTooltip = document.createElement('span');
                  let clock = document.createElement('span');
                  let clockDisplay = document.createElement('i');
                  let name = document.createElement('span');
                  let displayTicket = document.createElement("button");
                  let spaceBetweenBtn = document.createElement("span");
                  let displaySwitchDev = document.createElement("button");


                  //Not displayed
                  let ticketContent = document.createElement('span');

                  //Get all ticket content
                  displayTicket.onclick = function() {
                    getTicket(this);
                  };

                  displaySwitchDev.onclick = function() {
                    switchDev(this);
                  };

                  //Algo de detection du retard d'un ticket
                  var currentDate = d.getTime();
                  var ticketDate = new Date(lignephp[item][6]).getTime(); //Recup date du ticket
                  var minus = (currentDate - ticketDate); //Fait la difference entre deux les dates
                  let long = (minus) / (1000 * 60 * 60 * 24) //Convertis les millis en jours
                  const event = new Date(ticketDate); //Date en francais
                  const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                  };

                  frenchDate = event.toLocaleDateString('fr-FR', options);

                  var createdAt;
                  var setVisibility;

                  if (Math.trunc(long) != 0) {

                    var createdAt = "Il y a " + Math.trunc(long) + " jours";
                    var setVisibility = "display";
                    var setColor = "ad212f";

                  } else {
                    var createdAt = " Créé aujourd'hui";
                    var setVisibility = "none";
                    var setColor = "white";
                  }

                  ligne.style.color = setColor;
                  ligne.style.border = "9px solid #494e56";
                  ligne.style.backgroundColor = "#494e56"
                  id.innerText = lignephp[item][0]; //id
                  id.style.fontWeight = "bold";
                  statut.innerHTML = "SOUMIS";
                  statut.classList.add("statutColor");
                  statut.classList.add("statutSubmited");
                  contexte.innerHTML = lignephp[item][5];
                  contexte.style.fontWeight = "bold";
                  date.innerText = createdAt;
                  date.style.fontStyle = "italic";
                  toolTip.classList.add("tooltip")
                  clock.style.display = setVisibility;
                  clock.style.fontSize = "18px";
                  clock.style.content = "f00d";
                  clockDisplay.classList.add("fa");
                  clockDisplay.classList.add("fa-clock-o");
                  clockDisplay.classList.add("fa-fade");
                  clockDisplay.setAttribute("aria-hidden", "true");
                  name.innerText = lignephp[item][7] + " " + lignephp[item][8];
                  displayTooltip.classList.add("tooltiptext");
                  // displayTooltip.classList.add("fa");
                  //displayTooltip.classList.add("fa-clock-o");
                  displayTooltip.innerHTML = "<i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Ce ticket date du <br>" + frenchDate;
                  displayTicket.innerHTML = "<i class=\"fa-solid fa-pencil\"></i> RÉSOUDRE";
                  spaceBetweenBtn.innerHTML = "&nbsp;"
                  displaySwitchDev.innerHTML = "<i class=\"fa-solid fa-repeat\"></i> TRANSFÉRER";
                  ticketContent.style.display = "none";
                  ticketContent.innerHTML = lignephp[item][1];



                  clock.appendChild(clockDisplay);
                  toolTip.appendChild(displayTooltip);
                  toolTip.appendChild(clock);


                  ligne.appendChild(statut); //Statut
                  ligne.innerHTML += "&nbsp;";
                  ligne.appendChild(toolTip); //Pendule
                  ligne.innerHTML += "&nbsp;";
                  ligne.appendChild(id); // Id
                  ligne.innerHTML += " [";
                  ligne.innerHTML += "&nbsp;";
                  ligne.appendChild(contexte);
                  ligne.innerHTML += " ]";
                  ligne.innerHTML += "&nbsp;";
                  ligne.appendChild(date);
                  ligne.innerHTML += "&nbsp;";
                  ligne.innerHTML += "de&nbsp;";
                  ligne.appendChild(name);
                  ligne.innerHTML += "&nbsp;";
                  ligne.appendChild(displaySwitchDev);
                  ligne.appendChild(spaceBetweenBtn);
                  ligne.appendChild(displayTicket);
                  ligne.appendChild(ticketContent);
                  messages.appendChild(ligne);
                }
                // console.log(item)
              }
            } else {
              messages.innerHTML = "<br><br><br><center><p style=\"color:white\"class=\"statutColor statutEnAttenteDeTickets\"><i class=\"fa fa-check\"></i>&nbsp;Tout va bien, Vous n'avez pas de nouveaux tickets!</center></p>";
            }
          }
        }
      });

    }

    /* Get resolved tickets */

    loadResolvedTickets();
    setInterval('loadResolvedTickets()', 2500);

    function loadResolvedTickets() {

      $.ajax({
        url: "getTicketsList.php",
        type: "POST",
        data: "statut=1",
        success: function(lignephp) {
          //console.log(JSON.parse(lignephp))
          lignephp = JSON.parse(lignephp);

          //  var test = getSignature(lastTicketList)
          //   var test2 = getSignature(lignephp)

          // lastTicketList = lignephp;


          let resolvedTicketsDisplayBox = document.getElementsByClassName('resolvedTicketContainer')[0];
          //let getNewTicketsCount = document.getElementById('nbNewTickets');

          //getNewTicketsCount.innerHTML = lignephp.length;

          // if (test != test2) {



          if (lignephp.length > 0) {
            resolvedTicketsDisplayBox.innerHTML = '';
            for (let item in lignephp) {

              var setStatus = "";
              var setClassColor = "";
              var createdAt;
              var frenchDate;
              var long;
              var currentDate;
              var programmedArchivageDate;



              //Recup de la date de resolution du ticket en ms
              //  var resolvedDate = new Date(lignephp[item][10]).getTime();
              // var programmedArchivageDate = tomorrow.setDate(today.getDate() + 2);


              var archivageDays = (programmedArchivageDate) / (1000 * 60 * 60 * 24) //Convertis les millis en jours


              //Algo de detection du retard d'un ticket


              var setArchiveDay = 10;
              var setNotif = Math.floor(setArchiveDay / 2);

              var jour = new Date(); //date du jour
              var simulation = new Date();
              var res = new Date(lignephp[item][10]).getTime(); //Recup date du ticket
              const jour2 = new Date(lignephp[item][10]); //date du jour 10

              var t2 = jour2.setDate(jour2.getDate() + setArchiveDay); //ajout de 10 jours a date du jour

              var sim = simulation.setDate(simulation.getDate() + 10);

              var resolution = new Date(res).toLocaleDateString('fr-FR')
              var datej = new Date(jour).toLocaleDateString('fr-FR')
              var date2 = new Date(t2).toLocaleDateString('fr-FR')
              var simDt = new Date(sim).toLocaleDateString('fr-FR')

              // console.log("jour actuel " + datej);
              // console.log("resolution " + resolution);
              // console.log("resolution plus 10 " + date2);
              // console.log("sim date " + new Date(sim).toLocaleDateString('fr-FR'))

              var diffTime = Math.abs(t2 - sim);
              var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
              var final = setArchiveDay - diffDays;

              // console.log("Difference de jours " + diffDays);
              // // console.log("Notif displayed on " + setNotif)
              // console.log("simulateur de jour " + simDt);

              // console.log("if (" + diffDays + " <= " + setNotif + " )" + " { " + "diffDays = " + diffDays + " } ")
              // console.log("final " + final);

              // console.log("resolution " + resolution);
              // console.log("date jour " + datej)
              // console.log("date resolution plus dix " + date2);
              //console.log(d2)
              //console.log(d3)
              //console.log(calc)


              // console.log("if (" + simDt + " == " + date2 + " )" + " { " + "diffDays = " + ms + " } ")

              if (simDt == t2) {
                diffDays = 0;
              //  console.log("-> " + "in")
                // console.log("if (" + simDt + " == " + date2 + " )" + " { " + "diffDays = " + ms + " } ")
              } else if (simDt > t2) {
                diffDays = -1;
                // console.log("if (" + simDt + " > " + date2 + " )" + " { " + "diffDays = " + ms + " } ")
              }

              //Displayed on ticket
              let ligne = document.createElement('p');
              let statut = document.createElement('span');
              let id = document.createElement('span');
              let contexte = document.createElement('span');
              let date = document.createElement('span');
              let toolTip = document.createElement('div');
              let displayTooltip = document.createElement('span');
              let clock = document.createElement('span');
              let clockDisplay = document.createElement('i');
              let name = document.createElement('span');
              let btn = document.createElement("button");

              //Not displayed
              let ticketContent = document.createElement('span');

              //Get all ticket content
              btn.onclick = function() {
                toggleTicketView(this);
              };
/*
              console.log("-> " + diffDays)
              console.log("simDt -> " + simDt)
              console.log("date2 -> " + date2)*/

              var resolved;

              if (diffDays <= setNotif && diffDays > 1) {

                var archivingIn = "Ce ticket sera automatiquement archivé dans <b>" + diffDays + " jours</b>";
                var setVisibility = "display";
                var setColor = "ad212f";

              } else if (diffDays == 1) {
                var archivingIn = "Ce ticket sera automatiquement archivé <b>" + diffDays + " jour</b>";
                var setVisibility = "display";
                var setColor = "ad212f";

              } else if (diffDays == 0) {
                var archivingIn = "Ce ticket sera automatiquement archivé <b>Aujourd'hui</b>";
                var setVisibility = "display";
                var setColor = "ad212f";

              } else if (diffDays == -1) {
                var archivingIn = "Ce ticket est <b>archivé</b>";
                var setVisibility = "display";
                var setColor = "ad212f";

              } else {
                var setVisibility = "none";
                var setColor = "black";
              }


              //Definition du statut
              if (lignephp[item][4] == 1) {


                setStatus = "RÉSOLU";
                setClassColor = "statutResolu";

              } else {
                setStatus = "SANS OBJET";
                setClassColor = "statutNonResolu"
              }

              // ligne.style.color = setColor;
              id.innerText = lignephp[item][0]; //id
              id.style.fontWeight = "bold";
              statut.innerText = setStatus;
              statut.classList.add("statutColor");
              statut.classList.add(setClassColor);
              contexte.innerHTML = lignephp[item][5];
              contexte.style.fontWeight = "bold";
              date.innerText = lignephp[item][10];
              //  date.style.fontStyle = "italic";
              toolTip.classList.add("tooltip")
              clock.style.display = setVisibility;
              clock.style.fontSize = "18px";
              clock.style.content = "f00d";
              clockDisplay.classList.add("fa");
              clockDisplay.classList.add("fa-archive");
              clockDisplay.setAttribute("aria-hidden", "true");
              name.innerText = lignephp[item][7] + " " + lignephp[item][8];
              displayTooltip.classList.add("tooltip");
              displayTooltip.classList.add("tooltiptext2");
              // displayTooltip.classList.add("fa");
              // displayTooltip.classList.add("fa-archive");
              displayTooltip.innerHTML = "<i class=\"fa fa-archive\"></i> " + archivingIn;
              btn.innerHTML = "<i class=\"fa-solid fa-eye\"></i> CONSULTER";
              ticketContent.style.display = "none";
              ticketContent.innerHTML = lignephp[item][1];


              clock.appendChild(clockDisplay);
              toolTip.appendChild(displayTooltip);
              toolTip.appendChild(clock);


              ligne.appendChild(statut); //Statut
              ligne.innerHTML += "&nbsp;";
              ligne.appendChild(toolTip); //Pendule
              ligne.innerHTML += "&nbsp;";
              ligne.appendChild(id); // Id
              ligne.innerHTML += " [";
              ligne.innerHTML += "&nbsp;";
              ligne.appendChild(contexte);
              ligne.innerHTML += " ]";
              ligne.innerHTML += "&nbsp;";
              ligne.appendChild(date);
              ligne.innerHTML += "&nbsp;";
              ligne.innerHTML += "de&nbsp;";
              ligne.appendChild(name);
              ligne.innerHTML += "&nbsp;";
              ligne.appendChild(btn);
              ligne.appendChild(ticketContent);
              resolvedTicketsDisplayBox.appendChild(ligne);
            }
            // console.log(item)
          } else {
            resolvedTicketsDisplayBox.innerHTML = "<br><br><br><center><p style=\"color:white\"class=\"statutColor statutEnAttenteDeTickets\"><i class=\"fa fa-check\"></i>&nbsp;Tout va bien, Vous n'avez pas de nouveaux tickets!</center></p>";
          }
          // }
        }
      });

    }

    /*Update tickets list */
    function getSignature(currArray) {

      var signature = 0;

      if (currArray[0]) {

        for (let item in currArray) {

          var getTicketsDate = currArray[item][6];

          formatedTicketDate = getTicketsDate.replace(/-/g, "");
          //console.log(formatedTicketDate)

          signature += Number(formatedTicketDate);
          signature += Number(currArray[item][0]);
          signature += currArray[item][1].length

        }

        return signature;
      }
    }
  </script>

  <!-- TICKETS -->
  <h2>Nouveaux Tickets (<span id="nbNewTickets"></span>):</h2>
  <div class="newTicketContainer"></div>


  <!-- RESOLVED TICKETS -->
  <h2>Tickets Résolus:</h2>
  <div class="resolvedTicketContainer"></div>


  <?php
  /*
    if ($result->num_rows > 0) {
      //  echo($result->num_rows);
      while ($row = $result->fetch_assoc()) {

        if ($row['statut'] == 1) {
          echo "<div><p class=\"statutColor statutResolu\">RÉSOLU</p>
             <text class=\"ticketContent\"> <span style=\"display: none;\">" . $row["statut"] . "</span>
           <b>" . $row["idTicket"] . "</b> [<b>" . $row["titreTicket"] . "</b>
            ] | " . $row['dateCreationTicket'] . " | de <i>" . $row['nomEmetteurTicket'] . " " . $row['prenomEmetteurTicket'] . "</i> 
            <button type=\"button\" onclick=\"toggleTicketView(this);\">CONSULTER <i class=\"fa fa-eye\"></i></button>
                <i style=\"display:none;\">" . $row["solutionTicket"] . "</i>
            <span id=\"test\"  style=\"display:none;\">" . $row["contenuTicket"] . "</span>
            </text><br></div>";
        } else if ($row['statut'] == 2) {
          echo "<div><p class=\"statutColor statutNonResolu\">SANS OBJET</p>
              <text class=\"ticketContent\"> <span style=\"display: none;\">" . $row["statut"] . "</span>
              <b>" . $row["idTicket"] . "</b> [<b>" . $row["titreTicket"] . "</b>
               ] | " . $row['dateCreationTicket'] . " | de <i>" . $row['nomEmetteurTicket'] . " " . $row['prenomEmetteurTicket'] . "</i> 
               <button type=\"button\" onclick=\"toggleTicketView(this);\">CONSULTER <i class=\"fa fa-eye\"></i></button>
               <i style=\"display:none;\">" . $row["solutionTicket"] . "</i>
               <span id=\"test\"  style=\"display:none;\">" . $row["contenuTicket"] . "</span>
               </text><br></div>";
        } else if ($row['statut'] == 3) {
          echo "<div><p class=\"statutColor statutArchive\">ARCHIVÉ</p>
              <text class=\"ticketContent\"> <span style=\"display: none;\">" . $row["statut"] . "</span>
              <b>" . $row["idTicket"] . "</b> [<b>" . $row["titreTicket"] . "</b>
               ] | " . $row['dateCreationTicket'] . " | de <i>" . $row['nomEmetteurTicket'] . " " . $row['prenomEmetteurTicket'] . "</i> 
               <button type=\"button\" onclick=\"toggleTicketView(this);\">CONSULTER <i class=\"fa fa-eye\"></i></button>
               <i style=\"display:none;\">" . $row["solutionTicket"] . "</i>
               <span id=\"test\"  style=\"display:none;\">" . $row["contenuTicket"] . "</span>
               </text><br></div>";
        }
      }
    ?>

    <?php
    } else {
      echo "<br><br><br><center><p style=\"color:white\"class=\"statutColor statutEnAttenteDeTickets\"><i class=\"fa fa-clock-o\"></i> En attente de nouveaux tickets..</center></p>";
    }

    $conn->close();
*/
  ?>
  </div>
  <br><br><br><br>

  <a id="button_is_auth" class="button button1" href="profilAdministrateur.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> RETOUR PROFIL</a>
  <a id="button_is_auth" class="button button1" onClick="window.location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> ACTUALISER</a>
  <a id="button_is_auth" class="button button1" href="stats.php"><i class="fa fa-arrow-up" aria-hidden="true"></i> STATS</a>



<?php
}

?>
</body>

</html>