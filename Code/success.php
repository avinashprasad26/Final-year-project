<!DOCTYPE html>
<html>
<head>
<style>
.buttons {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 12px;
}
.container { 
  height: 200px;
  position: relative;
  border: 3px solid green; 
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
</style>
</head>
<body>

<div class="container">
  <div class="center">
    <h2 style="text-align:center;">Your Payment is Successful.</h2>
  </div>
</div>
<p style="text-align:center;">Web page redirects after 5 seconds to your dashboard.</p>
<script>
    setTimeout(function(){
        window.location.href = 'http://artquarium.in/main_wall.php';
    }, 5000);
</script>
</body>
</html>