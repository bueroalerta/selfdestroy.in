(function() {

  angular.module('selfdestroyin')
    .service('Message', MessageService);

  function MessageService(){
    var service = {
      create: createMessage
    }

    return service;

    function createMessage() {

    }
  }

})();