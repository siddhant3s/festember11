<?php
session_destroy();
if (isset($_SERVER['HTTP_COOKIE'])) {
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach($cookies as $cookie) {
    $parts = explode('=', $cookie);
    $name = trim($parts[0]);
    setcookie($name, '', time()-1000);
    setcookie($name, '', time()-1000, '/');
  }
}

$redirectto = isset($_GET['redirectto'])?$_GET['redirectto']:"./";
?>
<script type="text/javascript">
window.location.href = "<?php echo $redirectto; ?>";
</script>