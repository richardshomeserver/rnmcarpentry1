<?php require_once './includes/minify.php';
require_once './includes/caching.php';
startCaching(); ?>
<!doctype html>
<html lang=en>

<head>
  <meta charset=UTF-8>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <title>Richard Matthews | Contact</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css rel=stylesheet>
  <link rel=stylesheet href=./styles/styles.css>
</head>

<body class="contact bg-light">
  <?php include './includes/navbar.php'; ?>
  <div class="contact-section bg-light text-dark">
    <div class="container text-center">
      <h1 class="display-4 mb-4">Get in Touch</h1>
      <p class="lead mb-5">
        If you're looking for a skilled carpenter for your yacht restoration, refit, or custom joinery project, I'd love to hear from you. Please contact me by Email or WhatsApp below.
      </p>
      <div class="row justify-content-center">
        <div class=col-md-6>
          <h5><strong>WhatsApp:</strong> <a href=https://wa.me/447391794140 target=_blank class=text-decoration-none>WhatsApp</a></h5>
          <h5><strong>Email:</strong> <a href=mailto:richardnmatthews@hotmail.com target=_blank class=text-decoration-none>richardnmatthews@hotmail.com</a></h5>
        </div>
      </div>
    </div>
  </div>
  <?php include './includes/footer.php'; ?>
  <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js></script>
</body>

</html>
<?php endCaching();
