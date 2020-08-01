function updatecount(cou){
    $.ajax({
        url : "updatecount.php",
        type: "POST",
        data:"cou="+cou,
        success:function(data){},
        cache:false
    });
}

function pick(field)
{
var prathap=document.getElementById(field).value;
return prathap; 
}

function showloader(cls){
     var obj = {},someBlock = $(""+cls);
    function getValues() {
        obj.textVal = $('#textInput').val();
        obj.percentVal = $('#percentInput').val();
        obj.durationVal = $('#durationInput').val();
    }
    someBlock.preloader({
            text: obj.textVal,
            percent: obj.percentVal,
            duration: obj.durationVal
        });
        /*$(""+cls).each(function(k,v) {
            if (v.value.length == 0) $(v).attr('disabled', true);
        });
        */
}

function hideloader(cls){
     var someBlock = $(""+cls);
        someBlock.preloader('remove');
        $(""+cls).attr('disabled', false);
    } 

function notify(msg,cat,time,modal)
{
ulak({"text":msg,"type":cat,"timeout":time,"modal":modal});
}


function dofocus(field){$("#"+field).focus();}


function login()
{
var stuid=pick("log_uid");
var passwd=pick("log_upass");
var reg_agree=$("input[name=terms]:checked").val();

if(stuid==undefined || stuid=="")
{
notify("Please Enter University ID","error","2000","true");
dofocus("log_uid");
return false;
}
else if(passwd==undefined || passwd=="")
{
notify("Please Enter Password","error","2000","true");
dofocus("log_upass");
return false;
}
else if(reg_agree=="" || reg_agree==undefined)
{
notify("Please Agree to the Terms and Conditions","error","2000","true");
return false;
}
else
{
var datastring="stuid="+stuid+"&passwd="+passwd;
$.ajax({
type:"POST",
url:"login-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){showloader(".form-horizontal");},
success:function(data){hideloader(".form-horizontal");if(data.indexOf("success")!=-1){notify("Loggedin Successfully....Redirecting....","success","3500","true");setTimeout(function(){window.location="index.php";},2000);}else{notify(data,"error","2000","true");}}
}); 
}
}


function contact()
{
var stuid=pick("log_uid");
var passwd=pick("log_upass");
if(stuid==undefined || stuid=="")
{
notify("Please Enter University ID","error","2000","true");
alert(passwd);
return false;
}
else if(passwd==undefined || passwd=="")
{
notify("Please Enter Description","error","2000","true");
dofocus("log_upass");
return false;
}
else
{
var datastring="stuid="+stuid+"&passwd="+passwd;
$.ajax({
type:"POST",
url:"contact-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){showloader(".form-horizontal");},
success:function(data){hideloader(".form-horizontal");if(data.indexOf("success")!=-1){notify("Submitted Successfully....","success","3500","true");setTimeout(function(){window.location="index.php";},2000);}else{notify(data,"error","2000","true");}}
}); 
}
}

function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}

function register()
{
var reg_email=pick("reg_email");
var reg_name=pick("reg_name");
var reg_year=pick("reg_year");
var reg_branch=pick("reg_branch");
var reg_gender=pick("reg_gender");
var reg_clg=pick("reg_clg");
var reg_mob=pick("reg_mob");
var reg_upass=pick("reg_upass");
var reg_cupass=pick("reg_cupass");
var reg_accept=pick("reg_accept");

if(reg_email=="" || ValidateEmail(reg_email)==false || reg_email==undefined)
{
notify("Please Enter Valid Email ID","error","2000","true");
dofocus("reg_email");
return false;
}
else if(reg_name=="" || isNaN(reg_name)==false || reg_name==undefined)
{
notify("Please Enter Your Name","error","2000","true");
dofocus("reg_name");
return false;
}
else if(reg_year=="Select" || reg_year==undefined)
{
notify("Please Choose Year","error","2000","true");
dofocus("reg_year");
return false;
}
else if(reg_branch=="Select" || reg_branch==undefined)
{
notify("Please Choose Branch","error","2000","true");
dofocus("reg_year");
return false;
}
else if(reg_gender=="Select" || reg_gender==undefined)
{
notify("Please Choose Gender","error","2000","true");
dofocus("reg_year");
return false;
}
else if(reg_clg=="" || reg_clg==undefined)
{
notify("Please Enter College Name","error","2000","true");
dofocus("reg_clg");
return false;
}

else if(reg_upass=="" || reg_upass==undefined)
{
notify("Please Enter Password","error","2000","true");
dofocus("reg_upass");
return false;
}
else if(reg_cupass=="" || reg_cupass==undefined)
{
notify("Please Enter Confirm Password","error","2000","true");
dofocus("reg_cupass");
return false;
}
else if(reg_upass!=reg_cupass)
{
notify("Password and Confirm Passwords are not same","error","2000","true");
dofocus("reg_cupass");
return false;
}
else if(reg_accept="" || reg_accept=="0")
{
notify("Please agree to the terms and conditions","error","2000","true");
dofocus("reg_accept");
return false;
}
else
{
//confirmation
if(confirm("Are you sure to Register?")){   
var datastring="reg_email="+reg_email+"&reg_name="+reg_name+"&reg_year="+reg_year+"&reg_branch="+reg_branch+"&reg_gender="+reg_gender+"&reg_clg="+reg_clg+"&reg_mob="+reg_mob+"&reg_upass="+reg_upass+"&reg_accept="+reg_accept;
$.ajax({
type:"POST",
url:"register-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){showloader(".form-horizontal");},
success:function(data){hideloader(".form-horizontal");if(data.indexOf("ID is")!=-1){notify(data,"success","3500","true");}else{notify(data,"error","2000","true");}}
});
                        } else {
                           return false;
                        }
                
 }
}


function dopassupdate()
{
var passwd=pick("passwd");  
var cpasswd=pick("cpasswd");    
if(passwd==undefined || passwd=="")
{

notify("Please Enter Password","error","2000","true");
}
else if(cpasswd==undefined || cpasswd=="")
{

notify("Please Enter Confirm Password","error","2000","true");
}
else if(passwd!=cpasswd)
{

notify("Password and  Confirm Password are not same","error","2000","true");
}
else
{
var datastring="passwd="+passwd+"&cpasswd="+cpasswd;
$.ajax({
type:"POST",
url:"changepass-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("updated")!=-1){notify("Password Successfully Updated...","success","2000","true");}else{notify(data,"error","2000","true");}}
});     
}
}