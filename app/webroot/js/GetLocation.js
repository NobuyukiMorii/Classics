//現在地の取得を開始する
function startFunc(){
if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
   } else {
     document.getElementById("geo").innerHTML =  "Geolocationが利用できません";
   }
}

//
function successCallback(position) {
  //成功したときの処理
  var location = [];
  location['latitude'] = position.coords.latitude;
  location['longitude'] = position.coords.longitude;
  $('#latitude').val(location['latitude']);
  $('#longitude').val(location['longitude']);
}
function errorCallback(error) {
   //失敗のときの処理
  $('#latitude').val(null);
  $('#longitude').val(null);
}