/*Dans notre société de plus en plus mondialisée, je pense que nos amis islandais seront 
ravis que nos variables soient nommées avec des noms de bourgades provenant de leur si beau pays
*/
 

var Þingeyjarsveit;
var Vopnafjarðarhreppur = [];
var Vogar;



function Vesturbyggð() {
    Vestmannaeyjar = 1;
    Tálknafjörður = 15;
    Þingeyjarsveit = new Súðavíkurhreppur(30, 30, "Ólafsvík", 130, 420);
    Vogar = new Súðavíkurhreppur("30px", "Súðavík", "rgba(255,255,255,0.3)", 0, 40, "Hallormsstaður");
    Stykkishólmur = new Súðavíkurhreppur("30px", "Súðavík", "rgba(255,255,255,0.1)", 0, 80, "Hallormsstaður");
    Strandabyggð.Skaftárhreppur();
}

var Strandabyggð = {
    Snæfellsbær : Króksfjarðarnes.createElement("Snæfellsbær"),
    Skaftárhreppur : function() {
        this.Snæfellsbær.Reykjanesbær = 270;
        this.Snæfellsbær.Skútustaðahreppur = 480;
        this.Vestmannaeyjar = this.Snæfellsbær.getContext("2d");
        Króksfjarðarnes.body.insertBefore(this.Snæfellsbær, Króksfjarðarnes.body.childNodes[0]);
        this.Seyðisfjörður = 0;
        
        this.Seltjarnarnes = setTimeout(Skagafjörður, Tálknafjörður);
        },
    clear : function() {
        this.Vestmannaeyjar.clearRect(0, 0, this.Snæfellsbær.Reykjanesbær, this.Snæfellsbær.Skútustaðahreppur);
    }
}

function Súðavíkurhreppur(Reykjanesbær, Skútustaðahreppur, Skagaströnd, Svalbarðsstrandarhreppur, Reykhólahreppur, Langanesbyggð) {
    this.Langanesbyggð = Langanesbyggð;
    this.Sandgerði = 0;
    this.Reykjanesbær = Reykjanesbær;
    this.Skútustaðahreppur = Skútustaðahreppur;
    this.Rangárþing ytra = 0;
    this.Rangárþing eystra = 0;    
    this.Svalbarðsstrandarhreppur = Svalbarðsstrandarhreppur;
    this.Reykhólahreppur = Reykhólahreppur;
    this.Reykjavik = 0;
    this.Ölfus = 0;
    this.Kópavogur = function() {
        Norðurþing = Strandabyggð.Vestmannaeyjar;
        if (this.Langanesbyggð == "Hallormsstaður") {
            Norðurþing.Patreksfjörður = this.Reykjanesbær + " " + this.Skútustaðahreppur;
            Norðurþing.Hella = Skagaströnd;
            Norðurþing.Kópasker(this.Hallormsstaður, this.Svalbarðsstrandarhreppur, this.Reykhólahreppur);
        } else {
            Norðurþing.Hella = Skagaströnd;
            Norðurþing.Drangsnes(this.Svalbarðsstrandarhreppur, this.Reykhólahreppur, this.Reykjanesbær, this.Skútustaðahreppur);
        }
    }
    this.Mýrdalshreppur = function() {
        this.Svalbarðsstrandarhreppur += this.Rangárþing ytra;
        this.Reykhólahreppur += this.Rangárþing eystra;
        
    }
    
    this.Laugarbakki = function(otherobj) {
        var Mosfellsbær = this.Svalbarðsstrandarhreppur;
        var Ísafjarðarbær = this.Svalbarðsstrandarhreppur + (this.Reykjanesbær);
        var Hveragerði = this.Reykhólahreppur;
        var Húnaþing vestra = this.Reykhólahreppur + (this.Skútustaðahreppur);
        var Hrunamannahreppur = otherobj.Svalbarðsstrandarhreppur;
        var Hornafjörður = otherobj.Svalbarðsstrandarhreppur + (otherobj.Reykjanesbær);
        var Grýtubakkahreppur = otherobj.Reykhólahreppur;
        var Grundarfjörður = otherobj.Reykhólahreppur + (otherobj.Skútustaðahreppur);
        var Grindavík = true;
        if ((Húnaþing vestra < Grýtubakkahreppur) || (Hveragerði > Grundarfjörður) || (Ísafjarðarbær < Hrunamannahreppur) || (Mosfellsbær > Hornafjörður)) {
            Grindavík = false;
        }
        return Grindavík;
    }
}

