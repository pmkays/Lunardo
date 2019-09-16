
var movies = ["movePanelACT","movePanelRMC","movePanelANM","movePanelAHF"];
var synopsis = ["synopsisACT","synopsisRMC","synopsisANM","synopsisAHF"];

getElement("movePanelACT").onclick = clickedACT;
getElement("movePanelRMC").onclick = clickedRMC;
getElement("movePanelANM").onclick = clickedANM;
getElement("movePanelAHF").onclick = clickedAHF;


function getElement(id){
  return document.getElementById(id);
}

// Choosing movie functions

function clickedACT(){
  if(movieClicked("movePanelACT")){
    return true;
  }
  return false;
}

function clickedRMC(){
  if(movieClicked("movePanelRMC")){
    return true;
  }
  return false;
}

function clickedANM(){
  if(movieClicked("movePanelANM")){
    return true;
  }
  return false;
}

function clickedAHF(){
  if(movieClicked("movePanelAHF")){
    return true;
  }
  return false;
}

function movieClicked(id){
  clearAllMovies();
  if(getElement(id).style.borderStyle != 'solid'){
  getElement(id).style.borderStyle = 'solid';
  getElement(id).style.borderWidth = '5px';
  getElement(id).style.borderColor = '#E6B31E';
  selectSynopsis(id);
  return true;
}
else{
  getElement(id).style.borderStyle = '';
  getElement(id).style.borderWidth = '';
  getElement(id).style.borderColor = '';
  return false;
}
}

function clearAllMovies(){
  for(var i = 0 ; i<movies.length; i++){
    clearMovie(movies[i]);
  }
}

function clearMovie(id){
  getElement(id).style.borderStyle = '';
  getElement(id).style.borderWidth = '';
  getElement(id).style.borderColor = '';
}

function selectSynopsis(id){
  clearAllSynopsis();
  switch(id){
    case "movePanelACT":
      getElement('synopsisACT').style.display = "block";
      break;
    case "movePanelRMC":
      getElement('synopsisRMC').style.display = "block";
      break;
    case "movePanelANM":
      getElement('synopsisANM').style.display = "block";
      break;
    case "movePanelAHF":
      getElement('synopsisAHF').style.display = "block";
      break;
  }
}

function clearAllSynopsis(){
  for(var i = 0 ; i<synopsis.length; i++){
    getElement(synopsis[i]).style.display = "none";
  }
}

//the times/days of discount tickets
var discount = ['Mon', 'TueT12', 'Wed', 'ThuT12', 'FriT12'];

//price of standard non-discounted tickets as determined by assignment specs
var adult;
var concession;
var child;

var fcAdult;
var fcConcession;
var fcChild;

//global variable to be used when calculating ticket prices
var discounted;

function checkDiscount(id)
{
  for(var i = 0; i < discount.length; i++)
  {
    if(id.includes(discount[i]))
    {
      discounted = true;
      break;
    }
    else
    {
      discounted = false;
    }
  }
  alert(discounted.toString());
}

function calculatePrice()
{
  if(discounted)
  {
    //price of standard discounted tickets as determined by assignment specs
    adult = 14.00;
    concession = 12.50;
    child = 11.00;

    //price of first class discounted tickets as determined by assignment specs
    fcAdult = 24.00;
    fcConcession = 22.50;
    fcChild = 21.00;
  }
  else
  {
    //price of standard non-discounted tickets as determined by assignment specs
    adult = 19.80;
    concession = 17.50;
    child = 15.30;

    //price of first class non-discounted tickets as determined by assignment specs
    fcAdult = 30.80;
    fcConcession = 27.00;
    fcChild = 24.80;
  }
  calculateEachTicket();
}

