/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var app = angular.module("myApp", []);
app.controller("tableController", function($scope, $http) {
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  $scope.urlPost = $("#urlPost").val();
  $scope.listName = "New List " + Date.now();
  $scope.template = "Hi {firstName} {lastName}";
  $scope.firstName = "";
  $scope.lastName = "";
  $scope.phone = "";

  $scope.headers = [
    "Phone Number",
    "First Name",
    "Last Name",
    "Param 1",
    "Param 2",
    "Param 3",
    "Param 4",
    "Param 5",
    "Param 6"
  ];

  $scope.rows = [];
  $scope.rowsData = [];

  $scope.addItem = function(e) {
    $scope.status = "";
    if (!$scope.inputform.$valid) {
      return false;
    }
    var target = $(e.target);
    var data = target.serializeArray();
    data.splice(0, 1);
    $scope.rows.push(data);
    e.target.reset();
    return false;
  };

  $scope.uploadItems = function(e) {
    $scope.status = "";
    var fd = new FormData(e.target);
    fd.append("_csrf", csrfToken);
    $http
      .post($(e.target).attr("action"), fd, {
        headers: { "Content-Type": undefined }
      })
      .then(
        function(response) {
          var data = response.data;
          if (response.status === 200) {
            for (var i in data) {
              var _d = data[i];
              var _i = [];
              for (var x in _d) {
                _i.push({ name: "SmsInputForm[" + x + "]", value: _d[x] });
              }
              $scope.rows.push(_i);
            }
            e.target.reset();
          }
        },
        function(response) {
          $scope.status = response.statusText;
        }
      );
  };

  $scope.sendSms = function(e) {
    $scope.status = "Sending message...";
    var data = {
      template: $scope.template,
      name: $scope.listName,
      _csrf: csrfToken,
      rows: $scope.rows
    };
    data = $.param(data);
    $http
      .post($scope.urlPost, data, {
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
      })
      .then(
        function(response) {
          if (response.status === 200) {
            window.location.reload();
          }
        },
        function(response) {
          $scope.status = response.statusText;
        }
      );
  };
});
