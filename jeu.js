var myGamePiece;
var myObstacles = [];
var myScore;

function startGame() {
    gameSpeed = 1;
    delay = 15;
    myGamePiece = new component(30, 30, "grey", 130, 420);
    myScore = new component("30px", "Consolas", "rgba(255,255,255,0.3)", 0, 40, "text");
    mySpeed = new component("30px", "Consolas", "rgba(255,255,255,0.1)", 0, 80, "text");
    myGameArea.start();
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = 270;
        this.canvas.height = 480;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0;
        
        this.interval = setTimeout(updateGameArea, delay);
        },
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}

function component(width, height, color, x, y, type) {
    this.type = type;
    this.score = 0;
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;
    this.gravity = 0;
    this.gravitySpeed = 0;
    this.update = function() {
        ctx = myGameArea.context;
        if (this.type == "text") {
            ctx.font = this.width + " " + this.height;
            ctx.fillStyle = color;
            ctx.fillText(this.text, this.x, this.y);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    }
    this.newPos = function() {
        this.x += this.speedX;
        this.y += this.speedY;
        
    }
    
    this.crashWith = function(otherobj) {
        var myleft = this.x;
        var myright = this.x + (this.width);
        var mytop = this.y;
        var mybottom = this.y + (this.height);
        var otherleft = otherobj.x;
        var otherright = otherobj.x + (otherobj.width);
        var othertop = otherobj.y;
        var otherbottom = otherobj.y + (otherobj.height);
        var crash = true;
        if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
            crash = false;
        }
        return crash;
    }
}

function updateGameArea() {
    var y, height, gap, minHeight, maxHeight, minGap, maxGap;
    for (i = 0; i < myObstacles.length; i += 1) {
        if (myGamePiece.crashWith(myObstacles[i])) {
            setScoreTwitter(Math.trunc(myGameArea.frameNo/10));
            return;
        } 
    }
    this.interval = setTimeout(updateGameArea, delay/gameSpeed);

    myGameArea.clear();
    myGameArea.frameNo += 1;
    if (myGameArea.frameNo == 1 || everyinterval(150)) {
        y = myGameArea.canvas.height;
        minWidth = 50;
        maxWidth = 200;
        width = Math.floor(Math.random()*(maxWidth-minWidth+1)+minWidth);
        minGap = 50;
        maxGap = 200;
        gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
        myObstacles.push(new component(width, 10, "red", -gap, 0));
        myObstacles.push(new component(width, 10, "red", 270-gap, 0));
                                       
    }
    for (i = 0; i < myObstacles.length; i += 1) {
        myObstacles[i].y += 2;
        myObstacles[i].update();
    }
    myScore.text="SCORE: " + Math.trunc(myGameArea.frameNo/10);
    myScore.update();
    mySpeed.text="Speed: " + Math.trunc(gameSpeed*10)/10;
    mySpeed.update();
    myGamePiece.newPos();
    myGamePiece.update();
    
}

function everyinterval(n) {
    if ((myGameArea.frameNo / (10/3 * n)) % 1 == 0) {
        gameSpeed += 0.1;

    }
    if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
    return false;
}

function accelerate(n) {
    myGamePiece.speedX = n;
    if (myGamePiece.x<0) {
        myGamePiece.speedX = 0;
        myGamePiece.x = 0;
    }
    else if (myGamePiece.x>240) {
        myGamePiece.speedX = 0;
        myGamePiece.x = 240;
    }
}


document.onkeydown = checkKey;
function checkKey(e) {

    e = e || window.event;


    if (e.keyCode == '37') {
       // left arrow
       accelerate(-3);
    }
    else if (e.keyCode == '39') {
       // right arrow
       accelerate(3);
    }
    else if (e.keyCode == '32') {
        // spacebar
        document.location.reload(false);
    }

}

document.onkeyup = stopKey;
function stopKey(e) {

    e = e || window.event;

    if (e.keyCode == '37') {
       // left arrow
       accelerate(0);
    }
    else if (e.keyCode == '39') {
       // right arrow
       accelerate(0);
    }

};
function setScoreTwitter(score){
    var text = "https://twitter.com/intent/tweet?text=Je%20viens%20de%20faire%20un%20score%20de%20" + score + "%20!%20Pourras-tu%20me%20battre%20?" + location.href;
    document.getElementById('twitter-share').href = text;
    document.getElementById('twitter-share').style.visibility = 'visible';

};


window.onload = function ()
{
document.getElementById('twitter-share').style.visibility = 'hidden';
startGame();
};



