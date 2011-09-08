var bgCanvas,drawCanvas,lidCanvas,bgContext,drawContext,lidContext;
var leveldesc,bar=new Array(),persons=new Array(),coins=new Array(),secam;
var dimension,gamestarted=0,level=null,score=-1,user,personcount,coincount=5,lives=3,scmax,securityCam=0,timelimit;
var leftpad=0,toppad=0,grid=30,block,padding,arclen=4,arcspread=(60*Math.PI)/180;
var rep;
var dir="d",ajax1,ajax2,ajax3,bosom=0,bomb;

var pesonimage,barimage,bgimage,coinimage,lifeimage;
var winsound,scoresound,losssound,lifesound;

function toggleWelcome(){
	var item=gi("gameback").style,p,i=0;
	item.display="block";
	item.opacity=0;
	item.filter="alpha(opacity=0)";
	p=window.setInterval(function(){
		item.opacity=i;
		item.filter="alpha(opacity="+i*100+")";
		i+=0.2;
		if(i>1){
			window.clearInterval(p);
			gi("game").style.display="block";
			document.body.onkeydown=keyPress;
		}
		},20);

}
function hideGame(){
	if(gamestarted)
		window.location.reload();
	else{
		gi("game").style.display="none";
		gi("gameback").style.display="none";
		document.body.onkeydown=null;
	}
}
function gi(el){
	return document.getElementById(el);
}
function bodyLoad(){
	if(window.XMLHttpRequest){
		ajax1=new XMLHttpRequest();
		ajax2=new XMLHttpRequest();
		ajax3=new XMLHttpRequest();
	}
	else{
		ajax1=new ActiveXObject("Microsoft.XMLHTTP");
		ajax2=new ActiveXObject("Microsoft.XMLHTTP");
		ajax3=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	bgCanvas=gi("backgroundCanvas");
	drawCanvas=gi("scratchpadCanvas");
	lidCanvas=gi("lidCanvas");
	
	bgContext=bgCanvas.getContext("2d");
	drawContext=drawCanvas.getContext("2d");
	lidContext=lidCanvas.getContext("2d");
	
	getDimension();
	bgCanvas.width=bgCanvas.height=dimension;
	drawCanvas.width=drawCanvas.height=dimension;
	lidCanvas.width=lidCanvas.height=dimension;
	gi("game").style.height=gi("game").style.width=dimension;
	
	drawContext.font = "bold 20px sans-serif";
	block=Math.floor(dimension/grid);
	padding=(dimension-(block*grid))/2;
	arclen*=block;
	
	welcomeGame();
}
function keyPress(e){
	if(e.keyCode==116){
		if(gamestarted)
			gameStop();
		return;
	}
	if(!gamestarted){
		gamestarted=1;
		gameInit();
		return;
	}
	switch(e.keyCode){
	case 37:
		dir="l";
		e.preventDefault();
		moveBar(dir);
		break;
	case 38:
		dir="u";
		e.preventDefault();
		moveBar(dir);
		break;
	case 39:
		dir="r";
		e.preventDefault();
		moveBar(dir);
		break;
	case 40:
		dir="d";
		e.preventDefault();
		moveBar(dir);
		break;
	case 65:
		pickCoin();
		break;
	case 83:
		useBooze();
		break;
	}	
}

function welcomeGame(){
	drawContext.width=drawContext.width;
	bgContext.fillStyle="#333";
	bgContext.fillRect(0,0,bgCanvas.width,bgCanvas.height);
	drawContext.fillText("Loading",drawCanvas.width/2-40,drawCanvas.height/2);
	getInfo();
	
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
	winsound=gi("win");
	scoresound=gi("score");
	losssound=gi("lose");
	lifesound=gi("lifelost");
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
	if(level===null)
		welcomeGame();
	bar[0]=bar[1]=Math.floor(grid/2);
	var k,j,i;
	//bgContext.drawImage(bgimage,0,0,bgCanvas.width,bgCanvas.height);
	for(i=0;i<coincount;++i)
		coins[i]=new Array();
	drawCanvas.width=drawCanvas.width;
	drawContext.fillStyle="#eee";
	for(i=leveldesc.length-1;i>=0;--i)
		if(leveldesc[i]=="1")
			drawContext.fillRect(padding+block*(i%grid),padding+block*Math.floor(i/grid),block,block);
	lidContext.fillStyle="#990";
	lidContext.font = "bold 16px sans-serif";
	lidContext.fillText(user,20,20);
	lidContext.fillText("Score:",20,50);
	lidContext.fillStyle="#829";
	lidContext.fillText("Time Left",lidCanvas.width-80,20);
	lidContext.font = "bold 25px Arial,sans-serif";
	i=lidContext.measureText(timelimit+"").width;
	lidContext.fillStyle="#f69";
	lidContext.fillText(timelimit,lidCanvas.width-i-10,50);
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
	for(i=coincount-1;i>=0;--i){
		temp=Math.floor(Math.random()*100);
		getNextFree(coins[i]);
		showCoin(i);
	}
	if(securityCam){
		secam=new Array();
		securityArc();
	}bosom=1;
	if(bosom){
		bomb=new Array();
		bomb[0]=-1;
		bomb[1]=0;
	}
	showBar();
	showLives();
	gameStart();
}
function gameStart(){
	var i,c=1,j;
	showAlert("Game Started! Collect "+scmax+" coins to win.",130,30,30);
	updateScore();
	updateTime();
	rep=window.setInterval(function(){
		if(timelimit<=0){
			alert("You Lose! Time Over.");
			losssound.play();
			gameStop();
		}
		for(var i=persons.length-1;i>=0;--i)
			movePerson(i);
		for(i=coins.length-1;i>=0;--i)
			if(coins[i][0]!=-1)
				showCoin(i);
		showBar();
		if(c%10==0){
			putCoins();
			c=1;
		}
		else c++;
		if(score>=scmax)
			gameWin(rep);
	},200);
}
var response=-1;
function gameWin(rep){
	window.clearInterval(rep);
	hasWonServer();
	var wait=window.setInterval(function(){
		if(response==-1){
			showAlert("Please Wait...",200,200,200);
			return;
		}
		if(response==1){
			updateLevel();
			alert("Congratulations! You won!");
			winsound.play();
		}
		gameStop();
		},100);
}
function gameStop(){
	window.clearInterval(rep);
	for(var i=persons.length-1;i>=0;--i)
		dropArc(i);
	if(securityCam){
		gi("wrapper").removeChild(secam[2]);
		window.clearInterval(secam[3]);
	}
	gamestarted=0;
	window.location.reload();
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
		if(coins[i][0]==-1)
			if(d>50){
				getNextFree(coins[i]);
				showCoin(i);
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
function useBooze(){
	if(bosom){
		if(score>2){
			score-=3;
			updateScore();
			dropBomb();
		} else
			showAlert("Not enough coins to drop BoozeBomb",200,0,0);
	} else
		showAlert("No BoozeBomb in this level!",255,150,100);
}
function pickCoin(){
	var x,pn,nos=0,con;;
	
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
				if(bosom && bomb[0]>=0 && bar[0]>=bomb[0]-1 && bar[0]<=bomb[0]+1 && bar[1]>=bomb[1]-1 && bar[1]<=bomb[1]+1);
				else{
					if(securityCam){
					con=secam[2].getContext("2d")
					if(checkSight(bar,con,secam[2])){
						con.fillStyle="#e00";
						con.fill();
						removeCoin(x);
						removeLives();
						return;
					} else{
						con.fillStyle="#0e0";
						con.fill();
					}
				}
				for(pn=persons.length-1;pn>=0;--pn){
					con=persons[pn][2].getContext("2d");
					if(checkSight(bar,con,persons[pn][2]))
						++nos;
					if( nos && (nos*Math.floor(Math.random)*10)>5){
						con.fillStyle="#e00";
						con.fill();
						removeCoin(x);
						removeLives();
						return;
					} else {
						con.fillStyle="#0e0";
						con.fill();
					}
				}}
				removeCoin(x);
				getNextFree(coins[x]);
				showCoin(x);
				scoresound.play();
				updateScore();
				break;
			}
}
function updateScore(){
	lidContext.clearRect(75,25,100,100);
	lidContext.fillStyle="#a0a";
	lidContext.font="bold 30px calibri,Monotype corsiva,sans-serif";
	lidContext.fillText(++score,80,50);
	showAlert("Score: "+score,10,130,10);
	updateScoreServer();
}
function updateTime(){
	var i,tl;
	tl=window.setInterval(function(){
		--timelimit;
		lidContext.font = "bold 25px Arial,sans-serif";
		lidContext.fillStyle="#f69";
		lidContext.clearRect(lidCanvas.width-100,30,lidCanvas.width-10,55);
		lidContext.fillText(timelimit,lidCanvas.width-lidContext.measureText(timelimit+"").width-10,50);
		if(timelimit<=0)
			window.clearInterval(tl);
	},1000);
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
	secam[2].style.left=leftpad+padding+drawCanvas.width-secam[2].width;
	secam[2].style.top=toppad+padding+drawCanvas.height-secam[2].height;
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
}
function dropBomb(){
	bomb[0]=bar[0];
	bomb[1]=bar[1];
	bomb[2]=gi("wrapper").appendChild(document.createElement("canvas"));
	showAlert("Booze Bomb",255,255,100);
	bomb[2].width=bomb[2].height=3*block;
	bomb[2].style.left=leftpad+padding+(bar[0]-1)*block;
	bomb[2].style.top=toppad+padding+(bar[1]-1)*block;
	var con=bomb[2].getContext("2d");
	con.fillStyle="rgba(255,255,100,0.4)";
	con.fillRect(0,0,bomb[2].width,bomb[2].height);
	window.setTimeout(function(){
		var i=4;
		bomb[0]=-1;
		var t=window.setInterval(function(){
			if(i<0){
				gi("wrapper").removeChild(bomb[2]);
				window.clearInterval(t);
				bomb[2]=null;
				return;
			}
			con.width=con.width;
			con.fillStyle="rgba(255,255,100,"+(i/10)+")";
			con.fillRect(0,0,bomb[2].width,bomb[2].height);
			i--;
		},10);
		},5000);
}
function movePerson(pn){
	var d,tdir=persons[pn][4];
	hidePerson(pn);
	tdir=getRandDir(persons[pn][4]);
	getNext(persons[pn],tdir);
	persons[pn][4]=tdir;
	showPerson(pn);
	alignBox(pn);
}
function getRandDir(org){
	var v1=Math.floor(Math.random()*100),v2;
	if(v1>87){
		if(v1<90)
			v2="u";
		else if(v1<94)
			v2="d";
		else if(v1<97)
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
	lifesound.play();
	showAlert("Caught",150,10,10);
	if(--lives>=0){
		lidContext.clearRect(10+lives*40,lidCanvas.height-40,30,30);
		hideBar();
		getNext(bar,dir);
		showBar();
	}
	else
		gameStop();
}
var showingalert=0;
function showAlert(str,colr,colg,colb){
	lidContext.font="bold 20px calibri,Monotype corsiva,sans-serif";
	var interval,w=lidContext.measureText(str).width/2,y=lidCanvas.height/2,x=lidCanvas.width/2,i=1,color="rgba("+colr+","+colg+","+colb+",",rep=0;
	if(showingalert)
		return;
	showingalert=1;
	interval=window.setInterval(function(){
		if(i<=0){
			showingalert=0;
			window.clearInterval(interval);
		}
		lidContext.fillStyle=color+(i/10)+")";
		lidContext.clearRect(x-w-10,y-30,2*(w+10),40);
		lidContext.fillRect(x-w-10,y-30,2*(w+10),40);
		lidContext.fillStyle="rgba(0,0,0,"+(i/10)+")";
		lidContext.font="bold 20px calibri,Monotype corsiva,sans-serif";
		lidContext.fillText(str,x-w,y);
		if(i<6){
			rep==0?i++:i--;
		} else if(i==6)
			if(++rep>=50)
				i-=1;
		},30);
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
		return 0;
	if(context.isPointInPath(x,y) || context.isPointInPath(x+block,y) || context.isPointInPath(x,y+block) || context.isPointInPath(x+block,y+block)){
		return 1;
	}
	return 0;
}
function showPerson(pn){
	drawContext.drawImage(personimage[persons[pn][4]],padding+block*persons[pn][0],padding+block*persons[pn][1],block,block);
}
function hidePerson(pn){
	drawContext.clearRect(padding+block*persons[pn][0],padding+block*persons[pn][1],block,block);
	showBar();
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
function getInfo(){
	drawContext.fillStyle="#999";
	drawContext.font = "bold 20px sans-serif";
	drawContext.clearRect(drawCanvas.width/2-50,drawCanvas.height/2-30,100,40);
	drawContext.fillText("Press any key to play Vigilante!",drawCanvas.width/2-150,drawCanvas.height/2-20);

	user=ob.namee;
	level=ob.level;
	leveldesc=ob.map;
	personcount=ob.persons;
	coincount=ob.coins;
	if(ob.addons.indexOf("s")!=-1)
		securityCam=1;
	if(ob.addons.indexOf("b")!=-1)
		bosom=1;
	scmax=ob.score;
	timelimit=ob.time;
}
function updateScoreServer(){
	//put the score on server; called when user scores
	ajax1.onreadystatechange=function(){
		if(ajax1.readyState==4 && ajax1.status==200)
			if(ajax1.responseText=='0')
				return 1;
		};
	
	ajax1.open("GET",encodeURI("checkgame.php?a="+score+"&b="+level+"&c="+timelimit+"&d="+user+"&e="+personcount+"&f="+coincount),true);
	ajax1.send();
}
function hasWonServer(){
	//return int;1if won 0 if not; called when user wins by js procedures
	ajax2.onreadystatechange=function(){
		if(ajax2.readyState==4 && ajax2.status==200)
			if(ajax2.responseText=='1')
				response= 1;
			else if(ajax2.responseText=='0')
				response= 0;
			else{
				alert("An error occured! Please restart the game.");
				window.location.reload();
			}
		};
		ajax2.open("GET",encodeURI("checkgame.php?a="+score+"&b="+level+"&c="+timelimit+"&d="+user+"&e="+personcount+"&f="+coincount),true);
		ajax2.send();
}
function updateLevel(){//called when js win and server win
	ajax3.onreadystatechange=function(){
		if(ajax3.readyState==4 && ajax3.status==200)
			if(ajax3.responseText=='0')
				return 0;
			else if(ajax3.responseText=='1')
				return 1;
			};
		var posts="a="+score+"&b="+level+"&c="+timelimit+"&d="+user+"&e="+personcount+"&f="+coincount;
		ajax3.open("POST","update.php",true);
		ajax3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		ajax3.send(posts);
}
