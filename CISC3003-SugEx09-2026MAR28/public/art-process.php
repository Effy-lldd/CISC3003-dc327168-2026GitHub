<?php
$title        = $_POST['title'] ?? '';
$description  = $_POST['description'] ?? '';
$genre        = $_POST['genre'] ?? '';
$subject      = $_POST['subject'] ?? '';
$medium       = $_POST['medium'] ?? '';
$year         = $_POST['year'] ?? '';
$museum       = $_POST['museum'] ?? '';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>CISC3003 Suggested Exercise 09</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/misc.js"></script>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php include 'header.inc.php'; ?>
    
<main>
    <section class="results">
    
    <table>
      <caption class="results__caption">Art Work Saved</caption>
      <tr>
        <td class="results__label">Title</td>    
        <td class="results__value"><?php echo htmlspecialchars($title); ?></td> 
      </tr>
      <tr>
        <td class="results__label">Description</td>    
        <td class="results__value"><?php echo htmlspecialchars($description); ?></td> 
      </tr>
      <tr>
        <td class="results__label">Genre</td>    
        <td class="results__value"><?php echo htmlspecialchars($genre); ?></td> 
      </tr>
      <tr>
        <td class="results__label">Subject</td>    
        <td class="results__value"><?php echo htmlspecialchars($subject); ?></td> 
      </tr>
      <tr>
        <td class="results__label">Medium</td>    
        <td class="results__value"><?php echo htmlspecialchars($medium); ?></td> 
      </tr>   
      <tr>
        <td class="results__label">Year</td>    
        <td class="results__value"><?php echo htmlspecialchars($year); ?></td> 
      </tr>  
      <tr>
        <td class="results__label">Museum</td>    
        <td class="results__value"><?php echo htmlspecialchars($museum); ?></td> 
      </tr>          
    </table>
    
    </section>
</main>       
</body>
</html>