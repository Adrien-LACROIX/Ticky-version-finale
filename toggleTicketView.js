function toggleTicketView(object) {

    console.log("0 " + object.parentNode.children[0].innerHTML)
    console.log("1 " + object.parentNode.children[1].innerHTML)
    console.log("2 " + object.parentNode.children[2].innerHTML)
    console.log("3 " + object.parentNode.children[3].innerHTML)
    console.log("4 " + object.parentNode.children[4].innerHTML)
    console.log("5 " + object.parentNode.children[5].innerHTML)
    console.log("6 " + object.parentNode.children[6].innerHTML)
    console.log("7 " + object.parentNode.children[7].innerHTML)

    var title = object.parentNode.children[3].innerText.toLowerCase();
    var titleToUppercase = title.charAt(0).toUpperCase() + title.slice(1);

    answer = object.parentNode.lastChild.innerHTML;


    user = " Vous "
    setIcon = "fa fa-shield"
    logoIcon = "<i class='fa fa-check' style='font-size:36px'></i>"
    object.parentNode.lastChild.innerHTML = answer
    setUserMessage = 6
    answer = object.parentNode.children[7].innerHTML


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
            html: "<div style=\"box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; text-align:justify; height: 30px;width: 450px;padding: -10px;background-color:##36393f;color:#b9bbbe;<p style=\"color:#b9bbbe;\"><i class=\"fa fa-user\"></i> " + object.parentNode.children[4].innerHTML + "</p></div> <div style=\"box-sizing: border-box; height: 130px; width: 450px;padding: 5px;background-color:#494e56;color:white;  overflow-y: auto;overflow-z: auto;scrollbar-color: #494e56;scrollbar-width: thin;font-family: Arial, Helvetica, sans-serif;text-align:justify;border-radius:5px;\">" + object.parentNode.children[setUserMessage].innerHTML + "</div><br /><br /><br /><div style=\"box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; text-align:justify; height: 30px;width: 450px;border: solid #494e56 0px;padding: -10px;background-color:#36393f;color:#EEDAAD;<p style=\"color:#EEDAAD;\"><i class=\"" + setIcon + "\"></i>" + user + "</p></div><div style=\"box-sizing: border-box; height: 130px;width: 450px;padding: 5px;background-color:#494e56;color:white;  overflow-y: auto;overflow-z: auto;scrollbar-color: rebeccapurple green;scrollbar-width: thin;font-family: Arial, Helvetica, sans-serif; text-align:justify; border-radius:5px\">" + answer + "</div>",
            allowOutsideClick: false,
            showCancelButton: false,
            confirmButtonText: "Fermer",
        });


    $(".swal2-modal").css('background-color', '#36393f'); //Optional changes the color of the sweetalert  
    $(".swal2-modal").css('border-radius', '15px');
    $(".swal2-container.in").css('background-color', '#fff '); //changes the color of the overlay 
    $(".swal2-footer").css('background-color', '#fff ');
}