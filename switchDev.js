function switchDev(object) {

    var title = object.parentNode.children[3].innerText.toLowerCase();
    var titleToUppercase = title.charAt(0).toUpperCase() + title.slice(1);

    var username = object.parentNode.children[5].innerText.toLowerCase();
    var usernameToUppercase = username.charAt(0).toUpperCase() + username.slice(1);

    var setClass = "statutSubmited";

    (async() => {

        const {} = await Swal.fire({
            width: 800,
            title: "<div><p style=\"color:white;float:left;font-size:18px;margin-top:-10;\">" + "[ " + object.parentNode.children[2].innerHTML + " ] " + titleToUppercase + " </p><br><p style=\"color:white;float:left;font-size:20px;margin-top:-10;\"><text class=\"statutColor " + setClass + "\">" + object.parentNode.children[0].innerHTML + " </i></text><i class=\"fa fa-arrow-right statutColor arrow\" aria-hidden=\"true\"></i><text class=\"statutColor statutEnCours\">EN COURS</text></p></div>",
            input: 'select',
            inputClass: 'custom-input-class',
            inputOptions: {
                level1: 'Niveau 1',
                level2: 'Niveau 2',
                level3: 'Niveau 3',
            },
            html: "<div class=\"boxUser\"><p style=\"color:#b9bbbe;\"><i class=\"fa fa-user\"></i> " + usernameToUppercase +
                "</p></div> <div class=\"boxContent\">" + object.parentNode.children[9].innerHTML +
                "</div><br>",
            inputPlaceholder: 'Sélectionner un niveau',
            confirmButtonColor: '#4FB933',
            confirmButtonText: 'Continuer <i class=\"fa-solid fa-arrow-right\"></i>',
            showCancelButton: true,
            allowOutsideClick: false,
            cancelButtonText: "Annuler",

            inputValidator: (value) => {
                return new Promise((resolve) => {
                    var ticketId = object.parentNode.children[2].innerHTML;

                    if (!value) {
                        resolve("<br><text style=\"white\">Vous devez selectionner un niveau</text>")
                    } else if (value === "level1") {
                        var setNewLevel;
                        setNewLevel = 1;

                        Swal.fire({
                            title: '<i class=\"fa-solid fa-repeat\"></i> TRANSFÉRER LE TICKET',
                            confirmButtonColor: '#4FB933',
                            confirmButtonText: '<i class=\"fa-solid fa-repeat\"></i> Transférer',
                            showCancelButton: true,
                            allowOutsideClick: false,
                            cancelButtonText: 'Annuler',
                            html: "<p style=\"color:white;font-family: Arial, Helvetica, sans-serif;\"> Voulez-vous transférer le ticket <b>" + object.parentNode.children[2].innerHTML + "</b> émis par" + " <b>" + object.parentNode.children[5].innerHTML + "</b> au <b>Niveau " + setNewLevel + "</b> ?",

                            preConfirm: () => {

                                $.ajax({
                                    url: "getAllLevels.php",
                                    type: "POST",
                                    data: "level=" + setNewLevel + "&ticketId=" + ticketId,
                                    success: function(pushLevel) {
                                        console.log("level " + setNewLevel)
                                        console.log("ticketId " + object.parentNode.children[2].innerHTML)
                                    },
                                });
                            }

                        })
                        $(".swal2-title").css('color', '#fff');
                        $(".swal2-modal").css('background-color', '#36393f');
                        $(".swal2-modal").css('border-radius', '15px');
                    } else if (value === "level2") {
                        var setNewLevel;
                        setNewLevel = 2;

                        Swal.fire({
                            title: '<i class=\"fa-solid fa-repeat\"></i> TRANSFÉRER LE TICKET',
                            confirmButtonColor: '#4FB933',
                            confirmButtonText: '<i class=\"fa-solid fa-repeat\"></i> Transférer',
                            showCancelButton: true,
                            allowOutsideClick: false,
                            cancelButtonText: 'Annuler',
                            html: "<p style=\"color:white;\"> Voulez-vous transférer le ticket <b>" + object.parentNode.children[2].innerHTML + "</b> émis par" + " <b>" + object.parentNode.children[5].innerHTML + "</b> au <b>Niveau " + setNewLevel + "</b> ?",

                            preConfirm: () => {

                                $.ajax({
                                    url: "getAllLevels.php",
                                    type: "POST",
                                    data: "level=" + setNewLevel + "&ticketId=" + ticketId,
                                    success: function(pushLevel) {
                                        console.log("level " + setNewLevel)
                                        console.log("ticketId " + object.parentNode.children[2].innerHTML)
                                    },
                                });
                            }

                        })
                        $(".swal2-title").css('color', '#fff');
                        $(".swal2-modal").css('background-color', '#36393f');
                        $(".swal2-modal").css('border-radius', '15px');
                    } else if (value === "level3") {
                        var setNewLevel;
                        setNewLevel = 3;

                        Swal.fire({
                            title: '<i class=\"fa-solid fa-repeat\"></i> TRANSFÉRER LE TICKET',
                            confirmButtonColor: '#4FB933',
                            confirmButtonText: '<i class=\"fa-solid fa-repeat\"></i> Transférer',
                            showCancelButton: true,
                            allowOutsideClick: false,
                            cancelButtonText: 'Annuler',
                            html: "<p style=\"color:white;\"> Voulez-vous transférer le ticket <b>" + object.parentNode.children[2].innerHTML + "</b> émis par<br>" + " <b>" + object.parentNode.children[5].innerHTML + "</b> au <b>Niveau " + setNewLevel + "</b> ?",

                            preConfirm: () => {

                                $.ajax({
                                    url: "getAllLevels.php",
                                    type: "POST",
                                    data: "level=" + setNewLevel + "&ticketId=" + ticketId,
                                    success: function(pushLevel) {
                                        console.log("level " + setNewLevel)
                                        console.log("ticketId " + object.parentNode.children[2].innerHTML)
                                    },
                                });
                            }

                        })
                        $(".swal2-title").css('color', '#fff');
                        $(".swal2-modal").css('background-color', '#36393f');
                        $(".swal2-modal").css('border-radius', '15px');
                    }
                })

            }
        })

    })()
    $(".swal2-modal").css('background-color', '#36393f');
    $(".swal2-modal").css('border-radius', '15px');

    $(".swal2-select").css('background-color', '#36393f');
    $(".swal2-select").css('border-radius', '5px');
    $(".swal2-select").css('color', '#fff');

    $(".swal2-validation-message").css('color', 'rgb(204, 68, 68)');
    $(".swal2-validation-message").css('background-color', '#36393f');
    $(".swal2-validation-message").css('font-family', 'Arial');
    $(".swal2-validation-message").css('font-family', 'Helvetica');
    $(".swal2-validation-message").css('font-family', 'sans-serif');
    $(".swal2-validation-message").css('font-size', '17px');
    $(".swal2-validation-message").css('width', '50%');
    $(".swal2-validation-message").css('margin', 'auto');

    $(".swal2-container.in").css('background-color', '#fff '); //changes the color of the overlay inputPlaceholder
}


// console.log("test " + test)