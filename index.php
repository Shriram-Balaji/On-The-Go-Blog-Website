<?php
session_start();
require_once('password.php');
require_once('connection.php');
?>
<!--Copyright 2015
Credit:
Shriram Balaji   Nadeem Shaik
St. Joseph's College Of Engineering
-->
<html lang="en">
  <head>
    <meta name="google-site-verification" content="AzfNiWKK_ll-2MH9EjIFizj4GinsgApw58YCoUiUmyY" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content=" width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="UTF-8">
    <title>On The Go Blog </title>
    <!--Import Google Icon Font-->
    <link type="text/css" rel="stylesheet" href="css/login-materialize.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="font/inter-ui/inter-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/loading.css" />
    <link rel="stylesheet" type="text/css" href="css/landing.css" />
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="js/classie.js"></script>
  </head>
  <body>
    <script type="text/javascript">
      //init code for facebook login starts here
      (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));


      window.fbAsyncInit = function () {
        FB.init({
          appId: '799680073475396',
          cookie: true, // enable cookies to allow the server to access
          // the session
          xfbml: true, // parse social plugins on this page
          version: 'v2.0' // use version 2.2
        });


        FB.getLoginStatus(function (response) {
          statusChangeCallback(response);
        });
      };
    </script>
    <script type="text/javascript">
      //login with facebook starts here
      // Now that we've initialized the JavaScript SDK, we call
      // FB.getLoginStatus().  This function gets the state of the
      // person visiting this page and can return one of three states to
      // the callback you provide.  They can be:
      //
      // 1. Logged into your app ('connected')
      // 2. Logged into Facebook, but not your app ('not_authorized')
      // 3. Not logged into Facebook and can't tell if they are logged into
      //    your app or not.
      //
      // These three cases are handled in the callback function.
      // Load the SDK asynchronously
      function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
          testAPI();
        } else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
        } else {
          // The person is not logged into Facebook, so we're not sure if
          // they are logged into this app or not.

        }
      }
      // This function is called when someone finishes with the Login
      // Button.  See the onlogin handler attached to it in the sample
      // code below.
      function checkLoginState() {
        FB.getLoginStatus(function (response) {
          statusChangeCallback(response);
        });
      }
      $(document).ready(function () {
        $('#fblogin').click(function () {
          FB.login(function (response) {
            if (response.authResponse) {
              testAPI(); //Get User Information.
            } else {
              alert('Authorization failed.');
            }
          }, {
            scope: 'public_profile,email,user_birthday'
          });

        });
        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
      });
      function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me?fields=id,name,email,picture,first_name,birthday,last_name', function (response) {
          var fblogin = $.ajax({
            type: "POST",
            data: response,
            dataType: 'json',
            url: 'facebook_login.php',
            cache: false,
          });
          fblogin.done(function (data) {
            window.top.location = "../home.php";
          });
          console.log('Successful login for: ' + response.name);
        });
      }
      //
    </script>
    <div class="bg-img">
    </div>
    <div class="logo">
      <div class="logo-title">
        <img src="../img/logo.png" id="otglogo" />
      </div>
      <br>
    </div>
    <!-- Divisions for loading effects -->
    <div class="la-anim-1"></div>
    <!-- main container -->
    <div class="modal" id="recovery">
      <div class="modal-content"="rcvr_email">
        <p> Please enter your registered email. We'll send the credentials required.</p>
        <form>
          EMAIL :
          <input type="email" name="frgt_mail" id="frgt_mail">
        </form>

      </div>
      <a href="#!" id="send" class="modal-action btn modal-close waves-effect waves">SEND</a>
    </div>
    <script type="text/javascript">
      $('#send').click(function(event) {
        /* Act on the event */
        var email = $("#frgt_mail").val();
        $.ajax({
          url: 'recovery.php',
          data: {
            'email': email,
            'update': 'password'
          },
          type: 'post',

          cache: false,
          success: function (data) {
            Materialize.toast('Your details have been sent. Please check your mail!', 3000);

          }

        });

      });
      $("#signup-tab").click(function (e) {
        $("#signup-submit").click(function (e) {
          console.log('done');
          e.preventDefault();

          var dataString = $("#signup_form").serialize();


          var login = $.ajax({
            url: "hello.php",
            data: dataString,
            type: "POST",
            dataType: 'json',

          });

          login.done(function () {
            console.log('logged in');

            window.location.href = "index.php";


          });

        });


      });
      $('#login_submit').click(function (event) {
        var username = $('#username').val();
        var password = $('#password').val();
        if (username.length <= 0 && password.length <= 0) {
          alert("empty");
        }
        /* Act on the event */
      });
      $('#fblogin').click(function () {
        $(document).ajaxComplete(function () {
          $('.la-anim-1').show();
          setTimeout(function () {
            $('.la-anim-1').hide();
            window.location.href = "home.php";
          }, 1000 * 0.5);

        });
      });
      //frgt passwd
      // $('.modal-trigger').leanModal();
      //preloading top bar
      var inProgress = false;
      Array.prototype.slice.call(document.querySelectorAll('#la-buttons > a')).forEach(function (el, i) {
        var anim = el.getAttribute('data-anim'),
          animEl = document.querySelector('.' + anim);
        el.addEventListener('click', function () {
          if (inProgress) return false;
          inProgress = true;
          classie.add(animEl, 'la-animate');
          setTimeout(function () {
            classie.remove(animEl, 'la-animate');
            inProgress = false;
          }, 6000);
        });
      });
    </script>
    <script type="text/javascript" ></script>
  </body>
</html>