<div class="table-tab">
    <div class="three_icons">
        <i class="fa fa-bars"></i>
        <i class="fa fa-times" style="display: none"></i>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" data-ng-class="{'active' : tabSelected == 'All'}">
            <a href="#all" aria-controls="all" role="tab" data-ng-click="selectTab('All')" data-ng-class="{'red' : tabSelected == 'All'}">{{trans('messages.tab.all')}}</a></li>
        <li role="presentation" data-ng-class="{'active' : tabSelected == 'Active'}">
            <a href="#active" data-ng-click="selectTab('Active')" aria-controls="active" role="tab" data-ng-class="{'red' : tabSelected == 'Active'}">{{trans('messages.tab.active')}} <span>15</span></a>
        </li>
        <li role="presentation" data-ng-class="{'active' : tabSelected == 'Inactive'}">
            <a href="#inactive" data-ng-click="selectTab('Inactive')" aria-controls="inactive" role="tab" data-ng-class="{'red' : tabSelected == 'Inactive'}"> {{trans('messages.tab.inactive')}} <span>15</span></a>
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
                            <th>{{trans('messages.s_no')}}</th>
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
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">{{trans('user.thead.name')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">{{trans('user.thead.email')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">{{trans('user.thead.created_date')}}</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">{{trans('user.thead.updated_date')}}</th>
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
                            <td></td>
                            <td></td>
                        </tr>
                        <tr data-ng-if="noRecords">
                            <td colspan="5" class="no-data">{{trans(MESSAGE_EMPTY_RECORD)}}</td>
                        </tr>
                        <tr 
                            data-ng-if="showRecords" data-on-finish-rendered data-ng-repeat="record in records track by $index">
                            <td>@{{((currentPage - 1) * rowsPerPage) + $index +1}}</td>
                            <td>
                                <div class="ckbox ckbox-default">
                                    <input class="checkbox-check row-checkbox" data-ng-click="selectCheckBox(record.id)" type="checkbox" value="@{{record.id}}" id="select-@{{record.id}}">
                                    <label for="select-@{{record.id}}"></label>
                                </div>
                            </td>
                            <td>@{{record.name}}</td>
                            <td>@{{record.email}}</td>
                            <td>@{{formatDate(record.created_at)}}</td>
                            <td>@{{formatDate(record.updated_at)}}</td>
                            </td>
                            <td>
                               <a href="">
                                <i class="icon-edit grey"></i>
                               </a>
                               @if (config ('settings.general_settings.disable_delete') == 'Yes')
                               <a data-toggle="modal" data-target="#deleteModal" data-ng-click="deleteSingleRecord(record.id)">
                                <i class="icon-delete grey"></i>
                               </a>
                               @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('layouts.pagination',['module_name'=>'User'])
        </div>
    </div>
</div>


