(function(){

  angular.module('selfdestroyin')
    .controller('MainController', MainController);

  function MainController(){
    var vm = this;

    vm.form = {
      title: '',
      content: '',
      expiry: {
        date: '',
        time: ''
      },
      password: '',
      confirm_password: ''
    }

    vm.current = {
      date: new Date(),
      time: new Date()
    }

    this.createMessage = function(){
      console.log('created message');
    }
  }

})();