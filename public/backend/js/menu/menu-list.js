var MenuList = function () {
	var menuInit = function () {
        // Select2
        var select2 = $(".select2_single");
        select2.select2({
            placeholder: "Select a state",
            allowClear: true
        });

        // nestable
        $('#nestable_list_3').nestable();		

        // 添加菜单按钮事件
        $('.createMenu').on('click', function () {
        	// 移除修改菜单时添加的id隐藏域
        	$('input[name=id]').remove();
        	// 移除修改菜单时添加的method隐藏域
        	$('#method').remove();
        	// 修改表单的action地址
        	$('#menuForm').attr('action', '/admin/menu');
        	// 清空表单
        	$('#menuForm input.form-control').val('');

        	var _item = $(this);
        	// 改变上级菜单的默认值
        	select2.val(_item.attr('data-pid')).trigger('change');
        });

        // 修改菜单按钮事件
        $('.editMenu').on('click', function () {
        	var _url = $(this).attr('data-href');
        	$.ajax({
        		url : _url,
        		dataType : 'json',
        		// layer loading
        		beforeSend : function () {
        			layer.load(1);
        		},
        		success  : function (data) {
        			// 关闭 loading
        			layer.closeAll('loading');
        			if (data.status == 'success') {
        				menuHandle.initAttribute(data, select2);
        			}
        			// layer 提示
        			layer.msg(data.msg);
        		}
        	});
        });

        // 删除菜单按钮事件
        $('.destoryMenu').on('click', function () {
        	var _id = $(this).attr('data-id');
        	layer.confirm('确定要删除菜单?',{
        		btn : ['确定', '取消'] // 按钮
        	}, function () {
        		$('form[name=delete_item_'+_id+']').submit();
        	});
        });
	};

	var menuHandle = function () {
		var menuAttribute = function (menuData, select2) {
			select2.val(menuData.parent_id).trigger('change');
			$('input[name=name]').val(menuData.name);
			$('input[name=icon]').val(menuData.icon);
			$('input[name=url]').val(menuData.url);
			$('input[name=hightlight_url]').val(menuData.hightlight_url);
			$('input[name=slug]').val(menuData.slug);
			$('input[name=sort]').val(menuData.sort);
			$('#menuForm').attr('action', menuData.update);
			// 添加一个隐藏域，存入需要修改菜单的id
			// 已经存在就更新，不存在就添加
			var _id = $('input[name=id]');
			if (_id.length > 0) {
				_id.val(menuData.id);
			} else {
				$('#menuForm').append('<input name="id" type="hidden" value="'+menuData.id+'">');
			}
			var _method = $('#method');
			if (_method.length < 1) {
				$('#menuForm').append('<input name="_method" type="hidden" id="method" value="PATCH">');
			}
		}

		return {
			initAttribute : menuAttribute
		};
	}();

	return {
		init : menuInit
	};
}();