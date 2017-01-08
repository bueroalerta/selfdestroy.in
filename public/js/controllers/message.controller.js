(function(){

  angular.module('selfdestroyin')
    .controller('MessageController', MessageController);

  function MessageController($state, $stateParams, Message, messagePayload, moment){
    var vm = this;

    vm.form = {
      password: ''
    }

    vm.payload = messagePayload.data.payload;

    moment.tz.add("Asia/Kuala_Lumpur|SMT MALT MALST MALT MALT JST MYT|-6T.p -70 -7k -7k -7u -90 -80|01234546|-2Bg6T.p 17anT.p 7hXE dM00 17bO 8Fyu 1so1u|71e5");
    vm.payload.expires_at_moment = moment.tz(vm.payload.expires_at, "Asia/Kuala_Lumpur").valueOf();

    vm.authenticate = function(form){
      if( form.$valid ){
        if( vm.payload.encrypted ){
          Message.auth($stateParams.code, vm.form.password ).then(
            function(data){
              vm.content = data.data.content;
            }
          )
        }
        else {
          Message.fetch($stateParams.code).then(
            function(data){
              vm.content = data.data.content;
            }
          )
        }
      }
    }

    vm.expired = function(){
      alert('This message has expired');
      $state.go('home');
    }
  }

})();