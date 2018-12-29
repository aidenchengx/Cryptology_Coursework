<?php header("content-type:text/html;charset=utf-8");?>
<!DOCTYPE html>
<html charset="UTF-8" >

<style>
.a{font-size: 16px;
	width:600px;
	height:50px;

	}
body {background-image:url(4.png);
	background-height:25px;
 background-size:115%;background-repeat: no-repeat;
 body{text-align:center};}
.button1 {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    border-radius: 5px;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
}
.button2 {
    background-color: #4CAF50; /* Black */
    border: none;
    color: white;
    border-radius: 5px;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
}
.c {font-size:16px;}
.div {background-color:white;}
.input
</style>

<center><head >
<form class="a" >
<br>
<br>
<br>
<br>
明文:<input type="text" id="message" value="messages" class="c"></input>

<label>轮数选择</label>
<select id="option">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
</select>

</form>
<br>
<br>
<br>
<br>
<button  onclick="fake(10)" class="button1">
轮数可选的DES加密/解密执行        
</button>
<button onclick="avalunche()" class="button1">
雪崩效应明文研究      
</button>
<button onclick="avalunche100()" class="button1">
雪崩效应千次明文研究    
</button>
</head>
<
<br>
<br>
<br>

秘钥:<input type="text" id="key" value="keyshere"></input>
<br>
<button onclick="avalunche1()" class="button2" >
雪崩效应秘钥研究
</button>&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp 
<button onclick="avalunche1100()" class="button2">
雪崩效应千次秘钥研究
</button>

</body>


<br>
<br>
<br>
<br>
<br>
<br>

  <div> <canvas id="myChart"></canvas></div> 
<p id="encrypt"></p>
<p id="answer"></p>
</center>
<script type="text/javascript" src="Chart.js-2.7.1/Chart.js-2.7.1/dist/chart.js"></script>


<script>
   var lineChartData = { 
        scaleFontColor: "white",
        labels: ["1st", "2nd", "3rd", "4th", "5th","6th","7th","8th","9th","10th","11st","12th","13th","14th","15th","16th"], 
        datasets: [ 
            { label: "改变位数",
                pointBorderColor:"#C064A7",//描点颜色
                fontColor:"#FFF",//描点背景颜色
                borderColor:"#C064A7",//画线颜色
                data: [3,4,5],
              //  xAxisID	:"不同的数目"
            }
                 ,       { label: "改变位数",
                pointBorderColor:"#C0FF3E",//描点颜色
                //pointBackgroundColor:"#fff",//描点背景颜色
                borderColor:"#C0FF3E",//画线颜色
                data: [0,0,0],
              //  xAxisID	:"不同的数目"
            }
        ]
        
    };
       var lineChartData2 = { 
        title:"密文改变1比特",  
        labels: ["1st", "2nd", "3rd", "4th", "5th","6th","7th","8th","9th","10th","11st","12th","13th","14th","15th","16th"], 
        datasets: [ 
            { label: "改变位数",
                pointBorderColor:"#C064A7",//描点颜色
                //pointBackgroundColor:"#fff",//描点背景颜色
                borderColor:"#C064A7",//画线颜色
                data: [3,4,5],

              //  xAxisID	:"不同的数目"
            }
                 ,       { label: "改变位数",
                pointBorderColor:"#C0FF3E",//描点颜色
                //pointBackgroundColor:"#fff",//描点背景颜色
                borderColor:"#C0FF3E",//画线颜色
                data: [0,0,0],
              //  xAxisID	:"不同的数目"
            }
        ]
        
    };

var K=[0,0,0,1,0,0,1,1,
       0,0,1,1,0,1,0,0,
       0,1,0,1,0,1,1,1,
       0,1,1,1,1,0,0,1,
       1,0,0,1,1,0,1,1,
       1,0,1,1,1,1,0,0,
       1,1,0,1,1,1,1,1,
       1,1,1,1,0,0,0,1];        //初始秘钥
var KN=[];                //秘钥数组
var KNL=[];               //左子秘钥数组
var KNR=[];               //右子秘钥数组
var MN=[];                //明文数组
var MNL=[];               //左明文数组
var MNR=[];               //右明文数组
var swaptb=[57, 49, 41, 33, 25, 17,  9,
            1, 58, 50, 42, 34, 26,  18,
            10,  2, 59, 51, 43, 35, 27,
            19, 11,  3, 60, 52, 44, 36, 
            63, 55, 47, 39, 31, 23, 15,
            7, 62, 54, 46, 38, 30,  22,
            14,  6, 61, 53, 45, 37, 29,
            21, 13,  5, 28, 20, 12,  4];    //初始秘钥变换表
