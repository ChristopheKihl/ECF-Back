let tabCommande = [];
let tabClient = JSON.parse(localStorage.getItem("client"));
let categorie;
let commandeOK;
let oldID;

setInterval(load, 500); //Recupération de la liste des commandes toutes les 0.5 secondes
setInterval(compteur, 500); //Appel de la fonction compteur toutes les 0.5 secondes

let commande = document.getElementById('commande');
let preparation = document.getElementById('preparation');
let prete = document.getElementById('prete');
let livraison = document.getElementById('livraison');
let boutton = document.getElementById('boutton');
let content = document.getElementById('commande_content');

commande.addEventListener('click', choixStatus);
preparation.addEventListener('click', choixStatus);
prete.addEventListener('click', choixStatus);
livraison.addEventListener('click', choixStatus);
boutton.addEventListener('click', changementStatus);

let div = document.createElement('div');
let divCoordonnees = div.cloneNode();

function compteur() { // Met a jour le nombre dans la bulle rouge
    let commandeCount = 0;
    let prepaCount = 0;
    let readyCount = 0;
    let livraisonCount = 0;

    tabCommande.forEach(compteur => {
        if (compteur.status === 'commande') {
            commandeCount += 1;
        }
        if (compteur.status === 'preparation') {
            prepaCount += 1;
        }
        if (compteur.status === 'prete') {
            readyCount += 1;
        }
        if (compteur.status === 'livraison') {
            livraisonCount += 1;
        }

        commande.firstElementChild.textContent = commandeCount;
        preparation.firstElementChild.textContent = prepaCount;
        prete.firstElementChild.textContent = readyCount;
        livraison.firstElementChild.textContent = livraisonCount;

    });
}

function choixStatus(event) {
    categorie = event.target.id;

    let titre = document.getElementById('commande_title');

    if (categorie === 'commande') {
        titre.textContent = 'EN COMMANDE';
        boutton.textContent = "JE PREPARE";
    }
    if (categorie === 'preparation') {
        titre.textContent = 'EN PREPARATION';
        boutton.textContent = "PIZZA PRETE";
    }
    if (categorie === 'prete') {
        titre.textContent = 'PIZZA PRETE';
        boutton.textContent = "ENVOYER EN LIVRAISON";
    }
    if (categorie === 'livraison') {
        titre.textContent = 'EN LIVRAISON';
        boutton.textContent = "PIZZA LIVREE";
    }

    createCard(categorie);
}

function createCard(categorie) {// Créer les card pour l'affichage des pizza dans les catégories

    let divInfo = div.cloneNode();

    content.innerHTML = "";

    if (categorie === 'prete') {
        divInfo.classList.add('fs-6', 'text-center', 'fst-italic')
        divInfo.textContent = "Si la commande est en rouge, c'est qu'elle n'est pas complete"
        content.appendChild(divInfo);
    }

    tabCommande.forEach(element => {
        if (element.status === categorie) {

            if (categorie !== 'livraison') {
                let divPizza = div.cloneNode();
                let divQuantite = div.cloneNode();
                let divCardBody = div.cloneNode();
                let divCard = div.cloneNode();

                let idClient = element.idClient;

                divPizza.textContent = element.nomPizza;
                divQuantite.textContent = 'X ' + element.quantite;
                divCardBody.classList.add('card-body', 'fs-5', 'd-flex', 'justify-content-between');
                divCardBody.appendChild(divPizza);
                divCardBody.appendChild(divQuantite);

                if (categorie === 'prete') {

                    commandeOK = verifCommande(idClient);
                    if (commandeOK === false) {
                        divCard.classList.add('bg-danger'); //Si la commande n'est pas complète
                    } else {
                        divCard.classList.add('bg-success'); // Si la commande est complète
                    }
                }

                divCard.classList.add('card', 'col-6', 'm-auto');
                divCard.setAttribute('id', element.id);
                divCard.appendChild(divCardBody);
                content.appendChild(divCard);
            }
            if (categorie === 'livraison') {
                pizzaLivraison(element);

            }
        }
    });

}

function changementStatus() {
    let idPizza = content.firstChild.id;

    tabCommande.forEach(element => {
        if (element.id == idPizza) {
            if (categorie === 'commande') {
                element.status = 'preparation';
                createCard(categorie)
            }
            if (categorie === 'preparation') {
                element.status = 'prete';
                createCard(categorie)
            }
            if (categorie === 'prete') {
                pizzaPrete();
                createCard(categorie);
            }
            if (categorie === 'livraison') {
                element.status = 'terminee';
                createCard(categorie)
            }
        }
        save();
    });
}

function verifCommande(idClient) { // Verifie si la commande est complète
    let pizzaTotale = 0;
    let pizzaPrete = 0;
    tabCommande.forEach(element => {
        if (element.idClient === idClient) {
            pizzaTotale += 1;
            if (element.status === 'prete') {
                pizzaPrete += 1;
            }
        }
    });

    if (pizzaPrete === pizzaTotale) {
        return true;

    } else {
        return false;
    }

}

function pizzaPrete() {
    content.childNodes.forEach(element => {
        if (element.classList[0] === 'bg-success') {
            tabCommande.forEach(listPizza => {
                if (listPizza.id == element.id) {
                    listPizza.status = 'livraison';
                }
            });
        }
        if (element.classList[0] === 'bg-danger') {
            boutton.removeEventListener('click');
        }
    });
}


//! TERMINER DE CREER LES CARD DE LIVRAISON
function pizzaLivraison(element) {

    // let divCardPizza = div.cloneNode();
    // let divRegroupPizza = div.cloneNode();

    // divCardPizza.classList.add('card-body', 'd-flex', 'justify-content-between');

    let currentID = element.idClient;
    tabClient.forEach(client => {
        if (client.id === currentID) {

            if (oldID !== currentID) {

                let divNom = div.cloneNode();
                let divAdresse = div.cloneNode();
                let divCP = div.cloneNode();
                let divTel = div.cloneNode();

                divNom.textContent = client.nomClient + ' ' + client.prenomClient;
                divAdresse.textContent = client.adresseClient;
                divCP.textContent = client.cpClient + ' ' + client.villeClient;
                divTel.textContent = client.telClient;
                divCoordonnees.classList.add('card-body', 'text-center');
                divCoordonnees.appendChild(divNom);
                divCoordonnees.appendChild(divAdresse);
                divCoordonnees.appendChild(divCP);
                divCoordonnees.appendChild(divTel);
                oldID = currentID;
            }





            let divNomPizza = div.cloneNode();
            let divQuantitePizza = div.cloneNode();

            divNomPizza.textContent = element.nomPizza;
            divQuantitePizza.textContent = element.quantite;

            divCardPizza.appendChild(divNomPizza);
            divCardPizza.appendChild(divQuantitePizza);

            divRegroupPizza.appendChild(divCardPizza);

            console.log(divRegroupPizza);

        }
    });



}

function load() {
    let id = 0;
    tabCommande = JSON.parse(localStorage.getItem("cuisine"));
    tabCommande.forEach(element => { // Réindexation des ID des pizza
        element.id = id;
        id += 1;
        save();
    });
}

function save() {
    return localStorage.setItem("cuisine", JSON.stringify(tabCommande));
}