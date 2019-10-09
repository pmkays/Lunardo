<?php
session_start();
require 'tools.php';
require 'index.php';

if(empty($_SESSION)){
    header("Location: index.php");
}
$type = checkDiscountOrFull();

$moviesObject =
[
  'ACT' => ['title' => 'The Avengers: EndGame',
            'rating' => 'M',
            'description' => '<p>The grave course of events set in motion by Thanos that wiped out half
            the universe and fractured the Avengers ranks compels the remaining Avengers
            to take one final stand in Marvel Studios’ grand conclusion to twenty-two films.</p>',
            'screenings' => ['Wed' => 'T21',
                            'Thu' => 'T21',
                            'Fri' => 'T21',
                            'Sat' => 'T18',
                            'Sun' => 'T18'
                            ]
            ],
  'RMC' => ['title' => 'Top End Wedding',
            'rating' => 'M',
            'description' => '<p>Lauren and Ned have 10 days to find Laurens mother who has gone
            AWOL in the remote far north of Australia so that they can reunite
            her parents and pull off their dream wedding.</p>',
            'screenings' => ['Mon' => 'T18',
                            'Tue' => 'T18',
                            'Sat' => 'T15',
                            'Sun' => 'T15'
                            ]
            ],
  'ANM'=> ['title' => 'Dumbo',
            'rating' => 'M',
            'description' => '<p>Struggling circus owner Max Medici enlists a former star and his
            two children to care for Dumbo, a baby elephant born with oversized
            ears. When the family discovers that the animal can fly, it soon
            becomes the main attraction -- bringing in huge audiences and
            revitalizing the run-down circus.</p>',
            'screenings' => ['Mon' => 'T12',
                            'Tue' => 'T12',
                            'Wed' => 'T18',
                            'Thu' => 'T18',
                            'Fri' => 'T18',
                            'Sat' => 'T12',
                            'Sun' => 'T12'
                            ]
            ],
  'AHF' => ['title' => 'The Happy Prince',
            'rating' => 'MA15+',
            'description' => '<p>  His body ailing, Oscar Wilde lives out his last days in exile,
            observing the difficulties and failures surrounding him with
            ironic detachment, humour, and the wit that defined his life.</p>',
            'screenings' => ['Wed' => 'T12',
                            'Thu' => 'T12',
                            'Fri' => 'T12',
                            'Sat' => 'T21',
                            'Sun' => 'T21'
                            ]
            ]
]

$pricesObject =
[
  'full' => ['STA' => 19.80,
            'STP' => 17.50,
            'STC' =>15.30,
            'FCA' => 30.80,
            'FCP' => 27.00,
            'FCC' =>24.80
            ],
  'disc' => ['STA' => 14.00,
            'STP' => 12.50,
            'STC' =>11.00,
            'FCA' => 24.00,
            'FCP' => 22.50,
            'FCC' =>21.00
            ]
]

function checkDiscountorFull()
{
  //the day of movie chosen by form
  $dayOfMovie = $_SESSION['cart'][$movieDay];
  //the time of movie chosen by form
  $timeOfMovie = $_SESSION['cart'][$movieHour];

  //find all the movie's possible screenings
  $screenings = $moviesObject[$_SESSION['cart'][$movieID]]['screenings'];

  //the day chosen inside the moviesObject
  $day = $screenings[$dayOfMovie];

  //the hour chosen inside the moviesObject
  $hour = $day[$timeOfMovie];

  //all movies on mondays and wednesdays are discounted;
  if($day ==='Mon' && $day=== 'Wed'])
  {
    return 'disc';
  }
  //no movies on sunday and saturday are discounted
  else if($day ==='Sat' && $day === 'Sun'])
  {
    return 'full';
  }
  //weekday matinee sessions not covered by the Mon/Wed discount
  else if($day === 'Tue' && $day === 'Thu' && $day === 'Fri' && $hour === 'T12')
  {
    return 'discount';
  }
  //weekday nightly shows are not discounted
  else
  {
    return 'full';
  }
}
$boughtSeats = array();
$eachTicketSubTotal = array();

function checkSubTotal()
{
  //checks how many of each type of seat the user has booked
  foreach($_SESSION['seats'] as $seats => $amount)
  {
    //if user has at least booked a type of seat add it to an array
    if(!empty($amount))
    {
      //need to check if this will just replace the same element/index or if it moves forward; can't array.push an associative array
      $boughtSeats[$seats] = $amount;
    }
  }
  foreach ($boughtSeats as $seats => $amount)
  {
      //need to check if this will just replace the same element/index or if it moves forward; can't array.push an associative array
      //have to traverse through pricesObject array to find the price and multiply it by how many they bought
      $eachTicketSubTotal[$seats] = $pricesObject[$type][$seats] * $amount;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <link id='receiptStylecss' type="text/css" rel="stylesheet" href="receiptStyle.css">
</head>
<body>

<?= preShow($_SESSION['cart']) ?>

  <div id = receipt class = page>

    <!--establishment details always displayed first in invoices-->
    <h2>Lunardo Cinemas</h2>
    <address>Email: info@lunardo.com<br>
      Phone: (03) 8675 4672<br>
      56 Moonlight Way, Seymour, VIC, 3660<br><br>
    </address>

    <h1>Confirmation of Purchase</h1>
    <span class = category> Name: </span> <span class = information> <?= $_SESSION['cart'][$custName]?> </span>
    <span class = category> Email: </span> <span class = information> <?= $_SESSION['cart'][$custEmail]?> </span>
    <span class = category> Phone Number:</span> <span class = information> <?= $_SESSION['cart'][$custMobile]?> </span>
    <span class = category> Credit Card:</span> <span class = information> <?= $_SESSION['cart'][$custCard]?> </span>
    <span class = category> Credit Card Expiry:</span> <span class = information> <?= $_SESSION['cart'][$custExpiry]?> </span>

    <h2>Movie Details</h2>
    <p>
      <? php $movie = $moviesObject[$_SESSION['cart'][$movieID]]?>
      <span class = category> Title:</span> <span class = information><?=$movie['title']?></span>
      <span class = category> Rating:</span> <span class = information><?= $movie['rating']?></span>
      <span class = category> Screening Session:</span> <span class = information><?= $_SESSION['cart'][$movieDay]?> at <?= $_SESSION['cart'][$movieDay][$movieHour]?></span>
      <span class = category> Description:</span> <p class = information> <?= $movie['description']?> </p>
    </p>

    <h2>Order details</h2>
    <p>
    <?php

    forEach($boughtSeats as $seats => $amount)
    {
      //should echo out a table format of sorts
      echo '${seats} seats:  ${amount} ${eachSubTotal[$seats]}';
    }

    //echo out the total price as well
    ?>

    </p>


  </div>

</body>
</html>
