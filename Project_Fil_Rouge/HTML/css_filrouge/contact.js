


// Validation formulaire JARDITOU CONTACT


function validationForm()
{
let vrtext=  RegExp("^[0-9A-Za-z]+$");
let vrnum=  RegExp("^(([0-8][0-9])|(9[0-5]))[0-9]{3}$");
let vremail=  RegExp("^[a-z0-9.-]+@[a-z0-9.-]{2,}.[a-z]{2,4}$");
let name= document.getElementById("nom").value;
let prenom= document.getElementById("prenom").value;
let code= document.getElementById("cpostal").value;
let mail= document.getElementById("email").value;
let female= document.getElementById("feminin").checked;
let male= document.getElementById("masculin").checked;
let neutre= document.getElementById("Neutre").checked;
let ddn= document.getElementById("date").value;
let select= document.getElementById("sujet").value;
let questions= document.getElementById("questions").value;
let boxfin= document.getElementById("box").checked;





// les conditions
if (vrtext.test(name)== false)
{
document.getElementById('nom').focus();
document.getElementById('ernom').innerHTML="Veuillez entrez un nom valide";

return false;
}
else {
    document.getElementById('ernom').innerHTML="";
}

if (vrtext.test(prenom)==false)
{
    document.getElementById('prenom').focus();
    document.getElementById('erprenom').innerHTML="Veuillez entrez un prenom valide";
    return false;
}
else {
    document.getElementById('erprenom').innerHTML="";
}


if (female == false && male== false && neutre==false)
{
    document.getElementById('feminin').focus();
    document.getElementById('ersex').innerHTML="Veuillez choisir le sex s.v.p.";
    return false;
}

else {
    document.getElementById('ersex').innerHTML="";
}

if (ddn == false)
{
    document.getElementById('date').focus();
    document.getElementById('erdate').innerHTML="Veuillez entrez la date de naissance s.v.p.!";
    return false;
}
else {
    document.getElementById('erdate').innerHTML="";
}

if (ddn < "1921-01-01") 
{
    document.getElementById('date').focus();
   alert("Vous etes encore vivant!!! \n Bienvenu qaund meme");
}

if (ddn > "2003-01-01") 
{
    document.getElementById('erdate').innerHTML="tu n'est pas adult!!! DESOLE \n va jouer puzzle!! AU REVOIR";
    document.getElementById('date').focus();
    return false;
}
else {
    document.getElementById('erdate').innerHTML="";
}


if (vrnum.test(code)==false && code.length!=5)
 {
    document.getElementById('cpostal').focus();
    document.getElementById('ercpostal').innerHTML="entrez le code postal sur 5 chiffres s.v.p.!";
    return false;
}
else {
    document.getElementById('ercpostal').innerHTML="";
}


if (vremail.test(mail)==false)
 {
    document.getElementById('email').focus();
    document.getElementById('eremail').innerHTML="entrez un bon address mail s.v.p.!";
    return false;
}
else {
    document.getElementById('eremail').innerHTML="";
}



if (select == false)

{
    document.getElementById('sujet').focus();
    document.getElementById('ersujet').innerHTML="veillez choisisser un sujet s.v.p.!";
        return false;
}
else {
    document.getElementById('ersujet').innerHTML="";
}

if (questions == false)
{
    document.getElementById('questions').focus();
    document.getElementById('erquestions').innerHTML="Entrez votre questions s.v.p.!";

    return false;
}
else {
    document.getElementById('erquestions').innerHTML="";
}


if (boxfin == false) 
{
    document.getElementById('box').focus();
    document.getElementById('erbox').innerHTML="Veuillez Accepter  le traitement informatique de ce formulaire"
    return false;
}
else {
    document.getElementById('erbox').innerHTML="";
}




return true;
}

