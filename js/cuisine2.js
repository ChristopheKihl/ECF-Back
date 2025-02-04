// let tabCommande = load();
let tabCommande;
let tabClient = JSON.parse(localStorage.getItem("client"));

setInterval(load, 2000); //met a jour la liste des commandes toutes les 2 secondes
setInterval(recupStatus, 200); //met a jour toute les 0.2 secondes le nombre de pizza dans chaque status

let commande = document.getElementById("commande");
let preparation = document.getElementById("preparation");
let prete = document.getElementById("prete");
let livraison = document.getElementById("livraison");
let boutton = document.getElementById("boutton")

commande.addEventListener('click', choixStatus);
preparation.addEventListener('click', choixStatus);
prete.addEventListener('click', choixStatus);
livraison.addEventListener('click', choixStatus);
boutton.addEventListener('click', changementStatus);

function recupStatus() { //Récupère le nombre de pizza par rapport à leur status et affichage dans la petite bulle rouge
    load();
    let quantiteCommande = 0;
    let quantitePrepa = 0;
    let quantitePrete = 0;
    let quantiteLivraison = 0;
    for (let i = 0; i < tabCommande.length; i++) {
        tabCommande[i].id = i; //Reindexation des ID des pizzas
        if (tabCommande[i].status === "commande") {
            quantiteCommande = parseInt(quantiteCommande) + parseInt(tabCommande[i].quantite);
        }
        if (tabCommande[i].status === "preparation") {
            quantitePrepa = parseInt(quantitePrepa) + parseInt(tabCommande[i].quantite);
        }
        if (tabCommande[i].status === "prete") {
            quantitePrete = parseInt(quantitePrete) + parseInt(tabCommande[i].quantite);
        }
        if (tabCommande[i].status === "livraison") {
            quantiteLivraison += 1;

        }
    }

    save(); //! PENSER A ENLEVER LE COMMENTAIRE !!
    commande.firstElementChild.textContent = quantiteCommande;
    preparation.firstElementChild.textContent = quantitePrepa;
    prete.firstElementChild.textContent = quantitePrete;
    livraison.firstElementChild.textContent = quantiteLivraison;
};

function choixStatus(event) { // Changement du titre de la card générale + appel de la fonction createCard
    let commandeTitre = document.getElementById('commande_title');

    let status = event.target.id;

    if (status === "commande") {
        commandeTitre.textContent = 'En commande';
        createCard(status);
    }
    if (status === "preparation") {
        commandeTitre.textContent = 'En preparation';
        createCard(status);
    }
    if (status === "prete") {
        commandeTitre.textContent = 'Prete';
        createCard(status);
    }
    if (status === "livraison") {
        commandeTitre.textContent = 'En livraison';
        createCard(status);
    }
}

