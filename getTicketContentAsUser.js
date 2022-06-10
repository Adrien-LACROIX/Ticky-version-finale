var ticketContent;
var ticketID;
var answer;
var footer;
var user;
const months = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
const days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
const d = new Date();
let month = months[d.getMonth()];
let day = days[d.getDay()];
let year = d.getFullYear();
let date = d.getDate();
let fulldate = day + " " + date + " " + month + " " + year;

function toggle_text(object) {


    var title = object.parentNode.children[3].innerText.toLowerCase();
    var titleToUppercase = title.charAt(0).toUpperCase() + title.slice(1);

    answer = object.parentNode.lastChild.innerHTML;

    if (object.parentNode.children[9].innerHTML == 0) {
        user = " Système"
        answer = "Votre ticket est en cours de traitement. Merci de bien vouloir patienter!"
        logoIcon = "<i class='fa fa-clock-o' style='font-size:36px'></i>"
        setIcon = "fa fa-gear"
        setUserMessage = 8
    } else {
        user = " Support "
        setIcon = "fa fa-shield"
        logoIcon = "<i class='fa fa-check' style='font-size:36px'></i>"
        object.parentNode.lastChild.innerHTML = answer
        setUserMessage = 6
        answer = object.parentNode.children[9].innerHTML
    }

    if (object.parentNode.children[0].innerHTML == "SOUMIS") {
        setClass = "statutSubmited";
    } else if (object.parentNode.children[0].innerHTML == "SANS OBJET") {
        setClass = "statutNonResolu";
    } else if (object.parentNode.children[0].innerHTML == "RÉSOLU") {
        setClass = "statutResolu"
    }

    ticketID = object.parentNode.children[1].innerHTML,

        Swal.fire({
            title: "<div><p style=\"color:white;float:left;font-size:18px;margin-top:-10;\">" + "[ " + object.parentNode.children[2].innerHTML + " ] " + titleToUppercase + " </p><br><p style=\"color:white;float:left;font-size:20px;margin-top:-10;\"><text class=\"statutColor " + setClass + "\">" + object.parentNode.children[0].innerHTML + "</text></p></div>",
            html: "<div style=\"box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; text-align:justify; height: 30px;width: 450px;padding: -10px;background-color:##36393f;color:#b9bbbe;<p style=\"color:#b9bbbe;\"><i class=\"fa fa-user\"></i> Vous</p></div> <div style=\"box-sizing: border-box; height: 130px; width: 450px;padding: 5px;background-color:#494e56;color:white;  overflow-y: auto;overflow-z: auto;scrollbar-color: #494e56;scrollbar-width: thin;font-family: Arial, Helvetica, sans-serif;text-align:justify;border-radius:5px;\">" + object.parentNode.children[setUserMessage].innerHTML + "</div><br /><br /><br /><div style=\"box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; text-align:justify; height: 30px;width: 450px;border: solid #494e56 0px;padding: -10px;background-color:#36393f;color:#EEDAAD;<p style=\"color:#EEDAAD;\"><i class=\"" + setIcon + "\"></i>" + user + "</p></div><div style=\"box-sizing: border-box; height: 130px;width: 450px;padding: 5px;background-color:#494e56;color:white;  overflow-y: auto;overflow-z: auto;scrollbar-color: rebeccapurple green;scrollbar-width: thin;font-family: Arial, Helvetica, sans-serif; text-align:justify; border-radius:5px\">" + answer + "</div>",
            allowOutsideClick: false,
            showCancelButton: false,
            confirmButtonText: "Fermer",
        });


    $(".swal2-modal").css('background-color', '#36393f'); //Optional changes the color of the sweetalert  
    $(".swal2-modal").css('border-radius', '15px');
    $(".swal2-container.in").css('background-color', '#fff '); //changes the color of the overlay 
    $(".swal2-footer").css('background-color', '#fff ');


}