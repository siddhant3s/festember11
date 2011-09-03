var bgCanvas,drawCanvas,lidCanvas,bgContext,drawContext,lidContext;
var leveldesc,bar=new Array(),persons=new Array(),coins=new Array(),secam=new Array();
var dimension,gamestarted=0,level,score=-1,user=0,ajax,personcount,coincount=5,lives=3,securityCam=0;
var leftpad=10,toppad=10,grid=30,block,padding,arclen=4,arcspread=(60*Math.PI)/180;
var rep;
var checkdiv,dir="d";

var pesonimage,barimage,bgimage,coinimage,lifeimage;
var winsound,scoresound,losssound,lifesound;

function gi(el){
	return document.getElementById(el);
}
function bodyLoad(){
	if(window.XMLHttpRequest)
		ajax=new XMLHttpRequest();
	else
		ajax=new ActiveXObject("Microsoft.XMLHTTP");
	getUser();
	getLevel();
			
	bgCanvas=gi("backgroundCanvas");
	drawCanvas=gi("scratchpadCanvas");
	lidCanvas=gi("lidCanvas");
	
	bgContext=bgCanvas.getContext("2d");
	drawContext=drawCanvas.getContext("2d");
	lidContext=lidCanvas.getContext("2d");
	
	getDimension();
	bgCanvas.width=dimension;
	bgCanvas.height=dimension;
	drawCanvas.width=dimension;
	drawCanvas.height=dimension;
	lidCanvas.width=dimension;
	lidCanvas.height=dimension;
	
	drawContext.font = "bold 20px sans-serif";
	block=Math.floor(dimension/grid);
	padding=(dimension-(block*grid))/2;
	arclen*=block;
	
	checkdiv=gi("checkdiv");
	bar[0]=30;
	bar[1]=500;
	bgContext.fillStyle="#333";
	bgContext.fillRect(0,0,bgCanvas.width,bgCanvas.height);
	welcomeGame();
}
function keyPress(e){
	if(!gamestarted){
		gamestarted=1;
		gameInit();
		return;
	}
	e.preventDefault();
	switch(e.keyCode){
	case 37:
		dir="l";
		break;
	case 38:
		dir="u";
		break;
	case 39:
		dir="r";
		break;
	case 40:
		dir="d";
		break;
	case 116:
		gameStop();
		window.location.reload();
		return;
	case 65:
		pickCoin();
		return;
	}	
	moveBar(dir);
}

function welcomeGame(){
	personimage=new Array();
	personimage["u"]=gi("personu");
	personimage["d"]=gi("persond");
	personimage["l"]=gi("personl");
	personimage["r"]=gi("personr");
	barimage=new Array();
	barimage["u"]=gi("baru");
	barimage["d"]=gi("bard");
	barimage["l"]=gi("barl");
	barimage["r"]=gi("barr");
	bgimage=gi("bgimage");
	coinimage=gi("coin");
	lifeimage=gi("life");
	drawContext.clearRect(drawCanvas.width/2-50,drawCanvas.height/2-50,120,50);
	drawContext.fillStyle="#999";
	drawContext.font = "bold 20px sans-serif";
	drawContext.fillText("Press any key to play Vigilante!",drawCanvas.width/2-150,drawCanvas.height/2-20);
}

