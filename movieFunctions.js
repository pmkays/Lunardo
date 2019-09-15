
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

function calculateStandardPrice(id)
{
  if(discounted)
  {
    //price of standard discounted tickets as determined by assignment specs
    adult = 14.00;
    concession = 12.50;
    child = 11.00;
  }
  else
  {
    //price of standard non-discounted tickets as determined by assignment specs
    adult = 19.80;
    concession = 17.50;
    child = 15.30;
  }
  calculateEachTicket(id);
}

function calculateFirstClassPrice(id)
{
  if(discounted)
  {
    //price of first class discounted tickets as determined by assignment specs
    adult = 24.00;
    concession = 22.50;
    child = 21.00;
  }
  else
  {
    //price of first class non-discounted tickets as determined by assignment specs
    adult = 30.80;
    concession = 27.00;
    child = 24.80;
  }
  calculateEachTicket(id);
}

var total = 0;
function calculateEachTicket(id)
{
  var element = getElement(id);

  //updates the value of the element with its actual numerical value
  element.value = element.options[element.selectedIndex].value;

  //retrieves the actual value of each type of ticket
  var temp = element.options[element.selectedIndex].value;

  //ensures there are no changes to calculation and price is not NaN
  if(temp === '')
  {
    temp = 0;
  }

  if(id.includes('adult-seats'))
  {
    total += temp * adult;
    alert('calculation complete');
    getElement("total").value = "$" + total.toFixed(2);
    alert('total updated ' + adult);
    total = 0;
  }

  if(id.includes('concession-seats'))
  {
    total += temp * concession;
    alert('calculation complete');
    getElement("total").value = "$" + total.toFixed(2);
    alert('total updated ' + concession);
    total = 0;
  }

  if(id.includes('child-seats'))
  {
    total += temp * child;
    alert('calculation complete');
    getElement("total").value = "$" + total.toFixed(2);
    alert('total updated ' + child);
    total = 0;
  }


  // switch(id)
  // {
  //   case 'adult-seats':
  //   total += temp * adult;
  //   alert('calculation complete');
  //   getElement("total").value = "$" + total.toFixed(2);
  //   alert('total updated ' + adult);
  //   break;
  //
  //   case 'concession-seats':
  //   total += temp * concession;
  //   alert('calculation complete');
  //   getElement("total").value = "$" + total.toFixed(2);
  //   alert('total updated ' + concession);
  //   break;
  //
  //   case 'child-seats':
  //   total += temp * child;
  //   alert('calculation complete');
  //   getElement("total").value = "$" + total.toFixed(2);
  //   alert('total updated ' + child);
  //   break;
  // }
  //if previously used value is less than current dropdown value, +- rather than ++
}

function formValidate()
{
}

//boolean value to keep track of ready to submit status

function checkName(thisP)
{
  var patt = /^[a-zA-Z' -.]{1,}$/;
  if (!patt.test(thisP.value))
  {
    getElement('name-error').innerHTML='Please enter a Western name';
  }
  else
  {
    getElement('name-error').innerHTML='';
  }
}

function checkMobile(thisP)
{
  var patt = /^(\(04\)|04|\+614)([ ]?\d){8}$/;
  if (!patt.test(thisP.value))
  {
    getElement('mobile-error').innerHTML='Please enter a valid Australian mobile';
  }
  else
  {
    getElement('mobile-error').innerHTML='';
  }
}

function checkCard(thisP)
{
  var patt = /^(([45]\d{3})|(35\d{2}))-? ?\d{4}-? ?\d{4}-? ?\d{4}/;
  if (!patt.test(thisP.value))
  {
    getElement('card-error').innerHTML='Please enter a Visa, Mastercard or American Express credit card';
  }
  else
  {
    getElement('card-error').innerHTML='';
  }
}

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
  }
  else
  {
    getElement('expiry-error').innerHTML='Please enter a date in the future';
  }
}
