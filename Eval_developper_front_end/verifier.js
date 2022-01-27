function veri()
{
    var x = document.getElementById("email").value;
    var _mail = new RegExp("^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$");
    var y = document.getElementById("sujet").value;
    var z = document.getElementById("contenu").value;

    if (_mail.test(x) == false)
    {
        document.getElementById('email').focus();
        document.getElementById('eremail').innerHTML="Veuillez choisir une forme correcte de mail";

    }
    else {
        document.getElementById('eremail').innerHTML="";
    }
    if (y == "")
    {
        document.getElementById('sujet').focus();
        document.getElementById('ersujet').innerHTML="Veuillez entrer un sujet";

    }
    else {
        document.getElementById('ersujet').innerHTML="";
    }
    if (z == "")
    {
        document.getElementById('contenu').focus();
        document.getElementById('ercontenu').innerHTML="Ne pas laisser vide le contenu";

    }
    else {
        document.getElementById('ercontenu').innerHTML="";
    }
    return false; // do not submit the form
}