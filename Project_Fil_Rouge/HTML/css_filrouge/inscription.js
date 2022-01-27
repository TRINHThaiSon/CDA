function verifier()
{
    var x = document.getElementById("password_form").value;
    var y = document.getElementById("confirm_form").value;
    var a = document.getElementById("nom_form").value;
    var _nom = new RegExp("^[0-9A-Za-z]+$");
    var b = document.getElementById("prenom_form").value;
    var d = document.getElementById("date_form").value;
    var e = document.getElementById("code_form").value;
    var _codepostal = new RegExp("^[0-9]$");
    var _mail = new RegExp("^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$");
    var f=document.getElementById("email_form").value;       
    var acc = document.getElementById("form_box").checked;
    var s1 = document.getElementById("feminin").checked;
    var s2 = document.getElementById("masculin").checked;
    var s3 = document.getElementById("Neutre").checked;
    var t = document.getElementById("tele_form").value;
    
    
    if (_nom.test(a) == false)
    {
        document.getElementById('nom_form').focus();
        document.getElementById('ernom').innerHTML="Veuillez entrez un nom valide";

    }
    else {
        document.getElementById('ernom').innerHTML="";
    }
    if (_nom.test(b) == false)
    {
        document.getElementById('prenom_form').focus();
        document.getElementById('erprenom').innerHTML="Veuillez entrez un prénom valide";

       
    }
    else {
        document.getElementById('erprenom').innerHTML="";
    }    
    if (s1 == false && s2 == false && s3 == false)
    {
        document.getElementById('feminin').focus();
        document.getElementById('ersex').innerHTML="Veuillez choisir une sexe";

        
    }
    else {
        document.getElementById('ersex').innerHTML="";
    }    
    if (d == "")
    {
        document.getElementById('date_form').focus();
        document.getElementById('erdate').innerHTML="Veuillez choisir un date";

        
    }
    else {
        document.getElementById('erdate').innerHTML="";
    }
        
    if (d>"2006-01-01"  ) 
    {
        document.getElementById('date_form').focus();
        document.getElementById('erdate').innerHTML="Desolé, tu es trop jeune!!!";

    }   
     if (_codepostal.test(e) == false && e.length != 5)
    {
        document.getElementById('code_form').focus();
        document.getElementById('ercode').innerHTML="Code postale ne contient que 5 numéros";

    }
        else {
        document.getElementById('ercode').innerHTML="";
    }
    if ( t.length != 10)
    {
        document.getElementById('tele_form').focus();
        document.getElementById('ertele').innerHTML="Numéro de tétéphone ne contient que 10 numéros";

    }
        else {
        document.getElementById('ertele').innerHTML="";
    }    
    if (_mail.test(f) == false || e == "")
    {
        document.getElementById('email_form').focus();
        document.getElementById('eremail').innerHTML="Veuillez choisir une forme correcte de mail";

        
    }
    else {
        document.getElementById('eremail').innerHTML="";
    }      
        
    if( acc == false)
    {
        document.getElementById('form_box').focus();
        document.getElementById('erbox').innerHTML="Veuillez cocher l'acceptance";

        
    }
    else {
        document.getElementById('erbox').innerHTML="";
    } 
    if ( x.length < 6)
    {
        document.getElementById('password_form').focus();
        document.getElementById('erpass').innerHTML="Veuillez choisir un mot de pass contenant au moins de 6 charactères";

    }
        else {
        document.getElementById('erpass').innerHTML="";
    } 
    if (  y !=x)
    {
        document.getElementById('confirm_form').focus();
        document.getElementById('erconfirm').innerHTML="Confirmation n'est pas correct!Veuillez re-saisir la vérification";

    }
        else {
        document.getElementById('erconfirm').innerHTML="";
    }      
    return false; // do not submit the form
}