var total = 0;
function calculateEachTicket()
{
  total = 0;
  var adultElement = getElement("seats-sta");
  var concessionElement = getElement("seats-stp");
  var childElement = getElement("seats-stc");
  var fcAdultElement = getElement("seats-fca");
  var fcConcessionElement = getElement("seats-fcp");
  var fcChildElement = getElement("seats-fcc");

  //updates the value of the element with its actual numerical value
  adultElement.value = adultElement.options[adultElement.selectedIndex].value;
  concessionElement.value = concessionElement.options[concessionElement.selectedIndex].value;
  childElement.value = childElement.options[childElement.selectedIndex].value;
  fcAdultElement.value = fcAdultElement.options[fcAdultElement.selectedIndex].value;
  fcConcessionElement.value = fcConcessionElement.options[fcConcessionElement.selectedIndex].value;
  fcChildElement.value = fcChildElement.options[fcChildElement.selectedIndex].value;

  //retrieves the actual value of each type of ticket
  var temp;

  //ensures there are no changes to calculation and price is not NaN
  // if(temp === '')
  // {
  //   temp = 0;
  // }

  temp = adultElement.options[adultElement.selectedIndex].value;
  total += temp * adult;
  getElement("total").value = "$" + total.toFixed(2);

  temp = concessionElement.options[concessionElement.selectedIndex].value;
  total += temp * concession;
  getElement("total").value = "$" + total.toFixed(2);

  temp = childElement.options[childElement.selectedIndex].value;
  total += temp * child;
  getElement("total").value = "$" + total.toFixed(2);

  temp = fcAdultElement.options[fcAdultElement.selectedIndex].value;
  total += temp * fcAdult;
  getElement("total").value = "$" + total.toFixed(2);

  temp = fcConcessionElement.options[fcConcessionElement.selectedIndex].value;
  total += temp * fcConcession;
  getElement("total").value = "$" + total.toFixed(2);

  temp = fcChildElement.options[childElement.selectedIndex].value;
  total += temp * fcChild;
  getElement("total").value = "$" + total.toFixed(2);
}

function formValidate()
{
  if(nameChecked && mobileChecked && cardChecked && expiryChecked)
  {
    return true;
  }
  else
  {
    return false;
  }
}

var nameChecked;
function checkName(thisP)
{
  var patt = /^[a-zA-Z' -.]{1,}$/;
  if (!patt.test(thisP.value))
  {
    getElement('name-error').innerHTML='Please enter a Western name';
    nameChecked = false;
  }
  else
  {
    getElement('name-error').innerHTML='';
    nameChecked = true;
  }
}

var mobileChecked;
function checkMobile(thisP)
{
  var patt = /^(\(04\)|04|\+614)([ ]?\d){8}$/;
  if (!patt.test(thisP.value))
  {
    getElement('mobile-error').innerHTML='Please enter a valid Australian mobile';
    mobileChecked = false;
  }
  else
  {
    getElement('mobile-error').innerHTML='';
    mobileChecked = true;
  }
}

var cardChecked;
function checkCard(thisP)
{
  var patt = /^(([45]\d{3})|(35\d{2}))-? ?\d{4}-? ?\d{4}-? ?\d{4}/;
  if (!patt.test(thisP.value))
  {
    getElement('card-error').innerHTML='Please enter a Visa, Mastercard or American Express credit card';
    cardChecked = false;
  }
  else
  {
    getElement('card-error').innerHTML='';
    cardChecked = true;
  }
}

var expiryChecked;
function checkExpiry(thisP)
{
  //convert today's year and month into integers
  var currentYear = parseInt(new Date().toISOString().slice(0, 4));
  var currentMonth = parseInt(new Date().toISOString().slice(5, 7));

  //convert form's year and month into integers
  var formYear = parseInt(thisP.value.toString().slice(0,4));
  var formMonth = parseInt(thisP.value.toString().slice(5,7));

  //ensures date is in the future (i.e. month is later if in same year or year is greater)
  if((formMonth > currentMonth && currentYear === formYear) || formYear > currentYear)
  {
    getElement('expiry-error').innerHTML='';
    expiryChecked = true;
  }
  else
  {
    getElement('expiry-error').innerHTML='Please enter a date in the future';
    expiryChecked = false;
  }
}
