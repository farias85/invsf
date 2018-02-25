/**
 * Created by Felipe on 12/02/2018.
 */

iApp.controller('MainCtrl',
  function ($scope) {
    $scope.name = 'World'

    $scope.cars = [{id: 1, name: 'Audi'}, {id: 2, name: 'BMW'}, {id: 1, name: 'Honda'}]
    $scope.selectedCar = []

    $scope.fruits = [{id: 1, name: 'Apple'}, {id: 2, name: 'Orange'}, {id: 3, name: 'Banana'}]
    $scope.selectedFruit = null
  }
)