<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Kyle Arch</title>

  <!-- CSS -->
  <link href="//fonts.googleapis.com/css?family=Anonymous+Pro:400,400i|Lora:400,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('css/style.css'); ?>" type="text/css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css" media="screen" title="no title" charset="utf-8">

  <!-- Good on you for inspecting the source! Arbitrary 4000 bonus points if you send me an email with "I inspected your site" as the subject. -->

</head>
<body>
  <div class="container">

    <?php view('partials.header'); ?>

    <?php view($content); ?>

    <?php view('partials.footer'); ?>
    
  </div>
</body>
</html>