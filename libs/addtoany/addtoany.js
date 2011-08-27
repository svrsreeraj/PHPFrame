var a2a_config = a2a_config || {};
a2a_config.vars = {
    vars: ["menu_type", "static_server", ["linkname", document.title || location.href], ["linkurl", location.href], "linkname_escape", ["ssl", ("https:" == document.location.protocol) ? "https://static.addtoany.com/menu": false], "show_title", "onclick", "num_services", "hide_embeds", "prioritize", "custom_services", ["templates", {}], "orientation", ["track_links", false], ["track_links_key", ""], "awesm", "tracking_callback", "track_pub", "color_main", "color_bg", "color_border", "color_link_text", "color_link_text_hover", "color_arrow", "color_arrow_hover", ["border_size", 8], ["localize", "", 1], ["add_services", false, 1], "locale", "delay", "no_3p", "show_menu", "target"],
    process: function() {
        var j = a2a_config.vars.vars;
        for (var g = 0, k = "a2a_", d = j.length, c, f, a, l, b; g < d; g++) {
            if (typeof j[g] == "string") {
                c = j[g];
                f = window[k + c];
                l = false
            } else {
                c = j[g][0];
                f = window[k + c];
                a = j[g][1];
                l = true;
                b = j[g][2]
                }
            if (typeof f != "undefined" && f != null) {
                a2a_config[c] = f;
                if (!b) {
                    try {
                        delete window[k + c]
                        } catch(h) {
                        window[k + c] = null
                    }
                }
            } else {
                if (l && !a2a_config[c]) {
                    a2a_config[c] = a
                }
            }
        }
    }
};
a2a_config.vars.process();
a2a_config.static_server = a2a_config.static_server || ((a2a_config.ssl) ? a2a_config.ssl: "http://static.addtoany.com/menu");
a2a_config.email_menu = (a2a_config.menu_type == "mail") ? 1: false;
var a2a = a2a || {
    total: 0,
    kit_services: [],
    icons_img_url: a2a_config.static_server + "/icons_19.png",
    head_tag: document.getElementsByTagName("head")[0],
    fn_queue: [],
    init: function(b, a, f) {
        var d = a2a.c,
        a = a || {},
        n = {},
        m = null,
        e,
        c = {},
        h,
        j,
        i,
        k,
        g = location.href;
        function l(p, q) {
            a2a.total++;
            a2a.n = a2a.total;
            a2a["n" + a2a.n] = p;
            var o = p.node = a2a.set_this_index(p.node),
            r = document.createElement("div"),
            t,
            s;
            if (!o) {
                if (!a2a.c.show_menu) {
                    a2a.total--
                }
                return
            }
            if (p.linkname_escape) {
                s = a2a.getByClass("a2a_linkname_escape", o.parentNode)[0];
                if (s) {
                    d.linkname = s.innerHTML
                }
            }
            r.innerHTML = d.linkname;
            t = r.childNodes[0];
            if (t) {
                p.linkname = t.nodeValue
            }
            delete r;
            if (o.a2a_kit) {
                a2a.kit(p, q)
                } else {
                a2a.button(p)
                }
        }
        for (h in a) {
            d[h] = a[h]
            }
        for (h in d) {
            n[h] = d[h]
            }
        j = d.target;
        if (j) {
            if (typeof j == "string") {
                i = j.substr(0, 1);
                k = j.substr(1);
                if (i == ".") {
                    a2a.multi_init(a2a.HTMLcollToArray(a2a.getByClass(k, document)), b, a);
                    d.target = false;
                    return
                } else {
                    m = a2a.gEl(k);
                    e = m.className;
                    if (e.indexOf("a2a_kit") >= 0 && e.indexOf("a2a_target") < 0) {
                        m = null
                    }
                }
            } else {
                m = d.target
            }
        }
        if (d.menu_type == "mail") {
            d.email_menu = 1;
            a2a.make_once()
            }
        b = (d.email_menu) ? "mail": b;
        if (b) {
            a2a.type = b;
            d.vars.process()
            }
        c.type = a2a.type;
        c.node = m;
        window["a2a" + a2a.type + "_init"] = 1;
        c.linkname = d.linkname;
        c.linkname_escape = d.linkname_escape;
        c.linkname_implicit = (document.title || g) == d.linkname;
        c.linkurl = d.linkurl;
        c.linkurl_implicit = g == d.linkurl;
        c.orientation = d.orientation || false;
        c.track_links = d.track_links || false;
        c.track_links_key = d.track_links_key || "";
        c.track_pub = d.track_pub || false;
        d.onclick = d.linkname_escape = d.show_title = d.custom_services = d.orientation = d.num_services = d.track_pub = d.target = false;
        if (d.track_links == "custom") {
            d.track_links = false;
            d.track_links_key = ""
        }
        if (a2a.locale && !f) {
            a2a.fn_queue.push((function(o, p) {
                return function() {
                    l(o, p)
                    }
            })(c, n))
            } else {
            l(c, n);
            d.menu_type = d.email_menu = false;
            a2a.init_show()
            }
    },
    multi_init: function(e, c, a) {
        for (var b = 0, d = e.length; b < d; b++) {
            a.target = e[b];
            a2a.init(c, a)
            }
    },
    button: function(b) {
        var a = b.node,
        c = b.type;
        if ((!a.getAttribute("onclick") || (a.getAttribute("onclick") + "").indexOf("a2a_") == -1) && (!a.getAttribute("onmouseover") || (a.getAttribute("onmouseover") + "").indexOf("a2a_") == -1)) {
            a.onclick = function() {
                a2a.show_menu(a);
                return false
            };
            a.onmouseup = a.onmousedown = a2a.stopPropagation;
            if (!a2a[a2a.type].onclick) {
                if (a2a.c.delay) {
                    a.onmouseover = function() {
                        a2a[a2a.type].over_delay = setTimeout(function() {
                            a2a.show_menu(a)
                            }, a2a.c.delay)
                        }
                } else {
                    a.onmouseover = function() {
                        a2a.show_menu(a)
                        }
                }
                a.onmouseout = function() {
                    a2a.onMouseOut_delay();
                    if (a2a[a2a.type].over_delay) {
                        clearTimeout(a2a[a2a.type].over_delay)
                        }
                }
            }
        }
        if (a.tagName.toLowerCase() == "a" && a2a.type == "page") {
            a.href = "http://www.addtoany.com/share_save#url=" + encodeURIComponent(b.linkurl) + "&title=" + encodeURIComponent(b.linkname).replace(/'/g, "%27") + "&description=" + encodeURIComponent(a2a.selection()).replace(/'/g, "%27")
            }
    },
    kit: function(w, d) {
        var l = a2a.type,
        D = function(n) {
            if (n != "facebook_like" && n != "twitter_tweet") {
                for (var E = 0, F = a2a.services, t = F.length; E < t; E++) {
                    if (n == F[E][1]) {
                        return [F[E][0], F[E][3]]
                        }
                }
            }
            return false
        },
        b = a2a.c.templates,
        j = w.node,
        C = j.getElementsByTagName("a"),
        a = C.length,
        e = document.createElement("div"),
        h = encodeURIComponent(w.linkurl).replace(/'/g, "%27"),
        c = encodeURIComponent(w.linkname).replace(/'/g, "%27"),
        g = '<iframe allowtransparency="true" frameborder="0" scrolling="no" src="javascript:\'\'" style="border:none;overflow:hidden"></iframe>',
        x,
        r;
        for (var s = 0; s < a; s++) {
            var B = C[s],
            A = B.className,
            f = A.match(/a2a_button_([\w\.]+)(?:\s|$)/),
            o = (f) ? f[1] : false,
            q = B.childNodes,
            k = D(o),
            m = k[0],
            z = k[1],
            v,
            y;
            if (A.indexOf("a2a_dd") >= 0) {
                d.target = B;
                a2a.init("page", d, 1);
                o = "a2a";
                z = "a2a"
            } else {
                if (o == "email") {
                    z = o
                } else {
                    if (o == "facebook_like") {
                        B.innerHTML = g;
                        x = B.firstChild;
                        x.src = "http://www.facebook.com/plugins/like.php?href=" + h + "&layout=button_count&show_faces=false&action=like";
                        x.style.height = "21px";
                        x.style.width = "90px"
                    } else {
                        if (o == "twitter_tweet") {
                            B.innerHTML = g;
                            r = B.firstChild;
                            r.src = "http://platform.twitter.com/widgets/tweet_button.html?url=" + h + "&text=";
                            r.style.height = "50px";
                            r.style.width = "130px"
                        }
                    }
                }
            }
            if (!o || (!z && !q)) {
                continue
            }
            if (A != "a2a_dd") {
                B.href = Root_Url_for_JS+"share/?came_from=" + o + "&linkurl=" + h + "&type=" + l + "&linkname=" + c + (((o == "twitter" || o == "email") && b[o]) ? "&template=" + encodeURIComponent(b[o]) : "") + "&linknote=";
                B.target = "_blank";
                B.rel = "nofollow";
                B.linkurl = w.linkurl;
                B.servicename = m;
                B.safename = o
            }
            if (q.length) {
                for (var u = 0, p = q.length; u < p; u++) {
                    if (q[u].nodeType == 1) {
                        y = true;
                        break
                    }
                }
                if (!y) {
                    v = document.createElement("span");
                    v.className = "a2a_img a2a_img_text a2a_i_" + z;
                    B.insertBefore(v, q[0])
                    }
            } else {
                v = document.createElement("span");
                v.className = "a2a_img a2a_i_" + z;
                B.appendChild(v)
                }
            if (A != "a2a_dd") {
                a2a.kit_services.push(B)
                }
        }
        if (j.className.indexOf("a2a_default_style") >= 0) {
            e.style.clear = "both";
            j.appendChild(e)
            }
    },
    init_show: function() {
        var b = a2a_config,
        a = a2a[a2a.type],
        c = a2a.show_menu;
        if (b.bookmarklet) {
            a.no_hide = 1;
            c()
            }
        if (b.show_menu) {
            a.no_hide = 1;
            c(false, b.show_menu)
            }
    },
    set_this_index: function(c) {
        var e = a2a.n,
        b;
        function a(f) {
            if (f.className.indexOf("a2a_kit") >= 0) {
                f.a2a_kit = 1
            }
        }
        if (c) {
            c.a2a_index = e;
            a(c);
            return c
        } else {
            function d(f) {
                for (var g = 0, j = f.length, h; g < j; g++) {
                    h = f[g];
                    if (typeof h.a2a_index === "undefined" || h.a2a_index === "" && h.className.indexOf("a2a_target") < 0) {
                        h.a2a_index = e;
                        a(h);
                        return h
                    }
                }
                return null
            }
            b = a2a.getByClass("a2a_kit", document);
            return d(b) || d(a2a.HTMLcollToArray(document.getElementsByName("a2a_dd")).concat(a2a.getByClass("a2a_dd", document)))
            }
    },
    gEl: function(a) {
        return document.getElementById(a)
        },
    getByClass: function(b, c, a) {
        if (document.getElementsByClassName && Object.prototype.getElementsByClassName === document.getElementsByClassName) {
            a2a.getByClass = function(j, h, m) {
                h = h || a2a.gEl("a2a" + a2a.type + "_dropdown");
                var d = h.getElementsByClassName(j),
                l = (m) ? new RegExp("\\b" + m + "\\b", "i") : null,
                e = [],
                g;
                for (var f = 0, k = d.length; f < k; f += 1) {
                    g = d[f];
                    if (!l || l.test(g.nodeName)) {
                        e.push(g)
                        }
                }
                return e
            }
        } else {
            if (document.evaluate) {
                a2a.getByClass = function(o, n, r) {
                    r = r || "*";
                    n = n || a2a.gEl("a2a" + a2a.type + "_dropdown");
                    var g = o.split(" "),
                    p = "",
                    l = "http://www.w3.org/1999/xhtml",
                    q = (document.documentElement.namespaceURI === l) ? l: null,
                    h = [],
                    d,
                    f;
                    for (var i = 0, k = g.length; i < k; i += 1) {
                        p += "[contains(concat(' ',@class,' '), ' " + g[i] + " ')]"
                    }
                    try {
                        d = document.evaluate(".//" + r + p, n, q, 0, null)
                        } catch(m) {
                        d = document.evaluate(".//" + r + p, n, null, 0, null)
                        }
                    while ((f = d.iterateNext())) {
                        h.push(f)
                        }
                    return h
                }
            } else {
                a2a.getByClass = function(r, q, u) {
                    u = u || "*";
                    q = q || a2a.gEl("a2a" + a2a.type + "_dropdown");
                    var h = r.split(" "),
                    t = [],
                    d = (u === "*" && q.all) ? q.all: q.getElementsByTagName(u),
                    p,
                    j = [],
                    o;
                    for (var i = 0, e = h.length; i < e; i += 1) {
                        t.push(new RegExp("(^|\\s)" + h[i] + "(\\s|$)"))
                        }
                    for (var g = 0, s = d.length; g < s; g += 1) {
                        p = d[g];
                        o = false;
                        for (var f = 0, n = t.length; f < n; f += 1) {
                            o = t[f].test(p.className);
                            if (!o) {
                                break
                            }
                        }
                        if (o) {
                            j.push(p)
                            }
                    }
                    return j
                }
            }
        }
        return a2a.getByClass(b, c, a)
        },
    HTMLcollToArray: function(f) {
        var b = [],
        e = f.length;
        for (var d = 0; d < e; d++) {
            b[b.length] = f[d]
            }
        return b
    },
    add_event: function(c, b, a) {
        if (!c.addEventListener) {
            c.attachEvent("on" + b, a)
            } else {
            c.addEventListener(b, a, false)
            }
    },
    stopPropagation: function(a) {
        if (!a) {
            a = window.event
        }
        a.cancelBubble = true;
        if (a.stopPropagation) {
            a.stopPropagation()
            }
    },
    onLoad: function(a) {
        var b = window.onload;
        if (typeof window.onload != "function") {
            window.onload = a
        } else {
            window.onload = function() {
                if (b) {
                    b()
                    }
                a()
                }
        }
    },
    in_array: function(e, a, b) {
        if (typeof a == "object") {
            e = e.toLowerCase();
            var c = a.length;
            for (var d = 0; d < c; d++) {
                if (b) {
                    if (e == a[d].toLowerCase()) {
                        return a[d]
                        }
                } else {
                    if (e.indexOf(a[d].toLowerCase()) != -1 && a[d] !== "") {
                        return a[d]
                        }
                }
            }
        }
        return false
    },
    onMouseOut_delay: function() {
        var b = a2a.type,
        a = a2a.gEl("a2a" + b + "_dropdown").style.display;
        if (a != "none" && a != "" && !a2a[b].find_focused && !a2a[b].inFocus) {
            a2a[b].out_delay = setTimeout("a2a.toggle_dropdown('none', '" + b + "')", 501)
            }
    },
    onMouseOver_stay: function() {
        if (a2a[a2a.type].out_delay) {
            clearTimeout(a2a[a2a.type].out_delay)
            }
    },
    toggle_dropdown: function(d, c) {
        if (d == "none" && a2a[c].no_hide) {
            return
        }
        var a,
        b = a2a.gEl,
        e = b("a2a" + c + "_shim");
        b("a2a" + c + "_dropdown").style.display = d;
        if (e) {
            e.style.display = d
        }
        a2a.onMouseOver_stay();
        if (d == "none") {
            a2a.embeds_fix(true);
            if (!window.addEventListener) {
                a = document.detachEvent;
                a("onmousedown", a2a.doc_mousedown_check_scroll);
                a("onmouseup", a2a[c].doc_mouseup_toggle_dropdown)
                } else {
                document.removeEventListener("mousedown", a2a.doc_mousedown_check_scroll, false);
                document.removeEventListener("mouseup", a2a[c].doc_mouseup_toggle_dropdown, false)
                }
            delete a2a[c].doc_mouseup_toggle_dropdown
        }
        if (a2a[c].prev_keydown) {
            document.onkeydown = a2a[c].prev_keydown
        } else {
            document.onkeydown = ""
        }
    },
    getPos: function(b) {
        var a = 0,
        c = 0;
        do {
            a += b.offsetLeft || 0;
            c += b.offsetTop || 0;
            b = b.offsetParent
        }
        while (b);
        return [a, c]
        },
    getDocDims: function(c) {
        var a = 0,
        b = 0;
        if (typeof(window.innerWidth) == "number") {
            a = window.innerWidth;
            b = window.innerHeight
        } else {
            if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                a = document.documentElement.clientWidth;
                b = document.documentElement.clientHeight
            } else {
                if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                    a = document.body.clientWidth;
                    b = document.body.clientHeight
                }
            }
        }
        if (c == "w") {
            return a
        } else {
            return b
        }
    },
    getScrollDocDims: function(c) {
        var a = 0,
        b = 0;
        if (typeof(window.pageYOffset) == "number") {
            a = window.pageXOffset;
            b = window.pageYOffset
        } else {
            if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
                a = document.body.scrollLeft;
                b = document.body.scrollTop
            } else {
                if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
                    a = document.documentElement.scrollLeft;
                    b = document.documentElement.scrollTop
                }
            }
        }
        if (c == "w") {
            return a
        } else {
            return b
        }
    },
    show_more_less: function(d) {
        a2a.onMouseOver_stay();
        var f = a2a.gEl("a2a" + a2a.type + "_show_more_less"),
        g = a2a.type,
        a;
        if (a2a[g].show_all || d == 1) {
            a2a[g].show_all = false;
            a = (a2a.c.color_arrow == "fff") ? "_wt": "";
            f.firstChild.className = "a2a_i_darr" + a;
            f.title = a2a.c.localize.ShowAll;
            a2a.statusbar(f, a2a.c.localize.ShowAll);
            if (d == 0) {
                a2a.default_services();
                a2a.embeds_fix(false);
                a2a.focus_find()
                }
        } else {
            a2a[g].show_all = true;
            var c = a2a[g].main_services,
            b = c.length;
            for (var e = 0; e < b; e++) {
                c[e].style.display = ""
            }
            a = (a2a.c.color_arrow == "fff") ? "_wt": "";
            f.firstChild.className = "a2a_i_uarr" + a;
            f.title = a2a.c.localize.ShowLess;
            a2a.statusbar(f, a2a.c.localize.ShowLess);
            a2a.embeds_fix(false);
            a2a.focus_find()
            }
        if (d == 0) {
            return false
        }
    },
    focus_find: function() {
        var b = a2a.gEl("a2a" + a2a.type + "_find");
        if (b.parentNode.style.display != "none") {
            b.focus()
            }
    },
    blur_find: function() {
        a2a[a2a.type].find_focused = false;
        if (!a2a[a2a.type].onclick) {
            a2a.onMouseOut_delay()
            }
    },
    default_services: function(e) {
        var c = e || a2a.type,
        f = a2a[c].main_services_col_1,
        a = f.length,
        d = a2a[c].main_services_col_2,
        g = d.length;
        for (var b = 0; b < a; b++) {
            if (b < parseInt(a2a[c].num_services / 2)) {
                f[b].style.display = ""
            } else {
                f[b].style.display = "none"
            }
        }
        for (var b = 0; b < g; b++) {
            if (b < parseInt(a2a[c].num_services / 2)) {
                d[b].style.display = ""
            } else {
                d[b].style.display = "none"
            }
        }
    },
    do_reset: function() {
        a2a[a2a.type].inFocus = false;
        a2a.show_more_less(1);
        a2a.embeds_fix(false);
        a2a.focus_find()
        },
    do_find: function() {
        var f = a2a.type,
        d = a2a[f].main_services,
        c = d.length,
        b = a2a.gEl("a2a" + f + "_find").value,
        g,
        a = a2a.in_array;
        if (b !== "") {
            g = b.split(" ");
            for (var e = 0, h; e < c; e++) {
                h = d[e].serviceNameLowerCase;
                if (a(h, g, false)) {
                    d[e].style.display = ""
                } else {
                    d[e].style.display = "none"
                }
            }
        } else {
            if (a2a[f].tab != "DEFAULT") {
                a2a.tabs(a2a[f].tab)
                } else {
                a2a.default_services()
                }
        }
        a2a.do_reset()
        },
    tabs: function(l, i) {
        var c = a2a.getByClass("a2a_tab_selected")[0],
        j = a2a.type,
        k = a2a.gEl,
        b = "a2a" + j,
        g = k(b + "_show_more_less"),
        e = k(b + "_find_container"),
        h = k(b + "_col1"),
        f = k(b + "_col2"),
        a = k(b + "_2_col1"),
        n = k(b + "_2_col2"),
        d = "block",
        m = "none";
        if (c.id == "a2afeed_DEFAULT" && l == "DEFAULT") {
            return true
        }
        c.className = c.className.replace(/a2a_tab_selected/, "");
        k(b + "_" + l).className += " a2a_tab_selected";
        if (l != "DEFAULT") {
            g.style.display = e.style.display = h.style.display = f.style.display = m
        } else {
            g.style.display = e.style.display = h.style.display = f.style.display = d;
            a2a.default_services()
            }
        if (l != "EMAIL") {
            a.style.display = n.style.display = m
        } else {
            a.style.display = n.style.display = d
        }
        k(b + "_note_BROWSER").style.display = "none";
        k(b + "_note_EMAIL").style.display = "none";
        if (i) {
            k(b + "_note_" + l).style.display = "block"
        }
        a2a.do_reset();
        return false
    },
    statusbar: function(a, c) {
        if (window.opera) {
            return
        }
        var b = a2a.gEl("a2a" + a2a.type + "_powered_by");
        if (!b.orig) {
            b.orig = b.innerHTML
        }
        a.onmouseover = function() {
            clearTimeout(a2a[a2a.type].statusbar_delay);
            b.innerHTML = c;
            b.style.textAlign = "left"
        };
        a.onmouseout = function() {
            a2a[a2a.type].statusbar_delay = setTimeout(function() {
                b.innerHTML = b.orig;
                b.style.textAlign = "center"
            }, 300)
            }
    },
    selection: function() {
        var b,
        h = document.getElementsByTagName("meta"),
        a = h.length;
        if (window.getSelection) {
            b = window.getSelection()
            } else {
            if (document.selection) {
                try {
                    b = document.selection.createRange()
                    } catch(f) {
                    b = ""
                }
                b = (b.text) ? b.text: ""
            }
        }
        if (b && b != "") {
            return b
        }
        if (a2a["n" + a2a.n].linkurl == location.href) {
            for (var c = 0, d, g; c < a; c++) {
                d = h[c].getAttribute("name");
                if (d) {
                    if (d.toLowerCase() == "description") {
                        g = h[c].getAttribute("content");
                        break
                    }
                }
            }
        }
        return (g) ? g.substring(0, 1200) : ""
    },
    collections: function(c) {
        var b = a2a.gEl,
        a = a2a[c],
        d = "a2a" + c;
        a.main_services_col_1 = a2a.getByClass("a2a_i", b(d + "_col1"));
        a.main_services_col_2 = a2a.getByClass("a2a_i", b(d + "_col2"));
        a.main_services = a.main_services_col_1.concat(a.main_services_col_2);
        a.email_services = a2a.getByClass("a2a_i", b(d + "_2_col1")).concat(a2a.getByClass("a2a_i", b(d + "_2_col2")));
        a.all_services = a.main_services.concat(a.email_services)
        },
    linker: function(o) {
        var n = a2a.type,
        m = location.href,
        c = document.title || m,
        b = a2a["n" + a2a.n],
        h = b.linkurl,
        g = (b.linkurl_implicit && m != h) ? m: h,
        p = encodeURIComponent(g).replace(/'/g, "%27"),
        a = b.linkname,
        e = (b.linkname_implicit && c != a) ? c: a,
        k = encodeURIComponent(e).replace(/'/g, "%27"),
        i = encodeURIComponent(a2a.selection()).replace(/'/g, "%27"),
        j = (b.track_links && (n == "page" || n == "mail")) ? "&linktrack=" + b.track_links + "&linktrackkey=" + encodeURIComponent(b.track_links_key) : "",
        d = o.getAttribute("customserviceuri") || o.customserviceuri || false,
        f = o.safename,
        l = a2a.c.templates;
        if (d) {
            o.href = d.replace(/A2A_LINKNAME_ENC/, k).replace(/A2A_LINKURL_ENC/, p).replace(/A2A_LINKNOTE_ENC/, i)
            } else {
            o.href = Root_Url_for_JS+"share/?came_from=" + f + "&linkurl=" + p + "&linkname=" + k + j + ((a2a.c.awesm) ? "&linktrack_parent=" + a2a.c.awesm: "") + (((f == "twitter" || f == "email") && l[f]) ? "&template=" + encodeURIComponent(l[f]) : "") + ((n == "feed") ? "&type=feed": "") + "&linknote=" + i
        }
        setTimeout(function() {
            o.href = "/"
        }, 500);
        return true
    },
    show_menu: function(c, p) {
        if (c) {
            a2a.n = c.a2a_index
        } else {
            a2a.n = a2a.total;
            a2a[a2a.type].no_hide = 1
        }
        var b = a2a["n" + a2a.n],
        j = a2a.type = b.type,
        a = "a2a" + j,
        m = a2a.gEl(a + "_dropdown");
        a2a.gEl(a + "_title").value = b.linkname;
        if (c && a2a[j].onclick && m.style.display == "block") {
            a2a.toggle_dropdown("none", j);
            return
        } else {
            a2a.toggle_dropdown("block", j)
            }
        var l = [m.clientWidth, m.clientHeight],
        g = a2a.getDocDims("w"),
        n = a2a.getDocDims("h"),
        k = a2a.getScrollDocDims("w"),
        e = a2a.getScrollDocDims("h"),
        f,
        h,
        i,
        d;
        if (c) {
            f = c.getElementsByTagName("img")[0];
            if (f) {
                h = a2a.getPos(f);
                i = f.clientWidth;
                d = f.clientHeight
            } else {
                h = a2a.getPos(c);
                i = c.offsetWidth;
                d = c.offsetHeight
            }
            if (h[0] - k + l[0] + i > g) {
                h[0] = h[0] - l[0] + i - 8
            }
            if (b.orientation == "up" || b.orientation != "down" && h[1] - e + l[1] + d > n && h[1] > l[1]) {
                h[1] = h[1] - l[1] - d
            }
            m.style.left = ((h[0] < 0) ? 0: h[0]) + 2 + "px";
            m.style.top = h[1] + d + "px";
            a2a.embeds_fix(false)
            } else {
            if (!p) {
                p = {}
            }
            m.style.position = p.position || "absolute";
            m.style.left = p.left || (g / 2 - l[0] / 2 + "px");
            m.style.top = p.top || (n / 2 - l[1] / 2 + "px")
            }
        if (!a2a[j].doc_mouseup_toggle_dropdown && !a2a[j].no_hide) {
            a2a.doc_mousedown_check_scroll = function() {
                a2a.last_scroll_pos = a2a.getScrollDocDims("h")
                };
            a2a[j].doc_mouseup_toggle_dropdown = (function(o) {
                return function() {
                    if (a2a.last_scroll_pos == a2a.getScrollDocDims("h")) {
                        a2a.toggle_dropdown("none", o)
                        }
                }
            })(j);
            if (!window.addEventListener) {
                document.attachEvent("onmousedown", a2a.doc_mousedown_check_scroll);
                document.attachEvent("onmouseup", a2a[j].doc_mouseup_toggle_dropdown)
                } else {
                document.addEventListener("mousedown", a2a.doc_mousedown_check_scroll, false);
                document.addEventListener("mouseup", a2a[j].doc_mouseup_toggle_dropdown, false)
                }
            document.onkeydown = a2a.checkKey
        }
        if (j == "feed") {
            a2a.gEl(a + "_DEFAULT").href = b.linkurl;
            if (a2a.c.fb_feedcount && !a2a.c.ssl) {
                a2a.feedburner_feedcount("init")
                }
        }
        a2a.a2a_track("test3");
        if (b.track_pub) {
            a2a.a2a_track("z_" + b.track_pub)
            }
    },
    embeds_fix: function(s) {
        if (!a2a.embeds) {
            a2a.embeds = a2a.HTMLcollToArray(document.getElementsByTagName("object")).concat(a2a.HTMLcollToArray(document.getElementsByTagName("embed"))).concat(a2a.HTMLcollToArray(document.getElementsByTagName("applet")))
            }
        var c = a2a.gEl,
        f = a2a.type,
        e = "a2a" + f,
        g = c(e + "_shim"),
        r = c(e + "_dropdown"),
        b = parseInt(r.style.left),
        n = parseInt(r.style.top),
        p = (r.clientWidth || r.offsetWidth),
        m = (r.clientHeight || r.offsetHeight),
        o = a2a.embeds,
        k = o.length,
        d,
        j,
        h,
        a,
        l = a2a.c.hide_embeds;
        for (var q = 0; q < k; q++) {
            a = "visible";
            if (!s) {
                d = a2a.getPos(o[q]);
                j = o[q].clientWidth;
                h = o[q].clientHeight;
                if (b < d[0] + j && n < d[1] + h && b + p > d[0] && n + m > d[1]) {
                    if (l) {
                        a = "hidden"
                    } else {
                        if (navigator.userAgent.indexOf("Firefox") == -1) {
                            if (!g) {
                                g = document.createElement("iframe");
                                g.className = "a2a_shim";
                                g.id = e + "_shim";
                                g.setAttribute("frameBorder", "0");
                                g.setAttribute("src", 'javascript:"";');
                                document.body.appendChild(g)
                                }
                            g.style.left = b + "px";
                            g.style.top = n + "px";
                            g.style.width = p + "px";
                            g.style.height = m + "px";
                            return
                        }
                    }
                }
            }
            o[q].style.visibility = a
        }
    },
    bmBrowser: function(a) {
        var c = a2a.c.localize.Bookmark,
        b = a2a["n" + a2a.n];
        if (document.all) {
            if (a == 1) {
                c = a2a.c.localize.AddToYourFavorites
            } else {
                window.external.AddFavorite(b.linkurl, b.linkname)
                }
        } else {
            if (a != 1) {
                a2a.gEl("a2apage_note_BROWSER").innerHTML = '<div class="a2a_note_note">' + a2a.c.localize.BookmarkInstructions + "</div>";
                a2a.tabs("BROWSER", true)
                }
        }
        if (a == 1) {
            return c
        }
    },
    loadExtScript: function(c, e, d) {
        var b = document.createElement("script");
        b.charset = "UTF-8";
        b.src = c;
        document.getElementsByTagName("head")[0].appendChild(b);
        if (typeof e == "function") {
            var a = setInterval(function() {
                var f = false;
                try {
                    f = e.call()
                    } catch(g) {}
                if (f) {
                    clearInterval(a);
                    d.call()
                    }
            }, 100)
            }
    },
    track: function(b) {
        var a = new Image(1, 1);
        a.src = b;
        a.width = 1;
        a.height = 1
    },
    a2a_track: function(p, h) {
        var r = (a2a.type != "feed") ? "Share": "Subscribe";
        if (document.cookie.length > 0) {
            var n = "__utma_a2a",
            t = document.cookie.indexOf(n + "="),
            d,
            q;
            if (t != -1) {
                t = t + n.length + 1;
                d = document.cookie.indexOf(";", t);
                if (d == -1) {
                    d = document.cookie.length
                }
                q = unescape(document.cookie.substring(t, d))
                }
        }
        var c = encodeURIComponent,
        l = new Date(),
        b = Math.round(l.getTime() / 1000),
        e = Math.floor(Math.random() * 9999999999),
        o = (q) ? q.split(".") : [],
        s = (o[0] && o[0] != 1) ? o[0] : e,
        i = o[2] || b,
        k = o[4] || b,
        a = b,
        j = o[1] || a + 31556926,
        f = (o[5]) ? parseInt(o[5]) + 1: 1,
        g = s + "." + j + "." + i + "." + k + "." + a + "." + f,
        m = "http" + ((a2a.c.ssl) ? "s://ssl": "://www") + ".google-analytics.com/__utm.gif?&utmwv=4.6.5&a2a&utmn=" + e + "&utmhn=" + window.location.hostname + "&utmt=event&utme=5(" + r + "%20menu*" + c(p) + ((h) ? "*" + c(h) : "") + ")&utmcs=" + ((document.characterSet) ? document.characterSet: document.charset) + "&utmsr=" + screen.width + "x" + screen.height + "&utmsc=" + screen.colorDepth + "-bit&utmul=" + (navigator.browserLanguage || navigator.language).toLowerCase() + "&utmdt=" + c(document.title || location.href) + "&utmhid=" + e + "&utmr=" + ((document.referrer) ? c(document.referrer) : "-") + "&utmp=" + c(window.location.pathname) + "&utmac=" + ((r == "Share") ? "UA-1244922-3": "UA-1244922-4") + "&utmcc=__utma%3D" + g + "%3B%2B__utmz%3D" + s + "." + a + "." + f + ".1.utmcsr%3D(direct)%7Cutmccn%3D(direct)%7Cutmcmd%3D(none)%3B";
        l.setDate(l.getDate() + 730);
        document.cookie = "__utma_a2a=" + escape(g) + "; expires=" + l.toGMTString() + "; path=/";
        a2a.track(m)
        },
    GA: function(d) {
        var a = a2a.type,
        c,
        b = function() {
            if (typeof urchinTracker == "function") {
                c = 1
            } else {
                if (typeof pageTracker == "object") {
                    c = 2
                } else {
                    if (typeof _gaq == "object") {
                        c = 3
                    } else {
                        return
                    }
                }
            }
            var j = a2a[a].all_services,
            o,
            f,
            e,
            l = (a == "feed") ? "subscriptions": "pages",
            m = (a == "feed") ? "AddToAny Subscribe Button": "AddToAny Share/Save Button",
            n,
            k;
            if (a == "page") {
                j.push(a2a.gEl("a2apage_any_email"), a2a.gEl("a2apage_email_client"));
                j = j.concat(a2a.kit_services)
                }
            for (var h = 0, g = j.length; h < g; h++) {
                o = j[h];
                k = o.linkurl || false;
                e = o.getAttribute("safename") || o.safename;
                f = o.getAttribute("servicename") || o.servicename;
                if (c == 1) {
                    n = (function(p, i, q) {
                        return function() {
                            urchinTracker("/addtoany.com/" + i);
                            urchinTracker("/addtoany.com/" + i + "/" + (q || a2a["n" + a2a.n].linkurl));
                            urchinTracker("/addtoany.com/services/" + p)
                            }
                    })(e, l, k)
                    } else {
                    if (c == 2) {
                        n = (function(s, p, i, q, r) {
                            return function() {
                                pageTracker._trackEvent(q, s, (r || a2a["n" + a2a.n].linkurl))
                                }
                        })(f, e, l, m, k)
                        } else {
                        n = (function(s, p, i, q, r) {
                            return function() {
                                _gaq.push(["_trackEvent", q, s, (r || a2a["n" + a2a.n].linkurl)])
                                }
                        })(f, e, l, m, k)
                        }
                }
                a2a.add_event(o, "click", n)
                }
        };
        if (d) {
            b()
            } else {
            a2a.onLoad(b)
            }
    },
    add_srvcs: function() {
        var g = a2a.type,
        h = a2a.gEl,
        f = h("a2a" + g + "_col1"),
        e = h("a2a" + g + "_col2");
        if (a2a[g].custom_services) {
            var l = a2a[g].custom_services,
            a = l.length,
            b = a2a.mk_srvc,
            k = 0;
            l.reverse();
            for (var d = 0, c; d < a; d++) {
                if (l[d]) {
                    k += 1;
                    c = b(l[d][0], l[d][0].replace(" ", "_"), false, false, false, l[d][1], l[d][2]);
                    if (k % 2 != 0) {
                        f.insertBefore(c, f.firstChild)
                        } else {
                        e.insertBefore(c, e.firstChild)
                        }
                }
            }
        }
        if (g == "page" && a2a.c.add_services) {
            var l = a2a.c.add_services,
            a = l.length,
            b = a2a.mk_srvc,
            k = 0,
            j = a2a.c.ssl;
            for (var d = 0; d < a; d++) {
                if (l[d]) {
                    k += 1;
                    if (j) {
                        l[d].icon = false
                    }
                    c = b(l[d].name, l[d].safe_name, l[d].home, false, false, false, l[d].icon);
                    if (k % 2 != 0) {
                        f.insertBefore(c, f.firstChild)
                        } else {
                        e.insertBefore(c, e.firstChild)
                        }
                }
            }
        }
    },
    prioritize_services: function() {
        if (!a2a.c.prioritize) {
            return
        }
        a2a.c.prioritize.reverse();
        var h = a2a.type,
        j = a2a.gEl,
        a = "a2a" + h,
        g = j(a + "_col1"),
        f = j(a + "_col2"),
        b = a2a.c.prioritize,
        e = b.length,
        k = 0;
        for (var d = 0, c; d < e; d++) {
            c = j(a + "_" + b[d].toLowerCase());
            if (c) {
                k += 1;
                if (k % 2 != 0) {
                    g.insertBefore(c, g.firstChild)
                    } else {
                    f.insertBefore(c, f.firstChild)
                    }
            }
        }
    },
    user_services: function() {
        if (!window.postMessage || a2a.c.static_server != ((a2a.c.ssl) ? a2a.c.ssl: "http://static.addtoany.com/menu")) {
            a2a.history();
            return
        }
        var a = a2a.type,
        b = document.createElement("iframe");
        b.id = "a2a" + a + "_sm_ifr";
        b.style.width = b.style.height = b.width = b.height = 1;
        b.style.top = b.style.left = b.frameborder = b.style.border = 0;
        b.style.position = "absolute";
        b.style.zIndex = 100000;
        b.setAttribute("transparency", "true");
        b.setAttribute("allowTransparency", "true");
        b.setAttribute("frameBorder", "0");
        b.src = a2a.c.static_server + "/sm1.html#" + a + ";" + location.href.split("#")[0];
        if (window.postMessage && !a2a.message_event) {
            a2a.add_event(window, "message", function(g) {
                if (g.origin.substr(g.origin.length - 13) == ".addtoany.com") {
                    var f = g.data,
                    c = f.split("=")[1],
                    d = f.substr(4, 4);
                    c = (c != "") ? c.split(",") : false;
                    a2a.gEl("a2a" + d + "_sm_ifr").style.display = "none";
                    a2a.history(c, d)
                    }
            });
            a2a.message_event = 1
        }
        document.body.insertBefore(b, document.body.firstChild)
        },
    history: function(r, d) {
        var l = d || a2a.type,
        c = a2a.gEl,
        v = c("a2a" + l + "_col1"),
        u = c("a2a" + l + "_col2"),
        y = a2a.getByClass("a2a_i", v),
        w = a2a.getByClass("a2a_i", u),
        h = [],
        A = y.length + w.length,
        j = Math.abs(y.length - w.length);
        for (var o = 0, b = y.length - 1, a = w.length - 1; o < A + j; o++) {
            if (o % 2 && o != 0 && w[a]) {
                h[h.length] = w[a];
                a--
            } else {
                if (y[b]) {
                    h[h.length] = y[b];
                    b--
                }
            }
        }
        var n = document.createElement("div");
        n.id = "a2a_hist_list";
        n.style.width = "1px";
        n.style.height = "1px";
        n.style.overflow = "hidden";
        document.body.insertBefore(n, document.body.firstChild);
        for (var o = 0, e = 0, g = h.length; o < g; o++) {
            var m = h[o],
            k = m.homepage,
            x = document.createElement("a"),
            p = a2a.in_array,
            q = false;
            if (!r) {
                x.style.clear = m.style.clear;
                x.href = k;
                x.innerHTML = k;
                n.appendChild(x);
                if (x.currentStyle) {
                    var f = x.currentStyle.clear
                } else {
                    if (document.defaultView.getComputedStyle(x, null)) {
                        var f = document.defaultView.getComputedStyle(x, null).getPropertyValue("clear")
                        }
                }
                x.parentNode.removeChild(x)
                }
            if (r && p(m.safename, r, true)) {
                q = true
            }
            if (q || (!r && f == "right" && k != "")) {
                m.className = m.className + " a2a_sss";
                if (e % 2 && e != 0) {
                    u.insertBefore(m, u.firstChild)
                    } else {
                    v.insertBefore(m, v.firstChild)
                    }
                e++
            }
        }
        n.parentNode.removeChild(n);
        a2a.collections(l);
        a2a.default_services(l)
        },
    visOnly: function(f) {
        var b = [],
        d = f.length;
        for (var c = 0, g = 0; c < d; c++) {
            if (f[c].style.display != "none" && f[c].parentNode.style.display != "none") {
                b[g] = f[c];
                g++
            }
        }
        return b
    },
    moveFocus: function(a, d) {
        var c = a2a[a2a.type].inFocus,
        b = a2a.getByClass("a2a_cols");
        presently_focused = a2a.visOnly(b[c[0]].getElementsByTagName("a"))[c[1]];
        presently_focused.blur();
        a2a[a2a.type].inFocus = [c[0] + a, c[1] + d];
        c = a2a[a2a.type].inFocus;
        to_focus = a2a.visOnly(b[c[0]].getElementsByTagName("a"))[c[1]];
        to_focus.focus();
        to_focus.onblur = function() {
            if (this != presently_focused) {
                a2a[a2a.type].inFocus = false;
                a2a.onMouseOut_delay()
                }
        }
    },
    checkKey: function(h) {
        var h = h || window.event,
        j = h.which || h.keyCode,
        c = a2a[a2a.type].inFocus,
        a = false,
        b = a2a.getByClass("a2a_cols"),
        k = b.length,
        d = a2a.visOnly;
        if (j == 13 && !c) {
            for (var g = 0; g < k; g++) {
                if (d(b[g].getElementsByTagName("a")).length > 0) {
                    a = g;
                    break
                }
            }
            if (a === false) {
                return false
            }
            a2a[a2a.type].inFocus = [a, 0];
            a2a.moveFocus(0, 0);
            return false
        }
        if (c) {
            var f = d(b[c[0]].getElementsByTagName("a"));
            if (j == 38) {
                if (c[1] < 1) {
                    if (typeof f[f.length - 1] != "undefined") {
                        a2a.moveFocus(0, f.length - 1)
                        }
                } else {
                    if (typeof f[c[1] - 1] != "undefined") {
                        a2a.moveFocus(0, -1)
                        }
                }
                return false
            } else {
                if (j == 40) {
                    if (c[1] > f.length - 2) {
                        a2a.moveFocus(0, -(c[1]))
                        } else {
                        a2a.moveFocus(0, 1)
                        }
                    return false
                } else {
                    if (j == 37) {
                        if (c[0] < 1) {
                            if (typeof d(b[b.length - 1].getElementsByTagName("a"))[c[1]] != "undefined") {
                                a2a.moveFocus(b.length - 1, 0)
                                }
                        } else {
                            if (typeof d(b[c[0] - 1].getElementsByTagName("a"))[c[1]] != "undefined") {
                                a2a.moveFocus( - 1, 0)
                                }
                        }
                    } else {
                        if (j == 39) {
                            if (c[0] > b.length - 2) {
                                if (typeof d(b[0].getElementsByTagName("a"))[c[1]] != "undefined") {
                                    a2a.moveFocus( - (b.length - 1), 0)
                                    }
                            } else {
                                if (typeof d(b[c[0] + 1].getElementsByTagName("a"))[c[1]] != "undefined") {
                                    a2a.moveFocus(1, 0)
                                    }
                            }
                        }
                    }
                }
            }
        }
        if (j == 27 && a2a[a2a.type].tab == "DEFAULT") {
            a2a.gEl("a2a" + a2a.type + "_find").value = "";
            a2a.do_find();
            a2a.focus_find()
            } else {
            if (j > 40 || j == 32) {
                a2a.focus_find()
                }
        }
    },
    css: function() {
        function m(E) {
            var D = 2,
            H = 4,
            C = (E.length == 3) ? 1: false;
            if (C) {
                D = 1;
                H = 2
            }
            function F(G) {
                var B = (C) ? E.substr(G, 1) + E.substr(G, 1) : E.substr(G, 2);
                return parseInt(B, 16)
                }
            return F(0) + "," + F(D) + "," + +F(H)
            }
        var g,
        q,
        w = a2a.c,
        i = w.css = document.createElement("style"),
        k = w.color_main || "EEE",
        f = w.color_bg || "FFF",
        j = w.color_border || "CCC",
        c = w.color_link_text || "00F",
        h = w.color_link_text_hover || "000",
        n = w.color_link_text_hover || "999",
        l = w.color_link_text || "000",
        r = (k.toLowerCase() == "ffffff") ? "EEE": k,
        b = w.color_link_text || "CCC",
        e = w.color_link_text || "000",
        y = ".a2a_",
        d = "{background-position:0 ",
        a = "px!important}",
        A = y + "i_",
        z = a + A,
        x = y + "menu",
        v = y + "tab",
        u = "border",
        t = "background-color:",
        s = "color:",
        p = "margin:",
        o = "padding:";
        g = "" + x + "," + x + " *{float:none;" + p + "0;" + o + "0;height:auto;width:auto}" + x + " table{" + u + "-collapse:collapse;" + u + "-spacing:0;width:auto}" + x + " table," + x + " tbody," + x + " td," + x + " tr{" + u + ":0;" + p + "0;" + o + "0;" + t + "#" + f + "}" + x + " td{vertical-align:top}" + x + "," + x + "_inside{-webkit-" + u + "-radius:16px;-moz-" + u + "-radius:16px}" + x + "{display:none;z-index:9999999;position:absolute;direction:ltr;min-width:200px;background:#" + k + ";background:rgba(" + m(k) + ",.6);font:12px Arial,Helvetica,sans-serif;" + s + "#000;line-height:12px;" + u + ":1px solid transparent;_" + u + ":1px solid #" + k + ";" + o + "7px;vertical-align:baseline;overflow:hidden}" + x + "_inside{" + t + "#" + f + ";" + u + ":1px solid #" + j + ";" + o + "8px}" + x + " a span," + v + "s " + v + "_selected span{" + s + "#" + c + "}" + x + " a:hover span," + v + "s div span," + v + "s a span{" + s + "#" + h + "}" + x + " a,#a2a_hist_list a," + v + "s div{" + s + "#" + c + ";text-decoration:none;font:12px Arial,Helvetica,sans-serif;line-height:12px;height:auto;width:auto;clear:none;outline:none;-moz-outline:none;-webkit-" + u + "-radius:8px;-moz-" + u + "-radius:8px}" + x + " a:visited,#a2a_hist_list a:visited{" + s + "#" + c + ";clear:right}" + x + " a:hover," + x + " a:active," + x + " a" + y + "i:focus," + v + "s div:hover{" + s + "#" + h + ";" + u + ":1px solid #" + j + ";" + t + "#" + k + ";text-decoration:none}" + x;
        g += " span," + y + "img{background:url(" + a2a.icons_img_url + ") no-repeat;" + u + ":0;display:block;line-height:16px}" + x + " span" + y + "i_find{height:16px;left:5px;position:absolute;top:2px;width:16px}#a2a_menu_container{display:inline-block}#a2a_menu_container{_display:inline}" + x + "_title_container{margin-bottom:2px;" + o + "6px}" + x + "_find_container{position:relative;text-align:left;" + p + "4px 1px;" + o + "1px 24px 1px 0;" + u + ":1px solid #" + b + ";-webkit-" + u + "-radius:8px;-moz-" + u + "-radius:8px}" + x + " input," + x + ' input[type="text"]{display:block;background-image:none;box-shadow:none;line-height:100%;' + p + "0;overflow:hidden;" + o + "0;-moz-box-shadow:none;-webkit-box-shadow:none;-webkit-appearance:none}" + x + "_title_container input" + x + "_title{" + s + "#" + e + ";" + t + "#" + f + ";" + u + ":0;" + p + "0;" + o + "0;width:100%}" + x + "_find_container input" + x + "_find{position:relative;left:24px;" + s + "#" + e + ";font-size:12px;" + o + "2px 0;outline:0;" + u + ":0;" + t + "transparent;_" + t + "#" + f + ";width:250px}table" + y + "cols_container{width:100%}" + y + "cols{width:50%}" + ((typeof document.body.style.maxHeight != "undefined") ? "" + y + "clear{clear:both}": "" + y + "clear{clear:both;height:0;width:0;line-height:0;font-size:0}") + " " + y + "default_style a{float:left;line-height:16px;" + o + "0 2px}" + y + "default_style " + y + "img{display:block;height:16px;line-height:16px;overflow:hidden;width:16px}" + y;
        g += "default_style " + y + "img," + y + "default_style " + y + "dd{float:left}" + y + "default_style " + y + "img_text{margin-right:4px}" + y + "default_style " + y + "divider{" + u + "-left:1px solid #000;display:inline;float:left;height:16px;line-height:16px;" + p + "0 5px}" + y + "kit a{cursor:pointer}" + y + "hr{" + p + "0 12px 12px;" + o + "1px;background:none;" + t + "#" + k + "}" + y + "nowrap{white-space:nowrap}" + y + "note{" + p + "0 auto;" + o + "9px;font-size:11px;text-align:center}" + y + "note " + y + "note_note{" + p + "0 0 9px;" + s + "#" + l + "}" + y + "wide a{display:block;margin-top:3px;" + u + ":1px solid #" + r + ";" + o + "3px;text-align:center}" + v + "s{float:left;" + p + "0 0 3px}" + v + "s a," + v + "s div{" + p + "1px;" + t + "#" + k + ";" + u + ":1px solid #" + k + ";font-size:11px;" + o + "6px 12px 2px;white-space:nowrap}" + v + "s a span," + v + "s div span{margin-bottom:4px;padding-left:20px}" + v + "s a," + v + "s a:visited," + v + "s a:hover," + v + "s div," + v + "s div:hover{cursor:pointer;" + u + "-bottom:1px solid #" + k + ";" + s + "#" + h + ";-webkit-" + u + "-bottom-left-radius:0;-moz-" + u + "-radius-bottomleft:0;-webkit-" + u + "-bottom-right-radius:0;-moz-" + u + "-radius-bottomright:0}a" + v + "_selected,a" + v + "_selected:visited,a" + v + "_selected:hover,a" + v + "_selected:active,a" + v + "_selected:focus,div" + v + "_selected,div" + v;
        g += "_selected:hover{" + s + "#" + c + ";" + t + "#" + f + ";" + u + ":1px solid #" + j + ";" + u + "-bottom:1px solid #" + f + "}a" + y + "i{display:block;" + o + "4px 6px;" + u + ":1px solid #" + f + ";text-align:left;white-space:nowrap}a" + y + "i span{padding-left:20px}a" + y + "sss{font-weight:700}a" + y + "ind{display:inline;" + p + "0;" + o + "0}a" + y + "emailer{display:inline-block;" + u + ":1px solid #EEE;" + p + "0 9px;text-align:center}a" + y + "email_client{padding-left:6px}a" + y + "email_client span{display:inline-block;height:16px;line-height:16px;" + p + "0 2px;padding-left:0;width:16px}a" + x + "_show_more_less{" + p + "4px 0 8px;" + o + "0}a" + x + "_show_more_less span{display:inline-block;height:14px;" + p + "0 auto;vertical-align:baseline;width:16px}a" + x + "_powered_by,a" + x + "_powered_by:visited{" + t + "#" + k + ";font-size:9px;" + s + "#" + n + "}iframe" + y + "shim{" + u + ":0;position:absolute;z-index:999999}" + y + "dd img{" + u + ":0}" + A + "a2a" + d + "0!important}" + A + "agregator" + d + "-17" + z + "aiderss" + d + "-34" + z + "aim" + d + "-51" + z + "allvoices" + d + "-68" + z + "amazon" + d + "-85" + z + "aol" + d + "-102" + z + "apple_mail" + d + "-119" + z + "arto" + d + "-136" + z + "ask" + d + "-153" + z + "avantgo" + d + "-170" + z + "backflip" + d + "-187" + z + "bebo" + d + "-204" + z + "bibsonomy" + d + "-221" + z + "bitty" + d + "-238" + z + "blinklist" + d + "-255" + z + "blogger" + d;
        g += "-272" + z + "bloglines" + d + "-289" + z + "blogmarks" + d + "-306" + z + "blogrovr" + d + "-323" + z + "bookmark" + d + "-340" + z + "bookmarks_fr" + d + "-357" + z + "box" + d + "-374" + z + "buddymarks" + d + "-391" + z + "buzmob" + d + "-408" + z + "buzz" + d + "-425" + z + "bzzster" + d + "-442" + z + "care2" + d + "-459" + z + "chrome" + d + "-476" + z + "citeulike" + d + "-493" + z + "clear" + d + "-510" + z + "connotea" + d + "-527" + z + "current" + d + "-544" + z + "dailyme" + d + "-561" + z + "dailyrotation" + d + "-578" + z + "darr" + d + "-595" + z + "darr_wt" + d + "-612" + z + "default" + d + "-629" + z + "delicious" + d + "-646" + z + "designfloat" + d + "-663" + z + "digg" + d + "-680" + z + "diglog" + d + "-697" + z + "diigo" + d + "-714" + z + "dzone" + d + "-731" + z + "email" + d + "-748" + z + "eskobo" + d + "-765" + z + "evernote" + d + "-782" + z + "excitemix" + d + "-799" + z + "expression" + d + "-816" + z + "facebook" + d + "-833" + z + "fark" + d + "-850" + z + "faves" + d + "-867" + z + "feed" + d + "-884" + z + "feedblitz" + d + "-901" + z + "feedbucket" + d + "-918" + z + "feedlounge" + d + "-935" + z + "feedm8" + d + "-952" + z + "feedmailer" + d + "-969" + z + "feedreader_net" + d + "-986" + z + "feedshow" + d + "-1003" + z + "find" + d + "-1020" + z + "fireant" + d + "-1037" + z + "firefox" + d + "-1054" + z + "flurry" + d + "-1071" + z + "folkd" + d + "-1088" + z + "foxiewire" + d + "-1105" + z + "friendfeed" + d + "-1122" + z + "friendster" + d;
        g += "-1139" + z + "funp" + d + "-1156" + z + "furl" + d + "-1173" + z + "fwicki" + d + "-1189" + z + "gabbr" + d + "-1206" + z + "global_grind" + d + "-1223" + z + "gmail" + d + "-1240" + z + "google" + d + "-1257" + z + "google_buzz" + d + "-1274" + z + "healthranker" + d + "-1291" + z + "hellotxt" + d + "-1308" + z + "hemidemi" + d + "-1325" + z + "hi5" + d + "-1342" + z + "hubdog" + d + "-1359" + z + "hugg" + d + "-1376" + z + "hyves" + d + "-1393" + z + "identica" + d + "-1410" + z + "im" + d + "-1427" + z + "imera" + d + "-1444" + z + "instapaper" + d + "-1461" + z + "iterasi" + d + "-1478" + z + "itunes" + d + "-1495" + z + "jamespot" + d + "-1512" + z + "jots" + d + "-1529" + z + "jumptags" + d + "-1546" + z + "khabbr" + d + "-1563" + z + "kledy" + d + "-1580" + z + "klipfolio" + d + "-1597" + z + "linkagogo" + d + "-1614" + z + "linkatopia" + d + "-1631" + z + "linkedin" + d + "-1648" + z + "live" + d + "-1665" + z + "livejournal" + d + "-1682" + z + "ma_gnolia" + d + "-1699" + z + "maple" + d + "-1716" + z + "meneame" + d + "-1733" + z + "mindbodygreen" + d + "-1750" + z + "miro" + d + "-1767" + z + "mister-wong" + d + "-1784" + z + "mixx" + d + "-1801" + z + "mobile" + d + "-1818" + z + "mozillaca" + d + "-1835" + z + "msdn" + d + "-1852" + z + "multiply" + d + "-1869" + z + "my_msn" + d + "-1886" + z + "mylinkvault" + d + "-1903" + z + "myspace" + d + "-1920" + z + "netimechannel" + d + "-1937" + z + "netlog" + d + "-1954" + z + "netomat" + d;
        g += "-1971" + z + "netvibes" + d + "-1988" + z + "netvouz" + d + "-2005" + z + "newgie" + d + "-2022" + z + "newsalloy" + d + "-2039" + z + "newscabby" + d + "-2056" + z + "newsgator" + d + "-2073" + z + "newshutch" + d + "-2090" + z + "newsisfree" + d + "-2107" + z + "newstrust" + d + "-2124" + z + "newsvine" + d + "-2141" + z + "nowpublic" + d + "-2158" + z + "odeo" + d + "-2175" + z + "oneview" + d + "-2192" + z + "openbm" + d + "-2209" + z + "orkut" + d + "-2226" + z + "outlook" + d + "-2243" + z + "pageflakes" + d + "-2260" + z + "pdf" + d + "-2277" + z + "phonefavs" + d + "-2294" + z + "ping" + d + "-2311" + z + "plaxo" + d + "-2328" + z + "plurk" + d + "-2345" + z + "plusmo" + d + "-2362" + z + "podnova" + d + "-2379" + z + "posterous" + d + "-2396" + z + "print" + d + "-2413" + z + "printfriendly" + d + "-2430" + z + "propeller" + d + "-2447" + z + "protopage" + d + "-2464" + z + "pusha" + d + "-2481" + z + "rapidfeeds" + d + "-2498" + z + "rasasa" + d + "-2515" + z + "reader" + d + "-2532" + z + "reddit" + d + "-2549" + z + "rssfwd" + d + "-2566" + z + "segnalo" + d + "-2583" + z + "share" + d + "-2600" + z + "shoutwire" + d + "-2617" + z + "shyftr" + d + "-2634" + z + "simpy" + d + "-2651" + z + "sitejot" + d + "-2668" + z + "skimbit" + d + "-2685" + z + "slashdot" + d + "-2702" + z + "smaknews" + d + "-2719" + z + "sodahead" + d + "-2736" + z + "sofomo" + d + "-2753" + z + "spaces" + d + "-2770" + z + "sphere" + d + "-2787" + z + "sphinn" + d + "-2803" + z + "spurl" + d;
        g += "-2820" + z + "squidoo" + d + "-2837" + z + "startaid" + d + "-2854" + z + "strands" + d + "-2871" + z + "stumbleupon" + d + "-2888" + z + "stumpedia" + d + "-2905" + z + "symbaloo" + d + "-2922" + z + "taggly" + d + "-2939" + z + "tagza" + d + "-2956" + z + "tailrank" + d + "-2973" + z + "technet" + d + "-2990" + z + "technorati" + d + "-3007" + z + "technotizie" + d + "-3024" + z + "thefreedictionary" + d + "-3041" + z + "thefreelibrary" + d + "-3058" + z + "thunderbird" + d + "-3075" + z + "tipd" + d + "-3092" + z + "toolbar_google" + d + "-3109" + z + "tumblr" + d + "-3126" + z + "twiddla" + d + "-3143" + z + "twine" + d + "-3160" + z + "twitter" + d + "-3177" + z + "txtvox" + d + "-3194" + z + "typepad" + d + "-3211" + z + "uarr" + d + "-3228" + z + "uarr_wt" + d + "-3245" + z + "unalog" + d + "-3262" + z + "viadeo" + d + "-3279" + z + "webnews" + d + "-3296" + z + "webwag" + d + "-3314" + z + "wikio" + d + "-3331" + z + "windows_mail" + d + "-3348" + z + "wink" + d + "-3365" + z + "winksite" + d + "-3382" + z + "wists" + d + "-3399" + z + "wordpress" + d + "-3416" + z + "xanga" + d + "-3433" + z + "xerpi" + d + "-3450" + z + "xianguo" + d + "-3467" + z + "yahoo" + d + "-3484" + z + "yample" + d + "-3501" + z + "yigg" + d + "-3518" + z + "yim" + d + "-3535" + z + "yoolink" + d + "-3552" + z + "youmob" + d + "-3569" + z + "yourminis" + d + "-3586" + z + "zaptxt" + d + "-3603" + z + "zhuaxia" + d + "-3620" + z + "zune" + d + "-3637px;  }";
        i.setAttribute("type", "text/css");
        a2a.head_tag.appendChild(i);
        if (i.styleSheet) {
            i.styleSheet.cssText = g
        } else {
            q = document.createTextNode(g);
            i.appendChild(q)
            }
    },
    mk_srvc: function(a, c, g, i, h, j, d) {
        var k = document.createElement("a"),
        b = a2a.c,
        e = function() {
            a2a.linker(this)
            },
        f = b.tracking_callback;
        k.id = "a2a" + a2a.type + "_" + c;
        k.rel = "nofollow";
        k.className = "a2a_i";
        k.href = "/";
        k.target = "_blank";
        k.onmousedown = e;
        k.onkeydown = e;
        k.homepage = g;
        k.safename = c;
        k.servicename = a;
        k.serviceNameLowerCase = a.toLowerCase();
        k.innerHTML = "<span>" + a + "</span>";
        a2a.add_event(k, "click", function() {
            var l = a2a["n" + a2a.n];
            a2a.a2a_track("testShare1", a);
            if (l.track_pub) {
                a2a.a2a_track("z_" + l.track_pub + "Share", a)
                }
        });
        if (h) {
            k.stype = h
        }
        if (f && (typeof f == "function" || f.share || f[0] == "share")) {
            a2a.add_event(k, "click", function() {
                var l = a2a["n" + a2a.n],
                m = {
                    service: a,
                    title: l.linkname,
                    url: l.linkurl
                };
                if (f.share) {
                    f.share(m)
                    } else { (f[1]) ? f[1](m) : f(m)
                    }
            })
            }
        if (j) {
            k.customserviceuri = j
        }
        if (d) {
            k.firstChild.style.backgroundImage = "url(" + d + ")"
        } else {
            if (i) {
                k.firstChild.className = "a2a_i_" + i
            } else {
                k.firstChild.className = "a2a_i_default"
            }
        }
        return k
    },
    i18n: function() {
        if (a2a.c.static_server != ((a2a.c.ssl) ? a2a.c.ssl: "http://static.addtoany.com/menu")) {
            return false
        }
        var c = ["ar", "id", "ms", "bn", "bs", "bg", "ca", "ca-AD", "ca-ES", "cs", "cy", "da", "de", "dv", "el", "et", "es", "es-AR", "es-VE", "eo", "en-US", "eu", "fa", "fr", "fr-CA", "gd", "he", "hi", "hr", "is", "it", "ja", "ko", "ku", "lv", "lt", "hu", "mk", "nl", "no", "pl", "pt", "pt-BR", "pt-PT", "ro", "ru", "sr", "fi", "sk", "sl", "sv", "ta", "te", "tr", "uk", "vi", "zh-CN", "zh-TW"],
        d = a2a.c.locale || (navigator.browserLanguage || navigator.language).toLowerCase(),
        b = a2a.in_array(d, c, true);
        if (!b) {
            var a = d.indexOf("-");
            if (a != -1) {
                b = a2a.in_array(d.substr(0, a), c, true)
                }
        }
        if (d != "en-us" && b) {
            return b
        } else {
            return false
        }
    }
};
a2a.c = a2a_config;
a2a.make_once = function() {
    a2a.type = a2a.c.menu_type || "page";
    if (!a2a[a2a.type] && !window["a2a" + a2a.type + "_init"]) {
        a2a[a2a.type] = {};
        window.a2a_show_dropdown = a2a.show_menu;
        window.a2a_onMouseOut_delay = a2a.onMouseOut_delay;
        window.a2a_fluids = function() {};
        window.a2a_init = a2a.init;
        a2a.create_page_dropdown = function(y) {
            var g = a2a.gEl,
            l = a2a.type = y,
            j = "a2a" + l,
            x = a2a.c,
            w = x.localize;
            a2a.css();
            w = x.localize = {
                Share: w.Share || "Share",
                Save: w.Save || "Save",
                Subscribe: w.Subscribe || "Subscribe",
                Email: w.Email || "Email",
                Bookmark: w.Bookmark || "Bookmark",
                ShowAll: w.ShowAll || "Show all",
                ShowLess: w.ShowLess || "Show less",
                FindAnyServiceToAddTo: w.FindAnyServiceToAddTo || "Instantly find any service",
                PoweredBy: w.PoweredBy || "Powered by",
                AnyEmail: "Any email",
                ShareViaEmail: w.ShareViaEmail || "Share via email",
                SubscribeViaEmail: w.SubscribeViaEmail || "Subscribe via email",
                BookmarkInYourBrowser: w.BookmarkInYourBrowser || "Bookmark in your browser",
                BookmarkInstructions: w.BookmarkInstructions || "Press Ctrl+D or &#8984;+D to bookmark this page",
                AddToYourFavorites: w.AddToYourFavorites || "Add to Favorites",
                SendFromWebOrProgram: w.SendFromWebOrProgram || "Send from any other email service",
                EmailProgram: w.EmailProgram || "Email application"
            };
            var h = '<div id="a2a' + l + '_dropdown" class="a2a_menu" onmouseover="a2a.onMouseOver_stay()"' + ((a2a[l].onclick) ? "": ' onmouseout="a2a.onMouseOut_delay()"') + '><div class="a2a_menu_inside"><table><tr><td><div id="a2a' + l + '_title_container" class="a2a_menu_title_container"' + ((a2a[l].show_title) ? "": ' style="display:none"') + '><input id="a2a' + l + '_title" class="a2a_menu_title"/></div>';
            if (l == "page") {
                h += '<div class="a2a' + l + '_wide a2a_wide"><div class="a2a_tabs"><div id="a2a' + l + '_DEFAULT" class="a2a_tab_selected" style="margin-right:1px" onclick="return a2a.tabs(\'DEFAULT\')"><span class="a2a_i_share">' + w.Share + " / " + w.Save + '</span></div></div><div class="a2a_tabs"><div title="' + w.ShareViaEmail + '" id="a2a' + l + '_EMAIL" style="margin-right:1px" onclick="return a2a.tabs(\'EMAIL\',true)"><span class="a2a_i_email">' + w.Email + '</span></div></div><div class="a2a_tabs"><div onclick="a2a.bmBrowser()" title="' + w.BookmarkInYourBrowser + '" id="a2a' + l + '_BROWSER" style="margin-left:1px"><span class="a2a_i_bookmark">' + a2a.bmBrowser(1) + '</span></div></div></div><div class="a2a_clear"></div>'
            }
            if (l == "page") {
                h += '<div id="a2a' + l + '_find_container" class="a2a_menu_find_container"><input id="a2a' + l + '_find" class="a2a_menu_find" type="text" onclick="a2a.focus_find()" onkeyup="a2a.do_find()" autocomplete="off" onfocus="a2a[\'' + l + '\'].find_focused=true;a2a.onMouseOver_stay()" onblur="a2a.blur_find()" title="' + w.FindAnyServiceToAddTo + '"><span id="a2a' + l + '_find_icon" class="a2a_i_find" onclick="a2a.focus_find()"/></span></div>'
            }
            h += '<table id="a2a' + l + '_cols_container" class="a2a_cols_container"><tr><td class="a2a_cols"><div id="a2a' + l + '_col1"' + ((l == "mail") ? ' style="display:none"': "") + '></div><div id="a2a' + l + '_2_col1"' + ((l != "mail") ? ' style="display:none"': "") + '></div></td><td class="a2a_cols"><div id="a2a' + l + '_col2"' + ((l == "mail") ? ' style="display:none"': "") + '></div><div id="a2a' + l + '_2_col2"' + ((l != "mail") ? ' style="display:none"': "") + '></div></td></tr></table><div id="a2a' + l + '_note_BROWSER" class="a2a_note" style="display:none"></div><div id="a2a' + l + '_note_EMAIL" class="a2a_note"' + ((l != "mail") ? ' style="display:none"': "") + '><div class="a2a_hr"></div><div class="a2a_note_note">' + w.SendFromWebOrProgram + ':</div><div class="a2a_nowrap"><a href="/" id="a2a' + l + '_any_email" class="a2a_i a2a_emailer" target="_blank" servicename="Email (form)" safename="email_form" customserviceuri="http://www.addtoany.com/email?linkurl=A2A_LINKURL_ENC&amp;linkname=A2A_LINKNAME_ENC" onkeydown="a2a.linker(this)" onmousedown="a2a.linker(this)" onmouseup="a2a.a2a_track(\'testShare1\', \'Email\');if(a2a.c.track_pub)a2a.a2a_track(\'z_\'+a2a.c.track_pub+\'Share\', \'Email\')" style="margin-right:9px"><span class="a2a_i_email">' + w.AnyEmail + '</span></a><a href="/" class="a2a_i a2a_emailer a2a_email_client" id="a2a' + l + '_email_client" servicename="Email (mailto)" safename="email_mailto" customserviceuri="mailto:?subject=A2A_LINKNAME_ENC&amp;body=A2A_LINKURL_ENC" onkeydown="a2a.linker(this)" onmousedown="a2a.linker(this)" onmouseup="a2a.a2a_track(\'testShare1\', \'Email\');if(a2a.c.track_pub)a2a.a2a_track(\'z_\'+a2a.c.track_pub+\'Share\', \'Email\')" style="margin-left:9px"><span class="a2a_i_outlook">&nbsp;</span><span class="a2a_i_windows_mail">&nbsp;</span><span class="a2a_i_apple_mail">&nbsp;</span><span class="a2a_i_thunderbird">&nbsp;</span></a></div></div>';
            if (l != "mail") {
                h += '<div class="a2a' + l + '_wide a2a_wide"><a href="javascript:void(0)" id="a2a' + l + "_show_more_less\" class=\"a2a_menu_show_more_less\" onClick=\"return a2a.show_more_less(0)\" onmouseover=\"img=this.firstChild;if(a2a.c.color_arrow_hover=='fff'){if(img.className.indexOf('_wt')==-1)img.className+='_wt'}else img.className=img.className.replace(/_wt/,'')\" onmouseout=\"img=this.firstChild;if(a2a.c.color_arrow=='fff'){if(img.className.indexOf('_wt')==-1)img.className+='_wt'}else img.className=img.className.replace(/_wt/,'')\" title=\"" + w.ShowAll + '"><span class="a2a_i_darr' + ((x.color_arrow == "fff") ? "_wt": "") + '"></span></a></div>'
            }
            h += '<div class="a2a' + l + '_wide a2a_wide"><a href="http://www.addtoany.com/" id="a2a' + l + '_powered_by" class="a2a_menu_powered_by" target="_blank" title="Share &amp; Subscribe buttons" onmouseover="if(!window.opera)this.innerHTML=this.orig;this.style.textAlign=\'center\'">' + w.PoweredBy + " AddToAny</a></div></td></tr></table></div></div>";
            var s = "a2a_menu_container",
            v = g(s) || document.createElement("div");
            v.onmouseup = v.onmousedown = a2a.stopPropagation;
            v.innerHTML = h;
            if (v.id != s) {
                v.style.position = "static";
                document.body.insertBefore(v, document.body.firstChild)
                } else {
                x.border_size = 0
            }
            var k = new RegExp("[\\?&]awesm=([^&#]*)"),
            o = k.exec(window.location.href);
            if (o != null) {
                x.awesm = o[1]
                } else {
                x.awesm = false
            }
            var m = a2a.mk_srvc,
            n = {
                most: {},
                email: {}
            };
            n.most.col1 = [["Facebook", "facebook", "http://www.facebook.com/", "facebook"], ["Delicious", "delicious", "http://delicious.com/", "delicious"], ["Google Bookmarks", "google_bookmarks", "http://www.google.com/bookmarks", "google"], ["MySpace", "myspace", "http://www.myspace.com/", "myspace"], ["Yahoo Buzz", "yahoo_buzz", "http://buzz.yahoo.com/", "buzz"], ["StumbleUpon", "stumbleupon", "http://www.stumbleupon.com/", "stumbleupon"], ["Bebo", "bebo", "http://www.bebo.com/", "bebo"], ["WordPress", "wordpress", "http://wordpress.com/", "wordpress"], ["Orkut", "orkut", "http://www.orkut.com/", "orkut"], ["Evernote", "evernote", "http://www.evernote.com/", "evernote"], ["Stumpedia", "stumpedia", "http://www.stumpedia.com/", "stumpedia"], ["Posterous", "posterous", "http://posterous.com", "posterous"], ["MSDN", "msdn", "http://social.msdn.microsoft.com/", "msdn"], ["Expression", "expression", "http://social.expression.microsoft.com/", "expression"], ["Tipd", "tipd", "http://tipd.com/", "tipd"], ["Plurk", "plurk", "http://www.plurk.com/", "plurk"], ["Yahoo Messenger", "yahoo_messenger", "http://messenger.yahoo.com/", "yim"], ["Mozillaca", "mozillaca", "http://www.mozillaca.com/", "mozillaca"], ["TypePad Post", "typepad_post", "http://www.typepad.com/", "typepad"], ["Mixx", "mixx", "http://mixx.com/", "mixx"], ["Technorati Favorites", "technorati_favorites", "http://technorati.com/", "technorati"], ["CiteULike", "citeulike", "http://www.citeulike.org/", "citeulike"], ["Hemidemi", "hemidemi", "http://www.hemidemi.com/", "hemidemi"], ["Instapaper", "instapaper", "http://www.instapaper.com/", "instapaper"], ["Xerpi", "xerpi", "http://www.xerpi.com/", "xerpi"], ["Wink", "wink", "http://www.wink.com/", "wink"], ["BibSonomy", "bibsonomy", "http://www.bibsonomy.org/", "bibsonomy"], ["Tailrank", "tailrank", "http://www.tailrank.com/", "tailrank"], ["Kledy", "kledy", "http://www.kledy.de/", "kledy"], ["Meneame", "meneame", "http://meneame.net/", "meneame"], ["Bookmarks.fr", "bookmarks_fr", "http://www.bookmarks.fr/", "bookmarks_fr"], ["NewsVine", "newsvine", "http://www.newsvine.com/", "newsvine"], ["FriendFeed", "friendfeed", "http://friendfeed.com/", "friendfeed"], ["Ping", "ping", "http://ping.fm/", "ping"], ["Protopage Bookmarks", "protopage_bookmarks", "http://www.protopage.com/", "protopage"], ["Faves", "faves", "http://faves.com/", "faves"], ["Webnews", "webnews", "http://www.webnews.de/", "webnews"], ["Pusha", "pusha", "http://www.pusha.se/", "pusha"], ["Slashdot", "slashdot", "http://slashdot.org/", "slashdot"], ["Allvoices", "allvoices", "http://www.allvoices.com/", "allvoices"], ["Imera Brazil", "imera_brazil", "http://imera.com.br/", "imera"], ["LinkaGoGo", "linkagogo", "http://www.linkagogo.com/", "linkagogo"], ["unalog", "unalog", "http://unalog.com/", "unalog"], ["Diglog", "diglog", "http://www.diglog.com/", "diglog"], ["Tumblr", "tumblr", "http://www.tumblr.com/", "tumblr"], ["Current", "current", "http://current.com/", "current"], ["Spurl", "spurl", "http://www.spurl.net/", "spurl"], ["Oneview", "oneview", "http://www.oneview.de/", "oneview"], ["Simpy", "simpy", "http://www.simpy.com/", "simpy"], ["BuddyMarks", "buddymarks", "http://www.buddymarks.com/", "buddymarks"], ["Viadeo", "viadeo", "http://www.viadeo.com/", "viadeo"], ["Wists", "wists", "http://www.wists.com/", "wists"], ["Backflip", "backflip", "http://www.backflip.com/", "backflip"], ["SiteJot", "sitejot", "http://www.sitejot.com/", "sitejot"], ["DZone", "dzone", "http://www.dzone.com/", "dzone"], ["Hyves", "hyves", "http://www.hyves.nl/", "hyves"], ["Bitty Browser", "bitty_browser", "http://www.bitty.com/", "bitty"], ["Symbaloo Feeds", "symbaloo_feeds", "http://www.symbaloo.com/", "symbaloo"], ["Folkd", "folkd", "http://www.folkd.com/", "folkd"], ["NewsTrust", "newstrust", "http://newstrust.net/", "newstrust"], ["PrintFriendly", "printfriendly", "http://www.printfriendly.com", "printfriendly"], ["Tuenti", "tuenti", "http://www.tuenti.com/", "default"]];
            n.email.col1 = [["Google Gmail", "google_gmail", "", "gmail", "email"], ["Hotmail", "hotmail", "", "live", "email"]];
            n.most.col2 = [["Twitter", "twitter", "http://twitter.com/", "twitter"], ["Digg", "digg", "http://digg.com/", "digg"], ["Google Buzz", "google_buzz", "http://mail.google.com/mail/", "google_buzz"], ["Reddit", "reddit", "http://www.reddit.com/", "reddit"], ["Messenger", "live", "http://www.live.com/", "live"], ["Yahoo Bookmarks", "yahoo_bookmarks", "http://bookmarks.yahoo.com/", "yahoo"], ["Mister-Wong", "mister_wong", "http://www.mister-wong.com/", "mister-wong"], ["Google Reader", "google_reader", "http://www.google.com/reader/", "reader"], ["XING", "xing", "https://www.xing.com/", "default"], ["Netvibes Share", "netvibes_share", "http://www.netvibes.com/", "netvibes"], ["Strands", "strands", "http://www.strands.com/", "strands"], ["DailyMe", "dailyme", "http://dailyme.com/", "dailyme"], ["TechNet", "technet", "http://social.technet.microsoft.com/", "technet"], ["Arto", "arto", "http://www.arto.com/", "arto"], ["SmakNews", "smaknews", "http://smaknews.com/", "smaknews"], ["AIM", "aim", "http://www.aim.com/", "aim"], ["Identi.ca", "identi_ca", "http://identi.ca/", "identica"], ["Blogger Post", "blogger_post", "http://www.blogger.com/", "blogger"], ["Box.net", "box_net", "https://www.box.net/", "box"], ["Netlog", "netlog", "http://www.netlog.com/", "netlog"], ["Shoutwire", "shoutwire", "http://www.shoutwire.com/", "shoutwire"], ["Jumptags", "jumptags", "http://www.jumptags.com/", "jumptags"], ["FunP", "funp", "http://funp.com/", "funp"], ["PhoneFavs", "phonefavs", "http://phonefavs.com/", "phonefavs"], ["Netvouz", "netvouz", "http://www.netvouz.com/", "netvouz"], ["Diigo", "diigo", "http://www.diigo.com/", "diigo"], ["BlogMarks", "blogmarks", "http://blogmarks.net/", "blogmarks"], ["StartAid", "startaid", "http://www.startaid.com/", "startaid"], ["Khabbr", "khabbr", "http://www.khabbr.com/", "khabbr"], ["Yoolink", "yoolink", "http://www.yoolink.fr/", "yoolink"], ["Technotizie", "technotizie", "http://www.technotizie.it/", "technotizie"], ["Multiply", "multiply", "http://multiply.com/", "multiply"], ["Plaxo Pulse", "plaxo_pulse", "http://pulse.plaxo.com/pulse/", "plaxo"], ["Squidoo", "squidoo", "http://www.squidoo.com/", "squidoo"], ["Blinklist", "blinklist", "http://www.blinklist.com/", "blinklist"], ["YiGG", "yigg", "http://www.yigg.de/", "yigg"], ["Segnalo", "segnalo", "http://segnalo.alice.it/", "segnalo"], ["YouMob", "youmob", "http://youmob.com/", "youmob"], ["Fark", "fark", "http://www.fark.com/", "fark"], ["Jamespot", "jamespot", "http://www.jamespot.com/", "jamespot"], ["Twiddla", "twiddla", "http://www.twiddla.com/", "twiddla"], ["MindBodyGreen", "mindbodygreen", "http://www.mindbodygreen.com/", "mindbodygreen"], ["Hugg", "hugg", "http://www.hugg.com/", "hugg"], ["NowPublic", "nowpublic", "http://www.nowpublic.com/", "nowpublic"], ["LiveJournal", "livejournal", "http://www.livejournal.com/", "livejournal"], ["HelloTxt", "hellotxt", "http://hellotxt.com", "hellotxt"], ["Yample", "yample", "http://yample.com/", "yample"], ["Linkatopia", "linkatopia", "http://www.linkatopia.com/", "linkatopia"], ["LinkedIn", "linkedin", "http://www.linkedin.com/", "linkedin"], ["Ask.com MyStuff", "ask_com_mystuff", "http://mystuff.ask.com/", "ask"], ["Maple", "maple", "http://www.maple.nu/", "maple"], ["Connotea", "connotea", "http://www.connotea.org/", "connotea"], ["MyLinkVault", "mylinkvault", "http://www.mylinkvault.com/", "mylinkvault"], ["Sphinn", "sphinn", "http://sphinn.com/", "sphinn"], ["Care2 News", "care2_news", "http://www.care2.com/news/", "care2"], ["Sphere", "sphere", "http://www.sphere.com/", "sphere"], ["Gabbr", "gabbr", "http://www.gabbr.com/", "gabbr"], ["Tagza", "tagza", "http://www.tagza.com/", "tagza"], ["VodPod", "vodpod", "http://vodpod.com/", "default"], ["Amazon Wish List", "amazon_wish_list", "http://www.amazon.com/", "amazon"], ["Read It Later", "read_it_later", "http://readitlaterlist.com/", "default"], ["Email", "email", "http://www.addtoany.com/email", "email"]];
            n.email.col2 = [["Yahoo Mail", "yahoo_mail", "", "yahoo", "email"], ["AOL Mail", "aol_mail", "", "aol", "email"]];
            for (var p = 1; p < 3; p++) {
                if (l != "mail") {
                    for (var u = 0, f = n.most["col" + p], r = f.length; u < r; u++) {
                        var t = f[u];
                        g(j + "_col" + p).appendChild(m(t[0], t[1], t[2], t[3], t[4]))
                        }
                }
                for (var u = 0, e = n.email["col" + p], q = e.length; u < q; u++) {
                    var t = e[u];
                    g(j + "_2_col" + p).appendChild(m(t[0], t[1], t[2], t[3], t[4]))
                    }
            }
            a2a.services = n.most.col1.concat(n.most.col2).concat(n.email.col1.concat(n.email.col2));
            if (l == "page") {
                a2a.statusbar(g(j + "_DEFAULT"), w.Share + " / " + w.Save);
                a2a.statusbar(g(j + "_EMAIL"), w.ShareViaEmail);
                a2a.statusbar(g(j + "_BROWSER"), w.BookmarkInYourBrowser)
                }
            a2a.statusbar(g(j + "_email_client"), w.EmailProgram);
            if (l == "page") {
                a2a.statusbar(g(j + "_show_more_less"), w.ShowAll);
                a2a.statusbar(g(j + "_find"), w.FindAnyServiceToAddTo)
                }
            a2a.prioritize_services();
            a2a.add_srvcs();
            a2a.user_services();
            a2a.collections(l);
            a2a.default_services()
            };
        var c = a2a.type,
        a = a2a[c],
        b = a2a.c;
        a.find_focused = false;
        a.show_all = false;
        a.inFocus = false;
        a.prev_keydown = document.onkeydown || false;
        a.tab = "DEFAULT";
        a.onclick = b.onclick || false;
        a.show_title = b.show_title || false;
        a.num_services = b.num_services || 10;
        a.custom_services = b.custom_services || false;
        a2a.locale = a2a.i18n();
        if (a2a.locale && a2a.locale != "custom") {
            a2a.loadExtScript(b.static_server + "/locale/" + a2a.locale + ".js", function() {
                return (a2a_localize != "")
                }, function() {
                b.localize = a2a_localize;
                b.add_services = window.a2a_add_services;
                a2a.create_page_dropdown(c);
                while (a2a.fn_queue.length > 0) { (a2a.fn_queue.shift())()
                    }
                a2a.locale = null;
                a2a.GA(1);
                a2a.init_show()
                });
            b.menu_type = b.email_menu = false
        } else {
            a2a.create_page_dropdown(c);
            a2a.GA()
            }
        try {
            document.execCommand("BackgroundImageCache", false, true)
            } catch(d) {}
        a2a.a2a_track("TestHit1");
        if (!b.ssl && !b.no_3p && document.cookie.indexOf("wp-settings") == -1 && document.cookie.indexOf("SESS") == -1) {
            a2a.track("http://map.media6degrees.com/orbserv/hbpix?pixId=2869&curl=" + encodeURIComponent(location.href))
            }
    }
};
a2a.make_once();
a2a.init(); (function() {
    var a = a2a.c.tracking_callback;
    if (a) {
        if (a.ready) {
            a.ready();
            a.ready = null
        } else {
            if (a[0] == "ready") {
                a[1]();
                a = null
            }
        }
    }
})();