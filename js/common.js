function CurrentTime() {
	var time = dayjs().format('HH:mm:ss');
	$('#time').text(time);
	var date = dayjs().format('YYYY 年 MM 月 DD 日');
	$('#date').text(date);
	setTimeout("CurrentTime()", 1000);
}

function CurrentDate() {
	var nowDate = new Date();
	var lunarD = Lunar.fromDate(nowDate);
	console.log(lunarD);
	var lunarNowDate = lunarD.getYearInGanZhi() + '年' + lunarD.getMonthInChinese() + "日" + lunarD.getDayInChinese();
	$('#nowLunar').text(lunarNowDate);
	var nowWeek = lunarD.getWeekInChinese();
	$('#nowWeek').text('星期' + nowWeek);
}
CurrentTime();
CurrentDate();

$(".siteList ").click(function() {
	var openurl = $(this).data('url');
	open_links(openurl);
});

$("a.typeList").click(function() {
	$("html, body").animate({
		scrollTop: $($(this).attr("href")).offset().top - 20 + "px"
	}, 500);
	return false;
});

//二级菜单
$(".type-list .list").click(function() {
	$(this).addClass("hover").siblings().removeClass('hover');
	$(this).find('.list-sub').slideDown();
	$(this).siblings().find('.list-sub').slideUp();
});

//搜索
$('#seaech-to').click(function() {
	var kw = $('#search').val();
	var baidu = 'https://www.baidu.com/s?ie=UTF-8&wd=';
	window.open(baidu + kw);
	$(".site-tit").removeClass("hidden");
	$(".siteList").removeClass("hidden");
});

//回车键、本地搜索
function keyClick() {
	$('body').keyup(function(e) {
		if(e.keyCode === 13) {
			var isFocus = $("#search").is(":focus");
			if(true == isFocus) {
				console.log(isFocus);
				var kw = $('#search').val();
				var baidu = 'https://www.baidu.com/s?ie=UTF-8&wd=';
				window.open(baidu + kw);
				$(".site-tit").removeClass("hidden");
				$(".siteList").removeClass("hidden");
			}
		}
	});

	$("#search").blur(function(data, status) {
		if($("#search").val() == '') {
			$(".site-tit").removeClass("hidden");
		};
	});

	$("#search").bind("input propertychange", function(event) {
		if($("#search").val() == '') {
			$(".site-tit").removeClass("hidden");
		};
	});
	$("#search").focus(function(data, status) {
		$('.search-lists').addClass('hide');
	});
	var h = holmes({
		input: '#search',
		find: '.siteList',
		placeholder: '<div class="empty">未搜索到匹配结果！</div>',
		mark: false,
		hiddenAttr: true,
		class: {
			visible: 'visible',
				hidden: 'hidden'
		},
		onFound(el) {
			$(".site-tit").addClass("hidden");
		},
		onInput(el) {
			$(".site-tit").addClass("hidden");
		},
		onVisible(el) {
			$(".site-tit").removeClass("hidden");
		},
		onEmpty(el) {
			$(".site-tit").removeClass("hidden");
		},
	});

}
keyClick();