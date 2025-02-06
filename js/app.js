let tabDonnees;
let tabCommande = load(1);
let tabClient = load(2);
let tabCuisine = load(3);

if (tabCommande === null) {
    tabCommande = [];
}
if (tabClient === null) {
    tabClient = [];
}
if (tabCuisine === null) {
    tabCuisine = [];
}

let cardTomate = document.getElementById("tomate");
let cardCreme = document.getElementById("creme");
let commande = document.getElementById("panier");
let client = document.getElementById("client");
let optionAlimentation = document.getElementById("alimentation");

optionAlimentation.addEventListener("click", trier);
cardCreme.addEventListener("click", choixPizza);
cardTomate.addEventListener("click", choixPizza);
commande.addEventListener("click", Panier);
client.addEventListener("click", RecupInfoClient);


(async function recupererPizza() { //Recupération des données JSON
    try {
        let reponse = await fetch('index.php?route=pizza')
            .then(reponse => reponse.json())

        const data = reponse;
        tabDonnees = data;

        createMenu(data);
    } catch (erreur) {
        console.log(erreur);
    }
})();

function createMenu(data) { //Normalisation et traitement des données

    for (let i = 0; i < data.length; i++) {
        let base = data[i].nom_base;
        let prix = parseFloat(data[i].prix_pizza);
        let devise = '€';
        let ingredients = data[i].ingredients;
        ingredients = ingredients.split(',');
        let nomPizza = (data[i].nom_pizza);
        nomPizza = nomPizza.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); //normalisation du titre
        let imagePizza = data[i].chemin_image;


        createCard(base, prix, devise, ingredients, nomPizza, imagePizza);

    }
};

function createCard(base, prix, devise, ingredients, nomPizza, imagePizza) { //Création des cards pour affichage
    let cardTomate = document.getElementById("tomate");
    let cardCreme = document.getElementById("creme");

    base = base.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    let div = document.createElement('div');
    let button = document.createElement('button');
    let input = document.createElement('input');
    let a = document.createElement('a');
    let ul = document.createElement('ul');
    let h3 = document.createElement('h4');
    let img = document.createElement('img');
    let article = document.createElement('article');

    let buttonMoins = button.cloneNode();
    let buttonPlus = button.cloneNode();
    let divQuantite = input.cloneNode();
    let divChoixQuantite = div.cloneNode();

    let divFooter = div.cloneNode();
    let divPrix = input.cloneNode();

    let divIngredients = div.cloneNode();

    let imgPizza = img.cloneNode();
    let divRegime = div.cloneNode();

    let divPhoto = div.cloneNode();

    let divCard = div.cloneNode();

    // Creation de la quantité
    buttonMoins.classList.add('moins');
    buttonMoins.textContent = '-';
    divQuantite.setAttribute('type', 'text');
    divQuantite.setAttribute('disabled', "");
    divQuantite.classList.add('quantite');
    divQuantite.value = '1';
    buttonPlus.classList.add('plus');
    buttonPlus.textContent = '+';
    divChoixQuantite.appendChild(buttonMoins);
    divChoixQuantite.appendChild(divQuantite);
    divChoixQuantite.appendChild(buttonPlus);
    divChoixQuantite.classList.add('d-flex');

    // Creation du footer
    divPrix.value = prix + ' ' + devise;
    divPrix.setAttribute('type', 'text');
    divPrix.setAttribute('disabled', "");
    divPrix.classList.add('fs-4', 'prix');
    a.classList.add('btn', 'btn-success');
    a.textContent = 'Ajouter';
    divFooter.classList.add('card-footer', 'd-flex', 'justify-content-between', 'align-items-center')
    divFooter.appendChild(divPrix);
    divFooter.appendChild(divChoixQuantite);
    divFooter.appendChild(a);

    // Creation de la liste d'ingrédients + nom pizza
    h3.textContent = nomPizza;
    for (let i = 0; i < ingredients.length; i++) {
        let li = document.createElement('li');
        ingredients[i] = ingredients[i].normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        li.textContent = ingredients[i];
        ul.appendChild(li);
    }

    divIngredients.classList.add('d-flex', 'flex-column');
    divIngredients.appendChild(h3);
    divIngredients.appendChild(ul);
    divIngredients.classList.add('ms-2')

    // Creation de l'image + preferences alimentaires
    imgPizza.setAttribute("src", imagePizza);
    imgPizza.setAttribute("alt", `Photo de ${nomPizza}`);
    divRegime.classList.add('d-flex', 'flex-row', 'regime_alimentaire', 'justify-content-around')

    // Création de la div Photo + regime alimentaire
    divPhoto.classList.add('d-flex', 'flex-column', 'align-self-center');
    divPhoto.appendChild(imgPizza);

    // Création de la div regroupant le tout
    divCard.classList.add('card-body', 'd-flex', 'flex-row', 'justify-content-around');
    divCard.appendChild(divPhoto);
    divCard.appendChild(divIngredients);

    // Creation de la card
    article.classList.add('card', 'card-p', 'd-flex', 'flex-column');
    article.appendChild(divCard);
    article.appendChild(divFooter);

    if (base === "creme") {
        cardCreme.appendChild(article);
    }
    if (base === "tomate") {
        cardTomate.appendChild(article);
    }

}

