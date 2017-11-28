@extends('layouts.default')

@section('content')
    <div class="contentpanel dashboard" data-ng-controller="DashboardController as dashboardCtrl" data-ng-cloak>
        <div class="row">
            <div class="col-md-6">
                <div class="total-order">
                    <div class="green col-md-4 nopadding">
                        <span>@{{dashboardCtrl.dashboard.targetOrder.target}}</span>
                        <h4>{{trans('dashboard.target_order')}}</h4>
                    </div>
                    <div class="yellow col-md-8 nopadding">
                        <div class="target">
                            <span>@{{dashboardCtrl.dashboard.counts.totalOrder}}</span>
                            <h4>{{trans('dashboard.total_order')}}</h4>
                        </div>
                        <div class="archived">
                            <span>@{{dashboardCtrl.dashboard.counts.orderProcessed}}</span>
                            <h4>{{trans('dashboard.achieved')}}</h4>
                        </div>
                        <p>{{Carbon\Carbon::now()->format('F')}} month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="revenue">
                    <div class="desc">
                        <span><i class="fa fa-inr"></i> @{{dashboardCtrl.dashboard.counts.totalRevenue}}</span>
                        <h4>{{trans('dashboard.total_revenue')}}</h4>
                    </div>
                    <i class="icon-total-revenue"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="total-users">
                    <h2>{{trans('dashboard.total_users')}}</h2>
                    <div class="division">
                        <div class="drivers">
                            <span>@{{dashboardCtrl.dashboard.driver.driverCount}}  <i class="icon-car-steering-wheel"></i></span>
                            <h4>{{trans('dashboard.drivers')}}</h4>
                        </div>
                        <div class="customers">
                            <span>@{{dashboardCtrl.dashboard.customer.customerCount}} <i class="icon-manage-user"></i></span>
                            <h4>{{trans('dashboard.customers')}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="order-by-time">
            <h2>{{trans('dashboard.orders_by_time')}} <span>{{Carbon\Carbon::now()->timezone('Asia/Kolkata')->format('h:i A')}}</span></h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{trans('dashboard.duration')}}</th>
                            <th class="text-center">{{trans('dashboard.pickup')}}</th>
                            <th class="text-center">{{trans('dashboard.delivery')}}</th>
                            <th class="text-center">{{trans('dashboard.missed')}}</th>
                            <th class="text-center">{{trans('dashboard.pending')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{trans('dashboard.1_hour')}}</td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.pickupCounts.pickupOneHour"><a>@{{dashboardCtrl.dashboard.pickupCounts.pickupOneHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.pickupCounts.pickupOneHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.deliveryCounts.deliveryOneHour"><a>@{{dashboardCtrl.dashboard.deliveryCounts.deliveryOneHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.deliveryCounts.deliveryOneHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.missedCounts.missedOneHour"><a>@{{dashboardCtrl.dashboard.missedCounts.missedOneHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.missedCounts.missedOneHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.pendingCounts.pendingOneHour"><a>@{{dashboardCtrl.dashboard.pendingCounts.pendingOneHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.pendingCounts.pendingOneHour"><a>0</a></td>
                        </tr>
                        <tr>
                            <td>{{trans('dashboard.2_hour')}}</td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.pickupCounts.pickupTwoHour"><a>@{{dashboardCtrl.dashboard.pickupCounts.pickupTwoHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.pickupCounts.pickupTwoHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.deliveryCounts.deliveryTwoHour"><a>@{{dashboardCtrl.dashboard.deliveryCounts.deliveryTwoHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.deliveryCounts.deliveryTwoHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.missedCounts.missedTwoHour"><a>@{{dashboardCtrl.dashboard.missedCounts.missedTwoHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.missedCounts.missedTwoHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.pendingCounts.pendingTwoHour"><a>@{{dashboardCtrl.dashboard.pendingCounts.pendingTwoHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.pendingCounts.pendingTwoHour"><a>0</a></td>
                        </tr>
                        <tr>
                            <td>{{trans('dashboard.3_hour')}}</td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.pickupCounts.pickupThreeHour"><a>@{{dashboardCtrl.dashboard.pickupCounts.pickupThreeHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.pickupCounts.pickupThreeHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.deliveryCounts.deliveryThreeHour"><a>@{{dashboardCtrl.dashboard.deliveryCounts.deliveryThreeHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.deliveryCounts.deliveryThreeHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.missedCounts.missedThreeHour"><a>@{{dashboardCtrl.dashboard.missedCounts.missedThreeHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.missedCounts.missedThreeHour"><a>0</a></td>
                            <td class="text-center" data-ng-if="dashboardCtrl.dashboard.pendingCounts.pendingThreeHour"><a>@{{dashboardCtrl.dashboard.pendingCounts.pendingThreeHour}}</a></td>
                            <td class="text-center" data-ng-if="!dashboardCtrl.dashboard.pendingCounts.pendingThreeHour"><a>0</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row status-overview">
            <h2>
                <span>{{trans('dashboard.status_overview')}}</span>
            </h2>
         
            
            <div class="col-md-8 col-sm-8">
                <div class="graph">
                    <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#activity-analytics" aria-controls="activity-analytics" role="tab" data-toggle="tab">{{trans('dashboard.activity_analytics')}}</a></li>
                        <li role="presentation"><a href="#" aria-controls="delivery-performance">{{trans('dashboard.delivery_performance')}}</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="activity-analytics">
                            <div class="top-info">
                                <span class="customer">{{trans('dashboard.customer')}}</span>
                                <span class="parcel">{{trans('dashboard.parcel')}}</span>
                                <select class="form-control">
                                    <option selected disabled>Days</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thrusday</option>
                                    <option>Friday</option>
                                    <option>Saturday</option>
                                    <option>Sunday</option>                                    
                                </select>
                            </div>  
                            <img data-ng-src="{{asset('assets/images/graph.png')}}" alt="graph" class="img-responsive">
                        </div>
                        <div role="tabpanel" class="tab-pane" id="delivery-performance">...</div>
                      </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-4">
                <div class="driver-review-performance">
                    <h4>{{trans('dashboard.driver_review_performance')}}</h4>
                        <div class="performance-info">
                            <div class="single-count outstanding">
                            <label class="name">{{trans('dashboard.outstanding')}}
                                <i class="fa fa-caret-right"></i>
                            </label>
                            <span class="count">@{{dashboardCtrl.dashboard.customer.outstandingDrivers.length}}</span>
                            <div class="bar">
                                <div class="fill" style="@{{dashboardCtrl.fill(dashboardCtrl.dashboard.customer.outstandingDrivers)}}"></div>
                            </div>
                        </div>

                        <div class="single-count excellent">
                            <label class="name">{{trans('dashboard.excellent')}}
                            </label>
                            <span class="count">@{{dashboardCtrl.dashboard.customer.excellentDrivers.length}}</span>
                            <div class="bar">
                                <div class="fill" style="@{{dashboardCtrl.fill(dashboardCtrl.dashboard.customer.excellentDrivers)}}"></div>
                            </div>
                        </div>

                        <div class="single-count good">
                            <label class="name">{{trans('dashboard.good')}}
                            </label>
                            <span class="count">@{{dashboardCtrl.dashboard.customer.goodDrivers.length}}</span>
                            <div class="bar">
                                <div class="fill" style="@{{dashboardCtrl.fill(dashboardCtrl.dashboard.customer.goodDrivers)}}"></div>
                            </div>
                        </div>

                        <div class="single-count poor">
                            <label class="name">{{trans('dashboard.poor')}}
                            </label>
                            <span class="count">@{{dashboardCtrl.dashboard.customer.poorDrivers.length}}</span>
                            <div class="bar">
                                <div class="fill" style="@{{dashboardCtrl.fill(dashboardCtrl.dashboard.customer.poorDrivers)}}"></div>
                            </div>
                        </div>

                        <div class="single-count to-be-avoided">
                            <label class="name">{{trans('dashboard.to_be_avoided')}}
                            </label>
                            <span class="count">@{{dashboardCtrl.dashboard.customer.avoidedDrivers.length}}</span>
                            <div class="bar">
                                <div class="fill" style="@{{dashboardCtrl.fill(dashboardCtrl.dashboard.customer.avoidedDrivers)}}"></div>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="visitors-overview">
                    <h4>{{trans('dashboard.vistors_overview')}}
                        <select class="form-control select">
                            <option>{{trans('dashboard.by_today')}}</option>
                        </select>
                    </h4>
                    <div class="overview-counts">
                        <div class="new-visitor">
                            <span>@{{dashboardCtrl.dashboard.customer.newCustomerCount}}</span>
                            <h5>{{trans('dashboard.new_vistor')}}</h5>
                        </div>
                        <div class="returning-visitor">
                            <span>@{{dashboardCtrl.dashboard.customer.returnCustomerCount}}</span>
                            <h5>{{trans('dashboard.returning_vistor')}}</h5>
                        </div>
                        <div class="sessions">
                            <span>0</span>
                            <h5>{{trans('dashboard.sessions')}}</h5>
                        </div>  
                    </div>
                    <div class="desktop-mobile">
                        <div class="info-name clearfix">
                            <span class="desktop">{{trans('dashboard.desktop')}}</span>
                            <span class="mobile">{{trans('dashboard.mobile')}}</span>
                        </div>
                        <div class="info-percentage clearfix">
                            <span class="desktop">@{{dashboardCtrl.dashboard.customer.webCustomerCount}}%</span>
                            <span class="mobile">@{{dashboardCtrl.dashboard.customer.mobileCustomerCount}}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
@endsection

@section('scripts')    
    <script type="text/javascript" src="{{asset('assets/js/lib/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/lib/jquery.dd.js')}}"></script>    
    <script src="{{asset('assets/js/modules/base/requestFactory.js')}}"></script>
    <script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
    <script src="{{asset('assets/js/modules/dashboard/app.js')}}"></script>
@endsection