<!DOCTYPE html>
<html>

<head>
  <title>Sign UP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Quicksand', sans-serif;
      font-size: 18px;
      background-color: #f5f5f5;

    }

    .o-formAuth__section {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0;
      min-height: 100vh;
      overflow-y: auto;
      padding-top: 32px;
      padding-bottom: 32px;
    }

    .o-formAuth__wrapper {
      max-width: 375px;
      width: 100%;
      margin: auto;
      position: relative;
      overflow: hidden;
      border-radius: 8px;
      box-shadow: 0 2px 15px 0.5px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }

    .o-formAuth__imageOverlay {
      background: url(https://3.bp.blogspot.com/-_vrpkw4upVI/XdnpIPurAcI/AAAAAAAAEl8/MLfOcDSJ8c0EE-DCEPVqpP4l8jhPMWdhwCLcBGAsYHQ/s1600/memmasahpe%2B1%2B1.png) no-repeat;
      background-size: 105%;
      background-position: center 40%;
      position: absolute;
      width: 100%;
      height: 200px;
    }

    .o-formAuth__header {
      position: relative;
      color: #fff;
      height: 200px;
      padding: 42px 42px 0 42px;
      margin: 0;
      z-index: 1;
    }

    .o-formAuth__title {
      font-size: 42px;
      font-weight: 700;
    }

    .o-formAuth__description {
      font-weight: 700;
    }

    .o-formAuth__form {
      overflow: hidden;
      position: relative;
    }

    .o-formAuth__formGroup {
      margin-bottom: 24px;
      position: relative;
      text-align: center;
    }

    .o-formAuth__body {
      padding: 42px;
      position: relative;
      font-family: 'Quicksand', sans-serif;
    }

    .o-formAuth__formGroup input {
      border: 2px solid #DDDDDD;
      border-radius: 8px;
      padding: 14px;
      font-size: 16px;
      text-align: center;
      outline: none;
      width: 100%;
      font-family: 'Quicksand', sans-serif;
      font-size: 18px;
      font-weight: 700;
    }

    .o-formAuth__formGroup input::placeholder {
      opacity: 0.5;
      font-weight: 700;
      font-family: 'Quicksand', sans-serif;
      font-size: 16px;
    }

    .o-formAuth__input-icon {
      position: absolute;
      display: flex;
      justify-content: flex-start;
      text-align: left;
      align-items: center;
      height: 32px;
      width: calc(32px + 14px);
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      background-color: #ffffff;
    }

    /*BTN*/
    .btn {
      padding: 14px;
      border: none;
      text-align: center;
      width: 100%;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.35s;
      font-size: 16px;
      font-family: 'Quicksand', sans-serif;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      outline: none;
    }

    .btn-primary {
      background: #38ada9;
      color: #fff;
    }

    .btn:hover {
      filter: brightness(0.8);
      transition: all 0.35s;
    }

    .btn-light {
      background: white;
      border: 2px solid #DDDDDD;
    }

    .o-formAuth__seperatorLine {
      text-align: center;
      position: relative;
    }

    .o-formAuth__footer {
      padding: 42px;
    }

    .o-formAuth__seperatorLine:before {
      content: '';
      position: absolute;
      height: 2px;
      width: calc(100% - 50px - 50px);
      text-align: center;
      right: 50%;
      bottom: 8px;
      z-index: 0;
      background: rgba(0, 0, 0, 0.2);
      transform: translateX(50%);
    }

    .o-formAuth__seperatorLine span {
      z-index: 1;
      font-size: 16px;
      background: #fff;
      position: relative;
      padding: 4px 16px;
      font-weight: 500;
      color: rgba(0, 0, 0, 0.5);
    }

    span.o-formAuth__google-icon {
      position: absolute;
      height: 32px;
      width: 32px;
      justify-content: center;
      align-items: center;
      display: flex;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      z-index: 1;
    }
  </style>
</head>

<body>
  <div class="o-formAuth__section">
    <div class="o-formAuth__wrapper">
      <div class="o-formAuth__imageOverlay"></div>
      <div class="o-formAuth__header">
        <h2 class="o-formAuth__title">MEMMA</h2>
        <span class="o-formAuth__description">Register with MEMMA</span>
      </div>
      <div class="o-formAuth__body">
        <div class="o-formAuth__form">
          <div class="o-formAuth__formGroup">
            <input id="userName" type="text" name="email" placeholder="Fullname" />
          </div>
          <div class="o-formAuth__formGroup">
            <input id="userEmail" type="email" name="email" placeholder="Email" />
          </div>
          <div class="o-formAuth__formGroup">
            <input id="userPassword" type="password" name="password" placeholder="Password" />
          </div>
          <div class="o-formAuth__formGroup">
            <input id="retypePassword" type="password" name="password" placeholder="Re-type password" />
          </div>
          <div class="o-formAuth__formGroup">
            <button id="submitButton" class="btn btn-primary">Sign Up</button>
            <div style="margin-bottom: 8px;"></div>
            <button id="secondBtn" class="btn btn-default btn-light" style="color:rgba(0,0,0,0.5)">Have an
              Account?</button>
          </div>
        </div>
      </div>
      <div class="o-formAuth__seperatorLine">
        <span>OR</span>
      </div>
      <div class="o-formAuth__footer">

        <div class="o-formAuth__formGroup" style="margin: 0">
          <span class="o-formAuth__google-icon"><svg width="28" height="25" viewBox="0 0 32 32" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M29.1598 13.8653C29.1148 13.5874 28.8712 13.3887 28.5897 13.3887H28.0277C28.0124 13.3887 28 13.3763 28 13.361V13.361C28 13.3457 27.9876 13.3333 27.9723 13.3333H18.6667C17.1939 13.3333 16 14.5272 16 16V16C16 17.4728 17.1939 18.6667 18.6667 18.6667H19.1203C21.2745 18.6667 22.6914 20.8704 21.017 22.2257C19.6463 23.3351 17.9019 24 16 24C11.582 24 8.00001 20.418 8.00001 16C8.00001 11.582 11.582 8.00001 16 8.00001C17.1297 8.00001 18.203 8.2361 19.1758 8.66035C20.4841 9.2309 22.0956 9.23778 23.1048 8.22854V8.22854C24.1835 7.14982 24.1612 5.36361 22.8553 4.57494C20.8533 3.3658 18.5101 2.66667 16 2.66667C8.63667 2.66667 2.66667 8.63667 2.66667 16C2.66667 23.3633 8.63667 29.3333 16 29.3333C23.3633 29.3333 29.3333 23.3633 29.3333 16C29.3333 15.2731 29.2725 14.5604 29.1598 13.8653Z"
                fill="#FFC107" />
              <path
                d="M5.3736 7.95635C4.61707 8.95514 4.95202 10.3426 5.96239 11.0836V11.0836C7.2923 12.0589 9.2028 11.479 10.3736 10.3176C11.8176 8.88506 13.8044 8 16 8C17.1297 8 18.203 8.2361 19.1758 8.66035C20.4841 9.23089 22.0956 9.23778 23.1048 8.22854V8.22854C24.1835 7.14982 24.1612 5.36361 22.8553 4.57494C20.8532 3.3658 18.5101 2.66667 16 2.66667C11.6592 2.66667 7.80693 4.74383 5.3736 7.95635Z"
                fill="#FF3D00" />
              <path
                d="M16 29.3333C18.3055 29.3333 20.47 28.7427 22.3589 27.7092C23.8338 26.9023 23.799 24.9071 22.5156 23.8211V23.8211C21.5207 22.9791 20.0873 22.9946 18.8717 23.4649C17.9617 23.8171 16.9885 24.0008 16 24C13.7537 24 11.727 23.0723 10.2763 21.58C9.09873 20.3686 7.10819 19.7581 5.76989 20.7892V20.7892C4.81933 21.5216 4.50664 22.8444 5.21077 23.8161C7.63176 27.1569 11.5585 29.3333 16 29.3333Z"
                fill="#4CAF50" />
              <path
                d="M29.1598 13.8653C29.1148 13.5874 28.8712 13.3887 28.5897 13.3887H28.0277C28.0124 13.3887 28 13.3763 28 13.361V13.361C28 13.3457 27.9876 13.3333 27.9723 13.3333H18.6667C17.1939 13.3333 16 14.5272 16 16V16C16 17.4728 17.1939 18.6667 18.6667 18.6667H19.1172C21.2714 18.6667 22.6879 20.8726 21.0107 22.2246C20.9449 22.2776 20.8782 22.3296 20.8107 22.3807V22.3807C20.8119 22.3799 20.8134 22.38 20.8145 22.3809L22.453 23.7674C23.7703 24.8821 26.1044 24.9068 27.0675 23.475C28.1897 21.8068 29.3333 19.2935 29.3333 16C29.3333 15.2731 29.2725 14.5604 29.1598 13.8653Z"
                fill="#1976D2" />
            </svg>
          </span>
          <button class="btn btn-default btn-light" style="color:rgba(0,0,0,0.5)">Signup With Google</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="https://apis.google.com/js/api.js"></script>
  <script>
    (function () {
      // GOOGLE CONFIGURATION //
      var GoogleApp = {
        start: function () {
          var config = {
            'apiKey': 'YOUR_API_KEY',
            // Your API key will be automatically added to the Discovery Document URLs.
            'discoveryDocs': ['https://people.googleapis.com/$discovery/rest'],
            // clientId and scope are optional if auth is not required.
            'clientId': 'YOUR_WEB_CLIENT_ID.apps.googleusercontent.com',
            'scope': 'profile',
          }
          window.gapi.client.init({

          })
        }
      }

      function elementId(name) {
        return document.getElementById(name);
      }
      function parseJSON(json) {
        try {
          return JSON.parse(json);
        } catch (err) {
          return null;
        }
      }

      // get url params;
      var appKey = "{{ Request::get('appKey') }}";
      var credential = "{{ Request::get('credential') }}";
      var redirectUrl = "{{ Request::get('redirectUrl') }}";
      var type = "{{ Request::get('type') }}";


      let Memma = {
        submitBtn: elementId('submitButton'),
        secondBtn: elementId('secondBtn'),
        onSubmit: function (event) {

          var name = elementId('userName').value;
          var email = elementId('userEmail').value;
          var password = elementId('userPassword').value;

          if (!email || !password) return alert('please fill form correctly!');

          var body = {
            name,
            email,
            password
          }

          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            var readyState = this.readyState
            var status = this.status;
            if (readyState === 4 && status === 200) {
              var response = parseJSON(this.response);
              window.alert(response.message);
              var redirectTo = response.data.redirectUrl;
              window.location.href = redirectTo;
            }

            if (readyState === 4 && status !== 200) {
              var response = parseJSON(this.response);
              window.alert(response.message);
            }

          }
          xhr.open('post', '/api/memma/v1/user/signup', true);
          xhr.setRequestHeader('Content-type', 'application/json');
          xhr.setRequestHeader('appKey', appKey);
          xhr.setRequestHeader('credential', credential);
          xhr.setRequestHeader('redirectUrl', redirectUrl);
          xhr.setRequestHeader('type', type);
          xhr.send(JSON.stringify(body));
        },
        handleSubmitButton: function () {
          this.submitBtn.onclick = this.onSubmit
        },
        handleSecondButton: function () {
          this.secondBtn.onclick = function () {
            var url = `${window.location.origin}/signin?appKey=${appKey}&credential=${credential}&redirectUrl=${redirectUrl}&type=${type}`;
            window.location.href = url;
          }
        },
        init: function () {
          this.handleSubmitButton();
          this.handleSecondButton();
        }
      }

      window.addEventListener('load', Memma.init())
    })();
  </script>
</body>

</html>