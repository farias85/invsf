/**
 * Created by Felipe on 12/02/2018.
 */

iApp.controller('AftFilterController',
  function ($scope) {

    $scope.original = TwigParams.activos

    $scope.getUrlShow = (activo) => {
      return Routing.generate('activo_fijo_show', {'id': activo.id})
    }

    $scope.getUrlEdit = (activo) => {
      return Routing.generate('activo_fijo_edit', {'id': activo.id})
    }

    $scope.getUrlControl = (activo) => {
      return Routing.generate('apunte_new_control', {'getUrlShow(activoFijo)': activo.id})
    }

    $scope.getRowColor = (index) => {
      return parseInt(index, 10) % 2 === 0 ? 'aliceblue' : 'inherit'
    }

    $scope.activos = $scope.original
    $scope.responsables = TwigParams.responsables
    $scope.sresponsables = []
    $scope.estados = TwigParams.estados
    $scope.sestados = []
    $scope.locales = TwigParams.locales
    $scope.slocales = []
    $scope.tipos = TwigParams.tipos
    $scope.stipos = []
    $scope.rotulo = ''
    $scope.descripcion = ''

    $scope.mySelect = function () {
      $scope.activos = $scope.original

      if ($scope.rotulo !== '') {
        $scope.activos = $scope.activos.filter(activo => activo.rotulo.toLowerCase().indexOf($scope.rotulo.toLowerCase()) !== -1)
      }

      if ($scope.descripcion !== '') {
        $scope.activos = $scope.activos.filter(activo => activo.descripcion.toLowerCase().indexOf($scope.descripcion.toLowerCase()) !== -1)
      }

      if ($scope.stipos.length > 0) {
        $scope.activos = $scope.activos.filter(activo => {
          for (let i = 0; i < $scope.stipos.length; i++) {
            if (activo.tipoActivo.toLowerCase() === $scope.stipos[i].nombre.toLowerCase()) {
              return true
            }
          }
          return false
        })
      }

      if ($scope.slocales.length > 0) {
        $scope.activos = $scope.activos.filter(activo => {
          for (let i = 0; i < $scope.slocales.length; i++) {
            if (activo.local.toLowerCase() === $scope.slocales[i].nombre.toLowerCase()) {
              return true
            }
          }
          return false
        })
      }

      if ($scope.sestados.length > 0) {
        $scope.activos = $scope.activos.filter(activo => {
          for (let i = 0; i < $scope.sestados.length; i++) {
            if (activo.estado.toLowerCase() === $scope.sestados[i].nombre.toLowerCase()) {
              return true
            }
          }
          return false
        })
      }

      if ($scope.sresponsables.length > 0) {
        $scope.activos = $scope.activos.filter(activo => {
          for (let i = 0; i < $scope.sresponsables.length; i++) {
            if (activo.responsable.toLowerCase() === $scope.sresponsables[i].nombre.toLowerCase()) {
              return true
            }
          }
          return false
        })
      }

    }
  }
)