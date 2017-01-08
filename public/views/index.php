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
  <link rel="stylesheet" href="bower_resources/pickadate/lib/themes/default.css"/>
  <link rel="stylesheet" href="bower_resources/pickadate/lib/themes/default.date.css"/>
  <link rel="stylesheet" href="bower_resources/pickadate/lib/themes/default.time.css"/>
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
  <script type="text/javascript" src="js/services/message.service.js"></script>
  <script type="text/javascript" src="js/controllers/main.controller.js"></script>
</head>
<body ng-controller="MainController as main">
  <div class="fs">
    <div id="left">
      <form name="create" novalidate ng-submit="main.createMessage(create)">
        <header>
          <h1>selfdestroy.in</h1>
          <h4>your encrypted messages easily!</h4>
        </header>
        <section class="form-group" ng-class="{'has-error': create.content.$error.required && create.$submitted}">
          <span class="instruction">1. Start by typing your message</span>
          <textarea name="content" class="form-control" placeholder="Enter your message's content" rows="5" ng-model="main.form.content" maxlength="5000" required></textarea>
          <p class="help-block">{{ 5000 - main.form.content.length }} characters left</p>
        </section>
        <section class="form-group clearfix" ng-class="{'has-error': create.expiry_date.$error.required && create.expiry_time.$error.required && create.$submitted}">
          <span class="instruction">2. Set your message's expiration date/time</span>
          <div class="clearfix">
            <input type="text" name="expiry_date" class="form-control form-control-half first-half" placeholder="Date" ng-model="main.form.expiry.date" pick-a-date="main.current.date" required/>
            <input type="text" name="expiry_time" class="form-control form-control-half" placeholder="Time" ng-model="main.form.expiry.time" pick-a-time="main.current.time" required/>
          </div>
        </section>
        <section class="form-group" ng-class="{'has-error': create.confirm_password.$invalid && create.$submitted}">
          <span class="instruction">3. Set a password should you want to be extra safe</span>
          <div class="clearfix">
            <input type="password" name="password" class="form-control form-control-half first-half" placeholder="Password" ng-model="main.form.password"/>
            <input type="password" name="confirm_password" class="form-control form-control-half" placeholder="Confirm Password" ng-model="main.form.confirm_password" same-as="main.form.password"/>
          </div>
          <p class="help-block" ng-if="create.confirm_password.$invalid && create.$submitted">Please check that your password is entered correctly</p>
        </section>
        <section>
          <button type="submit" class="btn btn-primary btn-lg" ng-disabled="!create.$valid">
            <span class="glyphicon glyphicon-lock"></span> Encrypt Message
          </button>
        </section>
        <section ng-if="main.encrypted_link">
          <span class="instruction text-center">Here's your encrypted message link</span>
          <a target="_blank" ng-href="{{ main.encrypted_link }}" class="btn btn-primary btn-block">{{ main.encrypted_link }}</a>
        </section>
      </form>
    </div>
    <div id="right">
      <div class="wrapper">
        <h2 class="centered">I'm still thinking what to put here</h2>
      </div>
    </div>
  </div>
</body>
</html>