function toggleTicketView(object) {

    var supportAnswer;
    var userTicketContent;

    userProfile = "<p style=\"color:black;\"><i class=\"fa fa-shield\"></i><b> Vous (Support) </b>"
    ticketID = object.parentNode.children[1].innerHTML;
    supportAnswer = object.parentNode.children[5].innerHTML
    userTicketContent = object.parentNode.children[6].innerHTML
    footer = "| ID" + object.parentNode.children[1].innerHTML + " | " + fulldate


    console.log("1 " + object.parentNode.children[1].innerHTML),
        console.log("2 " + object.parentNode.children[2].innerHTML),
        console.log("3 " + object.parentNode.children[3].innerHTML),
        console.log("4 " + object.parentNode.children[4].innerHTML),
        console.log("5 " + object.parentNode.children[5].innerHTML),
        console.log("6 " + object.parentNode.children[6].innerHTML),

        Swal.fire({
            title: object.parentNode.children[3].innerHTML,
            html: "<p style=\"color:black;\"><i class=\"fa fa-user\"></i><b> " +
                object.parentNode.children[5].innerHTML + "</b><br><div class=\"boxed\"><p style=\"color:black\">" +
                userTicketContent + "</div><br />" + userProfile + "<div class=\"boxed\"><p>" + supportAnswer + "</div>",

            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: "Fermer",
            footer: footer,
        })
}