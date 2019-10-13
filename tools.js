
window.onscroll = function() {navbarUpdate();};

function navbarUpdate() {
  var scrollPosition =  document.documentElement.scrollTop;
  var scrollInnerHeight = scrollPosition + window.innerHeight;
  var color = '#5c4f1a';

  if(scrollPosition==0){
    resetNavBar();
  }
  if(scrollPosition >= getElement('about').offsetTop){
    resetNavBar();
    getElement('about-btn').style.backgroundColor = color;
  }
  if(scrollPosition >= getElement('news').offsetTop-2){
    resetNavBar();
    getElement('news-btn').style.backgroundColor = color;
  }
  if(scrollPosition >= getElement('prices').offsetTop-2){
    resetNavBar();
    getElement('prices-btn').style.backgroundColor = color;
  }
  if(scrollPosition >= getElement('showing').offsetTop-2){
    resetNavBar();
    getElement('showing-btn').style.backgroundColor = color;
  }
  if(scrollPosition >= getElement('synopsis').offsetTop-2){
    resetNavBar();
    getElement('synopsis-btn').style.backgroundColor = color;
  }
  if(scrollInnerHeight >= document.documentElement.offsetHeight-2){
    resetNavBar();
    getElement('contact-btn').style.backgroundColor = color;
  }
}

function resetNavBar(){
  getElement('about-btn').style.backgroundColor = '';
  getElement('news-btn').style.backgroundColor = '';
  getElement('prices-btn').style.backgroundColor = '';
  getElement('showing-btn').style.backgroundColor = '';
  getElement('synopsis-btn').style.backgroundColor = '';
  getElement('contact-btn').style.backgroundColor = '';

}

function getElement(id){
  return document.getElementById(id);
}

function printReceipt(){
  getElement('ticket-page').style.display = 'none';
  window.print();
  getElement('ticket-page').style.display = 'block';
}

function printTickets(){
  getElement('receipt').style.display = 'none';
  window.print();
  getElement('receipt').style.display = 'block';
}