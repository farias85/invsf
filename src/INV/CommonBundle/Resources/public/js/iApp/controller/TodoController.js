/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

iApp.controller('TodoController',
  function ($scope) {

    $scope.message = 'Hello world ANGULaaaAR!!!'

    $scope.addTodo = function () {
      alert('addTodo')
    }

    $scope.removeTodo = function () {
      alert('removeTodo');
    }
  }
)
