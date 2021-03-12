<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta 
    name="description" 
    content=""
  >
  <title><?= $site_title ?></title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link 
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Poppins:wght@300;400;700&display=swap" 
    rel="stylesheet"
  >
  <link rel="stylesheet" href="<?= ROOT_DIR ?>build/css/main.min.css">
</head>
<body <?= ($site_id ? "id='{$site_id}'" : '') ?> >

<header class="site-header">
  <h1 class="m0 shadow--text">KindleUploader</h1>
</header>