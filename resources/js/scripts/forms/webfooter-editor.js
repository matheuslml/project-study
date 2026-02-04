/*=========================================================================================
	File Name: form-quill-editor.js
	Description: Quill is a modern rich text editor built for compatibility and extensibility.
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function(window, document, $) {
    'use strict';

    var Font = Quill.import('formats/font');
    Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
    Quill.register(Font, true);

    // Full Editor


    var fullEditorLeft = new Quill('#full-container-left .editor-left', {
        bounds: '#full-container-left .editor-left',
        modules: {
            formula: true,
            syntax: true,
            toolbar: [
                [{
                        font: []
                    },
                    {
                        size: []
                    }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                        color: []
                    },
                    {
                        background: []
                    }
                ],
                [{
                        script: 'super'
                    },
                    {
                        script: 'sub'
                    }
                ],
                [{
                        header: '1'
                    },
                    {
                        header: '2'
                    },
                    'blockquote',
                    'code-block'
                ],
                [{
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    },
                    {
                        indent: '-1'
                    },
                    {
                        indent: '+1'
                    }
                ],
                [
                    'direction',
                    {
                        align: []
                    }
                ],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ]
        },
        theme: 'snow'
    });

    var fullEditor = new Quill('#full-container-right .editor-right', {
        bounds: '#full-container-right .editor-right',
        modules: {
            formula: true,
            syntax: true,
            toolbar: [
                [{
                        font: []
                    },
                    {
                        size: []
                    }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                        color: []
                    },
                    {
                        background: []
                    }
                ],
                [{
                        script: 'super'
                    },
                    {
                        script: 'sub'
                    }
                ],
                [{
                        header: '1'
                    },
                    {
                        header: '2'
                    },
                    'blockquote',
                    'code-block'
                ],
                [{
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    },
                    {
                        indent: '-1'
                    },
                    {
                        indent: '+1'
                    }
                ],
                [
                    'direction',
                    {
                        align: []
                    }
                ],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ]
        },
        theme: 'snow'
    });


    fullEditorLeft.on('text-change', function(delta, oldDelta, source) {
        if (source == 'api') {
            $('#content_left').text($(".editor-left .ql-editor").html());
        } else if (source == 'user') {
            $('#content_left').text($(".editor-left .ql-editor").html());
        }
    });

    fullEditor.on('text-change', function(delta, oldDelta, source) {
        if (source == 'api') {
            $('#content_right').text($(".editor-right .ql-editor").html());
        } else if (source == 'user') {
            $('#content_right').text($(".editor-right .ql-editor").html());
        }
    });

})(window, document, jQuery);