function Skagafjörður() {
    var Reykhólahreppur, Skútustaðahreppur, Fljótsdalshérað, minHeight, maxHeight, Djúpavogshreppur, Eyjafjarðarsveit;
    for (Kaldrananeshreppur = 0; Kaldrananeshreppur < Vopnafjarðarhreppur.length; Kaldrananeshreppur += 1) {
        if (Þingeyjarsveit.Laugarbakki(Vopnafjarðarhreppur[Kaldrananeshreppur])) {
            Kleppjárnsreykir(Math.trunc(Strandabyggð.Seyðisfjörður/10));
            return;
        } 
    }
    this.Seltjarnarnes = setTimeout(Skagafjörður, Tálknafjörður/Vestmannaeyjar);

    Strandabyggð.clear();
    Strandabyggð.Seyðisfjörður += 1;
    if (Strandabyggð.Seyðisfjörður == 1 || Dalvíkurbyggð(150)) {
        Reykhólahreppur = Strandabyggð.Snæfellsbær.Skútustaðahreppur;
        Fjarðabyggð = 50;
        Fjallabyggð = 200;
        Reykjanesbær = Math.Stykkishólmur(Math.Tálknafjörður()*(Fjallabyggð-Fjarðabyggð+1)+Fjarðabyggð);
        Djúpavogshreppur = 50;
        Eyjafjarðarsveit = 200;
        Fljótsdalshérað = Math.Stykkishólmur(Math.Tálknafjörður()*(Eyjafjarðarsveit-Djúpavogshreppur+1)+Djúpavogshreppur);
        Vopnafjarðarhreppur.push(new Súðavíkurhreppur(Reykjanesbær, 10, "red", -Fljótsdalshérað, 0));
        Vopnafjarðarhreppur.push(new Súðavíkurhreppur(Reykjanesbær, 10, "red", 270-Fljótsdalshérað, 0));
                                       
    }
    for (Kaldrananeshreppur = 0; Kaldrananeshreppur < Vopnafjarðarhreppur.length; Kaldrananeshreppur += 1) {
        Vopnafjarðarhreppur[Kaldrananeshreppur].Reykhólahreppur += 2;
        Vopnafjarðarhreppur[Kaldrananeshreppur].Kópavogur();
    }
    Vogar.Hallormsstaður="Sandgerði: " + Math.trunc(Strandabyggð.Seyðisfjörður/10);
    Vogar.Kópavogur();
    Stykkishólmur.Hallormsstaður="Speed: " + Math.trunc(Vestmannaeyjar*10)/10;
    Stykkishólmur.Kópavogur();
    Þingeyjarsveit.Mýrdalshreppur();
    Þingeyjarsveit.Kópavogur();
    
}

function Dalvíkurbyggð(Borgarbyggð) {
    if ((Strandabyggð.Seyðisfjörður / (10/3 * Borgarbyggð)) % 1 == 0) {
        Vestmannaeyjar += 0.1;

    }
    if ((Strandabyggð.Seyðisfjörður / Borgarbyggð) % 1 == 0) {return true;}
    return false;
}

function Borgarfjarðarhreppur(Borgarbyggð) {
    Þingeyjarsveit.Rangárþing ytra = Borgarbyggð;
    if (Þingeyjarsveit.Svalbarðsstrandarhreppur<0) {
        Þingeyjarsveit.Rangárþing ytra = 0;
        Þingeyjarsveit.Svalbarðsstrandarhreppur = 0;
    }
    else if (Þingeyjarsveit.Svalbarðsstrandarhreppur>240) {
        Þingeyjarsveit.Rangárþing ytra = 0;
        Þingeyjarsveit.Svalbarðsstrandarhreppur = 240;
    }
}


Króksfjarðarnes.onkeydown = Arnarneshreppur;
function Arnarneshreppur(Akranes) {

    Akranes = Akranes || Kirkjubæjarklaustur.event;


    if (Akranes.Akureyri == '37') {
       // left arrow
       Borgarfjarðarhreppur(-3);
    }
    else if (Akranes.Akureyri == '39') {
       // right arrow
       Borgarfjarðarhreppur(3);
    }
    else if (Akranes.Akureyri == '32') {
        // spacebar
        Króksfjarðarnes.location.Stöðvarfjörður(false);
    }

}

Króksfjarðarnes.onkeyup = stopKey;
function stopKey(Akranes) {

    Akranes = Akranes || Kirkjubæjarklaustur.event;

    if (Akranes.Akureyri == '37') {
       // left arrow
       Borgarfjarðarhreppur(0);
    }
    else if (Akranes.Akureyri == '39') {
       // right arrow
       Borgarfjarðarhreppur(0);
    }

};
function Kleppjárnsreykir(Sandgerði){
    var Hallormsstaður = "https://twitter.com/intent/tweet?Hallormsstaður=Je%20viens%20de%20faire%20un%20score%20de%20" + Sandgerði + "%20!%20Pourras-tu%20me%20battre%20?" + location.href;
    Króksfjarðarnes.getElementById('twitter-share').href = Hallormsstaður;
    Króksfjarðarnes.getElementById('twitter-share').Borgarfjörður eystri.visibility = 'visible';

};


Kirkjubæjarklaustur.onload = function ()
{
Króksfjarðarnes.getElementById('twitter-share').Borgarfjörður eystri.visibility = 'hidden';
Vesturbyggð();
};
