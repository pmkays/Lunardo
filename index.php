<?php
session_start();
require 'tools.php';


$nameErr = $emailErr = $mobileErr = $creditCardErr = $expiryErr = "";

$ticketErr = $timeErr =  "";

$custName = $custEmail = $custMobile = $custCard = $custExpiry = "";
$movieID = $movieDay = $movieHour = "";
$seatSTA = $seatsSTP = $seatsSTC = $seatFCA = $seatsFTP = $seatsFTC = "";

$allOK = true;

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  $cust_name = $_POST['cust']['name'];
  $cust_email = $_POST['cust']['email'];
  $cust_mobile = $_POST['cust']['mobile'];
  $cust_card = $_POST['cust']['card'];
  $custExpiry = $_POST['cust']['expiry'];

  //no validation required for these
  $movieID = $_POST['movie']['id'];
  $movieDay = $_POST['movie']['day'];
  $movieHour = $_POST['movie']['hour'];
  $seatsSTA = $_POST['seats']['STA'];
  $seatsSTP = $_POST['seats']['STP'];
  $seatsSTC = $_POST['seats']['STC'];
  $seatFCA = $_POST['seats']['FCA'];
  $seatsFTP = $_POST['seats']['FCP'];
  $seatsFTC =$_POST['seats']['FCC'];


//    verifyPostData($_POST);
//}
    if (empty($cust_name))
    {
        $nameErr = "Name is required";
        $allOK = false;
    }
    else
    {
        $custName = testInput($cust_name);
        $patt = "/^[a-zA-Z' -.]{1,}$/";
        if(!preg_match($patt, $custName))
        {
          $nameErr = "Please enter a Western name";
          $allOK = false;
        }
    }

    //shouldn't need to check email bc type = email and required = true in html?
    if (empty($cust_email))
    {
      //line will never pass because of html
        $emailErr = "Email is required";
        $allOK = false;
    }
    else
    {
        $custEmail = testInput($cust_email);
        if(!filter_var($custEmail, FILTER_VALIDATE_EMAIL))
        {
          $emailErr = "Please enter a valid email";
          $allOK = false;
        }

    }

    if (empty($cust_mobile))
    {
        $mobileErr = "Mobile number is required";
        $allOK = false;
    }
    else
    {
        $custMobile = testInput($cust_mobile);
        $patt = "/^(\(04\)|04|\+614)([ ]?\d){8}$/";
        if(!preg_match($patt, $custMobile))
        {
          $mobileErr = "Please enter a valid mobile";
          $allOK = false;
        }
    }

    if (empty($cust_card))
    {
        $creditCardErr = "Credit card is required";
        $allOK = false;
    }
    else
    {
        $custCard = testInput($cust_card);
        $patt = "/^(([45]\d{3})|(35\d{2}))-? ?\d{4}-? ?\d{4}-? ?\d{4}$/";
        if(!preg_match($patt, $custCard))
        {
          $creditCardErr = "Please enter a valid credit card number";
          $allOK = false;
        }
    }

    if (empty($custExpiry))
    {
        $expiryErr = "Expiry date is required";
        $allOK = false;
    }

    function atLeastOneTicket()
    {
      foreach ($_POST['seats'] as $type => $amount)
      {
        if(!empty($amount))
        {
          return true;
        }
      }
    }

    if(!atLeastOneTicket())
    {
      $ticketErr = "Please select at least one ticket";
      $allOK = false;
    }
   
    if (empty($movieID))
    {
        $allOK = false;
    }
    
    if (empty($movieDay))
    {
        $allOK = false;
    }

    if (empty($movieHour))
    {
        $timeErr = "Please select a session";
        $allOK = false;
    }

    if($allOK === true)
    {
        $_SESSION['cart'] = $_POST;
        header("Location: receipt.php");
        exit;
    }
}

