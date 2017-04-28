  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="level">
        <div class="level-left">
          <p class="level-item">
            &copy; <?php echo date('Y'); ?> University of Illinois Law Review.
          </p>
        </div>
        <div class="level-right">
          <a href="/members/bookpull" class="level-item">Member Login</a>
          <a href="/wp-admin" class="level-item">Admin Login</a>
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

  <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>

  <!-- Mailchimp -->
  <script>
    document.getElementById("open-popup").addEventListener("click", function (event) {
        require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us11.list-manage.com","uuid":"f03cd499dcf95cd5380c4d7cf","lid":"5385570c73"}) })
    });
  </script>

  <?php wp_footer(); ?>

  </body>
</html>
