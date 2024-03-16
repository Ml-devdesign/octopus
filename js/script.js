
let cpt= 1;

document.getElementById("btn").addEventListener("click", function(){
    if(cpt==1){
        let ul= document.createElement("ul");
        ul.setAttribute("id", "list");
        document.body.append(ul);
    }
   
    const li = document.createElement("li");
    li.innerText = ("Click")+" "+cpt++;
    document.getElementById("list").append(li);
    // alert("Hello World!");
});

ocument.getElementById("btn-table").addEventListener("click", function(){
    // Définir le nombre de colonnes et de lignes
    let colonnes = 6;
    let lignes = 5;

    // Créer la table et le corps du tableau
    let table = document.createElement("table");
    let tb = document.createElement("tbody");
   

    // Créer une ligne d'en-tête (th) et ajouter des cellules d'en-tête
    let entete = document.createElement("tr");
    // Boucle pour créer les cellules de l'entête
    for (let i = 0; i < colonnes; i++) {
        let th = document.createElement("th"); // Utiliser th pour les cellules d'en-tête
        th.style.backgroundColor = "yellow"; // Définir la couleur de fond 
        th.textContent = `Entête`; // Contenu de la cellule d'en-tête ajout de compteur -> ${i + 1}
        entete.appendChild(th); // Ajouter la cellule d'en-tête à la ligne d'entête
    }

    // Ajouter la ligne d'entête au corps du tableau
    tb.appendChild(entete);

    // Boucle pour créer les lignes
    for (let i = 0; i < lignes; i++) { 
        let tr = document.createElement("tr"); // Créer une nouvelle ligne (tr)

        // Boucle pour créer les cellules dans chaque ligne
        for (let j = 0; j < colonnes; j++) { 
            let td = document.createElement("td"); // Créer une nouvelle cellule (td)
            td.textContent = ` ${"Hey"} `;

            // Style de la bordure de la cellule
            table.style.borderColor = "#000000"; // Définir la couleur de la bordure
            table.style.borderWidth = "1px"; // Définir la largeur de la bordure
            table.style.borderStyle = "solid"; // Définir le style de la bordure
            
            // Ajouter la cellule à la ligne
            tr.appendChild(td); 
        }

        // Ajouter la ligne au corps du tableau
        tb.appendChild(tr);
    }

    // Ajouter le corps du tableau à la table
    table.appendChild(tb);

    // Ajouter la table au corps du document
    document.body.appendChild(table);
});






// document.getElementById("btn-table").addEventListener("click", function(){

//     if(cpt== 1){
//          // Créer la table et le corps du tableau
//         let table = document.createElement("table");
//         let tb = document.createElement("tbody");
//          tb.style.backgroundColor="yellow";

//         // Créer une ligne et une cellule dans le corps du tableau 
//         let tr = document.createElement("tr");
//         let td = document.createElement("td");

//          // Ajouter la cellule à la ligne et la ligne au corps du tableau
//         tr.appendChild(td);  
//         tb.appendChild(tr);

//         // Ajouter le corps du tableau à la table
//         table.appendChild(tb);

//         // Définir le texte de la cellule
//         td.textContent = ` ${"Hey"} `;

//          // Ajouter la table au corps du document
//         document.body.appendChild(table);
//         console.log(table); 

//     }
   
// }); 


  // let cellules = 5;
    // let tableau = new Array(cellules);
    // for (let i = 0; i < cellules; i++) {
    //     tableau[i] = new Array(cellules);
    // }
    // for (let i = 0; i < cellules; i++) {
    //     for (let j = 0; j < cellules; j++) {
    //         tableau[i][j] = cpt++;
    //     }
    // }