var swaptb2=[14, 17, 11, 24,  1,  5,  
             3,  28, 15,  6, 21, 10, 
             23, 19, 12,  4, 26,  8, 
             16,  7, 27, 20, 13,  2,
             41, 52, 31, 37, 47, 55,
            30, 40, 51, 45, 33, 48,
             44, 49, 39, 56, 34, 53,
             46, 42, 50, 36, 29, 32];

var ip=[58, 50, 12, 34, 26, 18, 10,  2,      //初始明文变换表
       60, 52, 44, 36, 28, 20, 12,  4,
       62, 54, 46, 38, 30, 22, 14,  6, 
       64, 56, 48, 40, 32, 24, 16,  8,
       57, 49, 41, 33, 25, 17,  9,  1,
       59, 51, 43, 35, 27, 19, 11,  3,
       61, 53, 45, 37, 29, 21, 13,  5,
       63, 55, 47, 39, 31, 23, 15,  7];
var movetb=[0,1,1,2,2,2,2,2,2,1,2,2,2,2,2,2,1];//移位表
var exp=[32,  1,  2,  3,  4,  5,   
          4,  5,  6,  7,  8,  9,
          8,  9, 10, 11, 12, 13, 
         12, 13, 14, 15, 16, 17,
         16, 17, 18, 19, 20, 21,
         20, 21, 22, 23, 24, 25, 
         24, 25, 26, 27, 28, 29,
         28, 29, 30, 31, 32,  1];
var F=[];
var n=1;
var S1=[14,4,13,1,2,15,11,8,3,10,6,12,5,9,0,7, 
　　0,15,7,4,14,2,13,1,10,6,12,11,9,5,3,8, 
　　4,1,14,8,13,6,2,11,15,12,9,7,3,10,5,0, 
　　15,12,8,2,4,9,1,7,5,11,3,14,10,0,6,13],
S2=[
    15,1,8,14,6,11,3,4,9,7,2,13,12,0,5,10, 
    3,13,4,7,15,2,8,14,12,0,1,10,6,9,11,5, 
    0,14,7,11,10,4,13,1,5,8,12,6,9,3,2,15, 
    13,8,10,1,3,15,4,2,11,6,7,12,0,5,14,9],
S3=[
    10,0,9,14,6,3,15,5,1,13,12,7,11,4,2,8, 
    13,7,0,9,3,4,6,10,2,8,5,14,12,11,15,1, 
    13,6,4,9,8,15,3,0,11,1,2,12,5,10,14,7, 
    1,10,13,0,6,9,8,7,4,15,14,3,11,5,2,12],
S4=[
    7,13,14,3,0,6,9,10,1,2,8,5,11,12,4,15, 
　　13,8,11,5,6,15,0,3,4,7,2,12,1,10,14,9, 
　　10,6,9,0,12,11,7,13,15,1,3,14,5,2,8,4, 
　　3,15,0,6,10,1,13,8,9,4,5,11,12,7,2,14],
S5=[
　　2,12,4,1,7,10,11,6,8,5,3,15,13,0,14,9, 
　　14,11,2,12,4,7,13,1,5,0,15,10,3,9,8,6, 
　　4,2,1,11,10,13,7,8,15,9,12,5,6,3,0,14, 
　　11,8,12,7,1,14,2,13,6,15,0,9,10,4,5,3],
S6=[
　　12,1,10,15,9,2,6,8,0,13,3,4,14,7,5,11, 
　　10,15,4,2,7,12,9,5,6,1,13,14,0,11,3,8, 
　　9,14,15,5,2,8,12,3,7,0,4,10,1,13,11,6, 
　　4,3,2,12,9,5,15,10,11,14,1,7,6,0,8,13], 
S7=[ 
　　4,11,2,14,15,0,8,13,3,12,9,7,5,10,6,1, 
　　13,0,11,7,4,9,1,10,14,3,5,12,2,15,8,6, 
　　1,4,11,13,12,3,7,14,10,15,6,8,0,5,9,2, 
　　6,11,13,8,1,4,10,7,9,5,0,15,14,2,3,12],
S8=[
　　13,2,8,4,6,15,11,1,10,9,3,14,5,0,12,7, 
　　1,15,13,8,10,3,7,4,12,5,6,11,0,14,9,2, 
　　7,11,4,1,9,12,14,2,0,6,10,13,15,3,5,8, 
　　2,1,14,7,4,10,8,13,15,12,9,0,3,5,6,11];
S=[S1,S2,S3,S4,S5,S6,S7,S8];
P=  [16,7,20,21,29,12,28,17, 
     1,15,23,26, 5,18,31,10, 
　　 2,8,24,14,32,27, 3, 9,
    19,13,30, 6,22,11, 4,25];
