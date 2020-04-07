var encodeURL,
    show_animation,
    hide_animation,
    apply,
    apply_none,
    apply_img,
    apply_any,
    apply_video,
    apply_link,
    apply_file_rename,
    apply_file_duplicate,
    apply_folder_rename;
!(function (e, a, t) {
    "use strict";

    function r(e) {
        show_animation();
        var a = new Image();
        (a.src = e),
        jQuery(a).on("load", function () {
            hide_animation();
        });
    }

    function i() {
        jQuery("#textfile_create_area")
            .parent()
            .parent()
            .remove(),
            e
            .ajax({
                type: "GET",
                url: "ajax_calls.php?action=new_file_form"
            })
            .done(function (a) {
                bootbox.dialog(
                    a,
                    [{
                            label: jQuery("#cancel").val(),
                            class: "btn"
                        },
                        {
                            label: jQuery("#ok").val(),
                            class: "btn-inverse",
                            callback: function () {
                                var a =
                                    jQuery("#create_text_file_name").val() +
                                    jQuery("#create_text_file_extension").val(),
                                    t = jQuery("#textfile_create_area").val();
                                if (null !== a) {
                                    a = b(a);
                                    var r =
                                        jQuery("#sub_folder").val() + jQuery("#fldr_value").val();
                                    e.ajax({
                                        type: "POST",
                                        url: "execute.php?action=create_file",
                                        data: {
                                            path: r,
                                            name: a,
                                            new_content: t
                                        }
                                    }).done(function (e) {
                                        "" != e &&
                                            bootbox.alert(e, function () {
                                                setTimeout(function () {
                                                    window.location.href =
                                                        jQuery("#refresh").attr("href") +
                                                        "&" +
                                                        new Date().getTime();
                                                }, 500);
                                            });
                                    });
                                }
                            }
                        }
                    ], {
                        header: jQuery("#lang_new_file").val()
                    }
                );
            });
    }

    function n(a) {
        jQuery("#textfile_edit_area")
            .parent()
            .parent()
            .remove();
        var t = a.closest("figure").attr("data-path");
        e.ajax({
            type: "POST",
            url: "ajax_calls.php?action=get_file&sub_action=edit&preview_mode=text",
            data: {
                path: t
            }
        }).done(function (r) {
            bootbox.dialog(
                r,
                [{
                        label: jQuery("#cancel").val(),
                        class: "btn"
                    },
                    {
                        label: jQuery("#ok").val(),
                        class: "btn-inverse",
                        callback: function () {
                            var a = jQuery("#textfile_edit_area").val();
                            window.editor && (a = window.editor.getData()),
                                e
                                .ajax({
                                    type: "POST",
                                    url: "execute.php?action=save_text_file",
                                    data: {
                                        path: t,
                                        new_content: a
                                    }
                                })
                                .done(function (e) {
                                    "" != e && bootbox.alert(e);
                                });
                        }
                    }
                ], {
                    header: a.find(".name_download").val()
                }
            );
        });
    }

    function l() {
        e.ajax({
            type: "POST",
            url: "ajax_calls.php?action=get_lang",
            data: {}
        }).done(function (a) {
            bootbox.dialog(
                a,
                [{
                        label: jQuery("#cancel").val(),
                        class: "btn"
                    },
                    {
                        label: jQuery("#ok").val(),
                        class: "btn-inverse",
                        callback: function () {
                            var a = jQuery("#new_lang_select").val();
                            e.ajax({
                                type: "POST",
                                url: "ajax_calls.php?action=change_lang",
                                data: {
                                    choosen_lang: a
                                }
                            }).done(function (e) {
                                "" != e
                                    ?
                                    bootbox.alert(e) :
                                    setTimeout(function () {
                                        window.location.href =
                                            jQuery("#refresh")
                                            .attr("href")
                                            .replace(/lang=[\w]*&/i, "lang=" + a + "&") +
                                            "&" +
                                            new Date().getTime();
                                    }, 100);
                            });
                        }
                    }
                ], {
                    header: jQuery("#lang_lang_change").val()
                }
            );
        });
    }

    function o(a) {
        jQuery("#files_permission_start")
            .parent()
            .parent()
            .remove();
        var t = a.find(".rename-file-paths"),
            r = a.closest("figure").attr("data-path"),
            i = t.attr("data-permissions"),
            n = t.attr("data-folder");
        e.ajax({
            type: "POST",
            url: "ajax_calls.php?action=chmod",
            data: {
                path: r,
                permissions: i,
                folder: n
            }
        }).done(function (a) {
            bootbox.dialog(
                    a,
                    [{
                            label: jQuery("#cancel").val(),
                            class: "btn"
                        },
                        {
                            label: jQuery("#ok").val(),
                            class: "btn-inverse",
                            callback: function () {
                                var a = "-";
                                (a += jQuery("#u_4").is(":checked") ? "r" : "-"),
                                (a += jQuery("#u_2").is(":checked") ? "w" : "-"),
                                (a += jQuery("#u_1").is(":checked") ? "x" : "-"),
                                (a += jQuery("#g_4").is(":checked") ? "r" : "-"),
                                (a += jQuery("#g_2").is(":checked") ? "w" : "-"),
                                (a += jQuery("#g_1").is(":checked") ? "x" : "-"),
                                (a += jQuery("#a_4").is(":checked") ? "r" : "-"),
                                (a += jQuery("#a_2").is(":checked") ? "w" : "-"),
                                (a += jQuery("#a_1").is(":checked") ? "x" : "-");
                                var i = jQuery("#chmod_form #chmod_value").val();
                                if ("" != i && "undefined" != typeof i) {
                                    var l = jQuery(
                                        "#chmod_form input[name=apply_recursive]:checked"
                                    ).val();
                                    ("" != l && "undefined" != typeof l) || (l = "none"),
                                    e
                                        .ajax({
                                            type: "POST",
                                            url: "execute.php?action=chmod",
                                            data: {
                                                path: r,
                                                new_mode: i,
                                                is_recursive: l,
                                                folder: n
                                            }
                                        })
                                        .done(function (e) {
                                            "" != e
                                                ?
                                                bootbox.alert(e) :
                                                t.attr("data-permissions", a);
                                        });
                                }
                            }
                        }
                    ], {
                        header: jQuery("#lang_file_permission").val()
                    }
                ),
                setTimeout(function () {
                    u(!1);
                }, 100);
        });
    }

    function u(a) {
        var t = [];
        if (
            ((t.user = 0),
                (t.group = 0),
                (t.all = 0),
                "undefined" != typeof a && 1 == a)
        ) {
            var r = jQuery("#chmod_form #chmod_value").val();
            (t.user = r.substr(0, 1)),
            (t.group = r.substr(1, 1)),
            (t.all = r.substr(2, 1)),
            e.each(t, function (a) {
                    ("" == t[a] ||
                        0 == e.isNumeric(t[a]) ||
                        parseInt(t[a]) < 0 ||
                        parseInt(t[a]) > 7) &&
                    (t[a] = "0");
                }),
                jQuery("#chmod_form input:checkbox").each(function () {
                    var e = jQuery(this).attr("data-group"),
                        a = jQuery(this).attr("data-value");
                    c(t[e], a) ?
                        jQuery(this).prop("checked", !0) :
                        jQuery(this).prop("checked", !1);
                });
        } else
            jQuery("#chmod_form input:checkbox:checked").each(function () {
                var e = jQuery(this).attr("data-group"),
                    a = jQuery(this).attr("data-value");
                t[e] = parseInt(t[e]) + parseInt(a);
            }),
            jQuery("#chmod_form #chmod_value").val(
                t.user.toString() + t.group.toString() + t.all.toString()
            );
    }

    function c(a, t) {
        var r = [];
        return (
            (r[1] = [1, 3, 5, 7]),
            (r[2] = [2, 3, 6, 7]),
            (r[4] = [4, 5, 6, 7]),
            (a = parseInt(a)),
            (t = parseInt(t)),
            e.inArray(a, r[t]) != -1
        );
    }

    function s() {
        bootbox.confirm(
            jQuery("#lang_clear_clipboard_confirm").val(),
            jQuery("#cancel").val(),
            jQuery("#ok").val(),
            function (a) {
                1 == a &&
                    e
                    .ajax({
                        type: "POST",
                        url: "ajax_calls.php?action=clear_clipboard",
                        data: {}
                    })
                    .done(function (e) {
                        "" != e ? bootbox.alert(e) : jQuery("#clipboard").val("0"), y(!1);
                    });
            }
        );
    }

    function d(a, t) {
        if ("copy" == t || "cut" == t) {
            var r;
            (r = a.closest("figure").attr("data-path")),
            e
                .ajax({
                    type: "POST",
                    url: "ajax_calls.php?action=copy_cut",
                    data: {
                        path: r,
                        sub_action: t
                    }
                })
                .done(function (e) {
                    "" != e ? bootbox.alert(e) : (jQuery("#clipboard").val("1"), y(!0));
                });
        }
    }

    function f(a) {
        bootbox.confirm(
            jQuery("#lang_paste_confirm").val(),
            jQuery("#cancel").val(),
            jQuery("#ok").val(),
            function (t) {
                if (1 == t) {
                    var r;
                    (r =
                        "undefined" != typeof a ?
                        a.closest("figure").attr("data-path") :
                        jQuery("#sub_folder").val() + jQuery("#fldr_value").val()),
                    e
                        .ajax({
                            type: "POST",
                            url: "execute.php?action=paste_clipboard",
                            data: {
                                path: r
                            }
                        })
                        .done(function (e) {
                            "" != e
                                ?
                                bootbox.alert(e) :
                                (jQuery("#clipboard").val("0"),
                                    y(!1),
                                    setTimeout(function () {
                                        window.location.href =
                                            jQuery("#refresh").attr("href") +
                                            "&" +
                                            new Date().getTime();
                                    }, 300));
                        });
                }
            }
        );
    }

    function p(a, t) {
        var r;
        r = a.hasClass("directory") ?
            a.find(".rename-folder") :
            a.find(".rename-file");
        var i = a.closest("figure").attr("data-path");
        a.parent().hide(100),
            e
            .ajax({
                type: "POST",
                url: "ajax_calls.php?action=copy_cut",
                data: {
                    path: i,
                    sub_action: "cut"
                }
            })
            .done(function (r) {
                if ("" != r) bootbox.alert(r);
                else {
                    var i;
                    (i =
                        "undefined" != typeof t ?
                        t.hasClass("back-directory") ?
                        t.find(".path").val() :
                        t.closest("figure").attr("data-path") :
                        jQuery("#sub_folder").val() + jQuery("#fldr_value").val()),
                    e
                        .ajax({
                            type: "POST",
                            url: "execute.php?action=paste_clipboard",
                            data: {
                                path: i
                            }
                        })
                        .done(function (e) {
                            "" != e
                                ?
                                (bootbox.alert(e), a.parent().show(100)) :
                                (jQuery("#clipboard").val("0"),
                                    y(!1),
                                    a.parent().remove());
                        });
                }
            })
            .error(function () {
                a.parent().show(100);
            });
    }

    function y(e) {
        1 == e ?
            jQuery(".paste-here-btn, .clear-clipboard-btn").removeClass("disabled") :
            jQuery(".paste-here-btn, .clear-clipboard-btn").addClass("disabled");
    }

    function v(e) {
        var t = jQuery(".breadcrumb").width() + e,
            r = jQuery("#view"),
            i = jQuery("#help");
        if (r.val() > 0) {
            if (1 == r.val())
                jQuery("ul.grid li, ul.grid figure").css("width", "100%");
            else {
                var n = Math.floor(t / 380);
                0 == n && ((n = 1), jQuery("h4").css("font-size", 12)),
                    (t = Math.floor(t / n - 3)),
                    jQuery("ul.grid li, ul.grid figure").css("width", t);
            }
            i.hide();
        } else a.touch && i.show();
    }

    function m() {
        var e = jQuery(this);
        0 == jQuery("#view").val() &&
            (1 == e.attr("toggle") ?
                (e.attr("toggle", 0),
                    e.animate({
                        top: "0px"
                    }, {
                        queue: !1,
                        duration: 300
                    })) :
                (e.attr("toggle", 1),
                    e.animate({
                        top: "-30px"
                    }, {
                        queue: !1,
                        duration: 300
                    })));
    }

    function j(e) {
        var a = jQuery("#cur_dir").val();
        a = a.replace("\\", "/");
        var t = jQuery("#sub_folder").val();
        t = t.replace("\\", "/");
        var r = jQuery("#base_url").val(),
            i = jQuery("#fldr_value").val();
        i = i.replace("\\", "/");
        for (
            var n = [],
                l = jQuery("#return_relative_url").val(),
                o = 1 == jQuery("#ftp").val(),
                u = 0; u < e.length; u++
        ) {
            var c = e[u];
            o
                ?
                n.push(
                    encodeURL(
                        jQuery("#ftp_base_url").val() +
                        jQuery("#upload_dir").val() +
                        i +
                        c
                    )
                ) :
                n.push(encodeURL((1 == l ? t + i : r + a) + c));
        }
        return n;
    }

    function h() {
        return 1 == jQuery("#popup").val() ? window.parent : window.parent;
    }

    function Q(e) {
        var a = new RegExp("(?:[?&]|&)" + e + "=([^&]+)", "i"),
            t = window.location.search.match(a);
        return t && t.length > 1 ? t[1] : null;
    }

    function g() {
        1 == jQuery("#popup").val() ?
            window.close() :
            ("function" == typeof parent.jQuery(".modal:has(iframe)").modal &&
                parent.jQuery(".modal:has(iframe)").modal("hide"),
                "undefined" != typeof parent.jQuery && parent.jQuery ?
                "object" == typeof parent.jQuery.fancybox ?
                parent.jQuery.fancybox.getInstance().close() :
                "function" == typeof parent.jQuery.fancybox &&
                parent.jQuery.fancybox.close() :
                "function" == typeof parent.$.fancybox &&
                parent.$.fancybox.close());
    }

    function _(e) {
        for (
            var e,
                a = [
                    /[\300-\306]/g,
                    /[\340-\346]/g,
                    /[\310-\313]/g,
                    /[\350-\353]/g,
                    /[\314-\317]/g,
                    /[\354-\357]/g,
                    /[\322-\330]/g,
                    /[\362-\370]/g,
                    /[\331-\334]/g,
                    /[\371-\374]/g,
                    /[\321]/g,
                    /[\361]/g,
                    /[\307]/g,
                    /[\347]/g
                ],
                t = [
                    "A",
                    "a",
                    "E",
                    "e",
                    "I",
                    "i",
                    "O",
                    "o",
                    "U",
                    "u",
                    "N",
                    "n",
                    "C",
                    "c"
                ],
                r = 0; r < a.length; r++
        )
            e = e.replace(a[r], t[r]);
        return e;
    }

    function b(a) {
        return null != a ?
            ("true" == jQuery("#transliteration").val() &&
                ((a = _(a)), (a = a.replace(/[^A-Za-z0-9\.\-\[\] _]+/g, ""))),
                "true" == jQuery("#convert_spaces").val() &&
                (a = a.replace(/ /g, jQuery("#replace_with").val())),
                "true" == jQuery("#lower_case").val() && (a = a.toLowerCase()),
                (a = a.replace('"', "")),
                (a = a.replace("'", "")),
                (a = a.replace("/", "")),
                (a = a.replace("\\", "")),
                (a = a.replace(/<\/?[^>]+(>|$)/g, "")),
                e.trim(a)) :
            null;
    }

    function w(a, t, r, i, n) {
        null !== r &&
            ((r = b(r)),
                e
                .ajax({
                    type: "POST",
                    url: "execute.php?action=" + a,
                    data: {
                        path: t,
                        name: r.replace("/", "")
                    }
                })
                .done(function (e) {
                    return "" != e ?
                        (bootbox.alert(e), !1) :
                        ("" != n && window[n](i, r), !0);
                }));
    }

    function x(a, t, r, i, n) {
        null !== name &&
            ((name = b(name)),
                e
                .ajax({
                    type: "POST",
                    url: "execute.php?action=" + a,
                    data: {
                        path: t[0],
                        paths: t,
                        names: r
                    }
                })
                .done(function (e) {
                    return "" != e ?
                        (bootbox.alert(e), !1) :
                        ("" != n && window[n](i, name), !0);
                }));
    }

    function k(a, t) {
        var r = jQuery("li.dir", "ul.grid").filter(":visible"),
            i = jQuery("li.file", "ul.grid").filter(":visible"),
            n = [],
            l = [],
            o = [],
            u = [];
        r.each(function () {
                var a = jQuery(this),
                    r = a.find(t).val();
                if (e.isNumeric(r))
                    for (r = parseFloat(r);
                        "undefined" != typeof n[r] && n[r];)
                        r = parseFloat(parseFloat(r) + parseFloat(0.001));
                else r = r + "a" + a.find("h4 a").attr("data-file");
                (n[r] = a.html()), l.push(r);
            }),
            i.each(function () {
                var a = jQuery(this),
                    r = a.find(t).val();
                if (e.isNumeric(r))
                    for (r = parseFloat(r);
                        "undefined" != typeof o[r] && o[r];)
                        r = parseFloat(parseFloat(r) + parseFloat(0.001));
                else r = r + "a" + a.find("h4 a").attr("data-file");
                (o[r] = a.html()), u.push(r);
            }),
            e.isNumeric(l[0]) ?
            l.sort(function (e, a) {
                return parseFloat(e) - parseFloat(a);
            }) :
            l.sort(),
            e.isNumeric(u[0]) ?
            u.sort(function (e, a) {
                return parseFloat(e) - parseFloat(a);
            }) :
            u.sort(),
            a && (l.reverse(), u.reverse()),
            r.each(function (e) {
                jQuery(this).html(n[l[e]]);
            }),
            i.each(function (e) {
                jQuery(this).html(o[u[e]]),
                    jQuery(this).attr(
                        "data-name",
                        jQuery(this)
                        .children()
                        .attr("data-name")
                    );
            });
    }

    function C(e, a) {
        return featherEditor.launch({
            image: e,
            url: a
        }), !1;
    }

    function T() {
        O.update();
    }
    var S = "9.14.0",
        I = !0,
        O = null,
        A = null,
        E = (function () {
            var e = 0;
            return function (a, t) {
                clearTimeout(e), (e = setTimeout(a, t));
            };
        })(),
        P = function (e) {
            if (1 == jQuery("#ftp").val())
                var a =
                    jQuery("#ftp_base_url").val() +
                    jQuery("#upload_dir").val() +
                    jQuery("#fldr_value").val();
            else var a = jQuery("#base_url").val() + jQuery("#cur_dir").val();
            var t = e.find("a.link").attr("data-file");
            return (
                "" != t && null != t && (a += t),
                (t = e.find("h4 a.folder-link").attr("data-file")),
                "" != t && null != t && (a += t),
                a
            );
        },
        U = {
            contextActions: {
                copy_url: function (e) {
                    var a = P(e);
                    bootbox.alert(
                        'URL:<br/><div class="input-append" style="width:100%"><input id="url_text" type="text" style="width:80%; height:30px;" value="' +
                        encodeURL(a) +
                        '" /><button id="copy-button" class="btn btn-inverse copy-button" style="width:20%; height:30px;" data-clipboard-target="#url_text" title="copy"><i class="icon icon-white icon-share"></i> ' +
                        jQuery("#lang_copy").val() +
                        "</button></div>"
                    );
                },
                unzip: function (a) {
                    var t =
                        jQuery("#sub_folder").val() +
                        jQuery("#fldr_value").val() +
                        a.find("a.link").attr("data-file");
                    show_animation(),
                        e
                        .ajax({
                            type: "POST",
                            url: "ajax_calls.php?action=extract",
                            data: {
                                path: t
                            }
                        })
                        .done(function (e) {
                            hide_animation(),
                                "" != e ?
                                bootbox.alert(e) :
                                (window.location.href =
                                    jQuery("#refresh").attr("href") +
                                    "&" +
                                    new Date().getTime());
                        });
                },
                edit_img: function (e) {
                    var a = e.attr("data-name");
                    if (1 == jQuery("#ftp").val())
                        var t =
                            jQuery("#ftp_base_url").val() +
                            jQuery("#upload_dir").val() +
                            jQuery("#fldr_value").val() +
                            a;
                    else var t = jQuery("#base_url").val() + jQuery("#cur_dir").val() + a;
                    var r = jQuery("#aviary_img");
                    r.attr("data-name", a),
                        show_animation(),
                        r.attr("src", t).load(C(r.attr("id"), t));
                },
                duplicate: function (e) {
                    var a = e
                        .find("h4")
                        .text()
                        .trim();
                    bootbox.prompt(
                        jQuery("#lang_duplicate").val(),
                        jQuery("#cancel").val(),
                        jQuery("#ok").val(),
                        function (t) {
                            if (null !== t && ((t = b(t)), t != a)) {
                                var r = e.find(".rename-file");
                                w(
                                    "duplicate_file",
                                    r.attr("data-path"),
                                    t,
                                    r,
                                    "apply_file_duplicate"
                                );
                            }
                        },
                        a + " - copy"
                    );
                },
                select: function (e) {
                    var a,
                        t = P(e),
                        r = jQuery("#field_id").val(),
                        i = jQuery("#return_relative_url").val();
                    if (
                        (1 == i &&
                            ((t = t.replace(jQuery("#base_url").val(), "")),
                                (t = t.replace(jQuery("#cur_dir").val(), ""))),
                            (a = 1 == jQuery("#popup").val() ? window.parent : window.parent),
                            "" != r)
                    )
                        if (1 == jQuery("#crossdomain").val())
                            a.postMessage({
                                    sender: "responsivefilemanager",
                                    url: t,
                                    field_id: r
                                },
                                "*"
                            );
                        else {
                            var n = jQuery("#" + r, a.document);
                            n.val(t).trigger("change"),
                                "function" == typeof a.responsive_filemanager_callback &&
                                a.responsive_filemanager_callback(r),
                                g();
                        }
                    else apply_any(t);
                },
                copy: function (e) {
                    d(e, "copy");
                },
                cut: function (e) {
                    d(e, "cut");
                },
                paste: function () {
                    f();
                },
                chmod: function (e) {
                    o(e);
                },
                edit_text_file: function (e) {
                    n(e);
                }
            },
            makeContextMenu: function () {
                var a = this;
                e.contextMenu({
                        selector: "figure:not(.back-directory), .list-view2 figure:not(.back-directory)",
                        autoHide: !0,
                        build: function (e) {
                            e.addClass("selected");
                            var r = {
                                callback: function (t, r) {
                                    a.contextActions[t](e);
                                },
                                items: {}
                            };
                            return (
                                (e.find(".img-precontainer-mini .filetype").hasClass("png") ||
                                    e.find(".img-precontainer-mini .filetype").hasClass("jpg") ||
                                    e.find(".img-precontainer-mini .filetype").hasClass("jpeg")) &&
                                t &&
                                (r.items.edit_img = {
                                    name: jQuery("#lang_edit_image").val(),
                                    icon: "edit_img",
                                    disabled: !1
                                }),
                                e.hasClass("directory") &&
                                0 != jQuery("#type_param").val() &&
                                (r.items.select = {
                                    name: jQuery("#lang_select").val(),
                                    icon: "",
                                    disabled: !1
                                }),
                                (r.items.copy_url = {
                                    name: jQuery("#lang_show_url").val(),
                                    icon: "url",
                                    disabled: !1
                                }),
                                (e.find(".img-precontainer-mini .filetype").hasClass("zip") ||
                                    e.find(".img-precontainer-mini .filetype").hasClass("tar") ||
                                    e.find(".img-precontainer-mini .filetype").hasClass("gz")) &&
                                1 == jQuery("#extract_files").val() &&
                                (r.items.unzip = {
                                    name: jQuery("#lang_extract").val(),
                                    icon: "extract",
                                    disabled: !1
                                }),
                                e
                                .find(".img-precontainer-mini .filetype")
                                .hasClass("edit-text-file-allowed") &&
                                (r.items.edit_text_file = {
                                    name: jQuery("#lang_edit_file").val(),
                                    icon: "edit",
                                    disabled: !1
                                }),
                                e.hasClass("directory") ||
                                1 != jQuery("#duplicate").val() ||
                                (r.items.duplicate = {
                                    name: jQuery("#lang_duplicate").val(),
                                    icon: "duplicate",
                                    disabled: !1
                                }),
                                e.hasClass("directory") ||
                                1 != jQuery("#copy_cut_files_allowed").val() ?
                                e.hasClass("directory") &&
                                1 == jQuery("#copy_cut_dirs_allowed").val() &&
                                ((r.items.copy = {
                                        name: jQuery("#lang_copy").val(),
                                        icon: "copy",
                                        disabled: !1
                                    }),
                                    (r.items.cut = {
                                        name: jQuery("#lang_cut").val(),
                                        icon: "cut",
                                        disabled: !1
                                    })) :
                                ((r.items.copy = {
                                        name: jQuery("#lang_copy").val(),
                                        icon: "copy",
                                        disabled: !1
                                    }),
                                    (r.items.cut = {
                                        name: jQuery("#lang_cut").val(),
                                        icon: "cut",
                                        disabled: !1
                                    })),
                                0 == jQuery("#clipboard").val() ||
                                e.hasClass("directory") ||
                                (r.items.paste = {
                                    name: jQuery("#lang_paste_here").val(),
                                    icon: "clipboard-apply",
                                    disabled: !1
                                }),
                                e.hasClass("directory") ||
                                1 != jQuery("#chmod_files_allowed").val() ?
                                e.hasClass("directory") &&
                                1 == jQuery("#chmod_dirs_allowed").val() &&
                                (r.items.chmod = {
                                    name: jQuery("#lang_file_permission").val(),
                                    icon: "key",
                                    disabled: !1
                                }) :
                                (r.items.chmod = {
                                    name: jQuery("#lang_file_permission").val(),
                                    icon: "key",
                                    disabled: !1
                                }),
                                (r.items.sep = "----"),
                                (r.items.info = {
                                    name: "<strong>" + jQuery("#lang_file_info").val() + "</strong>",
                                    disabled: !0
                                }),
                                (r.items.name = {
                                    name: e.attr("data-name"),
                                    icon: "label",
                                    disabled: !0
                                }),
                                "img" == e.attr("data-type") &&
                                (r.items.dimension = {
                                    name: e.find(".img-dimension").html(),
                                    icon: "dimension",
                                    disabled: !0
                                }),
                                ("true" !== jQuery("#show_folder_size").val() &&
                                    "true" !== jQuery("#show_folder_size").val()) ||
                                (e.hasClass("directory") ?
                                    (r.items.size = {
                                        name: e.find(".file-size").html() +
                                            " - " +
                                            e.find(".nfiles").val() +
                                            " " +
                                            jQuery("#lang_files").val() +
                                            " - " +
                                            e.find(".nfolders").val() +
                                            " " +
                                            jQuery("#lang_folders").val(),
                                        icon: "size",
                                        disabled: !0
                                    }) :
                                    (r.items.size = {
                                        name: e.find(".file-size").html(),
                                        icon: "size",
                                        disabled: !0
                                    })),
                                (r.items.date = {
                                    name: e.find(".file-date").html(),
                                    icon: "date",
                                    disabled: !0
                                }),
                                r
                            );
                        },
                        events: {
                            hide: function () {
                                jQuery("figure").removeClass("selected");
                            }
                        }
                    }),
                    jQuery(document).on("contextmenu", function (e) {
                        if (!jQuery(e.target).is("figure")) return !1;
                    });
            },
            bindGridEvents: function () {
                function a(e) {
                    var a = e.attr("data-function");
                    "apply_multiple" == a
                        ?
                        (e.find(".selection:visible").trigger("click"),
                            e.find(".selector:visible").trigger("click")) :
                        window[a](e.attr("data-file"), jQuery("#field_id").val());
                }
                var t = jQuery("ul.grid");
                t.on("click", ".modalAV", function (a) {
                        var t = jQuery(this);
                        a.preventDefault();
                        var r = jQuery("#previewAV"),
                            i = jQuery(".body-preview");
                        r.removeData("modal"),
                            r.modal({
                                backdrop: "static",
                                keyboard: !1
                            }),
                            t.hasClass("audio") ?
                            i.css("height", "80px") :
                            i.css("height", "345px"),
                            e.ajax({
                                url: t.attr("data-url"),
                                success: function (e) {
                                    i.html(e);
                                }
                            });
                    }),
                    t.on("click", ".file-preview-btn", function (a) {
                        var t = jQuery(this);
                        a.preventDefault(),
                            e.ajax({
                                url: t.attr("data-url"),
                                success: function (e) {
                                    bootbox.modal(
                                        e,
                                        " " +
                                        t
                                        .parent()
                                        .parent()
                                        .parent()
                                        .find(".name")
                                        .val()
                                    );
                                }
                            });
                    }),
                    t.on("click", ".preview", function () {
                        var e = jQuery(this);
                        return (
                            0 == e.hasClass("disabled") &&
                            jQuery("#full-img").attr(
                                "src",
                                decodeURIComponent(e.attr("data-url"))
                            ),
                            !0
                        );
                    }),
                    t.on("click", ".rename-file", function () {
                        var a = jQuery(this),
                            t = a.closest("figure"),
                            r = t.attr("data-path"),
                            i = t.find("h4"),
                            n = e.trim(i.text());
                        bootbox.prompt(
                            jQuery("#rename").val(),
                            jQuery("#cancel").val(),
                            jQuery("#ok").val(),
                            function (e) {
                                null !== e &&
                                    ((e = b(e)),
                                        e != n && w("rename_file", r, e, t, "apply_file_rename"));
                            },
                            n
                        );
                    }),
                    t.on("click", ".rename-folder", function () {
                        var a = jQuery(this),
                            t = a.closest("figure"),
                            r = t.attr("data-path"),
                            i = t.find("h4"),
                            n = e.trim(i.text());
                        bootbox.prompt(
                            jQuery("#rename").val(),
                            jQuery("#cancel").val(),
                            jQuery("#ok").val(),
                            function (e) {
                                null !== e &&
                                    ((e = b(e).replace(".", "")),
                                        e != n && w("rename_folder", r, e, t, "apply_folder_rename"));
                            },
                            n
                        );
                    }),
                    t.on("click", ".delete-file", function () {
                        var e = jQuery(this),
                            a = e.closest("figure").attr("data-path");
                        bootbox.confirm(
                            e.attr("data-confirm"),
                            jQuery("#cancel").val(),
                            jQuery("#ok").val(),
                            function (t) {
                                if (1 == t) {
                                    w("delete_file", a, "", "", "");
                                    var r = jQuery("#files_number");
                                    r.text(parseInt(r.text()) - 1),
                                        e
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .remove();
                                }
                            }
                        );
                    }),
                    t.on("click", ".delete-folder", function () {
                        var e = jQuery(this),
                            a = e.closest("figure").attr("data-path");
                        bootbox.confirm(
                            e.attr("data-confirm"),
                            jQuery("#cancel").val(),
                            jQuery("#ok").val(),
                            function (t) {
                                if (1 == t) {
                                    w("delete_folder", a, "", "", "");
                                    var r = jQuery("#folders_number");
                                    r.text(parseInt(r.text()) - 1),
                                        e
                                        .parent()
                                        .parent()
                                        .parent()
                                        .remove();
                                }
                            }
                        );
                    }),
                    jQuery("ul.grid").on("click", ".link", function (e) {
                        e.stopPropagation(), a(jQuery(this));
                    }),
                    jQuery("ul.grid").on("click", "div.box", function (e) {
                        var t = jQuery(this).find(".link");
                        if (0 !== t.length) a(t);
                        else {
                            var r = jQuery(this).find(".folder-link");
                            0 !== r.length && (document.location = jQuery(r).prop("href"));
                        }
                    });
            },
            makeFilters: function (a) {
                jQuery("#filter-input")
                    .on("keyup", function () {
                        jQuery(".filters label").removeClass("btn-inverse"),
                            jQuery(".filters label")
                            .find("i")
                            .removeClass("icon-white"),
                            jQuery("#ff-item-type-all").addClass("btn-inverse"),
                            jQuery("#ff-item-type-all")
                            .find("i")
                            .addClass("icon-white");
                        var t = b(jQuery(this).val()).toLowerCase();
                        jQuery(this).val(t),
                            a &&
                            E(function () {
                                jQuery("li", "ul.grid ").each(function () {
                                        var e = jQuery(this);
                                        "" != t &&
                                            e
                                            .attr("data-name")
                                            .toLowerCase()
                                            .indexOf(t) == -1 ?
                                            e.hide(100) :
                                            e.show(100);
                                    }),
                                    e
                                    .ajax({
                                        url: "ajax_calls.php?action=filter&type=" + t
                                    })
                                    .done(function (e) {
                                        "" != e && bootbox.alert(e);
                                    }),
                                    E(function () {
                                        var e = 0 != jQuery("#descending").val();
                                        k(e, "." + jQuery("#sort_by").val()), T();
                                    }, 500);
                            }, 300);
                    })
                    .keypress(function (e) {
                        13 == e.which && jQuery("#filter").trigger("click");
                    }),
                    jQuery("#filter").on("click", function () {
                        var e = b(jQuery("#filter-input").val()),
                            a = jQuery("#current_url").val();
                        (a += a.indexOf("?") >= 0 ? "&" : "?"),
                        (window.location.href = a + "filter=" + e);
                    });
            },
            makeUploader: function () {
                jQuery("#fileupload").fileupload({
                        url: "upload.php",
                        maxChunkSize: 2097152
                    }),
                    jQuery("#fileupload").bind("fileuploaddrop", function (e, a) {
                        jQuery(".uploader").show(200),
                            setTimeout(function () {
                                jQuery(
                                    "#fileupload > div > div.fileupload-buttonbar > div.text-center > button"
                                ).click();
                            }, 200);
                    }),
                    jQuery("#fileupload").bind("fileuploadsubmit", function (e, a) {
                        a.formData = {
                            fldr: jQuery("#sub_folder").val() +
                                jQuery("#fldr_value").val() +
                                (a.files[0].relativePath || a.files[0].webkitRelativePath || "")
                        };
                    }),
                    jQuery("#fileupload").addClass("fileupload-processing"),
                    e
                    .ajax({
                        url: jQuery("#fileupload").fileupload("option", "url"),
                        dataType: "json",
                        context: jQuery("#fileupload")[0]
                    })
                    .always(function () {
                        jQuery(this).removeClass("fileupload-processing");
                    }),
                    jQuery(".upload-btn").on("click", function () {
                        jQuery(".uploader").show(200);
                    }),
                    jQuery(".close-uploader").on("click", function () {
                        jQuery(".uploader").hide(200),
                            setTimeout(function () {
                                window.location.href =
                                    jQuery("#refresh").attr("href") + "&" + new Date().getTime();
                            }, 420);
                    });
            },
            uploadURL: function () {
                jQuery("#uploadURL").on("click", function (a) {
                    a.preventDefault();
                    var t = jQuery("#url").val(),
                        r = jQuery("#fldr_value").val();
                    show_animation(),
                        e
                        .ajax({
                            type: "POST",
                            url: "upload.php",
                            data: {
                                fldr: r,
                                url: t
                            }
                        })
                        .done(function (e) {
                            hide_animation(), jQuery("#url").val("");
                        })
                        .fail(function (e) {
                            bootbox.alert(jQuery("#lang_error_upload").val()),
                                hide_animation(),
                                jQuery("#url").val("");
                        });
                });
            },
            makeSort: function (a) {
                jQuery("input[name=radio-sort]").on("click", function () {
                    var e = jQuery(this).attr("data-item"),
                        r = jQuery("#" + e),
                        i = jQuery(".filters label");
                    i.removeClass("btn-inverse"),
                        i.find("i").removeClass("icon-white"),
                        jQuery("#filter-input").val(""),
                        r.addClass("btn-inverse"),
                        r.find("i").addClass("icon-white"),
                        "ff-item-type-all" == e ?
                        (a ?
                            jQuery(".grid li").show(300) :
                            (window.location.href =
                                jQuery("#current_url").val() +
                                "&sort_by=" +
                                jQuery("#sort_by").val() +
                                "&descending=" +
                                (t ? 1 : 0)),
                            "undefined" != typeof Storage &&
                            localStorage.setItem("sort", "")) :
                        jQuery(this).is(":checked") &&
                        (jQuery(".grid li")
                            .not("." + e)
                            .hide(300),
                            jQuery(".grid li." + e).show(300),
                            "undefined" != typeof Storage &&
                            localStorage.setItem("sort", e)),
                        T();
                });
                var t = jQuery("#descending").val();
                jQuery(".sorter").on("click", function () {
                    var r = jQuery(this);
                    (t = jQuery("#sort_by").val() !== r.attr("data-sort") || 0 == t),
                    a
                        ?
                        (e.ajax({
                                url: "ajax_calls.php?action=sort&sort_by=" +
                                    r.attr("data-sort") +
                                    "&descending=" +
                                    (t ? 1 : 0)
                            }),
                            k(t, "." + r.attr("data-sort")),
                            jQuery(" a.sorter")
                            .removeClass("descending")
                            .removeClass("ascending"),
                            t ?
                            jQuery(".sort-" + r.attr("data-sort")).addClass(
                                "descending"
                            ) :
                            jQuery(".sort-" + r.attr("data-sort")).addClass(
                                "ascending"
                            ),
                            jQuery("#sort_by").val(r.attr("data-sort")),
                            jQuery("#descending").val(t ? 1 : 0),
                            T()) :
                        (window.location.href =
                            jQuery("#current_url").val() +
                            "&sort_by=" +
                            r.attr("data-sort") +
                            "&descending=" +
                            (t ? 1 : 0));
                });
            }
        };
    jQuery(document).ready(function () {
            if (
                (I && U.makeContextMenu(),
                    "undefined" != typeof Storage &&
                    1 != jQuery("#type_param").val() &&
                    3 != jQuery("#type_param").val())
            ) {
                var t = localStorage.getItem("sort");
                if (t) {
                    var n = jQuery("#" + t);
                    n.addClass("btn-inverse"),
                        n.find("i").addClass("icon-white"),
                        jQuery(".grid li")
                        .not("." + t)
                        .hide(300),
                        jQuery(".grid li." + t).show(300);
                }
            }
            if (
                (jQuery(".selector").on("click", function (e) {
                        e.stopPropagation(),
                            jQuery(".selection:checkbox:checked:visible").length > 0 ?
                            jQuery("#multiple-selection").show(300) :
                            jQuery("#multiple-selection").hide(300);
                    }),
                    jQuery("#full-img").on("click", function () {
                        jQuery("#previewLightbox").lightbox("hide");
                    }),
                    jQuery("body").on("click", function () {
                        jQuery(".tip-right").tooltip("hide");
                    }),
                    U.bindGridEvents(),
                    parseInt(jQuery("#file_number").val()) >
                    parseInt(jQuery("#file_number_limit_js").val()))
            )
                var o = !1;
            else var o = !0;
            U.makeSort(o),
                U.makeFilters(o),
                U.uploadURL(),
                jQuery("#info").on("click", function () {
                    bootbox.alert(
                        '<div class="text-center"><br/><img src="img/logo.png" alt="responsive filemanager"/><br/><br/><p><strong>RESPONSIVE filemanager v.' +
                        S +
                        '</strong><br/><a href="http://www.responsivefilemanager.com">responsivefilemanager.com</a></p><br/><p>Copyright © <a href="http://www.tecrail.com" alt="tecrail">Tecrail</a> - Alberto Peripolli. All rights reserved.</p><br/><p>License<br/><small><img alt="Creative Commons License" style="border-width:0" src="https://www.responsivefilemanager.com/license.php" /><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/">Creative Commons Attribution-NonCommercial 3.0 Unported License</a>.</small></p></div>'
                    );
                }),
                jQuery("#change_lang_btn").on("click", function () {
                    l();
                }),
                U.makeUploader(),
                jQuery("body").on("keypress", function (e) {
                    var a = String.fromCharCode(e.which);
                    if ("'" == a || '"' == a || "\\" == a || "/" == a) return !1;
                }),
                jQuery("ul.grid li figcaption").on(
                    "click",
                    'a[data-toggle="lightbox"]',
                    function () {
                        r(decodeURIComponent(jQuery(this).attr("data-url")));
                    }
                ),
                jQuery(".create-file-btn").on("click", function () {
                    i();
                }),
                jQuery(".new-folder").on("click", function () {
                    bootbox.prompt(
                        jQuery("#insert_folder_name").val(),
                        jQuery("#cancel").val(),
                        jQuery("#ok").val(),
                        function (a) {
                            if (null !== a) {
                                a = b(a).replace(".", "");
                                var t = jQuery("#sub_folder").val() + jQuery("#fldr_value").val();
                                e.ajax({
                                    type: "POST",
                                    url: "execute.php?action=create_folder",
                                    data: {
                                        path: t,
                                        name: a
                                    }
                                }).done(function (e) {
                                    e
                                        ?
                                        bootbox.alert(jQuery("#rename_existing_folder").val()) :
                                        setTimeout(function () {
                                            window.location.href =
                                                jQuery("#refresh").attr("href") +
                                                "&" +
                                                new Date().getTime();
                                        }, 300);
                                });
                            }
                        }
                    );
                }),
                jQuery(".view-controller button").on("click", function () {
                    var a = jQuery(this);
                    jQuery(".view-controller button").removeClass("btn-inverse"),
                        jQuery(".view-controller i").removeClass("icon-white"),
                        a.addClass("btn-inverse"),
                        a.find("i").addClass("icon-white"),
                        e
                        .ajax({
                            url: "ajax_calls.php?action=view&type=" + a.attr("data-value")
                        })
                        .done(function (e) {
                            "" != e && bootbox.alert(e);
                        }),
                        "undefined" != typeof jQuery("ul.grid")[0] &&
                        jQuery("ul.grid")[0] &&
                        (jQuery("ul.grid")[0].className = jQuery(
                            "ul.grid"
                        )[0].className.replace(/\blist-view.*?\b/g, "")),
                        "undefined" != typeof jQuery(".sorter-container")[0] &&
                        jQuery(".sorter-container")[0] &&
                        (jQuery(".sorter-container")[0].className = jQuery(
                            ".sorter-container"
                        )[0].className.replace(/\blist-view.*?\b/g, ""));
                    var t = a.attr("data-value");
                    jQuery("#view").val(t),
                        jQuery("ul.grid").addClass("list-view" + t),
                        jQuery(".sorter-container").addClass("list-view" + t),
                        a.attr("data-value") >= 1 ?
                        v(14) :
                        (jQuery("ul.grid li").css("width", 126),
                            jQuery("ul.grid figure").css("width", 122)),
                        T();
                }),
                a.touch ?
                (jQuery("#help").show(),
                    jQuery(".box:not(.no-effect)").swipe({
                        swipeLeft: m,
                        swipeRight: m,
                        threshold: 30
                    })) :
                (jQuery(".tip").tooltip({
                        placement: "bottom"
                    }),
                    jQuery(".tip-top").tooltip({
                        placement: "top"
                    }),
                    jQuery(".tip-left").tooltip({
                        placement: "left"
                    }),
                    jQuery(".tip-right").tooltip({
                        placement: "right"
                    }),
                    jQuery("body").addClass("no-touch")),
                jQuery(".paste-here-btn").on("click", function () {
                    0 == jQuery(this).hasClass("disabled") && f();
                }),
                jQuery(".clear-clipboard-btn").on("click", function () {
                    0 == jQuery(this).hasClass("disabled") && s();
                });
            var c = function (e) {
                var a = [];
                return (
                    jQuery(".selection:checkbox:checked:visible").each(function () {
                        var t = jQuery(this).val();
                        e &&
                            (t = jQuery(this)
                                .closest("figure")
                                .attr("data-path")),
                            a.push(t);
                    }),
                    a
                );
            };
            if (
                (jQuery(".multiple-action-btn").on("click", function () {
                        var e = c();
                        window[jQuery(this).attr("data-function")](
                            e,
                            jQuery("#field_id").val()
                        );
                    }),
                    jQuery(".multiple-deselect-btn").on("click", function () {
                        e(".selection:checkbox").removeAttr("checked"),
                            jQuery("#multiple-selection").hide(300);
                    }),
                    jQuery(".multiple-select-btn").on("click", function () {
                        e(".selection:checkbox:visible").prop("checked", !0);
                    }),
                    jQuery(".multiple-delete-btn").on("click", function () {
                        if (0 != jQuery(".selection:checkbox:checked:visible").length) {
                            var e = jQuery(this);
                            bootbox.confirm(
                                e.attr("data-confirm"),
                                jQuery("#cancel").val(),
                                jQuery("#ok").val(),
                                function (e) {
                                    if (1 == e) {
                                        var a = c(!0);
                                        x("delete_files", a, "", "", "");
                                        var t = jQuery("#files_number");
                                        t.text(parseInt(t.text()) - a.length),
                                            jQuery(".selection:checkbox:checked:visible").each(
                                                function () {
                                                    jQuery(this)
                                                        .closest("li")
                                                        .remove();
                                                }
                                            ),
                                            jQuery("#multiple-selection").hide(300);
                                    }
                                }
                            );
                        }
                    }),
                    !a.csstransforms)
            ) {
                var d = jQuery("figure");
                d.on("mouseover", function () {
                        0 == jQuery("#view").val() &&
                            jQuery("#main-item-container").hasClass("no-effect-slide") === !1 &&
                            jQuery(this)
                            .find(".box:not(.no-effect)")
                            .animate({
                                top: "-26px"
                            }, {
                                queue: !1,
                                duration: 300
                            });
                    }),
                    d.on("mouseout", function () {
                        0 == jQuery("#view").val() &&
                            jQuery(this)
                            .find(".box:not(.no-effect)")
                            .animate({
                                top: "0px"
                            }, {
                                queue: !1,
                                duration: 300
                            });
                    });
            }
            jQuery(window).resize(function () {
                    v(28);
                }),
                v(14),
                y(1 == jQuery("#clipboard").val() ? !0 : !1),
                jQuery("li.dir, li.file").draggable({
                    distance: 20,
                    cursor: "move",
                    helper: function () {
                        jQuery(this)
                            .find("figure")
                            .find(".box")
                            .css("top", "0px");
                        var e = jQuery(this)
                            .clone()
                            .css("z-index", 1e3)
                            .find(".box")
                            .css("box-shadow", "none")
                            .css("-webkit-box-shadow", "none")
                            .parent()
                            .parent();
                        return jQuery(this).addClass("selected"), e;
                    },
                    start: function (e, a) {
                        jQuery(a.helper).addClass("ui-draggable-helper"),
                            0 == jQuery("#view").val() &&
                            jQuery("#main-item-container").addClass("no-effect-slide");
                    },
                    stop: function () {
                        jQuery(this).removeClass("selected"),
                            0 == jQuery("#view").val() &&
                            jQuery("#main-item-container").removeClass("no-effect-slide");
                    }
                }),
                jQuery("li.dir,li.back").droppable({
                    accept: "ul.grid li",
                    activeClass: "ui-state-highlight",
                    hoverClass: "ui-state-hover",
                    drop: function (e, a) {
                        p(a.draggable.find("figure"), jQuery(this).find("figure"));
                    }
                }),
                jQuery(document).on("keyup", "#chmod_form #chmod_value", function () {
                    u(!0);
                }),
                jQuery(document).on("change", "#chmod_form input", function () {
                    u(!1);
                }),
                jQuery(document).on("focusout", "#chmod_form #chmod_value", function () {
                    var e = jQuery("#chmod_form #chmod_value");
                    null == e.val().match(/^[0-7]{3}$/) &&
                        (e.val(e.attr("data-def-value")), u(!0));
                }),
                (O = new LazyLoad()),
                (A = new Clipboard(".btn"));
        }),
        (encodeURL = function (e) {
            for (var a = e.split("/"), t = 3; t < a.length; t++)
                a[t] = encodeURIComponent(a[t]);
            return a.join("/");
        }),
        (apply = function (a, t) {
            var r = h(),
                i = jQuery("#callback").val(),
                n = "",
                l = ["ogg", "mp3", "wav"],
                o = ["mp4", "ogg", "webm"];
            Array.isArray(a) || (a = new Array(a));
            var u = j(a),
                c = JSON.stringify(u);
            if ((1 == u.length && (c = u[0]), "" != t))
                if (1 == jQuery("#crossdomain").val())
                    r.postMessage({
                            sender: "responsivefilemanager",
                            url: c,
                            field_id: t
                        },
                        "*"
                    );
                else {
                    var s = jQuery("#" + t, r.document);
                    s.val(c).trigger("change"),
                        0 == i ?
                        "function" == typeof r.responsive_filemanager_callback &&
                        r.responsive_filemanager_callback(t) :
                        "function" == typeof r[i] && r[i](t),
                        g();
                }
            else {
                for (var d = 0; d < u.length; d++) {
                    var f = a[d],
                        p = f.substr(0, f.lastIndexOf(".")),
                        y = f.split(".").pop();
                    y = y.toLowerCase();
                    var v = u[d];
                    e.inArray(y, ext_img) > -1 ?
                        (jQuery("#add_time_to_img").val() &&
                            (v = v + "?" + new Date().getTime()),
                            (n += '<img src="' + v + '" alt="' + p + '" /> ')) :
                        e.inArray(y, o) > -1 ?
                        (n +=
                            '<video controls source src="' +
                            v +
                            '" type="video/' +
                            y +
                            '">' +
                            p +
                            "</video> ") :
                        e.inArray(y, l) > -1 ?
                        ("mp3" == y && (y = "mpeg"),
                            (n +=
                                '<audio controls src="' +
                                v +
                                '" type="audio/' +
                                y +
                                '">' +
                                p +
                                "</audio> ")) :
                        (n += '<a href="' + v + '" title="' + p + '">' + p + "</a> ");
                }
                1 == jQuery("#crossdomain").val() ?
                    r.postMessage({
                            sender: "responsivefilemanager",
                            url: c,
                            field_id: null,
                            html: n
                        },
                        "*"
                    ) :
                    parent.tinymce.majorVersion < 4 ?
                    (parent.tinymce.activeEditor.execCommand("mceInsertContent", !1, n),
                        parent.tinymce.activeEditor.windowManager.close(
                            parent.tinymce.activeEditor.windowManager.params.mce_window_id
                        )) :
                    (parent.tinymce.activeEditor.insertContent(n),
                        parent.tinymce.activeEditor.windowManager.close());
            }
        }),
        (apply_link = function (e, a) {
            var t = h(),
                r = jQuery("#callback").val();
            Array.isArray(e) || (e = new Array(e));
            var i = j(e),
                n = JSON.stringify(i);
            if ((1 == i.length && (n = i[0]), "" != a))
                if (1 == jQuery("#crossdomain").val())
                    t.postMessage({
                            sender: "responsivefilemanager",
                            url: i[0],
                            field_id: a
                        },
                        "*"
                    );
                else {
                    var l = jQuery("#" + a, t.document);
                    l.val(n).trigger("change"),
                        0 == r ?
                        "function" == typeof t.responsive_filemanager_callback &&
                        t.responsive_filemanager_callback(a) :
                        "function" == typeof t[r] && t[r](a),
                        g();
                }
            else apply_any(i[0]);
        }),
        (apply_img = function (e, a) {
            var t = h(),
                r = jQuery("#callback").val();
            Array.isArray(e) || (e = new Array(e));
            var i = j(e),
                n = JSON.stringify(i);
            if ((1 == i.length && (n = i[0]), "" != a))
                if (1 == jQuery("#crossdomain").val())
                    t.postMessage({
                            sender: "responsivefilemanager",
                            url: i[0],
                            field_id: a
                        },
                        "*"
                    );
                else {
                    var l = jQuery("#" + a, t.document);
                    l.val(n).trigger("change"),
                        0 == r ?
                        "function" == typeof t.responsive_filemanager_callback &&
                        t.responsive_filemanager_callback(a) :
                        "function" == typeof t[r] && t[r](a),
                        g();
                }
            else {
                if (jQuery("#add_time_to_img").val())
                    var o = i[0] + "?" + new Date().getTime();
                else o = i[0];
                apply_any(o);
            }
        }),
        (apply_video = function (e, a) {
            var t = h(),
                r = jQuery("#callback").val();
            Array.isArray(e) || (e = new Array(e));
            var i = j(e),
                n = JSON.stringify(i);
            if ((1 == i.length && (n = i[0]), "" != a))
                if (1 == jQuery("#crossdomain").val())
                    t.postMessage({
                            sender: "responsivefilemanager",
                            url: i[0],
                            field_id: a
                        },
                        "*"
                    );
                else {
                    var l = jQuery("#" + a, t.document);
                    l.val(n).trigger("change"),
                        0 == r ?
                        "function" == typeof t.responsive_filemanager_callback &&
                        t.responsive_filemanager_callback(a) :
                        "function" == typeof t[r] && t[r](a),
                        g();
                }
            else apply_any(i[0]);
        }),
        (apply_none = function (e) {
            var a = jQuery("ul.grid").find('li[data-name="' + e + '"] figcaption a');
            a[1].click(), jQuery(".tip-right").tooltip("hide");
        }),
        (apply_any = function (e) {
            if (1 == jQuery("#crossdomain").val())
                window.parent.postMessage({
                        sender: "responsivefilemanager",
                        url: e,
                        field_id: null
                    },
                    "*"
                );
            else {
                var a = jQuery("#editor").val();
                if ("ckeditor" == a) {
                    var t = Q("CKEditorFuncNum");
                    var closeWindow = Q("CKEditorCleanUpFuncNum");
                    window.parent.CKEDITOR.tools.callFunction(t, e), window.close();
                    window.parent.CKEDITOR.tools.callFunction(closeWindow, e);


                } else
                    parent.tinymce.majorVersion < 4 ?
                    (parent.tinymce.activeEditor.windowManager.params.setUrl(e),
                        parent.tinymce.activeEditor.windowManager.close(
                            parent.tinymce.activeEditor.windowManager.params.mce_window_id
                        )) :
                    (parent.tinymce.activeEditor.windowManager.getParams().setUrl(e),
                        parent.tinymce.activeEditor.windowManager.close());
            }
        }),
        (apply_file_duplicate = function (e, a) {
            var t = e
                .parent()
                .parent()
                .parent()
                .parent();
            t.after(
                "<li class='" +
                t.attr("class") +
                "' data-name='" +
                t.attr("data-name") +
                "'>" +
                t.html() +
                "</li>"
            );
            var r = t.next();
            apply_file_rename(r.find("figure"), a);
            var i = r.find(".download-form"),
                n = "form" + new Date().getTime();
            i.attr("id", n),
                i.find(".tip-right").attr("onclick", "jQuery('#" + n + "').submit();");
        }),
        (apply_file_rename = function (e, a) {
            var t;
            e.attr("data-name", a),
                e.parent().attr("data-name", a),
                e.find("h4").text(a);
            var r = e.find("a.link");
            t = r.attr("data-file");
            var i = t.substring(t.lastIndexOf("/") + 1),
                n = t.substring(t.lastIndexOf(".") + 1);
            (n = n ? "." + n : ""),
            r.each(function () {
                    jQuery(this).attr("data-file", encodeURIComponent(a + n));
                }),
                e.find("img").each(function () {
                    var e = jQuery(this).attr("src");
                    if (e)
                        jQuery(this).attr(
                            "src",
                            e.replace(i, a + n) + "?time=" + new Date().getTime()
                        );
                    else {
                        var e = jQuery(this).attr("data-src");
                        jQuery(this).attr(
                            "data-src",
                            e.replace(i, a + n) + "?time=" + new Date().getTime()
                        );
                    }
                    jQuery(this).attr("alt", a + " thumbnails");
                });
            var l = e.find("a.preview");
            (t = l.attr("data-url")),
            "undefined" != typeof t &&
                t &&
                l.attr(
                    "data-url",
                    t.replace(encodeURIComponent(i), encodeURIComponent(a + n))
                ),
                e.parent().attr("data-name", a + n),
                e.attr("data-name", a + n),
                e.find(".name_download").val(a + n);
            var o = e.attr("data-path"),
                u = o.replace(i, a + n);
            e.attr("data-path", u);
        }),
        (apply_folder_rename = function (e, a) {
            e.attr("data-name", a), e.find("figure").attr("data-name", a);
            var t = e
                .find("h4")
                .find("a")
                .text();
            e.find("h4 > a").text(a);
            var r = e.find(".folder-link"),
                i = r.attr("href"),
                n = jQuery("#fldr_value").val(),
                l = i.replace(
                    "fldr=" + n + encodeURIComponent(t),
                    "fldr=" + n + encodeURIComponent(a)
                );
            r.each(function () {
                jQuery(this).attr("href", l);
            });
            var o = e.attr("data-path"),
                u = o.lastIndexOf("/"),
                c = o.substr(0, u + 1) + a;
            e.attr("data-path", c);
        }),
        (show_animation = function () {
            jQuery("#loading_container").css("display", "block"),
                jQuery("#loading").css("opacity", ".7");
        }),
        (hide_animation = function () {
            jQuery("#loading_container").fadeOut();
        });
})(jQuery, Modernizr, image_editor),
(function () {
    function e(e, a) {
        a = a || {
            bubbles: !1,
            cancelable: !1,
            detail: void 0
        };
        var t = document.createEvent("CustomEvent");
        return t.initCustomEvent(e, a.bubbles, a.cancelable, a.detail), t;
    }
    return (
        "function" != typeof window.CustomEvent &&
        ((e.prototype = window.Event.prototype), void(window.CustomEvent = e))
    );
})();