topModule();
?>

  <body id = "body">
    <header class = "header" id = "head">
      <section class="section-1">
        <h1 class = "title">Lunardo Theatre</h1>
        <p class="slogan">
          Est. 1987</p>
      </section>
    </header>

    <nav class = "navbar">
      <section class="section-2">
        <div class="navbar";>
          <a class="link" href="#about" id = "about-btn">About Us</a>
          <a class="link" href="#news" id = "news-btn">News</a>
          <a class="link" href="#prices" id = "prices-btn">Prices</a>
          <a class="link" href="#showing" id = "showing-btn">Now Showing</a>
          <a class="link" href="#synopsis" id = "synopsis-btn">Synopsis</a>
          <a class="link" href="#contact" id = "contact-btn">Contact Us</a>
        </div>
      </section>
    </nav>

    <main>
      <section class="section-3">
        <div class = "about-us">
          <a class = "anchor" name="about" id = "about">.</a>
          <div class="about-us-box">
            <h2 class = "section-title">About Us</h2>
            <div class = "about-info"><?= preShow($_POST) ?>After serving Seymour for many years, we, Lunardo Cinema,
              are proud to present our newly refurbished and improved state-of-the-art
              cinema for all your entertainment needs. A few of our many changes include
              more luxurious standard seats and recliner seats for those who opt for
              the first-class option. Our theatres are now also equipped with 3D Dolby
              Vision projection and Dolby Atmos sound to provide you with the best
              visual and auditory experience possible. <br><br> Come in today to see
              (and hear!) the difference!
            </div>
            <!-- <img src="http://www.profurn.com.au/wp-content/uploads/2016/09/538.jpg" alt="normal seats"  />
            <img src="http://www.profurn.com.au/wp-content/uploads/2016/07/Verona-Twin.png" alt="first-class seats"/> -->
          </div>
        </div>
        <hr>
        <div class = "news">
          <a class = "anchor" name="news" id= "news">.</a>
          <div class="news-box">
            <h2 class = "section-title">News</h2>
            <div class = "about-info">
              <p>
                We have recently upgraded our seats to all new Profurn luxury seats.
              </p>
              <p>
                Standard viewers can enjoy the all new Profurn 538, which feature leather headrests and multi-angled backrest.
                On the other hand our first class viewers can enjoy the luxurious Profurn Verona seats. Also available as twin seats for those romantic dates!
                They are fully motorized reclining and include large cup holders.
              </p>
            </div>
            <!-- <img src="http://www.profurn.com.au/wp-content/uploads/2016/09/538.jpg" alt="normal seats"  />
            <img src="http://www.profurn.com.au/wp-content/uploads/2016/07/Verona-Twin.png" alt="first-class seats"/> -->
          </div>
        </div>
        <hr>
        <div class="prices" id = "prices">
          <div class="prices-box">
            <h2 class= "section-title">Prices</h2>
            <div class="price-row">
              <p>The Cinema offers discounted pricing weekday afternoons (ie weekday matinée sessions) and all day on Mondays and Wednesdays. </p>
              <table class = "table">
                <thead>
                  <th>Seat Type</th>
                  <th>Discount Times</th>
                  <th>All other times</th>
                </thead>
                <tr>
                  <td>Standard Adult</td>
                  <td>$14.00</td>
                  <td>$19.80</td>
                </tr>
                <tr>
                  <td>Standard Concession</td>
                  <td>$12.50</td>
                  <td>$17.50</td>
                </tr>
                <tr>
                  <td>Standard Child</td>
                  <td>$11.00</td>
                  <td>$15.30</td>
                </tr>
                <tr>
                  <td>First Class Adult</td>
                  <td>$24.00</td>
                  <td>$30.80</td>
                </tr>
                <tr>
                  <td>First Class Concession</td>
                  <td>$22.50</td>
                  <td>$27.00</td>
                </tr>
                <tr>
                  <td>Firt Class Child</td>
                  <td>$21.00</td>
                  <td>$24.80</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <hr>
        <div class="now-showing" id = showing>
          <h2 class="section-title">Now Showing</h2>
          <h4 class = "now-showing-description">Choose a movie to book.</h4>
          <div class ="flexbox">
            <div class="movie 1" id = "movePanelACT">
              <img class="poster" src="https://images-na.ssl-images-amazon.com/images/I/71niXI3lxlL._SY606_.jpg" alt="the avengers:endgame poster"/>
              <h3 class="movie-title">The Avengers: Endgame <br> M</h3>
              <p class="description">
                Wednesday - 21:00<br>
                Thursday - 21:00<br>
                Friday - 21:00<br>
                Saturday - 18:00<br>
                Sunday - 18:00<br>
              </p>
            </div>

            <div class="movie 2" id = "movePanelRMC">
              <img class="poster" src="https://d32qys9a6wm9no.cloudfront.net/images/movies/poster/3e/1057b1941fd7267062a7a6608bd63629_500x735.jpg?t=1556774279" alt="Top End Wedding poster"/>
              <h3 class="movie-title">Top End Wedding <br> M</h3>
              <p class="description">
                Monday - 18:00<br>
                Tuesday - 18:00<br>
                Saturday - 15:00<br>
                Sunday - 15:00<br>
              </p>
            </div>

            <div class="movie 3" id = "movePanelANM">
              <img class="poster" src ="https://images-na.ssl-images-amazon.com/images/I/71jOztWX9YL._SL1259_.jpg" alt="Dumbo poster"/>
              <h3 class="movie-title">Dumbo <br> PG</h3>
              <p class="description">
                Monday - 12:00<br>
                Tuesday - 12:00<br>
                Wednesday - 18:00<br>
                Thursday - 18:00<br>
                Friday - 18:00<br>
                Saturday - 12:00<br>
                Sunday - 12:00<br>
              </p>
            </div>

            <div class="movie 4" id = "movePanelAHF">
              <img class="poster" src="https://m.media-amazon.com/images/M/MV5BODVjZThlMzMtZjQwNy00YjRlLWE5ZTMtMWVlMWUwM2U1NjRkXkEyXkFqcGdeQXVyODcyODY1Mzg@._V1_.jpg" alt="The Happy Prince poster" />
              <h3 class="movie-title">The Happy Prince <br> MA15+</h3>
              <p class="description">
                Wednesday - 12:00<br>
                Thursday - 12:00<br>
                Friday - 12:00<br>
                Saturday - 21:00<br>
                Sunday - 21:00<br>
              </p>
            </div>
          </div>
        </div>
      </section>
      <hr>
      <section class="synopsis" id = "synopsis">
        <h2 class = "section-title">Synopsis</h2>
        <div class="synopsis-display" id = "synopsisACT">
          <h3 class="movie-title">The Avengers: Endgame &emsp; &emsp; M</h3>
          <iframe width="30%" height="20%" src="https://www.youtube.com/embed/TcMBFSGVi1c"
          frameborder="0" allowfullscreen></iframe>
          <h3 class="movie-information"><br>Plot Description</h3>
            <p>
              The grave course of events set in motion by Thanos that wiped out half
              the universe and fractured the Avengers ranks compels the remaining Avengers
              to take one final stand in Marvel Studios’ grand conclusion to twenty-two films,
              Avengers: Endgame.
            </p>
          <h3 class="movie-information"><br>Make a Booking</h3>
          <div class="booking flexbox">
            <button class = "booking-btn"  id = 'WedT21ACT' onclick = 'checkDiscount(this.id)'>Wednesday - 21:00</button>
            <button class = "booking-btn"  id = 'ThuT21ACT' onclick = 'checkDiscount(this.id)'>Thursday - 21:00</button>
            <button class = "booking-btn"  id = 'FriT21ACT' onclick = 'checkDiscount(this.id)'>Friday - 21:00</button>
            <button class = "booking-btn"  id = 'SatT18ACT' onclick = 'checkDiscount(this.id)'>Saturday - 18:00</button>
            <button class = "booking-btn"  id = 'SunT18ACT' onclick = 'checkDiscount(this.id)'>Sunday - 18:00</button>

          </div>
        </div>
        <div class="synopsis-display" id = "synopsisRMC">
          <h3 class="movie-title">Top End Wedding &emsp; &emsp; M</h3>
          <iframe width="30%" height="20%" src="https://www.youtube.com/embed/uoDBvGF9pPU"
          frameborder="0" allowfullscreen></iframe>
          <h3 class="movie-information"><br>Plot Description</h3>
            <p>
              Lauren and Ned have 10 days to find Lauren's mother who has gone
              AWOL in the remote far north of Australia so that they can reunite
              her parents and pull off their dream wedding.
            </p>
          <h3 class="movie-information"><br>Make a Booking</h3>
          <div class="booking flexbox">
            <button class = "booking-btn"  id = 'MonT18RMC' onclick = 'checkDiscount(this.id)'>Monday - 18:00</button>
            <button class = "booking-btn"  id = 'TueT18RMC' onclick = 'checkDiscount(this.id)'>Tuesday - 18:00</button>
            <button class = "booking-btn"  id = 'SatT15RMC' onclick = 'checkDiscount(this.id)'>Saturday - 15:00</button>
            <button class = "booking-btn"  id = 'SunT15RMC' onclick = 'checkDiscount(this.id)'>Sunday - 15:00</button>

          </div>
        </div>
        <div class="synopsis-display" id = "synopsisANM">
          <h3 class="movie-title">Dumbo &emsp; &emsp; PG</h3>
          <iframe width="30%" height="20%" src="https://www.youtube.com/embed/7NiYVoqBt-8"
          frameborder="0" allowfullscreen></iframe>
          <h3 class="movie-information"><br>Plot Description</h3>
            <p>
              Struggling circus owner Max Medici enlists a former star and his
              two children to care for Dumbo, a baby elephant born with oversized
              ears. When the family discovers that the animal can fly, it soon
              becomes the main attraction -- bringing in huge audiences and
              revitalizing the run-down circus.
            </p>
          <h3 class="movie-information"><br>Make a Booking</h3>
          <div class="booking flexbox">
            <button class = "booking-btn"  id = 'MonT12ANM' onclick = 'checkDiscount(this.id)'>Monday - 12:00</button>
            <button class = "booking-btn"  id = 'TueT12ANM' onclick = 'checkDiscount(this.id)'>Tuesday - 12:00</button>
            <button class = "booking-btn"  id = 'WedT18ANM' onclick = 'checkDiscount(this.id)'>Wednesday - 18:00</button>
            <button class = "booking-btn"  id = 'ThuT18ANM' onclick = 'checkDiscount(this.id)'>Thursday - 18:00</button>
            <button class = "booking-btn"  id = 'FriT18ANM' onclick = 'checkDiscount(this.id)'>Friday - 18:00</button>
            <button class = "booking-btn"  id = 'SatT12ANM' onclick = 'checkDiscount(this.id)'>Saturday - 12:00</button>
            <button class = "booking-btn"  id = 'SunT12ANM' onclick = 'checkDiscount(this.id)'>Sunday - 12:00</button>

          </div>
        </div>
        <div class="synopsis-display" id = "synopsisAHF">
          <h3 class="movie-title">The Happy Prince &emsp; &emsp; MA15+</h3>
          <iframe width="30%" height="20%" src="https://www.youtube.com/embed/tXANCJQkUIE"
          frameborder="0" allowfullscreen></iframe>
          <h3 class="movie-information"><br>Plot Description</h3>
            <p>
              His body ailing, Oscar Wilde lives out his last days in exile,
              observing the difficulties and failures surrounding him with
              ironic detachment, humour, and the wit that defined his life.
            </p>
          <h3 class="movie-information"><br>Make a Booking</h3>
          <div class="booking flexbox">
            <button class = "booking-btn" id ='WedT12AHF' onclick = 'checkDiscount(this.id)'>Wednesday - 12:00</button>
            <button class = "booking-btn"  id = 'ThuT12AHF' onclick = 'checkDiscount(this.id)'>Thursday - 12:00</button>
            <button class = "booking-btn"  id = 'FriT12AHF' onclick = 'checkDiscount(this.id)'>Friday - 12:00</button>
            <button class = "booking-btn"  id = 'SatT21AHF' onclick = 'checkDiscount(this.id)'>Saturday - 21:00</button>
            <button class = "booking-btn"  id = 'SunT21AHF' onclick = 'checkDiscount(this.id)'>Sunday - 21:00</button>
          </div>
        </div>

        <div class = "form">
          <h2 class = "booking-title">Booking for:</h2>
          <h3 id = "selected-Movie" class = "movie-title">The Avengers: End Game - No time selected</h3>

          <form method="post" target = "_blank" id ='booking-form' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return formValidate()">
            <table class = "form-table">
            <tr>
            <td>

            <div class = 'standard-box'>
              <fieldset class = "seats field">

                <legend class = "legends">Standard</legend>

              <p>Adult:<br />
                <select name='seats[STA]' id ='seats-sta' onchange = 'calculatePrice()' selected = "<?php $seatsSTA?>">
                  <option value='' selected>Please Select</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                </select>
              </p>

              <p>Concession:<br />
                <select name='seats[STP]' id='seats-stp' onchange = 'calculatePrice()' selected = "<?php $seatsSTP?>" >
                  <option value='' selected>Please Select</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                </select>
              </p>

              <p>Children:<br />
                <select name='seats[STC]' id = 'seats-stc' onchange = 'calculatePrice()' selected = "<?php $seatsSTC?>">
                  <option value='' selected>Please Select</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                </select>
              </p>
              </fieldset>

            </div>
          </td>
          <td rowspan="2">
            <div class = 'personal-box'>
              <fieldset class = "personal field">

                <legend class = "legends">Personal Info</legend>
                <p><label for="cust-name">Name:</label><br>
                <input type="text" id="cust-name" name="cust[name]" oninput = 'checkName(this)' placeholder = 'Western Name' value = "<?= $custName ?>" required><br>
                <span class="error" id="name-error"><?php echo $nameErr;?></span></p>
                <p><label for="cust-email">Email:</label><br>
                  <input type="email" id="cust-email" name="cust[email]" placeholder = 'Valid email' value = "<?= $custEmail ?>" required </p><br>
                  <span class="error"> <?php echo $emailErr;?></span>
                <p><label for="cust-mobile">Mobile:</label><br>
                  <input type="tel" id="cust-mobile" name="cust[mobile]" oninput = 'checkMobile(this)' placeholder = 'Australian number' value = "<?= $custMobile ?>" required><br>
                    <span class="error" id="mobile-error"><?php echo $mobileErr;?></span></p>
                <p><label for="cust-card">Credit Card:</label><br>
                  <input type="text" id="cust-card" name="cust[card]" oninput = 'checkCard(this)' placeholder = 'AMEX, VISA, Mastercard'  value = "<?= $custCard ?>" required><br>
                    <span class="error" id="card-error"><?php echo $creditCardErr;?></span></p>
                <p><label for="cust-expiry">Expiry Date:</label><br>
                  <input type="month" min = <?php advanceDate("P1M")?> max = <?php advanceDate("P10Y")?> id="cust-expiry" name="cust[expiry]" oninput = 'checkExpiry(this)' value = "<?= $custExpiry ?>" required><br>
                    <span class="error" id="expiry-error"><?php echo $expiryErr;?></span></p>
                <p>
                  <input type="hidden" id="movie-ID" name="movie[id]" value="<?php echo $movieID;?>">
                  <input type="hidden" id="movie-day" name="movie[day]" value="<?php echo $movieDay;?>">
                  <input type="hidden" id="movie-hour" name="movie[hour]" value="<?php echo $movieHour;?>">
                </p>
                <p>
                  <br>Total: <br>
                  <!-- <input value="$0.00" readonly="readonly" type="text" id="total"/> -->
                  <span id = total>$0.00</span><br>
                  <span class="error" id="ticket-error"><?php echo $ticketErr;?></span>
                  <span class="error" id="time-error"><?php echo $timeErr;?></span>
                </p>
                <h4 id ="book-error"></h4>
                <h4 id = "ticket-error"></h4>
                <p><br><input type="submit" class = "submitButton" id = "submit-button" value="Order"></p>
              </fieldset>
            </div>
          </td>
          </tr>
          <tr>
            <td>

            <div class = 'first-class-box' id = 'first-class-selection'>
              <fieldset class = "seats field">

                <legend class = "legends">First Class</legend>

              <p>Adult:<br />
                <select name='seats[FCA]' id = 'seats-fca' onchange = 'calculatePrice()' selected = "<?php $seatsFCA ?>">
                  <option value='' selected>Please Select</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                </select>
              </p>

              <p>Concession:<br />
                <select name='seats[FCP]' id = 'seats-fcp' onchange = 'calculatePrice()' selected = "<?php $seatsFCP ?>" >
                  <option value='' selected>Please Select</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                </select>
              </p>

              <p>Children:<br />
                <select name='seats[FCC]' id = 'seats-fcc' onchange = 'calculatePrice()' selected = "<?php $seatsFCC ?>">
                  <option value='' selected>Please Select</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='6'>6</option>
                  <option value='7'>7</option>
                  <option value='8'>8</option>
                  <option value='9'>9</option>
                  <option value='10'>10</option>
                </select>
              </p>
              </fieldset>

            </div>

          </td>
          </tr>

          </table>
          </form>
        </div>
      </section>
      <hr>

    </main>

    <footer>
      <section class="section-5" id = "contact">
        <h3 class ="contact-details">Contact details </h3>
        <img class = "icon" alt = "Link to Lunardo Facebook" src = "images/icons/facebook.png" /></img>
        <img class = "icon" alt = "Link to Lunardo Twitter" src = "images/icons/twitter.png" /></img>
        <img class = "icon" alt = "Link to Lunardo Instagram" src = "images/icons/instagram.png" /></img>
        <address>Email: info@lunardo.com<br>
          Phone: (03) 8675 4672<br>
          56 Moonlight Way, Seymour, VIC, 3660<br><br>
        </address>

        <a href="https://github.com/pmkays/Lunardo" class = "myButton">Github Joint Repo</a>

        <p class = "student-info">
          <div class = "student-info">&copy;
            <script>
              document.write(new Date().getFullYear());
            </script>
            Ian Nguyen (S3788210) and Paula Kurniawan (S3782041).
          </div>

          <div class = "student-info">Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
          <div class = "student-info">All images used are licensed free images unless indicated.</div>
          <div class = "student-info">Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
          <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
        </p>
      </section>
      <script src="tools.js"></script>
      <script src="movieFunctions.js"></script>
    </footer>
  </body>
</html>
