<!doctype html>
<html lang="en" ng-app="selfdestroyin">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SelfDestroy.in Messages</title>

  <!-- CSS -->
  <link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="bower_resources/pickadate/lib/themes/classic.css"/>
  <link rel="stylesheet" href="bower_resources/pickadate/lib/themes/classic.date.css"/>
  <link rel="stylesheet" href="bower_resources/pickadate/lib/themes/classic.time.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <!-- Scripts -->
  <script type="text/javascript" src="bower_resources/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="bower_resources/angular/angular.min.js"></script>
  <script type="text/javascript" src="bower_resources/angular-bootstrap/ui-bootstrap.min.js"></script>
  <script type="text/javascript" src="bower_resources/angular-animate/angular-animate.min.js"></script>
  <script type="text/javascript" src="bower_resources/angular-touch/angular-touch.min.js"></script>
  <script type="text/javascript" src="bower_resources/pickadate/lib/picker.js"></script>
  <script type="text/javascript" src="bower_resources/pickadate/lib/picker.date.js"></script>
  <script type="text/javascript" src="bower_resources/pickadate/lib/picker.time.js"></script>
  <script type="text/javascript" src="bower_resources/ng-pickadate/ng-pickadate.js"></script>
  <!-- Angular Implementation -->
  <script type="text/javascript" src="js/app.js"></script>
  <script type="text/javascript" src="js/controllers/main.controller.js"></script>
  <script type="text/javascript" src="js/services/message.service.js"></script>
</head>
<body ng-controller="MainController as main">
  <div class="fs">
    <div id="left">
      <form name="create" novalidate ng-submit="main.createMessage(create)">
        <header>
          <h1>selfdestroy.in</h1>
          <h4>Sending encrypted messages made easy!</h4>
        </header>
        <section>
          <span class="instruction">1. Start by typing your message</span>
          <textarea name="content" class="form-control" placeholder="Enter your message's content" rows="5" ng-model="main.form.content" maxlength="5000"></textarea>
          <p class="help-block">{{ 5000 - main.form.content.length }} characters left</p>
        </section>
        <section>
          <span class="instruction">2. Set your message's expiration date/time</span>
          <input type="text" name="expiry_date" class="form-control" placeholder="Date" ng-model="main.form.expiry.date" pick-a-date="main.current.date"/>
          <input type="text" name="expiry_time" class="form-control" placeholder="Time" ng-model="main.form.expiry.time" pick-a-time="main.current.time"/>
          {{ main.current.time }}
        </section>
      </form>
    </div>
    <div id="right">

    </div>
  </div>
</body>
</html>