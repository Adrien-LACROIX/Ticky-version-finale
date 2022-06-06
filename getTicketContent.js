//Variables
var ticketContent;
var ticketID;
var footer;
var user;
var answer;
var statutResolved;

//Constantes Date
const months = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
const days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
const d = new Date();
let month = months[d.getMonth()];
let day = days[d.getDay()];
let year = d.getFullYear();
let date = d.getDate();
let fulldate = day + " " + date + " " + month + " " + year;


function getTicket(object) {

    //Calcul du temps depuis la creation du ticket

    var currentDate = d.getTime();
    var ticketDate = new Date(object.parentNode.children[4].innerHTML).getTime(); //Recup date du ticket
    var minus = (currentDate - ticketDate); //Fait la difference entre deux les dates
    let long = (minus) / (1000 * 60 * 60 * 24) //Convertis les millis en jours
        /*
            console.log("Date actuelle " + (currentDate));
            console.log("Date ticket " + (ticketDate));
            console.log("Soustraction " + minus);
            console.log(Math.trunc(long) + " jours"); */

    var createdAt;

    if (Math.trunc(long) != 0) {

        var createdAt = "Il y a " + Math.trunc(long) + " jours";

    } else {
        var createdAt = " Créé aujourd'hui";
    }

    //Calcul du temps de resolution
    /*
    var resoDate = new Date(object.parentNode.children[11].innerHTML).getTime();
    var sous = (resoDate - ticketDate); //Fait la difference entre deux les dates
    let finalDate = (sous) / (1000 * 60 * 60 * 24) //Convertis les millis en jours */
    /*
        console.log("Date resolution " + (resoDate));
        console.log("Date ticket " + (ticketDate));
        console.log("Soustraction " + sous);
        console.log(Math.trunc(finalDate) + " jours");*/

    // Liste des objets recuperes

    console.log("List -> ", object.parentNode.children);
    console.log("0 -> " + object.parentNode.children[0].innerHTML);
    console.log("1 -> " + object.parentNode.children[1].innerHTML);
    console.log("2 -> " + object.parentNode.children[2].innerHTML);
    console.log("3 -> " + object.parentNode.children[3].innerHTML);
    console.log("4 -> " + object.parentNode.children[4].innerHTML);
    console.log("5 -> " + object.parentNode.children[5].innerHTML);
    console.log("6 -> " + object.parentNode.children[6].innerHTML);
    console.log("7 -> " + object.parentNode.children[7].innerHTML);
    console.log("8 -> " + object.parentNode.children[8].innerHTML);
    console.log("9 -> " + object.parentNode.children[9].innerHTML);

    ticketID = object.parentNode.children[2].innerHTML;

    var title = object.parentNode.children[3].innerText.toLowerCase();
    var titleToUppercase = title.charAt(0).toUpperCase() + title.slice(1);

    var username = object.parentNode.children[5].innerText.toLowerCase();
    var usernameToUppercase = username.charAt(0).toUpperCase() + username.slice(1);

    var setClass = "statutSubmited";


    Swal.fire({
        title: "<div><p style=\"color:white;float:left;font-size:18px;margin-top:-10;\">" + "[ " + object.parentNode.children[2].innerHTML + " ] " + titleToUppercase + " </p><br><p style=\"color:white;float:left;font-size:20px;margin-top:-10;\"><text class=\"statutColor " + setClass + "\">" + object.parentNode.children[0].innerHTML + "</text></p></div>",
        width: 800,
        allowOutsideClick: false,
        html: "<div style=\"box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; text-align:justify; height: 30px;width: 450px;padding: -10px;background-color:##36393f;color:#b9bbbe;<p style=\"color:#b9bbbe;\"><i class=\"fa fa-user\"></i> " + object.parentNode.children[5].innerHTML + "</p></div> <div style=\"box-sizing: border-box; height: 130px; width: 740px;padding: 5px;background-color:#494e56;color:white; font-size:13pt;overflow-y: auto;overflow-z: auto;scrollbar-color: #494e56;scrollbar-width: thin;font-family: Arial, Helvetica, sans-serif;text-align:justify;border-radius:5px;\">" + object.parentNode.children[9].innerHTML + "</p></div><br>",
        showDenyButton: true,
        showCancelButton: true,
        cancelButtonText: "Annuler",
        confirmButtonColor: '#4FB933',
        denyButtonColor: '#DC5449',
        cancelButtonText: "Annuler",
        confirmButtonText: 'Résoudre',
        denyButtonText: `Classer sans objet`,
        //  footer: "<i class=\"fa fa-user\">  </i>" + "" + object.parentNode.children[5].innerHTML + " | ID" + object.parentNode.children[2].innerHTML + " | " + object.parentNode.children[4].innerHTML,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "<div><p style=\"color:white;float:left;font-size:18px;margin-top:-10;\">" + "[ " + object.parentNode.children[2].innerHTML + " ] " + titleToUppercase + " </p><br><p style=\"color:white;float:left;font-size:20px;margin-top:-10;\"><text class=\"statutColor " + setClass + "\">" + object.parentNode.children[0].innerHTML + " </i></text><i class=\"fa fa-arrow-right statutColor arrow\" aria-hidden=\"true\"></i><text class=\"statutColor statutResolu\"> RÉSOLU</text></p></div>",
                width: 800,
                allowOutsideClick: false,
                inputLabel: 'Message',
                showCancelButton: true,
                cancelButtonText: "Annuler",
                confirmButtonText: 'Envoyez ma réponse <i class="fa fa-arrow-right"></i>',
                confirmButtonColor: '#4FB933',
                html: "<div class=\"boxUser\"><p style=\"color:#b9bbbe;\"><i class=\"fa fa-user\"></i> " + usernameToUppercase +
                    "</p></div> <div class=\"boxContent\">" + object.parentNode.children[9].innerHTML +
                    "</div><br /><br /><br /><div class=\"boxUser\"><p style=\"color:#EEDAAD;\"><i class=\"fa fa-shield\"></i> Votre réponse</p></div><div><textarea maxlength=\"2000\" oninput=\"limitChar(this)\" id=\"answerValidInput\" placeholder=\"Entez votre réponse...\"class=\"boxTextAreaContent\"></textarea></div><div class=\"boxFooter\"><span id=\"charCounter\">Votre réponse dont contenir au maximum 2000 caractères.</span></div>",
                preConfirm: () => {
                    if (document.getElementById('answerValidInput').value) {
                        ticketContent = document.getElementById('answerValidInput').value,
                            console.log(ticketContent)
                            // location.reload();

                        $.ajax({
                            url: "ajaxQueryForTicketContent.php",
                            type: "POST",
                            data: "ticketContent=" + ticketContent + "&ticketId=" + ticketID,
                            success: function(AppelPhp) {
                                console.log("contenu " + ticketContent)
                                console.log("ID " + ticketID)
                                console.log(AppelPhp)
                            },
                        });
                    }
                    let timerInterval
                    Swal.fire({
                        title: "<div><p style=\"color:white;float:left;font-size:18px;margin-top:-10;\">" + "[ " + object.parentNode.children[2].innerHTML + " ] " + titleToUppercase + " </p><br><p style=\"color:white;float:left;font-size:20px;margin-top:-10;\"><text class=\"statutColor " + setClass + "\">" + object.parentNode.children[0].innerHTML + " </i></text><i class=\"fa fa-arrow-right statutColor arrow\" aria-hidden=\"true\"></i><text class=\"statutColor statutResolu\"> RÉSOLU</text></p></div>",

                        position: 'top-end',
                        timer: 3200,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: () => {
                            //  Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                    $(".swal2-modal").css('background-color', 'hsla(120,60%,70%,0.7)'); //Optional changes the color of the sweetalert  
                    $("swal2-timer-progress-bar").css('color', 'black');
                }
            })
            $(".swal2-modal").css('background-color', '#36393f'); //Optional changes the color of the sweetalert  
            $(".swal2-modal").css('border-radius', '15px');
            $(".swal2-container.in").css('background-color', '#fff '); //changes the color of the overlay 

        } else if (result.isDenied) {

            Swal.fire({
                title: "<div><p style=\"color:white;float:left;font-size:18px;margin-top:-10;\">" + "[ " + object.parentNode.children[2].innerHTML + " ] " + titleToUppercase + " </p><br><p style=\"color:white;float:left;font-size:20px;margin-top:-10;\"><text class=\"statutColor " + setClass + "\">" + object.parentNode.children[0].innerHTML + " </i></text><i class=\"fa fa-arrow-right statutColor arrow\" aria-hidden=\"true\"></i><text class=\"statutColor statutNonResolu\"> SANS OBJET</text></p></div>",
                width: 800,
                allowOutsideClick: false,
                inputLabel: 'Message',
                showCancelButton: true,
                cancelButtonText: "Annuler",
                confirmButtonText: 'Envoyez ma réponse <i class="fa fa-arrow-right"></i>',
                confirmButtonColor: '#DC5449',
                html: "<div class=\"boxUser\"><p style=\"color:#b9bbbe;\"><i class=\"fa fa-user\"></i> " + usernameToUppercase +
                    "</p></div> <div class=\"boxContent\">" + object.parentNode.children[9].innerHTML +
                    "</div><br /><br /><br /><div class=\"boxUser\"><p style=\"color:#EEDAAD;\"><i class=\"fa fa-shield\"></i> Votre réponse</p></div><div><textarea maxlength=\"2000\" oninput=\"limitChar(this)\" id=\"answerInvalidInput\" placeholder=\"Entez votre réponse...\"class=\"boxTextAreaContent\"></textarea></div><div class=\"boxFooter\"><span id=\"charCounter\">Votre réponse dont contenir au maximum 2000 caractères.</span></div>",


                preConfirm: () => {
                    if (document.getElementById('answerInvalidInput').value) {
                        ticketContent = document.getElementById('answerInvalidInput').value,
                            console.log(ticketContent)
                            //  location.reload();

                        $.ajax({
                            url: "insertInvalidTicket.php",
                            type: "POST",
                            data: "ticketContent=" + ticketContent + "&ticketId=" + ticketID,
                            success: function(AppelPhp2) {
                                console.log("contenu " + ticketContent)
                                console.log("ID " + ticketID)
                                console.log(AppelPhp2)
                            },
                        });
                    }
                }

            })
            $(".swal2-modal").css('background-color', '#36393f'); //Optional changes the color of the sweetalert  
            $(".swal2-modal").css('border-radius', '15px');
            $(".swal2-container.in").css('background-color', '#fff '); //changes the color of the overlay 
            $(".swal2-footer").css('background-color', '#fff ');
            $(".swal2-confirm").css('text-align', 'right');
        }
    })

    $(".swal2-modal").css('background-color', '#36393f'); //Optional changes the color of the sweetalert  
    $(".swal2-modal").css('border-radius', '15px');
    $(".swal2-container.in").css('background-color', '#fff '); //changes the color of the overlay 
    $(".swal2-footer").css('background-color', '#fff ');
    $(".swal2-confirm").css('text-align', 'right');
}