function trier(event) { //Fonction qui permet de trier les pizza en fonction de ses régimes alimentaires
    let tabTrier = [];

    cardCreme.innerHTML = "";
    cardTomate.innerHTML = "";

    if (event.target.checked === true) {
        for (let i = 0; i < tabDonnees.length; i++) {
            for (const key in tabDonnees[i].options_diet) {
                if (key === event.target.id && tabDonnees[i].options_diet[key] === true) {
                    tabTrier.push(tabDonnees[i]);
                }
            }
        }
        createMenu(tabTrier);
    }
    else {
        createMenu(tabDonnees);
    }
}

function choixPizza(event) {
    let elementClique = event.target.classList.value;

    if (elementClique === 'plus' || elementClique === 'moins') {
        choixNbPizza(elementClique);
    }
    else {
        elementClique = event.target.tagName;
        if (elementClique === 'A') {
            let prix = event.target.parentNode.firstChild.value;
            let quantite = event.target.previousSibling.firstChild.nextElementSibling.value;
            let nomPizza = event.target.parentNode.previousSibling.lastChild.firstChild.textContent;

            let check = document.createElement('i');
            check.classList.add('bi', 'bi-check2');

            console.log(event);
            event.target.classList.remove('btn-success');
            event.target.classList.add('btn-danger');
            event.target.textContent = "";
            event.target.appendChild(check);

            setTimeout(() => {
                event.target.classList.remove('btn-danger');
                event.target.classList.add('btn-success');
                event.target.textContent = "Ajouter";
            }, "800");



            prix = prix.replace(" ", "").replace("€", "");
            prix = parseFloat(prix);

            ajouterPizza(prix, quantite, nomPizza);

        }

    }

    function choixNbPizza(elementClique) {
        if (elementClique === 'plus') {
            let quantite = parseInt(event.target.previousElementSibling.value) + 1;
            event.target.previousElementSibling.value = quantite;
        }
        if (elementClique === 'moins') {
            if (event.target.nextElementSibling.value > 1) {
                let quantite = parseInt(event.target.nextElementSibling.value) - 1;
                event.target.nextElementSibling.value = quantite;
            }
        }
    }
}

function ajouterPizza(prix, quantite, nomPizza) { // Envoi de la pizza vers le panier
    let id;
    let state = 0;

    for (let i = 0; i < tabCommande.length; i++) { //Mise a jour de la quantité de pizza dans le panier
        if (tabCommande.length !== 0) {
            if (nomPizza === tabCommande[i].nomPizza) {
                if (prix !== 0) {
                    tabCommande[i].quantite = parseInt(tabCommande[i].quantite) + parseInt(quantite);
                    state = 1;
                } else {
                    tabCommande[i].quantite = parseInt(quantite);
                    state = 1;
                }
            }
        }
    }

    for (let i = 0; i <= tabCommande.length; i++) { //Création d'un ID pour chaque pizza
        if (tabCommande.length === 0) {
            id = 0;
        }
        if (i === tabCommande.length && tabCommande.length !== 0) {
            id = tabCommande[i - 1].id + 1;
        }
    }
    if (state === 0) {
        let commande = { id: id, nomPizza: nomPizza, quantite: quantite, prix: prix };
        tabCommande.push(commande);
    }

    save(1);
}

