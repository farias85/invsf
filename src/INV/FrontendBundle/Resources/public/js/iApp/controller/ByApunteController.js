/**
 * Created by Felipe on 25/02/2018.
 */

iApp.controller('ByApunteController',
  function ($scope) {

    $scope.activos = TwigParams.activos;
    $scope.original = TwigParams.activos;
    $scope.selected = [];
    $scope.sValue = '';

    $scope.activos = $scope.activos.map(activo => {
        activo.badge = activo.cantidad > 0 ? `badge-info ${activo.id}` : `badge-danger ${activo.id}`;
        activo.selected = '';
        return activo;
      }
    );

    $scope.getUrlControl = (activo) => {
      return Routing.generate('apunte_new_control', {'idActivo': activo.id});
    };

    $scope.rowSelect = (activo) => {
      $scope.activos = $scope.activos.map(act => {
        if (act.id === activo.id) {
          act.selected = activo.selected === '' ? 'selected' : '';
        }
        return act;
      });

      $scope.selected = $scope.activos.filter(act => act.selected === 'selected');
      $scope.sValue = JSON.stringify($scope.selected);
    };

  }
);