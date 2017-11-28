"use strict";
var pushNotification = angular.module("apptha.pushnotification", []);
pushNotification.directive("notification", notificationDirective);
pushNotification.factory("requestFactory", requestFactory);
pushNotification.directive("baseValidator", validatorDirective);
pushNotification.factory("requestFactory", requestFactory);

pushNotification.controller("PushNotificationController", ["$window", "$scope", "requestFactory", "$rootScope", function($window, scope, requestFactory, $rootScope) {
    requestFactory.setThisArgument(this);
    this.pushNotification = {};
    scope.errors = {};

    /**
     * Method to get the rules for the add form
     */
    this.fetchRules = function() {
        requestFactory.get(requestFactory.getUrl("pushnotification/create"), function(response) {
        	baseValidator.setRules(response.rules);
        }, function() {});
    };
    /**
     * Method to save the add form data
     */
    this.save = function(event) {
        if (baseValidator.validateAngularForm(event.target, scope)) {
            this.pushNotification.id = this.id
            this.pushNotification.user_id = 1;
            this.pushNotification.is_active = 1;
            if(angular.isDefined(self.pushNotification.body)) {
            	this.pushNotification.body = self.pushNotification.body;
            }
            requestFactory.post(requestFactory.getUrl("pushnotification"), this.pushNotification, function(response) {
                $window.location = requestFactory.getTemplateUrl("pushnotification");
                $rootScope.notification.add({isSuccess : true,message : response.message}).showLater();
            }, this.fillError);
        }
    };
    /**
     * Method to handle the error message.
     */
    this.fillError = function(response) {
        this.isDisabled = false;
        if (response.status == 422 && response.data.hasOwnProperty("messages")) {
            angular.forEach(response.data.messages, function(message, key) {
                if (typeof message == "object" && message.length > 0) {
                    scope.errors[key] = {
                        has: true,
                        message: message[0]
                    };
                }
            });
        }
    };
    /**
     * Method to get the single record data for the zones
     *
     * @param id, record id
     * @returns object
     */
    this.fetchSingleInfo = function(id) {
        this.id = id;
        requestFactory.get(requestFactory.getUrl("pushnotification/" + this.id + "/edit"), function(response) {
        	this.pushNotification = response.pushSingleInfo;
        	if(this.pushNotification.body){
        		scope.descriptionElement.editor.setValue(this.pushNotification.body);
      	 	}
        	baseValidator.setRules(response.rules);
        }, function() {});
    };
    
    $(document).ready(function(){
		  scope.descriptionElement = $("#wysiwyg").wysihtml5({
			  color  : true,
			  html   : true,
			  events : {
				  blur : function() {
					  self.pushNotification.body = this.textarea.element.value;
				  }
			  },
		  }).data("wysihtml5");
	  });
    
}]);
/**
 * Manually bootstrap the Angular module here
 */
angular.element(document).ready(function() {
    angular.bootstrap(document, ["apptha.pushnotification"]);
});