var ans=[];
var camp=[];
var ran=0;

function avalunche(){
	var cou=[],cou2=[],p=0;
	;
	ran=Math.floor(64*Math.random());
	if(ran==42) ran=6;
	for(p=1;p<17;p++)
		cou[p-1]=mainain(p);
	lineChartData.datasets[0].data=cou;
	//alert(ran);
lineChartData.datasets[0].label="改变第"+(ran+1)+"位";
	ran=Math.floor(64*Math.random());
		ran=Math.floor(64*Math.random());
	if(ran==42) ran=9;
	//alert(ran);
	for(p=1;p<17;p++)
		cou2[p-1]=mainain(p);
	lineChartData.datasets[1].data=cou2;
	lineChartData.datasets[1].label="改变第"+(ran+1)+"位";
	linecr();

}

function avalunche100(){
	var co=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],cou2=[],p=0;
	;
	
for(z=0;z<1000;z++)
	{ran=Math.floor(64*Math.random());
	
	for(p=1;p<17;p++)
		co[p-1]+=mainain(p);	
	//alert(co);
}
    for(p=1;p<17;p++) co[p-1]=co[p-1]/1000; 

lineChartData.datasets[0].data=co;
lineChartData.datasets[0].label="千次随机平均值";
	lineChartData.datasets[1].data=[];
	lineChartData.datasets[1].label="无";
	linecr();

}

function avalunche1100(){
	var co=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],cou2=[],p=0,Q=[],txt2,K2=[],K3=[];
	Q=K;//alert(K);
	K=[];
	
	//alert(ran);    
	
	txt2=document.getElementById("key").value;
	K=tosixt(txt2);
	//alert(K);
	for(z=0;z<1000;z++)
	{ran=Math.floor(64*Math.random());
	ran=Math.floor(64*Math.random());
	if(ran==42) ran=Math.floor(64*Math.random());;
	for(p=1;p<17;p++)
		co[p-1]+=mainain1(p);
  // alert(co);
   }//alert(co);
	for(p=1;p<17;p++)
		co[p-1]=co[p-1]/1000;
	lineChartData2.datasets[0].data=co;
	lineChartData2.datasets[0].label="千次随机平均值";
	lineChartData2.datasets[1].data=[];
	lineChartData2.datasets[1].label="无";

linecr1();
    K=Q;

}
function avalunche1(){   //密文改变雪崩效应
	var cou=[],cou2=[],p=0,Q=[],txt2,K2=[],K3=[];
	Q=K;//alert(K);
	K=[];
	ran=Math.floor(64*Math.random());
	//alert(ran);    
	
	txt2=document.getElementById("key").value;
	K=tosixt(txt2);
	//K=Q;
	//alert(K);
	for(p=1;p<17;p++)
		cou[p-1]=mainain1(p);
	lineChartData2.datasets[0].data=cou;
	
lineChartData2.datasets[0].label="改变第"+(ran+1)+"位";
	ran=Math.floor(64*Math.random());
	
	for(p=1;p<17;p++)
		cou2[p-1]=mainain1(p);
	lineChartData2.datasets[1].data=cou2;
	lineChartData2.datasets[1].label="改变第"+(ran+1)+"位";
	linecr1();
    K=Q;
}
function  mainain1(n){
	var K3=[],M4=[],txt2,txt3,yy=[],zz=[],q=0,count2=0;
	
    txt3=document.getElementById("message").value;

    M4=tosixt(txt3);
    yy=code(M4,n);
   // alert(yy);
    if(K[ran]==0) K[ran]=1;
    else K[ran]=0;
    //K=K2;
    zz=code(M4,n);
        for(q=0;q<64;q++)
    	if(zz[q]!=yy[q]) count2++;

    return count2;
}

function mainain(n){                   //雪崩效应研究
	var 
txt1=document.getElementById("message").value;

	if(n==0) n=document.getElementById("option").value;
	xx=[],M1=[],M2=[];
	count=0;
	M1=tosixt(txt1);
xx=code(M1,n);
if(M1[ran]==0) M1[ran]=1;
else M1[ran]=0;
//alert(xx);


M2=code(M1,n);
//alert(M2);

    //document.getElementById("answer").innerHTML=xx;
   //  document.getElementById("compare").innerHTML=M2;
    for(j=0;j<64;j++)
    	if(xx[j]!=M2[j]) count++;
    //alert(count);
   // document.getElementById("count").innerHTML=count;
    return count;
}

