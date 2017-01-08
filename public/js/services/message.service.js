(function() {

  angular.module('selfdestroyin')
    .service('Message', MessageService);

  function MessageService($http, API){
    var service = {
      create: createMessage
    }

    return service;

    function createMessage( payload ) {
      return $http.post(API + 'api/message/create', {
        content: payload.content,
        expiry: payload.expiry.date+' '+payload.expiry.time,
        password: payload.password
      });
    }
  }

})();