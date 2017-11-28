<div class="content-header clearfix">
    <h2 class="col-md-6 col-sm-6 col-xs-6 nopadding">Push Notification</h2>
    <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
        <a href="{{url('pushnotification/add')}}" class="button blue-button">Add Push Notification</a>
    </div>
</div>
<div class="table-tab">
    <div class="three_icons">
        <i class="fa fa-bars"></i>
        <i class="fa fa-times" style="display: none"></i>
    </div>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active">
            <div class="table-responsive">
                <div id="table_loader" class="table_loader_container ng-hide"
                 data-ng-show="tableLoader">
                 <div class="table_loader">
                  <div class="loader"></div>
                 </div>
                </div>
                <table class="table tablesaw" data-tablesaw-mode="columntoggle">
                    <thead>
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
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">{{trans('email.name')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Slug</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">{{trans('email.subject')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">{{trans('general.action')}}</th>
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
                                    <span class="tooltiptext">{{trans('email.name')}}</span>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
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
                            <td colspan="7" class="no-data">{{trans('messages.empty_record')}}</td>
                        </tr>
                        <tr data-ng-if="showRecords" data-on-finish-rendered data-ng-repeat="record in records track by $index">
                            <td>
                                <div class="ckbox ckbox-default">
                                    <input class="checkbox-check row-checkbox" data-ng-click="selectCheckBox(record.id)" type="checkbox" value="@{{record.id}}" id="select-@{{record.id}}">
                                    <label for="select-@{{record.id}}"></label>
                                </div>
                            </td>
                            <td>@{{$index+1}}</td>
                            <td>@{{record.name}}</td>
                            <td>@{{record.slug}}</td>
                            <td>@{{record.subject}}</td>
                            <td>
                              <a ng-href="{{url('pushnotification/edit').'/'}}@{{record.id}}">
                               <i class="icon-edit grey"></i>
                              </a>
                              @if (config ('settings.general_settings.disable_delete') == 'Yes')
                              <a href="#" data-toggle="modal" data-target="#deleteModal" data-ng-click="deleteSingleRecord(record.zone[0].id)">
                               <i class="icon-delete grey"></i>
                              </a>
                              @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('layouts.pagination',['module_name'=>'Email'])
        </div>
    </div>
</div>


