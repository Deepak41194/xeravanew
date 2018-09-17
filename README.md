# Read Me

Site uses PHP.  Set up a local server in the root to run.

Make sure .htaccess file is in the folder.  (Rename the supplied _htaccess file to .htaccess.)

index.php uses the URL to determine which page to load.  For example, domain.com/about will load pages/about/index.php.  domain.com/about/our-company will load pages/about/our-company.php.  Additional parameters can be found in the routes array.  For example domain.com/about/our-company/profile/ceo.  $routes[1] = "about".  $routes[2] = "our-company".  $routes[3] = "profile".  $routes[4] = "ceo".