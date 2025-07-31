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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel=stylesheet>
  <link rel=stylesheet href="./styles/styles.css">
</head>

<body class="contact bg-light">
  <?php include './includes/navbar.php'; ?>
  <div class="contact-section bg-light text-dark py-5">
    <div class="container text-center">
      <h1 class="display-4 mb-4">Get in Touch</h1>
      <p class="lead mb-5">
        If you're looking for a skilled carpenter for your yacht restoration, refit, or custom joinery project, I'd love to hear from you. Please contact me by Email or WhatsApp below.
      </p>

      <div class="mb-4">
        <h5><strong>WhatsApp:</strong> +44 7391 794140</h5>
        <div class="d-flex justify-content-center mt-2">
          <a href="https://wa.me/447391794140" target="_blank" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" >
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"/></svg>
            WhatsApp
          </a>
        </div>
      </div>

      <div class="mb-4">
        <h5><strong>Email:</strong> richardnmatthews@hotmail.com</h5>
        <div class="d-flex justify-content-center mt-2">
          <a href="mailto:richardnmatthews@hotmail.com" target="_blank" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" >
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M112 128C85.5 128 64 149.5 64 176C64 191.1 71.1 205.3 83.2 214.4L291.2 370.4C308.3 383.2 331.7 383.2 348.8 370.4L556.8 214.4C568.9 205.3 576 191.1 576 176C576 149.5 554.5 128 528 128L112 128zM64 260L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 260L377.6 408.8C343.5 434.4 296.5 434.4 262.4 408.8L64 260z"/></svg>
            Email
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php include './includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php endCaching(); ?>