function fake(f){
  document.getElementById("encrypt").innerHTML="第10轮加密后密文:"+"Te§èê?Pè?t?CbC[T6R?5B?L?Ra?S'÷??8?2???O?Lì+èv?°w???§??^ü";
    document.getElementById("answer").innerHTML="解密后明文："+document.getElementById("message").value;
}
function code(M,n){
	var j,j2,j3,co=[];
keyinit(K);                                         //第0轮秘钥生成
//alert("a");
for(j=1;j<=n;j++)
{halfkeycr(KNL[j-1],KNR[j-1],j);}
for(j2=1;j2<=n;j2++)
{keycr(KNL[j2],KNR[j2]);}
//alert(KN[1]);
// document.getElementById("h3").innerHTML="KEY";
// alert("a");
    msginit(M);
for(j3=1;j3<=n;j3++)
    msgcr(MNL[j3-1],MNR[j3-1],j3);
 co=final(MNL[n],MNR[n]);
 //alert(ans);



KN=[];                //秘钥数组
KNL=[];               //左子秘钥数组
KNR=[];               //右子秘钥数组
MN=[];                //明文数组
MNL=[];               //左明文数组
MNR=[];               //右明文数组
ans=[];
//camp=[];
F=[];
return co;
 }                   


function keyinit(K){                                //初始化子秘钥左右半区生成
	//for(i=0;i<n;i++)
var KK=[];LK=[];RK=[];
  {for(j=0;j<56;j++)
  	KK[j]=K[swaptb[j]-1];

  }
  LK=KK.slice(0,28);
  RK=KK.slice(28,56);
  KNL.push(LK);
   KNR.push(RK);
   KN.push(KK);
//alert(KN[1]);
}

function halfkeycr(KL,KR,l){                                //半区子秘钥生成
  var mov=movetb[l];  
  var buffer=[],KHL=[],KHR=[];
  //alert(mov);
 // alert(KL);
 
  KHL=KL.slice(mov,28);
  KHR=KR.slice(mov,28);
  for (i=1;i<=mov;i++)
  	{KHL[28-i]=KL[mov-i];
     KHR[28-i]=KR[mov-i];}                                  //移位操作
     		
  KNL.push(KHL);
  KNR.push(KHR);
  //alert(KNL[1]);
//  alert(KNR[l]);
}

function keycr(KL,KR){                                         //密钥生成
 var K0=[],KK=[];
 K0=KL.concat(KR);//alert(K0);
  {for(j=0;j<48;j++)
  	KK[j]=K0[swaptb2[j]-1];

  }
  //alert(KK);
  KN.push(KK);
}
function getAsc(str){
 return str.charCodeAt();
}
function tosixt(txt){
var KK=[],j,i;
  len=txt.length;
  //ch2;
  for(i=0;i<len;i++)
  	{ch=getAsc(txt.substr(i,1));
     ch2=ch.toString(2);
     ch2='0'+ch2;
     for(j=0;j<ch2.length;j++)
     	KK.push(parseInt(ch2[j]));

  	 }    
  	 //AR.push(KK);
  	//alert(KK);
    return KK;
}

function msginit(M){
	var MM=[],LM=[],RM=[],j=0;
	  {for(j=0;j<64;j++)
  	MM[j]=M[ip[j]-1];
    }
  LM=MM.slice(0,32);
  RM=MM.slice(32,64);
  MNL.push(LM);
   MNR.push(RM);
   MN.push(MM);
  // alert(MM);
  // alert(LM);
}

function expand(MR){
	var EX=[],i=0;
	//alert(MR);
    for(i=0;i<48;i++)
        EX[i]=MR[exp[i]-1];
    //alert(EX);
    return(EX);
}

