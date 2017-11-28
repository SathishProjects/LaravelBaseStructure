"use strict";
var sms = angular.module("apptha.sms", []);
sms.directive("notification", notificationDirective);
sms.factory("requestFactory", requestFactory);
sms.directive("baseValidator", validatorDirective);
sms.factory("requestFactory", requestFactory);

sms.controller("SmsController", ["$window", "$scope", "requestFactory", "$rootScope", function($window, scope, requestFactory, $rootScope) {
    requestFactory.setThisArgument(this);
    this.sms = {};
    scope.errors = {};

    /**
     * Method to get the rules for the add form
     */
    this.fetchRules = function() {
        requestFactory.get(requestFactory.getUrl("smstemplate/create"), function(response) {
        	baseValidator.setRules(response.rules);
        }, function() {});
    };
    /**
     * Method to save the add form data
     */
    this.save = function(event) {
        if (baseValidator.validateAngularForm(event.target, scope)) {
            this.sms.id = this.id
            this.sms.user_id = 1;
            this.sms.is_active = 1;
            if(angular.isDefined(self.sms.content)) {
            	this.sms.content = self.sms.content;
            }
            requestFactory.post(requestFactory.getUrl("smstemplate"), this.sms, function(response) {
                $window.location = requestFactory.getTemplateUrl("sms");
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
        requestFactory.get(requestFactory.getUrl("smstemplate/" + this.id + "/edit"), function(response) {
        	this.sms = response.smsSingleInfo;
        	if(this.sms.content){
        		scope.descriptionElement.editor.setValue(this.sms.content);
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
					  self.sms.content = this.textarea.element.value;
				  }
			  },
		  }).data("wysihtml5");
	  });
}]);
/**
 * Manually bootstrap the Angular module here
 */
angular.element(document).ready(function() {
    angular.bootstrap(document, ["apptha.sms"]);
});