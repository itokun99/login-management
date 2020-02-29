<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700&amp;display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#000000">
  <meta name="description" content="Web site created using create-react-app">
  <link rel="apple-touch-icon" href="logo192.png">
  <title>MEMMA | TEST</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Quicksand', sans-serif;
      font-weight: 200;
      min-height: 100vh;
      margin: 0;
      font-size: 18px;
      background-color: #f5f5f5;
    }

    .rn-environment {
      display: flex;
      flex: 1;
      flex-direction: column;
      min-height: 100vh;
    }
  </style>
  <style type="text/css" media="all" id="my"></style>
</head>

<body>
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <div class="rn-environment" id="root">
    <div style="position: relative; width: 100%; min-height: 480px; background-color: rgb(56, 173, 169);">
      <div style="padding-right: 24px; padding-left: 24px; height: 100%; width: 100%;">
        <div style="display: flex; justify-content: center; align-items: center; min-height: 480px;">
          <div>
            <div style="margin-right: auto; margin-left: auto; max-width: 480px; width: 100%; text-align: center;"><span
                style="margin: 0px; display: inline-block; font-size: 80px; font-weight: 700; width: 100%; color: rgb(255, 255, 255);">MEMMA</span><span
                style="margin: 0px 0px 24px; display: inline-block; font-size: 24px; font-weight: 700; width: 100%; color: rgb(255, 255, 255);">Continue
                with MEMMA</span>
              <div><span role="button" tabindex="0"
                  style="transition: all 0.3s ease 0s; display: inline-block; position: relative; padding: 14px; border: none; text-align: center; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 700; outline: none; background-color: rgb(26, 148, 144);"><span
                    style="margin: 0px; display: inline-block; color: rgb(255, 255, 255);">Let's Try</span></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div style="padding-right: 24px; padding-left: 24px; height: 100%; width: 100%;">
        <div
          style="margin-right: auto; margin-left: auto; max-width: 767px; width: 100%; text-align: center; padding: 42px;">
          <div style="position: relative; width: 100%; margin-bottom: 24px;"><span id="signIn" role="button" tabindex="0"
              style="transition: all 0.3s ease 0s; display: block; position: relative; padding: 14px; border: none; text-align: center; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 700; outline: none; width: 100%; background-color: rgb(56, 173, 169);"><span
                style="margin: 0px; display: inline-block; color: rgb(255, 255, 255);">Test Sign In</span></span></div>
                <div style="position: relative; width: 100%; margin-bottom: 24px;"><span id="signUp" role="button" tabindex="0"
              style="transition: all 0.3s ease 0s; display: block; position: relative; padding: 14px; border: none; text-align: center; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 700; outline: none; width: 100%; background-color: rgb(56, 173, 169);"><span
                style="margin: 0px; display: inline-block; color: rgb(255, 255, 255);">Test Sign Up</span></span></div>
        </div>
      </div>
    </div>
  </div>
  <script async="" type="text/javascript" src="http://localhost:3000/memma.js"></script>
  <script>
    (function () {
      var onReady = function (callback) {
        if (document.readyState === 'complete') { // Or also compare to 'interactive'
          setTimeout(yourMethod, 1); // Schedule to run immediately
        }
        else {
          readyStateCheckInterval = setInterval(function () {
            if (document.readyState === 'complete') { // Or also compare to 'interactive'
              clearInterval(readyStateCheckInterval);
              callback();
            }
          }, 100);
        }
      }


      onReady(function () {
        var memma = new Memma();
        var config = {
          appKey: "TXQ3ajNkaGFoSVRFSmpNclJPYXI5QmJqWXRZOFFU",
          redirectUrl: "http://localhost:8888/profile",
          authPageUrl: "http://localhost:3000/signin",
        }

        memma.init(config);

        var buttonSignIn = document.getElementById('signIn');
        var buttonSingUp = document.getElementById('signUp');

        buttonSignIn.onclick = function () {
          memma.requestAuth('signin');
        }
        buttonSingUp.onclick = function () {
          memma.requestAuth('signup');
        }
      })
    })();
  </script>
</body>

</html>