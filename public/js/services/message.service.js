(function() {

  angular.module('selfdestroyin')
    .service('Message', MessageService);

  function MessageService($http, API){
    var service = {
      create: createMessage,
      view: viewMessage,
      fetch: fetchMessage,
      auth: authMessage
    }

    return service;

    function createMessage( payload ) {
      return $http.post(API + 'api/message/create', {
        content: payload.content,
        expiry: payload.expiry.date+' '+payload.expiry.time,
        password: payload.password,
        confirm_password: payload.confirm_password
      });
    }

    function viewMessage( code ){
      return $http.get(API + 'api/message/view/' +code);
    }

    function fetchMessage( code ){
      return $http.get(API + 'api/message/fetch/' +code);
    }

    function authMessage( code, password ){
      return $http.post(API + 'api/message/authenticate/' +code, {
        password: password
      });
    }
  }

})();