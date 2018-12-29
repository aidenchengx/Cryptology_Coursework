<?php 
	include'connect.php';	
$tt3=$_GET["texts"];
$len=$_GET["len2"];
$ver=$_GET["ver2"];
$dec=$_GET["dec2"];
$fre=$_GET["fre2"];

$str="%".$tt3."%";
$score=30;
$sel_str = "context like ".$str;
$sql = "SELECT frequency FROM tablepw where context='$tt3'" ;   //与现有库中完全相同的密码
		$check_query = mysqli_query($con,$sql);
		$result = mysqli_fetch_row($check_query);
		if($result[0]!=0)       //库中存在这个密码
		{echo "库存中存在这个密码的记录";
		
		 if($result[0]<=10); 
       else $score-=log10($result[0])*4; 
		 $sql="UPDATE tablepw SET frequency=frequency+1 where context='$tt3'";
				$check_query = mysqli_query($con,$sql); 
		//	echo $score;
		}
	
		else {echo "这是一个新密码 库中没有相关记录";
		$sql="INSERT INTO tablepw values('$tt3',1)";//没有这个密码 则插入库中
		$check_query = mysqli_query($con,$sql);
		};
        $sql = "SELECT sum(frequency) FROM tablepw where context like'$str' and context<>'$tt3' " ;   //与现有库存相似的密码
		$check_query = mysqli_query($con,$sql);
		$result = mysqli_fetch_row($check_query);
		if($result[0]!=0)       //库中存在相似密码
		{
		 if($result<=10); 
       else  $score-=log10($result[0]); 
		}
 
	    if($score<0) $score=0;

?>
<!DOCTYPE html>

<html>
<style>
body {background-image:url(5.jpg);
  background-height:30px;
 background-size:100%;;body{text-align:center};}
 </style>
<center>

   <canvas id="myChart" width="200" height="100"></canvas>
<body>
<br>
<br>
<br>
<br>
<p id="ttt" >口令<?php echo $tt3?>的得分详情<p  name="len"></p></p>
<p id="len" >长度得分：<p  name="len"></p></p>
<p id="ver" >多样性得分：<p name="ver"> </p></p>
<p id="dec" >离散性得分：<p name="dec"></p></p>
<p id="fre" >不确定度得分：<p name="fre"></p></p>
<p id="dic" >字典及频率得分：<p name="dic"></p></p>
<p id="scr" >总得分：<p name="dic"></p></p>
</body>
</center>
</html>
<script type="text/javascript" src="Chart.js-2.7.1/Chart.js-2.7.1/dist/chart.js"></script>
<script language="javascript" >
var mW = 400;
var mH = 400;
var mCxt = null;
 
var canvas = document.createElement('canvas');
document.body.appendChild(canvas);
canvas.height = mH;
canvas.width = mW;
mCxt = canvas.getContext('2d');
var lenscore=parseInt('<?php echo $len?>');
var  verscore=parseInt('<?php echo $ver?>');
var decscore=parseInt('<?php echo $dec?>');
var frescore=parseInt('<?php echo $fre?>');
var dicscore=parseInt('<?php echo $score?>');
var score=decscore+frescore+dicscore+lenscore+verscore;
var ss=score.toFixed(2);
var min=Math.min(decscore*1.33,frescore,dicscore*0.67,lenscore,verscore*1.33);
//alert(ss);
//alert(min);
if (min<=12) {score=Math.round(ss*min/12);}
//alert(score);
var mCount = 5; //边数
var mCenter = mW /2; //中心点
var mRadius = mCenter - 60; //半径 预留部分作为文本空间
var mAngle = Math.PI * 2 / mCount; //角度
var mColorPolygon = '#B8B8B8'; //多边形颜色     
var mData = [['长度', lenscore],
            ['多样性', verscore*1.33],
            ['不确定度', frescore],
            ['离散程度', decscore*1.33],
            ['字典频率', dicscore*0.67]];
    document.getElementById("len").innerHTML="长度得分："+lenscore;
     document.getElementById("ver").innerHTML="多样性："+verscore;
      document.getElementById("dec").innerHTML="离散程度:"+decscore;
       document.getElementById("fre").innerHTML="不确定度:"+frescore;
              document.getElementById("dic").innerHTML="字典频率"+dicscore;
                      document.getElementById("scr").innerHTML="总分"+score;
/*drawPolygon(mCxt); 
drawLines(mCxt);
drawText(mCxt);
drawRegion(mCxt);*/
draw();
// 绘制多边形边
// 
function getPHP(){
	var ds ='<?php echo $len?>';
	alert(ds);
}

