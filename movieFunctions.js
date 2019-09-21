
var movies = ["#movePanelACT","#movePanelRMC","#movePanelANM","#movePanelAHF"];
var synopsis = ["synopsisACT","synopsisRMC","synopsisANM","synopsisAHF"];
var movieSelect = { "act": false, "rmc": false, "anm": false, "ahf": false };

getElement("movePanelACT").onclick = clickedACT;
getElement("movePanelRMC").onclick = clickedRMC;
getElement("movePanelANM").onclick = clickedANM;
getElement("movePanelAHF").onclick = clickedAHF;


function getElement(id){
  return document.getElementById(id);
}

// Choosing movie functions

function clickedACT(){
  movieClicked("#movePanelACT");
  selectSynopsis('movePanelACT');
  movieSelect["act"] = true;
  chosenMovie();
}

function clickedRMC(){
    movieClicked("#movePanelRMC");
    selectSynopsis('movePanelRMC');
    movieSelect["rmc"] = true;
    chosenMovie();
}

function clickedANM(){
  movieClicked("#movePanelANM");
  selectSynopsis('movePanelANM');
  movieSelect["anm"] = true;
  chosenMovie();
}

function clickedAHF(){
  movieClicked("#movePanelAHF");
  selectSynopsis('movePanelAHF');
  movieSelect["ahf"] = true;
  chosenMovie();
}

function movieClicked(id){
  clearAllMovies();
  document.querySelector(id).classList.toggle("movie-select");
}

function clearAllMovies(){
  for(var i = 0 ; i<movies.length; i++){
    clearMovie(movies[i]);
  }
  for(var movie in movieSelect){
    movieSelect[movie] = false;
  }
}

function clearMovie(id){
  if(document.querySelector(id).classList != null){
  document.querySelector(id).classList.remove("movie-select");
  }
}

function chosenMovie(){
  var movieName = '';
  for(var movie in movieSelect){
    if (movieSelect[movie] == true){
      movieName = movie;
    }
  }

  var defaultTime = "No time selected";

  switch(movieName){
    case "act":
      document.querySelector("#selected-Movie").textContent = "Avengers - " + defaultTime;
      break;
    case "rmc":
      document.querySelector("#selected-Movie").textContent = "Top End Wedding - " + defaultTime;
      break;
    case "anm":
      document.querySelector("#selected-Movie").textContent = "Dumbo - " + defaultTime;
      break;
    case "ahf":
      document.querySelector("#selected-Movie").textContent = "The Happy Prince - " + defaultTime;
      break;
  }
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
  displayDetails(id);
}

function displayDetails(id)
{
  //gets the day and time as shown in button pressed
  var time = getElement(id).innerHTML;
  if(id.includes("ACT"))
  {
    getElement("selected-Movie").innerHTML = "The Avengers: EndGame - " + time;
  }
  else if(id.includes("RMC"))
  {
    getElement("selected-Movie").innerHTML = "Top End Wedding - " + time;
  }
  else if(id.includes("ANM"))
  {
    getElement("selected-Movie").innerHTML = "Dumbo - " + time;
  }
  else if(id.includes("AHF"))
  {
    getElement("selected-Movie").innerHTML = "The Happy Prince - " + time;
  }
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

var total;
function calculateEachTicket()
{
  total = 0;
  var adultElement = getElement("seats-sta");
  var concessionElement = getElement("seats-stp");
  var childElement = getElement("seats-stc");
  var fcAdultElement = getElement("seats-fca");
  var fcConcessionElement = getElement("seats-fcp");
  var fcChildElement = getElement("seats-fcc");

  var adultIndexValue = adultElement.options[adultElement.selectedIndex].value;
  var concessionIndexValue = concessionElement.options[concessionElement.selectedIndex].value;
  var childIndexValue = childElement.options[childElement.selectedIndex].value;
  var fcAdultIndexValue = fcAdultElement.options[fcAdultElement.selectedIndex].value;
  var fcConcessionIndexValue = fcConcessionElement.options[fcConcessionElement.selectedIndex].value;
  var fcChildIndexValue =fcChildElement.options[fcChildElement.selectedIndex].value;

  //updates the value of the element with its actual numerical value
  adultElement.value = adultIndexValue;
  concessionElement.value = concessionIndexValue;
  childElement.value = childIndexValue;
  fcAdultElement.value = fcAdultIndexValue;
  fcConcessionElement.value = fcConcessionIndexValue;
  fcChildElement.value = fcChildIndexValue;

  //retrieves the actual value of each type of ticket
  var temp;

  temp = adultIndexValue;
  total += temp * adult;
  getElement("total").innerHTML = "$" + total.toFixed(2);

  temp = concessionIndexValue;
  total += temp * concession;
  getElement("total").innerHTML = "$" + total.toFixed(2);

  temp = childIndexValue;
  total += temp * child;
  getElement("total").innerHTML = "$" + total.toFixed(2);

  temp = fcAdultIndexValue;
  total += temp * fcAdult;
  getElement("total").innerHTML = "$" + total.toFixed(2);

  temp = fcConcessionIndexValue;
  total += temp * fcConcession;
  getElement("total").innerHTML = "$" + total.toFixed(2);

  temp = fcChildIndexValue;
  total += temp * fcChild;
  getElement("total").innerHTML = "$" + total.toFixed(2);
}

function formValidate()
{
  //checks if at least one of any type of ticket is chosen
  var atLeastOneTicket = getElement("total").innerHTML != "$0.00";

  //checks that a movie is selected in the first place and if there is a time selected
  var movieIsSelected = getElement("selected-Movie").innerHTML != "" &&
  !(getElement("selected-Movie").innerHTML.includes("No time selected"));

  if(nameChecked && mobileChecked && cardChecked && expiryChecked && atLeastOneTicket && movieIsSelected)
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
  //takes only western names (i.e. names with western characters)
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
  //takes only australian numbers, spaces are okay
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
  /*checks if card starts with either 4 or 5 (mastercard or visa) or 35 (amex) before
  making sure there are 16 numbers total*/
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
