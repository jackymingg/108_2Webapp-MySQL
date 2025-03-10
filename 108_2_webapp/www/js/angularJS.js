angular.module("App", []).controller("LoginConController", [
  "$scope",
  function($scope) {
    $scope.done = "";
  },
]);

function onLoad() {
  alert("相關圖片及影片為原作者所擁有之版權");
  document.addEventListener("deviceready", onDeviceReady, false); //確認是否有連結上網頁
  if (localStorage.userName != null) {
    document.getElementById("user").value = localStorage.userName;
  } //當帳號欄位不是空值時獲取登入帳號的Id並暫存其值
  if (localStorage.userPassword != null) {
    document.getElementById("passwd").value = localStorage.userPassword;
  } //當密碼欄位不是空值時獲取登入密碼的Id並暫存其值
}

function onDeviceReady() {
  alert("onDeviceReady");
  getPosition();
} //若連結上網頁則alert此行

function getPosition() {
  var options = {
    enableHighAccuracy: true,
    maximumAge: 3600000,
  };
  var watchID = navigator.geolocation.getCurrentPosition(
    onSuccess,
    onError,
    options
  );

  function onSuccess(position) {
    alert(
      "Latitude: " +
        position.coords.latitude +
        "\n" +
        "Longitude: " +
        position.coords.longitude +
        "\n" +
        "Altitude: " +
        position.coords.altitude +
        "\n" +
        "Accuracy: " +
        position.coords.accuracy +
        "\n" +
        "Altitude Accuracy: " +
        position.coords.altitudeAccuracy +
        "\n" +
        "Heading: " +
        position.coords.heading +
        "\n" +
        "Speed: " +
        position.coords.speed +
        "\n" +
        "Timestamp: " +
        position.timestamp +
        "\n"
    );
    localStorage.lon = position.coords.longitude;
    localStorage.lat = position.coords.latitude;
  }

  function onError(error) {
    alert("code: " + error.code + "\n" + "message: " + error.message + "\n");
  }
}

function login() {
  var id = document.getElementById("user").value; //取得帳號的值
  var passwd = document.getElementById("passwd").value; //取得密碼的值
  $.ajax({
    // 向資料庫傳送並取得資料
    datatype: "JSON",
    type: "POST",
    url: "http://210.70.80.21/~s107021034/1082_server/1082_Login.php",
    data:
      "userName=" +
      id +
      "&userPassword=" +
      passwd +
      "&lon=" +
      localStorage.lon +
      "&lat=" +
      localStorage.lat,
    crossDomain: true,
    cache: false,
    success: function(data) {
      var obj = JSON.parse(data);
      if (obj.status == "success") {
        //當連結成功時會將資料暫存
        localStorage.userName = id;
        localStorage.userPassword = passwd;
        localStorage.loginType = 0;
        document.location.href = "MainPage.html"; //跳頁
      } else if (obj.status == "noAccount") {
        //失敗時顯示錯誤
        alert("Wrong ID or Password!!");
      } else if (obj.status == "fail") {
        alert("Can't connect to DB!!");
      }
    },
    error: function(data) {
      alert("Error: " + data);
    },
  });
}

function adduser() {
  var Name = document.getElementById("Name").value; //取得使用者名字的值
  var email = document.getElementById("userEmail").value; //取得帳號的值
  var userPassword = document.getElementById("userPassword").value; //取得密碼的值
  $.ajax({
    // 向資料庫傳送並儲存資料
    datatype: "JSON",
    type: "POST",
    url: "http://210.70.80.21/~s107021034/1082_server/1082_Register.php",
    data:
      "userName=" +
      Name +
      "&userPassword=" +
      userPassword +
      "&userEmail=" +
      email,
    crossDomain: true,
    cache: false,
    success: function(data) {
      var obj = JSON.parse(data);
      if (obj.status == "success") {
        //當連結成功時會將資料暫存
        alert("success addID");
        localStorage.userEmail = email;
        localStorage.adduserType = 0;
        document.location.href = "index.html"; //跳頁
      } else if (obj.status == "existed") {
        //失敗時顯示錯誤
        alert("註冊錯誤=>帳號重複");
      } else if (obj.status == "fail") {
        alert("連線錯誤");
      }
    },
    error: function(data) {
      alert("Error: " + data);
    },
  });
}
function del() {
  var id = localStorage.userName;
  var type = document.getElementById("noteType").value;
  var title = document.getElementById("title").value;
  var description = document.getElementById("description").value;
  $.ajax({
    datatype: "JSON",
    type: "POST",
    url: "http://210.70.80.21/~s107021034/1082_server/AddNotes_1.php",
    data:
      "userEmail=" +
      id +
      "&noteType=" +
      type +
      "&title=" +
      title +
      "&description=" +
      description,
    crossDomain: true,
    cache: false,
    success: function(data) {
      var obj = JSON.parse(data);
      if (obj.status == "success") {
        alert("刪除一筆note");
        document.location.href = "notePage.html";
      } else if (obj.status == "noAccount") {
        alert("寫入資料庫錯誤");
      } else if (obj.status == "fail") {
        alert("Can't connect to DB!!");
      }
    },
    error: function(data) {
      alert("Error: " + data);
    },
  });
}
function noteOnLoad() {
  var id = localStorage.userName;
  $.ajax({
    datatype: "JSON",
    type: "POST",
    url: "http://210.70.80.21/~s107021034/1082_server/Getnotes_1.php",
    data: "userEmail=" + id,
    crossDomain: true,
    cache: false,
    success: function(data) {
      var obj = JSON.parse(data);
      alert(obj.length);
      $("#div3").html("");
      var div3Content = "";
      for (var i = 0; i < obj.length; i++) {
        div3Content +=
          "<p>" +
          "Type :" +
          obj[i].type +
          "， " +
          "Title :" +
          obj[i].title +
          "<br>" +
          "Description :" +
          obj[i].description +
          "。" +
          "<br>";
        ("</p>");
      }
      $("#div3").append(div3Content);
    },
    error: function(data) {
      alert("Error: " + data);
    },
  });
}

function sendNote2DB() {
  var id = localStorage.userName;
  var type = document.getElementById("noteType").value;
  var title = document.getElementById("title").value;
  var description = document.getElementById("description").value;
  $.ajax({
    datatype: "JSON",
    type: "POST",
    url: "http://210.70.80.21/~s107021034/1082_server/AddNotes_1.php",
    data:
      "userEmail=" +
      id +
      "&noteType=" +
      type +
      "&title=" +
      title +
      "&description=" +
      description,
    crossDomain: true,
    cache: false,
    success: function(data) {
      var obj = JSON.parse(data);
      if (obj.status == "success") {
        alert("寫入一筆note");
        document.location.href = "notePage.html";
      } else if (obj.status == "noAccount") {
        alert("寫入資料庫錯誤");
      } else if (obj.status == "fail") {
        alert("Can't connect to DB!!");
      }
    },
    error: function(data) {
      alert("Error: " + data);
    },
  });
}
