<?php

/*Contact Form by html-form-guide.com
You can customize all the aspects of the form in this style sheet
All the style elements use form id selector(notice the #contactus). So, including this
stylesheet does not affect the other elements at all!*/

?>



#contactus fieldset
{
   width:320px;
   padding:20px;
   border:1px none #ccc;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
-khtml-border-radius: 10px;
border-radius: 10px;   
}

#contactus legend
{
   font-family : Arial, sans-serif;
   font-size: 1.3em;
   font-weight:bold;
   color:#560000;
   text-transform:uppercase;
}


#contactus label
{
   font-family : Arial, sans-serif;
   font-size:0.8em;
   font-weight: bold;
}

#contactus input[type="text"],textarea
{
  font-family : Arial, Verdana, sans-serif;
  font-size: 0.8em;
  line-height:140%;
  color : #000; 
  padding : 3px; 
  border : 1px solid #999;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -khtml-border-radius: 5px;
    border-radius: 5px;

}

#contactus input[type="text"]
{
  height:18px;
  width:220px;
  
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
   border-radius: 5px;   
  
}

#contactus #scaptcha
{
  width:60px;
  height:18px;
}

#contactus input[type="submit"]
{
   width:100px;
   height:30px;
   padding-left:0px;
   
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
   border-radius: 5px;   
}

#contactus textarea
{
  height:120px;
  width:310px;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
   border-radius: 8px;  
}

#contactus input[type="text"]:focus,textarea:focus
{
  color : #009;
  border : 1px solid #990000;
  background-color : #ffff99;
  font-weight:bold;
}

#contactus .container
{
   margin-top:8px;
   margin-bottom: 10px;
}

#contactus .error
{
   font-family: Verdana, Arial, sans-serif; 
   font-size: 0.7em;
   color: #900;
   background-color : #ffff00;
}

#contactus fieldset#antispam
{
   padding:2px;
   border-top:1px solid #EEE;
   border-left:0;
   border-right:0;
   border-bottom:0;
   width:350px;
}

#contactus fieldset#antispam legend
{
   font-family : Arial, sans-serif;
   font-size: 0.8em;
   font-weight:bold;
   color:#333;   
}

#contactus .short_explanation
{
   font-family : Arial, sans-serif;
   font-size: 0.6em;
   color:#333;   
}

/* spam_trap: This input is hidden. This is here to trick the spam bots*/
#contactus .spmhidip
{
   display:none;
   width:10px;
   height:3px;
}
#fg_crdiv
{
   font-family : Arial, sans-serif;
   font-size: 0.3em;
   opacity: .2;
   -moz-opacity: .2;
   filter: alpha(opacity=20);   
}
#fg_crdiv p
{
    display:none;
}