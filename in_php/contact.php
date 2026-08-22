<?php include 'header.php'; ?>

  <div class="optech-breadcrumb nz-breadcrumb">
    <div class="container">
      <h1 class="post__title">Contact us</h1>
      <nav class="breadcrumbs">
        <ul>
          <li><a href='index'>Home</a></li>
          <li aria-current="page"> Contact us</li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- End breadcrumb -->

  <div class="section optech-section-padding">
    <div class="container">
      <div class="row g-4 align-items-start">
        <div class="col-lg-6">
          <div class="optech-main-form nz-form-card">
            <h3>Fill The Contact Form</h3>
            <p>Feel free to contact with us, we don't spam your email</p>
            <form class="nz-form" action="send_email.php" method="POST">
              <div class="row">
                <div class="col-lg-6">
                  <div class="optech-main-field">
                    <input type="text" name="name" placeholder="Your name" required>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="optech-main-field">
                    <input type="tel" name="phone" placeholder="Phone number" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="optech-main-field">
                    <input type="email" name="email" placeholder="Email address" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="optech-main-field">
                    <select name="service" required>
                      <option value="" selected disabled>Select service</option>
                      <option value="Website Development">Website Development</option>
                      <option value="App Development">App Development</option>
                      <option value="Software Development">Software Development</option>
                      <option value="SEO">SEO</option>
                      <option value="AI Automation">AI Automation</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="optech-main-field">
                    <textarea name="message" placeholder="Write your message" required></textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button class="nz-form-btn" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center">
          <div class="optech-default-content">
            <h2>Let's build an awesome project together</h2>
            <p>Get in touch with our team. We're always ready to help you transform your business with innovative IT solutions. Fill out the form and we'll respond within 24 hours.</p>
            <div class="optech-contact-info-column">
              <div class="optech-contact-info">
                <i class="ri-map-pin-2-fill"></i>
                <h5>Address</h5>
                <p>Kestopur, Kolkata<br>India</p>
              </div>
              <div class="optech-contact-info">
                <i class="ri-mail-fill"></i>
                <h5>Contact</h5>
                <a href="mailto:skonlineitsolution@gmail.com">skonlineitsolution@gmail.com</a>
                <a href="tel:6297616918">+91-6297616918</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End section -->
  <script src="assets/js/contact-form.js"></script>
<?php include 'footer.php'; ?>