function getDimension(){
	if(typeof(window.innerWidth)!="undefined")
		dimension=window.innerWidth>window.innerHeight?window.innerHeight:window.innerWidth;
	else if(typeof(document.body)!="undefined" && typeof(document.body.offsetWidth)!="undefined")
		dimension=document.body.offsetWidth>document.body.offsetHeight?document.body.offsetHeight:document.body.offsetWidth;
	else if(typeof(document.documentElement)!="undefined" && typeof(document.documentElement.offsetWidth)!="undefined")
		dimension=document.documentElement.offsetWidth>document.documentElement.offsetHeight?document.documentElement.offsetHeight:document.documentElement.offsetWidth;
	if(dimension%2==0)
		dimension-=20;
	else
		dimension-=19;
	if(dimension<600)
		dimension=600;
}
function gameInit(){
	bar[0]=bar[1]=Math.floor(grid/2);
	var k,j;
	//bgContext.drawImage(bgimage,0,0,bgCanvas.width,bgCanvas.height);
	for(i=0;i<coincount;++i)
		coins[i]=new Array();
	drawCanvas.width=drawCanvas.width;
	drawContext.fillStyle="#eee";
	for(var i=leveldesc.length-1;i>=0;--i)
		if(leveldesc[i]=="1")
			drawContext.fillRect(padding+block*(i%grid),padding+block*Math.floor(i/grid),block,block);
	lidContext.fillStyle="#990";
	lidContext.font = "bold 16px sans-serif";
	lidContext.fillText(user,20,20);
	lidContext.fillText("Score:",20,40);
	for(var temp=personcount-1;temp>=0;--temp){
		persons[temp]=new Array();//x,x,canvas,interval,dir
		do{
			j=Math.floor(Math.random()*100)%grid;
			k=Math.floor(Math.random()*100)%grid;
			if(leveldesc[j+k*grid]=="1")
				persons[temp][0]=-1;
			else{
				persons[temp][0]=j;
				persons[temp][1]=k;
			}
		}while(persons[temp][0]==-1);
		j=Math.floor(Math.random()*100);
		if(j<25)
			persons[temp][4]="u";
		else if(j<50)
			persons[temp][4]="d";
		else if(j<75)
			persons[temp][4]="r";
		else
			persons[temp][4]="l";
		showPerson(temp);
		attachArc(temp);
	}
	updateScore();
	for(i=coincount-1;i>=0;--i){
		temp=Math.floor(Math.random()*100);
		getNextFree(coins[i]);
		showCoin(i);
	}
	if(securityCam)
		securityArc();
	showBar();
	showLives();
	gameStart();
}
function gameStart(){
	var i,c=1;
	
	rep=window.setInterval(function(){
		for(var i=persons.length-1;i>=0;--i)
			movePerson(i);
		for(i=coins.length-1;i>=0;--i)
			if(coins[i][0]!=-1)
				showCoin(i);
		showBar();
		if(c%4==0){
			putCoins();
			c=1;
		}
		else c++;
		if(score>=20)
			gameWin();
	},200);
}
function gameWin(){
	if(hasWonServer()){
		alert("Congratulations! You won!");
		//updateLevel();
		gameStop();
	}
}
function gameStop(){
	window.clearInterval(rep);
	for(var i=persons.length-1;i>=0;--i)
		dropArc(i);
	gamestarted=0;
	//window.location.reload();
}
function putCoins(){
	var i,d,j,k;
	for(i=coincount-1;i>=0;--i){
		d=Math.floor(Math.random()*100);
		if(d<5){
			if(coins[i][0]!=-1)
				hideCoin(i);
			getNextFree(coins[i]);
			showCoin(i);
		} else if(d>95 && coins[i][0]!=-1){
			removeCoin(i);
		}
	}
}
function getNextFree(arr){
	var j,k
	do{
		j=Math.floor(Math.random()*100)%grid;
		k=Math.floor(Math.random()*100)%grid;
		if(leveldesc[j+k*grid]=="1")
			arr[0]=-1;
		else{
			arr[0]=j;
			arr[1]=k;
		}
	}while(arr[0]==-1);
}
function removeCoin(cn){
	hideCoin(cn);
	coins[cn][0]=-1;
}
function pickCoin(){
	var x,pn;
	
	var xx,yy;
	switch(dir){
	case "l":
		xx=bar[0]-1;yy=bar[1];
		break;
	case "r":
		xx=bar[0]+1;yy=bar[1];break;
	case "u":
		xx=bar[0];yy=bar[1]-1;break;
	case "d":
		xx=bar[0];yy=bar[1]+1;break;
	}
	if(xx>=0 && yy>=0 && xx<grid && yy<grid)
		for(x=coins.length-1;x>=0;--x)
			if(coins[x][0]==xx && coins[x][1]==yy){
				for(pn=persons.length-1;pn>=0;--pn)
					checkSight(bar,persons[pn][2].getContext("2d"),persons[pn][2]);
				if(securityCam)
					checkSight(bar,secam[2].getContext("2d"),secam[2]);
				removeCoin(x);
				updateScore();
			}
}
function updateScore(){
	++score;
	lidContext.clearRect(75,25,100,100);
	lidContext.fillStyle="#a0a";
	lidContext.fillText(score,80,40);
	updateScoreServer();
}
function attachArc(pn){
	var x,y, angle=(0*Math.PI)/180, step=Math.PI/180,div=0,pi=Math.PI/180,dirsign=1;;
	persons[pn][2]=gi("wrapper").appendChild(document.createElement("canvas"));
	persons[pn][2].width=persons[pn][2].height=1.5*arclen;
	alignBox(pn);
	var con=persons[pn][2].getContext("2d");
	persons[pn][3]=window.setInterval(function(){
		persons[pn][2].height=persons[pn][2].height;
		switch(persons[pn][4]){
		case 'l':
			x=persons[pn][2].width;
			y=persons[pn][2].height/2;
			angle=Math.PI;
			break;
		case 'u':
			x=persons[pn][2].width/2;
			y=persons[pn][2].height;
			angle=Math.PI/2;
			break;
		case 'd':
			x=persons[pn][2].width/2;
			y=0;
			angle=-Math.PI/2;
			break;
		case 'r':
			x=0;
			y=persons[pn][2].height/2;
			angle=0;
			break;
		}
		con.moveTo(x,y);
		if(div>=20 || div<=-20)
			dirsign*=-1;
		div+=dirsign;
		con.arc(x,y,arclen,-1*(angle+div*pi-(arcspread/2)),-1*(angle+div*pi+(arcspread/2)),true);
		con.fillStyle="rgba(0,0,200,0.3)";
	
		con.fill();
			},25);
	
}
function securityArc(direction){
	var x,y, angle=(135*Math.PI)/180, step=Math.PI/180,div=0,pi=Math.PI/180,dirsign=1,arclen=250;
	x=arclen;
	y=arclen;
	secam[2]=gi("wrapper").appendChild(document.createElement("canvas"));
	secam[2].width=secam[2].height=arclen;
	secam[2].style.left=leftpad+drawCanvas.width-secam[2].width;
	secam[2].style.top=toppad+drawCanvas.height-secam[2].height;
	var con=secam[2].getContext("2d");
	secam[3]=window.setInterval(function(){
		secam[2].height=arclen;
		con.moveTo(x,y);
		if(div>=40 || div<=-40)
			dirsign*=-1;
		div+=dirsign;
		con.arc(x,y,arclen,-1*(angle+div*pi-(arcspread/2)),-1*(angle+div*pi+(arcspread/2)),true);
		con.fillStyle="rgba(0,50,200,0.3)";
		con.fill();
			},50);
}
function dropArc(pn){
	window.clearInterval(persons[pn][3]);
	gi("wrapper").removeChild(persons[pn][2]);
	if(securityCamera){
		gi("wrapper").removeChild(secam[2]);
		window.clearInterval(secam[3]);
	}	
	persons[pn][2]=null;
}
function movePerson(pn){
	var d,dorand=1,tdir=persons[pn][4];
	hidePerson(pn);
	for(d=persons.length-1;d>=0;--d){
		if(d==pn)
			continue;
		if(Math.abs(persons[pn][0]-persons[d][0])<=1 && Math.abs(persons[pn][1]-persons[d][1]<=1)){
			var a=tdir;
			do{
				tdir=getRandDir(tdir);
			} while(a==tdir);
			dorand=0;
		}
	}
	if(dorand)
		tdir=getRandDir(persons[pn][4]);
	getNext(persons[pn],tdir);
	persons[pn][4]=tdir;
	showPerson(pn);
	alignBox(pn);
}
function getRandDir(org){
	var v1=Math.floor(Math.random()*100),v2;
	if(v1>80){
		if(v1<85)
			v2="u";
		else if(v1<90)
			v2="d";
		else if(v1<95)
			v2="l";
		else
			v2="r";
	} else
		v2=org;
	return v2;
}
function showLives(){
	lidContext.font="italic 16px Calibri,sans-serif";
	lidContext.fillStyle="#aed";
	lidContext.fillText("Lives",10,lidCanvas.height-50);
	for(var i=0;i<3;++i)
		lidContext.drawImage(lifeimage,10+i*40,lidCanvas.height-40,30,30);
}
function removeLives(){
	alert("caught");
	if(--lives>=0){
		lidContext.clearRect(10+lives*40,lidCanvas.height-40,30,30);
		hideBar();
		getNextFree(bar);
		showBar();
	}
	else
		gameStop();
}
function moveBar(direction){
	hideBar();
	getNext(bar,direction);
	showBar();
}
function getNext(imp,direction){
	switch(direction){
		case "l":
			if(imp[0]>0){
				if(leveldesc[imp[0]-1+imp[1]*grid]!="1")
					imp[0]-=1;
			} else
				imp[0]=0;
			break;
		case "r":
			if(imp[0]<grid-1){
				if(leveldesc[imp[0]+1+imp[1]*grid]!="1")
					imp[0]+=1;
			} else
				imp[0]=grid-1;
			break;
		case "u":
			if(imp[1]>0){
				if(leveldesc[imp[0]+(imp[1]-1)*grid]!="1")
					imp[1]-=1;
			} else
				imp[1]=0;
			break;
		case "d":
			if(imp[1]<grid-1){
				if(leveldesc[imp[0]+(imp[1]+1)*grid]!="1")
					imp[1]+=1;
			} else
				imp[1]=grid-1;
			break;
		}
}
function alignBox(pn){
	var d=persons[pn][2].width;
	switch(persons[pn][4]){
	case 'l':
		persons[pn][2].style.left=(leftpad+padding+persons[pn][0]*block-d)+"px";
		persons[pn][2].style.top=(toppad+padding+(persons[pn][1]+0.5)*block-(d/2))+"px";
		break;
	case 'u':
		persons[pn][2].style.left=(leftpad+padding+(persons[pn][0]+0.5)*block-(d/2))+"px";
		persons[pn][2].style.top=(toppad+padding+persons[pn][1]*block-d)+"px";
		break;
	case 'd':
		persons[pn][2].style.left=(leftpad+padding+(persons[pn][0]+0.5)*block-(d/2))+"px";
		persons[pn][2].style.top=(toppad+padding+(persons[pn][1]+1)*block)+"px";
		break;
	case 'r':
		persons[pn][2].style.left=(leftpad+padding+(persons[pn][0]+1)*block)+"px";
		persons[pn][2].style.top=(toppad+padding+(persons[pn][1]+0.5)*block-(d/2))+"px";
		break;
	}
}
function checkSight(target,context,canvas){
	var x=leftpad+padding+(target[0]*block)-parseInt(canvas.style.left),y=toppad+padding+(target[1]*block)-parseInt(canvas.style.top);
	if(!(x>0 && y>0 && x<canvas.width && y<canvas.height))
		return;
	if(context.isPointInPath(x,y) || context.isPointInPath(x+block,y) || context.isPointInPath(x,y+block) || context.isPointInPath(x+block,y+block)){
		context.fillStyle="#e00";
		context.fill();
		removeLives();
	}
}
function showPerson(pn){
	drawContext.drawImage(personimage[persons[pn][4]],padding+block*persons[pn][0],padding+block*persons[pn][1],block,block);
}
function hidePerson(pn){
	drawContext.clearRect(padding+block*persons[pn][0],padding+block*persons[pn][1],block,block);
	showBar();
	//show coins after person sweep
}
function showBar(){
	drawContext.drawImage(barimage[dir],padding+block*bar[0],padding+block*bar[1],block,block);
}
function hideBar(){
	drawContext.clearRect(padding+block*bar[0],padding+block*bar[1],block,block);
}
function showCoin(cn){
	drawContext.drawImage(coinimage,padding+block*coins[cn][0],padding+block*coins[cn][1],block,block);
}
function hideCoin(cn){
	drawContext.clearRect(padding+block*(coins[cn][0]),padding+block*(coins[cn][1]),block,block);
	showBar();
}

//backend interactions
function getUser(){
	user=gi("userinfo").value;
}
function getLevel(){
	level=parseInt(gi("levelinfo").value);
//	leveldesc=gi("leveldesc").value;
	leveldesc=   "000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000001111111111111111111100000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000111111111111100000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000"
				+"000000000000000000000000000000";
	var adds=gi("leveladds").value;
	personcount=parseInt(adds[0])+parseInt(adds[1]);
	coincount=parseInt(adds[2]);
	if(adds[3]=="s")
		securityCam=1;
}
function updateScoreServer(){
	//put the score on server
}
function hasWonServer(){
	//return int;1if won 0 if not
	/*
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status==200)
			if(ajax.responseText==1)
				return 1;
			else if(ajax.responseText==0)
				return 0;
		};
		ajax.open("GET","form.php?",true);
		ajax.send();
		*/
}
function updateLevel(){
	/*
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status==200)
			user=ajax.responseText;
		};
		ajax.open("POST","form.php",true);
		ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ajax.send(posts);
	*/
}
