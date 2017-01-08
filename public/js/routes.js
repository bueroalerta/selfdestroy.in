(function(){

  angular.module('selfdestroyin')
    .config(routerConfig)
    .run(stateChangeError);

  function routerConfig($stateProvider, $urlRouterProvider){
    $stateProvider
      .state('home', {
        url: '/',
        templateUrl: 'js/templates/main.html',
        controller: 'MainController',
        controllerAs: 'main'
      })
      .state('message', {
        url: '/m/:code',
        templateUrl: 'js/templates/message.html',
        controller: 'MessageController',
        controllerAs: 'message',
        resolve: {
          messagePayload: function(Message, $state, $stateParams, $q){
            return Message.view($stateParams.code);
          }
        }
      });

    $urlRouterProvider.otherwise('/');
  }

  function stateChangeError($rootScope, $state) {
    $rootScope.$on('$stateChangeError', function (event, toState, toParam, fromState, fromParam, error) {
      console.log(error);
      // this is required if you want to prevent the $UrlRouter reverting the URL to the previous valid location
      event.preventDefault();
      $state.go('home');
    });
  }

})();