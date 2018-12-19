<script>	
//1//-- Ajax Action -----------------------------------------------------
Gloval_pg = 'ajax_php.php';

function Ajax_js(data1, idTd,  op){

var xmlhttp;
if (window.XMLHttpRequest) {
	xmlhttp=new XMLHttpRequest(); 
}else{
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function(){

if (xmlhttp.readyState==4 && xmlhttp.status==200){


//alert(xmlhttp.responseText);
document.getElementById('groupCodetd'+idTd).innerHTML = xmlhttp.responseText;


}

}

xmlhttp.open("POST", Gloval_pg, true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("fichanumber="+data1+"&idcontrol="+idTd+"&op="+op);
}
//1//***
</script>