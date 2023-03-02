layui.use(['form', 'dropdown'], function() {
	var $ = layui.$,
		dropdown = layui.dropdown,
		form = layui.form,
		util = layui.util;

	$('#nav-add-type').click(function() {
		layer.open({
			type: 1,
			title: '添加分类',
			shadeClose: true,
			shade: 0.8,
			area: ['460px'],
			content: $('#component_type_add'), //iframe的url
		});
	});

	$('#nav-add-link').click(function() {
		layer.open({
			type: 1,
			title: '添加书签',
			shadeClose: true,
			shade: 0.8,
			area: ['460px'],
			content: $('#component_links_add'), //iframe的url
			success: function() {
				$('#component_links_add .list-type span').eq(0).addClass('hover');
				var addfid = $('#component_links_add .list-type span').eq(0).data('fid');
				$('input#fid').val(addfid);
			}
		});
	});

	//添加分类
	$('#categoryList span').click(function() {
		$(this).addClass('hover').siblings().removeClass('hover')
		var fid = $(this).data('fid');
		console.log(fid);
		$('input#fid').val(fid);
	});

	form.on('submit(type_add)', function(data) {
		var datas = data.field;
		console.log(datas);

		$.post("index.php?c=api&method=add_category", {
			name: datas.name,
			fid: datas.fid,
			font_icon: datas.font_icon,
			weight: datas.weight,
			property: datas.property,
			description: datas.description,
		}, function(data, status) {
			console.log(data)
			console.log(status)
			if(data.code == 0 || data.code == 200) {
				layer.msg('添加分类成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error()
		});
		return false;
	});

	//编辑分类
	form.on('submit(type_edit)', function(data) {
		var datas = data.field;
		console.log(datas);

		$.post("index.php?c=api&method=edit_category", {
			id: datas.id,
			name: datas.name,
			fid: datas.fid,
			font_icon: datas.font_icon,
			weight: datas.weight,
			property: datas.property,
			description: datas.description,
		}, function(data, status) {
			console.log(data)
			console.log(status)
			if(data.code == 0 || data.code == 200) {
				layer.msg('编辑分类成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error()
		});
		return false;
	});

	//添加链接
	form.on('submit(links_add)', function(data) {
		var datas = data.field;
		console.log(datas);

		$.post("index.php?c=api&method=add_link", {
			title: datas.title,
			fid: datas.fid,
			url: datas.url,
			weight: datas.weight,
			property: datas.property,
			description: datas.description,
		}, function(data, status) {
			console.log(data)
			console.log(status)
			if(data.code == 0 || data.code == 200) {
				layer.msg('添加链接成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error()
		});
		return false;
	});

	//编辑链接
	form.on('submit(links_edit)', function(data) {
		var datas = data.field;
		console.log(datas);

		$.post("index.php?c=api&method=edit_link", {
			id: datas.id,
			title: datas.title,
			fid: datas.fid,
			url: datas.url,
			weight: datas.weight,
			property: datas.property,
			description: datas.description,
		}, function(data, status) {
			console.log(data)
			console.log(status)
			if(data.code == 0 || data.code == 200) {
				layer.msg('编辑链接成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error()
		});
		return false;
	});

	//识别链接信息
	$('button#get_links_info').click(function() {

		var url = $('input#url').val();
		$.post("index.php?c=api&method=get_link_info", {
			url: url,
		}, function(data, status) {
			console.log(data)
			console.log(status)
			if(data.code == 0 || data.code == 200) {
				form.val("links_add", data.data);
				layer.msg('获取链接信息成功！', {
					icon: 6,
					time: 1000,
				});
				return;
			}
			post_error()
		});
		return false;
	});

	//右下角工具栏
	util.fixbar({
		bar1: '&#xe624;',
		css: {
			right: 30,
			bottom: 30
		},
		bgcolor: '#393D49',
		click: function(type) {
			if(type === 'bar1') {
				if($('#component_type_edit').length > 0) {
					layer.open({
						type: 1,
						title: '添加书签',
						shadeClose: true,
						shade: 0.8,
						area: ['460px'],
						content: $('#component_links_add'), //iframe的url
						success: function() {
							$('#component_links_add .list-type span').eq(0).addClass('hover');
							var addfid = $('#component_links_add .list-type span').eq(0).data('fid');
							$('input#fid').val(addfid);
						}
					});
					return;
				}
				post_error()

			}
		}
	});

	//选择图标
	function select_icons() {
		$('.select_icons').click(function() {
			layer.open({
				type: 1,
				title: '选择图标',
				shadeClose: true,
				shade: 0.8,
				area: ['534px'],
				content: $('#component_icons_list'), //iframe的url
				success: function() {

				}
			});
		})
	}
	select_icons();
	//给父页面传值
	$('#component_icons_list li').on('click', function() {
		var icon_name = $(this).attr('title');
		console.log(icon_name);
		parent.$('input#font_icon').val(icon_name);
		$('.font_icon_show i').attr('class', 'fa ' + icon_name)
		layer.close(layer.index);
	});

});

function post_error() {
	layer.msg('操作失败，请重试！', {
		icon: 5,
	});
}
//查询分类下是否为空
function isnull_type(id) {
	$.post("index.php?c=api&method=q_category_link", {
		category_id: id
	}, function(data, status) {
		if(data.count == 0) {
			del_type(id);
			return;
		};
		layer.msg('该分类不为空！', {
			icon: 5,
		});

	});

}
//删除分类
function del_type(id) {
	$.post("index.php?c=api&method=del_category", {
		id: id
	}, function(data, status) {
		console.log(data)
		console.log(status)
		if(data.code == 0 || data.code == 200) {
			layer.msg('删除分类成功！', {
				icon: 6,
				time: 1000,
				end: function() {
					window.location.reload();
				}
			});
			return;
		}
		post_error()
	});
}
//删除书签
function del_links(id) {
	$.post("index.php?c=api&method=del_link", {
		id: id
	}, function(data, status) {
		console.log(data)
		console.log(status)
		if(data.code == 0 || data.code == 200) {
			layer.msg('删除书签成功！', {
				icon: 6,
				time: 1000,
				end: function() {
					window.location.reload();
				}
			});
			return;
		}
		post_error()
	});
}
//打开书签
function open_links(url) {
	console.log(url)
	window.open(url);
}

//复制书签链接
function copy_link_url(div, links) {
	var clipboard = new ClipboardJS(div, {
		text: function() {
			return links
		}
	});
	clipboard.on('success', function(e) {
		console.log(e);
		layer.msg('链接复制成功！', {
			icon: 6,
			time: 1000,
		});
	});
	clipboard.on('error', function(e) {
		console.log(e);
		layer.msg('复制失败，请重试！', {
			icon: 6,
			time: 1000,
		});
	});
}