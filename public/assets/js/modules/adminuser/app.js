"use strict";
var adminUser = angular.module("apptha.adminUser", []);
adminUser.directive("notification", notificationDirective);
adminUser.directive("baseValidator", validatorDirective);
adminUser.factory("requestFactory", requestFactory);

adminUser.controller("AdminUserController", ["$window", "$scope", "requestFactory", "$rootScope" , "$timeout", function($window, scope, requestFactory, $rootScope, $timeout) {
    requestFactory.setThisArgument(this);
    this.adminUser = {};
    scope.errors = {};
    
    /**
     * Initialize upload handler will 
     * required options for driver
     */
    $timeout(function(){
    	(new uploadHandler).initate({
            file      : "picture-user",
            previewer : "user-profile-image",
            progress  : "user-progress",
            url       : requestFactory.getTemplateUrl("api/upload",{service : "admin"}),
            afterUpload : function(response){
              self.adminUser.uploadedImage=response.info;
            }
        });
    }, 300);
    
    /**
     * Method to get the rules set for the delivery slot form
     */
    this.fetchAddformRules = function() {
        requestFactory.get(requestFactory.getUrl("admin/create"), function(response) {
        	this.cities = response.city;
        	this.states = response.state;
        	this.countries = response.country;
        	this.roles = response.userRoles;
            this.adminUser.is_active = 1;
            this.adminUser.gender = "male";
            baseValidator.setRules(response.rules);
        }, function() {});
    };
    /**
     * Method to save the add form data into delivery_slots table
     */
    this.save = function(event) {
    	if(angular.isDefined(self.adminUser.uploadedImage)) {
    		this.adminUser.uploadedImage = self.adminUser.uploadedImage;
    	}
        if (baseValidator.validateAngularForm(event.target, scope)) {
            this.adminUser.id = this.id
            requestFactory.post(requestFactory.getUrl("admin"), this.adminUser, function(response) {
                $window.location = requestFactory.getTemplateUrl("admin");
                $rootScope.notification.add({isSuccess : true,message : response.message}).showLater();
            }, this.fillError);
        }
    };
    /**
     * Method to handle the error message.
     */
    this.fillError = function(response) {
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
     * Method to get the sigle record data
     *
     * @param id, record id
     * @returns object
     */
    this.fetchadminUserSingleInfo = function(id) {
        this.id = id;
        requestFactory.get(requestFactory.getUrl("admin/" + this.id + "/edit"), function(response) {
            this.adminUser = response.adminUserSingleInfo;
            this.cities = response.city;
        	this.states = response.state;
        	this.countries = response.country;
        	this.roles = response.userRoles;
            this.adminUser.is_active = response.adminUserSingleInfo.is_active;
            this.adminUser.gender = response.adminUserSingleInfo.gender;
            this.adminUser.user_role = response.adminUserSingleInfo.user_role_id;
            this.adminUser.city = response.adminUserSingleInfo.city_id;
            this.adminUser.state = response.adminUserSingleInfo.state_id;
            this.adminUser.country = response.adminUserSingleInfo.country_id;
            baseValidator.setRules(response.rules);
        }, function() {});
    };
    
    /**
     * Trigger select file event on the requested 
     * input file element
     *
     * @param string elementId
     * @return void
     */
    this.triggerSelectFile = function(elementId) {
        angular.element(elementId).click();
    };
}]);
/**
 * Manually bootstrap the Angular module here
 */
angular.element(document).ready(function() {
    angular.bootstrap(document, ["apptha.adminUser"]);
});