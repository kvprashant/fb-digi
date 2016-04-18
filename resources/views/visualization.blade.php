<!DOCTYPE html>
<html>
<head>
  <title>KPN Facebook page country-wise fans</title>

  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
  <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
</head>
<body>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1531057830531826',
        xfbml      : true,
        version    : 'v2.6'
      });
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
  
  <div id="container">
    <div class="content">
      <div class="title">KPN Facebook page country-wise fans</div>
      <p>This page visualizes the fans of <a href="https://www.facebook.com/KPN" target="_blank">KPN's Facebook page</a> across the world</p>
    </div>
  </div>
  {{ Html::script('js/d3.min.js') }}
  {{ Html::script('js/datamaps.world.min.js') }}
  {{ Html::script('js/app.min.js') }}
</body>
</html>
