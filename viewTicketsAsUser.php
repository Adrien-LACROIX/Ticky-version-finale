<?php
include_once("template.php");
include_once("session.php");
include_once("conDB.php");
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0adc6b23f3.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="laroda.jpg" type="image/x-icon">
    <script type="text/javascript" src="getTicketContentAsUser.js"></script>
    <script type="text/javascript" src="toggleTicketView.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

</html>

<body>
    <?php
    if (!$_SESSION['is_auth'] || $_SESSION['is_admin']) { ?>
        <title>La Roda - 404 :(</title>
        <div style="position: fixed; bottom: 290px; right: 720; width: -110px; text-align:left;">
            <div class="ErrorContainer">
                <strong style="font-size:10vw">404 </strong>
                <p>La page que vous demandez n'est pas acessible
            </div>
            <center><a class="button button1" href="main.php"></i> Revenir au menu</a>
                <center>
        </div> <?php }

            if ($_SESSION['is_auth'] && !$_SESSION['is_admin']) {
                ?>

        <title>Mes tickets</title>
        <div class="header">
        <a href="profilEmploye.php"><button class="button main_page">MON PROFIL</button></a>
      <a href="createTicket.php"><button class="button main_page">CRÉER UN TICKET</button></a>
      <a href="viewTicketsAsUser.php"><button class="button selected_page">MES TICKETS</button></a>
        </div>


        <!-- GET NEW TICKETS -->

        <script>
            let lastTicketList = [];
            loadUserTickets();
            setInterval('loadUserTickets()', 2500);

            function loadUserTickets() {

                $.ajax({
                    url: "getTicketsAsUser.php",
                    type: "POST",
                    data: "statut=0",
                    success: function(lignephp) {
                        //  console.log("->" + JSON.parse(lignephp))
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

                                    //   console.log(lignephp[item])
                                    //   if (lignephp[item][4] == 0) {

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
                                    let getTicketId = document.createElement('span');
                                    // let displaySwitchDev = document.createElement("button");


                                    //Not displayed
                                    let ticketContent = document.createElement('span');

                                    //Get all ticket content
                                    displayTicket.onclick = function() {
                                        toggle_text(this);
                                        // console.log("CLICKED")
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
                                        var setVisibility = "none";
                                        var setColor = "white";

                                    } else {
                                        var createdAt = " Créé aujourd'hui";
                                        var setVisibility = "display";
                                        var setColor = "white";
                                    }

                                    ligne.style.border = "9px solid #494e56";
                                    ligne.style.backgroundColor = "#494e56"
                                    ligne.style.color = setColor;
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
                                    clockDisplay.classList.add("fa-star");
                                    // clockDisplay.classList.add("fa-fade");
                                    clockDisplay.setAttribute("aria-hidden", "true");
                                    name.innerText = lignephp[item][7] + " " + lignephp[item][8];
                                    // displayTooltip.classList.add("tooltiptext");
                                    displayTooltip.classList.add("tooltiptext3");
                                    // displayTooltip.classList.add("fa");
                                    //  displayTooltip.classList.add("fa-clock-o");
                                    displayTooltip.innerHTML = "<i class=\"fa fa-star\" aria-hidden=\"true\"></i> Ce ticket est nouveau! <br>";
                                    displayTicket.innerHTML = "<i class=\"fa-solid fa-eye\"></i> CONSULTER";
                                    spaceBetweenBtn.innerHTML = "&nbsp;"
                                    // displaySwitchDev.innerHTML = "<i class=\"fa-solid fa-repeat\"></i> CONSULTER";
                                    ticketContent.style.display = "none";
                                    ticketContent.innerHTML = lignephp[item][1];
                                    getTicketId.style.display = "none";
                                    getTicketId.innerHTML = lignephp[item][4];



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
                                    // ligne.appendChild(displaySwitchDev);
                                    ligne.appendChild(spaceBetweenBtn);
                                    ligne.appendChild(displayTicket);
                                    ligne.appendChild(ticketContent);
                                    ligne.appendChild(getTicketId);
                                    messages.appendChild(ligne);
                                }
                                // console.log(item)
                            }
                            // } else {
                            //     messages.innerHTML = "<br><br><br><center><p style=\"color:white\"class=\"statutColor statutEnAttenteDeTickets\"><i class=\"fa fa-check\"></i>&nbsp;Tout va bien, Vous n'avez pas de nouveaux tickets!</center></p>";
                            // }
                        }
                    }
                });

            }

            /* Get resolved tickets */

            loadResolvedTickets();
            setInterval('loadResolvedTickets()', 2500);

            function loadResolvedTickets() {

                $.ajax({
                    url: "getTicketsAsUser.php",
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
                                let getTicketId = document.createElement('span');
                                let blankSpace = document.createElement('span');
                                let getTicketSupportAnswer = document.createElement('span');

                                //Not displayed
                                let ticketContent = document.createElement('span');

                                //Get all ticket content
                                btn.onclick = function() {
                                    toggle_text(this);
                                };

                                //Definition du statut
                                if (lignephp[item][4] == 1) {


                                    setStatus = "RÉSOLU";
                                    setClassColor = "statutResolu";

                                } else {
                                    setStatus = "SANS OBJET";
                                    setClassColor = "statutNonResolu"
                                }

                                ligne.style.border = "9px solid #494e56";
                                ligne.style.backgroundColor = "#494e56"
                                ligne.style.color = "#fff";
                                id.innerText = lignephp[item][0]; //id
                                id.style.fontWeight = "bold";
                                statut.innerText = setStatus;
                                statut.classList.add("statutColor");
                                statut.classList.add(setClassColor);
                                contexte.innerHTML = lignephp[item][5];
                                contexte.style.fontWeight = "bold";
                                date.innerText = " le " + lignephp[item][6];
                                name.innerText = lignephp[item][7] + " " + lignephp[item][8];
                                btn.innerHTML = "<i class=\"fa-solid fa-eye\"></i> CONSULTER";
                                ticketContent.style.display = "none";
                                blankSpace.innerHTML = "&nbsp;"
                                ticketContent.innerHTML = lignephp[item][1];
                                getTicketId.style.display = "none";
                                getTicketId.innerHTML = lignephp[item][4];
                                getTicketSupportAnswer.innerHTML = lignephp[item][9];
                                getTicketSupportAnswer.style.display = "none";


                                ligne.appendChild(statut);
                                ligne.innerHTML += "&nbsp;";
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
                                ligne.appendChild(getTicketId);
                                ligne.appendChild(blankSpace);
                                ligne.appendChild(getTicketSupportAnswer);
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
        <h2>Tickets soumis (<span id="nbNewTickets"></span>):</h2>
        <div class="newTicketContainer"></div>


        <!-- RESOLVED TICKETS -->
        <h2>Tickets Résolus:</h2>
        <div class="resolvedTicketContainer"></div>

    <?php
            }

    ?>
</body>

</html>