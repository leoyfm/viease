//Ready
$(function(){
	var mywidth = $("body").width();
	if(mywidth > 600) {
	   mywidth = 600;
	}
	$("body,html,footer").css({"font-size":mywidth/30, width:mywidth, margin:"0 auto"});
	
	$("#top").bind("click",function(){
		$("html,body").animate({ scrollTop: "0" }, 500);
	});
	
	//调用表单验证
	jQuery.verification(errorfun, rightfun);
});


//弹窗
function popup(){
	var $popup = $(".popup");//获取弹窗对象
	var $box = $(".popup .popup_box");//获取弹窗box
	var box_top = ($(window).height()-$box.height()) / 2;
	box_top += $(window).scrollTop();
	$box.css({"top":box_top});//设置弹窗左边距和上边距
	$popup.fadeIn();
}
function popup_off(){
	$(".popup").hide();
}

/* 表单验证 */

//错误函数
function errorfun(t) {
	$(t).attr("error","on");
	var con = $(t).prev().html();
	$("#str").parent().show();
	$("#str").html(con);
}
//正确函数
function rightfun(t) {
	$(t).removeAttr("error");
	$("#str").parent().hide();
}

/*  表单验证  */
jQuery.verification = function(error, right) {
	//类名数组
	/* is_user:用户名,is_qq:QQ号,is_tell:固话号码,is_mobile:手机号码,is_id:身份证号码,is_email:邮箱,is_pass:密码,is_bank:银行卡,is_num:纯数字,is_ch:纯中文,is_ip:IP*/
	var name = ["is_user", "is_qq", "is_tell", "is_mobile", "is_id", "is_email", "is_pass", "is_bank", "is_num", "is_ch","is_empty"];
	//正则表达式数组
	var regex = [/[^a-zA-Z0-9]/, /^\d{5,11}$/, /^0\d{2,3}-{0,1}\d{7,8}$|^\d{7,8}$/, /((1[34578][0-9]{1}))\d{8}/, /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/, /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/, /\d+[a-zA-Z]+|[a-zA-Z]+\d+/, /^\d{19}$|^\d{12}$|^\d{16}$/, /[^\d-.]/, /[\u4E00-\u9FFF]/,/[\u4E00-\u9FFF]/];
	//提示数组
	//反向数组
	var rev = [0, 8];
	var obj = $("[data]");
	for (i = 0; i < obj.length; i++) {
		for (j = 0; j < name.length; j++) {
			if (name[j] == obj.eq(i).attr("data")) {
				obj.eq(i).attr("data", j);
				break;
			}
		}
	}
	//失去焦点
	obj.bind("blur", function() {
		var val = $(this).val();
		var dat = $(this).attr("data");
		if (val == "") {
			error(this);
			return false;
		}
		if (!test(val, dat)) {
			error(this);
		} else {
			right(this);
		}
	});
	//测试方法
	function test(value, num) {
		var temp = regex[num].test(value); //验证正则表达式
		//判断取反
		for (i = 0; i < rev.length; i++) {
			if (num == rev[i]) {
				temp = !temp;
				break;
			}
		}
		//判断对错
		if (temp) {
			return true;
		} else {
			return false;
		}
	}
	
	
	var $file = $(".file");
	$file.val("").attr("error","on").show();
	$file.bind("change",function(){
		isFile($(this));
	});
	
	//提交
	$(".form").bind("submit", function() {
		var t = $(this).find("[data]");
		t.blur();
		var err = $(this).find("[error='on']");
		if (err.length) {
			err.eq(0).blur();
			var tf = $(this).find(".pic .file[error='on']");
			if(tf.length);
			{
				errorfun(tf.eq(0));
			}
			return false;
		}
		else
		{
			popup();
		}
	});
	
	//上传判断
	function isFile(t)
	{
		if(isPicture(t.val()))
		{ 
			rightfun(t);
			t.parent().next(".row").show();
		}
		else
		{
			 errorfun(t);
		}	
	}
	
   //判断上传图片的类型
   function isPicture(fileName) {
	  if (fileName != null && fileName != "") 
	  {
		  //lastIndexOf如果没有搜索到则返回为-1
		  if (fileName.lastIndexOf(".") != -1) 
		  {
			  var fileType = (fileName.substring(fileName.lastIndexOf(".") + 1, fileName.length)).toLowerCase();
			  var suppotFile = new Array();
			  suppotFile[0] = "jpg";
			  suppotFile[1] = "gif";
			  suppotFile[2] = "bmp";
			  suppotFile[3] = "png";
			  suppotFile[4] = "jpeg";
			  for (var i = 0; i < suppotFile.length; i++) 
			  {
				  if (suppotFile[i] == fileType) 
				  {
					  return true;
				  } else {
					  continue;
				  }
			  }
			  //alert("文件类型不合法,只能是jpg、gif、bmp、png、jpeg类型！");
			  return false;
		  } 
		  else 
		  {
			  //alert("文件类型不合法,只能是 jpg、gif、bmp、png、jpeg 类型！");
			  return false;
		  }
	  }
  }

	
};

//判断上传图片的类型
jQuery.isPicture = function(fileName) {
	  if (fileName != null && fileName != "") 
	  {
		  //lastIndexOf如果没有搜索到则返回为-1
		  if (fileName.lastIndexOf(".") != -1) 
		  {
			  var fileType = (fileName.substring(fileName.lastIndexOf(".") + 1, fileName.length)).toLowerCase();
			  var suppotFile = new Array();
			  suppotFile[0] = "jpg";
			  suppotFile[1] = "gif";
			  suppotFile[2] = "bmp";
			  suppotFile[3] = "png";
			  suppotFile[4] = "jpeg";
			  for (var i = 0; i < suppotFile.length; i++) 
			  {
				  if (suppotFile[i] == fileType) 
				  {
					  return true;
				  } else {
					  continue;
				  }
			  }
			  //alert("文件类型不合法,只能是jpg、gif、bmp、png、jpeg类型！");
			  return false;
		  } 
		  else 
		  {
			  //alert("文件类型不合法,只能是 jpg、gif、bmp、png、jpeg 类型！");
			  return false;
		  }
	  }
  }
