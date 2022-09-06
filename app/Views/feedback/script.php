<script>
  /*
   * Author: Abdullah A Almsaeed
   * Date: 4 Jan 2014
   * Description:
   *      This is a demo file used only for the main dashboard (index.html)
   **/

   "use strict";
   var gradetype=document.getElementsByName("gradetype");
   var gradefmt=document.getElementsByName("gradefmt");
   var reqdiv=document.getElementById("reqdiv");
   var calcdiv=document.getElementById("calcdiv");
   var tblElem=document.getElementById("tbl");
   var finaldiv=document.getElementById("finaldiv");
   var sumElem=document.getElementById("sum");
   //var gradecircle=document.getElementById("gradecircle");
   var avglabelElem=document.getElementById("avglabel");
   var avgElem=document.getElementById("avg");
   var avgletElem=document.getElementById("avglet");
   var areaElem=document.getElementById("area");
   var fgElem=document.getElementById("fg");
   var fgletElem=document.getElementById("fglet");
   var gradetypeElem=document.getElementsByName("gradetype");

   var weight=[];
   var grade=[];
   var avg;
   var rows=8;
   var igradetype=0;
   window.onunload = function() {
      localSave();
   };
   window.onload = function() {
      document.getElementById("calcform").onkeypress = function(e) { if( e.keyCode==13 ) Calc(); };
      document.getElementById("calcform2").onkeypress = function(e) { if( e.keyCode==13 ) Calc0(); };
      gradetype[0].addEventListener("click", function() { GradeType(0); });
      gradetype[1].addEventListener("click", function() { GradeType(1); });
      gradetype[2].addEventListener("click", function() { GradeType(2); });
      var params=GetURLParams();
      if( Object.keys(params).length>0 ) {
         document.querySelector("#tbl>tbody>tr:nth-child(3)>td:nth-child(4)>input").value=params.weight1;
         document.querySelector("#tbl>tbody>tr:nth-child(3)>td:nth-child(3)>input").value=params.grade1;
         document.querySelector("#tbl>tbody>tr:nth-child(4)>td:nth-child(4)>input").value=100-params.weight1;
         document.querySelector("#tbl>tbody>tr:nth-child(4)>td:nth-child(3)>input").value=params.grade2;
      }
      localLoad();
   };
   function localLoad()
   {
		var params = localStorage.getObject("gradecalculator_params");
      if( params==null ) return;
      GradeType(params.igradetype);
      var drows=params.text.length-8;
      if( drows>0 ) {
         for(var i=0; i<drows; i++)
            AddRow();
      }
      for(var i=0; i<rows; i++) {
         var k=i+2;
         var row=document.querySelector("#tbl>tbody>tr:nth-child("+k+")");
         if( row==null ) return;
         row.querySelector("td:nth-child(1)>input").value=params.text[i];
         row.querySelector("td:nth-child(2)>select").selectedIndex=params.lgrade[i];
         row.querySelector("td:nth-child(3)>input").value=params.pgrade[i];
         row.querySelector("td:nth-child(4)>input").value=params.weight[i];
      }
   }
   function localSave()
   {
      var params={};
      params.igradetype = igradetype;
      params.text=[];
      params.lgrade=[];
      params.pgrade=[];
      params.weight=[];
      for(var i=0; i<rows; i++) {
         var k=i+2;
         var row=document.querySelector("#tbl>tbody>tr:nth-child("+k+")");
         if( row==null ) return;
         params.text[i] = row.querySelector("td:nth-child(1)>input").value;
         params.lgrade[i] = row.querySelector("td:nth-child(2)>select").selectedIndex;
         params.pgrade[i] = row.querySelector("td:nth-child(3)>input").value;
         params.weight[i] = row.querySelector("td:nth-child(4)>input").value;
      }
   	localStorage.setObject("gradecalculator_params",params);
   }
   function OnReset()
   {
      if( rows>8 ) {
         for(var i=8; i<rows; i++)
            tblElem.deleteRow(i);
         rows=8;
      }
   }
   function Calc0()
   {
      var avg=document.getElementById("avg0").value;
      var total=document.getElementById("total0").value;
      var weight=document.getElementById("weight0").value;
      var final=(total-avg*(100.0-weight)/100.0)/(weight/100.0);
      document.getElementById("final0").value=final.toFixed(2);
   }
   function GradeType(i)
   {
      igradetype=i;
      if( i==0 )
         GradePercent();
      else if( i==1 )
         GradeLetter();
      else
         GradePoints();
   }
   function GradePercent()
   {
      gradetype[0].setAttribute("checked",true);
      gradetype[1].setAttribute("checked",false);
      gradetype[2].setAttribute("checked",false);
      gradetype[0].parentElement.classList.add("active");
      gradetype[1].parentElement.classList.remove("active");
      gradetype[2].parentElement.classList.remove("active");
      document.querySelector("#tbl tr:nth-child(1)>td:nth-child(3)").innerHTML="Grade (%)";
      document.querySelector("#tbl tr:nth-child(1)>td:nth-child(4)").innerHTML="Weight";
      var el1=document.querySelectorAll("#tbl tr>td:nth-child(2)");
      var el2=document.querySelectorAll("#tbl tr>td:nth-child(3)");
      for(var i=0; i<el1.length; i++) {
         el1[i].style.display="none";
         el2[i].style.display="table-cell";
      }
      reqdiv.style.display="flex";
      calcdiv.style.display="block";
      finaldiv.style.display="block";
      sumElem.style.display="none";
      avglabelElem.innerHTML="Average grade";
      avgElem.value="";
      avgletElem.value="";
      areaElem.value="";
      fgElem.value="";
      fgletElem.value="";
      //document.querySelector("#tbl tr:nth-child(2)>td:nth-child(3)>input").focus();
   }
   function GradeLetter()
   {
      gradetype[0].setAttribute("checked",false);
      gradetype[1].setAttribute("checked",true);
      gradetype[2].setAttribute("checked",false);
      gradetype[0].parentElement.classList.remove("active");
      gradetype[1].parentElement.classList.add("active");
      gradetype[2].parentElement.classList.remove("active");
      document.querySelector("#tbl tr:nth-child(1)>td:nth-child(3)").innerHTML="Grade (%)";
      document.querySelector("#tbl tr:nth-child(1)>td:nth-child(4)").innerHTML="Weight";
      var el1=document.querySelectorAll("#tbl tr>td:nth-child(2)");
      var el2=document.querySelectorAll("#tbl tr>td:nth-child(3)");
      for(var i=0; i<el1.length; i++) {
         el1[i].style.display="table-cell";
         el2[i].style.display="none";
      }
      reqdiv.style.display="none";
      calcdiv.style.display="none";
      finaldiv.style.display="none";
      sumElem.style.display="none";
      avglabelElem.innerHTML="GPA";
      //SetFinalURL();
      avgElem.value="";
      avgletElem.value="";
      //document.querySelector("#tbl tr:nth-child(2)>td:nth-child(2)>select").focus();
   }
   function GradePoints()
   {
      gradetype[0].setAttribute("checked",false);
      gradetype[1].setAttribute("checked",false);
      gradetype[2].setAttribute("checked",true);
      gradetype[0].parentElement.classList.remove("active");
      gradetype[1].parentElement.classList.remove("active");
      gradetype[2].parentElement.classList.add("active");
      document.querySelector("#tbl tr:nth-child(1)>td:nth-child(3)").innerHTML="Grade<br>(points)";
      document.querySelector("#tbl tr:nth-child(1)>td:nth-child(4)").innerHTML="Max Grade<br>(optional)";
      var el1=document.querySelectorAll("#tbl tr>td:nth-child(2)");
      var el2=document.querySelectorAll("#tbl tr>td:nth-child(3)");
      for(var i=0; i<el1.length; i++) {
         el1[i].style.display="none";
         el2[i].style.display="table-cell";
      }
      reqdiv.style.display="none";
      calcdiv.style.display="none";
      finaldiv.style.display="none";
      sumElem.style.display="table-row";
      avglabelElem.innerHTML="Total grade";
      //SetFinalURL();
      avgElem.value="";
      avgletElem.value="";
      //document.querySelector("#tbl tr:nth-child(2)>td:nth-child(3)>input").focus();
   }
   function Calc()
   {
      var i,dp;
      //for(i=0; i<gradetype.length; i++)
      //   if( gradetype[i].checked ) break;
      i=igradetype;
      for(dp=0; dp<gradefmt.length; dp++)
         if( gradefmt[dp].checked ) break;
      if( i==0 )
         CalcPercent(dp);
      else if( i==1 )
         CalcLetter(dp);
      else if( i==2 )
         CalcPoints(dp);
   }
   function CalcPercent(dp)
   {
      avg=0;
      var sum=0;
      var txt="";
      var tavg="";
      var tsum="";
      for(var i=0; i<rows; i++)
      {
         var k=i+2;
         grade[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(3)>input").value;
         weight[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(4)>input").value;
         grade[i] = parseFloat(grade[i]);
         weight[i] = parseFloat(weight[i]);
         if( weight[i]>0 && grade[i]>=0 )
         {
            avg+=weight[i]*grade[i];
            sum+=weight[i];
            if( i>0 ) { tavg+="+"; tsum+="+"; }
            tavg+=weight[i]+"\u00D7"+grade[i];
            tsum+=weight[i];
         }
      }
      if( avg==0 || sum==0 )
      {
         alert("Please enter grades & weights");
         return;
      }
      var topsum=avg;
      avg/=sum;
      avg=avg.toFixed(dp);
      txt="("+tavg+") / ("+tsum+") = "+roundresult(topsum)+" / "+roundresult(sum)+" = "+avg;
      var avglet=GetLetterFromPercent(avg);
      var rgrade=document.getElementById("rgrade").value;
      if( rgrade=="" ) rgrade=80;
      var final = (100*rgrade-sum*avg)/(100-sum);
      final = final.toFixed(dp);
      var finallet = GetLetterFromPercent(final);
      avgElem.value=avg;
      avgletElem.value=avglet;
      areaElem.value=txt;
      fgElem.value=final;
      fgletElem.value=finallet;
      if( avg==Math.floor(avg) ) avg=Math.floor(avg);
      //var url="final-grade-calculator.html?grade="+avg+"&weight="+sum;
      //if( sum<=0 || sum>=100 ) url=undefined;
      //SetFinalURL(url);
      var percent=avg;
      if( percent>100 ) percent=100;
   }
   function CalcLetter(dp)
   {
      avg=0;
      var sum=0;
      var txt="";
      var tavg="";
      var tsum="";
      var glook=[-1,4.33,4,3.67,3.33,3,2.67,2.33,2,1.67,1.33,1,0.67,0];
      for(var i=0; i<rows; i++)
      {
         var k=i+2;
         var index = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(2)>select").selectedIndex;
         grade[i] = glook[index];
         weight[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(4)>input").value;
         //grade[i] = parseFloat(grade[i]);
         weight[i] = parseFloat(weight[i]);
         if( weight[i]>0 && grade[i]>=0 )
         {
            avg+=weight[i]*grade[i];
            sum+=weight[i];
            if( i>0 ) { tavg+="+"; tsum+="+"; }
            tavg+=weight[i]+"\u00D7"+grade[i];
            tsum+=weight[i];
         }
      }
      if( avg==0 || sum==0 )
      {
         alert("Please enter grades & weights");
         return;
      }
      avg/=sum;
      avg=avg.toFixed(dp);
      //txt="("+tavg+") / ("+tsum+") = "+roundresult(topsum)+" / "+roundresult(sum)+" = "+avg;
      var avglet=GetLetterFromGPA(avg);
      avgElem.value=avg;
      avgletElem.value=avglet;
   }
   function CalcPoints(dp)
   {
      var pointsum, maxsum;
      [pointsum, maxsum] = CalcTotal();
      if( pointsum==0 || maxsum==0 )
      {
         alert("Please enter grade points");
         return;
      }
      avg=pointsum/maxsum*100;
      avg=avg.toFixed(dp);
      var avglet=GetLetterFromPercent(avg);
      avgElem.value=avg;
      avgletElem.value=avglet;
   }
   function GetLetterFromPercent(percent)
   {
      var letter="";
      var lettertbl=['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
      var percenttbl=[97,93,90,87,83,80,77,73,70,67,63,60,0];
      for(var i=0; i<percenttbl.length; i++)
         if( percent>=percenttbl[i] )
         {
            letter = lettertbl[i];
            break;
         }
      return letter;
   }
   function GetLetterFromGPA(gpa)
   {
      var letter="F";
      var lettertbl=['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
      var gpatbl=[4.165,3.835,3.5,3.165,2.835,2.5,2.165,1.835,1.5,1.165,0.835,0.335];
      for(var i=0; i<gpatbl.length; i++)
         if( gpa>=gpatbl[i] )
         {
            letter = lettertbl[i];
            break;
         }
      return letter;
   }
   function CalcTotal()
   {
      var pointsum=0;
      var maxsum=0;
      for(var i=0; i<rows; i++)
      {
         var k=i+2;
         grade[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(3)>input").value;
         weight[i] = document.querySelector("#tbl>tbody>tr:nth-child("+k+")>td:nth-child(4)>input").value;
         grade[i] = parseFloat(grade[i]);
         weight[i] = parseFloat(weight[i]);
         if( grade[i]>=0 ) {
            pointsum+=grade[i];
            if( weight[i]>=0 )
               maxsum+=weight[i];
         }
      }
      document.querySelector("#sum td:nth-child(3) input").value=pointsum;
      if( maxsum>0 )
         document.querySelector("#sum td:nth-child(4) input").value=maxsum;
      else {
         maxsum=document.querySelector("#sum td:nth-child(4) input").value;
         if( maxsum=="" ) 
            maxsum=100;
         else
            maxsum=parseFloat(maxsum);
      }
      return([pointsum,maxsum]);
   }
   function SetFinalURL(url)
   {
      if( url===undefined ) url="final-grade-calculator.html";
      document.getElementById("final1").href=url;
      document.getElementById("final2").href=url;
   }
   function GetURLParams()
   {
      var url=window.location.href;
      var regex = /[?&]([^=#]+)=([^&#]*)/g,
            //url = "www.domain.com/?v=123&p=hello",
            params = {},
            match;
      while(match = regex.exec(url)) {
            params[match[1]] = match[2];
      }
      return params;
   }
   function AddRow()
   {
     var tableRef = document.getElementById('tbl').getElementsByTagName('tbody')[0];
     var newRow = tableRef.insertRow(++rows);
     //var newRow = tableRef.insertRow(-1);
     //++rows;
     newRow.innerHTML = "<tr>\
         <td><input type='text' class='form-control'></td>\
         <td><select name='lgrade[]' class='form-control'>\
            <option selected>--</option>\
            <option>A+</option>\
            <option>A</option>\
            <option>A-</option>\
            <option>B+</option>\
            <option>B</option>\
            <option>B-</option>\
            <option>C+</option>\
            <option>C</option>\
            <option>C-</option>\
            <option>D+</option>\
            <option>D</option>\
            <option>D-</option>\
            <option>F</option>\
         </select></td>\
         <td><input type='number' name='grade[]' min='0' step='any' class='form-control'></td>\
         <td><input type='number' name='weight[]' min='0' step='any' class='form-control'></td>\
      </tr>";

      var k=rows+1;
      var i,dp;
      for(i=0; i<gradetype.length; i++) {
         //if( gradetype[i].checked ) break;
         console.log(gradetype[i].getAttribute("checked"));
         if( gradetype[i].getAttribute("checked")=="true" ) break;
      }
      if( i==1 ) {
         document.querySelector("#tbl tr:nth-child("+k+")>td:nth-child(3)").style.display="none";
         document.querySelector("#tbl tr:nth-child("+k+")>td:nth-child(2)").style.display="table-cell";
      } else {
         document.querySelector("#tbl tr:nth-child("+k+")>td:nth-child(2)").style.display="none";
         document.querySelector("#tbl tr:nth-child("+k+")>td:nth-child(3)").style.display="table-cell";
      }
   }
   function roundresult(x) {
      var y=parseFloat(x);
      y=roundnum(y,10);
      return y;
   }
   function roundnum(x,p) {
      var i;
      var n=parseFloat(x);
      var m=n.toPrecision(p+1);
      var y=String(m);
      i=y.indexOf('e');
      if( i==-1 )	i=y.length;
      var j=y.indexOf('.');
      if( i>j && j!=-1 ) 
      {
         while(i>0)
         {
            if(y.charAt(--i)=='0')
               y = removeAt(y,i);
            else
               break;
         }
         if(y.charAt(i)=='.')
            y = removeAt(y,i);
      }
      return y;
   }
   function removeAt(s,i) {
      s = s.substring(0,i)+s.substring(i+1,s.length);
      return s;
   }
   Storage.prototype.setObject = function(key, value) {
      this.setItem(key, JSON.stringify(value));
   }
   Storage.prototype.getObject = function(key) {
      var value = this.getItem(key);
      if( value==null || value=="undefined" ) return null;
      return value && JSON.parse(value);
   }


  $(function() {

    'use strict'

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  })
</script>