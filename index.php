<?php
//  POST METHOD:
$feedbackSuccess = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $file = 'feedbacks.txt';
        $entry = "Name: $name\nEmail: $email\nMessage: $message\n---\n";
        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
        $feedbackSuccess = true;
    } else {
        $feedbackError = "Please fill all fields correctly.";
    }
}

// GET Method: selected member
$selectedMember = isset($_GET['member']) ? $_GET['member'] : '';

// Criphingels members informations:
$members = [
    [
        "id" => "inna",
        "fullName" => "Inna Amor Serrano",
        "personality" => "Ambivert",
        "favorites" => [
            "Food" => "Sinigang",
            "Animal" => "Pomeranian Dog",
            "Movie/Series" => "Sherlock Holmes",
            "KDrama" => "The Smile Has Left Your Eyes",
            "KPop" => "GFRIEND",
            "Jpop" => "ADO, YAOSABI"
        ],
        "hobbies" => ["Reading Wattpad, manga, webtoons, physical books","Listening to Classical Music","Playing Badminton"],
        "img" => "INNA.jpg",
        "social" => ["facebook"=>"https://www.facebook.com/innaserrano02","instagram"=>"https://www.instagram.com/amorin_na/?hl=en","github"=>"https://github.com/innaserrano02"],
        "leader" => true
    ],
    [
        "id" => "phoebe",
        "fullName" => "Phoebe Kaye Pontiñoza",
        "personality" => "Extrovert",
        "favorites" => ["Color"=>"Lavender","Bible Verse"=>"Matthew 6:25","Instrument"=>"Kalimba","Ice Cream Flavor"=>"Vanilla","Time of Day"=>"Midnight"],
        "hobbies" => ["Watching BL series","Reading books"],
        "img" => "PHOEBE.jpg",
        "social" => ["facebook"=>"https://www.facebook.com/iamphoebekaye/","instagram"=>"https://www.instagram.com/iamphoebekaye/?hl=en","github"=>"https://github.com/PhoebeKaye"]
    ],
    [
        "id" => "crisel",
        "fullName" => "Ma. Crisel Francisco",
        "personality" => "Introvert",
        "favorites" => ["Color"=>"Violet","Food"=>"Kaldereta","Artist"=>"Taylor Swift","Place"=>"Switzerland","Comfort Food"=>"Ice Cream","Season"=>"Winter"],
        "hobbies" => ["Reading","Writing","Drawing"],
        "img" => "CRISEL.jpg",
        "social" => ["facebook"=>"https://www.facebook.com/kkuriseruuchi","instagram"=>"https://www.instagram.com/kuriseruu/?hl=en","github"=>"https://github.com/CriselUchi"]
    ],
    [
        "id" => "resare",
        "fullName" => "Griselle Jane C. Resare",
        "personality" => "Introvert",
        "favorites" => ["Animal"=>"Cats & Dogs","Movie/Series"=>"Twilight","KPop"=>"BTS","Books"=>"Rara Ravis & Alegria Girls Series","Author"=>"Jonaxx","Food"=>"Adobo"],
        "hobbies" => ["Reading Wattpad stories","Playing volleyball & online games","Watching movies or series"],
        "img" => "resare.jpeg",
        "social" => ["facebook"=>"https://www.facebook.com/share/1JmRsvxK1u/","instagram"=>"https://www.instagram.com/gj.r_sr/?hl=en","github"=>"https://github.com/Griselle-Resare"]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criphingels Team Profiles</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&family=Theano+Didot&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
  <div class="nav-container">
    <a href="#home" class="logo">Criphingels</a>
    <ul class="nav-links">
      <li><a href="?member=inna" class="<?php echo ($selectedMember=='inna') ? 'active' : ''; ?>">SERRANO</a></li>
      <li><a href="?member=phoebe" class="<?php echo ($selectedMember=='phoebe') ? 'active' : ''; ?>">PONTIÑOZA</a></li>
      <li><a href="?member=crisel" class="<?php echo ($selectedMember=='crisel') ? 'active' : ''; ?>">FRANCISCO</a></li>
      <li><a href="?member=resare" class="<?php echo ($selectedMember=='resare') ? 'active' : ''; ?>">RESARE</a></li>
    </ul>
    <button class="feedback-button"><i class="fa-solid fa-comment"></i> Feedback</button>
  </div>
</header>

<!-- Feedback Form -->
<div class="feedback-form-container">
  <?php if ($feedbackSuccess) { echo "<p class='feedback-success'>Thank you! Your feedback has been sent.</p>"; } ?>
  <?php if (!empty($feedbackError)) { echo "<p class='feedback-error'>$feedbackError</p>"; } ?>
  <form method="POST" class="feedback-form">
    <h2>Send Your Feedback</h2>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    
    <label for="message">Message</label>
    <textarea id="message" name="message" rows="5" required></textarea>
    
    <button type="submit">Submit</button>
  </form>
</div>

<main>
  <section class="start-page fade-in" id="home">
    <div class="start-content">
      <h1 class="start-title">Welcome to Criphingels</h1>
      <p class="subtitle"><span class="typing">Our Little Corner of the Web</span></p>
    </div>
  </section>

  <?php
  foreach ($members as $member) {
      if ($selectedMember && $selectedMember !== $member['id']) continue;

      echo '<section class="profile-section fade-in" id="'.$member['id'].'">';
      echo '<article class="profile-card">';
      echo '<img src="'.$member['img'].'" alt="'.$member['fullName'].'" class="profile-pic">';
      echo '<div class="profile-info">';
      echo '<h1>'.$member['fullName'].'</h1>';

      if (!empty($member['leader'])) {
          echo '<span class="badge leader">Team Leader</span>';
      }

      $badgeClass = ($member['personality'] == "Introvert") ? "introvert" : "extrovert";
      echo '<span class="badge '.$badgeClass.'">'.$member['personality'].'</span>';

      echo '<h2>Favorites</h2><ul>';
      foreach ($member['favorites'] as $key => $value) {
          echo '<li>'.$key.': '.$value.'</li>';
      }
      echo '</ul>';

      echo '<h2>Hobbies</h2><ul>';
      foreach ($member['hobbies'] as $hobby) {
          echo '<li>'.$hobby.'</li>';
      }
      echo '</ul>';
      echo '</div>';

      echo '<div class="profile-social">';
      echo '<div class="heart-menu"><i class="fa-solid fa-heart"></i>';
      echo '<div class="social-links">';
      foreach ($member['social'] as $platform => $link) {
          echo '<a href="'.$link.'" target="_blank"><i class="fab fa-'.$platform.'"></i></a>';
      }
      echo '</div></div></div>';

      echo '</article></section>';
  }
  ?>

</main>

<button id="backToTop" class="fade-in">↑</button>

<footer class="fade-in">
  <p>© 2025 Criphingels</p>
</footer>

<script src="script.js"></script>
</body>
</html>
