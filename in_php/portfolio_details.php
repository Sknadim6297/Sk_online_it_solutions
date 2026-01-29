<?php 
include 'header.php'; 

// Only RC Logistics is featured; default if no or unknown id
$project = [
  'title' => 'RC Logistics',
  'category' => 'Web Development & Domestic Logistics',
  'breadcrumb' => 'RC Logistics - Domestic Transport Solutions',
  // Replace with the provided RC Logistics hero image (save as this path)
  'main_image' => 'assets/images/projects/rg-logistic.png',
  'gallery_image1' => 'assets/images/projects/rg-logistic.png',
  'gallery_image2' => 'assets/images/projects/rg-logistic.png',
  'overview' => 'RC Logistics is a trusted domestic logistics provider, delivering end-to-end transport solutions across the nation. They specialize in fast, safe, and cost-effective services that keep goods moving reliably within India.',
  'overview_detailed' => 'We built a high-performance web experience that mirrors RC Logistics\' promise of seamless delivery. The site highlights their nationwide reach, transparent pricing, and always-on support while keeping the navigation lightweight for quick access to quotes and service details.',
  'challenge' => 'RC Logistics needed a digital presence that could translate their operational reliability into an intuitive online experience—fast-loading, mobile-first, and optimized for lead capture across every device.',
  'challenge_detailed' => 'Key requirements included rapid page loads on low bandwidth, clear service storytelling, strong trust signals (contacts, accreditations), and a single-click path to request a quote. We optimized media, simplified the IA, and added prominent CTAs to convert visitors into bookings.',
  'features' => [
    'Hero storytelling with logistics-specific messaging and trust cues',
    'Mobile-first layout with compressed assets for quick loads',
    'Prominent click-to-call and WhatsApp CTAs for instant reach',
    'Structured services overview for domestic logistics offerings',
    'SEO-friendly metadata and semantic markup for discoverability',
    'Analytics-ready structure for tracking conversions and engagement'
  ],
  'result' => 'The optimized experience gives RC Logistics a clear, modern face online: faster loads, clearer messaging, and frictionless quote requests that shorten the path from visit to booking.',
  'client' => 'RC Logistics',
  'date' => 'December 2024',
  'website' => 'https://rclogistics.org.in/',
  'website_text' => 'rclogistics.org.in'
];
?>

<div class="optech-breadcrumb" style="background-image: url(assets/images/breadcrumb/breadcrumb.png)">
    <div class="container">
      <h1 class="post__title"><?php echo $project['breadcrumb']; ?></h1>
      <nav class="breadcrumbs">
        <ul>
          <li><a href='index'>Home</a></li>
          <li><a href='portfolio'>Portfolio</a></li>
          <li aria-current="page"><?php echo $project['title']; ?></li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- End breadcrumb -->

  <div class="section optech-section-padding">
    <div class="container">
      <div class="optech-pd-thumb" data-aos="fade-up" data-aos-duration="800">
        <img src="<?php echo $project['main_image']; ?>" alt="<?php echo $project['title']; ?>">
      </div>
      <div class="optech-pd-wrap">
        <div class="row">
          <div class="col-xl-8 col-lg-7">
            <div class="optech-pd-content-wrap">
              <div class="optech-pd-content-item">
                <h3>Project overview</h3>
                <p><?php echo $project['overview']; ?></p>
                <?php if(!empty($project['overview_detailed'])): ?>
                <p><?php echo $project['overview_detailed']; ?></p>
                <?php endif; ?>
              </div>
              <div class="optech-pd-content-item">
                <h3>The challenge of project</h3>
                <p><?php echo $project['challenge']; ?></p>
                <?php if(!empty($project['challenge_detailed'])): ?>
                <p><?php echo $project['challenge_detailed']; ?></p>
                <?php endif; ?>
              </div>
              <div class="optech-pd-content-item">
                <div class="row">
                  <div class="col-md-6" data-aos="fade-up" data-aos-duration="600">
                    <img src="<?php echo $project['gallery_image1']; ?>" alt="<?php echo $project['title']; ?>">
                  </div>
                  <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
                    <img src="<?php echo $project['gallery_image2']; ?>" alt="<?php echo $project['title']; ?>">
                  </div>
                </div>
              </div>
              
              <?php if(!empty($project['features'])): ?>
              <div class="optech-icon-list">
                <ul>
                  <?php foreach($project['features'] as $feature): ?>
                  <li><i class="ri-check-line"></i><?php echo $feature; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?php endif; ?>
              
              <div class="optech-pd-content-item">
                <h3>Final results</h3>
                <p><?php echo $project['result']; ?></p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5">
            <div class="optech-pd-sidebar-wrap">
              <div class="optech-pd-sidebar">
                <h5>Project Details</h5>
                <div class="optech-pd-sidebar-item">
                  <span>Client:</span>
                  <p><?php echo $project['client']; ?></p>
                </div>
                <div class="optech-pd-sidebar-item">
                  <span>Category:</span>
                  <p><?php echo $project['category']; ?></p>
                </div>
                <div class="optech-pd-sidebar-item">
                  <span>Date:</span>
                  <p><?php echo $project['date']; ?></p>
                </div>
                <div class="optech-pd-sidebar-item">
                  <span>Website:</span>
                  <a href="<?php echo $project['website']; ?>" target="_blank"><?php echo $project['website_text']; ?></a>
                </div>
                <div class="optech-social-icon-box">
                  <ul>
                    <li>
                      <a href="https://www.facebook.com/" target="_blank">
                        <i class="ri-facebook-fill"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.linkedin.com/" target="_blank">
                        <i class="ri-linkedin-fill"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://twitter.com/" target="_blank">
                        <i class="ri-twitter-fill"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.instagram.com/" target="_blank">
                        <i class="ri-instagram-fill"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="optech-service-contact" data-aos="fade-up" data-aos-duration="800" style="background-image: url(assets/images/service/bg.png)">
                <div class="optech-service-contact-icon">
                  <img src="assets/images/service/icon.svg" alt="">
                </div>
                <h3>Don't hesitate to contact us</h3>
                <p>At our IT solution company, we are committed to exceptional</p>
                <a class='optech-default-btn' data-text='Get in Touch' href='contact'><span class="btn-wraper">Get in Touch</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Single featured case study; navigation hidden for now -->
    </div>
  </div>
  <!-- End section -->

  <div class="section bg-cover optech-section-padding" style="background-image: url(assets/images/cta/cta-bg3.png)">
    <div class="container">
      <div class="optech-cta-wrap">
        <div class="optech-cta-content center">
          <h2>Let's work together</h2>
          <p>Each demo built with Teba will look different. You can customize anything appearance of your website with only a few clicks</p>
          <div class="optech-extra-mt" data-aos="fade-up" data-aos-duration="800">
            <a class='optech-default-btn optech-white-btn' data-text='Let's Start a Project' href='contact'> <span class="btn-wraper">Let's Start a Project</span> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End section -->

<?php include 'footer.php'; ?>
