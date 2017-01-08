(function() {
  'use strict';

  angular.module('selfdestroyin', [
    'ui.bootstrap',
    'pickadate',
    'ui.router'
  ])

    .constant('API', 'http://selfdestroy.in/')

    .directive('sameAs', function () {
      return {
        require: 'ngModel',
        link: function (scope, element, attrs, ctrl) {
          var modelToMatch = attrs.sameAs;

          scope.$watch(attrs.sameAs, function () {
            ctrl.$validate();
          })

          ctrl.$validators.match = function (modelValue, viewValue) {
            return viewValue === scope.$eval(modelToMatch);
          };
        }
      };
    })

    .config(['pickADateProvider', 'pickATimeProvider', function (pickADateProvider, pickATimeProvider) {
      pickADateProvider.setOptions({
        format: 'yyyy-mm-dd',
        selectYears: true
      });

      pickATimeProvider.setOptions({
        format: 'HH:i'
      });
    }]);

})();