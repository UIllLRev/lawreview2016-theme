  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="level">
        <div class="level-left">
          <p class="level-item">
            &copy; <?php echo date('Y'); ?> University of Illinois Law Review
          </p>
        </div>
        <div class="level-right">
          <a href="<?php echo site_url( '/members/bookpull/' ) ?>" class="level-item">Member Login</a>
          <a href="<?php echo admin_url() ?>" class="level-item">Admin Login</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- analytics -->
  <script>
  (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
  (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
  l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-22837806-1', 'illinoislawreview.org');
  ga('send', 'pageview');
  </script>

  <?php wp_footer(); ?>

  </body>
</html>
