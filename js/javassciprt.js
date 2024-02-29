//vue par default
function loadDefaultView() {
    $("#all").load("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php?action=index");
}


$(document).ready(() => {
    $(document).on("click", "#button", () => {
        handleSearch();
    });

    function handleSearch() {
        $("#voyage").hide();

        const depart = $("#depart").val().trim();
        const arrivee = $("#arrivee").val().trim();
        const passengers = $("#passengers").val();

        if (depart === "" || arrivee === "" || passengers === "") {
            $("#voyage").html("");
            $("#bandeau").text("Sélectionner un départ, une arrivée et le nombre de passagers");
            return;
        }

        // si l'option avec escale est check
        const avecEscale = $("#avecEscale").is(":checked");

        // l'action change dependent de l'option avec escale
        const action = avecEscale ? "searchVoyageWithEscale" : "searchVoyage";

        $.get("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php", {
            action,
            depart,
            arrivee,
            passengers
        })
        .done(response => handleSearchResponse(response));
    }

    function handleSearchResponse(response) {
        if (response.includes("Aucun voyage")) {
            $("#voyage").html("");
            $("#bandeau").text("Aucun voyage n'est programmé");
        } else {
            $("#voyage").html(response);
            $("#bandeau").text("Résultat de la recherche");
          
            $("#voyage").show();
            
        }
    }
});


    $(document).on("click", "#inscriptionButton", () => {
        handleRegistration();
    });

    function handleRegistration() {
		
		const identifiant = $("#identifiant").val().trim();
    const pass = $("#pass").val().trim();
    const nom = $("#nom").val().trim();
    const prenom = $("#prenom").val().trim();
    const avatar = $("#avatar").val().trim();

  
    if (!identifiant || !pass || !nom || !prenom) {
        alert("Veuillez remplir tous les champs obligatoires.");
        return;
    }

		
        const userData = {
            identifiant: $("#identifiant").val(),
            pass: $("#pass").val(),
            nom: $("#nom").val(),
            prenom: $("#prenom").val(),
            avatar: $("#avatar").val()
        };

        $.get("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php", {
            action: "inscription",
            ...userData
        })
        .done(response => handleRegistrationResponse(response));
    }

    function handleRegistrationResponse(response) {
        if (response.includes("Inscription réussie")) {
            $("#bandeau").text("L'utilisateur a été ajouté avec succès");
            $("#inscription").hide();
        } else {
            $("#bandeau").text("Utilisateur déjà présent");
            $("#inscription").show();
        }
    }

    $(document).on("click", "#deconnexionButton", () => {
        handleDeconnexion();
    });

    function handleDeconnexion() {
        $.get("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php", {
            action: "deconnexion"
        })
        .done(response => handleDeconnexionResponse(response));
    }

    function handleDeconnexionResponse(response) {
        if (response.includes("déconnexion")) {
            console.log("Déconnexion réussie!");
            $("#bandeau").text("Déconnexion réussie!");
            loadDefaultView();
        } else {
            console.log("Échec de la déconnexion");
            $("#bandeau").text("Échec de la déconnexion");
        }
    }



    function loadDefaultView() {
        $("#all").load("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php?action=index");
    }


$(document).on("click", "#connexionButton", () => {
    handleConnexion();
});

function handleConnexion() {
    const identifiant = $("#loginIdentifiant").val().trim();
    const pass = $("#loginPass").val().trim();

    $.get("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php", {
        action: "connexion",
        identifiant,
        pass
    })
    .done(response => handleConnexionResponse(response))

}

function handleConnexionResponse(response) {
    if (response.includes("Connexion réussie")) {
        $("#bandeau").text("Connexion réussie!!");
        loadDefaultView();
        $("#con").hide();
        $("#content").hide();
    } else {
        $("#bandeau").text("Échec de la connexion. Veuillez vérifier vos identifiants.");
    }
}
$(document).on("click", ".reservationButton", function() {
    handleReservation($(this).data("voyage-id"));
});

