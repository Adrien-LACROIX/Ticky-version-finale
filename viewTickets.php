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
  <div class="header">
  <a id="button_is_auth" class="button button1" href="profilAdministrateur.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> RETOUR PROFIL</a>
  <a id="button_is_auth" class="button button1" onClick="window.location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> ACTUALISER</a>
    </div>
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
          lignephp = JSON.parse(lignephp);

          let resolvedTicketsDisplayBox = document.getElementsByClassName('resolvedTicketContainer')[0];


          if (lignephp.length > 0) {
            resolvedTicketsDisplayBox.innerHTML = '';
            for (let item in lignephp) {
              var setStatus = "";
              var setClassColor = "";


              //Displayed on ticket
              let ligne = document.createElement('p');
              let statut = document.createElement('span');
              let id = document.createElement('span');
              let contexte = document.createElement('span');
              let date = document.createElement('span');
              let name = document.createElement('span');
              let btn = document.createElement("button");
              let answer = document.createElement("span");

              //Not displayed
              let ticketContent = document.createElement('span');

              //Get all ticket content
              btn.onclick = function() {
                toggleTicketView(this);
              };


              //Definition du statut
              if (lignephp[item][4] == 1) {


                setStatus = "RÉSOLU";
                setClassColor = "statutResolu";

              } else {
                setStatus = "SANS OBJET";
                setClassColor = "statutNonResolu"
              }

              ligne.style.color = "#fff";
              ligne.style.border = "9px solid #494e56";
              ligne.style.backgroundColor = "#494e56"
              id.innerText = lignephp[item][0]; //id
              id.style.fontWeight = "bold";
              statut.innerText = setStatus;
              statut.classList.add("statutColor");
              statut.classList.add(setClassColor);
              contexte.innerHTML = lignephp[item][5];
              contexte.style.fontWeight = "bold";
              date.innerText = lignephp[item][10];
              name.innerText = lignephp[item][7] + " " + lignephp[item][8];
              btn.innerHTML = "<i class=\"fa-solid fa-eye\"></i> CONSULTER";
              ticketContent.style.display = "none";
              ticketContent.innerHTML = lignephp[item][1];
              answer.innerHTML = lignephp[item][9];
              answer.style.display = "none";

              ligne.appendChild(statut);
              ligne.innerHTML += "&nbsp;";
              ligne.appendChild(id);
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
              ligne.appendChild(answer);
              resolvedTicketsDisplayBox.appendChild(ligne);
            }

          } else {
            resolvedTicketsDisplayBox.innerHTML = "<br><br><br><center><p style=\"color:white\"class=\"statutColor statutEnAttenteDeTickets\"><i class=\"fa fa-check\"></i>&nbsp;Tout va bien, Vous n'avez pas de nouveaux tickets!</center></p>";
          }
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
  </div>




<?php
}

?>
</body>

</html>