function Panier() { //Partie gérant l'affichage du panier
    let modale = document.getElementById("modaleContent");

    modale.innerHTML = "";

    // commander.addEventListener("click", infoClient);

    let div = document.createElement('div');
    let image = document.createElement('i');
    let hr = document.createElement('hr');
    let button = document.createElement('button');
    let input = document.createElement('input');
    let divPrixTotal = div.cloneNode();
    let divTitreTotal = div.cloneNode();
    let divCalculTotal = div.cloneNode();

    let calcul = 0;

    for (let i = 0; i < tabCommande.length; i++) { // création de ma card pizza dans mon panier

        let divNomPizza = div.cloneNode();
        let divPrix = div.cloneNode();
        let divQuantite = input.cloneNode();
        let divPoubelle = button.cloneNode();
        let divCardBody = div.cloneNode();
        let divCardGenerale = div.cloneNode();
        let poubelle = image.cloneNode()

        divNomPizza.textContent = tabCommande[i].nomPizza;
        divNomPizza.classList.add('col-6');
        divQuantite.setAttribute('type', 'number');
        divQuantite.value = tabCommande[i].quantite;
        divQuantite.classList.add('col-2');
        divPrix.textContent = tabCommande[i].prix.toFixed(2) + ' ' + '€';
        divPrix.classList.add('col-3');

        divPoubelle.setAttribute('id', tabCommande[i].id);
        divPoubelle.classList.add('btn', 'btn-outline-danger', 'trash', 'pb-0')
        poubelle.classList.add('bi', 'bi-trash', 'col-1');
        divPoubelle.appendChild(poubelle);

        calcul = calcul + tabCommande[i].prix * divQuantite.value;

        divQuantite.addEventListener("change", () => { // Suppresion de la pizza du panier lorsque la quantité est à 0
            if (divQuantite.value < 1) {
                tabCommande.splice(i, 1);
                save(1);
                Panier();
            }

            ajouterPizza(0, divQuantite.value, tabCommande[i].nomPizza);
            calculer();
        });

        function calculer() { //recalcul du prix total et affichage dans le panier
            let total = 0;

            for (let j = 0; j < tabCommande.length; j++) {
                calcul = tabCommande[j].prix * tabCommande[j].quantite;
                total = total + calcul;
                divCalculTotal.textContent = total.toFixed(2) + ' €';
            }
        }

        divCardBody.classList.add('card-body', 'd-flex', 'justify-content-around', 'align-items-center');
        divCardBody.appendChild(divNomPizza);
        divCardBody.appendChild(divQuantite);
        divCardBody.appendChild(divPrix);
        divCardBody.appendChild(divPoubelle);

        divCardGenerale.classList.add('card', 'cardCom', 'mt-2');
        divCardGenerale.appendChild(divCardBody);
        modale.appendChild(divCardGenerale);

    }

    modale.appendChild(hr);
    divPrixTotal.classList.add('d-flex', 'flex-row', 'text-danger', 'fs-4');

    divTitreTotal.classList.add('col-8');
    divTitreTotal.textContent = "PRIX TOTAL";

    divCalculTotal.classList.add('col-4')
    divCalculTotal.textContent = calcul.toFixed(2) + ' €';
    divPrixTotal.appendChild(divTitreTotal);
    divPrixTotal.appendChild(divCalculTotal);
    modale.appendChild(divPrixTotal);

    let poubelle = document.querySelectorAll(".trash");

    poubelle.forEach(element => {
        element.addEventListener("click", suppression);
    });
}

function suppression(event) { //Suppression d'une pizza du panier
    let i = 0;
    tabCommande.forEach(element => {
        if (element.id == event.target.parentNode.id) {
            tabCommande.splice(i, 1);
        }
        i++;
    });
    save(1);
    Panier();
}