function handleReservation(voyageId) {
    if (!voyageId) {
        console.error("fournir un id de voyage");
        return;
    }

    $.get("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php", {
        action: "reserver",
        voyage: voyageId
    })
    .done(response => handleReservationResponse(response))
  
}

function handleReservationResponse(response) {
    if (response.includes("Réservation réussie")) {
        $("#bandeau").text("Réservation réussie!");
    } else {
        $("#bandeau").text("Échec de la réservation");
    }
}










$(document).on("click", "#inscriptionformulaire", function() {
    loadView("inscription_formulaire");
});

$(document).on("click", "#connexionformulaire", function() {
    loadView("connexion_formulaire");
});

$(document).on("click", "#profile-button", function() {
    loadView("reservation_liste", "#profile-content");
});

$(document).on("click", "#cancelButton", function() {
    const reservationId = $(this).data("reservation-id");
    const voyageId = $(this).data("voyage-id");

    cancelReservation(reservationId, voyageId);
});

function cancelReservation(reservationId, voyageId) {
    $.get("https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php", {
        action: "annulerReservation",
        reservationId,
        voyageId
    })
    .done(response => $("#bandeau").text(response))
}

$(document).on("click", "#addVoyage", function() {
    const depart = $("#depart").val().trim();
    const arrivee = $("#arrivee").val().trim();
    const tarif = $("#tarif").val().trim();
    const nbplace = $("#nbplace").val().trim();
    const heure = $("#heure").val().trim();
    const contrainte = $("#contr").val().trim();
    const conducteur = $(this).data("user-id");

    addVoyage(depart, arrivee, tarif, nbplace, heure, contrainte, conducteur);
});

function addVoyage(depart, arrivee, tarif, nbplace, heure, contrainte, conducteur) {
	//verifer l'heure
	  if (isNaN(heure) || heure < 0 || heure > 23) {
        alert("L'heure de départ doit être un nombre entre 0 et 23.");
        return;
    }
    if (!depart || !arrivee || !tarif || !nbplace || !heure) {
        alert("remplir tout le formulaire.");
        return;
    }

    const url = "https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php" +
        "?action=add_voyage" +
        "&trajet[depart]=" + depart +
        "&trajet[arrivee]=" + arrivee +
        "&tarif=" + tarif +
        "&nombrePlaces=" + nbplace +
        "&heureDepart=" + heure +
        "&contraintes=" + contrainte +
        "&conducteur=" + conducteur;

    $.ajax({
        type: "GET",
        url: url,
       success: function(response) {
            if (response.includes("Trajet n'existe pas")) {
               
                alert("Le trajet n'existe pas.");
            } else {
                $("#bandeau").text(" Ajout du voyage!");
                console.log(response);
            }
        },
      
    });
}  




$(document).on("click", "#accueilButton", function() {
    loadView("index", "#all");
});

$(document).on("click", "#accesFormulaireButton", function() {
    loadView("access_formulaire", "#content");
});

$(document).on("click", "#proposerVoyageButton", function() {
    loadView("add_voyageform", "#content");
});

$(document).on("click", "#profileButton", function() {
    loadView("reservation_liste", "#content");
});

$(document).on("click", "#connexionformulaire", function() {
    loadView("connexion_formulaire", "#content");
});

$(document).on("click", "#deconnexionButton", function() {
    loadView("deconnexion", "#content");
});
$(document).on("click", ".avatar-link", function() {
    loadView("reservation_liste", "#content");
});

$(document).on("click", "#inscrireButton", function() {
    loadView("inscription_formulaire", "#content");
});

//chargement de la vue correspendante

function loadView(action, targetSelector = "#content") {
    $.ajax({
        url: "https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/monApplication_ajax.php",
        method: "GET",
        data: { action },
        success: function(response) {
            $(targetSelector).html(response);
        },
       
    });
}

   