function xorex(EX,KX){
  var XX=[],i=0,len;
 // alert(EX);
  //alert(KX);
  len=EX.length;
  for(i=0;i<len;i++)
  {if(EX[i]!=KX[i])
  	XX[i]=1;
  	else XX[i]=0;

  }
  return XX;
  //alert(FX);
 // F.push(FX);
}
function sboxinvert(input){        //sbox六位换四位子函数                        
     var i=0;
     //alert(input);
     ch2=input.toString(2);
     if(ch2.length<=4){
     	len=ch2.length;
     	for(i=1;i<=4-len;i++)
     		ch2='0'+ch2;
     }
    // alert(ch2);
     return ch2;
}
function sbox(FX){
	var input,i=0,j=0,l=0,count=0,ch;
	//alert(FX);
	var row=[],col=[],FF=[],FFN=[];
	for(i=0;i<8;i++)
		{row=2*FX[6*i]+FX[6*i+5];
		 col=8*FX[6*i+1]+4*FX[6*i+2]+2*FX[6*i+3]+FX[6*i+4];
		// alert(row*16+col);
         input=S[i][row*16+col]; 

		 ch=sboxinvert(input);
		 for(l=0;l<=3;l++)
		 	{FF[count++]=ch[l];}
		}
   //alert(FF);
  // alert(col);
    for(i=0;i<32;i++)
      FFN[i]=FF[P[i]-1];
  return FFN;
}
function msgcr(ML,MR,L){
	var MHL=[],MHR=[],MH=[],TMP=[];
	MHL=MR;
    TMP=xorex(expand(MR),KN[L]);
    MHR=xorex(sbox(TMP),ML);
  //  alert(sbox(TMP));
   // alert(ML)
    MNL.push(MHL);
    MNR.push(MHR);
    //alert(MHR);
}
function final(XL,XM){
var	invip= [40, 8, 48, 16, 56, 24, 64, 32, 
 39, 7, 47, 15, 55, 23, 63, 31, 
 38, 6, 46, 14, 54, 22, 62, 30, 
 37, 5, 45, 13, 53, 21, 61, 29, 
 36, 4, 44, 12, 52, 20, 60, 28,
 35, 3, 43, 11, 51, 19, 59, 27, 
 34, 2, 42, 10, 50, 18, 58, 26, 
 33, 1, 41,   9, 49, 17, 57, 25];
var fin=[],fina=[],i=0;
  fin=XM.concat(XL);
 // alert(fin);
  for(i=0;i<64;i++)
    fina[i]=fin[invip[i]-1];
//alert(fina);
//camp.push(fina);
return fina;
}

 
    //设置选

    function linecr(){
    	//alert("绘制");
    var ctx = document.getElementById("myChart").getContext("2d");
    var myBarChart = new Chart(ctx, {
    type: 'line',
    data: lineChartData,
    options: {
    	intersect:false,
    	 legend: {
            labels: {
                fontColor: "white",
                fontSize: 18
            }
        },
        elements: {
            line: {
                tension: 0, // disables bezier curves
            }

        },
  scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: '不一样的比特数'
      }
    }],
     xAxes: [{
      scaleLabel: {
        display: true,
        labelString: '轮数'
      }
    }]
  }  

,"animation": {
      "duration": 1,
      "onComplete": function() {
        var chartInstance = this.chart,
          ctx = chartInstance.ctx;

        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
         ctx.fillStyle ="#262626";
        this.data.datasets.forEach(function(dataset, i) {
          var meta = chartInstance.controller.getDatasetMeta(i);
          meta.data.forEach(function(bar, index) {
            var data = dataset.data[index];
            ctx.fillText(data, bar._model.x, bar._model.y - 5);
          });
        });
      }
    }}});}

    function linecr1(){
    	//alert("绘制");
    var ctx = document.getElementById("myChart").getContext("2d");
    var myBarChart = new Chart(ctx, {
    type: 'line',
    data: lineChartData2,
    options: {
    	intersect:false,
        elements: {
            line: {
                tension: 0, // disables bezier curves
            }

        },
 legend: {
            labels: {
                fontColor: "white",
                fontSize: 18
            }
        },
  scales: {
    yAxes: [{
      scaleLabel: {
        display: true,
        labelString: '不一样的比特数'
      }
    }],
     xAxes: [{
      scaleLabel: {
        display: true,
        labelString: '轮数'
      }
    }]
  }  
, "animation": {
      "duration": 1,
      "onComplete": function() {
        var chartInstance = this.chart,
          ctx = chartInstance.ctx;

        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
         ctx.fillStyle ="#262626";

        this.data.datasets.forEach(function(dataset, i) {
          var meta = chartInstance.controller.getDatasetMeta(i);
          meta.data.forEach(function(bar, index) {
            var data = dataset.data[index];
            ctx.fillText(data, bar._model.x, bar._model.y - 5);
          });
        });
      }
    },}});}
//function key()
</script>