function createCard(status) { //Création d'une card de chaque pizza par rapport au status choisi

    let commandeContent = document.getElementById('commande_content');
    let boutton = document.getElementById('boutton');

    let div = document.createElement('div');
    let divInfo = div.cloneNode();

    let divCoordonnees = div.cloneNode();
    let divRegroupPizza = div.cloneNode();
    let divClient = div.cloneNode();
    let divLivraison = div.cloneNode();

    commandeContent.innerHTML = "";
    if (status === 'prete') {
        divInfo.classList.add('fs-6', 'text-center', 'fst-italic')
        divInfo.textContent = "Si la commande est en rouge, c'est qu'elle n'est pas complete"
        commandeContent.appendChild(divInfo);
    }

    let oldIdClient;

    for (let i = 0; i < tabCommande.length; i++) {
        let idClient = tabCommande[i].idClient;
        let nextIdClient = tabCommande[i + 1].idClient;

        if (tabCommande[i].status == status) {
            let divNomPizza = div.cloneNode();
            let divQuantite = div.cloneNode();
            let divContent = div.cloneNode();
            let divCard = div.cloneNode();

            divNomPizza.textContent = tabCommande[i].nomPizza;
            divQuantite.textContent = `X ${tabCommande[i].quantite}`;
            divContent.classList.add('card-body', 'd-flex', 'justify-content-between');
            divContent.appendChild(divNomPizza);
            divContent.appendChild(divQuantite);

            if (status === 'prete') {
                let verification;
                verification = verifCommande(tabCommande[i].idClient);
                if (verification === true) { // Si la commande est complète
                    divCard.classList.add('bg-success');
                }
                if (verification === false) { // Si la commande est incomplete
                    divCard.classList.add('bg-danger');
                }
            }

            divCard.setAttribute('id', tabCommande[i].id)
            divCard.classList.add('card', 'fs-5', 'col-6', 'm-auto');

            if (status !== "livraison") {
                divCard.appendChild(divContent);
                commandeContent.appendChild(divCard);
            }
        }

        let state = 0

        if (status === 'livraison') {

            if (oldIdClient !== idClient) {
                for (let j = 0; j < tabClient.length; j++) {
                    if (tabClient[j].id === idClient) {
                        if (state === 0) {
                            let divNom = div.cloneNode();
                            let divAdresse = div.cloneNode();
                            let divVille = div.cloneNode();
                            let divTelephone = div.cloneNode();

                            divNom.textContent = tabClient[j].nomClient + ' ' + tabClient[j].prenomClient;
                            divAdresse.textContent = tabClient[j].adresseClient;
                            divVille.textContent = tabClient[j].cpClient + ' ' + tabClient[j].villeClient;
                            divTelephone.textContent = tabClient[j].telClient;

                            divCoordonnees.classList.add('card-body', 'text-center');
                            divCoordonnees.appendChild(divNom);
                            divCoordonnees.appendChild(divAdresse);
                            divCoordonnees.appendChild(divVille);
                            divCoordonnees.appendChild(divTelephone);

                            oldIdClient = idClient;
                            state = 1;
                        }
                    }
                }
            }
            let divNomPizza = div.cloneNode();
            let divQuantite = div.cloneNode();
            let divPizza = div.cloneNode();

            divNomPizza.textContent = tabCommande[i].nomPizza;
            divQuantite.textContent = tabCommande[i].quantite;
            divPizza.classList.add('card-body', 'd-flex', 'justify-content-between');
            divPizza.appendChild(divNomPizza);
            divPizza.appendChild(divQuantite);

            divRegroupPizza.appendChild(divPizza);
            divClient.classList.add('card-body');
            divClient.appendChild(divRegroupPizza);

        }
        if (idClient !== nextIdClient) {
            divLivraison.classList.add('card', 'fs-6', 'col-6', 'm-auto')
            divLivraison.appendChild(divClient);
            divLivraison.appendChild(divCoordonnees);
        }
        commandeContent.appendChild(divLivraison);
    }

    console.log(divLivraison);

    //Changement du texte du boutton
    if (status === "commande") {
        boutton.textContent = "JE PREPARE";
    }
    if (status === "preparation") {
        boutton.textContent = "PIZZA PRETE";
    }
    if (status === "prete") {
        boutton.textContent = "EN LIVRAISON";
    }
    if (status === "livraison") {
        boutton.textContent = "PIZZA LIVREE";
    }

}

function changementStatus(event) { //Modifie le status de la pizza et appel de la focntion createCard pour mettre le tableau à jour
    let card = document.getElementById('commande_content');

    if (event.target.textContent === "JE PREPARE") {
        tabCommande.forEach(element => {
            if (element.id == card.firstElementChild.id) {
                element.status = 'preparation';
            }
        });
        createCard('commande');
    }

    if (event.target.textContent === "PIZZA PRETE") {
        tabCommande.forEach(element => {
            if (element.id == card.firstElementChild.id) {
                element.status = 'prete';
            }
        });
        createCard('preparation');
    }

    if (event.target.textContent === "EN LIVRAISON") {
        for (let i = 0; i < card.childNodes.length; i++) {
            if (card.childNodes[i].classList[0] === 'bg-success') { //verification que la commande est complète pour envoyer en livraison
                let idPizza = card.childNodes[i].id;
                tabCommande.forEach(element => {
                    if (element.id == idPizza) {
                        element.status = 'livraison';
                    }
                });
            }
        }
        createCard('prete');
    }
    save();
}

function verifCommande(id) { //Verifie que la commande est complete avant de l'envoyer en livraison
    let nbTotalPizza = 0;
    let nbPizzaPrete = 0;

    tabCommande.forEach(element => {
        if (id === element.idClient) {
            nbTotalPizza += 1;
            if (element.status === 'prete') {
                nbPizzaPrete += 1
            }
        }
    });

    if (nbPizzaPrete === nbTotalPizza) {
        return true;
    }
    else {
        return false;
    }
}

function save() { // Sauvegarde le tableau de commande
    return localStorage.setItem("cuisine", JSON.stringify(tabCommande));
}

function load() { // Charge le tableau de commande
    tabCommande = JSON.parse(localStorage.getItem("cuisine"));
}

