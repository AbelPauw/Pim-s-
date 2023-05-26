function GetTimeLoggedIn() {
    const firstname = document.getElementById('firstname').innerHTML; //Pak de voornaam van een hidden <h1>
    const volledigeTijd = new Date; //Pak de tijd van de gebruiker
    const hour = volledigeTijd.getHours(); //Verander de volledige tijd naar alleen de uren
    const output = document.getElementById('time'); //geef aan waar de groet te zien is
    let bericht; //Variabel om het bericht op te slaan die wordt bekeken met de switch statement

    switch (true) {
        case hour > 17: //Als het avond is
            bericht = "Good evening " + firstname + "!";;
            break;
        case hour > 11: //Als het middag is
            bericht = "Good afternoon " + firstname + "!";;
            break;
        case hour > 5: //als het ochtend is
            bericht = "Good morning " + firstname + "!";
            break;
        default: //Als het middennacht is
            bericht = "Good night, sleep well " + firstname + "!";
            break;
    }
    output.innerHTML = bericht; //Het bericht wordt gedaan op de html via innerHTML
}

GetTimeLoggedIn(); //Functie roepen

function contact() {
    const cards = document.getElementsByClassName('kaartje');
    const form = document.getElementsByClassName('contat');
    for (let i = cards.length - 1; i >= 0; i--) {
        cards[i].remove();
    }
    for (let i = 0; form.length > i; i++) {
        form[i].removeAttribute('hidden');
    }
}

