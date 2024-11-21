$(function () {
    //初始化绑定默认的属性
    $.upLoadDefaults = $.upLoadDefaults || {};
    $.upLoadDefaults.property = {
        multiple: false, //是否多文件
        water: false, //是否加水印
        thumbnail: false, //是否生成缩略图
        sendurl: "sendurl", //发送地址
        filetypes: "jpg,jpeg,png,gif,bmp", //文件类型
        filesize: "", //文件大小
        btntext: "上传图片", //上传按钮的文字
        swf: "/js/webuploader/uploader.swf", //SWF上传控件相对地址
        imgUrl: "",
        imgId: "",
        headPic: "",
        picType: "",
        multipleobj:""
    };
    //初始化上传控件
    $.fn.InitUploader = function (p) {
        var fun = function (parentObj) {
            p = $.extend({}, $.upLoadDefaults.property, p || {});
            var btnObj = $('<div class="upload-btn">' + p.btntext + '</div>').appendTo(parentObj);
            //初始化属性
            p.sendurl += "?action=UpLoadFile";
            if (p.water) {
                p.sendurl += "&IsWater=1";
            }
            if (p.thumbnail) {
                p.sendurl += "&IsThumbnail=1";
            }
            if (!p.multiple) {
                p.sendurl += "&DelFilePath=" + parentObj.siblings(".upload-path").val();
            }
            p.sendurl += "&picType=" + p.picType;
            //初始化WebUploader
            var uploader = WebUploader.create({
                method: 'POST',
                auto: true, //自动上传
                swf: p.swf, //SWF路径
                server: p.sendurl, //上传地址
                pick: {
                    id: btnObj,
                    multiple: p.multiple
                },
                accept: {
                    /*title: 'Images',*/
                    extensions: p.filetypes
                    /*mimeTypes: 'image/*'*/
                },
                formData: {
                    'DelFilePath': '' //定义参数
                },
                fileVal: 'Filedata', //上传域的名称
                fileSingleSizeLimit: p.filesize * 1024, //文件大小
                fileNumLimit: 100
            });

            //当validate不通过时，会以派送错误事件的形式通知
            uploader.on('error', function (type) {
                switch (type) {
                    case 'Q_EXCEED_NUM_LIMIT':
                        alert("错误：上传文件数量过多！");
                        break;
                    case 'Q_EXCEED_SIZE_LIMIT':
                        alert("错误：文件总大小超出限制！");
                        break;
                    case 'F_EXCEED_SIZE':
                        alert("错误：文件大小超出限制！");
                        break;
                    case 'Q_TYPE_DENIED':
                        //alert("错误：禁止上传该类型文件！");
                        //break;
                    case 'F_DUPLICATE':
                        alert("错误：请勿重复上传该文件！");
                        break;
                    default:
                        alert('错误代码：' + type);
                        break;
                }
            });
            //当文件被加入队列之前触发
            uploader.on('beforeFileQueued', function (file) {
                //验证图片数量
                if ($("#manyPhoto").find('li').length > 5) {
                    alert("晒图最多只能上传5张图片！");
                    return false;
                }
            });
            //当有文件添加进来的时候
            uploader.on('fileQueued', function (file) {

                //如果是单文件上传，把旧的文件地址传过去
                if (!p.multiple) {
                    uploader.options.formData.DelFilePath = parentObj.siblings(".upload-path").val();
                }
                //防止重复创建
                if (parentObj.children(".upload-progress").length == 0) {
                    //创建进度条
                    var fileProgressObj = $('<div class="upload-progress"></div>').appendTo(parentObj);
                    var progressText = $('<span class="txt">正在上传，请稍候...</span>').appendTo(fileProgressObj);
                    var progressBar = $('<span class="bar"><b></b></span>').appendTo(fileProgressObj);
                    var progressCancel = $('<a class="close" title="取消上传">关闭</a>').appendTo(fileProgressObj);
                    //绑定点击事件
                    progressCancel.click(function () {
                        uploader.cancelFile(file);
                        fileProgressObj.remove();
                    });
                }
            });
            //文件上传过程中创建进度条实时显示
            uploader.on('uploadProgress', function (file, percentage) {
                var progressObj = parentObj.children(".upload-progress");
                progressObj.children(".txt").html(file.name);
                progressObj.find(".bar b").width(percentage * 100 + "%");
            });
            //当文件上传出错时触发
            uploader.on('uploadError', function (file, reason) {
                uploader.removeFile(file); //从队列中移除
                alert(file.name + "上传失败，错误代码：" + reason);
            });
            //当文件上传成功时触发
            uploader.on('uploadSuccess', function (file, data) {
                if (data.status == '0') {
                    var progressObj = parentObj.children(".upload-progress");
                    progressObj.children(".txt").html(data.msg);
                }
                if (data.status == '1') {
                    //如果是单文件上传，则赋值相应的表单
                    if (!p.multiple) {
                        //parentObj.siblings(".upload-name").val(data.name);
                        //parentObj.siblings(".upload-path").val(data.path);
                        //parentObj.siblings(".upload-size").val(data.size);
                        $("#" + p.imgId).attr("src", p.imgUrl + data.path);
                        $("#" + p.headPic).val(data.path);
                        if ($('.dingwzh') && $(".uppictnew")) {
                            $('.dingwzh').show();
                            $(".uppictnew").hide();
                        }
                    } else {
                        addImage(p.multipleobj, data.path, data.path, p.imgUrl);
                    }
                    var progressObj = parentObj.children(".upload-progress");
                    progressObj.children(".txt").html("上传成功：" + file.name);
                }
                uploader.removeFile(file); //从队列中移除
            });

            //不管成功或者失败，文件上传完成时触发
            uploader.on('uploadComplete', function (file) {
                var progressObj = parentObj.children(".upload-progress");
                progressObj.children(".txt").html("上传完成");
                //如果队列为空，则移除进度条
                if (uploader.getStats().queueNum == 0) {
                    progressObj.remove();
                }
            });
        };
        return $(this).each(function () {
            fun($(this));
        });
    }
});

/*图片相册处理事件
=====================================================*/
//添加图片相册
function addImage(targetObj, originalSrc, thumbSrc, imgUrl) {
    //插入到相册UL里面
    var newLi = $('<li class="weui-uploader__file" onclick="delImg(this);">'
    + '<input type="hidden" name="hid_photo_name[]" value="' + originalSrc + '" />'
    + '<div class="img-box" onclick="setFocusImg(this);">'
    + '<img src="' + imgUrl + thumbSrc + '" width="77" height="77" bigsrc="' + imgUrl + originalSrc + '" />'
    //+ '<span class="remark"><i>暂无描述...</i></span>'
    + '</div>'
    //+ '<a href="javascript:;" onclick="setRemark(this);">描述</a>'
    + '</li>');
    newLi.appendTo(targetObj);

    //默认第一个为相册封面
    var focusPhotoObj = targetObj.siblings(".focus-photo");
    if (focusPhotoObj.val() == "") {
        focusPhotoObj.val(thumbSrc);
        newLi.children(".img-box").addClass("selected");
    }
}
//设置相册封面
function setFocusImg(obj) {
    var focusPhotoObj = $(obj).parents(".photo-list").siblings(".focus-photo");
    focusPhotoObj.val($(obj).children("img").eq(0).attr("src"));
    $(obj).parent().siblings().children(".img-box").removeClass("selected");
    $(obj).addClass("selected");
}
//删除图片LI节点
function delImg(obj) {
    $(obj).remove(); //删除的LI节点
}