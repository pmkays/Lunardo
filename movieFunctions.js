
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
