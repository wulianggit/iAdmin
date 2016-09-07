@extends('layouts.admin')

@section('css')
<!-- iCheck -->
<link href="{{asset('backend/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
<!-- Select2 -->
<link href="{{asset('backend/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<!-- Switchery -->
<link href="{{asset('backend/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
<!-- nestable -->
<link href="{{asset('backend/vendors/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>菜单管理</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    @include('flash::message')
    @inject('menus', 'App\Repositories\Presenter\MenuPresenter')

    <div class="row">
        <!-- left panel -->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>菜单列表</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content bs-example-popovers">
                    <div class="dd" id="nestable_list_3">
                        <ol class="dd-list">

                            {!! $menus->getMenuList($menuList) !!}
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end left panel -->
        <!-- right panel -->
        @permission(config('admin.permissions.menu.add'))
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>添加菜单 <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    @if (count($errors) > 0) 
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>  
                    @endif
                    <form class="form-horizontal form-label-left" id="menuForm" method="POST" action="{{ url('/admin/menu') }}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">上级菜单</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" name="parent_id">
                                    {!! $menus->getMenus($menu) !!}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单名称</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="菜单名称" name="name" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单图标</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="菜单图标" name="icon" value="{{old('icon')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单链接</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="菜单链接" name="url" value="{{old('url')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单高亮</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="菜单高亮" name="hightlight_url" value="{{old('hightlight_url')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单权限</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="菜单权限" name="slug" value="{{old('slug')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">排序</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="排序" name="sort" value="{{old('sort')}}">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="reset" class="btn btn-default">取消</button>
                                <button type="submit" class="btn btn-success">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endpermission
        <!-- end right panel -->
    </div>
</div>
@endsection

@section('js')
<!-- Select2 -->
<script src="{{asset('backend/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<!-- nestable -->
<script src="{{asset('backend/vendors/jquery-nestable/jquery.nestable.js')}}"></script>
{{-- layer --}}
<script src="{{asset('backend/vendors/layer/layer.js')}}"></script>

<script src="{{asset('backend/js/menu/menu-list.js')}}"></script>

<script>
    $(document).ready(function() {
        MenuList.init();
      });
</script>
@endsection
