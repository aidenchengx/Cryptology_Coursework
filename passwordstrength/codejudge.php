?php header("content-type:text/html;charset=utf-8");

//include '/poly.php'; 

?>
<!DOCTYPE html>
<html>
<style>
.a{background-color:grey;font-size: 100%;};

.button1 {
    background-color: #555555; /* Black */
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
body {background-image:url(4.jpg);
  background-height:30px;
 background-size:100%;background-repeat: no-repeat;body{text-align:center};}
/*.box {
  width: 300px;
  height: 300px;
  background: blue url(http://img3.imgtn.bdimg.com/it/u=3036208495,1104126380&fm=23&gp=0.jpg);
  background-size: cover;
  margin: 28px auto;
}

.clipPolygon {
  -webkit-clip-path: 
    polygon( 25% 0, 75% 0, 100% 50%,
              75% 100%, 25% 100%, 0 50%, 25% 0);
}*/

</style>
<center>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head>
<h1></h1>
<body>
<div class="box clipPolygon"></div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<form action="searchq.php" method="get">输入密码:<input id="tt" type="text" name="texts" oninput="eval()"></input>
<input type="submit" value="提交" class="button1">
<input type='hidden' name='len2' >
<input type='hidden' name='ver2' >
<input type='hidden' name='dec2' >
<input type='hidden' name='fre2' >
<p id="len" >长度得分：<p  name="len"></p></p>
<p id="ver" >多样性得分：<p name="ver"> </p></p>
<p id="dec" >离散性得分：<p name="dec"></p></p>
<p id="fre" >不确定度得分：<p name="fre"></p></p>
</form>




<table  border="1">
    <tr>
        <td class="a" id="low" >&nbsp  弱  &nbsp </td>
        <td class="a" id="medi">&nbsp  中  &nbsp </td>
        <td class="a" id="high">&nbsp  强  &nbsp </td>
   </tr>

</table>
<ul style="display:inline">
    <li></li>
    <li></li>
</ul>
</body>
</center>
</html>
<script >
// var  txt=document.getElementById("tt").value;
//test();
function codelength(){          //密码长度判断
var score=0;
  txt=document.getElementById("tt").value;
 // alert(txt);
  if (txt.length==0) score=0;
  else if(txt.length<=12) score=Math.pow(txt.length/15,2)*20;
  else if(txt.length<=18) score=Math.sqrt(txt.length/21)*20;
  else score=Math.sqrt(Math.sqrt(txt.length/26))*20;
; 
score=Math.round(score);
 // alert(score);
return score;	 
}
function getAsc(str){
 return str.charCodeAt();
}
function codeversity(){          //密码字符类型判断
var score=0,num=0,up=0,low=0,oth=0;
  txt=document.getElementById("tt").value;
//  alert(txt);

    for(i=0;i<txt.length;i++)
    {ch=txt.substr(i,1);
    //	alert(ch);
    	if(ch>='0' && ch<='9') num++;
  
         else if(ch>='A' && ch<='Z') up++;
          else if(ch>='a' && ch<='z') low++;
           else if(ch!='') oth++; 
    }
    if(num>0) score+=3;if(up>0) score+=5;if(low>0) score+=4;if(oth>0) score+=4;	
    if(score>=12) score=15;
    score=Math.round(score);
    return score;
//alert(score);
}

function codedecrete(){            //密码序列连续性 生日密码等
    var  txt=document.getElementById("tt").value;
    score=5;count=1;max=1;bl=false;
     ch0=getAsc(txt.substr(0,1));
     for(i=1;i<txt.length;i++){
     	ch1=getAsc(txt.substr(i,1));
       if((ch0==ch1) || (ch0==ch1+1)||(ch0==ch1-1)) 
       	{count+=1;ch0=ch1;continue;}
       if(i>=2)
       		{ch2=getAsc(txt.substr(i-2,1));  if((ch2==ch1) || (ch2==ch1+1)||(ch2==ch1-1)) {count+=0.7;ch0=ch1;continue;}
       		}
       if(i>=3)
       	{ch3=getAsc(txt.substr(i-3,1));  if((ch3==ch1) || (ch3==ch1+1)||(ch3==ch1-1)) {count+=0.3;ch0=ch1;continue;}}
        if(i>=3)
        {if((getAsc(txt.substr(i-2,1))==getAsc(txt.substr(i-1,1))-1)&&(getAsc(txt.substr(i-1,1))==getAsc(txt.substr(i,1))-1))
          count+=2;}
       if(count!=1 && max<count){max=count;count=1;}
       ch0=ch1;
     }
     if(max<count) max=count;                                  //重复格式
  if(max<=2) score=15;
else      score=15-3*Math.pow(max/2,2);
    bl=(txt.indexOf("19")>=0)||(txt.indexOf("200")>=0)||(txt.indexOf("201")>=0);//年份格式
    if(bl) score-=5;
    if(score<=0)score=0;
    //alert(score)
   ;return Math.round(score);
}

function eval(){
	var lenscore=0,verscore=0,decscore=0,frescore=0,avgscore=0;
	lenscore=codelength();
    verscore=codeversity();
    decscore=codedecrete();
    frescore=frequency();
    avgscore=frescore+verscore+decscore+lenscore;
   // alert(avgscore);
    document.getElementsByName("len")[0].innerHTML=lenscore;
     document.getElementsByName("ver")[0].innerHTML=verscore;
      document.getElementsByName("dec")[0].innerHTML=decscore;
       document.getElementsByName("fre")[0].innerHTML=frescore;
      if (avgscore<=35) {//document.getElementsByClassName("a").style="background-Color:grey";
      document.getElementById("medi").style.backgroundColor="grey";
      document.getElementById("high").style.backgroundColor="grey";
      document.getElementById("low").style.backgroundColor="green";}
       else if(avgscore<=55) {
document.getElementById("low").style.backgroundColor="grey";
      document.getElementById("high").style.backgroundColor="grey";
       document.getElementById("medi").style.backgroundColor="green";}
        else {document.getElementById("medi").style.backgroundColor="grey";
      document.getElementById("low").style.backgroundColor="grey";
              document.getElementById("high").style.backgroundColor="green";}
    document.getElementsByName("len2")[0].value=lenscore;
     document.getElementsByName("ver2")[0].value=verscore;
      document.getElementsByName("dec2")[0].value=decscore;
       document.getElementsByName("fre2")[0].value=frescore;

}

function frequency(){
var txt=document.getElementById("tt").value;
score=5;
h=0;
len=txt.length;
index=0;
 var ar=[],br=[];
  for(i=0;i<len;i++)
    {ch=getAsc(txt.substr(i,1));
     index=ar.indexOf(ch);
     if (index>=0) {
      //alert("已经存在");
      br.splice(index,1,br[index]+1);
      }
     else {ar.push(ch);
      br.push(1);}
    }
  max=br[0];                    //频次最大值
  maxi=0;                       
  len2=br.length;
                      
     for(i=0;i<len2;i++)
       h+=br[i]/len*Math.log(br[i]/len);
     //alert(ar);
     //alert(br);
   //alert(h);
  fre=len2/i;                    //计算有多少不同的字符
  max=max/i;                    //计算最大值的频率

 score=((Math.exp(-h)))*1.8;
  if(score>20) score=20;
  score=Math.round(score);
  return score;
  }

function eval2(){
this.location="searchq.php";
$(form的id).attr("action",新的url地址);
}
function test(){  
	//txt=document.getElementById("tt").innerHTML;
	var mode;
  ch1=getAsc('a');
  ch2=getAsc('b');
  alert(ch1-ch2);
	}
onerror=handleErr;
var te="";
function handleErr(msg,url,l){
	te="该页面有一个错误\n\n";
	te+="错误: " + msg + "\n";
	te+="URL: " + url + "\n";
	te+="行: " + l + "\n\n";
	te+="点击确定继续。\n\n";
	alert(te);
	return true;
}


</script>
