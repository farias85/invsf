/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

iApp.service('ApiService',
  function ($rootScope, $http, $resource, $q) {
    /**
     * HTTP GET CALL
     * @param url
     * @returns {jQuery.promise|*|promise|Promise|f}
     */
    this.get = function (url) {
      let defered = $q.defer()
      let promise = defered.promise
      $http.get(`${$rootScope.urlBase}${url}`)
        .then((response) => defered.resolve(response))
        .catch((err) => defered.reject(err))
      return promise
    }

    /**
     * HTTP POST CALL
     * @param url
     * @param body
     * @returns {jQuery.promise|*|promise|Promise|f}
     */
    this.post = function (url, body) {
      let defered = $q.defer()
      let promise = defered.promise
      $http.post(`${$rootScope.urlBase}${url}`, body)
        .then((response) => defered.resolve(response))
        .catch((err) => defered.reject(err))
      return promise
    }

    /**
     * HTTP PUT CALL
     * @param url
     * @param body
     * @returns {jQuery.promise|*|promise|Promise|f}
     */
    this.put = function (url, body) {
      let defered = $q.defer()
      let promise = defered.promise
      $http.put(`${$rootScope.urlBase}${url}`, body)
        .then((response) => defered.resolve(response))
        .catch((err) => defered.reject(err))
      return promise
    }

    /**
     * HTTP DELETE CALL
     * @param url
     * @param body
     * @returns {jQuery.promise|*|promise|Promise|f}
     */
    this.delete = function (url, body) {
      let defered = $q.defer()
      let promise = defered.promise
      $http.delete(`${$rootScope.urlBase}${url}`, body)
        .then((response) => defered.resolve(response))
        .catch((err) => defered.reject(err))
      return promise
    }

  }
)
  .service('ProfesorResource',
    function ($rootScope, $resource) {
      return $resource(`${$rootScope.API_URL}/profesor/:id`, {id: '@id'}, {update: {method: 'PUT'}})
    }
  )
  .service('CargoProyectoResource',
    function ($rootScope, $resource) {
      return $resource(`${$rootScope.API_URL}/cargo-proyecto/:id`, {id: '@id'}, {update: {method: 'PUT'}})
    }
  )

