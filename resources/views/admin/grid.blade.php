<div class="content-header clearfix">
                <h2 class="col-md-6 col-sm-6 col-xs-6 nopadding">{{trans('user.manage_admin')}}</h2>
                <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                    <a href="{{url('admin/add')}}" class="button blue-button">{{trans('user.add_admin')}}</a>
                </div>
            </div>
<div class="table-tab">
    <div class="three_icons">
        <i class="fa fa-bars"></i>
        <i class="fa fa-times" style="display: none"></i>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" data-ng-class="{'active' : tabSelected == 'All'}">
            <a href="#all" aria-controls="all" role="tab" data-ng-click="selectTab('All')" data-ng-class="{'red' : tabSelected == 'All'}" >{{trans('messages.tab.all')}}<span>@{{moreInfo.totalCount}}</span></a></li>
        <li role="presentation" data-ng-class="{'active' : tabSelected == 1}">
            <a href="#active" data-ng-click="selectTab('1')" aria-controls="active" role="tab" data-ng-class="{'red' : tabSelected == 1}" >{{trans('messages.tab.active')}} <span>@{{moreInfo.activeCount}}</span></a>
        </li>
        <li role="presentation" data-ng-class="{'active' : tabSelected == 0}">
            <a href="#inactive" data-ng-click="selectTab('0')" aria-controls="inactive" role="tab" data-ng-class="{'red' : tabSelected == 0}" >{{trans('messages.tab.inactive')}} <span>@{{moreInfo.inactiveCount}}</span></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active">
            <div class="items-to-show">
                <span>{{trans('messages.show_entries')}}</span> 
                @include('layouts.rowperpage')
                <span class="colums_to_display">{{trans('messages.select_column_to_display')}}</span>
            </div>
            <div class="table-responsive">
                <div id="table_loader" class="table_loader_container ng-hide" data-ng-show="tableLoader">
                  <div class="table_loader">
                   <div class="loader"></div>
                  </div>
                </div>
                <table class="table tablesaw" data-tablesaw-mode="columntoggle">
                    <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">
                                <div class="ckbox ckbox-default">
                                    <input class="checkbox-check" type="checkbox" data-ng-click="selectAll()" id="selectall">
                                    <label for="selectall"> </label>
                                  </div>
                                  @if (config ('settings.general_settings.disable_delete') == 'Yes')
                                  <div class="dropdown options-drop" style="display: none">
                                    <button id="dLabel" class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{trans('messages.bulk_options_selected')}}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a data-toggle="modal" data-target="#deleteModal" data-ng-click="deleteRecords()"><i class="fa fa-trash"></i>{{trans('messages.delete')}}</a></li>
                                    </ul>
                                 </div>
                                 @endif
                            </th>
                            <th>{{trans('general.sno')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">{{trans('user.thead.name')}}
                              <i herf="" data-ng-class="{showGridArrow:field.sort}" data-ng-click="fieldOrder($event,'name')" class="fa fa-sort"></i>
                            </th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">{{trans('user.thead.company')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">{{trans('user.thead.userrole')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">{{trans('user.thead.email')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">{{trans('user.thead.created_date')}}<i class="fa fa-sort"></i></th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">{{trans('general.status')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">{{trans('general.action')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="search-row">
                            <td></td>
                            <td></td>
                            <td>
                                <div class="tooltip1">
                                    <input type="text" class="form-control" data-ng-model="filters.name">
                                    <span class="tooltiptext">{{trans('user.filter.name')}}</span>
                                </div>
                            </td>
                            <td>
                                <div class="tooltip1">
                                    <select class="form-control select"  data-ng-change="getRecords(true)" data-ng-model="filters.company">
                                      <option value=''>All</option>
                                      <option data-ng-value='apptha'>Apptha</option>
                                    </select>
                                    <span class="tooltiptext">{{trans('user.filter.company')}}</span>
                                </div>
                            </td> 
                            <td>
                                <div class="tooltip1">
                                    <span class="tooltiptext">{{trans('user.filter.role')}}</span>
                                    <select class="form-control"  name="role"
              						 data-ng-change="getRecords(true)" data-ng-model="filters.role"
              						 data-ng-options="role.id as role.name for role in moreInfo.userRoles ">
    						        <option  value=''>All</option>
    						 </select>
                                </div>
                            </td> 
                            <td>
                                <div class="tooltip1">
                                    <input type="text" class="form-control" data-ng-model="filters.email">
                                    <span class="tooltiptext">{{trans('user.filter.email')}}</span>
                                </div>
                            </td>                            
                            <td>
                                <div class="tooltip1">
                                    <input type="text" data-date-range class="form-control" name="daterange" data-ng-model="filters.created_at">
                                    <span class="tooltiptext">{{trans('user.filter.created_date')}}</span>
                                </div>
                            </td>
                            <td>
                                            <div class="tooltip1">
                                                <select class="form-control select" ng-init="filters.status='All'" data-ng-change="getRecords(true)" data-ng-model="filters.status">
                                                    <option data-ng-value='All'>{{trans('general.all')}}</option>
                                                    <option data-ng-value='1'>{{trans('general.active')}}</option>
                                                    <option data-ng-value='0'>{{trans('general.inactive')}}</option>
                                                </select>
                                                <span class="tooltiptext">{{trans('general.filter_by_status')}}</span>
                                            </div>
                                        </td>
                            <td><button type="button" data-ng-click="doGridSearch()"
								class="btn search warning" data-boot-tooltip="true"
								data-toggle="tooltip"
								data-original-title="{{trans('general.search')}}">
								<i class="fa fa-search"></i></button>
								<button type="button" class="danger product_list_reset_btn" name="reset" data-ng-click="gridReset()" value="{{trans('general.reset')}}" data-boot-tooltip="true" data-toggle="tooltip" data-original-title="{{trans('general.reset')}}"><i class="fa fa-refresh"></i></button>
								</td>
                          <td></td>
                        </tr>
                        <tr data-ng-if="noRecords">
                            <td colspan="8" class="no-data">{{trans('messages.empty_record')}}</td>
                        </tr>
                        <tr data-ng-if="showRecords" data-on-finish-rendered data-on-finish-rendered-records data-ng-repeat="record in records track by $index">
                            
                            <td>
                                <div class="ckbox ckbox-default">
                                    <input class="checkbox-check row-checkbox" data-ng-click="selectCheckBox(record.id)" type="checkbox" value="@{{record.id}}" id="select-@{{record.id}}">
                                    <label for="select-@{{record.id}}"></label>
                                </div>
                            </td>
                            <td>@{{$index+1}}</td>
                             <td class="customer">
                                            <div class="image-profile">
                                                 <div class="driver-img">
                                                  <img data-ng-if="record.profile_image == null" src="{{asset('assets/images/default-user.png')}}" alt="profile-image">
                                                  <img data-ng-if="record.profile_image != null" data-ng-src="@{{record.profile_image}}" alt="profile-image">
                                                </div>
                                                <div class="desc">
                                                     <a href="#">@{{record.name}}</a>
                                                    <p><i class="icon-phone"></i>@{{record.mobile_number}}</p>
                                                </div>
                                            </div>
                                        </td>
                            <td>@{{record.company}}</td>
                            <td>@{{record.user_role.name}}</td>
                            <td>@{{record.email}}</td>
                            <td>@{{formatDate(record.created_at)}}</td>
                            <td data-ng-if="record.is_active== 1">
                              <label class="active">{{trans('general.active')}}</label>
                            </td>
                            <td data-ng-if="record.is_active== 0">
                              <label class="inactive">{{trans('general.inactive')}}</label>
                            </td>
                            <td>
                               <a ng-href="{{url('admin/edit').'/'}}@{{record.id}}">
                                <i class="icon-edit grey"></i>
                               </a>
                               @if (config ('settings.general_settings.disable_delete') == 'Yes')
                               <a href='#' data-toggle="modal" data-target="#deleteModal" data-ng-click="deleteSingleRecord(record.id)">
                                <i class="icon-delete grey"></i>
                               </a>
                               @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('layouts.pagination',['module_name'=>'Admin User'])
        </div>
    </div>
</div>


