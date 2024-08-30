$(function () {
    // $(".tags_select_choose").select2({
    //     tags: true,
    //     tokenSeparators: [','],
    //     ajax: {
    //         url: '/api/tags',
    //         dataType: 'json',
    //         delay: 250,
    //         processResults: function (data) {
    //             return {
    //                 results: data.map(function (item) {
    //                     return { text: item.name };
    //                 })
    //             };
    //         },
    //         cache: true //Bật bộ nhớ đệm
    //     },
    //     minimumInputLength: 1 // Số ký tự tối thiểu để bắt đầu tìm kiếm
    // });

    // $(".tags_select_choose").each(function(index, element) {
    //     $(this).select2({
    //         tags: true,
    //         width: "100%", // just for stack-snippet to show properly
    //         ajax: {
    //             url: '/api/tags',
    //             dataType: 'json',
    //             delay: 250,
    //             data: function (params) {
    //                 return {
    //                     q: params.term // search term
    //                 };
    //             },
    //             processResults: function (data) {
    //                 return {
    //                     results: data.map(function (item) {
    //                         return { id: item.id, text: item.name };
    //                     })
    //                 };
    //             },
    //             cache: true
    //         },
    //         minimumInputLength: 1
    //     });
    // });


    $(".tags_select_choose").select2({
        tags: true,
        tokenSeparators: [','],
        ajax: {
            url: '/api/tags',
            dataType: 'json',
            delay: 150,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {id: item.name, text: item.name };
                    })
                };
            },
            cache: true
        },
        createTag: function (params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            };
        },
        minimumInputLength: 1
    });

    $(".select2_init").select2({
        placeholder: "Chọn Danh Mục",
        allowClear: true
    });



    let editor_config = {
        path_absolute : "/",
        selector: 'textarea.tinymce_editor_init',
        height:350,
        relative_urls: false,
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table directionality",
          "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        file_picker_callback : function(callback, value, meta) {
          let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
          let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

          let cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
          if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
          } else {
            cmsURL = cmsURL + "&type=Files";
          }

          tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
              callback(message.content);
            }
          });
        }
      };

      tinymce.init(editor_config);
});


