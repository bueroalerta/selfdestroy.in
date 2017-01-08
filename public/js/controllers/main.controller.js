(function(){

  angular.module('selfdestroyin')
    .controller('MainController', MainController);

  function MainController(Message){
    var vm = this;

    vm.initializeForm = function(){
      vm.form = {
        //title: '',
        content: '',
        expiry: {
          date: '',
          time: ''
        },
        password: '',
        confirm_password: ''
      }
    }

    vm.initializeForm();

    vm.current = {
      date: '',
      time: ''
    }

    this.createMessage = function(form){
      if( form.$valid ) {
        Message.create(vm.form).then(
          function (data) {
            var result = angular.fromJson(data);
            if (result.data) {
              vm.encrypted_link = result.data.code;

              form.$submitted = false;
              form.$setPristine();

              vm.initializeForm();
            }
          }
        );
      }
    }
  }

})();