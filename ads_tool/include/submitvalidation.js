
function validateForm()
{
 var headline=document.getElementById('ad_h_l'); 
 var imageurl=document.getElementById('ad_i_u'); 
 var websiteurl=document.getElementById('ad_w'); 
 var ckeditorval=document.getElementById('ad_cke'); 
 var error=0;
 var errmsg =""; 
 /*Hide all error messages*/
  hide_all_errors();
 /*check for empty*/
  if(ad_isempty(headline,'text')){
    error=1;
    display_message(error);
  }
  if(ad_isempty(imageurl,'img')){
    error=2;
    display_message(error);
  }
  if(ad_isempty(websiteurl,'url')){
    error=3;  
    display_message(error);
  }
  
  if(error>0){
    return false; 
  }else{
    return true;
  }

}

function ad_isempty(element,er_type){  
  if(element.value.length==0){
    return true;
  }else{
    if (er_type == 'url') {
      if (ValidURL(element.value) != null && ValidURL(element.value) != '') {
	return false;
      }else{
	return true;
      }	
    }else if(er_type == 'img'){
      var obj = new Image();
      obj.src = element.value;
      if (obj.complete) {
	  return false;//alert('worked');
      } else {
	  return true;//alert('no worky');
      }
    }else{
      return false;
    }    
  }
}

function display_message(error){
  var goTo = document.getElementById("ad-sub-frm").offsetTop;
  window.scrollTo(0, goTo);
  switch(error){
    case 1:
      document.getElementById('er_1').style.display="block";
      document.getElementById('er_1').innerHTML="Please Enter Valid Headine";      
    break;
    case 2:
      document.getElementById('er_2').style.display="block";
      document.getElementById('er_2').innerHTML="Image not found"; 
    break;
    case 3:
      document.getElementById('er_3').style.display="block";
      document.getElementById('er_3').innerHTML="Please Enter Valid Website Url"; 
    break;
    case 10: 
    document.getElementById('er_3').innerHTML="Please Enter Valid Website Url"; 
    document.getElementById('er_3').style.display="block"; 
    break;
  }
}

function ValidURL(str) {
  return str.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function hide_all_errors()
{
	document.getElementById('er_1').style.display="none"; 
	document.getElementById('er_2').style.display="none"; 
	document.getElementById('er_3').style.display="none"; 
 
}