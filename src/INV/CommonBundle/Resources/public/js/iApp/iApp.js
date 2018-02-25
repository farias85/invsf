/**
 * Created by Felipe on 09/02/2018.
 */

let iApp = angular.module('INV',
  [
    'ngResource',
    'ngRoute',
    'ngCookies',
    'ngAnimate',
    'chart.js',
    'ngSanitize',
    'ui.multiselect',
    'INV.CONFIG'
  ], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('{|')
    return $interpolateProvider.endSymbol('|}')
  }
).run(
  ["$rootScope", "$cookieStore", "$location", 'CONFIG',
    function ($rootScope, $cookieStore, $location, CONFIG) {
      $rootScope.API_URL = CONFIG.API_URL;
    }
  ]
);
