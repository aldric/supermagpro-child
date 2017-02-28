<!DOCTYPE html>
<html>
  <head></head>
  <body>

<?php
require_once("class/BankReviewJson.php");

$review = new BankReviewJson("Monabanq",
                             "Villeneuve d'asq, Lille cedex 9",
                             "0680606073",
                             "http://www.example.com/monabanq.jpg",
                             "Le banque en ligne au meilleur prix",
                             "https://topbanque.net/linkAffiliate",
                             "4.6",
                             "Revue de la banque en ligne Monabanq.",
                             "Ici on pourrait mettre le recap en une ligne de notre avis");
echo '<pre>';
echo $review->toJson();
echo '</pre>';
 ?>
 </body>
 <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <a title="Go to %ftitle%." href="%link%" itemprop="url">
      <span itemprop="title"><span property="name">%htitle%</span></span>
    </a>
    <meta property="position" content="%position%">
  </span>
 </html>