function drawPolygon(Cxt){
    Cxt.save();
 
    Cxt.strokeStyle = mColorPolygon;
    var r = mRadius/ mCount; //单位半径
    //画5个圈
    for(var i = 0; i < mCount; i ++){
        Cxt.beginPath(); 
        //Cxt.moveTo(mCenter,mCenter+mRadius);       
        var currR = r * ( i + 1); //当前半径
        //画5条边
        for(var j = 0; j <=mCount; j ++){
            var y =mCenter- currR * Math.cos(mAngle * j);
            var x =mCenter- currR * Math.sin(mAngle * j);
 
            Cxt.lineTo(x, y);
        }
        Cxt.closePath()
        Cxt.stroke();
    }
 
    Cxt.restore();
}
 //顶点连线颜色
  //数据


//绘制文本
function drawText(Cxt){

    mColorText = '#000000';
    Cxt.save();
 
    var fontSize = mCenter / 12;
    Cxt.font = fontSize + 'px Microsoft Yahei';
    Cxt.fillStyle = mColorText;
 
    for(var i = 0; i < mCount; i ++){
        var y = mCenter - mRadius * Math.cos(mAngle * i);
        var x = mCenter - mRadius * Math.sin(mAngle * i);
 
        //通过不同的位置，调整文本的显示位置
        if( mAngle * i >= 0 && mAngle * i <= Math.PI / 2 ){
            Cxt.fillText(mData[i][0], x-fontSize, y - fontSize); 
        }else if(mAngle * i > Math.PI / 2 && mAngle * i <= Math.PI){
            Cxt.fillText(mData[i][0],x - Cxt.measureText(mData[i][0]).width,y + fontSize,);    
        }else if(mAngle * i > Math.PI && mAngle * i <= Math.PI * 3 / 2){
            Cxt.fillText(mData[i][0], x, y+ fontSize);   
        }else{
            Cxt.fillText(mData[i][0], x, y);
        }
 
    }
 
    Cxt.restore();
}
//绘制顶点连线
function drawLines(Cxt){
    Cxt.save();
    mColorLines = ' #4682B4';
    Cxt.beginPath();
    Cxt.strokeStyle = mColorLines; //设定连线的颜色
 
    for(var i = 0; i < mCount; i ++){
        var y = mCenter - mRadius * Math.cos(mAngle * i);
        var x = mCenter - mRadius * Math.sin(mAngle * i);
 
        Cxt.moveTo(mCenter, mCenter);
        Cxt.lineTo(x, y);
    }
 
    Cxt.stroke();
 
    Cxt.restore();
}


//绘制数据区域
function drawRegion(Cxt){
    Cxt.save();
 

   /* Cxt.fillStyle = 'rgba(255, 0, 0, 0.5)';
    Cxt.fill();*/
 
  
    gradient = Cxt.createRadialGradient(mCenter,mCenter,10,mCenter,mCenter,90); 
gradient.addColorStop(0, '#FF0000'); 
gradient.addColorStop(1, '#FFFF00');
 //gradient.addColorStop(1, '#76EE00'); 
Cxt.fillStyle = gradient; 
 Cxt.globalAlpha=0.8;  
    

     Cxt.fillStyle =gradient;    
     Cxt.beginPath();
    for(var i = 0; i < mCount; i ++){
        var y = mCenter - mRadius * Math.cos(mAngle * i) * mData[i][1] / 20;
        var x = mCenter - mRadius * Math.sin(mAngle * i) * mData[i][1] / 20;
 
        Cxt.lineTo(x, y);
    } Cxt.fill(); 
  Cxt.closePath();   Cxt.restore();
 }   

function draw(){
 var radarChartData = { 
       labels: ["字典频率","离散程度","多样性","长度","不确定度"], 
         datasets: [ 
             { 
                 pointBorderColor:"#C064A7",//描点颜色
                 pointBackgroundColor:"#fff",//描点背景颜色
                 borderColor:"#C064A7",//画线颜色
                 data: [dicscore*0.67,decscore*1.33,verscore*1.33,lenscore,frescore]
             }
         ]
         
     };
     //设置选项
     var options = {
         legend:false,//数据项
         scale: {
             ticks: {
                 beginAtZero: true,
                 stepSize:4,//Y轴间隔
                 max:20,//Y轴最大值
                 min:0,
                 callback:function(value) { return value + '分'; }//Y轴格式化
             },
             angleLines:{
                 display:false//雷达辐射轴                
             },
             pointLabels:{
                 fontSize:13//x轴文字
       },
             
         }

     }
     var ctx = document.getElementById("myChart").getContext("2d");
    var myBarChart = new Chart(ctx, {type: 'radar',data: radarChartData,options:options});}
 </script>
