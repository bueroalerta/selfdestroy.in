(function(){

  angular.module('selfdestroyin')
    .factory('timeoutHttpIntercept', timeoutHttpIntercept)
    .factory('httpIntercept', httpIntercept)
    .config(pushInterceptors);

  function timeoutHttpIntercept() {
    return {
      'request': function(config) {
        config.timeout = 10000;
        return config;
      }
    };
  }

  function httpIntercept($q) {
    var handler = {
      response: function(response){
        if( response.config.hasOwnProperty('url') ){
          if( response.config.url.indexOf('selfdestroy.in') >= 0 ){
            if( response.data.status == 0 ){
              alert( response.data.message );
              return $q.reject(response);
            }
          }
        }

        return response;
      },
      responseError: function(response) {
        /*switch(response.status){
          // 400:BAD_REQUEST - Validation error
          case 400: appService.showError( response.data.message ); break;
          // 403:FORBIDDEN - INVALID JWT
          case 403: appService.showError( 'An unexpected error occurred. Please try relogging into your account'); $rootScope.logout(); break;
          // 413:Payload Too Large
          case 413: break;
          // 401 NO JWT PASSED, 404 NOT FOUND
          default:
            if( response.data ){
              appService.showError( response.data.message );
            }
            else {
              appService.showError();
            }
        }*/
        return $q.reject(response);
      }
    };
    return handler;
  }

  function pushInterceptors($httpProvider){
    $httpProvider.interceptors.push('timeoutHttpIntercept');
    $httpProvider.interceptors.push('httpIntercept');
  }

})();