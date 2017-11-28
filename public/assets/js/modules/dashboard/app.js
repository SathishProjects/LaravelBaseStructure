"use strict";
var dashboard = angular.module("apptha.dashboard", []);
dashboard.directive("notification", notificationDirective);
dashboard.factory("requestFactory", requestFactory);

dashboard.controller("DashboardController", ["$window", "$scope", "requestFactory","$filter","$rootScope","$timeout", function($window, scope, requestFactory, $filter, $rootScope, $timeout) {
	
	var self = this;
	this.dashboard = {};
	
	/**
     * To get the data for the dashboard
     */
    this.init = function() {
    	requestFactory.get(requestFactory.getUrl("api/gettargetorder"),function(response) {
			self.dashboard.targetOrder = response.data;
    	});
    	requestFactory.get(requestFactory.getUrl("getordercounts"),function(response) {
			self.dashboard.counts = response.data[0];
    	});
    	requestFactory.get(requestFactory.getUrl("getcustomercounts"),function(response) {
			self.dashboard.customer = response.data;
    	});
    	requestFactory.get(requestFactory.getUrl("getdrivercount"),function(response) {
			self.dashboard.driver = response.data;
    	});
    	requestFactory.get(requestFactory.getUrl("getshipmenttypecounts"),function(response) {
			self.dashboard.shipmentType = response.data[0];
    	});
    	requestFactory.get(requestFactory.getUrl("getpickupcounts"),function(response) {
			self.dashboard.pickupCounts = response.data[0];
    	});
    	requestFactory.get(requestFactory.getUrl("getmissedcounts"),function(response) {
			self.dashboard.missedCounts = response.data[0];
    	});
    	requestFactory.get(requestFactory.getUrl("getdeliverycounts"),function(response) {
			self.dashboard.deliveryCounts = response.data[0];
    	});
    	requestFactory.get(requestFactory.getUrl("getpendingcounts"),function(response) {
			self.dashboard.pendingCounts = response.data[0];
    	});
    	requestFactory.get(requestFactory.getUrl("getmissedorders"),function(response) {
			self.dashboard.missedOrder = response.data;
    	});
    	requestFactory.get(requestFactory.getUrl("getpendingorders"),function(response) {
			self.dashboard.pendingOrder = response.data;
    	});
    	requestFactory.get(requestFactory.getUrl("getrecentorders"),function(response) {
			self.dashboard.recentOrder = response.data;
    	});
    	requestFactory.get(requestFactory.getUrl("gettopcustomers"),function(response) {
			self.dashboard.customerData = response.data;
    	});
    }
    
    this.getImage = function(value) {
    	return (value != null) ? value : "assets/images/default-user.png";
    }
    this.fill = function (value) {
    	if(angular.isDefined(value)) {
    		return "width:"+value[0].sum/value[0].count;
    	}else{
    		return "width:0";
    	}
    }
    
    this.init();
}]);
/**
 * Manually bootstrap the Angular module here
 */
angular.element(document).ready(function() {
    angular.bootstrap(document, ["apptha.dashboard"]);
});