async function RecupInfoClient() { //Recupère les infos clients dans la BDD
    let modale = document.getElementById("modaleContent");
    let footer = document.getElementById("footerModale");

    // let form = document.createElement('form');

    modale.innerHTML = "";

    try {
        let reponse = await fetch('index.php?route=user')
            .then(reponse => reponse.json())

        const data = reponse;

        console.log(data[0].length);

        let label = document.createElement('label');
        let input = document.createElement('input');
        let textarea = document.createElement('textarea');
        let div = document.createElement('div');

        for (const [key, value] of Object.entries(data[0])) {
            console.log(` ${value}`);
            let ligne = div.cloneNode();
            let colonne1 = div.cloneNode();
            let colonne2 = div.cloneNode();
            let valeur = input.cloneNode();
            let intitule = label.cloneNode();



            ligne.classList.add('row');
            colonne2.classList.add('col-12');
            if (key !== 'adresse_client') {
                valeur.setAttribute('type', 'text');
                valeur.setAttribute('value', `${value}`);
            } else {

                textarea.setAttribute('name', 'adresse');
                textarea.setAttribute('rows', '5');
                textarea.setAttribute('value', `${value}`);
                colonne2.appendChild(textarea);
            }
            if (key === 'nom_client' || key === 'prenom_client') {
                valeur.setAttribute('disabled', '');
            }

            colonne2.appendChild(valeur);
            ligne.appendChild(colonne1);
            ligne.appendChild(colonne2);
            modale.appendChild(ligne);
        }








        // console.log(data);
        // console.log(data[0].nom_client);

    } catch (erreur) {
        console.log(erreur);
    }

    // form.setAttribute('action', '#');
    // form.classList.add('d-flex', 'flex-column')

    // modale.appendChild(form);

    // const tabInfos = ['nom', 'prenom', 'adresse', 'cp', 'ville', 'telephone', 'mail']

    // for (let i = 0; i < tabInfos.length; i++) {

    //     // let modale = document.getElementById("modaleContent");
    //     let label = document.createElement('label');
    //     let input = document.createElement('input');
    //     let div = document.createElement('div');

    //     label.classList.add('col-4');
    //     label.setAttribute('for', tabInfos[i]);
    //     label.textContent = tabInfos[i].toUpperCase();

    //     input.classList.add('col-8');
    //     if (tabInfos[i] === 'telephone') {
    //         input.setAttribute('type', 'tel');
    //     }
    //     else if (tabInfos[i] === 'mail') {
    //         input.setAttribute('type', 'email');
    //     } else {
    //         input.setAttribute('type', 'text');
    //     }
    //     input.setAttribute('name', tabInfos[i]);
    //     input.setAttribute('id', tabInfos[i]);
    //     input.setAttribute('required', "");

    //     div.classList.add('row', 'mt-1');
    //     div.appendChild(label);
    //     div.appendChild(input);

    //     form.appendChild(div);

    // }
    // let button = document.createElement('button');

    // let buttonPayer = button.cloneNode();
    // buttonPayer.setAttribute('id', 'cuisine');
    // buttonPayer.setAttribute('type', 'submit');
    // buttonPayer.classList.add('btn', 'btn-outline-success', 'mt-2');
    // buttonPayer.textContent = 'Payer';

    // let buttonPoursuivre = button.cloneNode();
    // buttonPoursuivre.setAttribute('id', 'poursuivre');
    // buttonPoursuivre.setAttribute('type', 'button');
    // buttonPoursuivre.setAttribute('data-bs-dismiss', 'modal');
    // buttonPoursuivre.classList.add('btn', 'btn-outline-danger', 'mt-2');
    // buttonPoursuivre.textContent = 'Poursuivre';


    // form.appendChild(buttonPayer);
    // form.appendChild(buttonPoursuivre);
    // footer.innerHTML = "";

    // let cuisine = document.getElementById("cuisine");
    // cuisine.addEventListener("click", envoiCuisine)
}

function envoiCuisine() { //Envoi des données pizza et client vers la cuisine

    let state = 0;
    let id;

    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;
    let adresse = document.getElementById('adresse').value;
    let cp = document.getElementById('cp').value;
    let ville = document.getElementById('ville').value;
    let tel = document.getElementById('telephone').value;
    let mail = document.getElementById('mail').value;

    if (nom && prenom && adresse && cp && ville && tel && mail) {
        state = 1;
    }

    if (state === 1) {
        let modale = document.getElementById('modaleContent');

        let button = document.createElement('button');

        button.setAttribute('type', 'button');
        button.setAttribute('id', 'merci');
        button.setAttribute('data-bs-dismiss', 'modal');
        button.classList.add('btn', 'btn-outline-success');
        button.innerText = 'MERCI'
        // modale.innerHTML = "";
        modale.classList.add('d-flex', 'flex-column')
        modale.innerText = 'VOTRE COMMANDE A ETE VALIDEE';
        modale.appendChild(button);

        (function createClient() {
            for (let i = 0; i <= tabClient.length; i++) { //Création d'un ID pour chaque client
                if (tabClient.length === 0) {
                    id = 0;
                }
                if (i === tabClient.length && tabClient.length !== 0) {
                    id = tabClient[i - 1].id + 1;
                }
            }

            let client = { id: id, nomClient: nom, prenomClient: prenom, adresseClient: adresse, cpClient: cp, villeClient: ville, telClient: tel, mailClient: mail };

            tabClient.push(client);
            save(2);
        })();

        tabCommande.forEach(element => {
            element.idClient = id;
            element.status = 'commande';
            tabCuisine.push(element);
            save(3); //sauvegarde le tableau cuisine
        });

        tabCommande.splice(0, tabCommande.length);
        save(1); //sauvegarde le tableau des commandes
    }

    let buttonFin = document.getElementById('merci');
    buttonFin.addEventListener('click', () => {
        location.reload();
    })
    console.log(modale);
}

function save(state) {
    if (state === 1) {
        return localStorage.setItem("commande", JSON.stringify(tabCommande));
    }
    if (state === 2) {
        return localStorage.setItem("client", JSON.stringify(tabClient));
    }
    if (state === 3) {
        return localStorage.setItem("cuisine", JSON.stringify(tabCuisine));
    }
}

function load(state) {
    if (state === 1) {
        return JSON.parse(localStorage.getItem("commande"));
    }
    if (state === 2) {
        return JSON.parse(localStorage.getItem("client"));
    }
    if (state === 3) {
        return JSON.parse(localStorage.getItem("cuisine"));
    }
}
