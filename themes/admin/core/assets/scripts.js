function clone() {
    removeTinyMces(), $(".input-limit").remove();
    var $list = $("#meta"), $firstItem = $list.children("li").first(), clone = $firstItem.clone();
    $(clone).find("input,textarea").val(""), $(clone).find(".chbx").empty(), $checkboxes = $(clone).find(".chbx"), 
    $checkboxes.length > 1 && ($i = 1, $checkboxes.each(function() {
        $i < $checkboxes.length && $(this).remove(), $i++;
    })), $(clone).find("div.error").remove(), $(clone).find(".chbx").last().append('<a href="javascript:void(0)" onclick="removeMeta(this)">- Delete</a>'), 
    $(clone).find("span").text($list.children("li").length + 1), $(clone).find("textarea").attr("id", "tinymce" + ($(".tinymce").length + 1)), 
    $(clone).find("div.admin-image-show").remove(), $list.append(clone), addTinyMces(), 
    $(".LimitChar").limitinput();
}

function addTinyMces() {
    $("#meta textarea").each(function() {
        tinymce.EditorManager.execCommand("mceAddEditor", !0, $(this).attr("id"));
    });
}

function removeTinyMces() {
    $("#meta textarea").each(function() {
        tinymce.EditorManager.execCommand("mceRemoveEditor", !0, $(this).attr("id"));
    });
}

function removeMeta(el) {
    $(el).parents(".admin-section-t2").remove();
}

function clone(listSelector, limit) {
    if (listSelector = void 0 !== listSelector ? listSelector : "#meta", !((limit = void 0 !== limit ? limit : 0) && $(listSelector).children("li").length >= limit)) {
        removeTinyMces(listSelector), $(".input-limit").remove();
        var $list = $(listSelector), $firstItem = $list.children("li").first(), clone = $firstItem.clone();
        $(clone).find("input,textarea").val(""), $(clone).find(".chbx").empty(), $checkboxes = $(clone).find(".chbx"), 
        $checkboxes.length > 1 && ($i = 1, $checkboxes.each(function() {
            $i < $checkboxes.length && $(this).remove(), $i++;
        })), $(clone).find("a").remove(), $(clone).find(".chbx").last().append('<a href="javascript:void(0)" onclick="removeMeta(this)">- Delete</a>'), 
        $(clone).find("textarea.tinymce").attr("id", "tinymce" + ($(".tinymce").length + 1)), 
        $(clone).find("div.admin-image-show").remove(), $list.append(clone), $(".timepicker").pickatime(), 
        $(".datepicker").pikaday({
            firstDay: 1,
            minDate: new Date(),
            format: "MM/DD/YYYY",
            onOpen: function(e) {
                console.log(e);
            }
        }).on("focus blur", function() {
            $(this).keyup();
        }), addTinyMces(listSelector), $(".LimitChar").limitinput();
    }
}

function removeTinyMces(listSelector) {
    console.log("remove tiny mces for list selector: " + listSelector), $(listSelector + " textarea.tinymce").each(function() {
        tinymce.EditorManager.execCommand("mceRemoveEditor", !0, $(this).attr("id"));
    });
}

function addTinyMces(listSelector) {
    $(listSelector + " textarea.tinymce").each(function() {
        tinymce.EditorManager.execCommand("mceAddEditor", !0, $(this).attr("id"));
    });
}

function removeMeta(el) {
    $(el).parents(".admin-section-t2").remove();
}

function reSort(el) {
    var $this = $(el), thisNewOrder = $this.val(), i = 1;
    $("select[name='" + $this.attr("name") + "']").each(function() {
        console.log("i:" + i + " thisNewOrder:" + thisNewOrder), console.log($(this)), i == thisNewOrder && i++, 
        $(this).is($this) || ($(this).val(i), i++);
    });
}

!function(a, b) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function(a) {
        if (!a.document) throw new Error("jQuery requires a window with a document");
        return b(a);
    } : b(a);
}("undefined" != typeof window ? window : this, function(a, b) {
    function r(a) {
        var b = a.length, c = m.type(a);
        return "function" !== c && !m.isWindow(a) && (!(1 !== a.nodeType || !b) || ("array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a));
    }
    function w(a, b, c) {
        if (m.isFunction(b)) return m.grep(a, function(a, d) {
            return !!b.call(a, d, a) !== c;
        });
        if (b.nodeType) return m.grep(a, function(a) {
            return a === b !== c;
        });
        if ("string" == typeof b) {
            if (v.test(b)) return m.filter(b, a, c);
            b = m.filter(b, a);
        }
        return m.grep(a, function(a) {
            return m.inArray(a, b) >= 0 !== c;
        });
    }
    function D(a, b) {
        do {
            a = a[b];
        } while (a && 1 !== a.nodeType);
        return a;
    }
    function G(a) {
        var b = F[a] = {};
        return m.each(a.match(E) || [], function(a, c) {
            b[c] = !0;
        }), b;
    }
    function I() {
        y.addEventListener ? (y.removeEventListener("DOMContentLoaded", J, !1), a.removeEventListener("load", J, !1)) : (y.detachEvent("onreadystatechange", J), 
        a.detachEvent("onload", J));
    }
    function J() {
        (y.addEventListener || "load" === event.type || "complete" === y.readyState) && (I(), 
        m.ready());
    }
    function O(a, b, c) {
        if (void 0 === c && 1 === a.nodeType) {
            var d = "data-" + b.replace(N, "-$1").toLowerCase();
            if ("string" == typeof (c = a.getAttribute(d))) {
                try {
                    c = "true" === c || "false" !== c && ("null" === c ? null : +c + "" === c ? +c : M.test(c) ? m.parseJSON(c) : c);
                } catch (e) {}
                m.data(a, b, c);
            } else c = void 0;
        }
        return c;
    }
    function P(a) {
        var b;
        for (b in a) if (("data" !== b || !m.isEmptyObject(a[b])) && "toJSON" !== b) return !1;
        return !0;
    }
    function Q(a, b, d, e) {
        if (m.acceptData(a)) {
            var f, g, h = m.expando, i = a.nodeType, j = i ? m.cache : a, k = i ? a[h] : a[h] && h;
            if (k && j[k] && (e || j[k].data) || void 0 !== d || "string" != typeof b) return k || (k = i ? a[h] = c.pop() || m.guid++ : h), 
            j[k] || (j[k] = i ? {} : {
                toJSON: m.noop
            }), ("object" == typeof b || "function" == typeof b) && (e ? j[k] = m.extend(j[k], b) : j[k].data = m.extend(j[k].data, b)), 
            g = j[k], e || (g.data || (g.data = {}), g = g.data), void 0 !== d && (g[m.camelCase(b)] = d), 
            "string" == typeof b ? null == (f = g[b]) && (f = g[m.camelCase(b)]) : f = g, f;
        }
    }
    function R(a, b, c) {
        if (m.acceptData(a)) {
            var d, e, f = a.nodeType, g = f ? m.cache : a, h = f ? a[m.expando] : m.expando;
            if (g[h]) {
                if (b && (d = c ? g[h] : g[h].data)) {
                    m.isArray(b) ? b = b.concat(m.map(b, m.camelCase)) : b in d ? b = [ b ] : (b = m.camelCase(b), 
                    b = b in d ? [ b ] : b.split(" ")), e = b.length;
                    for (;e--; ) delete d[b[e]];
                    if (c ? !P(d) : !m.isEmptyObject(d)) return;
                }
                (c || (delete g[h].data, P(g[h]))) && (f ? m.cleanData([ a ], !0) : k.deleteExpando || g != g.window ? delete g[h] : g[h] = null);
            }
        }
    }
    function ab() {
        return !0;
    }
    function bb() {
        return !1;
    }
    function cb() {
        try {
            return y.activeElement;
        } catch (a) {}
    }
    function db(a) {
        var b = eb.split("|"), c = a.createDocumentFragment();
        if (c.createElement) for (;b.length; ) c.createElement(b.pop());
        return c;
    }
    function ub(a, b) {
        var c, d, e = 0, f = typeof a.getElementsByTagName !== K ? a.getElementsByTagName(b || "*") : typeof a.querySelectorAll !== K ? a.querySelectorAll(b || "*") : void 0;
        if (!f) for (f = [], c = a.childNodes || a; null != (d = c[e]); e++) !b || m.nodeName(d, b) ? f.push(d) : m.merge(f, ub(d, b));
        return void 0 === b || b && m.nodeName(a, b) ? m.merge([ a ], f) : f;
    }
    function vb(a) {
        W.test(a.type) && (a.defaultChecked = a.checked);
    }
    function wb(a, b) {
        return m.nodeName(a, "table") && m.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a;
    }
    function xb(a) {
        return a.type = (null !== m.find.attr(a, "type")) + "/" + a.type, a;
    }
    function yb(a) {
        var b = pb.exec(a.type);
        return b ? a.type = b[1] : a.removeAttribute("type"), a;
    }
    function zb(a, b) {
        for (var c, d = 0; null != (c = a[d]); d++) m._data(c, "globalEval", !b || m._data(b[d], "globalEval"));
    }
    function Ab(a, b) {
        if (1 === b.nodeType && m.hasData(a)) {
            var c, d, e, f = m._data(a), g = m._data(b, f), h = f.events;
            if (h) {
                delete g.handle, g.events = {};
                for (c in h) for (d = 0, e = h[c].length; e > d; d++) m.event.add(b, c, h[c][d]);
            }
            g.data && (g.data = m.extend({}, g.data));
        }
    }
    function Bb(a, b) {
        var c, d, e;
        if (1 === b.nodeType) {
            if (c = b.nodeName.toLowerCase(), !k.noCloneEvent && b[m.expando]) {
                e = m._data(b);
                for (d in e.events) m.removeEvent(b, d, e.handle);
                b.removeAttribute(m.expando);
            }
            "script" === c && b.text !== a.text ? (xb(b).text = a.text, yb(b)) : "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), 
            k.html5Clone && a.innerHTML && !m.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && W.test(a.type) ? (b.defaultChecked = b.checked = a.checked, 
            b.value !== a.value && (b.value = a.value)) : "option" === c ? b.defaultSelected = b.selected = a.defaultSelected : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue);
        }
    }
    function Eb(b, c) {
        var d, e = m(c.createElement(b)).appendTo(c.body), f = a.getDefaultComputedStyle && (d = a.getDefaultComputedStyle(e[0])) ? d.display : m.css(e[0], "display");
        return e.detach(), f;
    }
    function Fb(a) {
        var b = y, c = Db[a];
        return c || (c = Eb(a, b), "none" !== c && c || (Cb = (Cb || m("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), 
        b = (Cb[0].contentWindow || Cb[0].contentDocument).document, b.write(), b.close(), 
        c = Eb(a, b), Cb.detach()), Db[a] = c), c;
    }
    function Lb(a, b) {
        return {
            get: function() {
                var c = a();
                if (null != c) return c ? void delete this.get : (this.get = b).apply(this, arguments);
            }
        };
    }
    function Ub(a, b) {
        if (b in a) return b;
        for (var c = b.charAt(0).toUpperCase() + b.slice(1), d = b, e = Tb.length; e--; ) if ((b = Tb[e] + c) in a) return b;
        return d;
    }
    function Vb(a, b) {
        for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g], d.style && (f[g] = m._data(d, "olddisplay"), 
        c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && U(d) && (f[g] = m._data(d, "olddisplay", Fb(d.nodeName)))) : (e = U(d), 
        (c && "none" !== c || !e) && m._data(d, "olddisplay", e ? c : m.css(d, "display"))));
        for (g = 0; h > g; g++) d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
        return a;
    }
    function Wb(a, b, c) {
        var d = Pb.exec(b);
        return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b;
    }
    function Xb(a, b, c, d, e) {
        for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) "margin" === c && (g += m.css(a, c + T[f], !0, e)), 
        d ? ("content" === c && (g -= m.css(a, "padding" + T[f], !0, e)), "margin" !== c && (g -= m.css(a, "border" + T[f] + "Width", !0, e))) : (g += m.css(a, "padding" + T[f], !0, e), 
        "padding" !== c && (g += m.css(a, "border" + T[f] + "Width", !0, e)));
        return g;
    }
    function Yb(a, b, c) {
        var d = !0, e = "width" === b ? a.offsetWidth : a.offsetHeight, f = Ib(a), g = k.boxSizing && "border-box" === m.css(a, "boxSizing", !1, f);
        if (0 >= e || null == e) {
            if (e = Jb(a, b, f), (0 > e || null == e) && (e = a.style[b]), Hb.test(e)) return e;
            d = g && (k.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0;
        }
        return e + Xb(a, b, c || (g ? "border" : "content"), d, f) + "px";
    }
    function Zb(a, b, c, d, e) {
        return new Zb.prototype.init(a, b, c, d, e);
    }
    function fc() {
        return setTimeout(function() {
            $b = void 0;
        }), $b = m.now();
    }
    function gc(a, b) {
        var c, d = {
            height: a
        }, e = 0;
        for (b = b ? 1 : 0; 4 > e; e += 2 - b) c = T[e], d["margin" + c] = d["padding" + c] = a;
        return b && (d.opacity = d.width = a), d;
    }
    function hc(a, b, c) {
        for (var d, e = (ec[b] || []).concat(ec["*"]), f = 0, g = e.length; g > f; f++) if (d = e[f].call(c, b, a)) return d;
    }
    function ic(a, b, c) {
        var d, e, f, g, h, i, j, n = this, o = {}, p = a.style, q = a.nodeType && U(a), r = m._data(a, "fxshow");
        c.queue || (h = m._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, 
        h.empty.fire = function() {
            h.unqueued || i();
        }), h.unqueued++, n.always(function() {
            n.always(function() {
                h.unqueued--, m.queue(a, "fx").length || h.empty.fire();
            });
        })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [ p.overflow, p.overflowX, p.overflowY ], 
        j = m.css(a, "display"), "inline" === ("none" === j ? m._data(a, "olddisplay") || Fb(a.nodeName) : j) && "none" === m.css(a, "float") && (k.inlineBlockNeedsLayout && "inline" !== Fb(a.nodeName) ? p.zoom = 1 : p.display = "inline-block")), 
        c.overflow && (p.overflow = "hidden", k.shrinkWrapBlocks() || n.always(function() {
            p.overflow = c.overflow[0], p.overflowX = c.overflow[1], p.overflowY = c.overflow[2];
        }));
        for (d in b) if (e = b[d], ac.exec(e)) {
            if (delete b[d], f = f || "toggle" === e, e === (q ? "hide" : "show")) {
                if ("show" !== e || !r || void 0 === r[d]) continue;
                q = !0;
            }
            o[d] = r && r[d] || m.style(a, d);
        } else j = void 0;
        if (m.isEmptyObject(o)) "inline" === ("none" === j ? Fb(a.nodeName) : j) && (p.display = j); else {
            r ? "hidden" in r && (q = r.hidden) : r = m._data(a, "fxshow", {}), f && (r.hidden = !q), 
            q ? m(a).show() : n.done(function() {
                m(a).hide();
            }), n.done(function() {
                var b;
                m._removeData(a, "fxshow");
                for (b in o) m.style(a, b, o[b]);
            });
            for (d in o) g = hc(q ? r[d] : 0, d, n), d in r || (r[d] = g.start, q && (g.end = g.start, 
            g.start = "width" === d || "height" === d ? 1 : 0));
        }
    }
    function jc(a, b) {
        var c, d, e, f, g;
        for (c in a) if (d = m.camelCase(c), e = b[d], f = a[c], m.isArray(f) && (e = f[1], 
        f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), (g = m.cssHooks[d]) && "expand" in g) {
            f = g.expand(f), delete a[d];
            for (c in f) c in a || (a[c] = f[c], b[c] = e);
        } else b[d] = e;
    }
    function kc(a, b, c) {
        var d, e, f = 0, g = dc.length, h = m.Deferred().always(function() {
            delete i.elem;
        }), i = function() {
            if (e) return !1;
            for (var b = $b || fc(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++) j.tweens[g].run(f);
            return h.notifyWith(a, [ j, f, c ]), 1 > f && i ? c : (h.resolveWith(a, [ j ]), 
            !1);
        }, j = h.promise({
            elem: a,
            props: m.extend({}, b),
            opts: m.extend(!0, {
                specialEasing: {}
            }, c),
            originalProperties: b,
            originalOptions: c,
            startTime: $b || fc(),
            duration: c.duration,
            tweens: [],
            createTween: function(b, c) {
                var d = m.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                return j.tweens.push(d), d;
            },
            stop: function(b) {
                var c = 0, d = b ? j.tweens.length : 0;
                if (e) return this;
                for (e = !0; d > c; c++) j.tweens[c].run(1);
                return b ? h.resolveWith(a, [ j, b ]) : h.rejectWith(a, [ j, b ]), this;
            }
        }), k = j.props;
        for (jc(k, j.opts.specialEasing); g > f; f++) if (d = dc[f].call(j, a, k, j.opts)) return d;
        return m.map(k, hc, j), m.isFunction(j.opts.start) && j.opts.start.call(a, j), m.fx.timer(m.extend(i, {
            elem: a,
            anim: j,
            queue: j.opts.queue
        })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always);
    }
    function Lc(a) {
        return function(b, c) {
            "string" != typeof b && (c = b, b = "*");
            var d, e = 0, f = b.toLowerCase().match(E) || [];
            if (m.isFunction(c)) for (;d = f[e++]; ) "+" === d.charAt(0) ? (d = d.slice(1) || "*", 
            (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c);
        };
    }
    function Mc(a, b, c, d) {
        function g(h) {
            var i;
            return e[h] = !0, m.each(a[h] || [], function(a, h) {
                var j = h(b, c, d);
                return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), 
                g(j), !1);
            }), i;
        }
        var e = {}, f = a === Ic;
        return g(b.dataTypes[0]) || !e["*"] && g("*");
    }
    function Nc(a, b) {
        var c, d, e = m.ajaxSettings.flatOptions || {};
        for (d in b) void 0 !== b[d] && ((e[d] ? a : c || (c = {}))[d] = b[d]);
        return c && m.extend(!0, a, c), a;
    }
    function Oc(a, b, c) {
        for (var d, e, f, g, h = a.contents, i = a.dataTypes; "*" === i[0]; ) i.shift(), 
        void 0 === e && (e = a.mimeType || b.getResponseHeader("Content-Type"));
        if (e) for (g in h) if (h[g] && h[g].test(e)) {
            i.unshift(g);
            break;
        }
        if (i[0] in c) f = i[0]; else {
            for (g in c) {
                if (!i[0] || a.converters[g + " " + i[0]]) {
                    f = g;
                    break;
                }
                d || (d = g);
            }
            f = f || d;
        }
        return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0;
    }
    function Pc(a, b, c, d) {
        var e, f, g, h, i, j = {}, k = a.dataTypes.slice();
        if (k[1]) for (g in a.converters) j[g.toLowerCase()] = a.converters[g];
        for (f = k.shift(); f; ) if (a.responseFields[f] && (c[a.responseFields[f]] = b), 
        !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift()) if ("*" === f) f = i; else if ("*" !== i && i !== f) {
            if (!(g = j[i + " " + f] || j["* " + f])) for (e in j) if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                !0 === g ? g = j[e] : !0 !== j[e] && (f = h[0], k.unshift(h[1]));
                break;
            }
            if (!0 !== g) if (g && a.throws) b = g(b); else try {
                b = g(b);
            } catch (l) {
                return {
                    state: "parsererror",
                    error: g ? l : "No conversion from " + i + " to " + f
                };
            }
        }
        return {
            state: "success",
            data: b
        };
    }
    function Vc(a, b, c, d) {
        var e;
        if (m.isArray(b)) m.each(b, function(b, e) {
            c || Rc.test(a) ? d(a, e) : Vc(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d);
        }); else if (c || "object" !== m.type(b)) d(a, b); else for (e in b) Vc(a + "[" + e + "]", b[e], c, d);
    }
    function Zc() {
        try {
            return new a.XMLHttpRequest();
        } catch (b) {}
    }
    function $c() {
        try {
            return new a.ActiveXObject("Microsoft.XMLHTTP");
        } catch (b) {}
    }
    function dd(a) {
        return m.isWindow(a) ? a : 9 === a.nodeType && (a.defaultView || a.parentWindow);
    }
    var c = [], d = c.slice, e = c.concat, f = c.push, g = c.indexOf, h = {}, i = h.toString, j = h.hasOwnProperty, k = {}, l = "1.11.1", m = function(a, b) {
        return new m.fn.init(a, b);
    }, n = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, o = /^-ms-/, p = /-([\da-z])/gi, q = function(a, b) {
        return b.toUpperCase();
    };
    m.fn = m.prototype = {
        jquery: l,
        constructor: m,
        selector: "",
        length: 0,
        toArray: function() {
            return d.call(this);
        },
        get: function(a) {
            return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this);
        },
        pushStack: function(a) {
            var b = m.merge(this.constructor(), a);
            return b.prevObject = this, b.context = this.context, b;
        },
        each: function(a, b) {
            return m.each(this, a, b);
        },
        map: function(a) {
            return this.pushStack(m.map(this, function(b, c) {
                return a.call(b, c, b);
            }));
        },
        slice: function() {
            return this.pushStack(d.apply(this, arguments));
        },
        first: function() {
            return this.eq(0);
        },
        last: function() {
            return this.eq(-1);
        },
        eq: function(a) {
            var b = this.length, c = +a + (0 > a ? b : 0);
            return this.pushStack(c >= 0 && b > c ? [ this[c] ] : []);
        },
        end: function() {
            return this.prevObject || this.constructor(null);
        },
        push: f,
        sort: c.sort,
        splice: c.splice
    }, m.extend = m.fn.extend = function() {
        var a, b, c, d, e, f, g = arguments[0] || {}, h = 1, i = arguments.length, j = !1;
        for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || m.isFunction(g) || (g = {}), 
        h === i && (g = this, h--); i > h; h++) if (null != (e = arguments[h])) for (d in e) a = g[d], 
        c = e[d], g !== c && (j && c && (m.isPlainObject(c) || (b = m.isArray(c))) ? (b ? (b = !1, 
        f = a && m.isArray(a) ? a : []) : f = a && m.isPlainObject(a) ? a : {}, g[d] = m.extend(j, f, c)) : void 0 !== c && (g[d] = c));
        return g;
    }, m.extend({
        expando: "jQuery" + (l + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(a) {
            throw new Error(a);
        },
        noop: function() {},
        isFunction: function(a) {
            return "function" === m.type(a);
        },
        isArray: Array.isArray || function(a) {
            return "array" === m.type(a);
        },
        isWindow: function(a) {
            return null != a && a == a.window;
        },
        isNumeric: function(a) {
            return !m.isArray(a) && a - parseFloat(a) >= 0;
        },
        isEmptyObject: function(a) {
            var b;
            for (b in a) return !1;
            return !0;
        },
        isPlainObject: function(a) {
            var b;
            if (!a || "object" !== m.type(a) || a.nodeType || m.isWindow(a)) return !1;
            try {
                if (a.constructor && !j.call(a, "constructor") && !j.call(a.constructor.prototype, "isPrototypeOf")) return !1;
            } catch (c) {
                return !1;
            }
            if (k.ownLast) for (b in a) return j.call(a, b);
            for (b in a) ;
            return void 0 === b || j.call(a, b);
        },
        type: function(a) {
            return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object" : typeof a;
        },
        globalEval: function(b) {
            b && m.trim(b) && (a.execScript || function(b) {
                a.eval.call(a, b);
            })(b);
        },
        camelCase: function(a) {
            return a.replace(o, "ms-").replace(p, q);
        },
        nodeName: function(a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase();
        },
        each: function(a, b, c) {
            var e = 0, f = a.length, g = r(a);
            if (c) {
                if (g) for (;f > e && !1 !== b.apply(a[e], c); e++) ; else for (e in a) if (!1 === b.apply(a[e], c)) break;
            } else if (g) for (;f > e && !1 !== b.call(a[e], e, a[e]); e++) ; else for (e in a) if (!1 === b.call(a[e], e, a[e])) break;
            return a;
        },
        trim: function(a) {
            return null == a ? "" : (a + "").replace(n, "");
        },
        makeArray: function(a, b) {
            var c = b || [];
            return null != a && (r(Object(a)) ? m.merge(c, "string" == typeof a ? [ a ] : a) : f.call(c, a)), 
            c;
        },
        inArray: function(a, b, c) {
            var d;
            if (b) {
                if (g) return g.call(b, a, c);
                for (d = b.length, c = c ? 0 > c ? Math.max(0, d + c) : c : 0; d > c; c++) if (c in b && b[c] === a) return c;
            }
            return -1;
        },
        merge: function(a, b) {
            for (var c = +b.length, d = 0, e = a.length; c > d; ) a[e++] = b[d++];
            if (c !== c) for (;void 0 !== b[d]; ) a[e++] = b[d++];
            return a.length = e, a;
        },
        grep: function(a, b, c) {
            for (var e = [], f = 0, g = a.length, h = !c; g > f; f++) !b(a[f], f) !== h && e.push(a[f]);
            return e;
        },
        map: function(a, b, c) {
            var d, f = 0, g = a.length, h = r(a), i = [];
            if (h) for (;g > f; f++) null != (d = b(a[f], f, c)) && i.push(d); else for (f in a) null != (d = b(a[f], f, c)) && i.push(d);
            return e.apply([], i);
        },
        guid: 1,
        proxy: function(a, b) {
            var c, e, f;
            return "string" == typeof b && (f = a[b], b = a, a = f), m.isFunction(a) ? (c = d.call(arguments, 2), 
            e = function() {
                return a.apply(b || this, c.concat(d.call(arguments)));
            }, e.guid = a.guid = a.guid || m.guid++, e) : void 0;
        },
        now: function() {
            return +new Date();
        },
        support: k
    }), m.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(a, b) {
        h["[object " + b + "]"] = b.toLowerCase();
    });
    var s = function(a) {
        function fb(a, b, d, e) {
            var f, h, j, k, l, o, r, s, w, x;
            if ((b ? b.ownerDocument || b : v) !== n && m(b), b = b || n, d = d || [], !a || "string" != typeof a) return d;
            if (1 !== (k = b.nodeType) && 9 !== k) return [];
            if (p && !e) {
                if (f = _.exec(a)) if (j = f[1]) {
                    if (9 === k) {
                        if (!(h = b.getElementById(j)) || !h.parentNode) return d;
                        if (h.id === j) return d.push(h), d;
                    } else if (b.ownerDocument && (h = b.ownerDocument.getElementById(j)) && t(b, h) && h.id === j) return d.push(h), 
                    d;
                } else {
                    if (f[2]) return I.apply(d, b.getElementsByTagName(a)), d;
                    if ((j = f[3]) && c.getElementsByClassName && b.getElementsByClassName) return I.apply(d, b.getElementsByClassName(j)), 
                    d;
                }
                if (c.qsa && (!q || !q.test(a))) {
                    if (s = r = u, w = b, x = 9 === k && a, 1 === k && "object" !== b.nodeName.toLowerCase()) {
                        for (o = g(a), (r = b.getAttribute("id")) ? s = r.replace(bb, "\\$&") : b.setAttribute("id", s), 
                        s = "[id='" + s + "'] ", l = o.length; l--; ) o[l] = s + qb(o[l]);
                        w = ab.test(a) && ob(b.parentNode) || b, x = o.join(",");
                    }
                    if (x) try {
                        return I.apply(d, w.querySelectorAll(x)), d;
                    } catch (y) {} finally {
                        r || b.removeAttribute("id");
                    }
                }
            }
            return i(a.replace(R, "$1"), b, d, e);
        }
        function gb() {
            function b(c, e) {
                return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e;
            }
            var a = [];
            return b;
        }
        function hb(a) {
            return a[u] = !0, a;
        }
        function ib(a) {
            var b = n.createElement("div");
            try {
                return !!a(b);
            } catch (c) {
                return !1;
            } finally {
                b.parentNode && b.parentNode.removeChild(b), b = null;
            }
        }
        function jb(a, b) {
            for (var c = a.split("|"), e = a.length; e--; ) d.attrHandle[c[e]] = b;
        }
        function kb(a, b) {
            var c = b && a, d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || D) - (~a.sourceIndex || D);
            if (d) return d;
            if (c) for (;c = c.nextSibling; ) if (c === b) return -1;
            return a ? 1 : -1;
        }
        function nb(a) {
            return hb(function(b) {
                return b = +b, hb(function(c, d) {
                    for (var e, f = a([], c.length, b), g = f.length; g--; ) c[e = f[g]] && (c[e] = !(d[e] = c[e]));
                });
            });
        }
        function ob(a) {
            return a && typeof a.getElementsByTagName !== C && a;
        }
        function pb() {}
        function qb(a) {
            for (var b = 0, c = a.length, d = ""; c > b; b++) d += a[b].value;
            return d;
        }
        function rb(a, b, c) {
            var d = b.dir, e = c && "parentNode" === d, f = x++;
            return b.first ? function(b, c, f) {
                for (;b = b[d]; ) if (1 === b.nodeType || e) return a(b, c, f);
            } : function(b, c, g) {
                var h, i, j = [ w, f ];
                if (g) {
                    for (;b = b[d]; ) if ((1 === b.nodeType || e) && a(b, c, g)) return !0;
                } else for (;b = b[d]; ) if (1 === b.nodeType || e) {
                    if (i = b[u] || (b[u] = {}), (h = i[d]) && h[0] === w && h[1] === f) return j[2] = h[2];
                    if (i[d] = j, j[2] = a(b, c, g)) return !0;
                }
            };
        }
        function sb(a) {
            return a.length > 1 ? function(b, c, d) {
                for (var e = a.length; e--; ) if (!a[e](b, c, d)) return !1;
                return !0;
            } : a[0];
        }
        function tb(a, b, c) {
            for (var d = 0, e = b.length; e > d; d++) fb(a, b[d], c);
            return c;
        }
        function ub(a, b, c, d, e) {
            for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++) (f = a[h]) && (!c || c(f, d, e)) && (g.push(f), 
            j && b.push(h));
            return g;
        }
        function vb(a, b, c, d, e, f) {
            return d && !d[u] && (d = vb(d)), e && !e[u] && (e = vb(e, f)), hb(function(f, g, h, i) {
                var j, k, l, m = [], n = [], o = g.length, p = f || tb(b || "*", h.nodeType ? [ h ] : h, []), q = !a || !f && b ? p : ub(p, m, a, h, i), r = c ? e || (f ? a : o || d) ? [] : g : q;
                if (c && c(q, r, h, i), d) for (j = ub(r, n), d(j, [], h, i), k = j.length; k--; ) (l = j[k]) && (r[n[k]] = !(q[n[k]] = l));
                if (f) {
                    if (e || a) {
                        if (e) {
                            for (j = [], k = r.length; k--; ) (l = r[k]) && j.push(q[k] = l);
                            e(null, r = [], j, i);
                        }
                        for (k = r.length; k--; ) (l = r[k]) && (j = e ? K.call(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l));
                    }
                } else r = ub(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : I.apply(g, r);
            });
        }
        function wb(a) {
            for (var b, c, e, f = a.length, g = d.relative[a[0].type], h = g || d.relative[" "], i = g ? 1 : 0, k = rb(function(a) {
                return a === b;
            }, h, !0), l = rb(function(a) {
                return K.call(b, a) > -1;
            }, h, !0), m = [ function(a, c, d) {
                return !g && (d || c !== j) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d));
            } ]; f > i; i++) if (c = d.relative[a[i].type]) m = [ rb(sb(m), c) ]; else {
                if (c = d.filter[a[i].type].apply(null, a[i].matches), c[u]) {
                    for (e = ++i; f > e && !d.relative[a[e].type]; e++) ;
                    return vb(i > 1 && sb(m), i > 1 && qb(a.slice(0, i - 1).concat({
                        value: " " === a[i - 2].type ? "*" : ""
                    })).replace(R, "$1"), c, e > i && wb(a.slice(i, e)), f > e && wb(a = a.slice(e)), f > e && qb(a));
                }
                m.push(c);
            }
            return sb(m);
        }
        function xb(a, b) {
            var c = b.length > 0, e = a.length > 0, f = function(f, g, h, i, k) {
                var l, m, o, p = 0, q = "0", r = f && [], s = [], t = j, u = f || e && d.find.TAG("*", k), v = w += null == t ? 1 : Math.random() || .1, x = u.length;
                for (k && (j = g !== n && g); q !== x && null != (l = u[q]); q++) {
                    if (e && l) {
                        for (m = 0; o = a[m++]; ) if (o(l, g, h)) {
                            i.push(l);
                            break;
                        }
                        k && (w = v);
                    }
                    c && ((l = !o && l) && p--, f && r.push(l));
                }
                if (p += q, c && q !== p) {
                    for (m = 0; o = b[m++]; ) o(r, s, g, h);
                    if (f) {
                        if (p > 0) for (;q--; ) r[q] || s[q] || (s[q] = G.call(i));
                        s = ub(s);
                    }
                    I.apply(i, s), k && !f && s.length > 0 && p + b.length > 1 && fb.uniqueSort(i);
                }
                return k && (w = v, j = t), r;
            };
            return c ? hb(f) : f;
        }
        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + -new Date(), v = a.document, w = 0, x = 0, y = gb(), z = gb(), A = gb(), B = function(a, b) {
            return a === b && (l = !0), 0;
        }, C = "undefined", D = 1 << 31, E = {}.hasOwnProperty, F = [], G = F.pop, H = F.push, I = F.push, J = F.slice, K = F.indexOf || function(a) {
            for (var b = 0, c = this.length; c > b; b++) if (this[b] === a) return b;
            return -1;
        }, L = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", M = "[\\x20\\t\\r\\n\\f]", N = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", O = N.replace("w", "w#"), P = "\\[" + M + "*(" + N + ")(?:" + M + "*([*^$|!~]?=)" + M + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + O + "))|)" + M + "*\\]", Q = ":(" + N + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + P + ")*)|.*)\\)|)", R = new RegExp("^" + M + "+|((?:^|[^\\\\])(?:\\\\.)*)" + M + "+$", "g"), S = new RegExp("^" + M + "*," + M + "*"), T = new RegExp("^" + M + "*([>+~]|" + M + ")" + M + "*"), U = new RegExp("=" + M + "*([^\\]'\"]*?)" + M + "*\\]", "g"), V = new RegExp(Q), W = new RegExp("^" + O + "$"), X = {
            ID: new RegExp("^#(" + N + ")"),
            CLASS: new RegExp("^\\.(" + N + ")"),
            TAG: new RegExp("^(" + N.replace("w", "w*") + ")"),
            ATTR: new RegExp("^" + P),
            PSEUDO: new RegExp("^" + Q),
            CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + M + "*(even|odd|(([+-]|)(\\d*)n|)" + M + "*(?:([+-]|)" + M + "*(\\d+)|))" + M + "*\\)|)", "i"),
            bool: new RegExp("^(?:" + L + ")$", "i"),
            needsContext: new RegExp("^" + M + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + M + "*((?:-\\d)?\\d*)" + M + "*\\)|)(?=[^-]|$)", "i")
        }, Y = /^(?:input|select|textarea|button)$/i, Z = /^h\d$/i, $ = /^[^{]+\{\s*\[native \w/, _ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ab = /[+~]/, bb = /'|\\/g, cb = new RegExp("\\\\([\\da-f]{1,6}" + M + "?|(" + M + ")|.)", "ig"), db = function(a, b, c) {
            var d = "0x" + b - 65536;
            return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320);
        };
        try {
            I.apply(F = J.call(v.childNodes), v.childNodes), F[v.childNodes.length].nodeType;
        } catch (eb) {
            I = {
                apply: F.length ? function(a, b) {
                    H.apply(a, J.call(b));
                } : function(a, b) {
                    for (var c = a.length, d = 0; a[c++] = b[d++]; ) ;
                    a.length = c - 1;
                }
            };
        }
        c = fb.support = {}, f = fb.isXML = function(a) {
            var b = a && (a.ownerDocument || a).documentElement;
            return !!b && "HTML" !== b.nodeName;
        }, m = fb.setDocument = function(a) {
            var b, e = a ? a.ownerDocument || a : v, g = e.defaultView;
            return e !== n && 9 === e.nodeType && e.documentElement ? (n = e, o = e.documentElement, 
            p = !f(e), g && g !== g.top && (g.addEventListener ? g.addEventListener("unload", function() {
                m();
            }, !1) : g.attachEvent && g.attachEvent("onunload", function() {
                m();
            })), c.attributes = ib(function(a) {
                return a.className = "i", !a.getAttribute("className");
            }), c.getElementsByTagName = ib(function(a) {
                return a.appendChild(e.createComment("")), !a.getElementsByTagName("*").length;
            }), c.getElementsByClassName = $.test(e.getElementsByClassName) && ib(function(a) {
                return a.innerHTML = "<div class='a'></div><div class='a i'></div>", a.firstChild.className = "i", 
                2 === a.getElementsByClassName("i").length;
            }), c.getById = ib(function(a) {
                return o.appendChild(a).id = u, !e.getElementsByName || !e.getElementsByName(u).length;
            }), c.getById ? (d.find.ID = function(a, b) {
                if (typeof b.getElementById !== C && p) {
                    var c = b.getElementById(a);
                    return c && c.parentNode ? [ c ] : [];
                }
            }, d.filter.ID = function(a) {
                var b = a.replace(cb, db);
                return function(a) {
                    return a.getAttribute("id") === b;
                };
            }) : (delete d.find.ID, d.filter.ID = function(a) {
                var b = a.replace(cb, db);
                return function(a) {
                    var c = typeof a.getAttributeNode !== C && a.getAttributeNode("id");
                    return c && c.value === b;
                };
            }), d.find.TAG = c.getElementsByTagName ? function(a, b) {
                return typeof b.getElementsByTagName !== C ? b.getElementsByTagName(a) : void 0;
            } : function(a, b) {
                var c, d = [], e = 0, f = b.getElementsByTagName(a);
                if ("*" === a) {
                    for (;c = f[e++]; ) 1 === c.nodeType && d.push(c);
                    return d;
                }
                return f;
            }, d.find.CLASS = c.getElementsByClassName && function(a, b) {
                return typeof b.getElementsByClassName !== C && p ? b.getElementsByClassName(a) : void 0;
            }, r = [], q = [], (c.qsa = $.test(e.querySelectorAll)) && (ib(function(a) {
                a.innerHTML = "<select msallowclip=''><option selected=''></option></select>", a.querySelectorAll("[msallowclip^='']").length && q.push("[*^$]=" + M + "*(?:''|\"\")"), 
                a.querySelectorAll("[selected]").length || q.push("\\[" + M + "*(?:value|" + L + ")"), 
                a.querySelectorAll(":checked").length || q.push(":checked");
            }), ib(function(a) {
                var b = e.createElement("input");
                b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && q.push("name" + M + "*[*^$|!~]?="), 
                a.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), 
                q.push(",.*:");
            })), (c.matchesSelector = $.test(s = o.matches || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ib(function(a) {
                c.disconnectedMatch = s.call(a, "div"), s.call(a, "[s!='']:x"), r.push("!=", Q);
            }), q = q.length && new RegExp(q.join("|")), r = r.length && new RegExp(r.join("|")), 
            b = $.test(o.compareDocumentPosition), t = b || $.test(o.contains) ? function(a, b) {
                var c = 9 === a.nodeType ? a.documentElement : a, d = b && b.parentNode;
                return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)));
            } : function(a, b) {
                if (b) for (;b = b.parentNode; ) if (b === a) return !0;
                return !1;
            }, B = b ? function(a, b) {
                if (a === b) return l = !0, 0;
                var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
                return d || (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 
                1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === e || a.ownerDocument === v && t(v, a) ? -1 : b === e || b.ownerDocument === v && t(v, b) ? 1 : k ? K.call(k, a) - K.call(k, b) : 0 : 4 & d ? -1 : 1);
            } : function(a, b) {
                if (a === b) return l = !0, 0;
                var c, d = 0, f = a.parentNode, g = b.parentNode, h = [ a ], i = [ b ];
                if (!f || !g) return a === e ? -1 : b === e ? 1 : f ? -1 : g ? 1 : k ? K.call(k, a) - K.call(k, b) : 0;
                if (f === g) return kb(a, b);
                for (c = a; c = c.parentNode; ) h.unshift(c);
                for (c = b; c = c.parentNode; ) i.unshift(c);
                for (;h[d] === i[d]; ) d++;
                return d ? kb(h[d], i[d]) : h[d] === v ? -1 : i[d] === v ? 1 : 0;
            }, e) : n;
        }, fb.matches = function(a, b) {
            return fb(a, null, null, b);
        }, fb.matchesSelector = function(a, b) {
            if ((a.ownerDocument || a) !== n && m(a), b = b.replace(U, "='$1']"), !(!c.matchesSelector || !p || r && r.test(b) || q && q.test(b))) try {
                var d = s.call(a, b);
                if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType) return d;
            } catch (e) {}
            return fb(b, n, null, [ a ]).length > 0;
        }, fb.contains = function(a, b) {
            return (a.ownerDocument || a) !== n && m(a), t(a, b);
        }, fb.attr = function(a, b) {
            (a.ownerDocument || a) !== n && m(a);
            var e = d.attrHandle[b.toLowerCase()], f = e && E.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !p) : void 0;
            return void 0 !== f ? f : c.attributes || !p ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null;
        }, fb.error = function(a) {
            throw new Error("Syntax error, unrecognized expression: " + a);
        }, fb.uniqueSort = function(a) {
            var b, d = [], e = 0, f = 0;
            if (l = !c.detectDuplicates, k = !c.sortStable && a.slice(0), a.sort(B), l) {
                for (;b = a[f++]; ) b === a[f] && (e = d.push(f));
                for (;e--; ) a.splice(d[e], 1);
            }
            return k = null, a;
        }, e = fb.getText = function(a) {
            var b, c = "", d = 0, f = a.nodeType;
            if (f) {
                if (1 === f || 9 === f || 11 === f) {
                    if ("string" == typeof a.textContent) return a.textContent;
                    for (a = a.firstChild; a; a = a.nextSibling) c += e(a);
                } else if (3 === f || 4 === f) return a.nodeValue;
            } else for (;b = a[d++]; ) c += e(b);
            return c;
        }, d = fb.selectors = {
            cacheLength: 50,
            createPseudo: hb,
            match: X,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function(a) {
                    return a[1] = a[1].replace(cb, db), a[3] = (a[3] || a[4] || a[5] || "").replace(cb, db), 
                    "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4);
                },
                CHILD: function(a) {
                    return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || fb.error(a[0]), 
                    a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && fb.error(a[0]), 
                    a;
                },
                PSEUDO: function(a) {
                    var b, c = !a[6] && a[2];
                    return X.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && V.test(c) && (b = g(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), 
                    a[2] = c.slice(0, b)), a.slice(0, 3));
                }
            },
            filter: {
                TAG: function(a) {
                    var b = a.replace(cb, db).toLowerCase();
                    return "*" === a ? function() {
                        return !0;
                    } : function(a) {
                        return a.nodeName && a.nodeName.toLowerCase() === b;
                    };
                },
                CLASS: function(a) {
                    var b = y[a + " "];
                    return b || (b = new RegExp("(^|" + M + ")" + a + "(" + M + "|$)")) && y(a, function(a) {
                        return b.test("string" == typeof a.className && a.className || typeof a.getAttribute !== C && a.getAttribute("class") || "");
                    });
                },
                ATTR: function(a, b, c) {
                    return function(d) {
                        var e = fb.attr(d, a);
                        return null == e ? "!=" === b : !b || (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e + " ").indexOf(c) > -1 : "|=" === b && (e === c || e.slice(0, c.length + 1) === c + "-"));
                    };
                },
                CHILD: function(a, b, c, d, e) {
                    var f = "nth" !== a.slice(0, 3), g = "last" !== a.slice(-4), h = "of-type" === b;
                    return 1 === d && 0 === e ? function(a) {
                        return !!a.parentNode;
                    } : function(b, c, i) {
                        var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling", q = b.parentNode, r = h && b.nodeName.toLowerCase(), s = !i && !h;
                        if (q) {
                            if (f) {
                                for (;p; ) {
                                    for (l = b; l = l[p]; ) if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) return !1;
                                    o = p = "only" === a && !o && "nextSibling";
                                }
                                return !0;
                            }
                            if (o = [ g ? q.firstChild : q.lastChild ], g && s) {
                                for (k = q[u] || (q[u] = {}), j = k[a] || [], n = j[0] === w && j[1], m = j[0] === w && j[2], 
                                l = n && q.childNodes[n]; l = ++n && l && l[p] || (m = n = 0) || o.pop(); ) if (1 === l.nodeType && ++m && l === b) {
                                    k[a] = [ w, n, m ];
                                    break;
                                }
                            } else if (s && (j = (b[u] || (b[u] = {}))[a]) && j[0] === w) m = j[1]; else for (;(l = ++n && l && l[p] || (m = n = 0) || o.pop()) && ((h ? l.nodeName.toLowerCase() !== r : 1 !== l.nodeType) || !++m || (s && ((l[u] || (l[u] = {}))[a] = [ w, m ]), 
                            l !== b)); ) ;
                            return (m -= e) === d || m % d == 0 && m / d >= 0;
                        }
                    };
                },
                PSEUDO: function(a, b) {
                    var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || fb.error("unsupported pseudo: " + a);
                    return e[u] ? e(b) : e.length > 1 ? (c = [ a, a, "", b ], d.setFilters.hasOwnProperty(a.toLowerCase()) ? hb(function(a, c) {
                        for (var d, f = e(a, b), g = f.length; g--; ) d = K.call(a, f[g]), a[d] = !(c[d] = f[g]);
                    }) : function(a) {
                        return e(a, 0, c);
                    }) : e;
                }
            },
            pseudos: {
                not: hb(function(a) {
                    var b = [], c = [], d = h(a.replace(R, "$1"));
                    return d[u] ? hb(function(a, b, c, e) {
                        for (var f, g = d(a, null, e, []), h = a.length; h--; ) (f = g[h]) && (a[h] = !(b[h] = f));
                    }) : function(a, e, f) {
                        return b[0] = a, d(b, null, f, c), !c.pop();
                    };
                }),
                has: hb(function(a) {
                    return function(b) {
                        return fb(a, b).length > 0;
                    };
                }),
                contains: hb(function(a) {
                    return function(b) {
                        return (b.textContent || b.innerText || e(b)).indexOf(a) > -1;
                    };
                }),
                lang: hb(function(a) {
                    return W.test(a || "") || fb.error("unsupported lang: " + a), a = a.replace(cb, db).toLowerCase(), 
                    function(b) {
                        var c;
                        do {
                            if (c = p ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang")) return (c = c.toLowerCase()) === a || 0 === c.indexOf(a + "-");
                        } while ((b = b.parentNode) && 1 === b.nodeType);
                        return !1;
                    };
                }),
                target: function(b) {
                    var c = a.location && a.location.hash;
                    return c && c.slice(1) === b.id;
                },
                root: function(a) {
                    return a === o;
                },
                focus: function(a) {
                    return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a.type || a.href || ~a.tabIndex);
                },
                enabled: function(a) {
                    return !1 === a.disabled;
                },
                disabled: function(a) {
                    return !0 === a.disabled;
                },
                checked: function(a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && !!a.checked || "option" === b && !!a.selected;
                },
                selected: function(a) {
                    return a.parentNode && a.parentNode.selectedIndex, !0 === a.selected;
                },
                empty: function(a) {
                    for (a = a.firstChild; a; a = a.nextSibling) if (a.nodeType < 6) return !1;
                    return !0;
                },
                parent: function(a) {
                    return !d.pseudos.empty(a);
                },
                header: function(a) {
                    return Z.test(a.nodeName);
                },
                input: function(a) {
                    return Y.test(a.nodeName);
                },
                button: function(a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && "button" === a.type || "button" === b;
                },
                text: function(a) {
                    var b;
                    return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase());
                },
                first: nb(function() {
                    return [ 0 ];
                }),
                last: nb(function(a, b) {
                    return [ b - 1 ];
                }),
                eq: nb(function(a, b, c) {
                    return [ 0 > c ? c + b : c ];
                }),
                even: nb(function(a, b) {
                    for (var c = 0; b > c; c += 2) a.push(c);
                    return a;
                }),
                odd: nb(function(a, b) {
                    for (var c = 1; b > c; c += 2) a.push(c);
                    return a;
                }),
                lt: nb(function(a, b, c) {
                    for (var d = 0 > c ? c + b : c; --d >= 0; ) a.push(d);
                    return a;
                }),
                gt: nb(function(a, b, c) {
                    for (var d = 0 > c ? c + b : c; ++d < b; ) a.push(d);
                    return a;
                })
            }
        }, d.pseudos.nth = d.pseudos.eq;
        for (b in {
            radio: !0,
            checkbox: !0,
            file: !0,
            password: !0,
            image: !0
        }) d.pseudos[b] = function(a) {
            return function(b) {
                return "input" === b.nodeName.toLowerCase() && b.type === a;
            };
        }(b);
        for (b in {
            submit: !0,
            reset: !0
        }) d.pseudos[b] = function(a) {
            return function(b) {
                var c = b.nodeName.toLowerCase();
                return ("input" === c || "button" === c) && b.type === a;
            };
        }(b);
        return pb.prototype = d.filters = d.pseudos, d.setFilters = new pb(), g = fb.tokenize = function(a, b) {
            var c, e, f, g, h, i, j, k = z[a + " "];
            if (k) return b ? 0 : k.slice(0);
            for (h = a, i = [], j = d.preFilter; h; ) {
                (!c || (e = S.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), 
                c = !1, (e = T.exec(h)) && (c = e.shift(), f.push({
                    value: c,
                    type: e[0].replace(R, " ")
                }), h = h.slice(c.length));
                for (g in d.filter) !(e = X[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), 
                f.push({
                    value: c,
                    type: g,
                    matches: e
                }), h = h.slice(c.length));
                if (!c) break;
            }
            return b ? h.length : h ? fb.error(a) : z(a, i).slice(0);
        }, h = fb.compile = function(a, b) {
            var c, d = [], e = [], f = A[a + " "];
            if (!f) {
                for (b || (b = g(a)), c = b.length; c--; ) f = wb(b[c]), f[u] ? d.push(f) : e.push(f);
                f = A(a, xb(e, d)), f.selector = a;
            }
            return f;
        }, i = fb.select = function(a, b, e, f) {
            var i, j, k, l, m, n = "function" == typeof a && a, o = !f && g(a = n.selector || a);
            if (e = e || [], 1 === o.length) {
                if (j = o[0] = o[0].slice(0), j.length > 2 && "ID" === (k = j[0]).type && c.getById && 9 === b.nodeType && p && d.relative[j[1].type]) {
                    if (!(b = (d.find.ID(k.matches[0].replace(cb, db), b) || [])[0])) return e;
                    n && (b = b.parentNode), a = a.slice(j.shift().value.length);
                }
                for (i = X.needsContext.test(a) ? 0 : j.length; i-- && (k = j[i], !d.relative[l = k.type]); ) if ((m = d.find[l]) && (f = m(k.matches[0].replace(cb, db), ab.test(j[0].type) && ob(b.parentNode) || b))) {
                    if (j.splice(i, 1), !(a = f.length && qb(j))) return I.apply(e, f), e;
                    break;
                }
            }
            return (n || h(a, o))(f, b, !p, e, ab.test(a) && ob(b.parentNode) || b), e;
        }, c.sortStable = u.split("").sort(B).join("") === u, c.detectDuplicates = !!l, 
        m(), c.sortDetached = ib(function(a) {
            return 1 & a.compareDocumentPosition(n.createElement("div"));
        }), ib(function(a) {
            return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href");
        }) || jb("type|href|height|width", function(a, b, c) {
            return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2);
        }), c.attributes && ib(function(a) {
            return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value");
        }) || jb("value", function(a, b, c) {
            return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue;
        }), ib(function(a) {
            return null == a.getAttribute("disabled");
        }) || jb(L, function(a, b, c) {
            var d;
            return c ? void 0 : !0 === a[b] ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null;
        }), fb;
    }(a);
    m.find = s, m.expr = s.selectors, m.expr[":"] = m.expr.pseudos, m.unique = s.uniqueSort, 
    m.text = s.getText, m.isXMLDoc = s.isXML, m.contains = s.contains;
    var t = m.expr.match.needsContext, u = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, v = /^.[^:#\[\.,]*$/;
    m.filter = function(a, b, c) {
        var d = b[0];
        return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? m.find.matchesSelector(d, a) ? [ d ] : [] : m.find.matches(a, m.grep(b, function(a) {
            return 1 === a.nodeType;
        }));
    }, m.fn.extend({
        find: function(a) {
            var b, c = [], d = this, e = d.length;
            if ("string" != typeof a) return this.pushStack(m(a).filter(function() {
                for (b = 0; e > b; b++) if (m.contains(d[b], this)) return !0;
            }));
            for (b = 0; e > b; b++) m.find(a, d[b], c);
            return c = this.pushStack(e > 1 ? m.unique(c) : c), c.selector = this.selector ? this.selector + " " + a : a, 
            c;
        },
        filter: function(a) {
            return this.pushStack(w(this, a || [], !1));
        },
        not: function(a) {
            return this.pushStack(w(this, a || [], !0));
        },
        is: function(a) {
            return !!w(this, "string" == typeof a && t.test(a) ? m(a) : a || [], !1).length;
        }
    });
    var x, y = a.document, z = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;
    (m.fn.init = function(a, b) {
        var c, d;
        if (!a) return this;
        if ("string" == typeof a) {
            if (!(c = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [ null, a, null ] : z.exec(a)) || !c[1] && b) return !b || b.jquery ? (b || x).find(a) : this.constructor(b).find(a);
            if (c[1]) {
                if (b = b instanceof m ? b[0] : b, m.merge(this, m.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : y, !0)), 
                u.test(c[1]) && m.isPlainObject(b)) for (c in b) m.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
                return this;
            }
            if ((d = y.getElementById(c[2])) && d.parentNode) {
                if (d.id !== c[2]) return x.find(a);
                this.length = 1, this[0] = d;
            }
            return this.context = y, this.selector = a, this;
        }
        return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : m.isFunction(a) ? void 0 !== x.ready ? x.ready(a) : a(m) : (void 0 !== a.selector && (this.selector = a.selector, 
        this.context = a.context), m.makeArray(a, this));
    }).prototype = m.fn, x = m(y);
    var B = /^(?:parents|prev(?:Until|All))/, C = {
        children: !0,
        contents: !0,
        next: !0,
        prev: !0
    };
    m.extend({
        dir: function(a, b, c) {
            for (var d = [], e = a[b]; e && 9 !== e.nodeType && (void 0 === c || 1 !== e.nodeType || !m(e).is(c)); ) 1 === e.nodeType && d.push(e), 
            e = e[b];
            return d;
        },
        sibling: function(a, b) {
            for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
            return c;
        }
    }), m.fn.extend({
        has: function(a) {
            var b, c = m(a, this), d = c.length;
            return this.filter(function() {
                for (b = 0; d > b; b++) if (m.contains(this, c[b])) return !0;
            });
        },
        closest: function(a, b) {
            for (var c, d = 0, e = this.length, f = [], g = t.test(a) || "string" != typeof a ? m(a, b || this.context) : 0; e > d; d++) for (c = this[d]; c && c !== b; c = c.parentNode) if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && m.find.matchesSelector(c, a))) {
                f.push(c);
                break;
            }
            return this.pushStack(f.length > 1 ? m.unique(f) : f);
        },
        index: function(a) {
            return a ? "string" == typeof a ? m.inArray(this[0], m(a)) : m.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1;
        },
        add: function(a, b) {
            return this.pushStack(m.unique(m.merge(this.get(), m(a, b))));
        },
        addBack: function(a) {
            return this.add(null == a ? this.prevObject : this.prevObject.filter(a));
        }
    }), m.each({
        parent: function(a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b : null;
        },
        parents: function(a) {
            return m.dir(a, "parentNode");
        },
        parentsUntil: function(a, b, c) {
            return m.dir(a, "parentNode", c);
        },
        next: function(a) {
            return D(a, "nextSibling");
        },
        prev: function(a) {
            return D(a, "previousSibling");
        },
        nextAll: function(a) {
            return m.dir(a, "nextSibling");
        },
        prevAll: function(a) {
            return m.dir(a, "previousSibling");
        },
        nextUntil: function(a, b, c) {
            return m.dir(a, "nextSibling", c);
        },
        prevUntil: function(a, b, c) {
            return m.dir(a, "previousSibling", c);
        },
        siblings: function(a) {
            return m.sibling((a.parentNode || {}).firstChild, a);
        },
        children: function(a) {
            return m.sibling(a.firstChild);
        },
        contents: function(a) {
            return m.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : m.merge([], a.childNodes);
        }
    }, function(a, b) {
        m.fn[a] = function(c, d) {
            var e = m.map(this, b, c);
            return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = m.filter(d, e)), 
            this.length > 1 && (C[a] || (e = m.unique(e)), B.test(a) && (e = e.reverse())), 
            this.pushStack(e);
        };
    });
    var E = /\S+/g, F = {};
    m.Callbacks = function(a) {
        a = "string" == typeof a ? F[a] || G(a) : m.extend({}, a);
        var b, c, d, e, f, g, h = [], i = !a.once && [], j = function(l) {
            for (c = a.memory && l, d = !0, f = g || 0, g = 0, e = h.length, b = !0; h && e > f; f++) if (!1 === h[f].apply(l[0], l[1]) && a.stopOnFalse) {
                c = !1;
                break;
            }
            b = !1, h && (i ? i.length && j(i.shift()) : c ? h = [] : k.disable());
        }, k = {
            add: function() {
                if (h) {
                    var d = h.length;
                    !function f(b) {
                        m.each(b, function(b, c) {
                            var d = m.type(c);
                            "function" === d ? a.unique && k.has(c) || h.push(c) : c && c.length && "string" !== d && f(c);
                        });
                    }(arguments), b ? e = h.length : c && (g = d, j(c));
                }
                return this;
            },
            remove: function() {
                return h && m.each(arguments, function(a, c) {
                    for (var d; (d = m.inArray(c, h, d)) > -1; ) h.splice(d, 1), b && (e >= d && e--, 
                    f >= d && f--);
                }), this;
            },
            has: function(a) {
                return a ? m.inArray(a, h) > -1 : !(!h || !h.length);
            },
            empty: function() {
                return h = [], e = 0, this;
            },
            disable: function() {
                return h = i = c = void 0, this;
            },
            disabled: function() {
                return !h;
            },
            lock: function() {
                return i = void 0, c || k.disable(), this;
            },
            locked: function() {
                return !i;
            },
            fireWith: function(a, c) {
                return !h || d && !i || (c = c || [], c = [ a, c.slice ? c.slice() : c ], b ? i.push(c) : j(c)), 
                this;
            },
            fire: function() {
                return k.fireWith(this, arguments), this;
            },
            fired: function() {
                return !!d;
            }
        };
        return k;
    }, m.extend({
        Deferred: function(a) {
            var b = [ [ "resolve", "done", m.Callbacks("once memory"), "resolved" ], [ "reject", "fail", m.Callbacks("once memory"), "rejected" ], [ "notify", "progress", m.Callbacks("memory") ] ], c = "pending", d = {
                state: function() {
                    return c;
                },
                always: function() {
                    return e.done(arguments).fail(arguments), this;
                },
                then: function() {
                    var a = arguments;
                    return m.Deferred(function(c) {
                        m.each(b, function(b, f) {
                            var g = m.isFunction(a[b]) && a[b];
                            e[f[1]](function() {
                                var a = g && g.apply(this, arguments);
                                a && m.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [ a ] : arguments);
                            });
                        }), a = null;
                    }).promise();
                },
                promise: function(a) {
                    return null != a ? m.extend(a, d) : d;
                }
            }, e = {};
            return d.pipe = d.then, m.each(b, function(a, f) {
                var g = f[2], h = f[3];
                d[f[1]] = g.add, h && g.add(function() {
                    c = h;
                }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function() {
                    return e[f[0] + "With"](this === e ? d : this, arguments), this;
                }, e[f[0] + "With"] = g.fireWith;
            }), d.promise(e), a && a.call(e, e), e;
        },
        when: function(a) {
            var i, j, k, b = 0, c = d.call(arguments), e = c.length, f = 1 !== e || a && m.isFunction(a.promise) ? e : 0, g = 1 === f ? a : m.Deferred(), h = function(a, b, c) {
                return function(e) {
                    b[a] = this, c[a] = arguments.length > 1 ? d.call(arguments) : e, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c);
                };
            };
            if (e > 1) for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++) c[b] && m.isFunction(c[b].promise) ? c[b].promise().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
            return f || g.resolveWith(k, c), g.promise();
        }
    });
    var H;
    m.fn.ready = function(a) {
        return m.ready.promise().done(a), this;
    }, m.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function(a) {
            a ? m.readyWait++ : m.ready(!0);
        },
        ready: function(a) {
            if (!0 === a ? !--m.readyWait : !m.isReady) {
                if (!y.body) return setTimeout(m.ready);
                m.isReady = !0, !0 !== a && --m.readyWait > 0 || (H.resolveWith(y, [ m ]), m.fn.triggerHandler && (m(y).triggerHandler("ready"), 
                m(y).off("ready")));
            }
        }
    }), m.ready.promise = function(b) {
        if (!H) if (H = m.Deferred(), "complete" === y.readyState) setTimeout(m.ready); else if (y.addEventListener) y.addEventListener("DOMContentLoaded", J, !1), 
        a.addEventListener("load", J, !1); else {
            y.attachEvent("onreadystatechange", J), a.attachEvent("onload", J);
            var c = !1;
            try {
                c = null == a.frameElement && y.documentElement;
            } catch (d) {}
            c && c.doScroll && function e() {
                if (!m.isReady) {
                    try {
                        c.doScroll("left");
                    } catch (a) {
                        return setTimeout(e, 50);
                    }
                    I(), m.ready();
                }
            }();
        }
        return H.promise(b);
    };
    var L, K = "undefined";
    for (L in m(k)) break;
    k.ownLast = "0" !== L, k.inlineBlockNeedsLayout = !1, m(function() {
        var a, b, c, d;
        (c = y.getElementsByTagName("body")[0]) && c.style && (b = y.createElement("div"), 
        d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", 
        c.appendChild(d).appendChild(b), typeof b.style.zoom !== K && (b.style.cssText = "display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1", 
        k.inlineBlockNeedsLayout = a = 3 === b.offsetWidth, a && (c.style.zoom = 1)), c.removeChild(d));
    }), function() {
        var a = y.createElement("div");
        if (null == k.deleteExpando) {
            k.deleteExpando = !0;
            try {
                delete a.test;
            } catch (b) {
                k.deleteExpando = !1;
            }
        }
        a = null;
    }(), m.acceptData = function(a) {
        var b = m.noData[(a.nodeName + " ").toLowerCase()], c = +a.nodeType || 1;
        return (1 === c || 9 === c) && (!b || !0 !== b && a.getAttribute("classid") === b);
    };
    var M = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, N = /([A-Z])/g;
    m.extend({
        cache: {},
        noData: {
            "applet ": !0,
            "embed ": !0,
            "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
        },
        hasData: function(a) {
            return !!(a = a.nodeType ? m.cache[a[m.expando]] : a[m.expando]) && !P(a);
        },
        data: function(a, b, c) {
            return Q(a, b, c);
        },
        removeData: function(a, b) {
            return R(a, b);
        },
        _data: function(a, b, c) {
            return Q(a, b, c, !0);
        },
        _removeData: function(a, b) {
            return R(a, b, !0);
        }
    }), m.fn.extend({
        data: function(a, b) {
            var c, d, e, f = this[0], g = f && f.attributes;
            if (void 0 === a) {
                if (this.length && (e = m.data(f), 1 === f.nodeType && !m._data(f, "parsedAttrs"))) {
                    for (c = g.length; c--; ) g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = m.camelCase(d.slice(5)), 
                    O(f, d, e[d])));
                    m._data(f, "parsedAttrs", !0);
                }
                return e;
            }
            return "object" == typeof a ? this.each(function() {
                m.data(this, a);
            }) : arguments.length > 1 ? this.each(function() {
                m.data(this, a, b);
            }) : f ? O(f, a, m.data(f, a)) : void 0;
        },
        removeData: function(a) {
            return this.each(function() {
                m.removeData(this, a);
            });
        }
    }), m.extend({
        queue: function(a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = m._data(a, b), c && (!d || m.isArray(c) ? d = m._data(a, b, m.makeArray(c)) : d.push(c)), 
            d || []) : void 0;
        },
        dequeue: function(a, b) {
            b = b || "fx";
            var c = m.queue(a, b), d = c.length, e = c.shift(), f = m._queueHooks(a, b), g = function() {
                m.dequeue(a, b);
            };
            "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), 
            delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire();
        },
        _queueHooks: function(a, b) {
            var c = b + "queueHooks";
            return m._data(a, c) || m._data(a, c, {
                empty: m.Callbacks("once memory").add(function() {
                    m._removeData(a, b + "queue"), m._removeData(a, c);
                })
            });
        }
    }), m.fn.extend({
        queue: function(a, b) {
            var c = 2;
            return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? m.queue(this[0], a) : void 0 === b ? this : this.each(function() {
                var c = m.queue(this, a, b);
                m._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && m.dequeue(this, a);
            });
        },
        dequeue: function(a) {
            return this.each(function() {
                m.dequeue(this, a);
            });
        },
        clearQueue: function(a) {
            return this.queue(a || "fx", []);
        },
        promise: function(a, b) {
            var c, d = 1, e = m.Deferred(), f = this, g = this.length, h = function() {
                --d || e.resolveWith(f, [ f ]);
            };
            for ("string" != typeof a && (b = a, a = void 0), a = a || "fx"; g--; ) (c = m._data(f[g], a + "queueHooks")) && c.empty && (d++, 
            c.empty.add(h));
            return h(), e.promise(b);
        }
    });
    var S = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, T = [ "Top", "Right", "Bottom", "Left" ], U = function(a, b) {
        return a = b || a, "none" === m.css(a, "display") || !m.contains(a.ownerDocument, a);
    }, V = m.access = function(a, b, c, d, e, f, g) {
        var h = 0, i = a.length, j = null == c;
        if ("object" === m.type(c)) {
            e = !0;
            for (h in c) m.access(a, b, h, c[h], !0, f, g);
        } else if (void 0 !== d && (e = !0, m.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), 
        b = null) : (j = b, b = function(a, b, c) {
            return j.call(m(a), c);
        })), b)) for (;i > h; h++) b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
        return e ? a : j ? b.call(a) : i ? b(a[0], c) : f;
    }, W = /^(?:checkbox|radio)$/i;
    !function() {
        var a = y.createElement("input"), b = y.createElement("div"), c = y.createDocumentFragment();
        if (b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", 
        k.leadingWhitespace = 3 === b.firstChild.nodeType, k.tbody = !b.getElementsByTagName("tbody").length, 
        k.htmlSerialize = !!b.getElementsByTagName("link").length, k.html5Clone = "<:nav></:nav>" !== y.createElement("nav").cloneNode(!0).outerHTML, 
        a.type = "checkbox", a.checked = !0, c.appendChild(a), k.appendChecked = a.checked, 
        b.innerHTML = "<textarea>x</textarea>", k.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue, 
        c.appendChild(b), b.innerHTML = "<input type='radio' checked='checked' name='t'/>", 
        k.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, k.noCloneEvent = !0, 
        b.attachEvent && (b.attachEvent("onclick", function() {
            k.noCloneEvent = !1;
        }), b.cloneNode(!0).click()), null == k.deleteExpando) {
            k.deleteExpando = !0;
            try {
                delete b.test;
            } catch (d) {
                k.deleteExpando = !1;
            }
        }
    }(), function() {
        var b, c, d = y.createElement("div");
        for (b in {
            submit: !0,
            change: !0,
            focusin: !0
        }) c = "on" + b, (k[b + "Bubbles"] = c in a) || (d.setAttribute(c, "t"), k[b + "Bubbles"] = !1 === d.attributes[c].expando);
        d = null;
    }();
    var X = /^(?:input|select|textarea)$/i, Y = /^key/, Z = /^(?:mouse|pointer|contextmenu)|click/, $ = /^(?:focusinfocus|focusoutblur)$/, _ = /^([^.]*)(?:\.(.+)|)$/;
    m.event = {
        global: {},
        add: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, n, o, p, q, r = m._data(a);
            if (r) {
                for (c.handler && (i = c, c = i.handler, e = i.selector), c.guid || (c.guid = m.guid++), 
                (g = r.events) || (g = r.events = {}), (k = r.handle) || (k = r.handle = function(a) {
                    return typeof m === K || a && m.event.triggered === a.type ? void 0 : m.event.dispatch.apply(k.elem, arguments);
                }, k.elem = a), b = (b || "").match(E) || [ "" ], h = b.length; h--; ) f = _.exec(b[h]) || [], 
                o = q = f[1], p = (f[2] || "").split(".").sort(), o && (j = m.event.special[o] || {}, 
                o = (e ? j.delegateType : j.bindType) || o, j = m.event.special[o] || {}, l = m.extend({
                    type: o,
                    origType: q,
                    data: d,
                    handler: c,
                    guid: c.guid,
                    selector: e,
                    needsContext: e && m.expr.match.needsContext.test(e),
                    namespace: p.join(".")
                }, i), (n = g[o]) || (n = g[o] = [], n.delegateCount = 0, j.setup && !1 !== j.setup.call(a, d, p, k) || (a.addEventListener ? a.addEventListener(o, k, !1) : a.attachEvent && a.attachEvent("on" + o, k))), 
                j.add && (j.add.call(a, l), l.handler.guid || (l.handler.guid = c.guid)), e ? n.splice(n.delegateCount++, 0, l) : n.push(l), 
                m.event.global[o] = !0);
                a = null;
            }
        },
        remove: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, n, o, p, q, r = m.hasData(a) && m._data(a);
            if (r && (k = r.events)) {
                for (b = (b || "").match(E) || [ "" ], j = b.length; j--; ) if (h = _.exec(b[j]) || [], 
                o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
                    for (l = m.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, n = k[o] || [], 
                    h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), i = f = n.length; f--; ) g = n[f], 
                    !e && q !== g.origType || c && c.guid !== g.guid || h && !h.test(g.namespace) || d && d !== g.selector && ("**" !== d || !g.selector) || (n.splice(f, 1), 
                    g.selector && n.delegateCount--, l.remove && l.remove.call(a, g));
                    i && !n.length && (l.teardown && !1 !== l.teardown.call(a, p, r.handle) || m.removeEvent(a, o, r.handle), 
                    delete k[o]);
                } else for (o in k) m.event.remove(a, o + b[j], c, d, !0);
                m.isEmptyObject(k) && (delete r.handle, m._removeData(a, "events"));
            }
        },
        trigger: function(b, c, d, e) {
            var f, g, h, i, k, l, n, o = [ d || y ], p = j.call(b, "type") ? b.type : b, q = j.call(b, "namespace") ? b.namespace.split(".") : [];
            if (h = l = d = d || y, 3 !== d.nodeType && 8 !== d.nodeType && !$.test(p + m.event.triggered) && (p.indexOf(".") >= 0 && (q = p.split("."), 
            p = q.shift(), q.sort()), g = p.indexOf(":") < 0 && "on" + p, b = b[m.expando] ? b : new m.Event(p, "object" == typeof b && b), 
            b.isTrigger = e ? 2 : 3, b.namespace = q.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + q.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, 
            b.result = void 0, b.target || (b.target = d), c = null == c ? [ b ] : m.makeArray(c, [ b ]), 
            k = m.event.special[p] || {}, e || !k.trigger || !1 !== k.trigger.apply(d, c))) {
                if (!e && !k.noBubble && !m.isWindow(d)) {
                    for (i = k.delegateType || p, $.test(i + p) || (h = h.parentNode); h; h = h.parentNode) o.push(h), 
                    l = h;
                    l === (d.ownerDocument || y) && o.push(l.defaultView || l.parentWindow || a);
                }
                for (n = 0; (h = o[n++]) && !b.isPropagationStopped(); ) b.type = n > 1 ? i : k.bindType || p, 
                f = (m._data(h, "events") || {})[b.type] && m._data(h, "handle"), f && f.apply(h, c), 
                (f = g && h[g]) && f.apply && m.acceptData(h) && (b.result = f.apply(h, c), !1 === b.result && b.preventDefault());
                if (b.type = p, !e && !b.isDefaultPrevented() && (!k._default || !1 === k._default.apply(o.pop(), c)) && m.acceptData(d) && g && d[p] && !m.isWindow(d)) {
                    l = d[g], l && (d[g] = null), m.event.triggered = p;
                    try {
                        d[p]();
                    } catch (r) {}
                    m.event.triggered = void 0, l && (d[g] = l);
                }
                return b.result;
            }
        },
        dispatch: function(a) {
            a = m.event.fix(a);
            var b, c, e, f, g, h = [], i = d.call(arguments), j = (m._data(this, "events") || {})[a.type] || [], k = m.event.special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k.preDispatch || !1 !== k.preDispatch.call(this, a)) {
                for (h = m.event.handlers.call(this, a, j), b = 0; (f = h[b++]) && !a.isPropagationStopped(); ) for (a.currentTarget = f.elem, 
                g = 0; (e = f.handlers[g++]) && !a.isImmediatePropagationStopped(); ) (!a.namespace_re || a.namespace_re.test(e.namespace)) && (a.handleObj = e, 
                a.data = e.data, void 0 !== (c = ((m.event.special[e.origType] || {}).handle || e.handler).apply(f.elem, i)) && !1 === (a.result = c) && (a.preventDefault(), 
                a.stopPropagation()));
                return k.postDispatch && k.postDispatch.call(this, a), a.result;
            }
        },
        handlers: function(a, b) {
            var c, d, e, f, g = [], h = b.delegateCount, i = a.target;
            if (h && i.nodeType && (!a.button || "click" !== a.type)) for (;i != this; i = i.parentNode || this) if (1 === i.nodeType && (!0 !== i.disabled || "click" !== a.type)) {
                for (e = [], f = 0; h > f; f++) d = b[f], c = d.selector + " ", void 0 === e[c] && (e[c] = d.needsContext ? m(c, this).index(i) >= 0 : m.find(c, this, null, [ i ]).length), 
                e[c] && e.push(d);
                e.length && g.push({
                    elem: i,
                    handlers: e
                });
            }
            return h < b.length && g.push({
                elem: this,
                handlers: b.slice(h)
            }), g;
        },
        fix: function(a) {
            if (a[m.expando]) return a;
            var b, c, d, e = a.type, f = a, g = this.fixHooks[e];
            for (g || (this.fixHooks[e] = g = Z.test(e) ? this.mouseHooks : Y.test(e) ? this.keyHooks : {}), 
            d = g.props ? this.props.concat(g.props) : this.props, a = new m.Event(f), b = d.length; b--; ) c = d[b], 
            a[c] = f[c];
            return a.target || (a.target = f.srcElement || y), 3 === a.target.nodeType && (a.target = a.target.parentNode), 
            a.metaKey = !!a.metaKey, g.filter ? g.filter(a, f) : a;
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(a, b) {
                return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), 
                a;
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(a, b) {
                var c, d, e, f = b.button, g = b.fromElement;
                return null == a.pageX && null != b.clientX && (d = a.target.ownerDocument || y, 
                e = d.documentElement, c = d.body, a.pageX = b.clientX + (e && e.scrollLeft || c && c.scrollLeft || 0) - (e && e.clientLeft || c && c.clientLeft || 0), 
                a.pageY = b.clientY + (e && e.scrollTop || c && c.scrollTop || 0) - (e && e.clientTop || c && c.clientTop || 0)), 
                !a.relatedTarget && g && (a.relatedTarget = g === a.target ? b.toElement : g), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), 
                a;
            }
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== cb() && this.focus) try {
                        return this.focus(), !1;
                    } catch (a) {}
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === cb() && this.blur ? (this.blur(), !1) : void 0;
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return m.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), 
                    !1) : void 0;
                },
                _default: function(a) {
                    return m.nodeName(a.target, "a");
                }
            },
            beforeunload: {
                postDispatch: function(a) {
                    void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result);
                }
            }
        },
        simulate: function(a, b, c, d) {
            var e = m.extend(new m.Event(), c, {
                type: a,
                isSimulated: !0,
                originalEvent: {}
            });
            d ? m.event.trigger(e, null, b) : m.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault();
        }
    }, m.removeEvent = y.removeEventListener ? function(a, b, c) {
        a.removeEventListener && a.removeEventListener(b, c, !1);
    } : function(a, b, c) {
        var d = "on" + b;
        a.detachEvent && (typeof a[d] === K && (a[d] = null), a.detachEvent(d, c));
    }, m.Event = function(a, b) {
        return this instanceof m.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, 
        this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && !1 === a.returnValue ? ab : bb) : this.type = a, 
        b && m.extend(this, b), this.timeStamp = a && a.timeStamp || m.now(), void (this[m.expando] = !0)) : new m.Event(a, b);
    }, m.Event.prototype = {
        isDefaultPrevented: bb,
        isPropagationStopped: bb,
        isImmediatePropagationStopped: bb,
        preventDefault: function() {
            var a = this.originalEvent;
            this.isDefaultPrevented = ab, a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1);
        },
        stopPropagation: function() {
            var a = this.originalEvent;
            this.isPropagationStopped = ab, a && (a.stopPropagation && a.stopPropagation(), 
            a.cancelBubble = !0);
        },
        stopImmediatePropagation: function() {
            var a = this.originalEvent;
            this.isImmediatePropagationStopped = ab, a && a.stopImmediatePropagation && a.stopImmediatePropagation(), 
            this.stopPropagation();
        }
    }, m.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function(a, b) {
        m.event.special[a] = {
            delegateType: b,
            bindType: b,
            handle: function(a) {
                var c, d = this, e = a.relatedTarget, f = a.handleObj;
                return (!e || e !== d && !m.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), 
                a.type = b), c;
            }
        };
    }), k.submitBubbles || (m.event.special.submit = {
        setup: function() {
            return !m.nodeName(this, "form") && void m.event.add(this, "click._submit keypress._submit", function(a) {
                var b = a.target, c = m.nodeName(b, "input") || m.nodeName(b, "button") ? b.form : void 0;
                c && !m._data(c, "submitBubbles") && (m.event.add(c, "submit._submit", function(a) {
                    a._submit_bubble = !0;
                }), m._data(c, "submitBubbles", !0));
            });
        },
        postDispatch: function(a) {
            a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && m.event.simulate("submit", this.parentNode, a, !0));
        },
        teardown: function() {
            return !m.nodeName(this, "form") && void m.event.remove(this, "._submit");
        }
    }), k.changeBubbles || (m.event.special.change = {
        setup: function() {
            return X.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (m.event.add(this, "propertychange._change", function(a) {
                "checked" === a.originalEvent.propertyName && (this._just_changed = !0);
            }), m.event.add(this, "click._change", function(a) {
                this._just_changed && !a.isTrigger && (this._just_changed = !1), m.event.simulate("change", this, a, !0);
            })), !1) : void m.event.add(this, "beforeactivate._change", function(a) {
                var b = a.target;
                X.test(b.nodeName) && !m._data(b, "changeBubbles") && (m.event.add(b, "change._change", function(a) {
                    !this.parentNode || a.isSimulated || a.isTrigger || m.event.simulate("change", this.parentNode, a, !0);
                }), m._data(b, "changeBubbles", !0));
            });
        },
        handle: function(a) {
            var b = a.target;
            return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0;
        },
        teardown: function() {
            return m.event.remove(this, "._change"), !X.test(this.nodeName);
        }
    }), k.focusinBubbles || m.each({
        focus: "focusin",
        blur: "focusout"
    }, function(a, b) {
        var c = function(a) {
            m.event.simulate(b, a.target, m.event.fix(a), !0);
        };
        m.event.special[b] = {
            setup: function() {
                var d = this.ownerDocument || this, e = m._data(d, b);
                e || d.addEventListener(a, c, !0), m._data(d, b, (e || 0) + 1);
            },
            teardown: function() {
                var d = this.ownerDocument || this, e = m._data(d, b) - 1;
                e ? m._data(d, b, e) : (d.removeEventListener(a, c, !0), m._removeData(d, b));
            }
        };
    }), m.fn.extend({
        on: function(a, b, c, d, e) {
            var f, g;
            if ("object" == typeof a) {
                "string" != typeof b && (c = c || b, b = void 0);
                for (f in a) this.on(f, b, c, a[f], e);
                return this;
            }
            if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, 
            c = void 0) : (d = c, c = b, b = void 0)), !1 === d) d = bb; else if (!d) return this;
            return 1 === e && (g = d, d = function(a) {
                return m().off(a), g.apply(this, arguments);
            }, d.guid = g.guid || (g.guid = m.guid++)), this.each(function() {
                m.event.add(this, a, d, c, b);
            });
        },
        one: function(a, b, c, d) {
            return this.on(a, b, c, d, 1);
        },
        off: function(a, b, c) {
            var d, e;
            if (a && a.preventDefault && a.handleObj) return d = a.handleObj, m(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), 
            this;
            if ("object" == typeof a) {
                for (e in a) this.off(e, b, a[e]);
                return this;
            }
            return (!1 === b || "function" == typeof b) && (c = b, b = void 0), !1 === c && (c = bb), 
            this.each(function() {
                m.event.remove(this, a, c, b);
            });
        },
        trigger: function(a, b) {
            return this.each(function() {
                m.event.trigger(a, b, this);
            });
        },
        triggerHandler: function(a, b) {
            var c = this[0];
            return c ? m.event.trigger(a, b, c, !0) : void 0;
        }
    });
    var eb = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", fb = / jQuery\d+="(?:null|\d+)"/g, gb = new RegExp("<(?:" + eb + ")[\\s/>]", "i"), hb = /^\s+/, ib = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, jb = /<([\w:]+)/, kb = /<tbody/i, lb = /<|&#?\w+;/, mb = /<(?:script|style|link)/i, nb = /checked\s*(?:[^=]|=\s*.checked.)/i, ob = /^$|\/(?:java|ecma)script/i, pb = /^true\/(.*)/, qb = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, rb = {
        option: [ 1, "<select multiple='multiple'>", "</select>" ],
        legend: [ 1, "<fieldset>", "</fieldset>" ],
        area: [ 1, "<map>", "</map>" ],
        param: [ 1, "<object>", "</object>" ],
        thead: [ 1, "<table>", "</table>" ],
        tr: [ 2, "<table><tbody>", "</tbody></table>" ],
        col: [ 2, "<table><tbody></tbody><colgroup>", "</colgroup></table>" ],
        td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],
        _default: k.htmlSerialize ? [ 0, "", "" ] : [ 1, "X<div>", "</div>" ]
    }, sb = db(y), tb = sb.appendChild(y.createElement("div"));
    rb.optgroup = rb.option, rb.tbody = rb.tfoot = rb.colgroup = rb.caption = rb.thead, 
    rb.th = rb.td, m.extend({
        clone: function(a, b, c) {
            var d, e, f, g, h, i = m.contains(a.ownerDocument, a);
            if (k.html5Clone || m.isXMLDoc(a) || !gb.test("<" + a.nodeName + ">") ? f = a.cloneNode(!0) : (tb.innerHTML = a.outerHTML, 
            tb.removeChild(f = tb.firstChild)), !(k.noCloneEvent && k.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || m.isXMLDoc(a))) for (d = ub(f), 
            h = ub(a), g = 0; null != (e = h[g]); ++g) d[g] && Bb(e, d[g]);
            if (b) if (c) for (h = h || ub(a), d = d || ub(f), g = 0; null != (e = h[g]); g++) Ab(e, d[g]); else Ab(a, f);
            return d = ub(f, "script"), d.length > 0 && zb(d, !i && ub(a, "script")), d = h = e = null, 
            f;
        },
        buildFragment: function(a, b, c, d) {
            for (var e, f, g, h, i, j, l, n = a.length, o = db(b), p = [], q = 0; n > q; q++) if ((f = a[q]) || 0 === f) if ("object" === m.type(f)) m.merge(p, f.nodeType ? [ f ] : f); else if (lb.test(f)) {
                for (h = h || o.appendChild(b.createElement("div")), i = (jb.exec(f) || [ "", "" ])[1].toLowerCase(), 
                l = rb[i] || rb._default, h.innerHTML = l[1] + f.replace(ib, "<$1></$2>") + l[2], 
                e = l[0]; e--; ) h = h.lastChild;
                if (!k.leadingWhitespace && hb.test(f) && p.push(b.createTextNode(hb.exec(f)[0])), 
                !k.tbody) for (f = "table" !== i || kb.test(f) ? "<table>" !== l[1] || kb.test(f) ? 0 : h : h.firstChild, 
                e = f && f.childNodes.length; e--; ) m.nodeName(j = f.childNodes[e], "tbody") && !j.childNodes.length && f.removeChild(j);
                for (m.merge(p, h.childNodes), h.textContent = ""; h.firstChild; ) h.removeChild(h.firstChild);
                h = o.lastChild;
            } else p.push(b.createTextNode(f));
            for (h && o.removeChild(h), k.appendChecked || m.grep(ub(p, "input"), vb), q = 0; f = p[q++]; ) if ((!d || -1 === m.inArray(f, d)) && (g = m.contains(f.ownerDocument, f), 
            h = ub(o.appendChild(f), "script"), g && zb(h), c)) for (e = 0; f = h[e++]; ) ob.test(f.type || "") && c.push(f);
            return h = null, o;
        },
        cleanData: function(a, b) {
            for (var d, e, f, g, h = 0, i = m.expando, j = m.cache, l = k.deleteExpando, n = m.event.special; null != (d = a[h]); h++) if ((b || m.acceptData(d)) && (f = d[i], 
            g = f && j[f])) {
                if (g.events) for (e in g.events) n[e] ? m.event.remove(d, e) : m.removeEvent(d, e, g.handle);
                j[f] && (delete j[f], l ? delete d[i] : typeof d.removeAttribute !== K ? d.removeAttribute(i) : d[i] = null, 
                c.push(f));
            }
        }
    }), m.fn.extend({
        text: function(a) {
            return V(this, function(a) {
                return void 0 === a ? m.text(this) : this.empty().append((this[0] && this[0].ownerDocument || y).createTextNode(a));
            }, null, a, arguments.length);
        },
        append: function() {
            return this.domManip(arguments, function(a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    wb(this, a).appendChild(a);
                }
            });
        },
        prepend: function() {
            return this.domManip(arguments, function(a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = wb(this, a);
                    b.insertBefore(a, b.firstChild);
                }
            });
        },
        before: function() {
            return this.domManip(arguments, function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this);
            });
        },
        after: function() {
            return this.domManip(arguments, function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling);
            });
        },
        remove: function(a, b) {
            for (var c, d = a ? m.filter(a, this) : this, e = 0; null != (c = d[e]); e++) b || 1 !== c.nodeType || m.cleanData(ub(c)), 
            c.parentNode && (b && m.contains(c.ownerDocument, c) && zb(ub(c, "script")), c.parentNode.removeChild(c));
            return this;
        },
        empty: function() {
            for (var a, b = 0; null != (a = this[b]); b++) {
                for (1 === a.nodeType && m.cleanData(ub(a, !1)); a.firstChild; ) a.removeChild(a.firstChild);
                a.options && m.nodeName(a, "select") && (a.options.length = 0);
            }
            return this;
        },
        clone: function(a, b) {
            return a = null != a && a, b = null == b ? a : b, this.map(function() {
                return m.clone(this, a, b);
            });
        },
        html: function(a) {
            return V(this, function(a) {
                var b = this[0] || {}, c = 0, d = this.length;
                if (void 0 === a) return 1 === b.nodeType ? b.innerHTML.replace(fb, "") : void 0;
                if (!("string" != typeof a || mb.test(a) || !k.htmlSerialize && gb.test(a) || !k.leadingWhitespace && hb.test(a) || rb[(jb.exec(a) || [ "", "" ])[1].toLowerCase()])) {
                    a = a.replace(ib, "<$1></$2>");
                    try {
                        for (;d > c; c++) b = this[c] || {}, 1 === b.nodeType && (m.cleanData(ub(b, !1)), 
                        b.innerHTML = a);
                        b = 0;
                    } catch (e) {}
                }
                b && this.empty().append(a);
            }, null, a, arguments.length);
        },
        replaceWith: function() {
            var a = arguments[0];
            return this.domManip(arguments, function(b) {
                a = this.parentNode, m.cleanData(ub(this)), a && a.replaceChild(b, this);
            }), a && (a.length || a.nodeType) ? this : this.remove();
        },
        detach: function(a) {
            return this.remove(a, !0);
        },
        domManip: function(a, b) {
            a = e.apply([], a);
            var c, d, f, g, h, i, j = 0, l = this.length, n = this, o = l - 1, p = a[0], q = m.isFunction(p);
            if (q || l > 1 && "string" == typeof p && !k.checkClone && nb.test(p)) return this.each(function(c) {
                var d = n.eq(c);
                q && (a[0] = p.call(this, c, d.html())), d.domManip(a, b);
            });
            if (l && (i = m.buildFragment(a, this[0].ownerDocument, !1, this), c = i.firstChild, 
            1 === i.childNodes.length && (i = c), c)) {
                for (g = m.map(ub(i, "script"), xb), f = g.length; l > j; j++) d = i, j !== o && (d = m.clone(d, !0, !0), 
                f && m.merge(g, ub(d, "script"))), b.call(this[j], d, j);
                if (f) for (h = g[g.length - 1].ownerDocument, m.map(g, yb), j = 0; f > j; j++) d = g[j], 
                ob.test(d.type || "") && !m._data(d, "globalEval") && m.contains(h, d) && (d.src ? m._evalUrl && m._evalUrl(d.src) : m.globalEval((d.text || d.textContent || d.innerHTML || "").replace(qb, "")));
                i = c = null;
            }
            return this;
        }
    }), m.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(a, b) {
        m.fn[a] = function(a) {
            for (var c, d = 0, e = [], g = m(a), h = g.length - 1; h >= d; d++) c = d === h ? this : this.clone(!0), 
            m(g[d])[b](c), f.apply(e, c.get());
            return this.pushStack(e);
        };
    });
    var Cb, Db = {};
    !function() {
        var a;
        k.shrinkWrapBlocks = function() {
            if (null != a) return a;
            a = !1;
            var b, c, d;
            return c = y.getElementsByTagName("body")[0], c && c.style ? (b = y.createElement("div"), 
            d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", 
            c.appendChild(d).appendChild(b), typeof b.style.zoom !== K && (b.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1", 
            b.appendChild(y.createElement("div")).style.width = "5px", a = 3 !== b.offsetWidth), 
            c.removeChild(d), a) : void 0;
        };
    }();
    var Ib, Jb, Gb = /^margin/, Hb = new RegExp("^(" + S + ")(?!px)[a-z%]+$", "i"), Kb = /^(top|right|bottom|left)$/;
    a.getComputedStyle ? (Ib = function(a) {
        return a.ownerDocument.defaultView.getComputedStyle(a, null);
    }, Jb = function(a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Ib(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, c && ("" !== g || m.contains(a.ownerDocument, a) || (g = m.style(a, b)), 
        Hb.test(g) && Gb.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, 
        g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 === g ? g : g + "";
    }) : y.documentElement.currentStyle && (Ib = function(a) {
        return a.currentStyle;
    }, Jb = function(a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Ib(a), g = c ? c[b] : void 0, null == g && h && h[b] && (g = h[b]), 
        Hb.test(g) && !Kb.test(b) && (d = h.left, e = a.runtimeStyle, f = e && e.left, f && (e.left = a.currentStyle.left), 
        h.left = "fontSize" === b ? "1em" : g, g = h.pixelLeft + "px", h.left = d, f && (e.left = f)), 
        void 0 === g ? g : g + "" || "auto";
    }), !function() {
        function i() {
            var b, c, d, i;
            (c = y.getElementsByTagName("body")[0]) && c.style && (b = y.createElement("div"), 
            d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", 
            c.appendChild(d).appendChild(b), b.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", 
            e = f = !1, h = !0, a.getComputedStyle && (e = "1%" !== (a.getComputedStyle(b, null) || {}).top, 
            f = "4px" === (a.getComputedStyle(b, null) || {
                width: "4px"
            }).width, i = b.appendChild(y.createElement("div")), i.style.cssText = b.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", 
            i.style.marginRight = i.style.width = "0", b.style.width = "1px", h = !parseFloat((a.getComputedStyle(i, null) || {}).marginRight)), 
            b.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", i = b.getElementsByTagName("td"), 
            i[0].style.cssText = "margin:0;border:0;padding:0;display:none", g = 0 === i[0].offsetHeight, 
            g && (i[0].style.display = "", i[1].style.display = "none", g = 0 === i[0].offsetHeight), 
            c.removeChild(d));
        }
        var b, c, d, e, f, g, h;
        b = y.createElement("div"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", 
        d = b.getElementsByTagName("a")[0], (c = d && d.style) && (c.cssText = "float:left;opacity:.5", 
        k.opacity = "0.5" === c.opacity, k.cssFloat = !!c.cssFloat, b.style.backgroundClip = "content-box", 
        b.cloneNode(!0).style.backgroundClip = "", k.clearCloneStyle = "content-box" === b.style.backgroundClip, 
        k.boxSizing = "" === c.boxSizing || "" === c.MozBoxSizing || "" === c.WebkitBoxSizing, 
        m.extend(k, {
            reliableHiddenOffsets: function() {
                return null == g && i(), g;
            },
            boxSizingReliable: function() {
                return null == f && i(), f;
            },
            pixelPosition: function() {
                return null == e && i(), e;
            },
            reliableMarginRight: function() {
                return null == h && i(), h;
            }
        }));
    }(), m.swap = function(a, b, c, d) {
        var e, f, g = {};
        for (f in b) g[f] = a.style[f], a.style[f] = b[f];
        e = c.apply(a, d || []);
        for (f in b) a.style[f] = g[f];
        return e;
    };
    var Mb = /alpha\([^)]*\)/i, Nb = /opacity\s*=\s*([^)]*)/, Ob = /^(none|table(?!-c[ea]).+)/, Pb = new RegExp("^(" + S + ")(.*)$", "i"), Qb = new RegExp("^([+-])=(" + S + ")", "i"), Rb = {
        position: "absolute",
        visibility: "hidden",
        display: "block"
    }, Sb = {
        letterSpacing: "0",
        fontWeight: "400"
    }, Tb = [ "Webkit", "O", "Moz", "ms" ];
    m.extend({
        cssHooks: {
            opacity: {
                get: function(a, b) {
                    if (b) {
                        var c = Jb(a, "opacity");
                        return "" === c ? "1" : c;
                    }
                }
            }
        },
        cssNumber: {
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {
            float: k.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(a, b, c, d) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var e, f, g, h = m.camelCase(b), i = a.style;
                if (b = m.cssProps[h] || (m.cssProps[h] = Ub(i, h)), g = m.cssHooks[b] || m.cssHooks[h], 
                void 0 === c) return g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b];
                if (f = typeof c, "string" === f && (e = Qb.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(m.css(a, b)), 
                f = "number"), null != c && c === c && ("number" !== f || m.cssNumber[h] || (c += "px"), 
                k.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), 
                !(g && "set" in g && void 0 === (c = g.set(a, c, d))))) try {
                    i[b] = c;
                } catch (j) {}
            }
        },
        css: function(a, b, c, d) {
            var e, f, g, h = m.camelCase(b);
            return b = m.cssProps[h] || (m.cssProps[h] = Ub(a.style, h)), g = m.cssHooks[b] || m.cssHooks[h], 
            g && "get" in g && (f = g.get(a, !0, c)), void 0 === f && (f = Jb(a, b, d)), "normal" === f && b in Sb && (f = Sb[b]), 
            "" === c || c ? (e = parseFloat(f), !0 === c || m.isNumeric(e) ? e || 0 : f) : f;
        }
    }), m.each([ "height", "width" ], function(a, b) {
        m.cssHooks[b] = {
            get: function(a, c, d) {
                return c ? Ob.test(m.css(a, "display")) && 0 === a.offsetWidth ? m.swap(a, Rb, function() {
                    return Yb(a, b, d);
                }) : Yb(a, b, d) : void 0;
            },
            set: function(a, c, d) {
                var e = d && Ib(a);
                return Wb(a, c, d ? Xb(a, b, d, k.boxSizing && "border-box" === m.css(a, "boxSizing", !1, e), e) : 0);
            }
        };
    }), k.opacity || (m.cssHooks.opacity = {
        get: function(a, b) {
            return Nb.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : b ? "1" : "";
        },
        set: function(a, b) {
            var c = a.style, d = a.currentStyle, e = m.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")" : "", f = d && d.filter || c.filter || "";
            c.zoom = 1, (b >= 1 || "" === b) && "" === m.trim(f.replace(Mb, "")) && c.removeAttribute && (c.removeAttribute("filter"), 
            "" === b || d && !d.filter) || (c.filter = Mb.test(f) ? f.replace(Mb, e) : f + " " + e);
        }
    }), m.cssHooks.marginRight = Lb(k.reliableMarginRight, function(a, b) {
        return b ? m.swap(a, {
            display: "inline-block"
        }, Jb, [ a, "marginRight" ]) : void 0;
    }), m.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(a, b) {
        m.cssHooks[a + b] = {
            expand: function(c) {
                for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [ c ]; 4 > d; d++) e[a + T[d] + b] = f[d] || f[d - 2] || f[0];
                return e;
            }
        }, Gb.test(a) || (m.cssHooks[a + b].set = Wb);
    }), m.fn.extend({
        css: function(a, b) {
            return V(this, function(a, b, c) {
                var d, e, f = {}, g = 0;
                if (m.isArray(b)) {
                    for (d = Ib(a), e = b.length; e > g; g++) f[b[g]] = m.css(a, b[g], !1, d);
                    return f;
                }
                return void 0 !== c ? m.style(a, b, c) : m.css(a, b);
            }, a, b, arguments.length > 1);
        },
        show: function() {
            return Vb(this, !0);
        },
        hide: function() {
            return Vb(this);
        },
        toggle: function(a) {
            return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function() {
                U(this) ? m(this).show() : m(this).hide();
            });
        }
    }), m.Tween = Zb, Zb.prototype = {
        constructor: Zb,
        init: function(a, b, c, d, e, f) {
            this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), 
            this.end = d, this.unit = f || (m.cssNumber[c] ? "" : "px");
        },
        cur: function() {
            var a = Zb.propHooks[this.prop];
            return a && a.get ? a.get(this) : Zb.propHooks._default.get(this);
        },
        run: function(a) {
            var b, c = Zb.propHooks[this.prop];
            return this.pos = b = this.options.duration ? m.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : a, 
            this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), 
            c && c.set ? c.set(this) : Zb.propHooks._default.set(this), this;
        }
    }, Zb.prototype.init.prototype = Zb.prototype, Zb.propHooks = {
        _default: {
            get: function(a) {
                var b;
                return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = m.css(a.elem, a.prop, ""), 
                b && "auto" !== b ? b : 0) : a.elem[a.prop];
            },
            set: function(a) {
                m.fx.step[a.prop] ? m.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[m.cssProps[a.prop]] || m.cssHooks[a.prop]) ? m.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now;
            }
        }
    }, Zb.propHooks.scrollTop = Zb.propHooks.scrollLeft = {
        set: function(a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now);
        }
    }, m.easing = {
        linear: function(a) {
            return a;
        },
        swing: function(a) {
            return .5 - Math.cos(a * Math.PI) / 2;
        }
    }, m.fx = Zb.prototype.init, m.fx.step = {};
    var $b, _b, ac = /^(?:toggle|show|hide)$/, bc = new RegExp("^(?:([+-])=|)(" + S + ")([a-z%]*)$", "i"), cc = /queueHooks$/, dc = [ ic ], ec = {
        "*": [ function(a, b) {
            var c = this.createTween(a, b), d = c.cur(), e = bc.exec(b), f = e && e[3] || (m.cssNumber[a] ? "" : "px"), g = (m.cssNumber[a] || "px" !== f && +d) && bc.exec(m.css(c.elem, a)), h = 1, i = 20;
            if (g && g[3] !== f) {
                f = f || g[3], e = e || [], g = +d || 1;
                do {
                    h = h || ".5", g /= h, m.style(c.elem, a, g + f);
                } while (h !== (h = c.cur() / d) && 1 !== h && --i);
            }
            return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), 
            c;
        } ]
    };
    m.Animation = m.extend(kc, {
        tweener: function(a, b) {
            m.isFunction(a) ? (b = a, a = [ "*" ]) : a = a.split(" ");
            for (var c, d = 0, e = a.length; e > d; d++) c = a[d], ec[c] = ec[c] || [], ec[c].unshift(b);
        },
        prefilter: function(a, b) {
            b ? dc.unshift(a) : dc.push(a);
        }
    }), m.speed = function(a, b, c) {
        var d = a && "object" == typeof a ? m.extend({}, a) : {
            complete: c || !c && b || m.isFunction(a) && a,
            duration: a,
            easing: c && b || b && !m.isFunction(b) && b
        };
        return d.duration = m.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in m.fx.speeds ? m.fx.speeds[d.duration] : m.fx.speeds._default, 
        (null == d.queue || !0 === d.queue) && (d.queue = "fx"), d.old = d.complete, d.complete = function() {
            m.isFunction(d.old) && d.old.call(this), d.queue && m.dequeue(this, d.queue);
        }, d;
    }, m.fn.extend({
        fadeTo: function(a, b, c, d) {
            return this.filter(U).css("opacity", 0).show().end().animate({
                opacity: b
            }, a, c, d);
        },
        animate: function(a, b, c, d) {
            var e = m.isEmptyObject(a), f = m.speed(b, c, d), g = function() {
                var b = kc(this, m.extend({}, a), f);
                (e || m._data(this, "finish")) && b.stop(!0);
            };
            return g.finish = g, e || !1 === f.queue ? this.each(g) : this.queue(f.queue, g);
        },
        stop: function(a, b, c) {
            var d = function(a) {
                var b = a.stop;
                delete a.stop, b(c);
            };
            return "string" != typeof a && (c = b, b = a, a = void 0), b && !1 !== a && this.queue(a || "fx", []), 
            this.each(function() {
                var b = !0, e = null != a && a + "queueHooks", f = m.timers, g = m._data(this);
                if (e) g[e] && g[e].stop && d(g[e]); else for (e in g) g[e] && g[e].stop && cc.test(e) && d(g[e]);
                for (e = f.length; e--; ) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), 
                b = !1, f.splice(e, 1));
                (b || !c) && m.dequeue(this, a);
            });
        },
        finish: function(a) {
            return !1 !== a && (a = a || "fx"), this.each(function() {
                var b, c = m._data(this), d = c[a + "queue"], e = c[a + "queueHooks"], f = m.timers, g = d ? d.length : 0;
                for (c.finish = !0, m.queue(this, a, []), e && e.stop && e.stop.call(this, !0), 
                b = f.length; b--; ) f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), 
                f.splice(b, 1));
                for (b = 0; g > b; b++) d[b] && d[b].finish && d[b].finish.call(this);
                delete c.finish;
            });
        }
    }), m.each([ "toggle", "show", "hide" ], function(a, b) {
        var c = m.fn[b];
        m.fn[b] = function(a, d, e) {
            return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(gc(b, !0), a, d, e);
        };
    }), m.each({
        slideDown: gc("show"),
        slideUp: gc("hide"),
        slideToggle: gc("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function(a, b) {
        m.fn[a] = function(a, c, d) {
            return this.animate(b, a, c, d);
        };
    }), m.timers = [], m.fx.tick = function() {
        var a, b = m.timers, c = 0;
        for ($b = m.now(); c < b.length; c++) (a = b[c])() || b[c] !== a || b.splice(c--, 1);
        b.length || m.fx.stop(), $b = void 0;
    }, m.fx.timer = function(a) {
        m.timers.push(a), a() ? m.fx.start() : m.timers.pop();
    }, m.fx.interval = 13, m.fx.start = function() {
        _b || (_b = setInterval(m.fx.tick, m.fx.interval));
    }, m.fx.stop = function() {
        clearInterval(_b), _b = null;
    }, m.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, m.fn.delay = function(a, b) {
        return a = m.fx ? m.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function(b, c) {
            var d = setTimeout(b, a);
            c.stop = function() {
                clearTimeout(d);
            };
        });
    }, function() {
        var a, b, c, d, e;
        b = y.createElement("div"), b.setAttribute("className", "t"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", 
        d = b.getElementsByTagName("a")[0], c = y.createElement("select"), e = c.appendChild(y.createElement("option")), 
        a = b.getElementsByTagName("input")[0], d.style.cssText = "top:1px", k.getSetAttribute = "t" !== b.className, 
        k.style = /top/.test(d.getAttribute("style")), k.hrefNormalized = "/a" === d.getAttribute("href"), 
        k.checkOn = !!a.value, k.optSelected = e.selected, k.enctype = !!y.createElement("form").enctype, 
        c.disabled = !0, k.optDisabled = !e.disabled, a = y.createElement("input"), a.setAttribute("value", ""), 
        k.input = "" === a.getAttribute("value"), a.value = "t", a.setAttribute("type", "radio"), 
        k.radioValue = "t" === a.value;
    }();
    var lc = /\r/g;
    m.fn.extend({
        val: function(a) {
            var b, c, d, e = this[0];
            return arguments.length ? (d = m.isFunction(a), this.each(function(c) {
                var e;
                1 === this.nodeType && (e = d ? a.call(this, c, m(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : m.isArray(e) && (e = m.map(e, function(a) {
                    return null == a ? "" : a + "";
                })), (b = m.valHooks[this.type] || m.valHooks[this.nodeName.toLowerCase()]) && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e));
            })) : e ? (b = m.valHooks[e.type] || m.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, 
            "string" == typeof c ? c.replace(lc, "") : null == c ? "" : c)) : void 0;
        }
    }), m.extend({
        valHooks: {
            option: {
                get: function(a) {
                    var b = m.find.attr(a, "value");
                    return null != b ? b : m.trim(m.text(a));
                }
            },
            select: {
                get: function(a) {
                    for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++) if (c = d[i], 
                    !(!c.selected && i !== e || (k.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && m.nodeName(c.parentNode, "optgroup"))) {
                        if (b = m(c).val(), f) return b;
                        g.push(b);
                    }
                    return g;
                },
                set: function(a, b) {
                    for (var c, d, e = a.options, f = m.makeArray(b), g = e.length; g--; ) if (d = e[g], 
                    m.inArray(m.valHooks.option.get(d), f) >= 0) try {
                        d.selected = c = !0;
                    } catch (h) {
                        d.scrollHeight;
                    } else d.selected = !1;
                    return c || (a.selectedIndex = -1), e;
                }
            }
        }
    }), m.each([ "radio", "checkbox" ], function() {
        m.valHooks[this] = {
            set: function(a, b) {
                return m.isArray(b) ? a.checked = m.inArray(m(a).val(), b) >= 0 : void 0;
            }
        }, k.checkOn || (m.valHooks[this].get = function(a) {
            return null === a.getAttribute("value") ? "on" : a.value;
        });
    });
    var mc, nc, oc = m.expr.attrHandle, pc = /^(?:checked|selected)$/i, qc = k.getSetAttribute, rc = k.input;
    m.fn.extend({
        attr: function(a, b) {
            return V(this, m.attr, a, b, arguments.length > 1);
        },
        removeAttr: function(a) {
            return this.each(function() {
                m.removeAttr(this, a);
            });
        }
    }), m.extend({
        attr: function(a, b, c) {
            var d, e, f = a.nodeType;
            if (a && 3 !== f && 8 !== f && 2 !== f) return typeof a.getAttribute === K ? m.prop(a, b, c) : (1 === f && m.isXMLDoc(a) || (b = b.toLowerCase(), 
            d = m.attrHooks[b] || (m.expr.match.bool.test(b) ? nc : mc)), void 0 === c ? d && "get" in d && null !== (e = d.get(a, b)) ? e : (e = m.find.attr(a, b), 
            null == e ? void 0 : e) : null !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), 
            c) : void m.removeAttr(a, b));
        },
        removeAttr: function(a, b) {
            var c, d, e = 0, f = b && b.match(E);
            if (f && 1 === a.nodeType) for (;c = f[e++]; ) d = m.propFix[c] || c, m.expr.match.bool.test(c) ? rc && qc || !pc.test(c) ? a[d] = !1 : a[m.camelCase("default-" + c)] = a[d] = !1 : m.attr(a, c, ""), 
            a.removeAttribute(qc ? c : d);
        },
        attrHooks: {
            type: {
                set: function(a, b) {
                    if (!k.radioValue && "radio" === b && m.nodeName(a, "input")) {
                        var c = a.value;
                        return a.setAttribute("type", b), c && (a.value = c), b;
                    }
                }
            }
        }
    }), nc = {
        set: function(a, b, c) {
            return !1 === b ? m.removeAttr(a, c) : rc && qc || !pc.test(c) ? a.setAttribute(!qc && m.propFix[c] || c, c) : a[m.camelCase("default-" + c)] = a[c] = !0, 
            c;
        }
    }, m.each(m.expr.match.bool.source.match(/\w+/g), function(a, b) {
        var c = oc[b] || m.find.attr;
        oc[b] = rc && qc || !pc.test(b) ? function(a, b, d) {
            var e, f;
            return d || (f = oc[b], oc[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, 
            oc[b] = f), e;
        } : function(a, b, c) {
            return c ? void 0 : a[m.camelCase("default-" + b)] ? b.toLowerCase() : null;
        };
    }), rc && qc || (m.attrHooks.value = {
        set: function(a, b, c) {
            return m.nodeName(a, "input") ? void (a.defaultValue = b) : mc && mc.set(a, b, c);
        }
    }), qc || (mc = {
        set: function(a, b, c) {
            var d = a.getAttributeNode(c);
            return d || a.setAttributeNode(d = a.ownerDocument.createAttribute(c)), d.value = b += "", 
            "value" === c || b === a.getAttribute(c) ? b : void 0;
        }
    }, oc.id = oc.name = oc.coords = function(a, b, c) {
        var d;
        return c ? void 0 : (d = a.getAttributeNode(b)) && "" !== d.value ? d.value : null;
    }, m.valHooks.button = {
        get: function(a, b) {
            var c = a.getAttributeNode(b);
            return c && c.specified ? c.value : void 0;
        },
        set: mc.set
    }, m.attrHooks.contenteditable = {
        set: function(a, b, c) {
            mc.set(a, "" !== b && b, c);
        }
    }, m.each([ "width", "height" ], function(a, b) {
        m.attrHooks[b] = {
            set: function(a, c) {
                return "" === c ? (a.setAttribute(b, "auto"), c) : void 0;
            }
        };
    })), k.style || (m.attrHooks.style = {
        get: function(a) {
            return a.style.cssText || void 0;
        },
        set: function(a, b) {
            return a.style.cssText = b + "";
        }
    });
    var sc = /^(?:input|select|textarea|button|object)$/i, tc = /^(?:a|area)$/i;
    m.fn.extend({
        prop: function(a, b) {
            return V(this, m.prop, a, b, arguments.length > 1);
        },
        removeProp: function(a) {
            return a = m.propFix[a] || a, this.each(function() {
                try {
                    this[a] = void 0, delete this[a];
                } catch (b) {}
            });
        }
    }), m.extend({
        propFix: {
            for: "htmlFor",
            class: "className"
        },
        prop: function(a, b, c) {
            var d, e, f, g = a.nodeType;
            if (a && 3 !== g && 8 !== g && 2 !== g) return f = 1 !== g || !m.isXMLDoc(a), f && (b = m.propFix[b] || b, 
            e = m.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b];
        },
        propHooks: {
            tabIndex: {
                get: function(a) {
                    var b = m.find.attr(a, "tabindex");
                    return b ? parseInt(b, 10) : sc.test(a.nodeName) || tc.test(a.nodeName) && a.href ? 0 : -1;
                }
            }
        }
    }), k.hrefNormalized || m.each([ "href", "src" ], function(a, b) {
        m.propHooks[b] = {
            get: function(a) {
                return a.getAttribute(b, 4);
            }
        };
    }), k.optSelected || (m.propHooks.selected = {
        get: function(a) {
            var b = a.parentNode;
            return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex), null;
        }
    }), m.each([ "tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable" ], function() {
        m.propFix[this.toLowerCase()] = this;
    }), k.enctype || (m.propFix.enctype = "encoding");
    var uc = /[\t\r\n\f]/g;
    m.fn.extend({
        addClass: function(a) {
            var b, c, d, e, f, g, h = 0, i = this.length, j = "string" == typeof a && a;
            if (m.isFunction(a)) return this.each(function(b) {
                m(this).addClass(a.call(this, b, this.className));
            });
            if (j) for (b = (a || "").match(E) || []; i > h; h++) if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(uc, " ") : " ")) {
                for (f = 0; e = b[f++]; ) d.indexOf(" " + e + " ") < 0 && (d += e + " ");
                g = m.trim(d), c.className !== g && (c.className = g);
            }
            return this;
        },
        removeClass: function(a) {
            var b, c, d, e, f, g, h = 0, i = this.length, j = 0 === arguments.length || "string" == typeof a && a;
            if (m.isFunction(a)) return this.each(function(b) {
                m(this).removeClass(a.call(this, b, this.className));
            });
            if (j) for (b = (a || "").match(E) || []; i > h; h++) if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(uc, " ") : "")) {
                for (f = 0; e = b[f++]; ) for (;d.indexOf(" " + e + " ") >= 0; ) d = d.replace(" " + e + " ", " ");
                g = a ? m.trim(d) : "", c.className !== g && (c.className = g);
            }
            return this;
        },
        toggleClass: function(a, b) {
            var c = typeof a;
            return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : this.each(m.isFunction(a) ? function(c) {
                m(this).toggleClass(a.call(this, c, this.className, b), b);
            } : function() {
                if ("string" === c) for (var b, d = 0, e = m(this), f = a.match(E) || []; b = f[d++]; ) e.hasClass(b) ? e.removeClass(b) : e.addClass(b); else (c === K || "boolean" === c) && (this.className && m._data(this, "__className__", this.className), 
                this.className = this.className || !1 === a ? "" : m._data(this, "__className__") || "");
            });
        },
        hasClass: function(a) {
            for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++) if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(uc, " ").indexOf(b) >= 0) return !0;
            return !1;
        }
    }), m.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(a, b) {
        m.fn[b] = function(a, c) {
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b);
        };
    }), m.fn.extend({
        hover: function(a, b) {
            return this.mouseenter(a).mouseleave(b || a);
        },
        bind: function(a, b, c) {
            return this.on(a, null, b, c);
        },
        unbind: function(a, b) {
            return this.off(a, null, b);
        },
        delegate: function(a, b, c, d) {
            return this.on(b, a, c, d);
        },
        undelegate: function(a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c);
        }
    });
    var vc = m.now(), wc = /\?/, xc = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
    m.parseJSON = function(b) {
        if (a.JSON && a.JSON.parse) return a.JSON.parse(b + "");
        var c, d = null, e = m.trim(b + "");
        return e && !m.trim(e.replace(xc, function(a, b, e, f) {
            return c && b && (d = 0), 0 === d ? a : (c = e || b, d += !f - !e, "");
        })) ? Function("return " + e)() : m.error("Invalid JSON: " + b);
    }, m.parseXML = function(b) {
        var c, d;
        if (!b || "string" != typeof b) return null;
        try {
            a.DOMParser ? (d = new DOMParser(), c = d.parseFromString(b, "text/xml")) : (c = new ActiveXObject("Microsoft.XMLDOM"), 
            c.async = "false", c.loadXML(b));
        } catch (e) {
            c = void 0;
        }
        return c && c.documentElement && !c.getElementsByTagName("parsererror").length || m.error("Invalid XML: " + b), 
        c;
    };
    var yc, zc, Ac = /#.*$/, Bc = /([?&])_=[^&]*/, Cc = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm, Dc = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, Ec = /^(?:GET|HEAD)$/, Fc = /^\/\//, Gc = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, Hc = {}, Ic = {}, Jc = "*/".concat("*");
    try {
        zc = location.href;
    } catch (Kc) {
        zc = y.createElement("a"), zc.href = "", zc = zc.href;
    }
    yc = Gc.exec(zc.toLowerCase()) || [], m.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: zc,
            type: "GET",
            isLocal: Dc.test(yc[1]),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Jc,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": m.parseJSON,
                "text xml": m.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(a, b) {
            return b ? Nc(Nc(a, m.ajaxSettings), b) : Nc(m.ajaxSettings, a);
        },
        ajaxPrefilter: Lc(Hc),
        ajaxTransport: Lc(Ic),
        ajax: function(a, b) {
            function x(a, b, c, d) {
                var j, r, s, u, w, x = b;
                2 !== t && (t = 2, g && clearTimeout(g), i = void 0, f = d || "", v.readyState = a > 0 ? 4 : 0, 
                j = a >= 200 && 300 > a || 304 === a, c && (u = Oc(k, v, c)), u = Pc(k, u, v, j), 
                j ? (k.ifModified && (w = v.getResponseHeader("Last-Modified"), w && (m.lastModified[e] = w), 
                (w = v.getResponseHeader("etag")) && (m.etag[e] = w)), 204 === a || "HEAD" === k.type ? x = "nocontent" : 304 === a ? x = "notmodified" : (x = u.state, 
                r = u.data, s = u.error, j = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), 
                v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [ r, x, v ]) : o.rejectWith(l, [ v, x, s ]), 
                v.statusCode(q), q = void 0, h && n.trigger(j ? "ajaxSuccess" : "ajaxError", [ v, k, j ? r : s ]), 
                p.fireWith(l, [ v, x ]), h && (n.trigger("ajaxComplete", [ v, k ]), --m.active || m.event.trigger("ajaxStop")));
            }
            "object" == typeof a && (b = a, a = void 0), b = b || {};
            var c, d, e, f, g, h, i, j, k = m.ajaxSetup({}, b), l = k.context || k, n = k.context && (l.nodeType || l.jquery) ? m(l) : m.event, o = m.Deferred(), p = m.Callbacks("once memory"), q = k.statusCode || {}, r = {}, s = {}, t = 0, u = "canceled", v = {
                readyState: 0,
                getResponseHeader: function(a) {
                    var b;
                    if (2 === t) {
                        if (!j) for (j = {}; b = Cc.exec(f); ) j[b[1].toLowerCase()] = b[2];
                        b = j[a.toLowerCase()];
                    }
                    return null == b ? null : b;
                },
                getAllResponseHeaders: function() {
                    return 2 === t ? f : null;
                },
                setRequestHeader: function(a, b) {
                    var c = a.toLowerCase();
                    return t || (a = s[c] = s[c] || a, r[a] = b), this;
                },
                overrideMimeType: function(a) {
                    return t || (k.mimeType = a), this;
                },
                statusCode: function(a) {
                    var b;
                    if (a) if (2 > t) for (b in a) q[b] = [ q[b], a[b] ]; else v.always(a[v.status]);
                    return this;
                },
                abort: function(a) {
                    var b = a || u;
                    return i && i.abort(b), x(0, b), this;
                }
            };
            if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, k.url = ((a || k.url || zc) + "").replace(Ac, "").replace(Fc, yc[1] + "//"), 
            k.type = b.method || b.type || k.method || k.type, k.dataTypes = m.trim(k.dataType || "*").toLowerCase().match(E) || [ "" ], 
            null == k.crossDomain && (c = Gc.exec(k.url.toLowerCase()), k.crossDomain = !(!c || c[1] === yc[1] && c[2] === yc[2] && (c[3] || ("http:" === c[1] ? "80" : "443")) === (yc[3] || ("http:" === yc[1] ? "80" : "443")))), 
            k.data && k.processData && "string" != typeof k.data && (k.data = m.param(k.data, k.traditional)), 
            Mc(Hc, k, b, v), 2 === t) return v;
            h = k.global, h && 0 == m.active++ && m.event.trigger("ajaxStart"), k.type = k.type.toUpperCase(), 
            k.hasContent = !Ec.test(k.type), e = k.url, k.hasContent || (k.data && (e = k.url += (wc.test(e) ? "&" : "?") + k.data, 
            delete k.data), !1 === k.cache && (k.url = Bc.test(e) ? e.replace(Bc, "$1_=" + vc++) : e + (wc.test(e) ? "&" : "?") + "_=" + vc++)), 
            k.ifModified && (m.lastModified[e] && v.setRequestHeader("If-Modified-Since", m.lastModified[e]), 
            m.etag[e] && v.setRequestHeader("If-None-Match", m.etag[e])), (k.data && k.hasContent && !1 !== k.contentType || b.contentType) && v.setRequestHeader("Content-Type", k.contentType), 
            v.setRequestHeader("Accept", k.dataTypes[0] && k.accepts[k.dataTypes[0]] ? k.accepts[k.dataTypes[0]] + ("*" !== k.dataTypes[0] ? ", " + Jc + "; q=0.01" : "") : k.accepts["*"]);
            for (d in k.headers) v.setRequestHeader(d, k.headers[d]);
            if (k.beforeSend && (!1 === k.beforeSend.call(l, v, k) || 2 === t)) return v.abort();
            u = "abort";
            for (d in {
                success: 1,
                error: 1,
                complete: 1
            }) v[d](k[d]);
            if (i = Mc(Ic, k, b, v)) {
                v.readyState = 1, h && n.trigger("ajaxSend", [ v, k ]), k.async && k.timeout > 0 && (g = setTimeout(function() {
                    v.abort("timeout");
                }, k.timeout));
                try {
                    t = 1, i.send(r, x);
                } catch (w) {
                    if (!(2 > t)) throw w;
                    x(-1, w);
                }
            } else x(-1, "No Transport");
            return v;
        },
        getJSON: function(a, b, c) {
            return m.get(a, b, c, "json");
        },
        getScript: function(a, b) {
            return m.get(a, void 0, b, "script");
        }
    }), m.each([ "get", "post" ], function(a, b) {
        m[b] = function(a, c, d, e) {
            return m.isFunction(c) && (e = e || d, d = c, c = void 0), m.ajax({
                url: a,
                type: b,
                dataType: e,
                data: c,
                success: d
            });
        };
    }), m.each([ "ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend" ], function(a, b) {
        m.fn[b] = function(a) {
            return this.on(b, a);
        };
    }), m._evalUrl = function(a) {
        return m.ajax({
            url: a,
            type: "GET",
            dataType: "script",
            async: !1,
            global: !1,
            throws: !0
        });
    }, m.fn.extend({
        wrapAll: function(a) {
            if (m.isFunction(a)) return this.each(function(b) {
                m(this).wrapAll(a.call(this, b));
            });
            if (this[0]) {
                var b = m(a, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && b.insertBefore(this[0]), b.map(function() {
                    for (var a = this; a.firstChild && 1 === a.firstChild.nodeType; ) a = a.firstChild;
                    return a;
                }).append(this);
            }
            return this;
        },
        wrapInner: function(a) {
            return this.each(m.isFunction(a) ? function(b) {
                m(this).wrapInner(a.call(this, b));
            } : function() {
                var b = m(this), c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a);
            });
        },
        wrap: function(a) {
            var b = m.isFunction(a);
            return this.each(function(c) {
                m(this).wrapAll(b ? a.call(this, c) : a);
            });
        },
        unwrap: function() {
            return this.parent().each(function() {
                m.nodeName(this, "body") || m(this).replaceWith(this.childNodes);
            }).end();
        }
    }), m.expr.filters.hidden = function(a) {
        return a.offsetWidth <= 0 && a.offsetHeight <= 0 || !k.reliableHiddenOffsets() && "none" === (a.style && a.style.display || m.css(a, "display"));
    }, m.expr.filters.visible = function(a) {
        return !m.expr.filters.hidden(a);
    };
    var Qc = /%20/g, Rc = /\[\]$/, Sc = /\r?\n/g, Tc = /^(?:submit|button|image|reset|file)$/i, Uc = /^(?:input|select|textarea|keygen)/i;
    m.param = function(a, b) {
        var c, d = [], e = function(a, b) {
            b = m.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b);
        };
        if (void 0 === b && (b = m.ajaxSettings && m.ajaxSettings.traditional), m.isArray(a) || a.jquery && !m.isPlainObject(a)) m.each(a, function() {
            e(this.name, this.value);
        }); else for (c in a) Vc(c, a[c], b, e);
        return d.join("&").replace(Qc, "+");
    }, m.fn.extend({
        serialize: function() {
            return m.param(this.serializeArray());
        },
        serializeArray: function() {
            return this.map(function() {
                var a = m.prop(this, "elements");
                return a ? m.makeArray(a) : this;
            }).filter(function() {
                var a = this.type;
                return this.name && !m(this).is(":disabled") && Uc.test(this.nodeName) && !Tc.test(a) && (this.checked || !W.test(a));
            }).map(function(a, b) {
                var c = m(this).val();
                return null == c ? null : m.isArray(c) ? m.map(c, function(a) {
                    return {
                        name: b.name,
                        value: a.replace(Sc, "\r\n")
                    };
                }) : {
                    name: b.name,
                    value: c.replace(Sc, "\r\n")
                };
            }).get();
        }
    }), m.ajaxSettings.xhr = void 0 !== a.ActiveXObject ? function() {
        return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && Zc() || $c();
    } : Zc;
    var Wc = 0, Xc = {}, Yc = m.ajaxSettings.xhr();
    a.ActiveXObject && m(a).on("unload", function() {
        for (var a in Xc) Xc[a](void 0, !0);
    }), k.cors = !!Yc && "withCredentials" in Yc, (Yc = k.ajax = !!Yc) && m.ajaxTransport(function(a) {
        if (!a.crossDomain || k.cors) {
            var b;
            return {
                send: function(c, d) {
                    var e, f = a.xhr(), g = ++Wc;
                    if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields) for (e in a.xhrFields) f[e] = a.xhrFields[e];
                    a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
                    for (e in c) void 0 !== c[e] && f.setRequestHeader(e, c[e] + "");
                    f.send(a.hasContent && a.data || null), b = function(c, e) {
                        var h, i, j;
                        if (b && (e || 4 === f.readyState)) if (delete Xc[g], b = void 0, f.onreadystatechange = m.noop, 
                        e) 4 !== f.readyState && f.abort(); else {
                            j = {}, h = f.status, "string" == typeof f.responseText && (j.text = f.responseText);
                            try {
                                i = f.statusText;
                            } catch (k) {
                                i = "";
                            }
                            h || !a.isLocal || a.crossDomain ? 1223 === h && (h = 204) : h = j.text ? 200 : 404;
                        }
                        j && d(h, i, j, f.getAllResponseHeaders());
                    }, a.async ? 4 === f.readyState ? setTimeout(b) : f.onreadystatechange = Xc[g] = b : b();
                },
                abort: function() {
                    b && b(void 0, !0);
                }
            };
        }
    }), m.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /(?:java|ecma)script/
        },
        converters: {
            "text script": function(a) {
                return m.globalEval(a), a;
            }
        }
    }), m.ajaxPrefilter("script", function(a) {
        void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1);
    }), m.ajaxTransport("script", function(a) {
        if (a.crossDomain) {
            var b, c = y.head || m("head")[0] || y.documentElement;
            return {
                send: function(d, e) {
                    b = y.createElement("script"), b.async = !0, a.scriptCharset && (b.charset = a.scriptCharset), 
                    b.src = a.url, b.onload = b.onreadystatechange = function(a, c) {
                        (c || !b.readyState || /loaded|complete/.test(b.readyState)) && (b.onload = b.onreadystatechange = null, 
                        b.parentNode && b.parentNode.removeChild(b), b = null, c || e(200, "success"));
                    }, c.insertBefore(b, c.firstChild);
                },
                abort: function() {
                    b && b.onload(void 0, !0);
                }
            };
        }
    });
    var _c = [], ad = /(=)\?(?=&|$)|\?\?/;
    m.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var a = _c.pop() || m.expando + "_" + vc++;
            return this[a] = !0, a;
        }
    }), m.ajaxPrefilter("json jsonp", function(b, c, d) {
        var e, f, g, h = !1 !== b.jsonp && (ad.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && ad.test(b.data) && "data");
        return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = m.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, 
        h ? b[h] = b[h].replace(ad, "$1" + e) : !1 !== b.jsonp && (b.url += (wc.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), 
        b.converters["script json"] = function() {
            return g || m.error(e + " was not called"), g[0];
        }, b.dataTypes[0] = "json", f = a[e], a[e] = function() {
            g = arguments;
        }, d.always(function() {
            a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, _c.push(e)), g && m.isFunction(f) && f(g[0]), 
            g = f = void 0;
        }), "script") : void 0;
    }), m.parseHTML = function(a, b, c) {
        if (!a || "string" != typeof a) return null;
        "boolean" == typeof b && (c = b, b = !1), b = b || y;
        var d = u.exec(a), e = !c && [];
        return d ? [ b.createElement(d[1]) ] : (d = m.buildFragment([ a ], b, e), e && e.length && m(e).remove(), 
        m.merge([], d.childNodes));
    };
    var bd = m.fn.load;
    m.fn.load = function(a, b, c) {
        if ("string" != typeof a && bd) return bd.apply(this, arguments);
        var d, e, f, g = this, h = a.indexOf(" ");
        return h >= 0 && (d = m.trim(a.slice(h, a.length)), a = a.slice(0, h)), m.isFunction(b) ? (c = b, 
        b = void 0) : b && "object" == typeof b && (f = "POST"), g.length > 0 && m.ajax({
            url: a,
            type: f,
            dataType: "html",
            data: b
        }).done(function(a) {
            e = arguments, g.html(d ? m("<div>").append(m.parseHTML(a)).find(d) : a);
        }).complete(c && function(a, b) {
            g.each(c, e || [ a.responseText, b, a ]);
        }), this;
    }, m.expr.filters.animated = function(a) {
        return m.grep(m.timers, function(b) {
            return a === b.elem;
        }).length;
    };
    var cd = a.document.documentElement;
    m.offset = {
        setOffset: function(a, b, c) {
            var d, e, f, g, h, i, j, k = m.css(a, "position"), l = m(a), n = {};
            "static" === k && (a.style.position = "relative"), h = l.offset(), f = m.css(a, "top"), 
            i = m.css(a, "left"), j = ("absolute" === k || "fixed" === k) && m.inArray("auto", [ f, i ]) > -1, 
            j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), 
            m.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (n.top = b.top - h.top + g), 
            null != b.left && (n.left = b.left - h.left + e), "using" in b ? b.using.call(a, n) : l.css(n);
        }
    }, m.fn.extend({
        offset: function(a) {
            if (arguments.length) return void 0 === a ? this : this.each(function(b) {
                m.offset.setOffset(this, a, b);
            });
            var b, c, d = {
                top: 0,
                left: 0
            }, e = this[0], f = e && e.ownerDocument;
            return f ? (b = f.documentElement, m.contains(b, e) ? (typeof e.getBoundingClientRect !== K && (d = e.getBoundingClientRect()), 
            c = dd(f), {
                top: d.top + (c.pageYOffset || b.scrollTop) - (b.clientTop || 0),
                left: d.left + (c.pageXOffset || b.scrollLeft) - (b.clientLeft || 0)
            }) : d) : void 0;
        },
        position: function() {
            if (this[0]) {
                var a, b, c = {
                    top: 0,
                    left: 0
                }, d = this[0];
                return "fixed" === m.css(d, "position") ? b = d.getBoundingClientRect() : (a = this.offsetParent(), 
                b = this.offset(), m.nodeName(a[0], "html") || (c = a.offset()), c.top += m.css(a[0], "borderTopWidth", !0), 
                c.left += m.css(a[0], "borderLeftWidth", !0)), {
                    top: b.top - c.top - m.css(d, "marginTop", !0),
                    left: b.left - c.left - m.css(d, "marginLeft", !0)
                };
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var a = this.offsetParent || cd; a && !m.nodeName(a, "html") && "static" === m.css(a, "position"); ) a = a.offsetParent;
                return a || cd;
            });
        }
    }), m.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(a, b) {
        var c = /Y/.test(b);
        m.fn[a] = function(d) {
            return V(this, function(a, d, e) {
                var f = dd(a);
                return void 0 === e ? f ? b in f ? f[b] : f.document.documentElement[d] : a[d] : void (f ? f.scrollTo(c ? m(f).scrollLeft() : e, c ? e : m(f).scrollTop()) : a[d] = e);
            }, a, d, arguments.length, null);
        };
    }), m.each([ "top", "left" ], function(a, b) {
        m.cssHooks[b] = Lb(k.pixelPosition, function(a, c) {
            return c ? (c = Jb(a, b), Hb.test(c) ? m(a).position()[b] + "px" : c) : void 0;
        });
    }), m.each({
        Height: "height",
        Width: "width"
    }, function(a, b) {
        m.each({
            padding: "inner" + a,
            content: b,
            "": "outer" + a
        }, function(c, d) {
            m.fn[d] = function(d, e) {
                var f = arguments.length && (c || "boolean" != typeof d), g = c || (!0 === d || !0 === e ? "margin" : "border");
                return V(this, function(b, c, d) {
                    var e;
                    return m.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, 
                    Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? m.css(b, c, g) : m.style(b, c, d, g);
                }, b, f ? d : void 0, f, null);
            };
        });
    }), m.fn.size = function() {
        return this.length;
    }, m.fn.andSelf = m.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
        return m;
    });
    var ed = a.jQuery, fd = a.$;
    return m.noConflict = function(b) {
        return a.$ === m && (a.$ = fd), b && a.jQuery === m && (a.jQuery = ed), m;
    }, typeof b === K && (a.jQuery = a.$ = m), m;
}), function(e) {
    "function" == typeof define && define.amd ? define([ "jquery" ], e) : e(jQuery);
}(function(e) {
    function t(t, s) {
        var n, a, o, r = t.nodeName.toLowerCase();
        return "area" === r ? (n = t.parentNode, a = n.name, !(!t.href || !a || "map" !== n.nodeName.toLowerCase()) && (!!(o = e("img[usemap='#" + a + "']")[0]) && i(o))) : (/^(input|select|textarea|button|object)$/.test(r) ? !t.disabled : "a" === r ? t.href || s : s) && i(t);
    }
    function i(t) {
        return e.expr.filters.visible(t) && !e(t).parents().addBack().filter(function() {
            return "hidden" === e.css(this, "visibility");
        }).length;
    }
    e.ui = e.ui || {}, e.extend(e.ui, {
        version: "1.11.4",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), e.fn.extend({
        scrollParent: function(t) {
            var i = this.css("position"), s = "absolute" === i, n = t ? /(auto|scroll|hidden)/ : /(auto|scroll)/, a = this.parents().filter(function() {
                var t = e(this);
                return (!s || "static" !== t.css("position")) && n.test(t.css("overflow") + t.css("overflow-y") + t.css("overflow-x"));
            }).eq(0);
            return "fixed" !== i && a.length ? a : e(this[0].ownerDocument || document);
        },
        uniqueId: function() {
            var e = 0;
            return function() {
                return this.each(function() {
                    this.id || (this.id = "ui-id-" + ++e);
                });
            };
        }(),
        removeUniqueId: function() {
            return this.each(function() {
                /^ui-id-\d+$/.test(this.id) && e(this).removeAttr("id");
            });
        }
    }), e.extend(e.expr[":"], {
        data: e.expr.createPseudo ? e.expr.createPseudo(function(t) {
            return function(i) {
                return !!e.data(i, t);
            };
        }) : function(t, i, s) {
            return !!e.data(t, s[3]);
        },
        focusable: function(i) {
            return t(i, !isNaN(e.attr(i, "tabindex")));
        },
        tabbable: function(i) {
            var s = e.attr(i, "tabindex"), n = isNaN(s);
            return (n || s >= 0) && t(i, !n);
        }
    }), e("<a>").outerWidth(1).jquery || e.each([ "Width", "Height" ], function(t, i) {
        function s(t, i, s, a) {
            return e.each(n, function() {
                i -= parseFloat(e.css(t, "padding" + this)) || 0, s && (i -= parseFloat(e.css(t, "border" + this + "Width")) || 0), 
                a && (i -= parseFloat(e.css(t, "margin" + this)) || 0);
            }), i;
        }
        var n = "Width" === i ? [ "Left", "Right" ] : [ "Top", "Bottom" ], a = i.toLowerCase(), o = {
            innerWidth: e.fn.innerWidth,
            innerHeight: e.fn.innerHeight,
            outerWidth: e.fn.outerWidth,
            outerHeight: e.fn.outerHeight
        };
        e.fn["inner" + i] = function(t) {
            return void 0 === t ? o["inner" + i].call(this) : this.each(function() {
                e(this).css(a, s(this, t) + "px");
            });
        }, e.fn["outer" + i] = function(t, n) {
            return "number" != typeof t ? o["outer" + i].call(this, t) : this.each(function() {
                e(this).css(a, s(this, t, !0, n) + "px");
            });
        };
    }), e.fn.addBack || (e.fn.addBack = function(e) {
        return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
    }), e("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (e.fn.removeData = function(t) {
        return function(i) {
            return arguments.length ? t.call(this, e.camelCase(i)) : t.call(this);
        };
    }(e.fn.removeData)), e.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), 
    e.fn.extend({
        focus: function(t) {
            return function(i, s) {
                return "number" == typeof i ? this.each(function() {
                    var t = this;
                    setTimeout(function() {
                        e(t).focus(), s && s.call(t);
                    }, i);
                }) : t.apply(this, arguments);
            };
        }(e.fn.focus),
        disableSelection: function() {
            var e = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
            return function() {
                return this.bind(e + ".ui-disableSelection", function(e) {
                    e.preventDefault();
                });
            };
        }(),
        enableSelection: function() {
            return this.unbind(".ui-disableSelection");
        },
        zIndex: function(t) {
            if (void 0 !== t) return this.css("zIndex", t);
            if (this.length) for (var i, s, n = e(this[0]); n.length && n[0] !== document; ) {
                if (("absolute" === (i = n.css("position")) || "relative" === i || "fixed" === i) && (s = parseInt(n.css("zIndex"), 10), 
                !isNaN(s) && 0 !== s)) return s;
                n = n.parent();
            }
            return 0;
        }
    }), e.ui.plugin = {
        add: function(t, i, s) {
            var n, a = e.ui[t].prototype;
            for (n in s) a.plugins[n] = a.plugins[n] || [], a.plugins[n].push([ i, s[n] ]);
        },
        call: function(e, t, i, s) {
            var n, a = e.plugins[t];
            if (a && (s || e.element[0].parentNode && 11 !== e.element[0].parentNode.nodeType)) for (n = 0; a.length > n; n++) e.options[a[n][0]] && a[n][1].apply(e.element, i);
        }
    };
    var s = 0, n = Array.prototype.slice;
    e.cleanData = function(t) {
        return function(i) {
            var s, n, a;
            for (a = 0; null != (n = i[a]); a++) try {
                (s = e._data(n, "events")) && s.remove && e(n).triggerHandler("remove");
            } catch (o) {}
            t(i);
        };
    }(e.cleanData), e.widget = function(t, i, s) {
        var n, a, o, r, h = {}, l = t.split(".")[0];
        return t = t.split(".")[1], n = l + "-" + t, s || (s = i, i = e.Widget), e.expr[":"][n.toLowerCase()] = function(t) {
            return !!e.data(t, n);
        }, e[l] = e[l] || {}, a = e[l][t], o = e[l][t] = function(e, t) {
            return this._createWidget ? void (arguments.length && this._createWidget(e, t)) : new o(e, t);
        }, e.extend(o, a, {
            version: s.version,
            _proto: e.extend({}, s),
            _childConstructors: []
        }), r = new i(), r.options = e.widget.extend({}, r.options), e.each(s, function(t, s) {
            return e.isFunction(s) ? void (h[t] = function() {
                var e = function() {
                    return i.prototype[t].apply(this, arguments);
                }, n = function(e) {
                    return i.prototype[t].apply(this, e);
                };
                return function() {
                    var t, i = this._super, a = this._superApply;
                    return this._super = e, this._superApply = n, t = s.apply(this, arguments), this._super = i, 
                    this._superApply = a, t;
                };
            }()) : void (h[t] = s);
        }), o.prototype = e.widget.extend(r, {
            widgetEventPrefix: a ? r.widgetEventPrefix || t : t
        }, h, {
            constructor: o,
            namespace: l,
            widgetName: t,
            widgetFullName: n
        }), a ? (e.each(a._childConstructors, function(t, i) {
            var s = i.prototype;
            e.widget(s.namespace + "." + s.widgetName, o, i._proto);
        }), delete a._childConstructors) : i._childConstructors.push(o), e.widget.bridge(t, o), 
        o;
    }, e.widget.extend = function(t) {
        for (var i, s, a = n.call(arguments, 1), o = 0, r = a.length; r > o; o++) for (i in a[o]) s = a[o][i], 
        a[o].hasOwnProperty(i) && void 0 !== s && (t[i] = e.isPlainObject(s) ? e.isPlainObject(t[i]) ? e.widget.extend({}, t[i], s) : e.widget.extend({}, s) : s);
        return t;
    }, e.widget.bridge = function(t, i) {
        var s = i.prototype.widgetFullName || t;
        e.fn[t] = function(a) {
            var o = "string" == typeof a, r = n.call(arguments, 1), h = this;
            return o ? this.each(function() {
                var i, n = e.data(this, s);
                return "instance" === a ? (h = n, !1) : n ? e.isFunction(n[a]) && "_" !== a.charAt(0) ? (i = n[a].apply(n, r), 
                i !== n && void 0 !== i ? (h = i && i.jquery ? h.pushStack(i.get()) : i, !1) : void 0) : e.error("no such method '" + a + "' for " + t + " widget instance") : e.error("cannot call methods on " + t + " prior to initialization; attempted to call method '" + a + "'");
            }) : (r.length && (a = e.widget.extend.apply(null, [ a ].concat(r))), this.each(function() {
                var t = e.data(this, s);
                t ? (t.option(a || {}), t._init && t._init()) : e.data(this, s, new i(a, this));
            })), h;
        };
    }, e.Widget = function() {}, e.Widget._childConstructors = [], e.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            disabled: !1,
            create: null
        },
        _createWidget: function(t, i) {
            i = e(i || this.defaultElement || this)[0], this.element = e(i), this.uuid = s++, 
            this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = e(), this.hoverable = e(), 
            this.focusable = e(), i !== this && (e.data(i, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function(e) {
                    e.target === i && this.destroy();
                }
            }), this.document = e(i.style ? i.ownerDocument : i.document || i), this.window = e(this.document[0].defaultView || this.document[0].parentWindow)), 
            this.options = e.widget.extend({}, this.options, this._getCreateOptions(), t), this._create(), 
            this._trigger("create", null, this._getCreateEventData()), this._init();
        },
        _getCreateOptions: e.noop,
        _getCreateEventData: e.noop,
        _create: e.noop,
        _init: e.noop,
        destroy: function() {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)), 
            this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), 
            this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), 
            this.focusable.removeClass("ui-state-focus");
        },
        _destroy: e.noop,
        widget: function() {
            return this.element;
        },
        option: function(t, i) {
            var s, n, a, o = t;
            if (0 === arguments.length) return e.widget.extend({}, this.options);
            if ("string" == typeof t) if (o = {}, s = t.split("."), t = s.shift(), s.length) {
                for (n = o[t] = e.widget.extend({}, this.options[t]), a = 0; s.length - 1 > a; a++) n[s[a]] = n[s[a]] || {}, 
                n = n[s[a]];
                if (t = s.pop(), 1 === arguments.length) return void 0 === n[t] ? null : n[t];
                n[t] = i;
            } else {
                if (1 === arguments.length) return void 0 === this.options[t] ? null : this.options[t];
                o[t] = i;
            }
            return this._setOptions(o), this;
        },
        _setOptions: function(e) {
            var t;
            for (t in e) this._setOption(t, e[t]);
            return this;
        },
        _setOption: function(e, t) {
            return this.options[e] = t, "disabled" === e && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!t), 
            t && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), 
            this;
        },
        enable: function() {
            return this._setOptions({
                disabled: !1
            });
        },
        disable: function() {
            return this._setOptions({
                disabled: !0
            });
        },
        _on: function(t, i, s) {
            var n, a = this;
            "boolean" != typeof t && (s = i, i = t, t = !1), s ? (i = n = e(i), this.bindings = this.bindings.add(i)) : (s = i, 
            i = this.element, n = this.widget()), e.each(s, function(s, o) {
                function r() {
                    return t || !0 !== a.options.disabled && !e(this).hasClass("ui-state-disabled") ? ("string" == typeof o ? a[o] : o).apply(a, arguments) : void 0;
                }
                "string" != typeof o && (r.guid = o.guid = o.guid || r.guid || e.guid++);
                var h = s.match(/^([\w:-]*)\s*(.*)$/), l = h[1] + a.eventNamespace, u = h[2];
                u ? n.delegate(u, l, r) : i.bind(l, r);
            });
        },
        _off: function(t, i) {
            i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, 
            t.unbind(i).undelegate(i), this.bindings = e(this.bindings.not(t).get()), this.focusable = e(this.focusable.not(t).get()), 
            this.hoverable = e(this.hoverable.not(t).get());
        },
        _delay: function(e, t) {
            function i() {
                return ("string" == typeof e ? s[e] : e).apply(s, arguments);
            }
            var s = this;
            return setTimeout(i, t || 0);
        },
        _hoverable: function(t) {
            this.hoverable = this.hoverable.add(t), this._on(t, {
                mouseenter: function(t) {
                    e(t.currentTarget).addClass("ui-state-hover");
                },
                mouseleave: function(t) {
                    e(t.currentTarget).removeClass("ui-state-hover");
                }
            });
        },
        _focusable: function(t) {
            this.focusable = this.focusable.add(t), this._on(t, {
                focusin: function(t) {
                    e(t.currentTarget).addClass("ui-state-focus");
                },
                focusout: function(t) {
                    e(t.currentTarget).removeClass("ui-state-focus");
                }
            });
        },
        _trigger: function(t, i, s) {
            var n, a, o = this.options[t];
            if (s = s || {}, i = e.Event(i), i.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), 
            i.target = this.element[0], a = i.originalEvent) for (n in a) n in i || (i[n] = a[n]);
            return this.element.trigger(i, s), !(e.isFunction(o) && !1 === o.apply(this.element[0], [ i ].concat(s)) || i.isDefaultPrevented());
        }
    }, e.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(t, i) {
        e.Widget.prototype["_" + t] = function(s, n, a) {
            "string" == typeof n && (n = {
                effect: n
            });
            var o, r = n ? !0 === n || "number" == typeof n ? i : n.effect || i : t;
            n = n || {}, "number" == typeof n && (n = {
                duration: n
            }), o = !e.isEmptyObject(n), n.complete = a, n.delay && s.delay(n.delay), o && e.effects && e.effects.effect[r] ? s[t](n) : r !== t && s[r] ? s[r](n.duration, n.easing, a) : s.queue(function(i) {
                e(this)[t](), a && a.call(s[0]), i();
            });
        };
    }), e.widget;
    var a = !1;
    e(document).mouseup(function() {
        a = !1;
    }), e.widget("ui.mouse", {
        version: "1.11.4",
        options: {
            cancel: "input,textarea,button,select,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var t = this;
            this.element.bind("mousedown." + this.widgetName, function(e) {
                return t._mouseDown(e);
            }).bind("click." + this.widgetName, function(i) {
                return !0 === e.data(i.target, t.widgetName + ".preventClickEvent") ? (e.removeData(i.target, t.widgetName + ".preventClickEvent"), 
                i.stopImmediatePropagation(), !1) : void 0;
            }), this.started = !1;
        },
        _mouseDestroy: function() {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate);
        },
        _mouseDown: function(t) {
            if (!a) {
                this._mouseMoved = !1, this._mouseStarted && this._mouseUp(t), this._mouseDownEvent = t;
                var i = this, s = 1 === t.which, n = !("string" != typeof this.options.cancel || !t.target.nodeName) && e(t.target).closest(this.options.cancel).length;
                return !(s && !n && this._mouseCapture(t)) || (this.mouseDelayMet = !this.options.delay, 
                this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    i.mouseDelayMet = !0;
                }, this.options.delay)), this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = !1 !== this._mouseStart(t), 
                !this._mouseStarted) ? (t.preventDefault(), !0) : (!0 === e.data(t.target, this.widgetName + ".preventClickEvent") && e.removeData(t.target, this.widgetName + ".preventClickEvent"), 
                this._mouseMoveDelegate = function(e) {
                    return i._mouseMove(e);
                }, this._mouseUpDelegate = function(e) {
                    return i._mouseUp(e);
                }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), 
                t.preventDefault(), a = !0, !0));
            }
        },
        _mouseMove: function(t) {
            if (this._mouseMoved) {
                if (e.ui.ie && (!document.documentMode || 9 > document.documentMode) && !t.button) return this._mouseUp(t);
                if (!t.which) return this._mouseUp(t);
            }
            return (t.which || t.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(t), 
            t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = !1 !== this._mouseStart(this._mouseDownEvent, t), 
            this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted);
        },
        _mouseUp: function(t) {
            return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), 
            this._mouseStarted && (this._mouseStarted = !1, t.target === this._mouseDownEvent.target && e.data(t.target, this.widgetName + ".preventClickEvent", !0), 
            this._mouseStop(t)), a = !1, !1;
        },
        _mouseDistanceMet: function(e) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance;
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet;
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0;
        }
    }), function() {
        function t(e, t, i) {
            return [ parseFloat(e[0]) * (p.test(e[0]) ? t / 100 : 1), parseFloat(e[1]) * (p.test(e[1]) ? i / 100 : 1) ];
        }
        function i(t, i) {
            return parseInt(e.css(t, i), 10) || 0;
        }
        function s(t) {
            var i = t[0];
            return 9 === i.nodeType ? {
                width: t.width(),
                height: t.height(),
                offset: {
                    top: 0,
                    left: 0
                }
            } : e.isWindow(i) ? {
                width: t.width(),
                height: t.height(),
                offset: {
                    top: t.scrollTop(),
                    left: t.scrollLeft()
                }
            } : i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {
                    top: i.pageY,
                    left: i.pageX
                }
            } : {
                width: t.outerWidth(),
                height: t.outerHeight(),
                offset: t.offset()
            };
        }
        e.ui = e.ui || {};
        var n, a, o = Math.max, r = Math.abs, h = Math.round, l = /left|center|right/, u = /top|center|bottom/, d = /[\+\-]\d+(\.[\d]+)?%?/, c = /^\w+/, p = /%$/, f = e.fn.position;
        e.position = {
            scrollbarWidth: function() {
                if (void 0 !== n) return n;
                var t, i, s = e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), a = s.children()[0];
                return e("body").append(s), t = a.offsetWidth, s.css("overflow", "scroll"), i = a.offsetWidth, 
                t === i && (i = s[0].clientWidth), s.remove(), n = t - i;
            },
            getScrollInfo: function(t) {
                var i = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"), s = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"), n = "scroll" === i || "auto" === i && t.width < t.element[0].scrollWidth;
                return {
                    width: "scroll" === s || "auto" === s && t.height < t.element[0].scrollHeight ? e.position.scrollbarWidth() : 0,
                    height: n ? e.position.scrollbarWidth() : 0
                };
            },
            getWithinInfo: function(t) {
                var i = e(t || window), s = e.isWindow(i[0]), n = !!i[0] && 9 === i[0].nodeType;
                return {
                    element: i,
                    isWindow: s,
                    isDocument: n,
                    offset: i.offset() || {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: s || n ? i.width() : i.outerWidth(),
                    height: s || n ? i.height() : i.outerHeight()
                };
            }
        }, e.fn.position = function(n) {
            if (!n || !n.of) return f.apply(this, arguments);
            n = e.extend({}, n);
            var p, m, g, v, y, b, _ = e(n.of), x = e.position.getWithinInfo(n.within), w = e.position.getScrollInfo(x), k = (n.collision || "flip").split(" "), T = {};
            return b = s(_), _[0].preventDefault && (n.at = "left top"), m = b.width, g = b.height, 
            v = b.offset, y = e.extend({}, v), e.each([ "my", "at" ], function() {
                var e, t, i = (n[this] || "").split(" ");
                1 === i.length && (i = l.test(i[0]) ? i.concat([ "center" ]) : u.test(i[0]) ? [ "center" ].concat(i) : [ "center", "center" ]), 
                i[0] = l.test(i[0]) ? i[0] : "center", i[1] = u.test(i[1]) ? i[1] : "center", e = d.exec(i[0]), 
                t = d.exec(i[1]), T[this] = [ e ? e[0] : 0, t ? t[0] : 0 ], n[this] = [ c.exec(i[0])[0], c.exec(i[1])[0] ];
            }), 1 === k.length && (k[1] = k[0]), "right" === n.at[0] ? y.left += m : "center" === n.at[0] && (y.left += m / 2), 
            "bottom" === n.at[1] ? y.top += g : "center" === n.at[1] && (y.top += g / 2), p = t(T.at, m, g), 
            y.left += p[0], y.top += p[1], this.each(function() {
                var s, l, u = e(this), d = u.outerWidth(), c = u.outerHeight(), f = i(this, "marginLeft"), b = i(this, "marginTop"), D = d + f + i(this, "marginRight") + w.width, S = c + b + i(this, "marginBottom") + w.height, N = e.extend({}, y), M = t(T.my, u.outerWidth(), u.outerHeight());
                "right" === n.my[0] ? N.left -= d : "center" === n.my[0] && (N.left -= d / 2), "bottom" === n.my[1] ? N.top -= c : "center" === n.my[1] && (N.top -= c / 2), 
                N.left += M[0], N.top += M[1], a || (N.left = h(N.left), N.top = h(N.top)), s = {
                    marginLeft: f,
                    marginTop: b
                }, e.each([ "left", "top" ], function(t, i) {
                    e.ui.position[k[t]] && e.ui.position[k[t]][i](N, {
                        targetWidth: m,
                        targetHeight: g,
                        elemWidth: d,
                        elemHeight: c,
                        collisionPosition: s,
                        collisionWidth: D,
                        collisionHeight: S,
                        offset: [ p[0] + M[0], p[1] + M[1] ],
                        my: n.my,
                        at: n.at,
                        within: x,
                        elem: u
                    });
                }), n.using && (l = function(e) {
                    var t = v.left - N.left, i = t + m - d, s = v.top - N.top, a = s + g - c, h = {
                        target: {
                            element: _,
                            left: v.left,
                            top: v.top,
                            width: m,
                            height: g
                        },
                        element: {
                            element: u,
                            left: N.left,
                            top: N.top,
                            width: d,
                            height: c
                        },
                        horizontal: 0 > i ? "left" : t > 0 ? "right" : "center",
                        vertical: 0 > a ? "top" : s > 0 ? "bottom" : "middle"
                    };
                    d > m && m > r(t + i) && (h.horizontal = "center"), c > g && g > r(s + a) && (h.vertical = "middle"), 
                    h.important = o(r(t), r(i)) > o(r(s), r(a)) ? "horizontal" : "vertical", n.using.call(this, e, h);
                }), u.offset(e.extend(N, {
                    using: l
                }));
            });
        }, e.ui.position = {
            fit: {
                left: function(e, t) {
                    var i, s = t.within, n = s.isWindow ? s.scrollLeft : s.offset.left, a = s.width, r = e.left - t.collisionPosition.marginLeft, h = n - r, l = r + t.collisionWidth - a - n;
                    t.collisionWidth > a ? h > 0 && 0 >= l ? (i = e.left + h + t.collisionWidth - a - n, 
                    e.left += h - i) : e.left = l > 0 && 0 >= h ? n : h > l ? n + a - t.collisionWidth : n : h > 0 ? e.left += h : l > 0 ? e.left -= l : e.left = o(e.left - r, e.left);
                },
                top: function(e, t) {
                    var i, s = t.within, n = s.isWindow ? s.scrollTop : s.offset.top, a = t.within.height, r = e.top - t.collisionPosition.marginTop, h = n - r, l = r + t.collisionHeight - a - n;
                    t.collisionHeight > a ? h > 0 && 0 >= l ? (i = e.top + h + t.collisionHeight - a - n, 
                    e.top += h - i) : e.top = l > 0 && 0 >= h ? n : h > l ? n + a - t.collisionHeight : n : h > 0 ? e.top += h : l > 0 ? e.top -= l : e.top = o(e.top - r, e.top);
                }
            },
            flip: {
                left: function(e, t) {
                    var i, s, n = t.within, a = n.offset.left + n.scrollLeft, o = n.width, h = n.isWindow ? n.scrollLeft : n.offset.left, l = e.left - t.collisionPosition.marginLeft, u = l - h, d = l + t.collisionWidth - o - h, c = "left" === t.my[0] ? -t.elemWidth : "right" === t.my[0] ? t.elemWidth : 0, p = "left" === t.at[0] ? t.targetWidth : "right" === t.at[0] ? -t.targetWidth : 0, f = -2 * t.offset[0];
                    0 > u ? (0 > (i = e.left + c + p + f + t.collisionWidth - o - a) || r(u) > i) && (e.left += c + p + f) : d > 0 && ((s = e.left - t.collisionPosition.marginLeft + c + p + f - h) > 0 || d > r(s)) && (e.left += c + p + f);
                },
                top: function(e, t) {
                    var i, s, n = t.within, a = n.offset.top + n.scrollTop, o = n.height, h = n.isWindow ? n.scrollTop : n.offset.top, l = e.top - t.collisionPosition.marginTop, u = l - h, d = l + t.collisionHeight - o - h, c = "top" === t.my[1], p = c ? -t.elemHeight : "bottom" === t.my[1] ? t.elemHeight : 0, f = "top" === t.at[1] ? t.targetHeight : "bottom" === t.at[1] ? -t.targetHeight : 0, m = -2 * t.offset[1];
                    0 > u ? (0 > (s = e.top + p + f + m + t.collisionHeight - o - a) || r(u) > s) && (e.top += p + f + m) : d > 0 && ((i = e.top - t.collisionPosition.marginTop + p + f + m - h) > 0 || d > r(i)) && (e.top += p + f + m);
                }
            },
            flipfit: {
                left: function() {
                    e.ui.position.flip.left.apply(this, arguments), e.ui.position.fit.left.apply(this, arguments);
                },
                top: function() {
                    e.ui.position.flip.top.apply(this, arguments), e.ui.position.fit.top.apply(this, arguments);
                }
            }
        }, function() {
            var t, i, s, n, o, r = document.getElementsByTagName("body")[0], h = document.createElement("div");
            t = document.createElement(r ? "div" : "body"), s = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            }, r && e.extend(s, {
                position: "absolute",
                left: "-1000px",
                top: "-1000px"
            });
            for (o in s) t.style[o] = s[o];
            t.appendChild(h), i = r || document.documentElement, i.insertBefore(t, i.firstChild), 
            h.style.cssText = "position: absolute; left: 10.7432222px;", n = e(h).offset().left, 
            a = n > 10 && 11 > n, t.innerHTML = "", i.removeChild(t);
        }();
    }(), e.ui.position, e.widget("ui.tooltip", {
        version: "1.11.4",
        options: {
            content: function() {
                var t = e(this).attr("title") || "";
                return e("<a>").text(t).html();
            },
            hide: !0,
            items: "[title]:not([disabled])",
            position: {
                my: "left top+15",
                at: "left bottom",
                collision: "flipfit flip"
            },
            show: !0,
            tooltipClass: null,
            track: !1,
            close: null,
            open: null
        },
        _addDescribedBy: function(t, i) {
            var s = (t.attr("aria-describedby") || "").split(/\s+/);
            s.push(i), t.data("ui-tooltip-id", i).attr("aria-describedby", e.trim(s.join(" ")));
        },
        _removeDescribedBy: function(t) {
            var i = t.data("ui-tooltip-id"), s = (t.attr("aria-describedby") || "").split(/\s+/), n = e.inArray(i, s);
            -1 !== n && s.splice(n, 1), t.removeData("ui-tooltip-id"), s = e.trim(s.join(" ")), 
            s ? t.attr("aria-describedby", s) : t.removeAttr("aria-describedby");
        },
        _create: function() {
            this._on({
                mouseover: "open",
                focusin: "open"
            }), this.tooltips = {}, this.parents = {}, this.options.disabled && this._disable(), 
            this.liveRegion = e("<div>").attr({
                role: "log",
                "aria-live": "assertive",
                "aria-relevant": "additions"
            }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body);
        },
        _setOption: function(t, i) {
            var s = this;
            return "disabled" === t ? (this[i ? "_disable" : "_enable"](), void (this.options[t] = i)) : (this._super(t, i), 
            void ("content" === t && e.each(this.tooltips, function(e, t) {
                s._updateContent(t.element);
            })));
        },
        _disable: function() {
            var t = this;
            e.each(this.tooltips, function(i, s) {
                var n = e.Event("blur");
                n.target = n.currentTarget = s.element[0], t.close(n, !0);
            }), this.element.find(this.options.items).addBack().each(function() {
                var t = e(this);
                t.is("[title]") && t.data("ui-tooltip-title", t.attr("title")).removeAttr("title");
            });
        },
        _enable: function() {
            this.element.find(this.options.items).addBack().each(function() {
                var t = e(this);
                t.data("ui-tooltip-title") && t.attr("title", t.data("ui-tooltip-title"));
            });
        },
        open: function(t) {
            var i = this, s = e(t ? t.target : this.element).closest(this.options.items);
            s.length && !s.data("ui-tooltip-id") && (s.attr("title") && s.data("ui-tooltip-title", s.attr("title")), 
            s.data("ui-tooltip-open", !0), t && "mouseover" === t.type && s.parents().each(function() {
                var t, s = e(this);
                s.data("ui-tooltip-open") && (t = e.Event("blur"), t.target = t.currentTarget = this, 
                i.close(t, !0)), s.attr("title") && (s.uniqueId(), i.parents[this.id] = {
                    element: this,
                    title: s.attr("title")
                }, s.attr("title", ""));
            }), this._registerCloseHandlers(t, s), this._updateContent(s, t));
        },
        _updateContent: function(e, t) {
            var i, s = this.options.content, n = this, a = t ? t.type : null;
            return "string" == typeof s ? this._open(t, e, s) : void ((i = s.call(e[0], function(i) {
                n._delay(function() {
                    e.data("ui-tooltip-open") && (t && (t.type = a), this._open(t, e, i));
                });
            })) && this._open(t, e, i));
        },
        _open: function(t, i, s) {
            function n(e) {
                l.of = e, o.is(":hidden") || o.position(l);
            }
            var a, o, r, h, l = e.extend({}, this.options.position);
            if (s) {
                if (a = this._find(i)) return void a.tooltip.find(".ui-tooltip-content").html(s);
                i.is("[title]") && (t && "mouseover" === t.type ? i.attr("title", "") : i.removeAttr("title")), 
                a = this._tooltip(i), o = a.tooltip, this._addDescribedBy(i, o.attr("id")), o.find(".ui-tooltip-content").html(s), 
                this.liveRegion.children().hide(), s.clone ? (h = s.clone(), h.removeAttr("id").find("[id]").removeAttr("id")) : h = s, 
                e("<div>").html(h).appendTo(this.liveRegion), this.options.track && t && /^mouse/.test(t.type) ? (this._on(this.document, {
                    mousemove: n
                }), n(t)) : o.position(e.extend({
                    of: i
                }, this.options.position)), o.hide(), this._show(o, this.options.show), this.options.show && this.options.show.delay && (r = this.delayedShow = setInterval(function() {
                    o.is(":visible") && (n(l.of), clearInterval(r));
                }, e.fx.interval)), this._trigger("open", t, {
                    tooltip: o
                });
            }
        },
        _registerCloseHandlers: function(t, i) {
            var s = {
                keyup: function(t) {
                    if (t.keyCode === e.ui.keyCode.ESCAPE) {
                        var s = e.Event(t);
                        s.currentTarget = i[0], this.close(s, !0);
                    }
                }
            };
            i[0] !== this.element[0] && (s.remove = function() {
                this._removeTooltip(this._find(i).tooltip);
            }), t && "mouseover" !== t.type || (s.mouseleave = "close"), t && "focusin" !== t.type || (s.focusout = "close"), 
            this._on(!0, i, s);
        },
        close: function(t) {
            var i, s = this, n = e(t ? t.currentTarget : this.element), a = this._find(n);
            return a ? (i = a.tooltip, void (a.closing || (clearInterval(this.delayedShow), 
            n.data("ui-tooltip-title") && !n.attr("title") && n.attr("title", n.data("ui-tooltip-title")), 
            this._removeDescribedBy(n), a.hiding = !0, i.stop(!0), this._hide(i, this.options.hide, function() {
                s._removeTooltip(e(this));
            }), n.removeData("ui-tooltip-open"), this._off(n, "mouseleave focusout keyup"), 
            n[0] !== this.element[0] && this._off(n, "remove"), this._off(this.document, "mousemove"), 
            t && "mouseleave" === t.type && e.each(this.parents, function(t, i) {
                e(i.element).attr("title", i.title), delete s.parents[t];
            }), a.closing = !0, this._trigger("close", t, {
                tooltip: i
            }), a.hiding || (a.closing = !1)))) : void n.removeData("ui-tooltip-open");
        },
        _tooltip: function(t) {
            var i = e("<div>").attr("role", "tooltip").addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || "")), s = i.uniqueId().attr("id");
            return e("<div>").addClass("ui-tooltip-content").appendTo(i), i.appendTo(this.document[0].body), 
            this.tooltips[s] = {
                element: t,
                tooltip: i
            };
        },
        _find: function(e) {
            var t = e.data("ui-tooltip-id");
            return t ? this.tooltips[t] : null;
        },
        _removeTooltip: function(e) {
            e.remove(), delete this.tooltips[e.attr("id")];
        },
        _destroy: function() {
            var t = this;
            e.each(this.tooltips, function(i, s) {
                var n = e.Event("blur"), a = s.element;
                n.target = n.currentTarget = a[0], t.close(n, !0), e("#" + i).remove(), a.data("ui-tooltip-title") && (a.attr("title") || a.attr("title", a.data("ui-tooltip-title")), 
                a.removeData("ui-tooltip-title"));
            }), this.liveRegion.remove();
        }
    });
}), function(factory) {
    "function" == typeof define && define.amd ? define("picker", [ "jquery" ], factory) : "object" == typeof exports ? module.exports = factory(require("jquery")) : this.Picker = factory(jQuery);
}(function($) {
    function PickerConstructor(ELEMENT, NAME, COMPONENT, OPTIONS) {
        function createWrappedComponent() {
            return PickerConstructor._.node("div", PickerConstructor._.node("div", PickerConstructor._.node("div", PickerConstructor._.node("div", P.component.nodes(STATE.open), CLASSES.box), CLASSES.wrap), CLASSES.frame), CLASSES.holder, 'tabindex="-1"');
        }
        function prepareElement() {
            $ELEMENT.data(NAME, P).addClass(CLASSES.input).val($ELEMENT.data("value") ? P.get("select", SETTINGS.format) : ELEMENT.value), 
            SETTINGS.editable || $ELEMENT.on("focus." + STATE.id + " click." + STATE.id, function(event) {
                event.preventDefault(), P.open();
            }).on("keydown." + STATE.id, handleKeydownEvent), aria(ELEMENT, {
                haspopup: !0,
                expanded: !1,
                readonly: !1,
                owns: ELEMENT.id + "_root"
            });
        }
        function prepareElementRoot() {
            aria(P.$root[0], "hidden", !0);
        }
        function prepareElementHolder() {
            P.$holder.on({
                keydown: handleKeydownEvent,
                "focus.toOpen": handleFocusToOpenEvent,
                blur: function() {
                    $ELEMENT.removeClass(CLASSES.target);
                },
                focusin: function(event) {
                    P.$root.removeClass(CLASSES.focused), event.stopPropagation();
                },
                "mousedown click": function(event) {
                    var target = event.target;
                    target != P.$holder[0] && (event.stopPropagation(), "mousedown" != event.type || $(target).is("input, select, textarea, button, option") || (event.preventDefault(), 
                    P.$holder[0].focus()));
                }
            }).on("click", "[data-pick], [data-nav], [data-clear], [data-close]", function() {
                var $target = $(this), targetData = $target.data(), targetDisabled = $target.hasClass(CLASSES.navDisabled) || $target.hasClass(CLASSES.disabled), activeElement = getActiveElement();
                activeElement = activeElement && (activeElement.type || activeElement.href), (targetDisabled || activeElement && !$.contains(P.$root[0], activeElement)) && P.$holder[0].focus(), 
                !targetDisabled && targetData.nav ? P.set("highlight", P.component.item.highlight, {
                    nav: targetData.nav
                }) : !targetDisabled && "pick" in targetData ? (P.set("select", targetData.pick), 
                SETTINGS.closeOnSelect && P.close(!0)) : targetData.clear ? (P.clear(), SETTINGS.closeOnClear && P.close(!0)) : targetData.close && P.close(!0);
            });
        }
        function prepareElementHidden() {
            var name;
            !0 === SETTINGS.hiddenName ? (name = ELEMENT.name, ELEMENT.name = "") : (name = [ "string" == typeof SETTINGS.hiddenPrefix ? SETTINGS.hiddenPrefix : "", "string" == typeof SETTINGS.hiddenSuffix ? SETTINGS.hiddenSuffix : "_submit" ], 
            name = name[0] + ELEMENT.name + name[1]), P._hidden = $('<input type=hidden name="' + name + '"' + ($ELEMENT.data("value") || ELEMENT.value ? ' value="' + P.get("select", SETTINGS.formatSubmit) + '"' : "") + ">")[0], 
            $ELEMENT.on("change." + STATE.id, function() {
                P._hidden.value = ELEMENT.value ? P.get("select", SETTINGS.formatSubmit) : "";
            });
        }
        function focusPickerOnceOpened() {
            IS_DEFAULT_THEME && supportsTransitions ? P.$holder.find("." + CLASSES.frame).one("transitionend", function() {
                P.$holder[0].focus();
            }) : P.$holder[0].focus();
        }
        function handleFocusToOpenEvent(event) {
            event.stopPropagation(), $ELEMENT.addClass(CLASSES.target), P.$root.addClass(CLASSES.focused), 
            P.open();
        }
        function handleKeydownEvent(event) {
            var keycode = event.keyCode, isKeycodeDelete = /^(8|46)$/.test(keycode);
            if (27 == keycode) return P.close(!0), !1;
            (32 == keycode || isKeycodeDelete || !STATE.open && P.component.key[keycode]) && (event.preventDefault(), 
            event.stopPropagation(), isKeycodeDelete ? P.clear().close() : P.open());
        }
        if (!ELEMENT) return PickerConstructor;
        var IS_DEFAULT_THEME = !1, STATE = {
            id: ELEMENT.id || "P" + Math.abs(~~(Math.random() * new Date()))
        }, SETTINGS = COMPONENT ? $.extend(!0, {}, COMPONENT.defaults, OPTIONS) : OPTIONS || {}, CLASSES = $.extend({}, PickerConstructor.klasses(), SETTINGS.klass), $ELEMENT = $(ELEMENT), PickerInstance = function() {
            return this.start();
        }, P = PickerInstance.prototype = {
            constructor: PickerInstance,
            $node: $ELEMENT,
            start: function() {
                return STATE && STATE.start ? P : (STATE.methods = {}, STATE.start = !0, STATE.open = !1, 
                STATE.type = ELEMENT.type, ELEMENT.autofocus = ELEMENT == getActiveElement(), ELEMENT.readOnly = !SETTINGS.editable, 
                ELEMENT.id = ELEMENT.id || STATE.id, "text" != ELEMENT.type && (ELEMENT.type = "text"), 
                P.component = new COMPONENT(P, SETTINGS), P.$root = $('<div class="' + CLASSES.picker + '" id="' + ELEMENT.id + '_root" />'), 
                prepareElementRoot(), P.$holder = $(createWrappedComponent()).appendTo(P.$root), 
                prepareElementHolder(), SETTINGS.formatSubmit && prepareElementHidden(), prepareElement(), 
                SETTINGS.containerHidden ? $(SETTINGS.containerHidden).append(P._hidden) : $ELEMENT.after(P._hidden), 
                SETTINGS.container ? $(SETTINGS.container).append(P.$root) : $ELEMENT.after(P.$root), 
                P.on({
                    start: P.component.onStart,
                    render: P.component.onRender,
                    stop: P.component.onStop,
                    open: P.component.onOpen,
                    close: P.component.onClose,
                    set: P.component.onSet
                }).on({
                    start: SETTINGS.onStart,
                    render: SETTINGS.onRender,
                    stop: SETTINGS.onStop,
                    open: SETTINGS.onOpen,
                    close: SETTINGS.onClose,
                    set: SETTINGS.onSet
                }), IS_DEFAULT_THEME = isUsingDefaultTheme(P.$holder[0]), ELEMENT.autofocus && P.open(), 
                P.trigger("start").trigger("render"));
            },
            render: function(entireComponent) {
                return entireComponent ? (P.$holder = $(createWrappedComponent()), prepareElementHolder(), 
                P.$root.html(P.$holder)) : P.$root.find("." + CLASSES.box).html(P.component.nodes(STATE.open)), 
                P.trigger("render");
            },
            stop: function() {
                return STATE.start ? (P.close(), P._hidden && P._hidden.parentNode.removeChild(P._hidden), 
                P.$root.remove(), $ELEMENT.removeClass(CLASSES.input).removeData(NAME), setTimeout(function() {
                    $ELEMENT.off("." + STATE.id);
                }, 0), ELEMENT.type = STATE.type, ELEMENT.readOnly = !1, P.trigger("stop"), STATE.methods = {}, 
                STATE.start = !1, P) : P;
            },
            open: function(dontGiveFocus) {
                return STATE.open ? P : ($ELEMENT.addClass(CLASSES.active), aria(ELEMENT, "expanded", !0), 
                setTimeout(function() {
                    P.$root.addClass(CLASSES.opened), aria(P.$root[0], "hidden", !1);
                }, 0), !1 !== dontGiveFocus && (STATE.open = !0, IS_DEFAULT_THEME && $html.css("overflow", "hidden").css("padding-right", "+=" + getScrollbarWidth()), 
                focusPickerOnceOpened(), $document.on("click." + STATE.id + " focusin." + STATE.id, function(event) {
                    var target = event.target;
                    target != ELEMENT && target != document && 3 != event.which && P.close(target === P.$holder[0]);
                }).on("keydown." + STATE.id, function(event) {
                    var keycode = event.keyCode, keycodeToMove = P.component.key[keycode], target = event.target;
                    27 == keycode ? P.close(!0) : target != P.$holder[0] || !keycodeToMove && 13 != keycode ? $.contains(P.$root[0], target) && 13 == keycode && (event.preventDefault(), 
                    target.click()) : (event.preventDefault(), keycodeToMove ? PickerConstructor._.trigger(P.component.key.go, P, [ PickerConstructor._.trigger(keycodeToMove) ]) : P.$root.find("." + CLASSES.highlighted).hasClass(CLASSES.disabled) || (P.set("select", P.component.item.highlight), 
                    SETTINGS.closeOnSelect && P.close(!0)));
                })), P.trigger("open"));
            },
            close: function(giveFocus) {
                return giveFocus && (SETTINGS.editable ? ELEMENT.focus() : (P.$holder.off("focus.toOpen").focus(), 
                setTimeout(function() {
                    P.$holder.on("focus.toOpen", handleFocusToOpenEvent);
                }, 0))), $ELEMENT.removeClass(CLASSES.active), aria(ELEMENT, "expanded", !1), setTimeout(function() {
                    P.$root.removeClass(CLASSES.opened + " " + CLASSES.focused), aria(P.$root[0], "hidden", !0);
                }, 0), STATE.open ? (STATE.open = !1, IS_DEFAULT_THEME && $html.css("overflow", "").css("padding-right", "-=" + getScrollbarWidth()), 
                $document.off("." + STATE.id), P.trigger("close")) : P;
            },
            clear: function(options) {
                return P.set("clear", null, options);
            },
            set: function(thing, value, options) {
                var thingItem, thingValue, thingIsObject = $.isPlainObject(thing), thingObject = thingIsObject ? thing : {};
                if (options = thingIsObject && $.isPlainObject(value) ? value : options || {}, thing) {
                    thingIsObject || (thingObject[thing] = value);
                    for (thingItem in thingObject) thingValue = thingObject[thingItem], thingItem in P.component.item && (void 0 === thingValue && (thingValue = null), 
                    P.component.set(thingItem, thingValue, options)), "select" != thingItem && "clear" != thingItem || $ELEMENT.val("clear" == thingItem ? "" : P.get(thingItem, SETTINGS.format)).trigger("change");
                    P.render();
                }
                return options.muted ? P : P.trigger("set", thingObject);
            },
            get: function(thing, format) {
                if (thing = thing || "value", null != STATE[thing]) return STATE[thing];
                if ("valueSubmit" == thing) {
                    if (P._hidden) return P._hidden.value;
                    thing = "value";
                }
                if ("value" == thing) return ELEMENT.value;
                if (thing in P.component.item) {
                    if ("string" == typeof format) {
                        var thingValue = P.component.get(thing);
                        return thingValue ? PickerConstructor._.trigger(P.component.formats.toString, P.component, [ format, thingValue ]) : "";
                    }
                    return P.component.get(thing);
                }
            },
            on: function(thing, method, internal) {
                var thingName, thingMethod, thingIsObject = $.isPlainObject(thing), thingObject = thingIsObject ? thing : {};
                if (thing) {
                    thingIsObject || (thingObject[thing] = method);
                    for (thingName in thingObject) thingMethod = thingObject[thingName], internal && (thingName = "_" + thingName), 
                    STATE.methods[thingName] = STATE.methods[thingName] || [], STATE.methods[thingName].push(thingMethod);
                }
                return P;
            },
            off: function() {
                var i, thingName, names = arguments;
                for (i = 0, namesCount = names.length; i < namesCount; i += 1) (thingName = names[i]) in STATE.methods && delete STATE.methods[thingName];
                return P;
            },
            trigger: function(name, data) {
                var _trigger = function(name) {
                    var methodList = STATE.methods[name];
                    methodList && methodList.map(function(method) {
                        PickerConstructor._.trigger(method, P, [ data ]);
                    });
                };
                return _trigger("_" + name), _trigger(name), P;
            }
        };
        return new PickerInstance();
    }
    function isUsingDefaultTheme(element) {
        var theme;
        return element.currentStyle ? theme = element.currentStyle.position : window.getComputedStyle && (theme = getComputedStyle(element).position), 
        "fixed" == theme;
    }
    function getScrollbarWidth() {
        if ($html.height() <= $window.height()) return 0;
        var $outer = $('<div style="visibility:hidden;width:100px" />').appendTo("body"), widthWithoutScroll = $outer[0].offsetWidth;
        $outer.css("overflow", "scroll");
        var $inner = $('<div style="width:100%" />').appendTo($outer), widthWithScroll = $inner[0].offsetWidth;
        return $outer.remove(), widthWithoutScroll - widthWithScroll;
    }
    function aria(element, attribute, value) {
        if ($.isPlainObject(attribute)) for (var key in attribute) ariaSet(element, key, attribute[key]); else ariaSet(element, attribute, value);
    }
    function ariaSet(element, attribute, value) {
        element.setAttribute(("role" == attribute ? "" : "aria-") + attribute, value);
    }
    function ariaAttr(attribute, data) {
        $.isPlainObject(attribute) || (attribute = {
            attribute: data
        }), data = "";
        for (var key in attribute) {
            var attr = ("role" == key ? "" : "aria-") + key;
            data += null == attribute[key] ? "" : attr + '="' + attribute[key] + '"';
        }
        return data;
    }
    function getActiveElement() {
        try {
            return document.activeElement;
        } catch (err) {}
    }
    var $window = $(window), $document = $(document), $html = $(document.documentElement), supportsTransitions = null != document.documentElement.style.transition;
    return PickerConstructor.klasses = function(prefix) {
        return prefix = prefix || "picker", {
            picker: prefix,
            opened: prefix + "--opened",
            focused: prefix + "--focused",
            input: prefix + "__input",
            active: prefix + "__input--active",
            target: prefix + "__input--target",
            holder: prefix + "__holder",
            frame: prefix + "__frame",
            wrap: prefix + "__wrap",
            box: prefix + "__box"
        };
    }, PickerConstructor._ = {
        group: function(groupObject) {
            for (var loopObjectScope, nodesList = "", counter = PickerConstructor._.trigger(groupObject.min, groupObject); counter <= PickerConstructor._.trigger(groupObject.max, groupObject, [ counter ]); counter += groupObject.i) loopObjectScope = PickerConstructor._.trigger(groupObject.item, groupObject, [ counter ]), 
            nodesList += PickerConstructor._.node(groupObject.node, loopObjectScope[0], loopObjectScope[1], loopObjectScope[2]);
            return nodesList;
        },
        node: function(wrapper, item, klass, attribute) {
            return item ? (item = $.isArray(item) ? item.join("") : item, klass = klass ? ' class="' + klass + '"' : "", 
            attribute = attribute ? " " + attribute : "", "<" + wrapper + klass + attribute + ">" + item + "</" + wrapper + ">") : "";
        },
        lead: function(number) {
            return (number < 10 ? "0" : "") + number;
        },
        trigger: function(callback, scope, args) {
            return "function" == typeof callback ? callback.apply(scope, args || []) : callback;
        },
        digits: function(string) {
            return /\d/.test(string[1]) ? 2 : 1;
        },
        isDate: function(value) {
            return {}.toString.call(value).indexOf("Date") > -1 && this.isInteger(value.getDate());
        },
        isInteger: function(value) {
            return {}.toString.call(value).indexOf("Number") > -1 && value % 1 == 0;
        },
        ariaAttr: ariaAttr
    }, PickerConstructor.extend = function(name, Component) {
        $.fn[name] = function(options, action) {
            var componentData = this.data(name);
            return "picker" == options ? componentData : componentData && "string" == typeof options ? PickerConstructor._.trigger(componentData[options], componentData, [ action ]) : this.each(function() {
                $(this).data(name) || new PickerConstructor(this, name, Component, options);
            });
        }, $.fn[name].defaults = Component.defaults;
    }, PickerConstructor;
}), function() {
    var $, AbstractChosen, Chosen, SelectParser, _ref, __hasProp = {}.hasOwnProperty, __extends = function(child, parent) {
        function ctor() {
            this.constructor = child;
        }
        for (var key in parent) __hasProp.call(parent, key) && (child[key] = parent[key]);
        return ctor.prototype = parent.prototype, child.prototype = new ctor(), child.__super__ = parent.prototype, 
        child;
    };
    SelectParser = function() {
        function SelectParser() {
            this.options_index = 0, this.parsed = [];
        }
        return SelectParser.prototype.add_node = function(child) {
            return "OPTGROUP" === child.nodeName.toUpperCase() ? this.add_group(child) : this.add_option(child);
        }, SelectParser.prototype.add_group = function(group) {
            var group_position, option, _i, _len, _ref, _results;
            for (group_position = this.parsed.length, this.parsed.push({
                array_index: group_position,
                group: !0,
                label: this.escapeExpression(group.label),
                title: group.title ? group.title : void 0,
                children: 0,
                disabled: group.disabled,
                classes: group.className
            }), _ref = group.childNodes, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) option = _ref[_i], 
            _results.push(this.add_option(option, group_position, group.disabled));
            return _results;
        }, SelectParser.prototype.add_option = function(option, group_position, group_disabled) {
            if ("OPTION" === option.nodeName.toUpperCase()) return "" !== option.text ? (null != group_position && (this.parsed[group_position].children += 1), 
            this.parsed.push({
                array_index: this.parsed.length,
                options_index: this.options_index,
                value: option.value,
                text: option.text,
                html: option.innerHTML,
                title: option.title ? option.title : void 0,
                selected: option.selected,
                disabled: !0 === group_disabled ? group_disabled : option.disabled,
                group_array_index: group_position,
                group_label: null != group_position ? this.parsed[group_position].label : null,
                classes: option.className,
                style: option.style.cssText
            })) : this.parsed.push({
                array_index: this.parsed.length,
                options_index: this.options_index,
                empty: !0
            }), this.options_index += 1;
        }, SelectParser.prototype.escapeExpression = function(text) {
            var map, unsafe_chars;
            return null == text || !1 === text ? "" : /[\&\<\>\"\'\`]/.test(text) ? (map = {
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;"
            }, unsafe_chars = /&(?!\w+;)|[\<\>\"\'\`]/g, text.replace(unsafe_chars, function(chr) {
                return map[chr] || "&amp;";
            })) : text;
        }, SelectParser;
    }(), SelectParser.select_to_array = function(select) {
        var child, parser, _i, _len, _ref;
        for (parser = new SelectParser(), _ref = select.childNodes, _i = 0, _len = _ref.length; _i < _len; _i++) child = _ref[_i], 
        parser.add_node(child);
        return parser.parsed;
    }, AbstractChosen = function() {
        function AbstractChosen(form_field, options) {
            this.form_field = form_field, this.options = null != options ? options : {}, AbstractChosen.browser_is_supported() && (this.is_multiple = this.form_field.multiple, 
            this.set_default_text(), this.set_default_values(), this.setup(), this.set_up_html(), 
            this.register_observers(), this.on_ready());
        }
        return AbstractChosen.prototype.set_default_values = function() {
            var _this = this;
            return this.click_test_action = function(evt) {
                return _this.test_active_click(evt);
            }, this.activate_action = function(evt) {
                return _this.activate_field(evt);
            }, this.active_field = !1, this.mouse_on_container = !1, this.results_showing = !1, 
            this.result_highlighted = null, this.allow_single_deselect = null != this.options.allow_single_deselect && null != this.form_field.options[0] && "" === this.form_field.options[0].text && this.options.allow_single_deselect, 
            this.disable_search_threshold = this.options.disable_search_threshold || 0, this.disable_search = this.options.disable_search || !1, 
            this.enable_split_word_search = null == this.options.enable_split_word_search || this.options.enable_split_word_search, 
            this.group_search = null == this.options.group_search || this.options.group_search, 
            this.search_contains = this.options.search_contains || !1, this.single_backstroke_delete = null == this.options.single_backstroke_delete || this.options.single_backstroke_delete, 
            this.max_selected_options = this.options.max_selected_options || 1 / 0, this.inherit_select_classes = this.options.inherit_select_classes || !1, 
            this.display_selected_options = null == this.options.display_selected_options || this.options.display_selected_options, 
            this.display_disabled_options = null == this.options.display_disabled_options || this.options.display_disabled_options, 
            this.include_group_label_in_selected = this.options.include_group_label_in_selected || !1;
        }, AbstractChosen.prototype.set_default_text = function() {
            return this.form_field.getAttribute("data-placeholder") ? this.default_text = this.form_field.getAttribute("data-placeholder") : this.is_multiple ? this.default_text = this.options.placeholder_text_multiple || this.options.placeholder_text || AbstractChosen.default_multiple_text : this.default_text = this.options.placeholder_text_single || this.options.placeholder_text || AbstractChosen.default_single_text, 
            this.results_none_found = this.form_field.getAttribute("data-no_results_text") || this.options.no_results_text || AbstractChosen.default_no_result_text;
        }, AbstractChosen.prototype.choice_label = function(item) {
            return this.include_group_label_in_selected && null != item.group_label ? "<b class='group-name'>" + item.group_label + "</b>" + item.html : item.html;
        }, AbstractChosen.prototype.mouse_enter = function() {
            return this.mouse_on_container = !0;
        }, AbstractChosen.prototype.mouse_leave = function() {
            return this.mouse_on_container = !1;
        }, AbstractChosen.prototype.input_focus = function(evt) {
            var _this = this;
            if (this.is_multiple) {
                if (!this.active_field) return setTimeout(function() {
                    return _this.container_mousedown();
                }, 50);
            } else if (!this.active_field) return this.activate_field();
        }, AbstractChosen.prototype.input_blur = function(evt) {
            var _this = this;
            if (!this.mouse_on_container) return this.active_field = !1, setTimeout(function() {
                return _this.blur_test();
            }, 100);
        }, AbstractChosen.prototype.results_option_build = function(options) {
            var content, data, _i, _len, _ref;
            for (content = "", _ref = this.results_data, _i = 0, _len = _ref.length; _i < _len; _i++) data = _ref[_i], 
            data.group ? content += this.result_add_group(data) : content += this.result_add_option(data), 
            (null != options ? options.first : void 0) && (data.selected && this.is_multiple ? this.choice_build(data) : data.selected && !this.is_multiple && this.single_set_selected_text(this.choice_label(data)));
            return content;
        }, AbstractChosen.prototype.result_add_option = function(option) {
            var classes, option_el;
            return option.search_match && this.include_option_in_results(option) ? (classes = [], 
            option.disabled || option.selected && this.is_multiple || classes.push("active-result"), 
            !option.disabled || option.selected && this.is_multiple || classes.push("disabled-result"), 
            option.selected && classes.push("result-selected"), null != option.group_array_index && classes.push("group-option"), 
            "" !== option.classes && classes.push(option.classes), option_el = document.createElement("li"), 
            option_el.className = classes.join(" "), option_el.style.cssText = option.style, 
            option_el.setAttribute("data-option-array-index", option.array_index), option_el.innerHTML = option.search_text, 
            option.title && (option_el.title = option.title), this.outerHTML(option_el)) : "";
        }, AbstractChosen.prototype.result_add_group = function(group) {
            var classes, group_el;
            return (group.search_match || group.group_match) && group.active_options > 0 ? (classes = [], 
            classes.push("group-result"), group.classes && classes.push(group.classes), group_el = document.createElement("li"), 
            group_el.className = classes.join(" "), group_el.innerHTML = group.search_text, 
            group.title && (group_el.title = group.title), this.outerHTML(group_el)) : "";
        }, AbstractChosen.prototype.results_update_field = function() {
            if (this.set_default_text(), this.is_multiple || this.results_reset_cleanup(), this.result_clear_highlight(), 
            this.results_build(), this.results_showing) return this.winnow_results();
        }, AbstractChosen.prototype.reset_single_select_options = function() {
            var result, _i, _len, _ref, _results;
            for (_ref = this.results_data, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) result = _ref[_i], 
            result.selected ? _results.push(result.selected = !1) : _results.push(void 0);
            return _results;
        }, AbstractChosen.prototype.results_toggle = function() {
            return this.results_showing ? this.results_hide() : this.results_show();
        }, AbstractChosen.prototype.results_search = function(evt) {
            return this.results_showing ? this.winnow_results() : this.results_show();
        }, AbstractChosen.prototype.winnow_results = function() {
            var escapedSearchText, option, regex, results, results_group, searchText, startpos, text, zregex, _i, _len, _ref;
            for (this.no_results_clear(), results = 0, searchText = this.get_search_text(), 
            escapedSearchText = searchText.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&"), zregex = new RegExp(escapedSearchText, "i"), 
            regex = this.get_search_regex(escapedSearchText), _ref = this.results_data, _i = 0, 
            _len = _ref.length; _i < _len; _i++) option = _ref[_i], option.search_match = !1, 
            results_group = null, this.include_option_in_results(option) && (option.group && (option.group_match = !1, 
            option.active_options = 0), null != option.group_array_index && this.results_data[option.group_array_index] && (results_group = this.results_data[option.group_array_index], 
            0 === results_group.active_options && results_group.search_match && (results += 1), 
            results_group.active_options += 1), option.search_text = option.group ? option.label : option.html, 
            option.group && !this.group_search || (option.search_match = this.search_string_match(option.search_text, regex), 
            option.search_match && !option.group && (results += 1), option.search_match ? (searchText.length && (startpos = option.search_text.search(zregex), 
            text = option.search_text.substr(0, startpos + searchText.length) + "</em>" + option.search_text.substr(startpos + searchText.length), 
            option.search_text = text.substr(0, startpos) + "<em>" + text.substr(startpos)), 
            null != results_group && (results_group.group_match = !0)) : null != option.group_array_index && this.results_data[option.group_array_index].search_match && (option.search_match = !0)));
            return this.result_clear_highlight(), results < 1 && searchText.length ? (this.update_results_content(""), 
            this.no_results(searchText)) : (this.update_results_content(this.results_option_build()), 
            this.winnow_results_set_highlight());
        }, AbstractChosen.prototype.get_search_regex = function(escaped_search_string) {
            var regex_anchor;
            return regex_anchor = this.search_contains ? "" : "^", new RegExp(regex_anchor + escaped_search_string, "i");
        }, AbstractChosen.prototype.search_string_match = function(search_string, regex) {
            var part, parts, _i, _len;
            if (regex.test(search_string)) return !0;
            if (this.enable_split_word_search && (search_string.indexOf(" ") >= 0 || 0 === search_string.indexOf("[")) && (parts = search_string.replace(/\[|\]/g, "").split(" "), 
            parts.length)) for (_i = 0, _len = parts.length; _i < _len; _i++) if (part = parts[_i], 
            regex.test(part)) return !0;
        }, AbstractChosen.prototype.choices_count = function() {
            var option, _i, _len, _ref;
            if (null != this.selected_option_count) return this.selected_option_count;
            for (this.selected_option_count = 0, _ref = this.form_field.options, _i = 0, _len = _ref.length; _i < _len; _i++) option = _ref[_i], 
            option.selected && (this.selected_option_count += 1);
            return this.selected_option_count;
        }, AbstractChosen.prototype.choices_click = function(evt) {
            if (evt.preventDefault(), !this.results_showing && !this.is_disabled) return this.results_show();
        }, AbstractChosen.prototype.keyup_checker = function(evt) {
            var stroke, _ref;
            switch (stroke = null != (_ref = evt.which) ? _ref : evt.keyCode, this.search_field_scale(), 
            stroke) {
              case 8:
                if (this.is_multiple && this.backstroke_length < 1 && this.choices_count() > 0) return this.keydown_backstroke();
                if (!this.pending_backstroke) return this.result_clear_highlight(), this.results_search();
                break;

              case 13:
                if (evt.preventDefault(), this.results_showing) return this.result_select(evt);
                break;

              case 27:
                return this.results_showing && this.results_hide(), !0;

              case 9:
              case 38:
              case 40:
              case 16:
              case 91:
              case 17:
                break;

              default:
                return this.results_search();
            }
        }, AbstractChosen.prototype.clipboard_event_checker = function(evt) {
            var _this = this;
            return setTimeout(function() {
                return _this.results_search();
            }, 50);
        }, AbstractChosen.prototype.container_width = function() {
            return null != this.options.width ? this.options.width : this.form_field.offsetWidth + "px";
        }, AbstractChosen.prototype.include_option_in_results = function(option) {
            return !(this.is_multiple && !this.display_selected_options && option.selected) && (!(!this.display_disabled_options && option.disabled) && !option.empty);
        }, AbstractChosen.prototype.search_results_touchstart = function(evt) {
            return this.touch_started = !0, this.search_results_mouseover(evt);
        }, AbstractChosen.prototype.search_results_touchmove = function(evt) {
            return this.touch_started = !1, this.search_results_mouseout(evt);
        }, AbstractChosen.prototype.search_results_touchend = function(evt) {
            if (this.touch_started) return this.search_results_mouseup(evt);
        }, AbstractChosen.prototype.outerHTML = function(element) {
            var tmp;
            return element.outerHTML ? element.outerHTML : (tmp = document.createElement("div"), 
            tmp.appendChild(element), tmp.innerHTML);
        }, AbstractChosen.browser_is_supported = function() {
            return "Microsoft Internet Explorer" === window.navigator.appName ? document.documentMode >= 8 : !/iP(od|hone)/i.test(window.navigator.userAgent) && (!/Android/i.test(window.navigator.userAgent) || !/Mobile/i.test(window.navigator.userAgent));
        }, AbstractChosen.default_multiple_text = "Select Some Options", AbstractChosen.default_single_text = "Select an Option", 
        AbstractChosen.default_no_result_text = "No results match", AbstractChosen;
    }(), $ = jQuery, $.fn.extend({
        chosen: function(options) {
            return AbstractChosen.browser_is_supported() ? this.each(function(input_field) {
                var $this, chosen;
                $this = $(this), chosen = $this.data("chosen"), "destroy" === options && chosen instanceof Chosen ? chosen.destroy() : chosen instanceof Chosen || $this.data("chosen", new Chosen(this, options));
            }) : this;
        }
    }), Chosen = function(_super) {
        function Chosen() {
            return _ref = Chosen.__super__.constructor.apply(this, arguments);
        }
        return __extends(Chosen, _super), Chosen.prototype.setup = function() {
            return this.form_field_jq = $(this.form_field), this.current_selectedIndex = this.form_field.selectedIndex, 
            this.is_rtl = this.form_field_jq.hasClass("chosen-rtl");
        }, Chosen.prototype.set_up_html = function() {
            var container_classes, container_props;
            return container_classes = [ "chosen-container" ], container_classes.push("chosen-container-" + (this.is_multiple ? "multi" : "single")), 
            this.inherit_select_classes && this.form_field.className && container_classes.push(this.form_field.className), 
            this.is_rtl && container_classes.push("chosen-rtl"), container_props = {
                class: container_classes.join(" "),
                style: "width: " + this.container_width() + ";",
                title: this.form_field.title
            }, this.form_field.id.length && (container_props.id = this.form_field.id.replace(/[^\w]/g, "_") + "_chosen"), 
            this.container = $("<div />", container_props), this.is_multiple ? this.container.html('<ul class="chosen-choices"><li class="search-field"><input type="text" value="' + this.default_text + '" class="default" autocomplete="off" style="width:25px;" /></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div>') : this.container.html('<a class="chosen-single chosen-default" tabindex="-1"><span>' + this.default_text + '</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" /></div><ul class="chosen-results"></ul></div>'), 
            this.form_field_jq.hide().after(this.container), this.dropdown = this.container.find("div.chosen-drop").first(), 
            this.search_field = this.container.find("input").first(), this.search_results = this.container.find("ul.chosen-results").first(), 
            this.search_field_scale(), this.search_no_results = this.container.find("li.no-results").first(), 
            this.is_multiple ? (this.search_choices = this.container.find("ul.chosen-choices").first(), 
            this.search_container = this.container.find("li.search-field").first()) : (this.search_container = this.container.find("div.chosen-search").first(), 
            this.selected_item = this.container.find(".chosen-single").first()), this.results_build(), 
            this.set_tab_index(), this.set_label_behavior();
        }, Chosen.prototype.on_ready = function() {
            return this.form_field_jq.trigger("chosen:ready", {
                chosen: this
            });
        }, Chosen.prototype.register_observers = function() {
            var _this = this;
            return this.container.bind("touchstart.chosen", function(evt) {
                return _this.container_mousedown(evt), evt.preventDefault();
            }), this.container.bind("touchend.chosen", function(evt) {
                return _this.container_mouseup(evt), evt.preventDefault();
            }), this.container.bind("mousedown.chosen", function(evt) {
                _this.container_mousedown(evt);
            }), this.container.bind("mouseup.chosen", function(evt) {
                _this.container_mouseup(evt);
            }), this.container.bind("mouseenter.chosen", function(evt) {
                _this.mouse_enter(evt);
            }), this.container.bind("mouseleave.chosen", function(evt) {
                _this.mouse_leave(evt);
            }), this.search_results.bind("mouseup.chosen", function(evt) {
                _this.search_results_mouseup(evt);
            }), this.search_results.bind("mouseover.chosen", function(evt) {
                _this.search_results_mouseover(evt);
            }), this.search_results.bind("mouseout.chosen", function(evt) {
                _this.search_results_mouseout(evt);
            }), this.search_results.bind("mousewheel.chosen DOMMouseScroll.chosen", function(evt) {
                _this.search_results_mousewheel(evt);
            }), this.search_results.bind("touchstart.chosen", function(evt) {
                _this.search_results_touchstart(evt);
            }), this.search_results.bind("touchmove.chosen", function(evt) {
                _this.search_results_touchmove(evt);
            }), this.search_results.bind("touchend.chosen", function(evt) {
                _this.search_results_touchend(evt);
            }), this.form_field_jq.bind("chosen:updated.chosen", function(evt) {
                _this.results_update_field(evt);
            }), this.form_field_jq.bind("chosen:activate.chosen", function(evt) {
                _this.activate_field(evt);
            }), this.form_field_jq.bind("chosen:open.chosen", function(evt) {
                _this.container_mousedown(evt);
            }), this.form_field_jq.bind("chosen:close.chosen", function(evt) {
                _this.input_blur(evt);
            }), this.search_field.bind("blur.chosen", function(evt) {
                _this.input_blur(evt);
            }), this.search_field.bind("keyup.chosen", function(evt) {
                _this.keyup_checker(evt);
            }), this.search_field.bind("keydown.chosen", function(evt) {
                _this.keydown_checker(evt);
            }), this.search_field.bind("focus.chosen", function(evt) {
                _this.input_focus(evt);
            }), this.search_field.bind("cut.chosen", function(evt) {
                _this.clipboard_event_checker(evt);
            }), this.search_field.bind("paste.chosen", function(evt) {
                _this.clipboard_event_checker(evt);
            }), this.is_multiple ? this.search_choices.bind("click.chosen", function(evt) {
                _this.choices_click(evt);
            }) : this.container.bind("click.chosen", function(evt) {
                evt.preventDefault();
            });
        }, Chosen.prototype.destroy = function() {
            return $(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action), 
            this.search_field[0].tabIndex && (this.form_field_jq[0].tabIndex = this.search_field[0].tabIndex), 
            this.container.remove(), this.form_field_jq.removeData("chosen"), this.form_field_jq.show();
        }, Chosen.prototype.search_field_disabled = function() {
            return this.is_disabled = this.form_field_jq[0].disabled, this.is_disabled ? (this.container.addClass("chosen-disabled"), 
            this.search_field[0].disabled = !0, this.is_multiple || this.selected_item.unbind("focus.chosen", this.activate_action), 
            this.close_field()) : (this.container.removeClass("chosen-disabled"), this.search_field[0].disabled = !1, 
            this.is_multiple ? void 0 : this.selected_item.bind("focus.chosen", this.activate_action));
        }, Chosen.prototype.container_mousedown = function(evt) {
            if (!this.is_disabled && (evt && "mousedown" === evt.type && !this.results_showing && evt.preventDefault(), 
            null == evt || !$(evt.target).hasClass("search-choice-close"))) return this.active_field ? this.is_multiple || !evt || $(evt.target)[0] !== this.selected_item[0] && !$(evt.target).parents("a.chosen-single").length || (evt.preventDefault(), 
            this.results_toggle()) : (this.is_multiple && this.search_field.val(""), $(this.container[0].ownerDocument).bind("click.chosen", this.click_test_action), 
            this.results_show()), this.activate_field();
        }, Chosen.prototype.container_mouseup = function(evt) {
            if ("ABBR" === evt.target.nodeName && !this.is_disabled) return this.results_reset(evt);
        }, Chosen.prototype.search_results_mousewheel = function(evt) {
            var delta;
            if (evt.originalEvent && (delta = evt.originalEvent.deltaY || -evt.originalEvent.wheelDelta || evt.originalEvent.detail), 
            null != delta) return evt.preventDefault(), "DOMMouseScroll" === evt.type && (delta *= 40), 
            this.search_results.scrollTop(delta + this.search_results.scrollTop());
        }, Chosen.prototype.blur_test = function(evt) {
            if (!this.active_field && this.container.hasClass("chosen-container-active")) return this.close_field();
        }, Chosen.prototype.close_field = function() {
            return $(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action), 
            this.active_field = !1, this.results_hide(), this.container.removeClass("chosen-container-active"), 
            this.clear_backstroke(), this.show_search_field_default(), this.search_field_scale();
        }, Chosen.prototype.activate_field = function() {
            return this.container.addClass("chosen-container-active"), this.active_field = !0, 
            this.search_field.val(this.search_field.val()), this.search_field.focus();
        }, Chosen.prototype.test_active_click = function(evt) {
            var active_container;
            return active_container = $(evt.target).closest(".chosen-container"), active_container.length && this.container[0] === active_container[0] ? this.active_field = !0 : this.close_field();
        }, Chosen.prototype.results_build = function() {
            return this.parsing = !0, this.selected_option_count = null, this.results_data = SelectParser.select_to_array(this.form_field), 
            this.is_multiple ? this.search_choices.find("li.search-choice").remove() : this.is_multiple || (this.single_set_selected_text(), 
            this.disable_search || this.form_field.options.length <= this.disable_search_threshold ? (this.search_field[0].readOnly = !0, 
            this.container.addClass("chosen-container-single-nosearch")) : (this.search_field[0].readOnly = !1, 
            this.container.removeClass("chosen-container-single-nosearch"))), this.update_results_content(this.results_option_build({
                first: !0
            })), this.search_field_disabled(), this.show_search_field_default(), this.search_field_scale(), 
            this.parsing = !1;
        }, Chosen.prototype.result_do_highlight = function(el) {
            var high_bottom, high_top, maxHeight, visible_bottom, visible_top;
            if (el.length) {
                if (this.result_clear_highlight(), this.result_highlight = el, this.result_highlight.addClass("highlighted"), 
                maxHeight = parseInt(this.search_results.css("maxHeight"), 10), visible_top = this.search_results.scrollTop(), 
                visible_bottom = maxHeight + visible_top, high_top = this.result_highlight.position().top + this.search_results.scrollTop(), 
                (high_bottom = high_top + this.result_highlight.outerHeight()) >= visible_bottom) return this.search_results.scrollTop(high_bottom - maxHeight > 0 ? high_bottom - maxHeight : 0);
                if (high_top < visible_top) return this.search_results.scrollTop(high_top);
            }
        }, Chosen.prototype.result_clear_highlight = function() {
            return this.result_highlight && this.result_highlight.removeClass("highlighted"), 
            this.result_highlight = null;
        }, Chosen.prototype.results_show = function() {
            return this.is_multiple && this.max_selected_options <= this.choices_count() ? (this.form_field_jq.trigger("chosen:maxselected", {
                chosen: this
            }), !1) : (this.container.addClass("chosen-with-drop"), this.results_showing = !0, 
            this.search_field.focus(), this.search_field.val(this.search_field.val()), this.winnow_results(), 
            this.form_field_jq.trigger("chosen:showing_dropdown", {
                chosen: this
            }));
        }, Chosen.prototype.update_results_content = function(content) {
            return this.search_results.html(content);
        }, Chosen.prototype.results_hide = function() {
            return this.results_showing && (this.result_clear_highlight(), this.container.removeClass("chosen-with-drop"), 
            this.form_field_jq.trigger("chosen:hiding_dropdown", {
                chosen: this
            })), this.results_showing = !1;
        }, Chosen.prototype.set_tab_index = function(el) {
            var ti;
            if (this.form_field.tabIndex) return ti = this.form_field.tabIndex, this.form_field.tabIndex = -1, 
            this.search_field[0].tabIndex = ti;
        }, Chosen.prototype.set_label_behavior = function() {
            var _this = this;
            if (this.form_field_label = this.form_field_jq.parents("label"), !this.form_field_label.length && this.form_field.id.length && (this.form_field_label = $("label[for='" + this.form_field.id + "']")), 
            this.form_field_label.length > 0) return this.form_field_label.bind("click.chosen", function(evt) {
                return _this.is_multiple ? _this.container_mousedown(evt) : _this.activate_field();
            });
        }, Chosen.prototype.show_search_field_default = function() {
            return this.is_multiple && this.choices_count() < 1 && !this.active_field ? (this.search_field.val(this.default_text), 
            this.search_field.addClass("default")) : (this.search_field.val(""), this.search_field.removeClass("default"));
        }, Chosen.prototype.search_results_mouseup = function(evt) {
            var target;
            if (target = $(evt.target).hasClass("active-result") ? $(evt.target) : $(evt.target).parents(".active-result").first(), 
            target.length) return this.result_highlight = target, this.result_select(evt), this.search_field.focus();
        }, Chosen.prototype.search_results_mouseover = function(evt) {
            var target;
            if (target = $(evt.target).hasClass("active-result") ? $(evt.target) : $(evt.target).parents(".active-result").first()) return this.result_do_highlight(target);
        }, Chosen.prototype.search_results_mouseout = function(evt) {
            if ($(evt.target).hasClass("active-result")) return this.result_clear_highlight();
        }, Chosen.prototype.choice_build = function(item) {
            var choice, close_link, _this = this;
            return choice = $("<li />", {
                class: "search-choice"
            }).html("<span>" + this.choice_label(item) + "</span>"), item.disabled ? choice.addClass("search-choice-disabled") : (close_link = $("<a />", {
                class: "search-choice-close",
                "data-option-array-index": item.array_index
            }), close_link.bind("click.chosen", function(evt) {
                return _this.choice_destroy_link_click(evt);
            }), choice.append(close_link)), this.search_container.before(choice);
        }, Chosen.prototype.choice_destroy_link_click = function(evt) {
            if (evt.preventDefault(), evt.stopPropagation(), !this.is_disabled) return this.choice_destroy($(evt.target));
        }, Chosen.prototype.choice_destroy = function(link) {
            if (this.result_deselect(link[0].getAttribute("data-option-array-index"))) return this.show_search_field_default(), 
            this.is_multiple && this.choices_count() > 0 && this.search_field.val().length < 1 && this.results_hide(), 
            link.parents("li").first().remove(), this.search_field_scale();
        }, Chosen.prototype.results_reset = function() {
            if (this.reset_single_select_options(), this.form_field.options[0].selected = !0, 
            this.single_set_selected_text(), this.show_search_field_default(), this.results_reset_cleanup(), 
            this.form_field_jq.trigger("change"), this.active_field) return this.results_hide();
        }, Chosen.prototype.results_reset_cleanup = function() {
            return this.current_selectedIndex = this.form_field.selectedIndex, this.selected_item.find("abbr").remove();
        }, Chosen.prototype.result_select = function(evt) {
            var high, item;
            if (this.result_highlight) return high = this.result_highlight, this.result_clear_highlight(), 
            this.is_multiple && this.max_selected_options <= this.choices_count() ? (this.form_field_jq.trigger("chosen:maxselected", {
                chosen: this
            }), !1) : (this.is_multiple ? high.removeClass("active-result") : this.reset_single_select_options(), 
            high.addClass("result-selected"), item = this.results_data[high[0].getAttribute("data-option-array-index")], 
            item.selected = !0, this.form_field.options[item.options_index].selected = !0, this.selected_option_count = null, 
            this.is_multiple ? this.choice_build(item) : this.single_set_selected_text(this.choice_label(item)), 
            (evt.metaKey || evt.ctrlKey) && this.is_multiple || this.results_hide(), this.search_field.val(""), 
            (this.is_multiple || this.form_field.selectedIndex !== this.current_selectedIndex) && this.form_field_jq.trigger("change", {
                selected: this.form_field.options[item.options_index].value
            }), this.current_selectedIndex = this.form_field.selectedIndex, evt.preventDefault(), 
            this.search_field_scale());
        }, Chosen.prototype.single_set_selected_text = function(text) {
            return null == text && (text = this.default_text), text === this.default_text ? this.selected_item.addClass("chosen-default") : (this.single_deselect_control_build(), 
            this.selected_item.removeClass("chosen-default")), this.selected_item.find("span").html(text);
        }, Chosen.prototype.result_deselect = function(pos) {
            var result_data;
            return result_data = this.results_data[pos], !this.form_field.options[result_data.options_index].disabled && (result_data.selected = !1, 
            this.form_field.options[result_data.options_index].selected = !1, this.selected_option_count = null, 
            this.result_clear_highlight(), this.results_showing && this.winnow_results(), this.form_field_jq.trigger("change", {
                deselected: this.form_field.options[result_data.options_index].value
            }), this.search_field_scale(), !0);
        }, Chosen.prototype.single_deselect_control_build = function() {
            if (this.allow_single_deselect) return this.selected_item.find("abbr").length || this.selected_item.find("span").first().after('<abbr class="search-choice-close"></abbr>'), 
            this.selected_item.addClass("chosen-single-with-deselect");
        }, Chosen.prototype.get_search_text = function() {
            return $("<div/>").text($.trim(this.search_field.val())).html();
        }, Chosen.prototype.winnow_results_set_highlight = function() {
            var do_high, selected_results;
            if (selected_results = this.is_multiple ? [] : this.search_results.find(".result-selected.active-result"), 
            null != (do_high = selected_results.length ? selected_results.first() : this.search_results.find(".active-result").first())) return this.result_do_highlight(do_high);
        }, Chosen.prototype.no_results = function(terms) {
            var no_results_html;
            return no_results_html = $('<li class="no-results">' + this.results_none_found + ' "<span></span>"</li>'), 
            no_results_html.find("span").first().html(terms), this.search_results.append(no_results_html), 
            this.form_field_jq.trigger("chosen:no_results", {
                chosen: this
            });
        }, Chosen.prototype.no_results_clear = function() {
            return this.search_results.find(".no-results").remove();
        }, Chosen.prototype.keydown_arrow = function() {
            var next_sib;
            return this.results_showing && this.result_highlight ? (next_sib = this.result_highlight.nextAll("li.active-result").first()) ? this.result_do_highlight(next_sib) : void 0 : this.results_show();
        }, Chosen.prototype.keyup_arrow = function() {
            var prev_sibs;
            return this.results_showing || this.is_multiple ? this.result_highlight ? (prev_sibs = this.result_highlight.prevAll("li.active-result"), 
            prev_sibs.length ? this.result_do_highlight(prev_sibs.first()) : (this.choices_count() > 0 && this.results_hide(), 
            this.result_clear_highlight())) : void 0 : this.results_show();
        }, Chosen.prototype.keydown_backstroke = function() {
            var next_available_destroy;
            return this.pending_backstroke ? (this.choice_destroy(this.pending_backstroke.find("a").first()), 
            this.clear_backstroke()) : (next_available_destroy = this.search_container.siblings("li.search-choice").last(), 
            next_available_destroy.length && !next_available_destroy.hasClass("search-choice-disabled") ? (this.pending_backstroke = next_available_destroy, 
            this.single_backstroke_delete ? this.keydown_backstroke() : this.pending_backstroke.addClass("search-choice-focus")) : void 0);
        }, Chosen.prototype.clear_backstroke = function() {
            return this.pending_backstroke && this.pending_backstroke.removeClass("search-choice-focus"), 
            this.pending_backstroke = null;
        }, Chosen.prototype.keydown_checker = function(evt) {
            var stroke, _ref1;
            switch (stroke = null != (_ref1 = evt.which) ? _ref1 : evt.keyCode, this.search_field_scale(), 
            8 !== stroke && this.pending_backstroke && this.clear_backstroke(), stroke) {
              case 8:
                this.backstroke_length = this.search_field.val().length;
                break;

              case 9:
                this.results_showing && !this.is_multiple && this.result_select(evt), this.mouse_on_container = !1;
                break;

              case 13:
                this.results_showing && evt.preventDefault();
                break;

              case 32:
                this.disable_search && evt.preventDefault();
                break;

              case 38:
                evt.preventDefault(), this.keyup_arrow();
                break;

              case 40:
                evt.preventDefault(), this.keydown_arrow();
            }
        }, Chosen.prototype.search_field_scale = function() {
            var div, f_width, style, style_block, styles, w, _i, _len;
            if (this.is_multiple) {
                for (0, w = 0, style_block = "position:absolute; left: -1000px; top: -1000px; display:none;", 
                styles = [ "font-size", "font-style", "font-weight", "font-family", "line-height", "text-transform", "letter-spacing" ], 
                _i = 0, _len = styles.length; _i < _len; _i++) style = styles[_i], style_block += style + ":" + this.search_field.css(style) + ";";
                return div = $("<div />", {
                    style: style_block
                }), div.text(this.search_field.val()), $("body").append(div), w = div.width() + 25, 
                div.remove(), f_width = this.container.outerWidth(), w > f_width - 10 && (w = f_width - 10), 
                this.search_field.css({
                    width: w + "px"
                });
            }
        }, Chosen;
    }(AbstractChosen);
}.call(this), function() {
    var Dropzone, Emitter, camelize, contentLoaded, detectVerticalSquash, drawImageIOSFix, noop, without, __slice = [].slice, __hasProp = {}.hasOwnProperty, __extends = function(child, parent) {
        function ctor() {
            this.constructor = child;
        }
        for (var key in parent) __hasProp.call(parent, key) && (child[key] = parent[key]);
        return ctor.prototype = parent.prototype, child.prototype = new ctor(), child.__super__ = parent.prototype, 
        child;
    };
    noop = function() {}, Emitter = function() {
        function Emitter() {}
        return Emitter.prototype.addEventListener = Emitter.prototype.on, Emitter.prototype.on = function(event, fn) {
            return this._callbacks = this._callbacks || {}, this._callbacks[event] || (this._callbacks[event] = []), 
            this._callbacks[event].push(fn), this;
        }, Emitter.prototype.emit = function() {
            var args, callback, callbacks, event, _i, _len;
            if (event = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [], 
            this._callbacks = this._callbacks || {}, callbacks = this._callbacks[event]) for (_i = 0, 
            _len = callbacks.length; _i < _len; _i++) callback = callbacks[_i], callback.apply(this, args);
            return this;
        }, Emitter.prototype.removeListener = Emitter.prototype.off, Emitter.prototype.removeAllListeners = Emitter.prototype.off, 
        Emitter.prototype.removeEventListener = Emitter.prototype.off, Emitter.prototype.off = function(event, fn) {
            var callbacks, i, _i, _len;
            if (!this._callbacks || 0 === arguments.length) return this._callbacks = {}, this;
            if (!(callbacks = this._callbacks[event])) return this;
            if (1 === arguments.length) return delete this._callbacks[event], this;
            for (i = _i = 0, _len = callbacks.length; _i < _len; i = ++_i) if (callbacks[i] === fn) {
                callbacks.splice(i, 1);
                break;
            }
            return this;
        }, Emitter;
    }(), Dropzone = function(_super) {
        function Dropzone(element, options) {
            var elementOptions, fallback, _ref;
            if (this.element = element, this.version = Dropzone.version, this.defaultOptions.previewTemplate = this.defaultOptions.previewTemplate.replace(/\n*/g, ""), 
            this.clickableElements = [], this.listeners = [], this.files = [], "string" == typeof this.element && (this.element = document.querySelector(this.element)), 
            !this.element || null == this.element.nodeType) throw new Error("Invalid dropzone element.");
            if (this.element.dropzone) throw new Error("Dropzone already attached.");
            if (Dropzone.instances.push(this), this.element.dropzone = this, elementOptions = null != (_ref = Dropzone.optionsForElement(this.element)) ? _ref : {}, 
            this.options = extend({}, this.defaultOptions, elementOptions, null != options ? options : {}), 
            this.options.forceFallback || !Dropzone.isBrowserSupported()) return this.options.fallback.call(this);
            if (null == this.options.url && (this.options.url = this.element.getAttribute("action")), 
            !this.options.url) throw new Error("No URL provided.");
            if (this.options.acceptedFiles && this.options.acceptedMimeTypes) throw new Error("You can't provide both 'acceptedFiles' and 'acceptedMimeTypes'. 'acceptedMimeTypes' is deprecated.");
            this.options.acceptedMimeTypes && (this.options.acceptedFiles = this.options.acceptedMimeTypes, 
            delete this.options.acceptedMimeTypes), this.options.method = this.options.method.toUpperCase(), 
            (fallback = this.getExistingFallback()) && fallback.parentNode && fallback.parentNode.removeChild(fallback), 
            !1 !== this.options.previewsContainer && (this.options.previewsContainer ? this.previewsContainer = Dropzone.getElement(this.options.previewsContainer, "previewsContainer") : this.previewsContainer = this.element), 
            this.options.clickable && (!0 === this.options.clickable ? this.clickableElements = [ this.element ] : this.clickableElements = Dropzone.getElements(this.options.clickable, "clickable")), 
            this.init();
        }
        var extend, resolveOption;
        return __extends(Dropzone, _super), Dropzone.prototype.Emitter = Emitter, Dropzone.prototype.events = [ "drop", "dragstart", "dragend", "dragenter", "dragover", "dragleave", "addedfile", "addedfiles", "removedfile", "thumbnail", "error", "errormultiple", "processing", "processingmultiple", "uploadprogress", "totaluploadprogress", "sending", "sendingmultiple", "success", "successmultiple", "canceled", "canceledmultiple", "complete", "completemultiple", "reset", "maxfilesexceeded", "maxfilesreached", "queuecomplete" ], 
        Dropzone.prototype.defaultOptions = {
            url: null,
            method: "post",
            withCredentials: !1,
            parallelUploads: 2,
            uploadMultiple: !1,
            maxFilesize: 256,
            paramName: "file",
            createImageThumbnails: !0,
            maxThumbnailFilesize: 10,
            thumbnailWidth: 120,
            thumbnailHeight: 120,
            filesizeBase: 1e3,
            maxFiles: null,
            params: {},
            clickable: !0,
            ignoreHiddenFiles: !0,
            acceptedFiles: null,
            acceptedMimeTypes: null,
            autoProcessQueue: !0,
            autoQueue: !0,
            addRemoveLinks: !1,
            previewsContainer: null,
            hiddenInputContainer: "body",
            capture: null,
            renameFilename: null,
            dictDefaultMessage: "Drop files here to upload",
            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
            dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
            dictInvalidFileType: "You can't upload files of this type.",
            dictResponseError: "Server responded with {{statusCode}} code.",
            dictCancelUpload: "Cancel upload",
            dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
            dictRemoveFile: "Remove file",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "You can not upload any more files.",
            accept: function(file, done) {
                return done();
            },
            init: function() {
                return noop;
            },
            forceFallback: !1,
            fallback: function() {
                var child, messageElement, span, _i, _len, _ref;
                for (this.element.className = this.element.className + " dz-browser-not-supported", 
                _ref = this.element.getElementsByTagName("div"), _i = 0, _len = _ref.length; _i < _len; _i++) child = _ref[_i], 
                /(^| )dz-message($| )/.test(child.className) && (messageElement = child, child.className = "dz-message");
                return messageElement || (messageElement = Dropzone.createElement('<div class="dz-message"><span></span></div>'), 
                this.element.appendChild(messageElement)), span = messageElement.getElementsByTagName("span")[0], 
                span && (null != span.textContent ? span.textContent = this.options.dictFallbackMessage : null != span.innerText && (span.innerText = this.options.dictFallbackMessage)), 
                this.element.appendChild(this.getFallbackForm());
            },
            resize: function(file) {
                var info, srcRatio, trgRatio;
                return info = {
                    srcX: 0,
                    srcY: 0,
                    srcWidth: file.width,
                    srcHeight: file.height
                }, srcRatio = file.width / file.height, info.optWidth = this.options.thumbnailWidth, 
                info.optHeight = this.options.thumbnailHeight, null == info.optWidth && null == info.optHeight ? (info.optWidth = info.srcWidth, 
                info.optHeight = info.srcHeight) : null == info.optWidth ? info.optWidth = srcRatio * info.optHeight : null == info.optHeight && (info.optHeight = 1 / srcRatio * info.optWidth), 
                trgRatio = info.optWidth / info.optHeight, file.height < info.optHeight || file.width < info.optWidth ? (info.trgHeight = info.srcHeight, 
                info.trgWidth = info.srcWidth) : srcRatio > trgRatio ? (info.srcHeight = file.height, 
                info.srcWidth = info.srcHeight * trgRatio) : (info.srcWidth = file.width, info.srcHeight = info.srcWidth / trgRatio), 
                info.srcX = (file.width - info.srcWidth) / 2, info.srcY = (file.height - info.srcHeight) / 2, 
                info;
            },
            drop: function(e) {
                return this.element.classList.remove("dz-drag-hover");
            },
            dragstart: noop,
            dragend: function(e) {
                return this.element.classList.remove("dz-drag-hover");
            },
            dragenter: function(e) {
                return this.element.classList.add("dz-drag-hover");
            },
            dragover: function(e) {
                return this.element.classList.add("dz-drag-hover");
            },
            dragleave: function(e) {
                return this.element.classList.remove("dz-drag-hover");
            },
            paste: noop,
            reset: function() {
                return this.element.classList.remove("dz-started");
            },
            addedfile: function(file) {
                var node, removeFileEvent, removeLink, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _ref2, _results;
                if (this.element === this.previewsContainer && this.element.classList.add("dz-started"), 
                this.previewsContainer) {
                    for (file.previewElement = Dropzone.createElement(this.options.previewTemplate.trim()), 
                    file.previewTemplate = file.previewElement, this.previewsContainer.appendChild(file.previewElement), 
                    _ref = file.previewElement.querySelectorAll("[data-dz-name]"), _i = 0, _len = _ref.length; _i < _len; _i++) node = _ref[_i], 
                    node.textContent = this._renameFilename(file.name);
                    for (_ref1 = file.previewElement.querySelectorAll("[data-dz-size]"), _j = 0, _len1 = _ref1.length; _j < _len1; _j++) node = _ref1[_j], 
                    node.innerHTML = this.filesize(file.size);
                    for (this.options.addRemoveLinks && (file._removeLink = Dropzone.createElement('<a class="dz-remove" href="javascript:undefined;" data-dz-remove>' + this.options.dictRemoveFile + "</a>"), 
                    file.previewElement.appendChild(file._removeLink)), removeFileEvent = function(_this) {
                        return function(e) {
                            return e.preventDefault(), e.stopPropagation(), file.status === Dropzone.UPLOADING ? Dropzone.confirm(_this.options.dictCancelUploadConfirmation, function() {
                                return _this.removeFile(file);
                            }) : _this.options.dictRemoveFileConfirmation ? Dropzone.confirm(_this.options.dictRemoveFileConfirmation, function() {
                                return _this.removeFile(file);
                            }) : _this.removeFile(file);
                        };
                    }(this), _ref2 = file.previewElement.querySelectorAll("[data-dz-remove]"), _results = [], 
                    _k = 0, _len2 = _ref2.length; _k < _len2; _k++) removeLink = _ref2[_k], _results.push(removeLink.addEventListener("click", removeFileEvent));
                    return _results;
                }
            },
            removedfile: function(file) {
                var _ref;
                return file.previewElement && null != (_ref = file.previewElement) && _ref.parentNode.removeChild(file.previewElement), 
                this._updateMaxFilesReachedClass();
            },
            thumbnail: function(file, dataUrl) {
                var thumbnailElement, _i, _len, _ref;
                if (file.previewElement) {
                    for (file.previewElement.classList.remove("dz-file-preview"), _ref = file.previewElement.querySelectorAll("[data-dz-thumbnail]"), 
                    _i = 0, _len = _ref.length; _i < _len; _i++) thumbnailElement = _ref[_i], thumbnailElement.alt = file.name, 
                    thumbnailElement.src = dataUrl;
                    return setTimeout(function(_this) {
                        return function() {
                            return file.previewElement.classList.add("dz-image-preview");
                        };
                    }(), 1);
                }
            },
            error: function(file, message) {
                var node, _i, _len, _ref, _results;
                if (file.previewElement) {
                    for (file.previewElement.classList.add("dz-error"), "String" != typeof message && message.error && (message = message.error), 
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]"), _results = [], 
                    _i = 0, _len = _ref.length; _i < _len; _i++) node = _ref[_i], _results.push(node.textContent = message);
                    return _results;
                }
            },
            errormultiple: noop,
            processing: function(file) {
                if (file.previewElement && (file.previewElement.classList.add("dz-processing"), 
                file._removeLink)) return file._removeLink.textContent = this.options.dictCancelUpload;
            },
            processingmultiple: noop,
            uploadprogress: function(file, progress, bytesSent) {
                var node, _i, _len, _ref, _results;
                if (file.previewElement) {
                    for (_ref = file.previewElement.querySelectorAll("[data-dz-uploadprogress]"), _results = [], 
                    _i = 0, _len = _ref.length; _i < _len; _i++) node = _ref[_i], "PROGRESS" === node.nodeName ? _results.push(node.value = progress) : _results.push(node.style.width = progress + "%");
                    return _results;
                }
            },
            totaluploadprogress: noop,
            sending: noop,
            sendingmultiple: noop,
            success: function(file) {
                if (file.previewElement) return file.previewElement.classList.add("dz-success");
            },
            successmultiple: noop,
            canceled: function(file) {
                return this.emit("error", file, "Upload canceled.");
            },
            canceledmultiple: noop,
            complete: function(file) {
                if (file._removeLink && (file._removeLink.textContent = this.options.dictRemoveFile), 
                file.previewElement) return file.previewElement.classList.add("dz-complete");
            },
            completemultiple: noop,
            maxfilesexceeded: noop,
            maxfilesreached: noop,
            queuecomplete: noop,
            addedfiles: noop,
            previewTemplate: '<div class="dz-preview dz-file-preview">\n  <div class="dz-image"><img data-dz-thumbnail /></div>\n  <div class="dz-details">\n    <div class="dz-size"><span data-dz-size></span></div>\n    <div class="dz-filename"><span data-dz-name></span></div>\n  </div>\n  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n  <div class="dz-success-mark">\n    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">\n      <title>Check</title>\n      <defs></defs>\n      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">\n        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>\n      </g>\n    </svg>\n  </div>\n  <div class="dz-error-mark">\n    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">\n      <title>Error</title>\n      <defs></defs>\n      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">\n        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">\n          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>\n        </g>\n      </g>\n    </svg>\n  </div>\n</div>'
        }, extend = function() {
            var key, object, objects, target, val, _i, _len;
            for (target = arguments[0], objects = 2 <= arguments.length ? __slice.call(arguments, 1) : [], 
            _i = 0, _len = objects.length; _i < _len; _i++) {
                object = objects[_i];
                for (key in object) val = object[key], target[key] = val;
            }
            return target;
        }, Dropzone.prototype.getAcceptedFiles = function() {
            var file, _i, _len, _ref, _results;
            for (_ref = this.files, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
            file.accepted && _results.push(file);
            return _results;
        }, Dropzone.prototype.getRejectedFiles = function() {
            var file, _i, _len, _ref, _results;
            for (_ref = this.files, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
            file.accepted || _results.push(file);
            return _results;
        }, Dropzone.prototype.getFilesWithStatus = function(status) {
            var file, _i, _len, _ref, _results;
            for (_ref = this.files, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
            file.status === status && _results.push(file);
            return _results;
        }, Dropzone.prototype.getQueuedFiles = function() {
            return this.getFilesWithStatus(Dropzone.QUEUED);
        }, Dropzone.prototype.getUploadingFiles = function() {
            return this.getFilesWithStatus(Dropzone.UPLOADING);
        }, Dropzone.prototype.getAddedFiles = function() {
            return this.getFilesWithStatus(Dropzone.ADDED);
        }, Dropzone.prototype.getActiveFiles = function() {
            var file, _i, _len, _ref, _results;
            for (_ref = this.files, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
            file.status !== Dropzone.UPLOADING && file.status !== Dropzone.QUEUED || _results.push(file);
            return _results;
        }, Dropzone.prototype.init = function() {
            var eventName, noPropagation, setupHiddenFileInput, _i, _len, _ref, _ref1;
            for ("form" === this.element.tagName && this.element.setAttribute("enctype", "multipart/form-data"), 
            this.element.classList.contains("dropzone") && !this.element.querySelector(".dz-message") && this.element.appendChild(Dropzone.createElement('<div class="dz-default dz-message"><span>' + this.options.dictDefaultMessage + "</span></div>")), 
            this.clickableElements.length && (setupHiddenFileInput = function(_this) {
                return function() {
                    return _this.hiddenFileInput && _this.hiddenFileInput.parentNode.removeChild(_this.hiddenFileInput), 
                    _this.hiddenFileInput = document.createElement("input"), _this.hiddenFileInput.setAttribute("type", "file"), 
                    (null == _this.options.maxFiles || _this.options.maxFiles > 1) && _this.hiddenFileInput.setAttribute("multiple", "multiple"), 
                    _this.hiddenFileInput.className = "dz-hidden-input", null != _this.options.acceptedFiles && _this.hiddenFileInput.setAttribute("accept", _this.options.acceptedFiles), 
                    null != _this.options.capture && _this.hiddenFileInput.setAttribute("capture", _this.options.capture), 
                    _this.hiddenFileInput.style.visibility = "hidden", _this.hiddenFileInput.style.position = "absolute", 
                    _this.hiddenFileInput.style.top = "0", _this.hiddenFileInput.style.left = "0", _this.hiddenFileInput.style.height = "0", 
                    _this.hiddenFileInput.style.width = "0", document.querySelector(_this.options.hiddenInputContainer).appendChild(_this.hiddenFileInput), 
                    _this.hiddenFileInput.addEventListener("change", function() {
                        var file, files, _i, _len;
                        if (files = _this.hiddenFileInput.files, files.length) for (_i = 0, _len = files.length; _i < _len; _i++) file = files[_i], 
                        _this.addFile(file);
                        return _this.emit("addedfiles", files), setupHiddenFileInput();
                    });
                };
            }(this))(), this.URL = null != (_ref = window.URL) ? _ref : window.webkitURL, _ref1 = this.events, 
            _i = 0, _len = _ref1.length; _i < _len; _i++) eventName = _ref1[_i], this.on(eventName, this.options[eventName]);
            return this.on("uploadprogress", function(_this) {
                return function() {
                    return _this.updateTotalUploadProgress();
                };
            }(this)), this.on("removedfile", function(_this) {
                return function() {
                    return _this.updateTotalUploadProgress();
                };
            }(this)), this.on("canceled", function(_this) {
                return function(file) {
                    return _this.emit("complete", file);
                };
            }(this)), this.on("complete", function(_this) {
                return function(file) {
                    if (0 === _this.getAddedFiles().length && 0 === _this.getUploadingFiles().length && 0 === _this.getQueuedFiles().length) return setTimeout(function() {
                        return _this.emit("queuecomplete");
                    }, 0);
                };
            }(this)), noPropagation = function(e) {
                return e.stopPropagation(), e.preventDefault ? e.preventDefault() : e.returnValue = !1;
            }, this.listeners = [ {
                element: this.element,
                events: {
                    dragstart: function(_this) {
                        return function(e) {
                            return _this.emit("dragstart", e);
                        };
                    }(this),
                    dragenter: function(_this) {
                        return function(e) {
                            return noPropagation(e), _this.emit("dragenter", e);
                        };
                    }(this),
                    dragover: function(_this) {
                        return function(e) {
                            var efct;
                            try {
                                efct = e.dataTransfer.effectAllowed;
                            } catch (_error) {}
                            return e.dataTransfer.dropEffect = "move" === efct || "linkMove" === efct ? "move" : "copy", 
                            noPropagation(e), _this.emit("dragover", e);
                        };
                    }(this),
                    dragleave: function(_this) {
                        return function(e) {
                            return _this.emit("dragleave", e);
                        };
                    }(this),
                    drop: function(_this) {
                        return function(e) {
                            return noPropagation(e), _this.drop(e);
                        };
                    }(this),
                    dragend: function(_this) {
                        return function(e) {
                            return _this.emit("dragend", e);
                        };
                    }(this)
                }
            } ], this.clickableElements.forEach(function(_this) {
                return function(clickableElement) {
                    return _this.listeners.push({
                        element: clickableElement,
                        events: {
                            click: function(evt) {
                                return (clickableElement !== _this.element || evt.target === _this.element || Dropzone.elementInside(evt.target, _this.element.querySelector(".dz-message"))) && _this.hiddenFileInput.click(), 
                                !0;
                            }
                        }
                    });
                };
            }(this)), this.enable(), this.options.init.call(this);
        }, Dropzone.prototype.destroy = function() {
            var _ref;
            return this.disable(), this.removeAllFiles(!0), (null != (_ref = this.hiddenFileInput) ? _ref.parentNode : void 0) && (this.hiddenFileInput.parentNode.removeChild(this.hiddenFileInput), 
            this.hiddenFileInput = null), delete this.element.dropzone, Dropzone.instances.splice(Dropzone.instances.indexOf(this), 1);
        }, Dropzone.prototype.updateTotalUploadProgress = function() {
            var activeFiles, file, totalBytes, totalBytesSent, totalUploadProgress, _i, _len, _ref;
            if (totalBytesSent = 0, totalBytes = 0, activeFiles = this.getActiveFiles(), activeFiles.length) {
                for (_ref = this.getActiveFiles(), _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
                totalBytesSent += file.upload.bytesSent, totalBytes += file.upload.total;
                totalUploadProgress = 100 * totalBytesSent / totalBytes;
            } else totalUploadProgress = 100;
            return this.emit("totaluploadprogress", totalUploadProgress, totalBytes, totalBytesSent);
        }, Dropzone.prototype._getParamName = function(n) {
            return "function" == typeof this.options.paramName ? this.options.paramName(n) : this.options.paramName + (this.options.uploadMultiple ? "[" + n + "]" : "");
        }, Dropzone.prototype._renameFilename = function(name) {
            return "function" != typeof this.options.renameFilename ? name : this.options.renameFilename(name);
        }, Dropzone.prototype.getFallbackForm = function() {
            var existingFallback, fields, fieldsString, form;
            return (existingFallback = this.getExistingFallback()) ? existingFallback : (fieldsString = '<div class="dz-fallback">', 
            this.options.dictFallbackText && (fieldsString += "<p>" + this.options.dictFallbackText + "</p>"), 
            fieldsString += '<input type="file" name="' + this._getParamName(0) + '" ' + (this.options.uploadMultiple ? 'multiple="multiple"' : void 0) + ' /><input type="submit" value="Upload!"></div>', 
            fields = Dropzone.createElement(fieldsString), "FORM" !== this.element.tagName ? (form = Dropzone.createElement('<form action="' + this.options.url + '" enctype="multipart/form-data" method="' + this.options.method + '"></form>'), 
            form.appendChild(fields)) : (this.element.setAttribute("enctype", "multipart/form-data"), 
            this.element.setAttribute("method", this.options.method)), null != form ? form : fields);
        }, Dropzone.prototype.getExistingFallback = function() {
            var fallback, getFallback, tagName, _i, _len, _ref;
            for (getFallback = function(elements) {
                var el, _i, _len;
                for (_i = 0, _len = elements.length; _i < _len; _i++) if (el = elements[_i], /(^| )fallback($| )/.test(el.className)) return el;
            }, _ref = [ "div", "form" ], _i = 0, _len = _ref.length; _i < _len; _i++) if (tagName = _ref[_i], 
            fallback = getFallback(this.element.getElementsByTagName(tagName))) return fallback;
        }, Dropzone.prototype.setupEventListeners = function() {
            var elementListeners, event, listener, _i, _len, _ref, _results;
            for (_ref = this.listeners, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) elementListeners = _ref[_i], 
            _results.push(function() {
                var _ref1, _results1;
                _ref1 = elementListeners.events, _results1 = [];
                for (event in _ref1) listener = _ref1[event], _results1.push(elementListeners.element.addEventListener(event, listener, !1));
                return _results1;
            }());
            return _results;
        }, Dropzone.prototype.removeEventListeners = function() {
            var elementListeners, event, listener, _i, _len, _ref, _results;
            for (_ref = this.listeners, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) elementListeners = _ref[_i], 
            _results.push(function() {
                var _ref1, _results1;
                _ref1 = elementListeners.events, _results1 = [];
                for (event in _ref1) listener = _ref1[event], _results1.push(elementListeners.element.removeEventListener(event, listener, !1));
                return _results1;
            }());
            return _results;
        }, Dropzone.prototype.disable = function() {
            var file, _i, _len, _ref, _results;
            for (this.clickableElements.forEach(function(element) {
                return element.classList.remove("dz-clickable");
            }), this.removeEventListeners(), _ref = this.files, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
            _results.push(this.cancelUpload(file));
            return _results;
        }, Dropzone.prototype.enable = function() {
            return this.clickableElements.forEach(function(element) {
                return element.classList.add("dz-clickable");
            }), this.setupEventListeners();
        }, Dropzone.prototype.filesize = function(size) {
            var cutoff, i, selectedSize, selectedUnit, unit, units, _i, _len;
            if (selectedSize = 0, selectedUnit = "b", size > 0) {
                for (units = [ "TB", "GB", "MB", "KB", "b" ], i = _i = 0, _len = units.length; _i < _len; i = ++_i) if (unit = units[i], 
                cutoff = Math.pow(this.options.filesizeBase, 4 - i) / 10, size >= cutoff) {
                    selectedSize = size / Math.pow(this.options.filesizeBase, 4 - i), selectedUnit = unit;
                    break;
                }
                selectedSize = Math.round(10 * selectedSize) / 10;
            }
            return "<strong>" + selectedSize + "</strong> " + selectedUnit;
        }, Dropzone.prototype._updateMaxFilesReachedClass = function() {
            return null != this.options.maxFiles && this.getAcceptedFiles().length >= this.options.maxFiles ? (this.getAcceptedFiles().length === this.options.maxFiles && this.emit("maxfilesreached", this.files), 
            this.element.classList.add("dz-max-files-reached")) : this.element.classList.remove("dz-max-files-reached");
        }, Dropzone.prototype.drop = function(e) {
            var files, items;
            e.dataTransfer && (this.emit("drop", e), files = e.dataTransfer.files, this.emit("addedfiles", files), 
            files.length && (items = e.dataTransfer.items, items && items.length && null != items[0].webkitGetAsEntry ? this._addFilesFromItems(items) : this.handleFiles(files)));
        }, Dropzone.prototype.paste = function(e) {
            var items, _ref;
            if (null != (null != e && null != (_ref = e.clipboardData) ? _ref.items : void 0)) return this.emit("paste", e), 
            items = e.clipboardData.items, items.length ? this._addFilesFromItems(items) : void 0;
        }, Dropzone.prototype.handleFiles = function(files) {
            var file, _i, _len, _results;
            for (_results = [], _i = 0, _len = files.length; _i < _len; _i++) file = files[_i], 
            _results.push(this.addFile(file));
            return _results;
        }, Dropzone.prototype._addFilesFromItems = function(items) {
            var entry, item, _i, _len, _results;
            for (_results = [], _i = 0, _len = items.length; _i < _len; _i++) item = items[_i], 
            null != item.webkitGetAsEntry && (entry = item.webkitGetAsEntry()) ? entry.isFile ? _results.push(this.addFile(item.getAsFile())) : entry.isDirectory ? _results.push(this._addFilesFromDirectory(entry, entry.name)) : _results.push(void 0) : null != item.getAsFile && (null == item.kind || "file" === item.kind) ? _results.push(this.addFile(item.getAsFile())) : _results.push(void 0);
            return _results;
        }, Dropzone.prototype._addFilesFromDirectory = function(directory, path) {
            var dirReader, errorHandler, readEntries;
            return dirReader = directory.createReader(), errorHandler = function(error) {
                return "undefined" != typeof console && null !== console && "function" == typeof console.log ? console.log(error) : void 0;
            }, (readEntries = function(_this) {
                return function() {
                    return dirReader.readEntries(function(entries) {
                        var entry, _i, _len;
                        if (entries.length > 0) {
                            for (_i = 0, _len = entries.length; _i < _len; _i++) entry = entries[_i], entry.isFile ? entry.file(function(file) {
                                if (!_this.options.ignoreHiddenFiles || "." !== file.name.substring(0, 1)) return file.fullPath = path + "/" + file.name, 
                                _this.addFile(file);
                            }) : entry.isDirectory && _this._addFilesFromDirectory(entry, path + "/" + entry.name);
                            readEntries();
                        }
                        return null;
                    }, errorHandler);
                };
            }(this))();
        }, Dropzone.prototype.accept = function(file, done) {
            return file.size > 1024 * this.options.maxFilesize * 1024 ? done(this.options.dictFileTooBig.replace("{{filesize}}", Math.round(file.size / 1024 / 10.24) / 100).replace("{{maxFilesize}}", this.options.maxFilesize)) : Dropzone.isValidFile(file, this.options.acceptedFiles) ? null != this.options.maxFiles && this.getAcceptedFiles().length >= this.options.maxFiles ? (done(this.options.dictMaxFilesExceeded.replace("{{maxFiles}}", this.options.maxFiles)), 
            this.emit("maxfilesexceeded", file)) : this.options.accept.call(this, file, done) : done(this.options.dictInvalidFileType);
        }, Dropzone.prototype.addFile = function(file) {
            return file.upload = {
                progress: 0,
                total: file.size,
                bytesSent: 0
            }, this.files.push(file), file.status = Dropzone.ADDED, this.emit("addedfile", file), 
            this._enqueueThumbnail(file), this.accept(file, function(_this) {
                return function(error) {
                    return error ? (file.accepted = !1, _this._errorProcessing([ file ], error)) : (file.accepted = !0, 
                    _this.options.autoQueue && _this.enqueueFile(file)), _this._updateMaxFilesReachedClass();
                };
            }(this));
        }, Dropzone.prototype.enqueueFiles = function(files) {
            var file, _i, _len;
            for (_i = 0, _len = files.length; _i < _len; _i++) file = files[_i], this.enqueueFile(file);
            return null;
        }, Dropzone.prototype.enqueueFile = function(file) {
            if (file.status !== Dropzone.ADDED || !0 !== file.accepted) throw new Error("This file can't be queued because it has already been processed or was rejected.");
            if (file.status = Dropzone.QUEUED, this.options.autoProcessQueue) return setTimeout(function(_this) {
                return function() {
                    return _this.processQueue();
                };
            }(this), 0);
        }, Dropzone.prototype._thumbnailQueue = [], Dropzone.prototype._processingThumbnail = !1, 
        Dropzone.prototype._enqueueThumbnail = function(file) {
            if (this.options.createImageThumbnails && file.type.match(/image.*/) && file.size <= 1024 * this.options.maxThumbnailFilesize * 1024) return this._thumbnailQueue.push(file), 
            setTimeout(function(_this) {
                return function() {
                    return _this._processThumbnailQueue();
                };
            }(this), 0);
        }, Dropzone.prototype._processThumbnailQueue = function() {
            if (!this._processingThumbnail && 0 !== this._thumbnailQueue.length) return this._processingThumbnail = !0, 
            this.createThumbnail(this._thumbnailQueue.shift(), function(_this) {
                return function() {
                    return _this._processingThumbnail = !1, _this._processThumbnailQueue();
                };
            }(this));
        }, Dropzone.prototype.removeFile = function(file) {
            if (file.status === Dropzone.UPLOADING && this.cancelUpload(file), this.files = without(this.files, file), 
            this.emit("removedfile", file), 0 === this.files.length) return this.emit("reset");
        }, Dropzone.prototype.removeAllFiles = function(cancelIfNecessary) {
            var file, _i, _len, _ref;
            for (null == cancelIfNecessary && (cancelIfNecessary = !1), _ref = this.files.slice(), 
            _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], (file.status !== Dropzone.UPLOADING || cancelIfNecessary) && this.removeFile(file);
            return null;
        }, Dropzone.prototype.createThumbnail = function(file, callback) {
            var fileReader;
            return fileReader = new FileReader(), fileReader.onload = function(_this) {
                return function() {
                    return "image/svg+xml" === file.type ? (_this.emit("thumbnail", file, fileReader.result), 
                    void (null != callback && callback())) : _this.createThumbnailFromUrl(file, fileReader.result, callback);
                };
            }(this), fileReader.readAsDataURL(file);
        }, Dropzone.prototype.createThumbnailFromUrl = function(file, imageUrl, callback, crossOrigin) {
            var img;
            return img = document.createElement("img"), crossOrigin && (img.crossOrigin = crossOrigin), 
            img.onload = function(_this) {
                return function() {
                    var canvas, ctx, resizeInfo, thumbnail, _ref, _ref1, _ref2, _ref3;
                    if (file.width = img.width, file.height = img.height, resizeInfo = _this.options.resize.call(_this, file), 
                    null == resizeInfo.trgWidth && (resizeInfo.trgWidth = resizeInfo.optWidth), null == resizeInfo.trgHeight && (resizeInfo.trgHeight = resizeInfo.optHeight), 
                    canvas = document.createElement("canvas"), ctx = canvas.getContext("2d"), canvas.width = resizeInfo.trgWidth, 
                    canvas.height = resizeInfo.trgHeight, drawImageIOSFix(ctx, img, null != (_ref = resizeInfo.srcX) ? _ref : 0, null != (_ref1 = resizeInfo.srcY) ? _ref1 : 0, resizeInfo.srcWidth, resizeInfo.srcHeight, null != (_ref2 = resizeInfo.trgX) ? _ref2 : 0, null != (_ref3 = resizeInfo.trgY) ? _ref3 : 0, resizeInfo.trgWidth, resizeInfo.trgHeight), 
                    thumbnail = canvas.toDataURL("image/png"), _this.emit("thumbnail", file, thumbnail), 
                    null != callback) return callback();
                };
            }(this), null != callback && (img.onerror = callback), img.src = imageUrl;
        }, Dropzone.prototype.processQueue = function() {
            var i, parallelUploads, processingLength, queuedFiles;
            if (parallelUploads = this.options.parallelUploads, processingLength = this.getUploadingFiles().length, 
            i = processingLength, !(processingLength >= parallelUploads) && (queuedFiles = this.getQueuedFiles(), 
            queuedFiles.length > 0)) {
                if (this.options.uploadMultiple) return this.processFiles(queuedFiles.slice(0, parallelUploads - processingLength));
                for (;i < parallelUploads; ) {
                    if (!queuedFiles.length) return;
                    this.processFile(queuedFiles.shift()), i++;
                }
            }
        }, Dropzone.prototype.processFile = function(file) {
            return this.processFiles([ file ]);
        }, Dropzone.prototype.processFiles = function(files) {
            var file, _i, _len;
            for (_i = 0, _len = files.length; _i < _len; _i++) file = files[_i], file.processing = !0, 
            file.status = Dropzone.UPLOADING, this.emit("processing", file);
            return this.options.uploadMultiple && this.emit("processingmultiple", files), this.uploadFiles(files);
        }, Dropzone.prototype._getFilesWithXhr = function(xhr) {
            var file;
            return function() {
                var _i, _len, _ref, _results;
                for (_ref = this.files, _results = [], _i = 0, _len = _ref.length; _i < _len; _i++) file = _ref[_i], 
                file.xhr === xhr && _results.push(file);
                return _results;
            }.call(this);
        }, Dropzone.prototype.cancelUpload = function(file) {
            var groupedFile, groupedFiles, _i, _j, _len, _len1, _ref;
            if (file.status === Dropzone.UPLOADING) {
                for (groupedFiles = this._getFilesWithXhr(file.xhr), _i = 0, _len = groupedFiles.length; _i < _len; _i++) groupedFile = groupedFiles[_i], 
                groupedFile.status = Dropzone.CANCELED;
                for (file.xhr.abort(), _j = 0, _len1 = groupedFiles.length; _j < _len1; _j++) groupedFile = groupedFiles[_j], 
                this.emit("canceled", groupedFile);
                this.options.uploadMultiple && this.emit("canceledmultiple", groupedFiles);
            } else (_ref = file.status) !== Dropzone.ADDED && _ref !== Dropzone.QUEUED || (file.status = Dropzone.CANCELED, 
            this.emit("canceled", file), this.options.uploadMultiple && this.emit("canceledmultiple", [ file ]));
            if (this.options.autoProcessQueue) return this.processQueue();
        }, resolveOption = function() {
            var args, option;
            return option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [], 
            "function" == typeof option ? option.apply(this, args) : option;
        }, Dropzone.prototype.uploadFile = function(file) {
            return this.uploadFiles([ file ]);
        }, Dropzone.prototype.uploadFiles = function(files) {
            var file, formData, handleError, headerName, headerValue, headers, i, input, inputName, inputType, key, method, option, progressObj, response, updateProgress, url, value, xhr, _i, _j, _k, _l, _len, _len1, _len2, _len3, _m, _ref, _ref1, _ref2, _ref3, _ref4, _ref5;
            for (xhr = new XMLHttpRequest(), _i = 0, _len = files.length; _i < _len; _i++) file = files[_i], 
            file.xhr = xhr;
            method = resolveOption(this.options.method, files), url = resolveOption(this.options.url, files), 
            xhr.open(method, url, !0), xhr.withCredentials = !!this.options.withCredentials, 
            response = null, handleError = function(_this) {
                return function() {
                    var _j, _len1, _results;
                    for (_results = [], _j = 0, _len1 = files.length; _j < _len1; _j++) file = files[_j], 
                    _results.push(_this._errorProcessing(files, response || _this.options.dictResponseError.replace("{{statusCode}}", xhr.status), xhr));
                    return _results;
                };
            }(this), updateProgress = function(_this) {
                return function(e) {
                    var allFilesFinished, progress, _j, _k, _l, _len1, _len2, _len3, _results;
                    if (null != e) for (progress = 100 * e.loaded / e.total, _j = 0, _len1 = files.length; _j < _len1; _j++) file = files[_j], 
                    file.upload = {
                        progress: progress,
                        total: e.total,
                        bytesSent: e.loaded
                    }; else {
                        for (allFilesFinished = !0, progress = 100, _k = 0, _len2 = files.length; _k < _len2; _k++) file = files[_k], 
                        100 === file.upload.progress && file.upload.bytesSent === file.upload.total || (allFilesFinished = !1), 
                        file.upload.progress = progress, file.upload.bytesSent = file.upload.total;
                        if (allFilesFinished) return;
                    }
                    for (_results = [], _l = 0, _len3 = files.length; _l < _len3; _l++) file = files[_l], 
                    _results.push(_this.emit("uploadprogress", file, progress, file.upload.bytesSent));
                    return _results;
                };
            }(this), xhr.onload = function(_this) {
                return function(e) {
                    var _ref;
                    if (files[0].status !== Dropzone.CANCELED && 4 === xhr.readyState) {
                        if (response = xhr.responseText, xhr.getResponseHeader("content-type") && ~xhr.getResponseHeader("content-type").indexOf("application/json")) try {
                            response = JSON.parse(response);
                        } catch (_error) {
                            e = _error, response = "Invalid JSON response from server.";
                        }
                        return updateProgress(), 200 <= (_ref = xhr.status) && _ref < 300 ? _this._finished(files, response, e) : handleError();
                    }
                };
            }(this), xhr.onerror = function(_this) {
                return function() {
                    if (files[0].status !== Dropzone.CANCELED) return handleError();
                };
            }(), progressObj = null != (_ref = xhr.upload) ? _ref : xhr, progressObj.onprogress = updateProgress, 
            headers = {
                Accept: "application/json",
                "Cache-Control": "no-cache",
                "X-Requested-With": "XMLHttpRequest"
            }, this.options.headers && extend(headers, this.options.headers);
            for (headerName in headers) (headerValue = headers[headerName]) && xhr.setRequestHeader(headerName, headerValue);
            if (formData = new FormData(), this.options.params) {
                _ref1 = this.options.params;
                for (key in _ref1) value = _ref1[key], formData.append(key, value);
            }
            for (_j = 0, _len1 = files.length; _j < _len1; _j++) file = files[_j], this.emit("sending", file, xhr, formData);
            if (this.options.uploadMultiple && this.emit("sendingmultiple", files, xhr, formData), 
            "FORM" === this.element.tagName) for (_ref2 = this.element.querySelectorAll("input, textarea, select, button"), 
            _k = 0, _len2 = _ref2.length; _k < _len2; _k++) if (input = _ref2[_k], inputName = input.getAttribute("name"), 
            inputType = input.getAttribute("type"), "SELECT" === input.tagName && input.hasAttribute("multiple")) for (_ref3 = input.options, 
            _l = 0, _len3 = _ref3.length; _l < _len3; _l++) option = _ref3[_l], option.selected && formData.append(inputName, option.value); else (!inputType || "checkbox" !== (_ref4 = inputType.toLowerCase()) && "radio" !== _ref4 || input.checked) && formData.append(inputName, input.value);
            for (i = _m = 0, _ref5 = files.length - 1; 0 <= _ref5 ? _m <= _ref5 : _m >= _ref5; i = 0 <= _ref5 ? ++_m : --_m) formData.append(this._getParamName(i), files[i], this._renameFilename(files[i].name));
            return this.submitRequest(xhr, formData, files);
        }, Dropzone.prototype.submitRequest = function(xhr, formData, files) {
            return xhr.send(formData);
        }, Dropzone.prototype._finished = function(files, responseText, e) {
            var file, _i, _len;
            for (_i = 0, _len = files.length; _i < _len; _i++) file = files[_i], file.status = Dropzone.SUCCESS, 
            this.emit("success", file, responseText, e), this.emit("complete", file);
            if (this.options.uploadMultiple && (this.emit("successmultiple", files, responseText, e), 
            this.emit("completemultiple", files)), this.options.autoProcessQueue) return this.processQueue();
        }, Dropzone.prototype._errorProcessing = function(files, message, xhr) {
            var file, _i, _len;
            for (_i = 0, _len = files.length; _i < _len; _i++) file = files[_i], file.status = Dropzone.ERROR, 
            this.emit("error", file, message, xhr), this.emit("complete", file);
            if (this.options.uploadMultiple && (this.emit("errormultiple", files, message, xhr), 
            this.emit("completemultiple", files)), this.options.autoProcessQueue) return this.processQueue();
        }, Dropzone;
    }(Emitter), Dropzone.version = "4.3.0", Dropzone.options = {}, Dropzone.optionsForElement = function(element) {
        return element.getAttribute("id") ? Dropzone.options[camelize(element.getAttribute("id"))] : void 0;
    }, Dropzone.instances = [], Dropzone.forElement = function(element) {
        if ("string" == typeof element && (element = document.querySelector(element)), null == (null != element ? element.dropzone : void 0)) throw new Error("No Dropzone found for given element. This is probably because you're trying to access it before Dropzone had the time to initialize. Use the `init` option to setup any additional observers on your Dropzone.");
        return element.dropzone;
    }, Dropzone.autoDiscover = !0, Dropzone.discover = function() {
        var checkElements, dropzone, dropzones, _i, _len, _results;
        for (document.querySelectorAll ? dropzones = document.querySelectorAll(".dropzone") : (dropzones = [], 
        checkElements = function(elements) {
            var el, _i, _len, _results;
            for (_results = [], _i = 0, _len = elements.length; _i < _len; _i++) el = elements[_i], 
            /(^| )dropzone($| )/.test(el.className) ? _results.push(dropzones.push(el)) : _results.push(void 0);
            return _results;
        }, checkElements(document.getElementsByTagName("div")), checkElements(document.getElementsByTagName("form"))), 
        _results = [], _i = 0, _len = dropzones.length; _i < _len; _i++) dropzone = dropzones[_i], 
        !1 !== Dropzone.optionsForElement(dropzone) ? _results.push(new Dropzone(dropzone)) : _results.push(void 0);
        return _results;
    }, Dropzone.blacklistedBrowsers = [ /opera.*Macintosh.*version\/12/i ], Dropzone.isBrowserSupported = function() {
        var capableBrowser, regex, _i, _len, _ref;
        if (capableBrowser = !0, window.File && window.FileReader && window.FileList && window.Blob && window.FormData && document.querySelector) if ("classList" in document.createElement("a")) for (_ref = Dropzone.blacklistedBrowsers, 
        _i = 0, _len = _ref.length; _i < _len; _i++) regex = _ref[_i], regex.test(navigator.userAgent) && (capableBrowser = !1); else capableBrowser = !1; else capableBrowser = !1;
        return capableBrowser;
    }, without = function(list, rejectedItem) {
        var item, _i, _len, _results;
        for (_results = [], _i = 0, _len = list.length; _i < _len; _i++) (item = list[_i]) !== rejectedItem && _results.push(item);
        return _results;
    }, camelize = function(str) {
        return str.replace(/[\-_](\w)/g, function(match) {
            return match.charAt(1).toUpperCase();
        });
    }, Dropzone.createElement = function(string) {
        var div;
        return div = document.createElement("div"), div.innerHTML = string, div.childNodes[0];
    }, Dropzone.elementInside = function(element, container) {
        if (element === container) return !0;
        for (;element = element.parentNode; ) if (element === container) return !0;
        return !1;
    }, Dropzone.getElement = function(el, name) {
        var element;
        if ("string" == typeof el ? element = document.querySelector(el) : null != el.nodeType && (element = el), 
        null == element) throw new Error("Invalid `" + name + "` option provided. Please provide a CSS selector or a plain HTML element.");
        return element;
    }, Dropzone.getElements = function(els, name) {
        var el, elements, _i, _j, _len, _len1, _ref;
        if (els instanceof Array) {
            elements = [];
            try {
                for (_i = 0, _len = els.length; _i < _len; _i++) el = els[_i], elements.push(this.getElement(el, name));
            } catch (_error) {
                _error, elements = null;
            }
        } else if ("string" == typeof els) for (elements = [], _ref = document.querySelectorAll(els), 
        _j = 0, _len1 = _ref.length; _j < _len1; _j++) el = _ref[_j], elements.push(el); else null != els.nodeType && (elements = [ els ]);
        if (null == elements || !elements.length) throw new Error("Invalid `" + name + "` option provided. Please provide a CSS selector, a plain HTML element or a list of those.");
        return elements;
    }, Dropzone.confirm = function(question, accepted, rejected) {
        return window.confirm(question) ? accepted() : null != rejected ? rejected() : void 0;
    }, Dropzone.isValidFile = function(file, acceptedFiles) {
        var baseMimeType, mimeType, validType, _i, _len;
        if (!acceptedFiles) return !0;
        for (acceptedFiles = acceptedFiles.split(","), mimeType = file.type, baseMimeType = mimeType.replace(/\/.*$/, ""), 
        _i = 0, _len = acceptedFiles.length; _i < _len; _i++) if (validType = acceptedFiles[_i], 
        validType = validType.trim(), "." === validType.charAt(0)) {
            if (-1 !== file.name.toLowerCase().indexOf(validType.toLowerCase(), file.name.length - validType.length)) return !0;
        } else if (/\/\*$/.test(validType)) {
            if (baseMimeType === validType.replace(/\/.*$/, "")) return !0;
        } else if (mimeType === validType) return !0;
        return !1;
    }, "undefined" != typeof jQuery && null !== jQuery && (jQuery.fn.dropzone = function(options) {
        return this.each(function() {
            return new Dropzone(this, options);
        });
    }), "undefined" != typeof module && null !== module ? module.exports = Dropzone : window.Dropzone = Dropzone, 
    Dropzone.ADDED = "added", Dropzone.QUEUED = "queued", Dropzone.ACCEPTED = Dropzone.QUEUED, 
    Dropzone.UPLOADING = "uploading", Dropzone.PROCESSING = Dropzone.UPLOADING, Dropzone.CANCELED = "canceled", 
    Dropzone.ERROR = "error", Dropzone.SUCCESS = "success", detectVerticalSquash = function(img) {
        var alpha, canvas, ctx, data, ey, ih, py, ratio, sy;
        for (img.naturalWidth, ih = img.naturalHeight, canvas = document.createElement("canvas"), 
        canvas.width = 1, canvas.height = ih, ctx = canvas.getContext("2d"), ctx.drawImage(img, 0, 0), 
        data = ctx.getImageData(0, 0, 1, ih).data, sy = 0, ey = ih, py = ih; py > sy; ) alpha = data[4 * (py - 1) + 3], 
        0 === alpha ? ey = py : sy = py, py = ey + sy >> 1;
        return ratio = py / ih, 0 === ratio ? 1 : ratio;
    }, drawImageIOSFix = function(ctx, img, sx, sy, sw, sh, dx, dy, dw, dh) {
        var vertSquashRatio;
        return vertSquashRatio = detectVerticalSquash(img), ctx.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh / vertSquashRatio);
    }, contentLoaded = function(win, fn) {
        var add, doc, done, init, poll, pre, rem, root, top;
        if (done = !1, top = !0, doc = win.document, root = doc.documentElement, add = doc.addEventListener ? "addEventListener" : "attachEvent", 
        rem = doc.addEventListener ? "removeEventListener" : "detachEvent", pre = doc.addEventListener ? "" : "on", 
        init = function(e) {
            if ("readystatechange" !== e.type || "complete" === doc.readyState) return ("load" === e.type ? win : doc)[rem](pre + e.type, init, !1), 
            !done && (done = !0) ? fn.call(win, e.type || e) : void 0;
        }, poll = function() {
            try {
                root.doScroll("left");
            } catch (_error) {
                return _error, void setTimeout(poll, 50);
            }
            return init("poll");
        }, "complete" !== doc.readyState) {
            if (doc.createEventObject && root.doScroll) {
                try {
                    top = !win.frameElement;
                } catch (_error) {}
                top && poll();
            }
            return doc[add](pre + "DOMContentLoaded", init, !1), doc[add](pre + "readystatechange", init, !1), 
            win[add](pre + "load", init, !1);
        }
    }, Dropzone._autoDiscoverFunction = function() {
        if (Dropzone.autoDiscover) return Dropzone.discover();
    }, contentLoaded(window, Dropzone._autoDiscoverFunction);
}.call(this), function($) {
    $.fn.hamburger = function(options) {
        return this.each(function() {
            var scrollTopPos, defaults = {
                navTarget: ".nav-wrap",
                isToggle: !1,
                btnToggle: ".nav-open",
                toggleClass: "nav-toggle-active",
                btnOpen: ".nav-open",
                btnClose: ".nav-close",
                doHide: !0,
                activeClass: "nav-active"
            }, settings = $.extend({}, defaults, options), allowScrolling = !0, plugin = {
                init: function() {
                    settings.isToggle ? plugin.startToggle() : (plugin.startNoToggle(), settings.doHide && plugin.hideOpen());
                },
                startToggle: function() {
                    $(settings.btnToggle).on("click", function(e) {
                        e.preventDefault(), console.log("Hamburger Menu : Click Toggle"), $(settings.btnToggle).hasClass(settings.toggleClass) ? ($(settings.btnToggle).removeClass(settings.toggleClass), 
                        plugin.hamClose()) : ($(settings.btnToggle).addClass(settings.toggleClass), plugin.hamOpen());
                    });
                },
                startNoToggle: function() {
                    $(settings.btnOpen).on("click", function(e) {
                        e.preventDefault(), plugin.hamOpen(), settings.doHide && plugin.hideOpen();
                    }), $(settings.btnClose).on("click", function(e) {
                        e.preventDefault(), plugin.hamClose(), settings.doHide && plugin.hideClose();
                    });
                },
                hideOpen: function() {
                    $(settings.btnClose).show(), $(settings.btnOpen).hide();
                },
                hideClose: function() {
                    $(settings.btnClose).hide(), $(settings.btnOpen).show();
                },
                hamOpen: function() {
                    allowScrolling = !1, scrollTopPos = $(document).scrollTop(), $(settings.navTarget).addClass(settings.activeClass), 
                    $("#content-main").addClass("content-active");
                },
                hamClose: function() {
                    allowScrolling = !0, $(settings.navTarget).removeClass(settings.activeClass), $("#content-main").removeClass("content-active");
                }
            };
            plugin.init();
        });
    };
}(jQuery), $(function() {
    function parseStringForUrl(raw) {
        for (var toDashes = [ " ", "/", "\\", "-", "=", "+" ], parsed = raw.trim(), i = 0; i < toDashes.length; i++) {
            var char = toDashes[i];
            parsed = parsed.split(char).join(" ");
        }
        return parsed = parsed.replace(/[^0-9a-z \-]/gi, ""), parsed = parsed.split(" ").join("-"), 
        parsed.toLowerCase();
    }
    function saveEditing() {
        console.log("save");
        var $tr = $(this).parents("tr");
        $tr.addClass("pending"), $tr.removeClass("editing"), $tr.find(".options-editing").hide(), 
        $tr.find("select.group_id").hide(), $tr.find(".options-not-editing").show();
        var i = 0, id = $tr.attr("data-id");
        $tr.find("td.permissionsblock").each(function() {
            var newpermval = $(this).find(".permissions-select").find("select[name='permissionselect'] option:selected").val(), newpermtext = $(this).find(".permissions-select").find("select[name='permissionselect'] option:selected").text();
            $tr.find(".permissions-text").html(newpermtext), $(this).find(".permissions-select").hide(), 
            $(this).find(".permissions-text").show();
            var inputHtml = '<input type="hidden" name="permission[]" value="' + newpermval + '" />';
            $(this).find(".input").html(inputHtml);
        }), i = 0, $tr.find("td.editable").each(function() {
            var newval = $(this).find("input").val();
            $(this).find(".text").text(newval), $(this).find(".text").show(), $(this).find("input").attr("type", "hidden"), 
            0 != i || $(this).find(".input").find("input.id_holder").length || $(this).find(".input").append('<input type="hidden" class="id_holder" name="id[]" value="' + id + '" />'), 
            i++;
        });
    }
    function cancelEditing() {
        console.log("cancel");
        var $tr = $(this).parents("tr");
        $tr.removeClass("editing"), $tr.find(".options-editing").hide(), $tr.find("select.group_id").remove(), 
        $tr.find(".options-not-editing").show(), $tr.find(".permissions-text").show(), $tr.find(".permissions-select").hide(), 
        $tr.find("td.editable").each(function() {
            $(this).find(".text").show(), $(this).find(".input").html("");
        });
    }
    $(".LimitChar").limitinput(), $("#nav-main").hamburger(), $(".timepicker").pickatime(), 
    $(".datepicker").pikaday({
        firstDay: 1,
        format: "MM/DD/YYYY",
        onOpen: function(e) {
            console.log(e);
        }
    }).on("focus blur", function() {
        $(this).keyup();
    }), $(".disabled :input").attr("disabled", !0);
    $("#nav-main li:not(.nav-active-sub) ol").hide();
    $(".nav-menu > a").click(function(event) {
        if ($(this).parent().has("ol").length > 0) if (event.preventDefault(), $(this).parent().hasClass("nav-active-sub")) $(this).parent().parent().find(".nav-menu").removeClass("nav-active-sub"), 
        $(this).parent().parent().find(".nav-menu").find("ol").slideUp(); else {
            var d = 0;
            d = $("#nav-main").has(".nav-active-sub").length > 0 ? 300 : 0, $(this).parent().parent().find(".nav-menu").removeClass("nav-active-sub"), 
            $(this).parent().parent().find(".nav-menu").find("ol").slideUp(), $(this).parent().find("ol").delay(d).slideDown(), 
            $(this).parent().delay(d).addClass("nav-active-sub");
        }
    }), $("form.event.new #title").change(function() {
        console.log("changed title");
        for (var raw = $("form.new #title").val().trim(), toDashes = [ " ", "/", "\\", "-", "=", "+" ], parsed = raw.trim(), i = 0; i < toDashes.length; i++) {
            var char = toDashes[i];
            parsed = parsed.split(char).join(" ");
        }
        parsed = parsed.trim(), parsed = parsed.split(" ").join("-"), parsed = parsed.replace(/[^0-9a-z \-]/gi, ""), 
        $("form.new #friendlyurl").val("/events/" + parsed.toLowerCase());
    }), $("form.news.new #title").change(function() {
        var raw = $("form.new #title").val().trim(), parsed = parseStringForUrl(raw);
        $("form.new #friendlyurl").val("/news/" + parsed);
    }), $("#saveall").click(function(e) {
        e.preventDefault(), $("tr.editing a.save").click(), $(this).parents("form").focus().submit();
    }), $(".tabs-nav").click(function() {
        var tabname = $(this).attr("data-tab");
        $(".tabs-nav").each(function() {
            $(this).attr("data-tab") == tabname ? $(this).addClass("active") : $(this).removeClass("active");
        }), $("table").each(function() {
            $(this).attr("data-tab") == tabname ? $(this).show() : $(this).hide();
        });
    }), $(".button.edit").click(function(e) {
        e.preventDefault();
        var $tr = $(this).parents("tr");
        if ($tr.find(".options-editing").show(), $tr.find(".options-not-editing").hide(), 
        $tr.find(".cancel").click(cancelEditing), $tr.find(".save").click(saveEditing), 
        $tr.addClass("editing"), $tr.find("td.editable").each(function() {
            $(this).find(".text").hide();
            var val = $(this).find(".text").text(), type = $(this).attr("data-val"), inputHtml = '<input type="text" name="' + type + '[]" value="' + val + '" />';
            $(this).find(".input").html(inputHtml);
        }), $tr.find("select.group_id").length) $tr.find("select.group_id").show(); else {
            var activeId = $("span.tabs-nav.active").attr("data-tabid"), dropdown = '<select name="group_id[]" class="group_id">';
            $("span.tabs-nav").each(function() {
                var thisid = $(this).attr("data-tabid");
                dropdown += "<option " + (thisid == activeId ? ' selected="selected" ' : "") + ' value="' + thisid + '">' + $(this).attr("data-tab") + "</option>";
            }), dropdown += "</select>", $tr.find(".options-editing").prepend(dropdown);
        }
        $tr.find("td.permissionsblock").each(function() {
            $(this).find(".permissions-select").show(), $(this).find(".permissions-text").hide();
        });
    }), $(".button.delete").click(function(e) {}), $(window).ready(function() {
        $(".chosen").chosen({
            width: "100%"
        });
    }), $(document).tooltip({
        items: ".admin-image-rollover",
        content: function() {
            $(this);
            return '<img src="' + $(this).attr("data-rollover") + '" />';
        },
        track: !0
    }), Dropzone.options.dropzone = {
        init: function() {
            this.on("complete", function(file) {
                console.log(file.xhr.response);
                var data = file.xhr.response.split(","), filename = data[0], order = data[1], html = '<li class="admin-section-t2"><ul>';
                html += '<input type="hidden" name="image_displayorder[]" value="' + order + '" >', 
                html += '<li class="lbl-hint col  btm-margin"><label for="image_title[]" class="show">Title</label>', 
                html += '<input name="image_title[]" id="image_title[]" type="text" placeholder="Title" value="">', 
                html += '</li><li class="col"><label for="image_image[]">Image</label><br><div class="admin-image-show">', 
                html += '<img class="admin-image-rollover" data-rollover="/assets/images/galleries/rollover/' + filename + '"', 
                html += 'src="/assets/images/galleries/cms/' + filename + '"></div><input name="image_image[]" id="image_image[]" type="file"></li>', 
                html += '<input type="hidden" name="image_imagefile[]" value="' + filename + '">', 
                html += '<select name="image_delete[]"><option value="0" selected="selected">Active</option><option value="1">Delete</option></select></ul></li>', 
                $("#meta").append(html), $("input[name=cancel]").remove();
            });
        }
    }, $(".generate-url").each(function() {
        $li = $(this), $friendlyUrlInput = $li.find("input");
        var deriveFrom = $li.attr("data-derive-from"), prefix = $li.attr("data-prefix");
        $("#" + deriveFrom).change(function() {
            $stringInput = $(this);
            var parsed = parseStringForUrl($stringInput.val());
            prefix.length ? $friendlyUrlInput.val("/" + prefix + "/" + parsed) : $friendlyUrlInput.val("/" + parsed), 
            $(".generate-admin-key")[0] && (console.log(".generate-admin-key"), $(".generate-admin-key").each(function() {
                $li = $(this), $adminKeyInput = $li.find("input");
                var prefix = $li.attr("data-prefix");
                1 != $li.attr("data-locked") && (prefix.length ? $adminKeyInput.val(prefix + "-" + parsed) : $adminKeyInput.val(parsed));
            }));
        });
    }), $(".generate-admin-key").each(function() {
        $li = $(this), $adminKeyInput = $li.find("input");
        var deriveFrom = $li.attr("data-derive-from"), prefix = $li.attr("data-prefix");
        1 != $li.attr("data-locked") && $("#" + deriveFrom).change(function() {
            $stringInput = $(this);
            var parsed = parseStringForUrl($stringInput.val());
            prefix.length ? $adminKeyInput.val(prefix + "-" + parsed) : $adminKeyInput.val(parsed);
        });
    }), $("div.tabheader > a").click(function() {
        var tabgroup = $(this).parent().attr("data-tabgroup"), tabName = $(this).attr("data-tab");
        $("div[data-tabgroup=" + tabgroup + "] > a").each(function() {
            $(this).removeClass("active");
        }), $(this).addClass("active"), $("div.tabcontents[data-tabgroup=" + tabgroup + "] > div").each(function() {
            $(this).attr("data-tab") == tabName ? $(this).addClass("active") : $(this).removeClass("active");
        });
    }), $(".saveSortable").sortable({
        stop: function() {
            var $el = $(this), url = $el.attr("data-save-url");
            console.log(url);
            var orders = [];
            $el.children().each(function() {
                orders.push($(this).attr("data-id"));
            }), console.log(orders), $.get(url, {
                orders: orders
            }, function() {
                console.log("saved");
            });
        }
    }), document.deleteSortable = function(element) {
        if (confirm("Are you sure you want to delete this item?")) {
            var $parent = $(element).closest(".saveSortable"), url = $parent.attr("data-delete-url"), $row = $(element).closest(".sortableRow"), id = $row.attr("data-id");
            $.get(url, {
                id: id
            }, function() {
                $row.remove();
            });
        }
    }, document.editSortable = function(element) {
        var $this = $(element), $row = $this.closest(".sortableRow"), $editable = $row.find(".editSortable"), val = ($editable.attr("data-edit-name"), 
        $editable.text()), editHtml = '<input type="text" value="' + val + '" />';
        $editable.html(editHtml);
        var $editButton = $row.find(".editSortableButton");
        $editButton.text("Save"), $editButton.attr("onclick", "saveEditSortable(this)");
    }, document.saveEditSortable = function(element) {
        var $this = $(element), $parent = $this.closest(".saveSortable"), $row = $this.closest(".sortableRow"), $editable = $row.find(".editSortable"), $input = $row.find("input[type=text]"), val = $input.val(), url = $parent.attr("data-edit-url"), data = {
            id: $row.attr("data-id")
        };
        data[$editable.attr("data-edit-name")] = val, $.get(url, data, function() {
            var $editButton = $row.find(".editSortableButton");
            $editButton.attr("onclick", "editSortable(this)"), $editButton.text("Edit"), $editable.empty(), 
            $editable.text(val), console.log(val);
        });
    };
}), function(t) {
    "function" == typeof define && define.amd ? define([ "jquery" ], t) : t(jQuery);
}(function(t) {
    function e(e, s) {
        var n, a, o, r = e.nodeName.toLowerCase();
        return "area" === r ? (n = e.parentNode, a = n.name, !(!e.href || !a || "map" !== n.nodeName.toLowerCase()) && (!!(o = t("img[usemap='#" + a + "']")[0]) && i(o))) : (/^(input|select|textarea|button|object)$/.test(r) ? !e.disabled : "a" === r ? e.href || s : s) && i(e);
    }
    function i(e) {
        return t.expr.filters.visible(e) && !t(e).parents().addBack().filter(function() {
            return "hidden" === t.css(this, "visibility");
        }).length;
    }
    t.ui = t.ui || {}, t.extend(t.ui, {
        version: "1.11.4",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), t.fn.extend({
        scrollParent: function(e) {
            var i = this.css("position"), s = "absolute" === i, n = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/, a = this.parents().filter(function() {
                var e = t(this);
                return (!s || "static" !== e.css("position")) && n.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"));
            }).eq(0);
            return "fixed" !== i && a.length ? a : t(this[0].ownerDocument || document);
        },
        uniqueId: function() {
            var t = 0;
            return function() {
                return this.each(function() {
                    this.id || (this.id = "ui-id-" + ++t);
                });
            };
        }(),
        removeUniqueId: function() {
            return this.each(function() {
                /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id");
            });
        }
    }), t.extend(t.expr[":"], {
        data: t.expr.createPseudo ? t.expr.createPseudo(function(e) {
            return function(i) {
                return !!t.data(i, e);
            };
        }) : function(e, i, s) {
            return !!t.data(e, s[3]);
        },
        focusable: function(i) {
            return e(i, !isNaN(t.attr(i, "tabindex")));
        },
        tabbable: function(i) {
            var s = t.attr(i, "tabindex"), n = isNaN(s);
            return (n || s >= 0) && e(i, !n);
        }
    }), t("<a>").outerWidth(1).jquery || t.each([ "Width", "Height" ], function(e, i) {
        function s(e, i, s, a) {
            return t.each(n, function() {
                i -= parseFloat(t.css(e, "padding" + this)) || 0, s && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), 
                a && (i -= parseFloat(t.css(e, "margin" + this)) || 0);
            }), i;
        }
        var n = "Width" === i ? [ "Left", "Right" ] : [ "Top", "Bottom" ], a = i.toLowerCase(), o = {
            innerWidth: t.fn.innerWidth,
            innerHeight: t.fn.innerHeight,
            outerWidth: t.fn.outerWidth,
            outerHeight: t.fn.outerHeight
        };
        t.fn["inner" + i] = function(e) {
            return void 0 === e ? o["inner" + i].call(this) : this.each(function() {
                t(this).css(a, s(this, e) + "px");
            });
        }, t.fn["outer" + i] = function(e, n) {
            return "number" != typeof e ? o["outer" + i].call(this, e) : this.each(function() {
                t(this).css(a, s(this, e, !0, n) + "px");
            });
        };
    }), t.fn.addBack || (t.fn.addBack = function(t) {
        return this.add(null == t ? this.prevObject : this.prevObject.filter(t));
    }), t("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (t.fn.removeData = function(e) {
        return function(i) {
            return arguments.length ? e.call(this, t.camelCase(i)) : e.call(this);
        };
    }(t.fn.removeData)), t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), 
    t.fn.extend({
        focus: function(e) {
            return function(i, s) {
                return "number" == typeof i ? this.each(function() {
                    var e = this;
                    setTimeout(function() {
                        t(e).focus(), s && s.call(e);
                    }, i);
                }) : e.apply(this, arguments);
            };
        }(t.fn.focus),
        disableSelection: function() {
            var t = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
            return function() {
                return this.bind(t + ".ui-disableSelection", function(t) {
                    t.preventDefault();
                });
            };
        }(),
        enableSelection: function() {
            return this.unbind(".ui-disableSelection");
        },
        zIndex: function(e) {
            if (void 0 !== e) return this.css("zIndex", e);
            if (this.length) for (var i, s, n = t(this[0]); n.length && n[0] !== document; ) {
                if (("absolute" === (i = n.css("position")) || "relative" === i || "fixed" === i) && (s = parseInt(n.css("zIndex"), 10), 
                !isNaN(s) && 0 !== s)) return s;
                n = n.parent();
            }
            return 0;
        }
    }), t.ui.plugin = {
        add: function(e, i, s) {
            var n, a = t.ui[e].prototype;
            for (n in s) a.plugins[n] = a.plugins[n] || [], a.plugins[n].push([ i, s[n] ]);
        },
        call: function(t, e, i, s) {
            var n, a = t.plugins[e];
            if (a && (s || t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType)) for (n = 0; a.length > n; n++) t.options[a[n][0]] && a[n][1].apply(t.element, i);
        }
    };
    var s = 0, n = Array.prototype.slice;
    t.cleanData = function(e) {
        return function(i) {
            var s, n, a;
            for (a = 0; null != (n = i[a]); a++) try {
                (s = t._data(n, "events")) && s.remove && t(n).triggerHandler("remove");
            } catch (o) {}
            e(i);
        };
    }(t.cleanData), t.widget = function(e, i, s) {
        var n, a, o, r, h = {}, l = e.split(".")[0];
        return e = e.split(".")[1], n = l + "-" + e, s || (s = i, i = t.Widget), t.expr[":"][n.toLowerCase()] = function(e) {
            return !!t.data(e, n);
        }, t[l] = t[l] || {}, a = t[l][e], o = t[l][e] = function(t, e) {
            return this._createWidget ? void (arguments.length && this._createWidget(t, e)) : new o(t, e);
        }, t.extend(o, a, {
            version: s.version,
            _proto: t.extend({}, s),
            _childConstructors: []
        }), r = new i(), r.options = t.widget.extend({}, r.options), t.each(s, function(e, s) {
            return t.isFunction(s) ? void (h[e] = function() {
                var t = function() {
                    return i.prototype[e].apply(this, arguments);
                }, n = function(t) {
                    return i.prototype[e].apply(this, t);
                };
                return function() {
                    var e, i = this._super, a = this._superApply;
                    return this._super = t, this._superApply = n, e = s.apply(this, arguments), this._super = i, 
                    this._superApply = a, e;
                };
            }()) : void (h[e] = s);
        }), o.prototype = t.widget.extend(r, {
            widgetEventPrefix: a ? r.widgetEventPrefix || e : e
        }, h, {
            constructor: o,
            namespace: l,
            widgetName: e,
            widgetFullName: n
        }), a ? (t.each(a._childConstructors, function(e, i) {
            var s = i.prototype;
            t.widget(s.namespace + "." + s.widgetName, o, i._proto);
        }), delete a._childConstructors) : i._childConstructors.push(o), t.widget.bridge(e, o), 
        o;
    }, t.widget.extend = function(e) {
        for (var i, s, a = n.call(arguments, 1), o = 0, r = a.length; r > o; o++) for (i in a[o]) s = a[o][i], 
        a[o].hasOwnProperty(i) && void 0 !== s && (e[i] = t.isPlainObject(s) ? t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], s) : t.widget.extend({}, s) : s);
        return e;
    }, t.widget.bridge = function(e, i) {
        var s = i.prototype.widgetFullName || e;
        t.fn[e] = function(a) {
            var o = "string" == typeof a, r = n.call(arguments, 1), h = this;
            return o ? this.each(function() {
                var i, n = t.data(this, s);
                return "instance" === a ? (h = n, !1) : n ? t.isFunction(n[a]) && "_" !== a.charAt(0) ? (i = n[a].apply(n, r), 
                i !== n && void 0 !== i ? (h = i && i.jquery ? h.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + a + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + a + "'");
            }) : (r.length && (a = t.widget.extend.apply(null, [ a ].concat(r))), this.each(function() {
                var e = t.data(this, s);
                e ? (e.option(a || {}), e._init && e._init()) : t.data(this, s, new i(a, this));
            })), h;
        };
    }, t.Widget = function() {}, t.Widget._childConstructors = [], t.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            disabled: !1,
            create: null
        },
        _createWidget: function(e, i) {
            i = t(i || this.defaultElement || this)[0], this.element = t(i), this.uuid = s++, 
            this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = t(), this.hoverable = t(), 
            this.focusable = t(), i !== this && (t.data(i, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function(t) {
                    t.target === i && this.destroy();
                }
            }), this.document = t(i.style ? i.ownerDocument : i.document || i), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), 
            this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this._create(), 
            this._trigger("create", null, this._getCreateEventData()), this._init();
        },
        _getCreateOptions: t.noop,
        _getCreateEventData: t.noop,
        _create: t.noop,
        _init: t.noop,
        destroy: function() {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)), 
            this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), 
            this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), 
            this.focusable.removeClass("ui-state-focus");
        },
        _destroy: t.noop,
        widget: function() {
            return this.element;
        },
        option: function(e, i) {
            var s, n, a, o = e;
            if (0 === arguments.length) return t.widget.extend({}, this.options);
            if ("string" == typeof e) if (o = {}, s = e.split("."), e = s.shift(), s.length) {
                for (n = o[e] = t.widget.extend({}, this.options[e]), a = 0; s.length - 1 > a; a++) n[s[a]] = n[s[a]] || {}, 
                n = n[s[a]];
                if (e = s.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
                n[e] = i;
            } else {
                if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
                o[e] = i;
            }
            return this._setOptions(o), this;
        },
        _setOptions: function(t) {
            var e;
            for (e in t) this._setOption(e, t[e]);
            return this;
        },
        _setOption: function(t, e) {
            return this.options[t] = e, "disabled" === t && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!e), 
            e && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), 
            this;
        },
        enable: function() {
            return this._setOptions({
                disabled: !1
            });
        },
        disable: function() {
            return this._setOptions({
                disabled: !0
            });
        },
        _on: function(e, i, s) {
            var n, a = this;
            "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, 
            i = this.element, n = this.widget()), t.each(s, function(s, o) {
                function r() {
                    return e || !0 !== a.options.disabled && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof o ? a[o] : o).apply(a, arguments) : void 0;
                }
                "string" != typeof o && (r.guid = o.guid = o.guid || r.guid || t.guid++);
                var h = s.match(/^([\w:-]*)\s*(.*)$/), l = h[1] + a.eventNamespace, u = h[2];
                u ? n.delegate(u, l, r) : i.bind(l, r);
            });
        },
        _off: function(e, i) {
            i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, 
            e.unbind(i).undelegate(i), this.bindings = t(this.bindings.not(e).get()), this.focusable = t(this.focusable.not(e).get()), 
            this.hoverable = t(this.hoverable.not(e).get());
        },
        _delay: function(t, e) {
            function i() {
                return ("string" == typeof t ? s[t] : t).apply(s, arguments);
            }
            var s = this;
            return setTimeout(i, e || 0);
        },
        _hoverable: function(e) {
            this.hoverable = this.hoverable.add(e), this._on(e, {
                mouseenter: function(e) {
                    t(e.currentTarget).addClass("ui-state-hover");
                },
                mouseleave: function(e) {
                    t(e.currentTarget).removeClass("ui-state-hover");
                }
            });
        },
        _focusable: function(e) {
            this.focusable = this.focusable.add(e), this._on(e, {
                focusin: function(e) {
                    t(e.currentTarget).addClass("ui-state-focus");
                },
                focusout: function(e) {
                    t(e.currentTarget).removeClass("ui-state-focus");
                }
            });
        },
        _trigger: function(e, i, s) {
            var n, a, o = this.options[e];
            if (s = s || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), 
            i.target = this.element[0], a = i.originalEvent) for (n in a) n in i || (i[n] = a[n]);
            return this.element.trigger(i, s), !(t.isFunction(o) && !1 === o.apply(this.element[0], [ i ].concat(s)) || i.isDefaultPrevented());
        }
    }, t.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function(e, i) {
        t.Widget.prototype["_" + e] = function(s, n, a) {
            "string" == typeof n && (n = {
                effect: n
            });
            var o, r = n ? !0 === n || "number" == typeof n ? i : n.effect || i : e;
            n = n || {}, "number" == typeof n && (n = {
                duration: n
            }), o = !t.isEmptyObject(n), n.complete = a, n.delay && s.delay(n.delay), o && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, a) : s.queue(function(i) {
                t(this)[e](), a && a.call(s[0]), i();
            });
        };
    }), t.widget;
    var a = !1;
    t(document).mouseup(function() {
        a = !1;
    }), t.widget("ui.mouse", {
        version: "1.11.4",
        options: {
            cancel: "input,textarea,button,select,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function() {
            var e = this;
            this.element.bind("mousedown." + this.widgetName, function(t) {
                return e._mouseDown(t);
            }).bind("click." + this.widgetName, function(i) {
                return !0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), 
                i.stopImmediatePropagation(), !1) : void 0;
            }), this.started = !1;
        },
        _mouseDestroy: function() {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate);
        },
        _mouseDown: function(e) {
            if (!a) {
                this._mouseMoved = !1, this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                var i = this, s = 1 === e.which, n = !("string" != typeof this.options.cancel || !e.target.nodeName) && t(e.target).closest(this.options.cancel).length;
                return !(s && !n && this._mouseCapture(e)) || (this.mouseDelayMet = !this.options.delay, 
                this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                    i.mouseDelayMet = !0;
                }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(e), 
                !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), 
                this._mouseMoveDelegate = function(t) {
                    return i._mouseMove(t);
                }, this._mouseUpDelegate = function(t) {
                    return i._mouseUp(t);
                }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), 
                e.preventDefault(), a = !0, !0));
            }
        },
        _mouseMove: function(e) {
            if (this._mouseMoved) {
                if (t.ui.ie && (!document.documentMode || 9 > document.documentMode) && !e.button) return this._mouseUp(e);
                if (!e.which) return this._mouseUp(e);
            }
            return (e.which || e.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(e), 
            e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(this._mouseDownEvent, e), 
            this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted);
        },
        _mouseUp: function(e) {
            return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), 
            this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), 
            this._mouseStop(e)), a = !1, !1;
        },
        _mouseDistanceMet: function(t) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance;
        },
        _mouseDelayMet: function() {
            return this.mouseDelayMet;
        },
        _mouseStart: function() {},
        _mouseDrag: function() {},
        _mouseStop: function() {},
        _mouseCapture: function() {
            return !0;
        }
    }), function() {
        function e(t, e, i) {
            return [ parseFloat(t[0]) * (p.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (p.test(t[1]) ? i / 100 : 1) ];
        }
        function i(e, i) {
            return parseInt(t.css(e, i), 10) || 0;
        }
        function s(e) {
            var i = e[0];
            return 9 === i.nodeType ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: 0,
                    left: 0
                }
            } : t.isWindow(i) ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: e.scrollTop(),
                    left: e.scrollLeft()
                }
            } : i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {
                    top: i.pageY,
                    left: i.pageX
                }
            } : {
                width: e.outerWidth(),
                height: e.outerHeight(),
                offset: e.offset()
            };
        }
        t.ui = t.ui || {};
        var n, a, o = Math.max, r = Math.abs, h = Math.round, l = /left|center|right/, u = /top|center|bottom/, c = /[\+\-]\d+(\.[\d]+)?%?/, d = /^\w+/, p = /%$/, f = t.fn.position;
        t.position = {
            scrollbarWidth: function() {
                if (void 0 !== n) return n;
                var e, i, s = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), a = s.children()[0];
                return t("body").append(s), e = a.offsetWidth, s.css("overflow", "scroll"), i = a.offsetWidth, 
                e === i && (i = s[0].clientWidth), s.remove(), n = e - i;
            },
            getScrollInfo: function(e) {
                var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"), s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"), n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth;
                return {
                    width: "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight ? t.position.scrollbarWidth() : 0,
                    height: n ? t.position.scrollbarWidth() : 0
                };
            },
            getWithinInfo: function(e) {
                var i = t(e || window), s = t.isWindow(i[0]), n = !!i[0] && 9 === i[0].nodeType;
                return {
                    element: i,
                    isWindow: s,
                    isDocument: n,
                    offset: i.offset() || {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: s || n ? i.width() : i.outerWidth(),
                    height: s || n ? i.height() : i.outerHeight()
                };
            }
        }, t.fn.position = function(n) {
            if (!n || !n.of) return f.apply(this, arguments);
            n = t.extend({}, n);
            var p, m, g, v, _, b, y = t(n.of), x = t.position.getWithinInfo(n.within), w = t.position.getScrollInfo(x), k = (n.collision || "flip").split(" "), D = {};
            return b = s(y), y[0].preventDefault && (n.at = "left top"), m = b.width, g = b.height, 
            v = b.offset, _ = t.extend({}, v), t.each([ "my", "at" ], function() {
                var t, e, i = (n[this] || "").split(" ");
                1 === i.length && (i = l.test(i[0]) ? i.concat([ "center" ]) : u.test(i[0]) ? [ "center" ].concat(i) : [ "center", "center" ]), 
                i[0] = l.test(i[0]) ? i[0] : "center", i[1] = u.test(i[1]) ? i[1] : "center", t = c.exec(i[0]), 
                e = c.exec(i[1]), D[this] = [ t ? t[0] : 0, e ? e[0] : 0 ], n[this] = [ d.exec(i[0])[0], d.exec(i[1])[0] ];
            }), 1 === k.length && (k[1] = k[0]), "right" === n.at[0] ? _.left += m : "center" === n.at[0] && (_.left += m / 2), 
            "bottom" === n.at[1] ? _.top += g : "center" === n.at[1] && (_.top += g / 2), p = e(D.at, m, g), 
            _.left += p[0], _.top += p[1], this.each(function() {
                var s, l, u = t(this), c = u.outerWidth(), d = u.outerHeight(), f = i(this, "marginLeft"), b = i(this, "marginTop"), T = c + f + i(this, "marginRight") + w.width, S = d + b + i(this, "marginBottom") + w.height, M = t.extend({}, _), C = e(D.my, u.outerWidth(), u.outerHeight());
                "right" === n.my[0] ? M.left -= c : "center" === n.my[0] && (M.left -= c / 2), "bottom" === n.my[1] ? M.top -= d : "center" === n.my[1] && (M.top -= d / 2), 
                M.left += C[0], M.top += C[1], a || (M.left = h(M.left), M.top = h(M.top)), s = {
                    marginLeft: f,
                    marginTop: b
                }, t.each([ "left", "top" ], function(e, i) {
                    t.ui.position[k[e]] && t.ui.position[k[e]][i](M, {
                        targetWidth: m,
                        targetHeight: g,
                        elemWidth: c,
                        elemHeight: d,
                        collisionPosition: s,
                        collisionWidth: T,
                        collisionHeight: S,
                        offset: [ p[0] + C[0], p[1] + C[1] ],
                        my: n.my,
                        at: n.at,
                        within: x,
                        elem: u
                    });
                }), n.using && (l = function(t) {
                    var e = v.left - M.left, i = e + m - c, s = v.top - M.top, a = s + g - d, h = {
                        target: {
                            element: y,
                            left: v.left,
                            top: v.top,
                            width: m,
                            height: g
                        },
                        element: {
                            element: u,
                            left: M.left,
                            top: M.top,
                            width: c,
                            height: d
                        },
                        horizontal: 0 > i ? "left" : e > 0 ? "right" : "center",
                        vertical: 0 > a ? "top" : s > 0 ? "bottom" : "middle"
                    };
                    c > m && m > r(e + i) && (h.horizontal = "center"), d > g && g > r(s + a) && (h.vertical = "middle"), 
                    h.important = o(r(e), r(i)) > o(r(s), r(a)) ? "horizontal" : "vertical", n.using.call(this, t, h);
                }), u.offset(t.extend(M, {
                    using: l
                }));
            });
        }, t.ui.position = {
            fit: {
                left: function(t, e) {
                    var i, s = e.within, n = s.isWindow ? s.scrollLeft : s.offset.left, a = s.width, r = t.left - e.collisionPosition.marginLeft, h = n - r, l = r + e.collisionWidth - a - n;
                    e.collisionWidth > a ? h > 0 && 0 >= l ? (i = t.left + h + e.collisionWidth - a - n, 
                    t.left += h - i) : t.left = l > 0 && 0 >= h ? n : h > l ? n + a - e.collisionWidth : n : h > 0 ? t.left += h : l > 0 ? t.left -= l : t.left = o(t.left - r, t.left);
                },
                top: function(t, e) {
                    var i, s = e.within, n = s.isWindow ? s.scrollTop : s.offset.top, a = e.within.height, r = t.top - e.collisionPosition.marginTop, h = n - r, l = r + e.collisionHeight - a - n;
                    e.collisionHeight > a ? h > 0 && 0 >= l ? (i = t.top + h + e.collisionHeight - a - n, 
                    t.top += h - i) : t.top = l > 0 && 0 >= h ? n : h > l ? n + a - e.collisionHeight : n : h > 0 ? t.top += h : l > 0 ? t.top -= l : t.top = o(t.top - r, t.top);
                }
            },
            flip: {
                left: function(t, e) {
                    var i, s, n = e.within, a = n.offset.left + n.scrollLeft, o = n.width, h = n.isWindow ? n.scrollLeft : n.offset.left, l = t.left - e.collisionPosition.marginLeft, u = l - h, c = l + e.collisionWidth - o - h, d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0, p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0, f = -2 * e.offset[0];
                    0 > u ? (0 > (i = t.left + d + p + f + e.collisionWidth - o - a) || r(u) > i) && (t.left += d + p + f) : c > 0 && ((s = t.left - e.collisionPosition.marginLeft + d + p + f - h) > 0 || c > r(s)) && (t.left += d + p + f);
                },
                top: function(t, e) {
                    var i, s, n = e.within, a = n.offset.top + n.scrollTop, o = n.height, h = n.isWindow ? n.scrollTop : n.offset.top, l = t.top - e.collisionPosition.marginTop, u = l - h, c = l + e.collisionHeight - o - h, d = "top" === e.my[1], p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0, f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0, m = -2 * e.offset[1];
                    0 > u ? (0 > (s = t.top + p + f + m + e.collisionHeight - o - a) || r(u) > s) && (t.top += p + f + m) : c > 0 && ((i = t.top - e.collisionPosition.marginTop + p + f + m - h) > 0 || c > r(i)) && (t.top += p + f + m);
                }
            },
            flipfit: {
                left: function() {
                    t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments);
                },
                top: function() {
                    t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments);
                }
            }
        }, function() {
            var e, i, s, n, o, r = document.getElementsByTagName("body")[0], h = document.createElement("div");
            e = document.createElement(r ? "div" : "body"), s = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            }, r && t.extend(s, {
                position: "absolute",
                left: "-1000px",
                top: "-1000px"
            });
            for (o in s) e.style[o] = s[o];
            e.appendChild(h), i = r || document.documentElement, i.insertBefore(e, i.firstChild), 
            h.style.cssText = "position: absolute; left: 10.7432222px;", n = t(h).offset().left, 
            a = n > 10 && 11 > n, e.innerHTML = "", i.removeChild(e);
        }();
    }(), t.ui.position, t.widget("ui.draggable", t.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function() {
            "original" === this.options.helper && this._setPositionRelative(), this.options.addClasses && this.element.addClass("ui-draggable"), 
            this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._setHandleClassName(), 
            this._mouseInit();
        },
        _setOption: function(t, e) {
            this._super(t, e), "handle" === t && (this._removeHandleClassName(), this._setHandleClassName());
        },
        _destroy: function() {
            return (this.helper || this.element).is(".ui-draggable-dragging") ? void (this.destroyOnClear = !0) : (this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), 
            this._removeHandleClassName(), void this._mouseDestroy());
        },
        _mouseCapture: function(e) {
            var i = this.options;
            return this._blurActiveElement(e), !(this.helper || i.disabled || t(e.target).closest(".ui-resizable-handle").length > 0) && (this.handle = this._getHandle(e), 
            !!this.handle && (this._blockFrames(!0 === i.iframeFix ? "iframe" : i.iframeFix), 
            !0));
        },
        _blockFrames: function(e) {
            this.iframeBlocks = this.document.find(e).map(function() {
                var e = t(this);
                return t("<div>").css("position", "absolute").appendTo(e.parent()).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).offset(e.offset())[0];
            });
        },
        _unblockFrames: function() {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks);
        },
        _blurActiveElement: function(e) {
            var i = this.document[0];
            if (this.handleElement.is(e.target)) try {
                i.activeElement && "body" !== i.activeElement.nodeName.toLowerCase() && t(i.activeElement).blur();
            } catch (s) {}
        },
        _mouseStart: function(e) {
            var i = this.options;
            return this.helper = this._createHelper(e), this.helper.addClass("ui-draggable-dragging"), 
            this._cacheHelperProportions(), t.ui.ddmanager && (t.ui.ddmanager.current = this), 
            this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), 
            this.offsetParent = this.helper.offsetParent(), this.hasFixedAncestor = this.helper.parents().filter(function() {
                return "fixed" === t(this).css("position");
            }).length > 0, this.positionAbs = this.element.offset(), this._refreshOffsets(e), 
            this.originalPosition = this.position = this._generatePosition(e, !1), this.originalPageX = e.pageX, 
            this.originalPageY = e.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), 
            this._setContainment(), !1 === this._trigger("start", e) ? (this._clear(), !1) : (this._cacheHelperProportions(), 
            t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._normalizeRightBottom(), 
            this._mouseDrag(e, !0), t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0);
        },
        _refreshOffsets: function(t) {
            this.offset = {
                top: this.positionAbs.top - this.margins.top,
                left: this.positionAbs.left - this.margins.left,
                scroll: !1,
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }, this.offset.click = {
                left: t.pageX - this.offset.left,
                top: t.pageY - this.offset.top
            };
        },
        _mouseDrag: function(e, i) {
            if (this.hasFixedAncestor && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e, !0), 
            this.positionAbs = this._convertPositionTo("absolute"), !i) {
                var s = this._uiHash();
                if (!1 === this._trigger("drag", e, s)) return this._mouseUp({}), !1;
                this.position = s.position;
            }
            return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", 
            t.ui.ddmanager && t.ui.ddmanager.drag(this, e), !1;
        },
        _mouseStop: function(e) {
            var i = this, s = !1;
            return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)), 
            this.dropped && (s = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !s || "valid" === this.options.revert && s || !0 === this.options.revert || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
                !1 !== i._trigger("stop", e) && i._clear();
            }) : !1 !== this._trigger("stop", e) && this._clear(), !1;
        },
        _mouseUp: function(e) {
            return this._unblockFrames(), t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e), 
            this.handleElement.is(e.target) && this.element.focus(), t.ui.mouse.prototype._mouseUp.call(this, e);
        },
        cancel: function() {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), 
            this;
        },
        _getHandle: function(e) {
            return !this.options.handle || !!t(e.target).closest(this.element.find(this.options.handle)).length;
        },
        _setHandleClassName: function() {
            this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, 
            this.handleElement.addClass("ui-draggable-handle");
        },
        _removeHandleClassName: function() {
            this.handleElement.removeClass("ui-draggable-handle");
        },
        _createHelper: function(e) {
            var i = this.options, s = t.isFunction(i.helper), n = s ? t(i.helper.apply(this.element[0], [ e ])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
            return n.parents("body").length || n.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), 
            s && n[0] === this.element[0] && this._setPositionRelative(), n[0] === this.element[0] || /(fixed|absolute)/.test(n.css("position")) || n.css("position", "absolute"), 
            n;
        },
        _setPositionRelative: function() {
            /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative");
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), 
            "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top);
        },
        _isRootNode: function(t) {
            return /(html|body)/i.test(t.tagName) || t === this.document[0];
        },
        _getParentOffset: function() {
            var e = this.offsetParent.offset(), i = this.document[0];
            return "absolute" === this.cssPosition && this.scrollParent[0] !== i && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), 
            e.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            };
        },
        _getRelativeOffset: function() {
            if ("relative" !== this.cssPosition) return {
                top: 0,
                left: 0
            };
            var t = this.element.position(), e = this._isRootNode(this.scrollParent[0]);
            return {
                top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + (e ? 0 : this.scrollParent.scrollTop()),
                left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + (e ? 0 : this.scrollParent.scrollLeft())
            };
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            };
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            };
        },
        _setContainment: function() {
            var e, i, s, n = this.options, a = this.document[0];
            return this.relativeContainer = null, n.containment ? "window" === n.containment ? void (this.containment = [ t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || a.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top ]) : "document" === n.containment ? void (this.containment = [ 0, 0, t(a).width() - this.helperProportions.width - this.margins.left, (t(a).height() || a.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top ]) : n.containment.constructor === Array ? void (this.containment = n.containment) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), 
            i = t(n.containment), void ((s = i[0]) && (e = /(scroll|auto)/.test(i.css("overflow")), 
            this.containment = [ (parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom ], 
            this.relativeContainer = i))) : void (this.containment = null);
        },
        _convertPositionTo: function(t, e) {
            e || (e = this.position);
            var i = "absolute" === t ? 1 : -1, s = this._isRootNode(this.scrollParent[0]);
            return {
                top: e.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : s ? 0 : this.offset.scroll.top) * i,
                left: e.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : s ? 0 : this.offset.scroll.left) * i
            };
        },
        _generatePosition: function(t, e) {
            var i, s, n, a, o = this.options, r = this._isRootNode(this.scrollParent[0]), h = t.pageX, l = t.pageY;
            return r && this.offset.scroll || (this.offset.scroll = {
                top: this.scrollParent.scrollTop(),
                left: this.scrollParent.scrollLeft()
            }), e && (this.containment && (this.relativeContainer ? (s = this.relativeContainer.offset(), 
            i = [ this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top ]) : i = this.containment, 
            t.pageX - this.offset.click.left < i[0] && (h = i[0] + this.offset.click.left), 
            t.pageY - this.offset.click.top < i[1] && (l = i[1] + this.offset.click.top), t.pageX - this.offset.click.left > i[2] && (h = i[2] + this.offset.click.left), 
            t.pageY - this.offset.click.top > i[3] && (l = i[3] + this.offset.click.top)), o.grid && (n = o.grid[1] ? this.originalPageY + Math.round((l - this.originalPageY) / o.grid[1]) * o.grid[1] : this.originalPageY, 
            l = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - o.grid[1] : n + o.grid[1] : n, 
            a = o.grid[0] ? this.originalPageX + Math.round((h - this.originalPageX) / o.grid[0]) * o.grid[0] : this.originalPageX, 
            h = i ? a - this.offset.click.left >= i[0] || a - this.offset.click.left > i[2] ? a : a - this.offset.click.left >= i[0] ? a - o.grid[0] : a + o.grid[0] : a), 
            "y" === o.axis && (h = this.originalPageX), "x" === o.axis && (l = this.originalPageY)), 
            {
                top: l - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : r ? 0 : this.offset.scroll.top),
                left: h - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : r ? 0 : this.offset.scroll.left)
            };
        },
        _clear: function() {
            this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), 
            this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy();
        },
        _normalizeRightBottom: function() {
            "y" !== this.options.axis && "auto" !== this.helper.css("right") && (this.helper.width(this.helper.width()), 
            this.helper.css("right", "auto")), "x" !== this.options.axis && "auto" !== this.helper.css("bottom") && (this.helper.height(this.helper.height()), 
            this.helper.css("bottom", "auto"));
        },
        _trigger: function(e, i, s) {
            return s = s || this._uiHash(), t.ui.plugin.call(this, e, [ i, s, this ], !0), /^(drag|start|stop)/.test(e) && (this.positionAbs = this._convertPositionTo("absolute"), 
            s.offset = this.positionAbs), t.Widget.prototype._trigger.call(this, e, i, s);
        },
        plugins: {},
        _uiHash: function() {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            };
        }
    }), t.ui.plugin.add("draggable", "connectToSortable", {
        start: function(e, i, s) {
            var n = t.extend({}, i, {
                item: s.element
            });
            s.sortables = [], t(s.options.connectToSortable).each(function() {
                var i = t(this).sortable("instance");
                i && !i.options.disabled && (s.sortables.push(i), i.refreshPositions(), i._trigger("activate", e, n));
            });
        },
        stop: function(e, i, s) {
            var n = t.extend({}, i, {
                item: s.element
            });
            s.cancelHelperRemoval = !1, t.each(s.sortables, function() {
                var t = this;
                t.isOver ? (t.isOver = 0, s.cancelHelperRemoval = !0, t.cancelHelperRemoval = !1, 
                t._storedCSS = {
                    position: t.placeholder.css("position"),
                    top: t.placeholder.css("top"),
                    left: t.placeholder.css("left")
                }, t._mouseStop(e), t.options.helper = t.options._helper) : (t.cancelHelperRemoval = !0, 
                t._trigger("deactivate", e, n));
            });
        },
        drag: function(e, i, s) {
            t.each(s.sortables, function() {
                var n = !1, a = this;
                a.positionAbs = s.positionAbs, a.helperProportions = s.helperProportions, a.offset.click = s.offset.click, 
                a._intersectsWith(a.containerCache) && (n = !0, t.each(s.sortables, function() {
                    return this.positionAbs = s.positionAbs, this.helperProportions = s.helperProportions, 
                    this.offset.click = s.offset.click, this !== a && this._intersectsWith(this.containerCache) && t.contains(a.element[0], this.element[0]) && (n = !1), 
                    n;
                })), n ? (a.isOver || (a.isOver = 1, s._parent = i.helper.parent(), a.currentItem = i.helper.appendTo(a.element).data("ui-sortable-item", !0), 
                a.options._helper = a.options.helper, a.options.helper = function() {
                    return i.helper[0];
                }, e.target = a.currentItem[0], a._mouseCapture(e, !0), a._mouseStart(e, !0, !0), 
                a.offset.click.top = s.offset.click.top, a.offset.click.left = s.offset.click.left, 
                a.offset.parent.left -= s.offset.parent.left - a.offset.parent.left, a.offset.parent.top -= s.offset.parent.top - a.offset.parent.top, 
                s._trigger("toSortable", e), s.dropped = a.element, t.each(s.sortables, function() {
                    this.refreshPositions();
                }), s.currentItem = s.element, a.fromOutside = s), a.currentItem && (a._mouseDrag(e), 
                i.position = a.position)) : a.isOver && (a.isOver = 0, a.cancelHelperRemoval = !0, 
                a.options._revert = a.options.revert, a.options.revert = !1, a._trigger("out", e, a._uiHash(a)), 
                a._mouseStop(e, !0), a.options.revert = a.options._revert, a.options.helper = a.options._helper, 
                a.placeholder && a.placeholder.remove(), i.helper.appendTo(s._parent), s._refreshOffsets(e), 
                i.position = s._generatePosition(e, !0), s._trigger("fromSortable", e), s.dropped = !1, 
                t.each(s.sortables, function() {
                    this.refreshPositions();
                }));
            });
        }
    }), t.ui.plugin.add("draggable", "cursor", {
        start: function(e, i, s) {
            var n = t("body"), a = s.options;
            n.css("cursor") && (a._cursor = n.css("cursor")), n.css("cursor", a.cursor);
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._cursor && t("body").css("cursor", n._cursor);
        }
    }), t.ui.plugin.add("draggable", "opacity", {
        start: function(e, i, s) {
            var n = t(i.helper), a = s.options;
            n.css("opacity") && (a._opacity = n.css("opacity")), n.css("opacity", a.opacity);
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._opacity && t(i.helper).css("opacity", n._opacity);
        }
    }), t.ui.plugin.add("draggable", "scroll", {
        start: function(t, e, i) {
            i.scrollParentNotHidden || (i.scrollParentNotHidden = i.helper.scrollParent(!1)), 
            i.scrollParentNotHidden[0] !== i.document[0] && "HTML" !== i.scrollParentNotHidden[0].tagName && (i.overflowOffset = i.scrollParentNotHidden.offset());
        },
        drag: function(e, i, s) {
            var n = s.options, a = !1, o = s.scrollParentNotHidden[0], r = s.document[0];
            o !== r && "HTML" !== o.tagName ? (n.axis && "x" === n.axis || (s.overflowOffset.top + o.offsetHeight - e.pageY < n.scrollSensitivity ? o.scrollTop = a = o.scrollTop + n.scrollSpeed : e.pageY - s.overflowOffset.top < n.scrollSensitivity && (o.scrollTop = a = o.scrollTop - n.scrollSpeed)), 
            n.axis && "y" === n.axis || (s.overflowOffset.left + o.offsetWidth - e.pageX < n.scrollSensitivity ? o.scrollLeft = a = o.scrollLeft + n.scrollSpeed : e.pageX - s.overflowOffset.left < n.scrollSensitivity && (o.scrollLeft = a = o.scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (e.pageY - t(r).scrollTop() < n.scrollSensitivity ? a = t(r).scrollTop(t(r).scrollTop() - n.scrollSpeed) : t(window).height() - (e.pageY - t(r).scrollTop()) < n.scrollSensitivity && (a = t(r).scrollTop(t(r).scrollTop() + n.scrollSpeed))), 
            n.axis && "y" === n.axis || (e.pageX - t(r).scrollLeft() < n.scrollSensitivity ? a = t(r).scrollLeft(t(r).scrollLeft() - n.scrollSpeed) : t(window).width() - (e.pageX - t(r).scrollLeft()) < n.scrollSensitivity && (a = t(r).scrollLeft(t(r).scrollLeft() + n.scrollSpeed)))), 
            !1 !== a && t.ui.ddmanager && !n.dropBehaviour && t.ui.ddmanager.prepareOffsets(s, e);
        }
    }), t.ui.plugin.add("draggable", "snap", {
        start: function(e, i, s) {
            var n = s.options;
            s.snapElements = [], t(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function() {
                var e = t(this), i = e.offset();
                this !== s.element[0] && s.snapElements.push({
                    item: this,
                    width: e.outerWidth(),
                    height: e.outerHeight(),
                    top: i.top,
                    left: i.left
                });
            });
        },
        drag: function(e, i, s) {
            var n, a, o, r, h, l, u, c, d, p, f = s.options, m = f.snapTolerance, g = i.offset.left, v = g + s.helperProportions.width, _ = i.offset.top, b = _ + s.helperProportions.height;
            for (d = s.snapElements.length - 1; d >= 0; d--) h = s.snapElements[d].left - s.margins.left, 
            l = h + s.snapElements[d].width, u = s.snapElements[d].top - s.margins.top, c = u + s.snapElements[d].height, 
            h - m > v || g > l + m || u - m > b || _ > c + m || !t.contains(s.snapElements[d].item.ownerDocument, s.snapElements[d].item) ? (s.snapElements[d].snapping && s.options.snap.release && s.options.snap.release.call(s.element, e, t.extend(s._uiHash(), {
                snapItem: s.snapElements[d].item
            })), s.snapElements[d].snapping = !1) : ("inner" !== f.snapMode && (n = m >= Math.abs(u - b), 
            a = m >= Math.abs(c - _), o = m >= Math.abs(h - v), r = m >= Math.abs(l - g), n && (i.position.top = s._convertPositionTo("relative", {
                top: u - s.helperProportions.height,
                left: 0
            }).top), a && (i.position.top = s._convertPositionTo("relative", {
                top: c,
                left: 0
            }).top), o && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h - s.helperProportions.width
            }).left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l
            }).left)), p = n || a || o || r, "outer" !== f.snapMode && (n = m >= Math.abs(u - _), 
            a = m >= Math.abs(c - b), o = m >= Math.abs(h - g), r = m >= Math.abs(l - v), n && (i.position.top = s._convertPositionTo("relative", {
                top: u,
                left: 0
            }).top), a && (i.position.top = s._convertPositionTo("relative", {
                top: c - s.helperProportions.height,
                left: 0
            }).top), o && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: h
            }).left), r && (i.position.left = s._convertPositionTo("relative", {
                top: 0,
                left: l - s.helperProportions.width
            }).left)), !s.snapElements[d].snapping && (n || a || o || r || p) && s.options.snap.snap && s.options.snap.snap.call(s.element, e, t.extend(s._uiHash(), {
                snapItem: s.snapElements[d].item
            })), s.snapElements[d].snapping = n || a || o || r || p);
        }
    }), t.ui.plugin.add("draggable", "stack", {
        start: function(e, i, s) {
            var n, a = s.options, o = t.makeArray(t(a.stack)).sort(function(e, i) {
                return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0);
            });
            o.length && (n = parseInt(t(o[0]).css("zIndex"), 10) || 0, t(o).each(function(e) {
                t(this).css("zIndex", n + e);
            }), this.css("zIndex", n + o.length));
        }
    }), t.ui.plugin.add("draggable", "zIndex", {
        start: function(e, i, s) {
            var n = t(i.helper), a = s.options;
            n.css("zIndex") && (a._zIndex = n.css("zIndex")), n.css("zIndex", a.zIndex);
        },
        stop: function(e, i, s) {
            var n = s.options;
            n._zIndex && t(i.helper).css("zIndex", n._zIndex);
        }
    }), t.ui.draggable, t.widget("ui.droppable", {
        version: "1.11.4",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function() {
            var e, i = this.options, s = i.accept;
            this.isover = !1, this.isout = !0, this.accept = t.isFunction(s) ? s : function(t) {
                return t.is(s);
            }, this.proportions = function() {
                return arguments.length ? void (e = arguments[0]) : e || (e = {
                    width: this.element[0].offsetWidth,
                    height: this.element[0].offsetHeight
                });
            }, this._addToManager(i.scope), i.addClasses && this.element.addClass("ui-droppable");
        },
        _addToManager: function(e) {
            t.ui.ddmanager.droppables[e] = t.ui.ddmanager.droppables[e] || [], t.ui.ddmanager.droppables[e].push(this);
        },
        _splice: function(t) {
            for (var e = 0; t.length > e; e++) t[e] === this && t.splice(e, 1);
        },
        _destroy: function() {
            var e = t.ui.ddmanager.droppables[this.options.scope];
            this._splice(e), this.element.removeClass("ui-droppable ui-droppable-disabled");
        },
        _setOption: function(e, i) {
            if ("accept" === e) this.accept = t.isFunction(i) ? i : function(t) {
                return t.is(i);
            }; else if ("scope" === e) {
                var s = t.ui.ddmanager.droppables[this.options.scope];
                this._splice(s), this._addToManager(i);
            }
            this._super(e, i);
        },
        _activate: function(e) {
            var i = t.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", e, this.ui(i));
        },
        _deactivate: function(e) {
            var i = t.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), 
            i && this._trigger("deactivate", e, this.ui(i));
        },
        _over: function(e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), 
            this._trigger("over", e, this.ui(i)));
        },
        _out: function(e) {
            var i = t.ui.ddmanager.current;
            i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), 
            this._trigger("out", e, this.ui(i)));
        },
        _drop: function(e, i) {
            var s = i || t.ui.ddmanager.current, n = !1;
            return !(!s || (s.currentItem || s.element)[0] === this.element[0]) && (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                var i = t(this).droppable("instance");
                return i.options.greedy && !i.options.disabled && i.options.scope === s.options.scope && i.accept.call(i.element[0], s.currentItem || s.element) && t.ui.intersect(s, t.extend(i, {
                    offset: i.element.offset()
                }), i.options.tolerance, e) ? (n = !0, !1) : void 0;
            }), !n && (!!this.accept.call(this.element[0], s.currentItem || s.element) && (this.options.activeClass && this.element.removeClass(this.options.activeClass), 
            this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", e, this.ui(s)), 
            this.element)));
        },
        ui: function(t) {
            return {
                draggable: t.currentItem || t.element,
                helper: t.helper,
                position: t.position,
                offset: t.positionAbs
            };
        }
    }), t.ui.intersect = function() {
        function t(t, e, i) {
            return t >= e && e + i > t;
        }
        return function(e, i, s, n) {
            if (!i.offset) return !1;
            var a = (e.positionAbs || e.position.absolute).left + e.margins.left, o = (e.positionAbs || e.position.absolute).top + e.margins.top, r = a + e.helperProportions.width, h = o + e.helperProportions.height, l = i.offset.left, u = i.offset.top, c = l + i.proportions().width, d = u + i.proportions().height;
            switch (s) {
              case "fit":
                return a >= l && c >= r && o >= u && d >= h;

              case "intersect":
                return a + e.helperProportions.width / 2 > l && c > r - e.helperProportions.width / 2 && o + e.helperProportions.height / 2 > u && d > h - e.helperProportions.height / 2;

              case "pointer":
                return t(n.pageY, u, i.proportions().height) && t(n.pageX, l, i.proportions().width);

              case "touch":
                return (o >= u && d >= o || h >= u && d >= h || u > o && h > d) && (a >= l && c >= a || r >= l && c >= r || l > a && r > c);

              default:
                return !1;
            }
        };
    }(), t.ui.ddmanager = {
        current: null,
        droppables: {
            default: []
        },
        prepareOffsets: function(e, i) {
            var s, n, a = t.ui.ddmanager.droppables[e.options.scope] || [], o = i ? i.type : null, r = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
            t: for (s = 0; a.length > s; s++) if (!(a[s].options.disabled || e && !a[s].accept.call(a[s].element[0], e.currentItem || e.element))) {
                for (n = 0; r.length > n; n++) if (r[n] === a[s].element[0]) {
                    a[s].proportions().height = 0;
                    continue t;
                }
                a[s].visible = "none" !== a[s].element.css("display"), a[s].visible && ("mousedown" === o && a[s]._activate.call(a[s], i), 
                a[s].offset = a[s].element.offset(), a[s].proportions({
                    width: a[s].element[0].offsetWidth,
                    height: a[s].element[0].offsetHeight
                }));
            }
        },
        drop: function(e, i) {
            var s = !1;
            return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), function() {
                this.options && (!this.options.disabled && this.visible && t.ui.intersect(e, this, this.options.tolerance, i) && (s = this._drop.call(this, i) || s), 
                !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, 
                this.isover = !1, this._deactivate.call(this, i)));
            }), s;
        },
        dragStart: function(e, i) {
            e.element.parentsUntil("body").bind("scroll.droppable", function() {
                e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i);
            });
        },
        drag: function(e, i) {
            e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i), t.each(t.ui.ddmanager.droppables[e.options.scope] || [], function() {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var s, n, a, o = t.ui.intersect(e, this, this.options.tolerance, i), r = !o && this.isover ? "isout" : o && !this.isover ? "isover" : null;
                    r && (this.options.greedy && (n = this.options.scope, a = this.element.parents(":data(ui-droppable)").filter(function() {
                        return t(this).droppable("instance").options.scope === n;
                    }), a.length && (s = t(a[0]).droppable("instance"), s.greedyChild = "isover" === r)), 
                    s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, 
                    this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), 
                    s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)));
                }
            });
        },
        dragStop: function(e, i) {
            e.element.parentsUntil("body").unbind("scroll.droppable"), e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i);
        }
    }, t.ui.droppable, t.widget("ui.resizable", t.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "resize",
        options: {
            alsoResize: !1,
            animate: !1,
            animateDuration: "slow",
            animateEasing: "swing",
            aspectRatio: !1,
            autoHide: !1,
            containment: !1,
            ghost: !1,
            grid: !1,
            handles: "e,s,se",
            helper: !1,
            maxHeight: null,
            maxWidth: null,
            minHeight: 10,
            minWidth: 10,
            zIndex: 90,
            resize: null,
            start: null,
            stop: null
        },
        _num: function(t) {
            return parseInt(t, 10) || 0;
        },
        _isNumber: function(t) {
            return !isNaN(parseInt(t, 10));
        },
        _hasScroll: function(e, i) {
            if ("hidden" === t(e).css("overflow")) return !1;
            var s = i && "left" === i ? "scrollLeft" : "scrollTop", n = !1;
            return e[s] > 0 || (e[s] = 1, n = e[s] > 0, e[s] = 0, n);
        },
        _create: function() {
            var e, i, s, n, a, o = this, r = this.options;
            if (this.element.addClass("ui-resizable"), t.extend(this, {
                _aspectRatio: !!r.aspectRatio,
                aspectRatio: r.aspectRatio,
                originalElement: this.element,
                _proportionallyResizeElements: [],
                _helper: r.helper || r.ghost || r.animate ? r.helper || "ui-resizable-helper" : null
            }), this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i) && (this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                position: this.element.css("position"),
                width: this.element.outerWidth(),
                height: this.element.outerHeight(),
                top: this.element.css("top"),
                left: this.element.css("left")
            })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), 
            this.elementIsWrapper = !0, this.element.css({
                marginLeft: this.originalElement.css("marginLeft"),
                marginTop: this.originalElement.css("marginTop"),
                marginRight: this.originalElement.css("marginRight"),
                marginBottom: this.originalElement.css("marginBottom")
            }), this.originalElement.css({
                marginLeft: 0,
                marginTop: 0,
                marginRight: 0,
                marginBottom: 0
            }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), 
            this._proportionallyResizeElements.push(this.originalElement.css({
                position: "static",
                zoom: 1,
                display: "block"
            })), this.originalElement.css({
                margin: this.originalElement.css("margin")
            }), this._proportionallyResize()), this.handles = r.handles || (t(".ui-resizable-handle", this.element).length ? {
                n: ".ui-resizable-n",
                e: ".ui-resizable-e",
                s: ".ui-resizable-s",
                w: ".ui-resizable-w",
                se: ".ui-resizable-se",
                sw: ".ui-resizable-sw",
                ne: ".ui-resizable-ne",
                nw: ".ui-resizable-nw"
            } : "e,s,se"), this._handles = t(), this.handles.constructor === String) for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), 
            e = this.handles.split(","), this.handles = {}, i = 0; e.length > i; i++) s = t.trim(e[i]), 
            a = "ui-resizable-" + s, n = t("<div class='ui-resizable-handle " + a + "'></div>"), 
            n.css({
                zIndex: r.zIndex
            }), "se" === s && n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[s] = ".ui-resizable-" + s, 
            this.element.append(n);
            this._renderAxis = function(e) {
                var i, s, n, a;
                e = e || this.element;
                for (i in this.handles) this.handles[i].constructor === String ? this.handles[i] = this.element.children(this.handles[i]).first().show() : (this.handles[i].jquery || this.handles[i].nodeType) && (this.handles[i] = t(this.handles[i]), 
                this._on(this.handles[i], {
                    mousedown: o._mouseDown
                })), this.elementIsWrapper && this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i) && (s = t(this.handles[i], this.element), 
                a = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = [ "padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left" ].join(""), 
                e.css(n, a), this._proportionallyResize()), this._handles = this._handles.add(this.handles[i]);
            }, this._renderAxis(this.element), this._handles = this._handles.add(this.element.find(".ui-resizable-handle")), 
            this._handles.disableSelection(), this._handles.mouseover(function() {
                o.resizing || (this.className && (n = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), 
                o.axis = n && n[1] ? n[1] : "se");
            }), r.autoHide && (this._handles.hide(), t(this.element).addClass("ui-resizable-autohide").mouseenter(function() {
                r.disabled || (t(this).removeClass("ui-resizable-autohide"), o._handles.show());
            }).mouseleave(function() {
                r.disabled || o.resizing || (t(this).addClass("ui-resizable-autohide"), o._handles.hide());
            })), this._mouseInit();
        },
        _destroy: function() {
            this._mouseDestroy();
            var e, i = function(e) {
                t(e).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove();
            };
            return this.elementIsWrapper && (i(this.element), e = this.element, this.originalElement.css({
                position: e.css("position"),
                width: e.outerWidth(),
                height: e.outerHeight(),
                top: e.css("top"),
                left: e.css("left")
            }).insertAfter(e), e.remove()), this.originalElement.css("resize", this.originalResizeStyle), 
            i(this.originalElement), this;
        },
        _mouseCapture: function(e) {
            var i, s, n = !1;
            for (i in this.handles) ((s = t(this.handles[i])[0]) === e.target || t.contains(s, e.target)) && (n = !0);
            return !this.options.disabled && n;
        },
        _mouseStart: function(e) {
            var i, s, n, a = this.options, o = this.element;
            return this.resizing = !0, this._renderProxy(), i = this._num(this.helper.css("left")), 
            s = this._num(this.helper.css("top")), a.containment && (i += t(a.containment).scrollLeft() || 0, 
            s += t(a.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                left: i,
                top: s
            }, this.size = this._helper ? {
                width: this.helper.width(),
                height: this.helper.height()
            } : {
                width: o.width(),
                height: o.height()
            }, this.originalSize = this._helper ? {
                width: o.outerWidth(),
                height: o.outerHeight()
            } : {
                width: o.width(),
                height: o.height()
            }, this.sizeDiff = {
                width: o.outerWidth() - o.width(),
                height: o.outerHeight() - o.height()
            }, this.originalPosition = {
                left: i,
                top: s
            }, this.originalMousePosition = {
                left: e.pageX,
                top: e.pageY
            }, this.aspectRatio = "number" == typeof a.aspectRatio ? a.aspectRatio : this.originalSize.width / this.originalSize.height || 1, 
            n = t(".ui-resizable-" + this.axis).css("cursor"), t("body").css("cursor", "auto" === n ? this.axis + "-resize" : n), 
            o.addClass("ui-resizable-resizing"), this._propagate("start", e), !0;
        },
        _mouseDrag: function(e) {
            var i, s, n = this.originalMousePosition, a = this.axis, o = e.pageX - n.left || 0, r = e.pageY - n.top || 0, h = this._change[a];
            return this._updatePrevProperties(), !!h && (i = h.apply(this, [ e, o, r ]), this._updateVirtualBoundaries(e.shiftKey), 
            (this._aspectRatio || e.shiftKey) && (i = this._updateRatio(i, e)), i = this._respectSize(i, e), 
            this._updateCache(i), this._propagate("resize", e), s = this._applyChanges(), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), 
            t.isEmptyObject(s) || (this._updatePrevProperties(), this._trigger("resize", e, this.ui()), 
            this._applyChanges()), !1);
        },
        _mouseStop: function(e) {
            this.resizing = !1;
            var i, s, n, a, o, r, h, l = this.options, u = this;
            return this._helper && (i = this._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), 
            n = s && this._hasScroll(i[0], "left") ? 0 : u.sizeDiff.height, a = s ? 0 : u.sizeDiff.width, 
            o = {
                width: u.helper.width() - a,
                height: u.helper.height() - n
            }, r = parseInt(u.element.css("left"), 10) + (u.position.left - u.originalPosition.left) || null, 
            h = parseInt(u.element.css("top"), 10) + (u.position.top - u.originalPosition.top) || null, 
            l.animate || this.element.css(t.extend(o, {
                top: h,
                left: r
            })), u.helper.height(u.size.height), u.helper.width(u.size.width), this._helper && !l.animate && this._proportionallyResize()), 
            t("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), 
            this._propagate("stop", e), this._helper && this.helper.remove(), !1;
        },
        _updatePrevProperties: function() {
            this.prevPosition = {
                top: this.position.top,
                left: this.position.left
            }, this.prevSize = {
                width: this.size.width,
                height: this.size.height
            };
        },
        _applyChanges: function() {
            var t = {};
            return this.position.top !== this.prevPosition.top && (t.top = this.position.top + "px"), 
            this.position.left !== this.prevPosition.left && (t.left = this.position.left + "px"), 
            this.size.width !== this.prevSize.width && (t.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (t.height = this.size.height + "px"), 
            this.helper.css(t), t;
        },
        _updateVirtualBoundaries: function(t) {
            var e, i, s, n, a, o = this.options;
            a = {
                minWidth: this._isNumber(o.minWidth) ? o.minWidth : 0,
                maxWidth: this._isNumber(o.maxWidth) ? o.maxWidth : 1 / 0,
                minHeight: this._isNumber(o.minHeight) ? o.minHeight : 0,
                maxHeight: this._isNumber(o.maxHeight) ? o.maxHeight : 1 / 0
            }, (this._aspectRatio || t) && (e = a.minHeight * this.aspectRatio, s = a.minWidth / this.aspectRatio, 
            i = a.maxHeight * this.aspectRatio, n = a.maxWidth / this.aspectRatio, e > a.minWidth && (a.minWidth = e), 
            s > a.minHeight && (a.minHeight = s), a.maxWidth > i && (a.maxWidth = i), a.maxHeight > n && (a.maxHeight = n)), 
            this._vBoundaries = a;
        },
        _updateCache: function(t) {
            this.offset = this.helper.offset(), this._isNumber(t.left) && (this.position.left = t.left), 
            this._isNumber(t.top) && (this.position.top = t.top), this._isNumber(t.height) && (this.size.height = t.height), 
            this._isNumber(t.width) && (this.size.width = t.width);
        },
        _updateRatio: function(t) {
            var e = this.position, i = this.size, s = this.axis;
            return this._isNumber(t.height) ? t.width = t.height * this.aspectRatio : this._isNumber(t.width) && (t.height = t.width / this.aspectRatio), 
            "sw" === s && (t.left = e.left + (i.width - t.width), t.top = null), "nw" === s && (t.top = e.top + (i.height - t.height), 
            t.left = e.left + (i.width - t.width)), t;
        },
        _respectSize: function(t) {
            var e = this._vBoundaries, i = this.axis, s = this._isNumber(t.width) && e.maxWidth && e.maxWidth < t.width, n = this._isNumber(t.height) && e.maxHeight && e.maxHeight < t.height, a = this._isNumber(t.width) && e.minWidth && e.minWidth > t.width, o = this._isNumber(t.height) && e.minHeight && e.minHeight > t.height, r = this.originalPosition.left + this.originalSize.width, h = this.position.top + this.size.height, l = /sw|nw|w/.test(i), u = /nw|ne|n/.test(i);
            return a && (t.width = e.minWidth), o && (t.height = e.minHeight), s && (t.width = e.maxWidth), 
            n && (t.height = e.maxHeight), a && l && (t.left = r - e.minWidth), s && l && (t.left = r - e.maxWidth), 
            o && u && (t.top = h - e.minHeight), n && u && (t.top = h - e.maxHeight), t.width || t.height || t.left || !t.top ? t.width || t.height || t.top || !t.left || (t.left = null) : t.top = null, 
            t;
        },
        _getPaddingPlusBorderDimensions: function(t) {
            for (var e = 0, i = [], s = [ t.css("borderTopWidth"), t.css("borderRightWidth"), t.css("borderBottomWidth"), t.css("borderLeftWidth") ], n = [ t.css("paddingTop"), t.css("paddingRight"), t.css("paddingBottom"), t.css("paddingLeft") ]; 4 > e; e++) i[e] = parseInt(s[e], 10) || 0, 
            i[e] += parseInt(n[e], 10) || 0;
            return {
                height: i[0] + i[2],
                width: i[1] + i[3]
            };
        },
        _proportionallyResize: function() {
            if (this._proportionallyResizeElements.length) for (var t, e = 0, i = this.helper || this.element; this._proportionallyResizeElements.length > e; e++) t = this._proportionallyResizeElements[e], 
            this.outerDimensions || (this.outerDimensions = this._getPaddingPlusBorderDimensions(t)), 
            t.css({
                height: i.height() - this.outerDimensions.height || 0,
                width: i.width() - this.outerDimensions.width || 0
            });
        },
        _renderProxy: function() {
            var e = this.element, i = this.options;
            this.elementOffset = e.offset(), this._helper ? (this.helper = this.helper || t("<div style='overflow:hidden;'></div>"), 
            this.helper.addClass(this._helper).css({
                width: this.element.outerWidth() - 1,
                height: this.element.outerHeight() - 1,
                position: "absolute",
                left: this.elementOffset.left + "px",
                top: this.elementOffset.top + "px",
                zIndex: ++i.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element;
        },
        _change: {
            e: function(t, e) {
                return {
                    width: this.originalSize.width + e
                };
            },
            w: function(t, e) {
                var i = this.originalSize;
                return {
                    left: this.originalPosition.left + e,
                    width: i.width - e
                };
            },
            n: function(t, e, i) {
                var s = this.originalSize;
                return {
                    top: this.originalPosition.top + i,
                    height: s.height - i
                };
            },
            s: function(t, e, i) {
                return {
                    height: this.originalSize.height + i
                };
            },
            se: function(e, i, s) {
                return t.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [ e, i, s ]));
            },
            sw: function(e, i, s) {
                return t.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [ e, i, s ]));
            },
            ne: function(e, i, s) {
                return t.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [ e, i, s ]));
            },
            nw: function(e, i, s) {
                return t.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [ e, i, s ]));
            }
        },
        _propagate: function(e, i) {
            t.ui.plugin.call(this, e, [ i, this.ui() ]), "resize" !== e && this._trigger(e, i, this.ui());
        },
        plugins: {},
        ui: function() {
            return {
                originalElement: this.originalElement,
                element: this.element,
                helper: this.helper,
                position: this.position,
                size: this.size,
                originalSize: this.originalSize,
                originalPosition: this.originalPosition
            };
        }
    }), t.ui.plugin.add("resizable", "animate", {
        stop: function(e) {
            var i = t(this).resizable("instance"), s = i.options, n = i._proportionallyResizeElements, a = n.length && /textarea/i.test(n[0].nodeName), o = a && i._hasScroll(n[0], "left") ? 0 : i.sizeDiff.height, r = a ? 0 : i.sizeDiff.width, h = {
                width: i.size.width - r,
                height: i.size.height - o
            }, l = parseInt(i.element.css("left"), 10) + (i.position.left - i.originalPosition.left) || null, u = parseInt(i.element.css("top"), 10) + (i.position.top - i.originalPosition.top) || null;
            i.element.animate(t.extend(h, u && l ? {
                top: u,
                left: l
            } : {}), {
                duration: s.animateDuration,
                easing: s.animateEasing,
                step: function() {
                    var s = {
                        width: parseInt(i.element.css("width"), 10),
                        height: parseInt(i.element.css("height"), 10),
                        top: parseInt(i.element.css("top"), 10),
                        left: parseInt(i.element.css("left"), 10)
                    };
                    n && n.length && t(n[0]).css({
                        width: s.width,
                        height: s.height
                    }), i._updateCache(s), i._propagate("resize", e);
                }
            });
        }
    }), t.ui.plugin.add("resizable", "containment", {
        start: function() {
            var e, i, s, n, a, o, r, h = t(this).resizable("instance"), l = h.options, u = h.element, c = l.containment, d = c instanceof t ? c.get(0) : /parent/.test(c) ? u.parent().get(0) : c;
            d && (h.containerElement = t(d), /document/.test(c) || c === document ? (h.containerOffset = {
                left: 0,
                top: 0
            }, h.containerPosition = {
                left: 0,
                top: 0
            }, h.parentData = {
                element: t(document),
                left: 0,
                top: 0,
                width: t(document).width(),
                height: t(document).height() || document.body.parentNode.scrollHeight
            }) : (e = t(d), i = [], t([ "Top", "Right", "Left", "Bottom" ]).each(function(t, s) {
                i[t] = h._num(e.css("padding" + s));
            }), h.containerOffset = e.offset(), h.containerPosition = e.position(), h.containerSize = {
                height: e.innerHeight() - i[3],
                width: e.innerWidth() - i[1]
            }, s = h.containerOffset, n = h.containerSize.height, a = h.containerSize.width, 
            o = h._hasScroll(d, "left") ? d.scrollWidth : a, r = h._hasScroll(d) ? d.scrollHeight : n, 
            h.parentData = {
                element: d,
                left: s.left,
                top: s.top,
                width: o,
                height: r
            }));
        },
        resize: function(e) {
            var i, s, n, a, o = t(this).resizable("instance"), r = o.options, h = o.containerOffset, l = o.position, u = o._aspectRatio || e.shiftKey, c = {
                top: 0,
                left: 0
            }, d = o.containerElement, p = !0;
            d[0] !== document && /static/.test(d.css("position")) && (c = h), l.left < (o._helper ? h.left : 0) && (o.size.width = o.size.width + (o._helper ? o.position.left - h.left : o.position.left - c.left), 
            u && (o.size.height = o.size.width / o.aspectRatio, p = !1), o.position.left = r.helper ? h.left : 0), 
            l.top < (o._helper ? h.top : 0) && (o.size.height = o.size.height + (o._helper ? o.position.top - h.top : o.position.top), 
            u && (o.size.width = o.size.height * o.aspectRatio, p = !1), o.position.top = o._helper ? h.top : 0), 
            n = o.containerElement.get(0) === o.element.parent().get(0), a = /relative|absolute/.test(o.containerElement.css("position")), 
            n && a ? (o.offset.left = o.parentData.left + o.position.left, o.offset.top = o.parentData.top + o.position.top) : (o.offset.left = o.element.offset().left, 
            o.offset.top = o.element.offset().top), i = Math.abs(o.sizeDiff.width + (o._helper ? o.offset.left - c.left : o.offset.left - h.left)), 
            s = Math.abs(o.sizeDiff.height + (o._helper ? o.offset.top - c.top : o.offset.top - h.top)), 
            i + o.size.width >= o.parentData.width && (o.size.width = o.parentData.width - i, 
            u && (o.size.height = o.size.width / o.aspectRatio, p = !1)), s + o.size.height >= o.parentData.height && (o.size.height = o.parentData.height - s, 
            u && (o.size.width = o.size.height * o.aspectRatio, p = !1)), p || (o.position.left = o.prevPosition.left, 
            o.position.top = o.prevPosition.top, o.size.width = o.prevSize.width, o.size.height = o.prevSize.height);
        },
        stop: function() {
            var e = t(this).resizable("instance"), i = e.options, s = e.containerOffset, n = e.containerPosition, a = e.containerElement, o = t(e.helper), r = o.offset(), h = o.outerWidth() - e.sizeDiff.width, l = o.outerHeight() - e.sizeDiff.height;
            e._helper && !i.animate && /relative/.test(a.css("position")) && t(this).css({
                left: r.left - n.left - s.left,
                width: h,
                height: l
            }), e._helper && !i.animate && /static/.test(a.css("position")) && t(this).css({
                left: r.left - n.left - s.left,
                width: h,
                height: l
            });
        }
    }), t.ui.plugin.add("resizable", "alsoResize", {
        start: function() {
            var e = t(this).resizable("instance"), i = e.options;
            t(i.alsoResize).each(function() {
                var e = t(this);
                e.data("ui-resizable-alsoresize", {
                    width: parseInt(e.width(), 10),
                    height: parseInt(e.height(), 10),
                    left: parseInt(e.css("left"), 10),
                    top: parseInt(e.css("top"), 10)
                });
            });
        },
        resize: function(e, i) {
            var s = t(this).resizable("instance"), n = s.options, a = s.originalSize, o = s.originalPosition, r = {
                height: s.size.height - a.height || 0,
                width: s.size.width - a.width || 0,
                top: s.position.top - o.top || 0,
                left: s.position.left - o.left || 0
            };
            t(n.alsoResize).each(function() {
                var e = t(this), s = t(this).data("ui-resizable-alsoresize"), n = {}, a = e.parents(i.originalElement[0]).length ? [ "width", "height" ] : [ "width", "height", "top", "left" ];
                t.each(a, function(t, e) {
                    var i = (s[e] || 0) + (r[e] || 0);
                    i && i >= 0 && (n[e] = i || null);
                }), e.css(n);
            });
        },
        stop: function() {
            t(this).removeData("resizable-alsoresize");
        }
    }), t.ui.plugin.add("resizable", "ghost", {
        start: function() {
            var e = t(this).resizable("instance"), i = e.options, s = e.size;
            e.ghost = e.originalElement.clone(), e.ghost.css({
                opacity: .25,
                display: "block",
                position: "relative",
                height: s.height,
                width: s.width,
                margin: 0,
                left: 0,
                top: 0
            }).addClass("ui-resizable-ghost").addClass("string" == typeof i.ghost ? i.ghost : ""), 
            e.ghost.appendTo(e.helper);
        },
        resize: function() {
            var e = t(this).resizable("instance");
            e.ghost && e.ghost.css({
                position: "relative",
                height: e.size.height,
                width: e.size.width
            });
        },
        stop: function() {
            var e = t(this).resizable("instance");
            e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0));
        }
    }), t.ui.plugin.add("resizable", "grid", {
        resize: function() {
            var e, i = t(this).resizable("instance"), s = i.options, n = i.size, a = i.originalSize, o = i.originalPosition, r = i.axis, h = "number" == typeof s.grid ? [ s.grid, s.grid ] : s.grid, l = h[0] || 1, u = h[1] || 1, c = Math.round((n.width - a.width) / l) * l, d = Math.round((n.height - a.height) / u) * u, p = a.width + c, f = a.height + d, m = s.maxWidth && p > s.maxWidth, g = s.maxHeight && f > s.maxHeight, v = s.minWidth && s.minWidth > p, _ = s.minHeight && s.minHeight > f;
            s.grid = h, v && (p += l), _ && (f += u), m && (p -= l), g && (f -= u), /^(se|s|e)$/.test(r) ? (i.size.width = p, 
            i.size.height = f) : /^(ne)$/.test(r) ? (i.size.width = p, i.size.height = f, i.position.top = o.top - d) : /^(sw)$/.test(r) ? (i.size.width = p, 
            i.size.height = f, i.position.left = o.left - c) : ((0 >= f - u || 0 >= p - l) && (e = i._getPaddingPlusBorderDimensions(this)), 
            f - u > 0 ? (i.size.height = f, i.position.top = o.top - d) : (f = u - e.height, 
            i.size.height = f, i.position.top = o.top + a.height - f), p - l > 0 ? (i.size.width = p, 
            i.position.left = o.left - c) : (p = l - e.width, i.size.width = p, i.position.left = o.left + a.width - p));
        }
    }), t.ui.resizable, t.widget("ui.selectable", t.ui.mouse, {
        version: "1.11.4",
        options: {
            appendTo: "body",
            autoRefresh: !0,
            distance: 0,
            filter: "*",
            tolerance: "touch",
            selected: null,
            selecting: null,
            start: null,
            stop: null,
            unselected: null,
            unselecting: null
        },
        _create: function() {
            var e, i = this;
            this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function() {
                e = t(i.options.filter, i.element[0]), e.addClass("ui-selectee"), e.each(function() {
                    var e = t(this), i = e.offset();
                    t.data(this, "selectable-item", {
                        element: this,
                        $element: e,
                        left: i.left,
                        top: i.top,
                        right: i.left + e.outerWidth(),
                        bottom: i.top + e.outerHeight(),
                        startselected: !1,
                        selected: e.hasClass("ui-selected"),
                        selecting: e.hasClass("ui-selecting"),
                        unselecting: e.hasClass("ui-unselecting")
                    });
                });
            }, this.refresh(), this.selectees = e.addClass("ui-selectee"), this._mouseInit(), 
            this.helper = t("<div class='ui-selectable-helper'></div>");
        },
        _destroy: function() {
            this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), 
            this._mouseDestroy();
        },
        _mouseStart: function(e) {
            var i = this, s = this.options;
            this.opos = [ e.pageX, e.pageY ], this.options.disabled || (this.selectees = t(s.filter, this.element[0]), 
            this._trigger("start", e), t(s.appendTo).append(this.helper), this.helper.css({
                left: e.pageX,
                top: e.pageY,
                width: 0,
                height: 0
            }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function() {
                var s = t.data(this, "selectable-item");
                s.startselected = !0, e.metaKey || e.ctrlKey || (s.$element.removeClass("ui-selected"), 
                s.selected = !1, s.$element.addClass("ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", e, {
                    unselecting: s.element
                }));
            }), t(e.target).parents().addBack().each(function() {
                var s, n = t.data(this, "selectable-item");
                return n ? (s = !e.metaKey && !e.ctrlKey || !n.$element.hasClass("ui-selected"), 
                n.$element.removeClass(s ? "ui-unselecting" : "ui-selected").addClass(s ? "ui-selecting" : "ui-unselecting"), 
                n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", e, {
                    selecting: n.element
                }) : i._trigger("unselecting", e, {
                    unselecting: n.element
                }), !1) : void 0;
            }));
        },
        _mouseDrag: function(e) {
            if (this.dragged = !0, !this.options.disabled) {
                var i, s = this, n = this.options, a = this.opos[0], o = this.opos[1], r = e.pageX, h = e.pageY;
                return a > r && (i = r, r = a, a = i), o > h && (i = h, h = o, o = i), this.helper.css({
                    left: a,
                    top: o,
                    width: r - a,
                    height: h - o
                }), this.selectees.each(function() {
                    var i = t.data(this, "selectable-item"), l = !1;
                    i && i.element !== s.element[0] && ("touch" === n.tolerance ? l = !(i.left > r || a > i.right || i.top > h || o > i.bottom) : "fit" === n.tolerance && (l = i.left > a && r > i.right && i.top > o && h > i.bottom), 
                    l ? (i.selected && (i.$element.removeClass("ui-selected"), i.selected = !1), i.unselecting && (i.$element.removeClass("ui-unselecting"), 
                    i.unselecting = !1), i.selecting || (i.$element.addClass("ui-selecting"), i.selecting = !0, 
                    s._trigger("selecting", e, {
                        selecting: i.element
                    }))) : (i.selecting && ((e.metaKey || e.ctrlKey) && i.startselected ? (i.$element.removeClass("ui-selecting"), 
                    i.selecting = !1, i.$element.addClass("ui-selected"), i.selected = !0) : (i.$element.removeClass("ui-selecting"), 
                    i.selecting = !1, i.startselected && (i.$element.addClass("ui-unselecting"), i.unselecting = !0), 
                    s._trigger("unselecting", e, {
                        unselecting: i.element
                    }))), i.selected && (e.metaKey || e.ctrlKey || i.startselected || (i.$element.removeClass("ui-selected"), 
                    i.selected = !1, i.$element.addClass("ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", e, {
                        unselecting: i.element
                    })))));
                }), !1;
            }
        },
        _mouseStop: function(e) {
            var i = this;
            return this.dragged = !1, t(".ui-unselecting", this.element[0]).each(function() {
                var s = t.data(this, "selectable-item");
                s.$element.removeClass("ui-unselecting"), s.unselecting = !1, s.startselected = !1, 
                i._trigger("unselected", e, {
                    unselected: s.element
                });
            }), t(".ui-selecting", this.element[0]).each(function() {
                var s = t.data(this, "selectable-item");
                s.$element.removeClass("ui-selecting").addClass("ui-selected"), s.selecting = !1, 
                s.selected = !0, s.startselected = !0, i._trigger("selected", e, {
                    selected: s.element
                });
            }), this._trigger("stop", e), this.helper.remove(), !1;
        }
    }), t.widget("ui.sortable", t.ui.mouse, {
        version: "1.11.4",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1e3,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _isOverAxis: function(t, e, i) {
            return t >= e && e + i > t;
        },
        _isFloating: function(t) {
            return /left|right/.test(t.css("float")) || /inline|table-cell/.test(t.css("display"));
        },
        _create: function() {
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), 
            this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), 
            this.ready = !0;
        },
        _setOption: function(t, e) {
            this._super(t, e), "handle" === t && this._setHandleClassName();
        },
        _setHandleClassName: function() {
            this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"), t.each(this.items, function() {
                (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle");
            });
        },
        _destroy: function() {
            this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"), 
            this._mouseDestroy();
            for (var t = this.items.length - 1; t >= 0; t--) this.items[t].item.removeData(this.widgetName + "-item");
            return this;
        },
        _mouseCapture: function(e, i) {
            var s = null, n = !1, a = this;
            return !this.reverting && (!this.options.disabled && "static" !== this.options.type && (this._refreshItems(e), 
            t(e.target).parents().each(function() {
                return t.data(this, a.widgetName + "-item") === a ? (s = t(this), !1) : void 0;
            }), t.data(e.target, a.widgetName + "-item") === a && (s = t(e.target)), !!s && (!(this.options.handle && !i && (t(this.options.handle, s).find("*").addBack().each(function() {
                this === e.target && (n = !0);
            }), !n)) && (this.currentItem = s, this._removeCurrentsFromItems(), !0))));
        },
        _mouseStart: function(e, i, s) {
            var n, a, o = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(e), 
            this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), 
            this.offset = this.currentItem.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, t.extend(this.offset, {
                click: {
                    left: e.pageX - this.offset.left,
                    top: e.pageY - this.offset.top
                },
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), 
            this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, 
            this.originalPageY = e.pageY, o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt), 
            this.domPosition = {
                prev: this.currentItem.prev()[0],
                parent: this.currentItem.parent()[0]
            }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), 
            o.containment && this._setContainment(), o.cursor && "auto" !== o.cursor && (a = this.document.find("body"), 
            this.storedCursor = a.css("cursor"), a.css("cursor", o.cursor), this.storedStylesheet = t("<style>*{ cursor: " + o.cursor + " !important; }</style>").appendTo(a)), 
            o.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), 
            this.helper.css("opacity", o.opacity)), o.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), 
            this.helper.css("zIndex", o.zIndex)), this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), 
            this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), 
            !s) for (n = this.containers.length - 1; n >= 0; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
            return t.ui.ddmanager && (t.ui.ddmanager.current = this), t.ui.ddmanager && !o.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), 
            this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(e), 
            !0;
        },
        _mouseDrag: function(e) {
            var i, s, n, a, o = this.options, r = !1;
            for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), 
            this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < o.scrollSensitivity ? this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop + o.scrollSpeed : e.pageY - this.overflowOffset.top < o.scrollSensitivity && (this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop - o.scrollSpeed), 
            this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < o.scrollSensitivity ? this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft + o.scrollSpeed : e.pageX - this.overflowOffset.left < o.scrollSensitivity && (this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft - o.scrollSpeed)) : (e.pageY - this.document.scrollTop() < o.scrollSensitivity ? r = this.document.scrollTop(this.document.scrollTop() - o.scrollSpeed) : this.window.height() - (e.pageY - this.document.scrollTop()) < o.scrollSensitivity && (r = this.document.scrollTop(this.document.scrollTop() + o.scrollSpeed)), 
            e.pageX - this.document.scrollLeft() < o.scrollSensitivity ? r = this.document.scrollLeft(this.document.scrollLeft() - o.scrollSpeed) : this.window.width() - (e.pageX - this.document.scrollLeft()) < o.scrollSensitivity && (r = this.document.scrollLeft(this.document.scrollLeft() + o.scrollSpeed))), 
            !1 !== r && t.ui.ddmanager && !o.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e)), 
            this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), 
            this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), 
            i = this.items.length - 1; i >= 0; i--) if (s = this.items[i], n = s.item[0], (a = this._intersectsWithPointer(s)) && s.instance === this.currentContainer && n !== this.currentItem[0] && this.placeholder[1 === a ? "next" : "prev"]()[0] !== n && !t.contains(this.placeholder[0], n) && ("semi-dynamic" !== this.options.type || !t.contains(this.element[0], n))) {
                if (this.direction = 1 === a ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
                this._rearrange(e, s), this._trigger("change", e, this._uiHash());
                break;
            }
            return this._contactContainers(e), t.ui.ddmanager && t.ui.ddmanager.drag(this, e), 
            this._trigger("sort", e, this._uiHash()), this.lastPositionAbs = this.positionAbs, 
            !1;
        },
        _mouseStop: function(e, i) {
            if (e) {
                if (t.ui.ddmanager && !this.options.dropBehaviour && t.ui.ddmanager.drop(this, e), 
                this.options.revert) {
                    var s = this, n = this.placeholder.offset(), a = this.options.axis, o = {};
                    a && "x" !== a || (o.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollLeft)), 
                    a && "y" !== a || (o.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollTop)), 
                    this.reverting = !0, t(this.helper).animate(o, parseInt(this.options.revert, 10) || 500, function() {
                        s._clear(e);
                    });
                } else this._clear(e, i);
                return !1;
            }
        },
        cancel: function() {
            if (this.dragging) {
                this._mouseUp({
                    target: null
                }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)), 
                this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), 
                this.containers[e].containerCache.over = 0);
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), 
            "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), 
            t.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? t(this.domPosition.prev).after(this.currentItem) : t(this.domPosition.parent).prepend(this.currentItem)), 
            this;
        },
        serialize: function(e) {
            var i = this._getItemsAsjQuery(e && e.connected), s = [];
            return e = e || {}, t(i).each(function() {
                var i = (t(e.item || this).attr(e.attribute || "id") || "").match(e.expression || /(.+)[\-=_](.+)/);
                i && s.push((e.key || i[1] + "[]") + "=" + (e.key && e.expression ? i[1] : i[2]));
            }), !s.length && e.key && s.push(e.key + "="), s.join("&");
        },
        toArray: function(e) {
            var i = this._getItemsAsjQuery(e && e.connected), s = [];
            return e = e || {}, i.each(function() {
                s.push(t(e.item || this).attr(e.attribute || "id") || "");
            }), s;
        },
        _intersectsWith: function(t) {
            var e = this.positionAbs.left, i = e + this.helperProportions.width, s = this.positionAbs.top, n = s + this.helperProportions.height, a = t.left, o = a + t.width, r = t.top, h = r + t.height, l = this.offset.click.top, u = this.offset.click.left, c = "x" === this.options.axis || s + l > r && h > s + l, d = "y" === this.options.axis || e + u > a && o > e + u, p = c && d;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > t[this.floating ? "width" : "height"] ? p : e + this.helperProportions.width / 2 > a && o > i - this.helperProportions.width / 2 && s + this.helperProportions.height / 2 > r && h > n - this.helperProportions.height / 2;
        },
        _intersectsWithPointer: function(t) {
            var e = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top, t.height), i = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left, t.width), s = e && i, n = this._getDragVerticalDirection(), a = this._getDragHorizontalDirection();
            return !!s && (this.floating ? a && "right" === a || "down" === n ? 2 : 1 : n && ("down" === n ? 2 : 1));
        },
        _intersectsWithSides: function(t) {
            var e = this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top + t.height / 2, t.height), i = this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left + t.width / 2, t.width), s = this._getDragVerticalDirection(), n = this._getDragHorizontalDirection();
            return this.floating && n ? "right" === n && i || "left" === n && !i : s && ("down" === s && e || "up" === s && !e);
        },
        _getDragVerticalDirection: function() {
            var t = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== t && (t > 0 ? "down" : "up");
        },
        _getDragHorizontalDirection: function() {
            var t = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== t && (t > 0 ? "right" : "left");
        },
        refresh: function(t) {
            return this._refreshItems(t), this._setHandleClassName(), this.refreshPositions(), 
            this;
        },
        _connectWith: function() {
            var t = this.options;
            return t.connectWith.constructor === String ? [ t.connectWith ] : t.connectWith;
        },
        _getItemsAsjQuery: function(e) {
            function i() {
                r.push(this);
            }
            var s, n, a, o, r = [], h = [], l = this._connectWith();
            if (l && e) for (s = l.length - 1; s >= 0; s--) for (a = t(l[s], this.document[0]), 
            n = a.length - 1; n >= 0; n--) (o = t.data(a[n], this.widgetFullName)) && o !== this && !o.options.disabled && h.push([ t.isFunction(o.options.items) ? o.options.items.call(o.element) : t(o.options.items, o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), o ]);
            for (h.push([ t.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                options: this.options,
                item: this.currentItem
            }) : t(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this ]), 
            s = h.length - 1; s >= 0; s--) h[s][0].each(i);
            return t(r);
        },
        _removeCurrentsFromItems: function() {
            var e = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = t.grep(this.items, function(t) {
                for (var i = 0; e.length > i; i++) if (e[i] === t.item[0]) return !1;
                return !0;
            });
        },
        _refreshItems: function(e) {
            this.items = [], this.containers = [ this ];
            var i, s, n, a, o, r, h, l, u = this.items, c = [ [ t.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {
                item: this.currentItem
            }) : t(this.options.items, this.element), this ] ], d = this._connectWith();
            if (d && this.ready) for (i = d.length - 1; i >= 0; i--) for (n = t(d[i], this.document[0]), 
            s = n.length - 1; s >= 0; s--) (a = t.data(n[s], this.widgetFullName)) && a !== this && !a.options.disabled && (c.push([ t.isFunction(a.options.items) ? a.options.items.call(a.element[0], e, {
                item: this.currentItem
            }) : t(a.options.items, a.element), a ]), this.containers.push(a));
            for (i = c.length - 1; i >= 0; i--) for (o = c[i][1], r = c[i][0], s = 0, l = r.length; l > s; s++) h = t(r[s]), 
            h.data(this.widgetName + "-item", o), u.push({
                item: h,
                instance: o,
                width: 0,
                height: 0,
                left: 0,
                top: 0
            });
        },
        refreshPositions: function(e) {
            this.floating = !!this.items.length && ("x" === this.options.axis || this._isFloating(this.items[0].item)), 
            this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var i, s, n, a;
            for (i = this.items.length - 1; i >= 0; i--) s = this.items[i], s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? t(this.options.toleranceElement, s.item) : s.item, 
            e || (s.width = n.outerWidth(), s.height = n.outerHeight()), a = n.offset(), s.left = a.left, 
            s.top = a.top);
            if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this); else for (i = this.containers.length - 1; i >= 0; i--) a = this.containers[i].element.offset(), 
            this.containers[i].containerCache.left = a.left, this.containers[i].containerCache.top = a.top, 
            this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), 
            this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
            return this;
        },
        _createPlaceholder: function(e) {
            e = e || this;
            var i, s = e.options;
            s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
                element: function() {
                    var s = e.currentItem[0].nodeName.toLowerCase(), n = t("<" + s + ">", e.document[0]).addClass(i || e.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tbody" === s ? e._createTrPlaceholder(e.currentItem.find("tr").eq(0), t("<tr>", e.document[0]).appendTo(n)) : "tr" === s ? e._createTrPlaceholder(e.currentItem, n) : "img" === s && n.attr("src", e.currentItem.attr("src")), 
                    i || n.css("visibility", "hidden"), n;
                },
                update: function(t, n) {
                    (!i || s.forcePlaceholderSize) && (n.height() || n.height(e.currentItem.innerHeight() - parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), 
                    n.width() || n.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10)));
                }
            }), e.placeholder = t(s.placeholder.element.call(e.element, e.currentItem)), e.currentItem.after(e.placeholder), 
            s.placeholder.update(e, e.placeholder);
        },
        _createTrPlaceholder: function(e, i) {
            var s = this;
            e.children().each(function() {
                t("<td>&#160;</td>", s.document[0]).attr("colspan", t(this).attr("colspan") || 1).appendTo(i);
            });
        },
        _contactContainers: function(e) {
            var i, s, n, a, o, r, h, l, u, c, d = null, p = null;
            for (i = this.containers.length - 1; i >= 0; i--) if (!t.contains(this.currentItem[0], this.containers[i].element[0])) if (this._intersectsWith(this.containers[i].containerCache)) {
                if (d && t.contains(this.containers[i].element[0], d.element[0])) continue;
                d = this.containers[i], p = i;
            } else this.containers[i].containerCache.over && (this.containers[i]._trigger("out", e, this._uiHash(this)), 
            this.containers[i].containerCache.over = 0);
            if (d) if (1 === this.containers.length) this.containers[p].containerCache.over || (this.containers[p]._trigger("over", e, this._uiHash(this)), 
            this.containers[p].containerCache.over = 1); else {
                for (n = 1e4, a = null, u = d.floating || this._isFloating(this.currentItem), o = u ? "left" : "top", 
                r = u ? "width" : "height", c = u ? "clientX" : "clientY", s = this.items.length - 1; s >= 0; s--) t.contains(this.containers[p].element[0], this.items[s].item[0]) && this.items[s].item[0] !== this.currentItem[0] && (h = this.items[s].item.offset()[o], 
                l = !1, e[c] - h > this.items[s][r] / 2 && (l = !0), n > Math.abs(e[c] - h) && (n = Math.abs(e[c] - h), 
                a = this.items[s], this.direction = l ? "up" : "down"));
                if (!a && !this.options.dropOnEmpty) return;
                if (this.currentContainer === this.containers[p]) return void (this.currentContainer.containerCache.over || (this.containers[p]._trigger("over", e, this._uiHash()), 
                this.currentContainer.containerCache.over = 1));
                a ? this._rearrange(e, a, null, !0) : this._rearrange(e, null, this.containers[p].element, !0), 
                this._trigger("change", e, this._uiHash()), this.containers[p]._trigger("change", e, this._uiHash(this)), 
                this.currentContainer = this.containers[p], this.options.placeholder.update(this.currentContainer, this.placeholder), 
                this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1;
            }
        },
        _createHelper: function(e) {
            var i = this.options, s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [ e, this.currentItem ])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
            return s.parents("body").length || t("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), 
            s[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), (!s[0].style.width || i.forceHelperSize) && s.width(this.currentItem.width()), 
            (!s[0].style.height || i.forceHelperSize) && s.height(this.currentItem.height()), 
            s;
        },
        _adjustOffsetFromHelper: function(e) {
            "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                left: +e[0],
                top: +e[1] || 0
            }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), 
            "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top);
        },
        _getParentOffset: function() {
            this.offsetParent = this.helper.offsetParent();
            var e = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== this.document[0] && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), 
            e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === this.document[0].body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                top: 0,
                left: 0
            }), {
                top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            };
        },
        _getRelativeOffset: function() {
            if ("relative" === this.cssPosition) {
                var t = this.currentItem.position();
                return {
                    top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                };
            }
            return {
                top: 0,
                left: 0
            };
        },
        _cacheMargins: function() {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            };
        },
        _cacheHelperProportions: function() {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            };
        },
        _setContainment: function() {
            var e, i, s, n = this.options;
            "parent" === n.containment && (n.containment = this.helper[0].parentNode), ("document" === n.containment || "window" === n.containment) && (this.containment = [ 0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, "document" === n.containment ? this.document.width() : this.window.width() - this.helperProportions.width - this.margins.left, ("document" === n.containment ? this.document.width() : this.window.height() || this.document[0].body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top ]), 
            /^(document|window|parent)$/.test(n.containment) || (e = t(n.containment)[0], i = t(n.containment).offset(), 
            s = "hidden" !== t(e).css("overflow"), this.containment = [ i.left + (parseInt(t(e).css("borderLeftWidth"), 10) || 0) + (parseInt(t(e).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(t(e).css("borderTopWidth"), 10) || 0) + (parseInt(t(e).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(t(e).css("borderLeftWidth"), 10) || 0) - (parseInt(t(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(t(e).css("borderTopWidth"), 10) || 0) - (parseInt(t(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top ]);
        },
        _convertPositionTo: function(e, i) {
            i || (i = this.position);
            var s = "absolute" === e ? 1 : -1, n = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent, a = /(html|body)/i.test(n[0].tagName);
            return {
                top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : a ? 0 : n.scrollTop()) * s,
                left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : a ? 0 : n.scrollLeft()) * s
            };
        },
        _generatePosition: function(e) {
            var i, s, n = this.options, a = e.pageX, o = e.pageY, r = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent, h = /(html|body)/i.test(r[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), 
            this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (a = this.containment[0] + this.offset.click.left), 
            e.pageY - this.offset.click.top < this.containment[1] && (o = this.containment[1] + this.offset.click.top), 
            e.pageX - this.offset.click.left > this.containment[2] && (a = this.containment[2] + this.offset.click.left), 
            e.pageY - this.offset.click.top > this.containment[3] && (o = this.containment[3] + this.offset.click.top)), 
            n.grid && (i = this.originalPageY + Math.round((o - this.originalPageY) / n.grid[1]) * n.grid[1], 
            o = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, 
            s = this.originalPageX + Math.round((a - this.originalPageX) / n.grid[0]) * n.grid[0], 
            a = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)), 
            {
                top: o - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : h ? 0 : r.scrollTop()),
                left: a - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : h ? 0 : r.scrollLeft())
            };
        },
        _rearrange: function(t, e, i, s) {
            i ? i[0].appendChild(this.placeholder[0]) : e.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? e.item[0] : e.item[0].nextSibling), 
            this.counter = this.counter ? ++this.counter : 1;
            var n = this.counter;
            this._delay(function() {
                n === this.counter && this.refreshPositions(!s);
            });
        },
        _clear: function(t, e) {
            function i(t, e, i) {
                return function(s) {
                    i._trigger(t, s, e._uiHash(e));
                };
            }
            this.reverting = !1;
            var s, n = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), 
            this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (s in this._storedCSS) ("auto" === this._storedCSS[s] || "static" === this._storedCSS[s]) && (this._storedCSS[s] = "");
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper");
            } else this.currentItem.show();
            for (this.fromOutside && !e && n.push(function(t) {
                this._trigger("receive", t, this._uiHash(this.fromOutside));
            }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || e || n.push(function(t) {
                this._trigger("update", t, this._uiHash());
            }), this !== this.currentContainer && (e || (n.push(function(t) {
                this._trigger("remove", t, this._uiHash());
            }), n.push(function(t) {
                return function(e) {
                    t._trigger("receive", e, this._uiHash(this));
                };
            }.call(this, this.currentContainer)), n.push(function(t) {
                return function(e) {
                    t._trigger("update", e, this._uiHash(this));
                };
            }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) e || n.push(i("deactivate", this, this.containers[s])), 
            this.containers[s].containerCache.over && (n.push(i("out", this, this.containers[s])), 
            this.containers[s].containerCache.over = 0);
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), 
            this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), 
            this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), 
            this.dragging = !1, e || this._trigger("beforeStop", t, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), 
            this.cancelHelperRemoval || (this.helper[0] !== this.currentItem[0] && this.helper.remove(), 
            this.helper = null), !e) {
                for (s = 0; n.length > s; s++) n[s].call(this, t);
                this._trigger("stop", t, this._uiHash());
            }
            return this.fromOutside = !1, !this.cancelHelperRemoval;
        },
        _trigger: function() {
            !1 === t.Widget.prototype._trigger.apply(this, arguments) && this.cancel();
        },
        _uiHash: function(e) {
            var i = e || this;
            return {
                helper: i.helper,
                placeholder: i.placeholder || t([]),
                position: i.position,
                originalPosition: i.originalPosition,
                offset: i.positionAbs,
                item: i.currentItem,
                sender: e ? e.element : null
            };
        }
    });
}), function(factory) {
    "use strict";
    "function" == typeof define && define.amd ? define([ "jquery" ], factory) : "undefined" != typeof module && module.exports ? module.exports = factory(require("jquery")) : factory(jQuery);
}(function($) {
    var _previousResizeWidth = -1, _updateTimeout = -1, _parse = function(value) {
        return parseFloat(value) || 0;
    }, _rows = function(elements) {
        var $elements = $(elements), lastTop = null, rows = [];
        return $elements.each(function() {
            var $that = $(this), top = $that.offset().top - _parse($that.css("margin-top")), lastRow = rows.length > 0 ? rows[rows.length - 1] : null;
            null === lastRow ? rows.push($that) : Math.floor(Math.abs(lastTop - top)) <= 1 ? rows[rows.length - 1] = lastRow.add($that) : rows.push($that), 
            lastTop = top;
        }), rows;
    }, _parseOptions = function(options) {
        var opts = {
            byRow: !0,
            property: "height",
            target: null,
            remove: !1
        };
        return "object" == typeof options ? $.extend(opts, options) : ("boolean" == typeof options ? opts.byRow = options : "remove" === options && (opts.remove = !0), 
        opts);
    }, matchHeight = $.fn.matchHeight = function(options) {
        var opts = _parseOptions(options);
        if (opts.remove) {
            var that = this;
            return this.css(opts.property, ""), $.each(matchHeight._groups, function(key, group) {
                group.elements = group.elements.not(that);
            }), this;
        }
        return this.length <= 1 && !opts.target ? this : (matchHeight._groups.push({
            elements: this,
            options: opts
        }), matchHeight._apply(this, opts), this);
    };
    matchHeight.version = "master", matchHeight._groups = [], matchHeight._throttle = 80, 
    matchHeight._maintainScroll = !1, matchHeight._beforeUpdate = null, matchHeight._afterUpdate = null, 
    matchHeight._rows = _rows, matchHeight._parse = _parse, matchHeight._parseOptions = _parseOptions, 
    matchHeight._apply = function(elements, options) {
        var opts = _parseOptions(options), $elements = $(elements), rows = [ $elements ], scrollTop = $(window).scrollTop(), htmlHeight = $("html").outerHeight(!0), $hiddenParents = $elements.parents().filter(":hidden");
        return $hiddenParents.each(function() {
            var $that = $(this);
            $that.data("style-cache", $that.attr("style"));
        }), $hiddenParents.css("display", "block"), opts.byRow && !opts.target && ($elements.each(function() {
            var $that = $(this), display = $that.css("display");
            "inline-block" !== display && "flex" !== display && "inline-flex" !== display && (display = "block"), 
            $that.data("style-cache", $that.attr("style")), $that.css({
                display: display,
                "padding-top": "0",
                "padding-bottom": "0",
                "margin-top": "0",
                "margin-bottom": "0",
                "border-top-width": "0",
                "border-bottom-width": "0",
                height: "100px",
                overflow: "hidden"
            });
        }), rows = _rows($elements), $elements.each(function() {
            var $that = $(this);
            $that.attr("style", $that.data("style-cache") || "");
        })), $.each(rows, function(key, row) {
            var $row = $(row), targetHeight = 0;
            if (opts.target) targetHeight = opts.target.outerHeight(!1); else {
                if (opts.byRow && $row.length <= 1) return void $row.css(opts.property, "");
                $row.each(function() {
                    var $that = $(this), display = $that.css("display");
                    "inline-block" !== display && "flex" !== display && "inline-flex" !== display && (display = "block");
                    var css = {
                        display: display
                    };
                    css[opts.property] = "", $that.css(css), $that.outerHeight(!1) > targetHeight && (targetHeight = $that.outerHeight(!1)), 
                    $that.css("display", "");
                });
            }
            $row.each(function() {
                var $that = $(this), verticalPadding = 0;
                opts.target && $that.is(opts.target) || ("border-box" !== $that.css("box-sizing") && (verticalPadding += _parse($that.css("border-top-width")) + _parse($that.css("border-bottom-width")), 
                verticalPadding += _parse($that.css("padding-top")) + _parse($that.css("padding-bottom"))), 
                $that.css(opts.property, targetHeight - verticalPadding + "px"));
            });
        }), $hiddenParents.each(function() {
            var $that = $(this);
            $that.attr("style", $that.data("style-cache") || null);
        }), matchHeight._maintainScroll && $(window).scrollTop(scrollTop / htmlHeight * $("html").outerHeight(!0)), 
        this;
    }, matchHeight._applyDataApi = function() {
        var groups = {};
        $("[data-match-height], [data-mh]").each(function() {
            var $this = $(this), groupId = $this.attr("data-mh") || $this.attr("data-match-height");
            groups[groupId] = groupId in groups ? groups[groupId].add($this) : $this;
        }), $.each(groups, function() {
            this.matchHeight(!0);
        });
    };
    var _update = function(event) {
        matchHeight._beforeUpdate && matchHeight._beforeUpdate(event, matchHeight._groups), 
        $.each(matchHeight._groups, function() {
            matchHeight._apply(this.elements, this.options);
        }), matchHeight._afterUpdate && matchHeight._afterUpdate(event, matchHeight._groups);
    };
    matchHeight._update = function(throttle, event) {
        if (event && "resize" === event.type) {
            var windowWidth = $(window).width();
            if (windowWidth === _previousResizeWidth) return;
            _previousResizeWidth = windowWidth;
        }
        throttle ? -1 === _updateTimeout && (_updateTimeout = setTimeout(function() {
            _update(event), _updateTimeout = -1;
        }, matchHeight._throttle)) : _update(event);
    }, $(matchHeight._applyDataApi), $(window).bind("load", function(event) {
        matchHeight._update(!1, event);
    }), $(window).bind("resize orientationchange", function(event) {
        matchHeight._update(!0, event);
    });
}), function($) {
    $.fn.labelHint = function(options) {
        var $fieldWrap = $(this), theInput = $fieldWrap.find("input"), theTextarea = $fieldWrap.find("textarea"), theSelect = $fieldWrap.find("select"), changeState = function() {
            var label = $(this).closest($fieldWrap).find("label");
            "" !== this.value ? label.addClass("show") : label.removeClass("show");
        };
        theInput.add(theTextarea).bind("checkval", changeState), theSelect.bind("checkval", changeState), 
        theInput.add(theTextarea).on("keyup", function() {
            $(this).trigger("checkval");
        }).on("focus", function() {
            $(this).closest($fieldWrap).find("label").addClass("on");
        }).on("blur", function() {
            $(this).closest($fieldWrap).find("label").removeClass("on");
        }).trigger("checkval"), theInput.add(theTextarea).on("change", changeState), theSelect.on("change", changeState).trigger("checkval");
    };
}(jQuery), function($) {
    $.fn.limitinput = function(options) {
        return this.each(function() {
            var target = this, curLimit = 0, removeLimit = !1, curVal = $(this).val(), curLength = curVal.length, classes = $(this).attr("class").split(/\s+/), plugin = {
                init: function() {
                    $("<div class='input-limit'></div>").insertAfter($(target)), plugin.runThrough();
                },
                runThrough: function() {
                    curVal = $(target).val(), curLength = curVal.length, plugin.setLimit(), plugin.toTheLimit();
                },
                setLimit: function() {
                    $.each(classes, function(index, item) {
                        "charLimit_" == item.substr(0, 10) && (curLimit = item.substr(10)), "removeLimit" == item && (removeLimit = !0);
                    });
                },
                toTheLimit: function() {
                    curLength >= curLimit && (target.value = target.value.substring(0, curLimit), curLength = curLimit), 
                    curLimit > 0 && (1 == removeLimit && curLength > curLimit && ($(this).val(curVal.substr(0, curLimit)), 
                    curLength = curLimit), $(target).parent().find(".input-limit").html(curLimit - curLength + " of " + curLimit + " characters remaining."));
                }
            };
            plugin.init(), $(this).bind("input", function(event) {
                plugin.runThrough();
            }), $(this).bind("paste", function(event) {
                setTimeout(function() {
                    plugin.runThrough();
                }, 100);
            });
        });
    };
}(jQuery), function(global, factory) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = factory() : "function" == typeof define && define.amd ? define(factory) : global.moment = factory();
}(this, function() {
    "use strict";
    function hooks() {
        return hookCallback.apply(null, arguments);
    }
    function isArray(input) {
        return input instanceof Array || "[object Array]" === Object.prototype.toString.call(input);
    }
    function isObject(input) {
        return null != input && "[object Object]" === Object.prototype.toString.call(input);
    }
    function isObjectEmpty(obj) {
        var k;
        for (k in obj) return !1;
        return !0;
    }
    function isUndefined(input) {
        return void 0 === input;
    }
    function isNumber(input) {
        return "number" == typeof input || "[object Number]" === Object.prototype.toString.call(input);
    }
    function isDate(input) {
        return input instanceof Date || "[object Date]" === Object.prototype.toString.call(input);
    }
    function map(arr, fn) {
        var i, res = [];
        for (i = 0; i < arr.length; ++i) res.push(fn(arr[i], i));
        return res;
    }
    function hasOwnProp(a, b) {
        return Object.prototype.hasOwnProperty.call(a, b);
    }
    function extend(a, b) {
        for (var i in b) hasOwnProp(b, i) && (a[i] = b[i]);
        return hasOwnProp(b, "toString") && (a.toString = b.toString), hasOwnProp(b, "valueOf") && (a.valueOf = b.valueOf), 
        a;
    }
    function createUTC(input, format, locale, strict) {
        return createLocalOrUTC(input, format, locale, strict, !0).utc();
    }
    function defaultParsingFlags() {
        return {
            empty: !1,
            unusedTokens: [],
            unusedInput: [],
            overflow: -2,
            charsLeftOver: 0,
            nullInput: !1,
            invalidMonth: null,
            invalidFormat: !1,
            userInvalidated: !1,
            iso: !1,
            parsedDateParts: [],
            meridiem: null,
            rfc2822: !1,
            weekdayMismatch: !1
        };
    }
    function getParsingFlags(m) {
        return null == m._pf && (m._pf = defaultParsingFlags()), m._pf;
    }
    function isValid(m) {
        if (null == m._isValid) {
            var flags = getParsingFlags(m), parsedParts = some$1.call(flags.parsedDateParts, function(i) {
                return null != i;
            }), isNowValid = !isNaN(m._d.getTime()) && flags.overflow < 0 && !flags.empty && !flags.invalidMonth && !flags.invalidWeekday && !flags.nullInput && !flags.invalidFormat && !flags.userInvalidated && (!flags.meridiem || flags.meridiem && parsedParts);
            if (m._strict && (isNowValid = isNowValid && 0 === flags.charsLeftOver && 0 === flags.unusedTokens.length && void 0 === flags.bigHour), 
            null != Object.isFrozen && Object.isFrozen(m)) return isNowValid;
            m._isValid = isNowValid;
        }
        return m._isValid;
    }
    function createInvalid(flags) {
        var m = createUTC(NaN);
        return null != flags ? extend(getParsingFlags(m), flags) : getParsingFlags(m).userInvalidated = !0, 
        m;
    }
    function copyConfig(to, from) {
        var i, prop, val;
        if (isUndefined(from._isAMomentObject) || (to._isAMomentObject = from._isAMomentObject), 
        isUndefined(from._i) || (to._i = from._i), isUndefined(from._f) || (to._f = from._f), 
        isUndefined(from._l) || (to._l = from._l), isUndefined(from._strict) || (to._strict = from._strict), 
        isUndefined(from._tzm) || (to._tzm = from._tzm), isUndefined(from._isUTC) || (to._isUTC = from._isUTC), 
        isUndefined(from._offset) || (to._offset = from._offset), isUndefined(from._pf) || (to._pf = getParsingFlags(from)), 
        isUndefined(from._locale) || (to._locale = from._locale), momentProperties.length > 0) for (i = 0; i < momentProperties.length; i++) prop = momentProperties[i], 
        val = from[prop], isUndefined(val) || (to[prop] = val);
        return to;
    }
    function Moment(config) {
        copyConfig(this, config), this._d = new Date(null != config._d ? config._d.getTime() : NaN), 
        this.isValid() || (this._d = new Date(NaN)), !1 === updateInProgress && (updateInProgress = !0, 
        hooks.updateOffset(this), updateInProgress = !1);
    }
    function isMoment(obj) {
        return obj instanceof Moment || null != obj && null != obj._isAMomentObject;
    }
    function absFloor(number) {
        return number < 0 ? Math.ceil(number) || 0 : Math.floor(number);
    }
    function toInt(argumentForCoercion) {
        var coercedNumber = +argumentForCoercion, value = 0;
        return 0 !== coercedNumber && isFinite(coercedNumber) && (value = absFloor(coercedNumber)), 
        value;
    }
    function compareArrays(array1, array2, dontConvert) {
        var i, len = Math.min(array1.length, array2.length), lengthDiff = Math.abs(array1.length - array2.length), diffs = 0;
        for (i = 0; i < len; i++) (dontConvert && array1[i] !== array2[i] || !dontConvert && toInt(array1[i]) !== toInt(array2[i])) && diffs++;
        return diffs + lengthDiff;
    }
    function warn(msg) {
        !1 === hooks.suppressDeprecationWarnings && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + msg);
    }
    function deprecate(msg, fn) {
        var firstTime = !0;
        return extend(function() {
            if (null != hooks.deprecationHandler && hooks.deprecationHandler(null, msg), firstTime) {
                for (var arg, args = [], i = 0; i < arguments.length; i++) {
                    if (arg = "", "object" == typeof arguments[i]) {
                        arg += "\n[" + i + "] ";
                        for (var key in arguments[0]) arg += key + ": " + arguments[0][key] + ", ";
                        arg = arg.slice(0, -2);
                    } else arg = arguments[i];
                    args.push(arg);
                }
                warn(msg + "\nArguments: " + Array.prototype.slice.call(args).join("") + "\n" + new Error().stack), 
                firstTime = !1;
            }
            return fn.apply(this, arguments);
        }, fn);
    }
    function deprecateSimple(name, msg) {
        null != hooks.deprecationHandler && hooks.deprecationHandler(name, msg), deprecations[name] || (warn(msg), 
        deprecations[name] = !0);
    }
    function isFunction(input) {
        return input instanceof Function || "[object Function]" === Object.prototype.toString.call(input);
    }
    function set(config) {
        var prop, i;
        for (i in config) prop = config[i], isFunction(prop) ? this[i] = prop : this["_" + i] = prop;
        this._config = config, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source);
    }
    function mergeConfigs(parentConfig, childConfig) {
        var prop, res = extend({}, parentConfig);
        for (prop in childConfig) hasOwnProp(childConfig, prop) && (isObject(parentConfig[prop]) && isObject(childConfig[prop]) ? (res[prop] = {}, 
        extend(res[prop], parentConfig[prop]), extend(res[prop], childConfig[prop])) : null != childConfig[prop] ? res[prop] = childConfig[prop] : delete res[prop]);
        for (prop in parentConfig) hasOwnProp(parentConfig, prop) && !hasOwnProp(childConfig, prop) && isObject(parentConfig[prop]) && (res[prop] = extend({}, res[prop]));
        return res;
    }
    function Locale(config) {
        null != config && this.set(config);
    }
    function calendar(key, mom, now) {
        var output = this._calendar[key] || this._calendar.sameElse;
        return isFunction(output) ? output.call(mom, now) : output;
    }
    function longDateFormat(key) {
        var format = this._longDateFormat[key], formatUpper = this._longDateFormat[key.toUpperCase()];
        return format || !formatUpper ? format : (this._longDateFormat[key] = formatUpper.replace(/MMMM|MM|DD|dddd/g, function(val) {
            return val.slice(1);
        }), this._longDateFormat[key]);
    }
    function invalidDate() {
        return this._invalidDate;
    }
    function ordinal(number) {
        return this._ordinal.replace("%d", number);
    }
    function relativeTime(number, withoutSuffix, string, isFuture) {
        var output = this._relativeTime[string];
        return isFunction(output) ? output(number, withoutSuffix, string, isFuture) : output.replace(/%d/i, number);
    }
    function pastFuture(diff, output) {
        var format = this._relativeTime[diff > 0 ? "future" : "past"];
        return isFunction(format) ? format(output) : format.replace(/%s/i, output);
    }
    function addUnitAlias(unit, shorthand) {
        var lowerCase = unit.toLowerCase();
        aliases[lowerCase] = aliases[lowerCase + "s"] = aliases[shorthand] = unit;
    }
    function normalizeUnits(units) {
        return "string" == typeof units ? aliases[units] || aliases[units.toLowerCase()] : void 0;
    }
    function normalizeObjectUnits(inputObject) {
        var normalizedProp, prop, normalizedInput = {};
        for (prop in inputObject) hasOwnProp(inputObject, prop) && (normalizedProp = normalizeUnits(prop)) && (normalizedInput[normalizedProp] = inputObject[prop]);
        return normalizedInput;
    }
    function addUnitPriority(unit, priority) {
        priorities[unit] = priority;
    }
    function getPrioritizedUnits(unitsObj) {
        var units = [];
        for (var u in unitsObj) units.push({
            unit: u,
            priority: priorities[u]
        });
        return units.sort(function(a, b) {
            return a.priority - b.priority;
        }), units;
    }
    function makeGetSet(unit, keepTime) {
        return function(value) {
            return null != value ? (set$1(this, unit, value), hooks.updateOffset(this, keepTime), 
            this) : get(this, unit);
        };
    }
    function get(mom, unit) {
        return mom.isValid() ? mom._d["get" + (mom._isUTC ? "UTC" : "") + unit]() : NaN;
    }
    function set$1(mom, unit, value) {
        mom.isValid() && mom._d["set" + (mom._isUTC ? "UTC" : "") + unit](value);
    }
    function stringGet(units) {
        return units = normalizeUnits(units), isFunction(this[units]) ? this[units]() : this;
    }
    function stringSet(units, value) {
        if ("object" == typeof units) {
            units = normalizeObjectUnits(units);
            for (var prioritized = getPrioritizedUnits(units), i = 0; i < prioritized.length; i++) this[prioritized[i].unit](units[prioritized[i].unit]);
        } else if (units = normalizeUnits(units), isFunction(this[units])) return this[units](value);
        return this;
    }
    function zeroFill(number, targetLength, forceSign) {
        var absNumber = "" + Math.abs(number), zerosToFill = targetLength - absNumber.length;
        return (number >= 0 ? forceSign ? "+" : "" : "-") + Math.pow(10, Math.max(0, zerosToFill)).toString().substr(1) + absNumber;
    }
    function addFormatToken(token, padded, ordinal, callback) {
        var func = callback;
        "string" == typeof callback && (func = function() {
            return this[callback]();
        }), token && (formatTokenFunctions[token] = func), padded && (formatTokenFunctions[padded[0]] = function() {
            return zeroFill(func.apply(this, arguments), padded[1], padded[2]);
        }), ordinal && (formatTokenFunctions[ordinal] = function() {
            return this.localeData().ordinal(func.apply(this, arguments), token);
        });
    }
    function removeFormattingTokens(input) {
        return input.match(/\[[\s\S]/) ? input.replace(/^\[|\]$/g, "") : input.replace(/\\/g, "");
    }
    function makeFormatFunction(format) {
        var i, length, array = format.match(formattingTokens);
        for (i = 0, length = array.length; i < length; i++) formatTokenFunctions[array[i]] ? array[i] = formatTokenFunctions[array[i]] : array[i] = removeFormattingTokens(array[i]);
        return function(mom) {
            var i, output = "";
            for (i = 0; i < length; i++) output += isFunction(array[i]) ? array[i].call(mom, format) : array[i];
            return output;
        };
    }
    function formatMoment(m, format) {
        return m.isValid() ? (format = expandFormat(format, m.localeData()), formatFunctions[format] = formatFunctions[format] || makeFormatFunction(format), 
        formatFunctions[format](m)) : m.localeData().invalidDate();
    }
    function expandFormat(format, locale) {
        function replaceLongDateFormatTokens(input) {
            return locale.longDateFormat(input) || input;
        }
        var i = 5;
        for (localFormattingTokens.lastIndex = 0; i >= 0 && localFormattingTokens.test(format); ) format = format.replace(localFormattingTokens, replaceLongDateFormatTokens), 
        localFormattingTokens.lastIndex = 0, i -= 1;
        return format;
    }
    function addRegexToken(token, regex, strictRegex) {
        regexes[token] = isFunction(regex) ? regex : function(isStrict, localeData) {
            return isStrict && strictRegex ? strictRegex : regex;
        };
    }
    function getParseRegexForToken(token, config) {
        return hasOwnProp(regexes, token) ? regexes[token](config._strict, config._locale) : new RegExp(unescapeFormat(token));
    }
    function unescapeFormat(s) {
        return regexEscape(s.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function(matched, p1, p2, p3, p4) {
            return p1 || p2 || p3 || p4;
        }));
    }
    function regexEscape(s) {
        return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
    }
    function addParseToken(token, callback) {
        var i, func = callback;
        for ("string" == typeof token && (token = [ token ]), isNumber(callback) && (func = function(input, array) {
            array[callback] = toInt(input);
        }), i = 0; i < token.length; i++) tokens[token[i]] = func;
    }
    function addWeekParseToken(token, callback) {
        addParseToken(token, function(input, array, config, token) {
            config._w = config._w || {}, callback(input, config._w, config, token);
        });
    }
    function addTimeToArrayFromToken(token, input, config) {
        null != input && hasOwnProp(tokens, token) && tokens[token](input, config._a, config, token);
    }
    function daysInMonth(year, month) {
        return new Date(Date.UTC(year, month + 1, 0)).getUTCDate();
    }
    function localeMonths(m, format) {
        return m ? isArray(this._months) ? this._months[m.month()] : this._months[(this._months.isFormat || MONTHS_IN_FORMAT).test(format) ? "format" : "standalone"][m.month()] : isArray(this._months) ? this._months : this._months.standalone;
    }
    function localeMonthsShort(m, format) {
        return m ? isArray(this._monthsShort) ? this._monthsShort[m.month()] : this._monthsShort[MONTHS_IN_FORMAT.test(format) ? "format" : "standalone"][m.month()] : isArray(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone;
    }
    function handleStrictParse(monthName, format, strict) {
        var i, ii, mom, llc = monthName.toLocaleLowerCase();
        if (!this._monthsParse) for (this._monthsParse = [], this._longMonthsParse = [], 
        this._shortMonthsParse = [], i = 0; i < 12; ++i) mom = createUTC([ 2e3, i ]), this._shortMonthsParse[i] = this.monthsShort(mom, "").toLocaleLowerCase(), 
        this._longMonthsParse[i] = this.months(mom, "").toLocaleLowerCase();
        return strict ? "MMM" === format ? (ii = indexOf$1.call(this._shortMonthsParse, llc), 
        -1 !== ii ? ii : null) : (ii = indexOf$1.call(this._longMonthsParse, llc), -1 !== ii ? ii : null) : "MMM" === format ? -1 !== (ii = indexOf$1.call(this._shortMonthsParse, llc)) ? ii : (ii = indexOf$1.call(this._longMonthsParse, llc), 
        -1 !== ii ? ii : null) : -1 !== (ii = indexOf$1.call(this._longMonthsParse, llc)) ? ii : (ii = indexOf$1.call(this._shortMonthsParse, llc), 
        -1 !== ii ? ii : null);
    }
    function localeMonthsParse(monthName, format, strict) {
        var i, mom, regex;
        if (this._monthsParseExact) return handleStrictParse.call(this, monthName, format, strict);
        for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), 
        i = 0; i < 12; i++) {
            if (mom = createUTC([ 2e3, i ]), strict && !this._longMonthsParse[i] && (this._longMonthsParse[i] = new RegExp("^" + this.months(mom, "").replace(".", "") + "$", "i"), 
            this._shortMonthsParse[i] = new RegExp("^" + this.monthsShort(mom, "").replace(".", "") + "$", "i")), 
            strict || this._monthsParse[i] || (regex = "^" + this.months(mom, "") + "|^" + this.monthsShort(mom, ""), 
            this._monthsParse[i] = new RegExp(regex.replace(".", ""), "i")), strict && "MMMM" === format && this._longMonthsParse[i].test(monthName)) return i;
            if (strict && "MMM" === format && this._shortMonthsParse[i].test(monthName)) return i;
            if (!strict && this._monthsParse[i].test(monthName)) return i;
        }
    }
    function setMonth(mom, value) {
        var dayOfMonth;
        if (!mom.isValid()) return mom;
        if ("string" == typeof value) if (/^\d+$/.test(value)) value = toInt(value); else if (value = mom.localeData().monthsParse(value), 
        !isNumber(value)) return mom;
        return dayOfMonth = Math.min(mom.date(), daysInMonth(mom.year(), value)), mom._d["set" + (mom._isUTC ? "UTC" : "") + "Month"](value, dayOfMonth), 
        mom;
    }
    function getSetMonth(value) {
        return null != value ? (setMonth(this, value), hooks.updateOffset(this, !0), this) : get(this, "Month");
    }
    function getDaysInMonth() {
        return daysInMonth(this.year(), this.month());
    }
    function monthsShortRegex(isStrict) {
        return this._monthsParseExact ? (hasOwnProp(this, "_monthsRegex") || computeMonthsParse.call(this), 
        isStrict ? this._monthsShortStrictRegex : this._monthsShortRegex) : (hasOwnProp(this, "_monthsShortRegex") || (this._monthsShortRegex = defaultMonthsShortRegex), 
        this._monthsShortStrictRegex && isStrict ? this._monthsShortStrictRegex : this._monthsShortRegex);
    }
    function monthsRegex(isStrict) {
        return this._monthsParseExact ? (hasOwnProp(this, "_monthsRegex") || computeMonthsParse.call(this), 
        isStrict ? this._monthsStrictRegex : this._monthsRegex) : (hasOwnProp(this, "_monthsRegex") || (this._monthsRegex = defaultMonthsRegex), 
        this._monthsStrictRegex && isStrict ? this._monthsStrictRegex : this._monthsRegex);
    }
    function computeMonthsParse() {
        function cmpLenRev(a, b) {
            return b.length - a.length;
        }
        var i, mom, shortPieces = [], longPieces = [], mixedPieces = [];
        for (i = 0; i < 12; i++) mom = createUTC([ 2e3, i ]), shortPieces.push(this.monthsShort(mom, "")), 
        longPieces.push(this.months(mom, "")), mixedPieces.push(this.months(mom, "")), mixedPieces.push(this.monthsShort(mom, ""));
        for (shortPieces.sort(cmpLenRev), longPieces.sort(cmpLenRev), mixedPieces.sort(cmpLenRev), 
        i = 0; i < 12; i++) shortPieces[i] = regexEscape(shortPieces[i]), longPieces[i] = regexEscape(longPieces[i]);
        for (i = 0; i < 24; i++) mixedPieces[i] = regexEscape(mixedPieces[i]);
        this._monthsRegex = new RegExp("^(" + mixedPieces.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, 
        this._monthsStrictRegex = new RegExp("^(" + longPieces.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + shortPieces.join("|") + ")", "i");
    }
    function daysInYear(year) {
        return isLeapYear(year) ? 366 : 365;
    }
    function isLeapYear(year) {
        return year % 4 == 0 && year % 100 != 0 || year % 400 == 0;
    }
    function getIsLeapYear() {
        return isLeapYear(this.year());
    }
    function createDate(y, m, d, h, M, s, ms) {
        var date = new Date(y, m, d, h, M, s, ms);
        return y < 100 && y >= 0 && isFinite(date.getFullYear()) && date.setFullYear(y), 
        date;
    }
    function createUTCDate(y) {
        var date = new Date(Date.UTC.apply(null, arguments));
        return y < 100 && y >= 0 && isFinite(date.getUTCFullYear()) && date.setUTCFullYear(y), 
        date;
    }
    function firstWeekOffset(year, dow, doy) {
        var fwd = 7 + dow - doy;
        return -(7 + createUTCDate(year, 0, fwd).getUTCDay() - dow) % 7 + fwd - 1;
    }
    function dayOfYearFromWeeks(year, week, weekday, dow, doy) {
        var resYear, resDayOfYear, localWeekday = (7 + weekday - dow) % 7, weekOffset = firstWeekOffset(year, dow, doy), dayOfYear = 1 + 7 * (week - 1) + localWeekday + weekOffset;
        return dayOfYear <= 0 ? (resYear = year - 1, resDayOfYear = daysInYear(resYear) + dayOfYear) : dayOfYear > daysInYear(year) ? (resYear = year + 1, 
        resDayOfYear = dayOfYear - daysInYear(year)) : (resYear = year, resDayOfYear = dayOfYear), 
        {
            year: resYear,
            dayOfYear: resDayOfYear
        };
    }
    function weekOfYear(mom, dow, doy) {
        var resWeek, resYear, weekOffset = firstWeekOffset(mom.year(), dow, doy), week = Math.floor((mom.dayOfYear() - weekOffset - 1) / 7) + 1;
        return week < 1 ? (resYear = mom.year() - 1, resWeek = week + weeksInYear(resYear, dow, doy)) : week > weeksInYear(mom.year(), dow, doy) ? (resWeek = week - weeksInYear(mom.year(), dow, doy), 
        resYear = mom.year() + 1) : (resYear = mom.year(), resWeek = week), {
            week: resWeek,
            year: resYear
        };
    }
    function weeksInYear(year, dow, doy) {
        var weekOffset = firstWeekOffset(year, dow, doy), weekOffsetNext = firstWeekOffset(year + 1, dow, doy);
        return (daysInYear(year) - weekOffset + weekOffsetNext) / 7;
    }
    function localeWeek(mom) {
        return weekOfYear(mom, this._week.dow, this._week.doy).week;
    }
    function localeFirstDayOfWeek() {
        return this._week.dow;
    }
    function localeFirstDayOfYear() {
        return this._week.doy;
    }
    function getSetWeek(input) {
        var week = this.localeData().week(this);
        return null == input ? week : this.add(7 * (input - week), "d");
    }
    function getSetISOWeek(input) {
        var week = weekOfYear(this, 1, 4).week;
        return null == input ? week : this.add(7 * (input - week), "d");
    }
    function parseWeekday(input, locale) {
        return "string" != typeof input ? input : isNaN(input) ? (input = locale.weekdaysParse(input), 
        "number" == typeof input ? input : null) : parseInt(input, 10);
    }
    function parseIsoWeekday(input, locale) {
        return "string" == typeof input ? locale.weekdaysParse(input) % 7 || 7 : isNaN(input) ? null : input;
    }
    function localeWeekdays(m, format) {
        return m ? isArray(this._weekdays) ? this._weekdays[m.day()] : this._weekdays[this._weekdays.isFormat.test(format) ? "format" : "standalone"][m.day()] : isArray(this._weekdays) ? this._weekdays : this._weekdays.standalone;
    }
    function localeWeekdaysShort(m) {
        return m ? this._weekdaysShort[m.day()] : this._weekdaysShort;
    }
    function localeWeekdaysMin(m) {
        return m ? this._weekdaysMin[m.day()] : this._weekdaysMin;
    }
    function handleStrictParse$1(weekdayName, format, strict) {
        var i, ii, mom, llc = weekdayName.toLocaleLowerCase();
        if (!this._weekdaysParse) for (this._weekdaysParse = [], this._shortWeekdaysParse = [], 
        this._minWeekdaysParse = [], i = 0; i < 7; ++i) mom = createUTC([ 2e3, 1 ]).day(i), 
        this._minWeekdaysParse[i] = this.weekdaysMin(mom, "").toLocaleLowerCase(), this._shortWeekdaysParse[i] = this.weekdaysShort(mom, "").toLocaleLowerCase(), 
        this._weekdaysParse[i] = this.weekdays(mom, "").toLocaleLowerCase();
        return strict ? "dddd" === format ? (ii = indexOf$1.call(this._weekdaysParse, llc), 
        -1 !== ii ? ii : null) : "ddd" === format ? (ii = indexOf$1.call(this._shortWeekdaysParse, llc), 
        -1 !== ii ? ii : null) : (ii = indexOf$1.call(this._minWeekdaysParse, llc), -1 !== ii ? ii : null) : "dddd" === format ? -1 !== (ii = indexOf$1.call(this._weekdaysParse, llc)) ? ii : -1 !== (ii = indexOf$1.call(this._shortWeekdaysParse, llc)) ? ii : (ii = indexOf$1.call(this._minWeekdaysParse, llc), 
        -1 !== ii ? ii : null) : "ddd" === format ? -1 !== (ii = indexOf$1.call(this._shortWeekdaysParse, llc)) ? ii : -1 !== (ii = indexOf$1.call(this._weekdaysParse, llc)) ? ii : (ii = indexOf$1.call(this._minWeekdaysParse, llc), 
        -1 !== ii ? ii : null) : -1 !== (ii = indexOf$1.call(this._minWeekdaysParse, llc)) ? ii : -1 !== (ii = indexOf$1.call(this._weekdaysParse, llc)) ? ii : (ii = indexOf$1.call(this._shortWeekdaysParse, llc), 
        -1 !== ii ? ii : null);
    }
    function localeWeekdaysParse(weekdayName, format, strict) {
        var i, mom, regex;
        if (this._weekdaysParseExact) return handleStrictParse$1.call(this, weekdayName, format, strict);
        for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], 
        this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), i = 0; i < 7; i++) {
            if (mom = createUTC([ 2e3, 1 ]).day(i), strict && !this._fullWeekdaysParse[i] && (this._fullWeekdaysParse[i] = new RegExp("^" + this.weekdays(mom, "").replace(".", ".?") + "$", "i"), 
            this._shortWeekdaysParse[i] = new RegExp("^" + this.weekdaysShort(mom, "").replace(".", ".?") + "$", "i"), 
            this._minWeekdaysParse[i] = new RegExp("^" + this.weekdaysMin(mom, "").replace(".", ".?") + "$", "i")), 
            this._weekdaysParse[i] || (regex = "^" + this.weekdays(mom, "") + "|^" + this.weekdaysShort(mom, "") + "|^" + this.weekdaysMin(mom, ""), 
            this._weekdaysParse[i] = new RegExp(regex.replace(".", ""), "i")), strict && "dddd" === format && this._fullWeekdaysParse[i].test(weekdayName)) return i;
            if (strict && "ddd" === format && this._shortWeekdaysParse[i].test(weekdayName)) return i;
            if (strict && "dd" === format && this._minWeekdaysParse[i].test(weekdayName)) return i;
            if (!strict && this._weekdaysParse[i].test(weekdayName)) return i;
        }
    }
    function getSetDayOfWeek(input) {
        if (!this.isValid()) return null != input ? this : NaN;
        var day = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
        return null != input ? (input = parseWeekday(input, this.localeData()), this.add(input - day, "d")) : day;
    }
    function getSetLocaleDayOfWeek(input) {
        if (!this.isValid()) return null != input ? this : NaN;
        var weekday = (this.day() + 7 - this.localeData()._week.dow) % 7;
        return null == input ? weekday : this.add(input - weekday, "d");
    }
    function getSetISODayOfWeek(input) {
        if (!this.isValid()) return null != input ? this : NaN;
        if (null != input) {
            var weekday = parseIsoWeekday(input, this.localeData());
            return this.day(this.day() % 7 ? weekday : weekday - 7);
        }
        return this.day() || 7;
    }
    function weekdaysRegex(isStrict) {
        return this._weekdaysParseExact ? (hasOwnProp(this, "_weekdaysRegex") || computeWeekdaysParse.call(this), 
        isStrict ? this._weekdaysStrictRegex : this._weekdaysRegex) : (hasOwnProp(this, "_weekdaysRegex") || (this._weekdaysRegex = defaultWeekdaysRegex), 
        this._weekdaysStrictRegex && isStrict ? this._weekdaysStrictRegex : this._weekdaysRegex);
    }
    function weekdaysShortRegex(isStrict) {
        return this._weekdaysParseExact ? (hasOwnProp(this, "_weekdaysRegex") || computeWeekdaysParse.call(this), 
        isStrict ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (hasOwnProp(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = defaultWeekdaysShortRegex), 
        this._weekdaysShortStrictRegex && isStrict ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex);
    }
    function weekdaysMinRegex(isStrict) {
        return this._weekdaysParseExact ? (hasOwnProp(this, "_weekdaysRegex") || computeWeekdaysParse.call(this), 
        isStrict ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (hasOwnProp(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = defaultWeekdaysMinRegex), 
        this._weekdaysMinStrictRegex && isStrict ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex);
    }
    function computeWeekdaysParse() {
        function cmpLenRev(a, b) {
            return b.length - a.length;
        }
        var i, mom, minp, shortp, longp, minPieces = [], shortPieces = [], longPieces = [], mixedPieces = [];
        for (i = 0; i < 7; i++) mom = createUTC([ 2e3, 1 ]).day(i), minp = this.weekdaysMin(mom, ""), 
        shortp = this.weekdaysShort(mom, ""), longp = this.weekdays(mom, ""), minPieces.push(minp), 
        shortPieces.push(shortp), longPieces.push(longp), mixedPieces.push(minp), mixedPieces.push(shortp), 
        mixedPieces.push(longp);
        for (minPieces.sort(cmpLenRev), shortPieces.sort(cmpLenRev), longPieces.sort(cmpLenRev), 
        mixedPieces.sort(cmpLenRev), i = 0; i < 7; i++) shortPieces[i] = regexEscape(shortPieces[i]), 
        longPieces[i] = regexEscape(longPieces[i]), mixedPieces[i] = regexEscape(mixedPieces[i]);
        this._weekdaysRegex = new RegExp("^(" + mixedPieces.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, 
        this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + longPieces.join("|") + ")", "i"), 
        this._weekdaysShortStrictRegex = new RegExp("^(" + shortPieces.join("|") + ")", "i"), 
        this._weekdaysMinStrictRegex = new RegExp("^(" + minPieces.join("|") + ")", "i");
    }
    function hFormat() {
        return this.hours() % 12 || 12;
    }
    function kFormat() {
        return this.hours() || 24;
    }
    function meridiem(token, lowercase) {
        addFormatToken(token, 0, 0, function() {
            return this.localeData().meridiem(this.hours(), this.minutes(), lowercase);
        });
    }
    function matchMeridiem(isStrict, locale) {
        return locale._meridiemParse;
    }
    function localeIsPM(input) {
        return "p" === (input + "").toLowerCase().charAt(0);
    }
    function localeMeridiem(hours, minutes, isLower) {
        return hours > 11 ? isLower ? "pm" : "PM" : isLower ? "am" : "AM";
    }
    function normalizeLocale(key) {
        return key ? key.toLowerCase().replace("_", "-") : key;
    }
    function chooseLocale(names) {
        for (var j, next, locale, split, i = 0; i < names.length; ) {
            for (split = normalizeLocale(names[i]).split("-"), j = split.length, next = normalizeLocale(names[i + 1]), 
            next = next ? next.split("-") : null; j > 0; ) {
                if (locale = loadLocale(split.slice(0, j).join("-"))) return locale;
                if (next && next.length >= j && compareArrays(split, next, !0) >= j - 1) break;
                j--;
            }
            i++;
        }
        return null;
    }
    function loadLocale(name) {
        var oldLocale = null;
        if (!locales[name] && "undefined" != typeof module && module && module.exports) try {
            oldLocale = globalLocale._abbr, require("./locale/" + name), getSetGlobalLocale(oldLocale);
        } catch (e) {}
        return locales[name];
    }
    function getSetGlobalLocale(key, values) {
        var data;
        return key && (data = isUndefined(values) ? getLocale(key) : defineLocale(key, values)) && (globalLocale = data), 
        globalLocale._abbr;
    }
    function defineLocale(name, config) {
        if (null !== config) {
            var parentConfig = baseConfig;
            if (config.abbr = name, null != locales[name]) deprecateSimple("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), 
            parentConfig = locales[name]._config; else if (null != config.parentLocale) {
                if (null == locales[config.parentLocale]) return localeFamilies[config.parentLocale] || (localeFamilies[config.parentLocale] = []), 
                localeFamilies[config.parentLocale].push({
                    name: name,
                    config: config
                }), null;
                parentConfig = locales[config.parentLocale]._config;
            }
            return locales[name] = new Locale(mergeConfigs(parentConfig, config)), localeFamilies[name] && localeFamilies[name].forEach(function(x) {
                defineLocale(x.name, x.config);
            }), getSetGlobalLocale(name), locales[name];
        }
        return delete locales[name], null;
    }
    function updateLocale(name, config) {
        if (null != config) {
            var locale, parentConfig = baseConfig;
            null != locales[name] && (parentConfig = locales[name]._config), config = mergeConfigs(parentConfig, config), 
            locale = new Locale(config), locale.parentLocale = locales[name], locales[name] = locale, 
            getSetGlobalLocale(name);
        } else null != locales[name] && (null != locales[name].parentLocale ? locales[name] = locales[name].parentLocale : null != locales[name] && delete locales[name]);
        return locales[name];
    }
    function getLocale(key) {
        var locale;
        if (key && key._locale && key._locale._abbr && (key = key._locale._abbr), !key) return globalLocale;
        if (!isArray(key)) {
            if (locale = loadLocale(key)) return locale;
            key = [ key ];
        }
        return chooseLocale(key);
    }
    function listLocales() {
        return keys$1(locales);
    }
    function checkOverflow(m) {
        var overflow, a = m._a;
        return a && -2 === getParsingFlags(m).overflow && (overflow = a[MONTH] < 0 || a[MONTH] > 11 ? MONTH : a[DATE] < 1 || a[DATE] > daysInMonth(a[YEAR], a[MONTH]) ? DATE : a[HOUR] < 0 || a[HOUR] > 24 || 24 === a[HOUR] && (0 !== a[MINUTE] || 0 !== a[SECOND] || 0 !== a[MILLISECOND]) ? HOUR : a[MINUTE] < 0 || a[MINUTE] > 59 ? MINUTE : a[SECOND] < 0 || a[SECOND] > 59 ? SECOND : a[MILLISECOND] < 0 || a[MILLISECOND] > 999 ? MILLISECOND : -1, 
        getParsingFlags(m)._overflowDayOfYear && (overflow < YEAR || overflow > DATE) && (overflow = DATE), 
        getParsingFlags(m)._overflowWeeks && -1 === overflow && (overflow = WEEK), getParsingFlags(m)._overflowWeekday && -1 === overflow && (overflow = WEEKDAY), 
        getParsingFlags(m).overflow = overflow), m;
    }
    function configFromISO(config) {
        var i, l, allowTime, dateFormat, timeFormat, tzFormat, string = config._i, match = extendedIsoRegex.exec(string) || basicIsoRegex.exec(string);
        if (match) {
            for (getParsingFlags(config).iso = !0, i = 0, l = isoDates.length; i < l; i++) if (isoDates[i][1].exec(match[1])) {
                dateFormat = isoDates[i][0], allowTime = !1 !== isoDates[i][2];
                break;
            }
            if (null == dateFormat) return void (config._isValid = !1);
            if (match[3]) {
                for (i = 0, l = isoTimes.length; i < l; i++) if (isoTimes[i][1].exec(match[3])) {
                    timeFormat = (match[2] || " ") + isoTimes[i][0];
                    break;
                }
                if (null == timeFormat) return void (config._isValid = !1);
            }
            if (!allowTime && null != timeFormat) return void (config._isValid = !1);
            if (match[4]) {
                if (!tzRegex.exec(match[4])) return void (config._isValid = !1);
                tzFormat = "Z";
            }
            config._f = dateFormat + (timeFormat || "") + (tzFormat || ""), configFromStringAndFormat(config);
        } else config._isValid = !1;
    }
    function configFromRFC2822(config) {
        var string, match, dayFormat, dateFormat, timeFormat, tzFormat, timezone, timezoneIndex, timezones = {
            " GMT": " +0000",
            " EDT": " -0400",
            " EST": " -0500",
            " CDT": " -0500",
            " CST": " -0600",
            " MDT": " -0600",
            " MST": " -0700",
            " PDT": " -0700",
            " PST": " -0800"
        }, military = "YXWVUTSRQPONZABCDEFGHIKLM";
        if (string = config._i.replace(/\([^\)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").replace(/^\s|\s$/g, ""), 
        match = basicRfcRegex.exec(string)) {
            if (dayFormat = match[1] ? "ddd" + (5 === match[1].length ? ", " : " ") : "", dateFormat = "D MMM " + (match[2].length > 10 ? "YYYY " : "YY "), 
            timeFormat = "HH:mm" + (match[4] ? ":ss" : ""), match[1]) {
                var momentDate = new Date(match[2]), momentDay = [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ][momentDate.getDay()];
                if (match[1].substr(0, 3) !== momentDay) return getParsingFlags(config).weekdayMismatch = !0, 
                void (config._isValid = !1);
            }
            switch (match[5].length) {
              case 2:
                0 === timezoneIndex ? timezone = " +0000" : (timezoneIndex = military.indexOf(match[5][1].toUpperCase()) - 12, 
                timezone = (timezoneIndex < 0 ? " -" : " +") + ("" + timezoneIndex).replace(/^-?/, "0").match(/..$/)[0] + "00");
                break;

              case 4:
                timezone = timezones[match[5]];
                break;

              default:
                timezone = timezones[" GMT"];
            }
            match[5] = timezone, config._i = match.splice(1).join(""), tzFormat = " ZZ", config._f = dayFormat + dateFormat + timeFormat + tzFormat, 
            configFromStringAndFormat(config), getParsingFlags(config).rfc2822 = !0;
        } else config._isValid = !1;
    }
    function configFromString(config) {
        var matched = aspNetJsonRegex.exec(config._i);
        if (null !== matched) return void (config._d = new Date(+matched[1]));
        configFromISO(config), !1 === config._isValid && (delete config._isValid, configFromRFC2822(config), 
        !1 === config._isValid && (delete config._isValid, hooks.createFromInputFallback(config)));
    }
    function defaults(a, b, c) {
        return null != a ? a : null != b ? b : c;
    }
    function currentDateArray(config) {
        var nowValue = new Date(hooks.now());
        return config._useUTC ? [ nowValue.getUTCFullYear(), nowValue.getUTCMonth(), nowValue.getUTCDate() ] : [ nowValue.getFullYear(), nowValue.getMonth(), nowValue.getDate() ];
    }
    function configFromArray(config) {
        var i, date, currentDate, yearToUse, input = [];
        if (!config._d) {
            for (currentDate = currentDateArray(config), config._w && null == config._a[DATE] && null == config._a[MONTH] && dayOfYearFromWeekInfo(config), 
            null != config._dayOfYear && (yearToUse = defaults(config._a[YEAR], currentDate[YEAR]), 
            (config._dayOfYear > daysInYear(yearToUse) || 0 === config._dayOfYear) && (getParsingFlags(config)._overflowDayOfYear = !0), 
            date = createUTCDate(yearToUse, 0, config._dayOfYear), config._a[MONTH] = date.getUTCMonth(), 
            config._a[DATE] = date.getUTCDate()), i = 0; i < 3 && null == config._a[i]; ++i) config._a[i] = input[i] = currentDate[i];
            for (;i < 7; i++) config._a[i] = input[i] = null == config._a[i] ? 2 === i ? 1 : 0 : config._a[i];
            24 === config._a[HOUR] && 0 === config._a[MINUTE] && 0 === config._a[SECOND] && 0 === config._a[MILLISECOND] && (config._nextDay = !0, 
            config._a[HOUR] = 0), config._d = (config._useUTC ? createUTCDate : createDate).apply(null, input), 
            null != config._tzm && config._d.setUTCMinutes(config._d.getUTCMinutes() - config._tzm), 
            config._nextDay && (config._a[HOUR] = 24);
        }
    }
    function dayOfYearFromWeekInfo(config) {
        var w, weekYear, week, weekday, dow, doy, temp, weekdayOverflow;
        if (w = config._w, null != w.GG || null != w.W || null != w.E) dow = 1, doy = 4, 
        weekYear = defaults(w.GG, config._a[YEAR], weekOfYear(createLocal(), 1, 4).year), 
        week = defaults(w.W, 1), ((weekday = defaults(w.E, 1)) < 1 || weekday > 7) && (weekdayOverflow = !0); else {
            dow = config._locale._week.dow, doy = config._locale._week.doy;
            var curWeek = weekOfYear(createLocal(), dow, doy);
            weekYear = defaults(w.gg, config._a[YEAR], curWeek.year), week = defaults(w.w, curWeek.week), 
            null != w.d ? ((weekday = w.d) < 0 || weekday > 6) && (weekdayOverflow = !0) : null != w.e ? (weekday = w.e + dow, 
            (w.e < 0 || w.e > 6) && (weekdayOverflow = !0)) : weekday = dow;
        }
        week < 1 || week > weeksInYear(weekYear, dow, doy) ? getParsingFlags(config)._overflowWeeks = !0 : null != weekdayOverflow ? getParsingFlags(config)._overflowWeekday = !0 : (temp = dayOfYearFromWeeks(weekYear, week, weekday, dow, doy), 
        config._a[YEAR] = temp.year, config._dayOfYear = temp.dayOfYear);
    }
    function configFromStringAndFormat(config) {
        if (config._f === hooks.ISO_8601) return void configFromISO(config);
        if (config._f === hooks.RFC_2822) return void configFromRFC2822(config);
        config._a = [], getParsingFlags(config).empty = !0;
        var i, parsedInput, tokens, token, skipped, string = "" + config._i, stringLength = string.length, totalParsedInputLength = 0;
        for (tokens = expandFormat(config._f, config._locale).match(formattingTokens) || [], 
        i = 0; i < tokens.length; i++) token = tokens[i], parsedInput = (string.match(getParseRegexForToken(token, config)) || [])[0], 
        parsedInput && (skipped = string.substr(0, string.indexOf(parsedInput)), skipped.length > 0 && getParsingFlags(config).unusedInput.push(skipped), 
        string = string.slice(string.indexOf(parsedInput) + parsedInput.length), totalParsedInputLength += parsedInput.length), 
        formatTokenFunctions[token] ? (parsedInput ? getParsingFlags(config).empty = !1 : getParsingFlags(config).unusedTokens.push(token), 
        addTimeToArrayFromToken(token, parsedInput, config)) : config._strict && !parsedInput && getParsingFlags(config).unusedTokens.push(token);
        getParsingFlags(config).charsLeftOver = stringLength - totalParsedInputLength, string.length > 0 && getParsingFlags(config).unusedInput.push(string), 
        config._a[HOUR] <= 12 && !0 === getParsingFlags(config).bigHour && config._a[HOUR] > 0 && (getParsingFlags(config).bigHour = void 0), 
        getParsingFlags(config).parsedDateParts = config._a.slice(0), getParsingFlags(config).meridiem = config._meridiem, 
        config._a[HOUR] = meridiemFixWrap(config._locale, config._a[HOUR], config._meridiem), 
        configFromArray(config), checkOverflow(config);
    }
    function meridiemFixWrap(locale, hour, meridiem) {
        var isPm;
        return null == meridiem ? hour : null != locale.meridiemHour ? locale.meridiemHour(hour, meridiem) : null != locale.isPM ? (isPm = locale.isPM(meridiem), 
        isPm && hour < 12 && (hour += 12), isPm || 12 !== hour || (hour = 0), hour) : hour;
    }
    function configFromStringAndArray(config) {
        var tempConfig, bestMoment, scoreToBeat, i, currentScore;
        if (0 === config._f.length) return getParsingFlags(config).invalidFormat = !0, void (config._d = new Date(NaN));
        for (i = 0; i < config._f.length; i++) currentScore = 0, tempConfig = copyConfig({}, config), 
        null != config._useUTC && (tempConfig._useUTC = config._useUTC), tempConfig._f = config._f[i], 
        configFromStringAndFormat(tempConfig), isValid(tempConfig) && (currentScore += getParsingFlags(tempConfig).charsLeftOver, 
        currentScore += 10 * getParsingFlags(tempConfig).unusedTokens.length, getParsingFlags(tempConfig).score = currentScore, 
        (null == scoreToBeat || currentScore < scoreToBeat) && (scoreToBeat = currentScore, 
        bestMoment = tempConfig));
        extend(config, bestMoment || tempConfig);
    }
    function configFromObject(config) {
        if (!config._d) {
            var i = normalizeObjectUnits(config._i);
            config._a = map([ i.year, i.month, i.day || i.date, i.hour, i.minute, i.second, i.millisecond ], function(obj) {
                return obj && parseInt(obj, 10);
            }), configFromArray(config);
        }
    }
    function createFromConfig(config) {
        var res = new Moment(checkOverflow(prepareConfig(config)));
        return res._nextDay && (res.add(1, "d"), res._nextDay = void 0), res;
    }
    function prepareConfig(config) {
        var input = config._i, format = config._f;
        return config._locale = config._locale || getLocale(config._l), null === input || void 0 === format && "" === input ? createInvalid({
            nullInput: !0
        }) : ("string" == typeof input && (config._i = input = config._locale.preparse(input)), 
        isMoment(input) ? new Moment(checkOverflow(input)) : (isDate(input) ? config._d = input : isArray(format) ? configFromStringAndArray(config) : format ? configFromStringAndFormat(config) : configFromInput(config), 
        isValid(config) || (config._d = null), config));
    }
    function configFromInput(config) {
        var input = config._i;
        isUndefined(input) ? config._d = new Date(hooks.now()) : isDate(input) ? config._d = new Date(input.valueOf()) : "string" == typeof input ? configFromString(config) : isArray(input) ? (config._a = map(input.slice(0), function(obj) {
            return parseInt(obj, 10);
        }), configFromArray(config)) : isObject(input) ? configFromObject(config) : isNumber(input) ? config._d = new Date(input) : hooks.createFromInputFallback(config);
    }
    function createLocalOrUTC(input, format, locale, strict, isUTC) {
        var c = {};
        return !0 !== locale && !1 !== locale || (strict = locale, locale = void 0), (isObject(input) && isObjectEmpty(input) || isArray(input) && 0 === input.length) && (input = void 0), 
        c._isAMomentObject = !0, c._useUTC = c._isUTC = isUTC, c._l = locale, c._i = input, 
        c._f = format, c._strict = strict, createFromConfig(c);
    }
    function createLocal(input, format, locale, strict) {
        return createLocalOrUTC(input, format, locale, strict, !1);
    }
    function pickBy(fn, moments) {
        var res, i;
        if (1 === moments.length && isArray(moments[0]) && (moments = moments[0]), !moments.length) return createLocal();
        for (res = moments[0], i = 1; i < moments.length; ++i) moments[i].isValid() && !moments[i][fn](res) || (res = moments[i]);
        return res;
    }
    function min() {
        return pickBy("isBefore", [].slice.call(arguments, 0));
    }
    function max() {
        return pickBy("isAfter", [].slice.call(arguments, 0));
    }
    function isDurationValid(m) {
        for (var key in m) if (-1 === ordering.indexOf(key) || null != m[key] && isNaN(m[key])) return !1;
        for (var unitHasDecimal = !1, i = 0; i < ordering.length; ++i) if (m[ordering[i]]) {
            if (unitHasDecimal) return !1;
            parseFloat(m[ordering[i]]) !== toInt(m[ordering[i]]) && (unitHasDecimal = !0);
        }
        return !0;
    }
    function isValid$1() {
        return this._isValid;
    }
    function createInvalid$1() {
        return createDuration(NaN);
    }
    function Duration(duration) {
        var normalizedInput = normalizeObjectUnits(duration), years = normalizedInput.year || 0, quarters = normalizedInput.quarter || 0, months = normalizedInput.month || 0, weeks = normalizedInput.week || 0, days = normalizedInput.day || 0, hours = normalizedInput.hour || 0, minutes = normalizedInput.minute || 0, seconds = normalizedInput.second || 0, milliseconds = normalizedInput.millisecond || 0;
        this._isValid = isDurationValid(normalizedInput), this._milliseconds = +milliseconds + 1e3 * seconds + 6e4 * minutes + 1e3 * hours * 60 * 60, 
        this._days = +days + 7 * weeks, this._months = +months + 3 * quarters + 12 * years, 
        this._data = {}, this._locale = getLocale(), this._bubble();
    }
    function isDuration(obj) {
        return obj instanceof Duration;
    }
    function absRound(number) {
        return number < 0 ? -1 * Math.round(-1 * number) : Math.round(number);
    }
    function offset(token, separator) {
        addFormatToken(token, 0, 0, function() {
            var offset = this.utcOffset(), sign = "+";
            return offset < 0 && (offset = -offset, sign = "-"), sign + zeroFill(~~(offset / 60), 2) + separator + zeroFill(~~offset % 60, 2);
        });
    }
    function offsetFromString(matcher, string) {
        var matches = (string || "").match(matcher);
        if (null === matches) return null;
        var chunk = matches[matches.length - 1] || [], parts = (chunk + "").match(chunkOffset) || [ "-", 0, 0 ], minutes = 60 * parts[1] + toInt(parts[2]);
        return 0 === minutes ? 0 : "+" === parts[0] ? minutes : -minutes;
    }
    function cloneWithOffset(input, model) {
        var res, diff;
        return model._isUTC ? (res = model.clone(), diff = (isMoment(input) || isDate(input) ? input.valueOf() : createLocal(input).valueOf()) - res.valueOf(), 
        res._d.setTime(res._d.valueOf() + diff), hooks.updateOffset(res, !1), res) : createLocal(input).local();
    }
    function getDateOffset(m) {
        return 15 * -Math.round(m._d.getTimezoneOffset() / 15);
    }
    function getSetOffset(input, keepLocalTime, keepMinutes) {
        var localAdjust, offset = this._offset || 0;
        if (!this.isValid()) return null != input ? this : NaN;
        if (null != input) {
            if ("string" == typeof input) {
                if (null === (input = offsetFromString(matchShortOffset, input))) return this;
            } else Math.abs(input) < 16 && !keepMinutes && (input *= 60);
            return !this._isUTC && keepLocalTime && (localAdjust = getDateOffset(this)), this._offset = input, 
            this._isUTC = !0, null != localAdjust && this.add(localAdjust, "m"), offset !== input && (!keepLocalTime || this._changeInProgress ? addSubtract(this, createDuration(input - offset, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, 
            hooks.updateOffset(this, !0), this._changeInProgress = null)), this;
        }
        return this._isUTC ? offset : getDateOffset(this);
    }
    function getSetZone(input, keepLocalTime) {
        return null != input ? ("string" != typeof input && (input = -input), this.utcOffset(input, keepLocalTime), 
        this) : -this.utcOffset();
    }
    function setOffsetToUTC(keepLocalTime) {
        return this.utcOffset(0, keepLocalTime);
    }
    function setOffsetToLocal(keepLocalTime) {
        return this._isUTC && (this.utcOffset(0, keepLocalTime), this._isUTC = !1, keepLocalTime && this.subtract(getDateOffset(this), "m")), 
        this;
    }
    function setOffsetToParsedOffset() {
        if (null != this._tzm) this.utcOffset(this._tzm, !1, !0); else if ("string" == typeof this._i) {
            var tZone = offsetFromString(matchOffset, this._i);
            null != tZone ? this.utcOffset(tZone) : this.utcOffset(0, !0);
        }
        return this;
    }
    function hasAlignedHourOffset(input) {
        return !!this.isValid() && (input = input ? createLocal(input).utcOffset() : 0, 
        (this.utcOffset() - input) % 60 == 0);
    }
    function isDaylightSavingTime() {
        return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset();
    }
    function isDaylightSavingTimeShifted() {
        if (!isUndefined(this._isDSTShifted)) return this._isDSTShifted;
        var c = {};
        if (copyConfig(c, this), c = prepareConfig(c), c._a) {
            var other = c._isUTC ? createUTC(c._a) : createLocal(c._a);
            this._isDSTShifted = this.isValid() && compareArrays(c._a, other.toArray()) > 0;
        } else this._isDSTShifted = !1;
        return this._isDSTShifted;
    }
    function isLocal() {
        return !!this.isValid() && !this._isUTC;
    }
    function isUtcOffset() {
        return !!this.isValid() && this._isUTC;
    }
    function isUtc() {
        return !!this.isValid() && (this._isUTC && 0 === this._offset);
    }
    function createDuration(input, key) {
        var sign, ret, diffRes, duration = input, match = null;
        return isDuration(input) ? duration = {
            ms: input._milliseconds,
            d: input._days,
            M: input._months
        } : isNumber(input) ? (duration = {}, key ? duration[key] = input : duration.milliseconds = input) : (match = aspNetRegex.exec(input)) ? (sign = "-" === match[1] ? -1 : 1, 
        duration = {
            y: 0,
            d: toInt(match[DATE]) * sign,
            h: toInt(match[HOUR]) * sign,
            m: toInt(match[MINUTE]) * sign,
            s: toInt(match[SECOND]) * sign,
            ms: toInt(absRound(1e3 * match[MILLISECOND])) * sign
        }) : (match = isoRegex.exec(input)) ? (sign = "-" === match[1] ? -1 : 1, duration = {
            y: parseIso(match[2], sign),
            M: parseIso(match[3], sign),
            w: parseIso(match[4], sign),
            d: parseIso(match[5], sign),
            h: parseIso(match[6], sign),
            m: parseIso(match[7], sign),
            s: parseIso(match[8], sign)
        }) : null == duration ? duration = {} : "object" == typeof duration && ("from" in duration || "to" in duration) && (diffRes = momentsDifference(createLocal(duration.from), createLocal(duration.to)), 
        duration = {}, duration.ms = diffRes.milliseconds, duration.M = diffRes.months), 
        ret = new Duration(duration), isDuration(input) && hasOwnProp(input, "_locale") && (ret._locale = input._locale), 
        ret;
    }
    function parseIso(inp, sign) {
        var res = inp && parseFloat(inp.replace(",", "."));
        return (isNaN(res) ? 0 : res) * sign;
    }
    function positiveMomentsDifference(base, other) {
        var res = {
            milliseconds: 0,
            months: 0
        };
        return res.months = other.month() - base.month() + 12 * (other.year() - base.year()), 
        base.clone().add(res.months, "M").isAfter(other) && --res.months, res.milliseconds = +other - +base.clone().add(res.months, "M"), 
        res;
    }
    function momentsDifference(base, other) {
        var res;
        return base.isValid() && other.isValid() ? (other = cloneWithOffset(other, base), 
        base.isBefore(other) ? res = positiveMomentsDifference(base, other) : (res = positiveMomentsDifference(other, base), 
        res.milliseconds = -res.milliseconds, res.months = -res.months), res) : {
            milliseconds: 0,
            months: 0
        };
    }
    function createAdder(direction, name) {
        return function(val, period) {
            var dur, tmp;
            return null === period || isNaN(+period) || (deprecateSimple(name, "moment()." + name + "(period, number) is deprecated. Please use moment()." + name + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), 
            tmp = val, val = period, period = tmp), val = "string" == typeof val ? +val : val, 
            dur = createDuration(val, period), addSubtract(this, dur, direction), this;
        };
    }
    function addSubtract(mom, duration, isAdding, updateOffset) {
        var milliseconds = duration._milliseconds, days = absRound(duration._days), months = absRound(duration._months);
        mom.isValid() && (updateOffset = null == updateOffset || updateOffset, milliseconds && mom._d.setTime(mom._d.valueOf() + milliseconds * isAdding), 
        days && set$1(mom, "Date", get(mom, "Date") + days * isAdding), months && setMonth(mom, get(mom, "Month") + months * isAdding), 
        updateOffset && hooks.updateOffset(mom, days || months));
    }
    function getCalendarFormat(myMoment, now) {
        var diff = myMoment.diff(now, "days", !0);
        return diff < -6 ? "sameElse" : diff < -1 ? "lastWeek" : diff < 0 ? "lastDay" : diff < 1 ? "sameDay" : diff < 2 ? "nextDay" : diff < 7 ? "nextWeek" : "sameElse";
    }
    function calendar$1(time, formats) {
        var now = time || createLocal(), sod = cloneWithOffset(now, this).startOf("day"), format = hooks.calendarFormat(this, sod) || "sameElse", output = formats && (isFunction(formats[format]) ? formats[format].call(this, now) : formats[format]);
        return this.format(output || this.localeData().calendar(format, this, createLocal(now)));
    }
    function clone() {
        return new Moment(this);
    }
    function isAfter(input, units) {
        var localInput = isMoment(input) ? input : createLocal(input);
        return !(!this.isValid() || !localInput.isValid()) && (units = normalizeUnits(isUndefined(units) ? "millisecond" : units), 
        "millisecond" === units ? this.valueOf() > localInput.valueOf() : localInput.valueOf() < this.clone().startOf(units).valueOf());
    }
    function isBefore(input, units) {
        var localInput = isMoment(input) ? input : createLocal(input);
        return !(!this.isValid() || !localInput.isValid()) && (units = normalizeUnits(isUndefined(units) ? "millisecond" : units), 
        "millisecond" === units ? this.valueOf() < localInput.valueOf() : this.clone().endOf(units).valueOf() < localInput.valueOf());
    }
    function isBetween(from, to, units, inclusivity) {
        return inclusivity = inclusivity || "()", ("(" === inclusivity[0] ? this.isAfter(from, units) : !this.isBefore(from, units)) && (")" === inclusivity[1] ? this.isBefore(to, units) : !this.isAfter(to, units));
    }
    function isSame(input, units) {
        var inputMs, localInput = isMoment(input) ? input : createLocal(input);
        return !(!this.isValid() || !localInput.isValid()) && (units = normalizeUnits(units || "millisecond"), 
        "millisecond" === units ? this.valueOf() === localInput.valueOf() : (inputMs = localInput.valueOf(), 
        this.clone().startOf(units).valueOf() <= inputMs && inputMs <= this.clone().endOf(units).valueOf()));
    }
    function isSameOrAfter(input, units) {
        return this.isSame(input, units) || this.isAfter(input, units);
    }
    function isSameOrBefore(input, units) {
        return this.isSame(input, units) || this.isBefore(input, units);
    }
    function diff(input, units, asFloat) {
        var that, zoneDelta, delta, output;
        return this.isValid() ? (that = cloneWithOffset(input, this), that.isValid() ? (zoneDelta = 6e4 * (that.utcOffset() - this.utcOffset()), 
        units = normalizeUnits(units), "year" === units || "month" === units || "quarter" === units ? (output = monthDiff(this, that), 
        "quarter" === units ? output /= 3 : "year" === units && (output /= 12)) : (delta = this - that, 
        output = "second" === units ? delta / 1e3 : "minute" === units ? delta / 6e4 : "hour" === units ? delta / 36e5 : "day" === units ? (delta - zoneDelta) / 864e5 : "week" === units ? (delta - zoneDelta) / 6048e5 : delta), 
        asFloat ? output : absFloor(output)) : NaN) : NaN;
    }
    function monthDiff(a, b) {
        var anchor2, adjust, wholeMonthDiff = 12 * (b.year() - a.year()) + (b.month() - a.month()), anchor = a.clone().add(wholeMonthDiff, "months");
        return b - anchor < 0 ? (anchor2 = a.clone().add(wholeMonthDiff - 1, "months"), 
        adjust = (b - anchor) / (anchor - anchor2)) : (anchor2 = a.clone().add(wholeMonthDiff + 1, "months"), 
        adjust = (b - anchor) / (anchor2 - anchor)), -(wholeMonthDiff + adjust) || 0;
    }
    function toString() {
        return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ");
    }
    function toISOString() {
        if (!this.isValid()) return null;
        var m = this.clone().utc();
        return m.year() < 0 || m.year() > 9999 ? formatMoment(m, "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]") : isFunction(Date.prototype.toISOString) ? this.toDate().toISOString() : formatMoment(m, "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]");
    }
    function inspect() {
        if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)";
        var func = "moment", zone = "";
        this.isLocal() || (func = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", 
        zone = "Z");
        var prefix = "[" + func + '("]', year = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY", suffix = zone + '[")]';
        return this.format(prefix + year + "-MM-DD[T]HH:mm:ss.SSS" + suffix);
    }
    function format(inputString) {
        inputString || (inputString = this.isUtc() ? hooks.defaultFormatUtc : hooks.defaultFormat);
        var output = formatMoment(this, inputString);
        return this.localeData().postformat(output);
    }
    function from(time, withoutSuffix) {
        return this.isValid() && (isMoment(time) && time.isValid() || createLocal(time).isValid()) ? createDuration({
            to: this,
            from: time
        }).locale(this.locale()).humanize(!withoutSuffix) : this.localeData().invalidDate();
    }
    function fromNow(withoutSuffix) {
        return this.from(createLocal(), withoutSuffix);
    }
    function to(time, withoutSuffix) {
        return this.isValid() && (isMoment(time) && time.isValid() || createLocal(time).isValid()) ? createDuration({
            from: this,
            to: time
        }).locale(this.locale()).humanize(!withoutSuffix) : this.localeData().invalidDate();
    }
    function toNow(withoutSuffix) {
        return this.to(createLocal(), withoutSuffix);
    }
    function locale(key) {
        var newLocaleData;
        return void 0 === key ? this._locale._abbr : (newLocaleData = getLocale(key), null != newLocaleData && (this._locale = newLocaleData), 
        this);
    }
    function localeData() {
        return this._locale;
    }
    function startOf(units) {
        switch (units = normalizeUnits(units)) {
          case "year":
            this.month(0);

          case "quarter":
          case "month":
            this.date(1);

          case "week":
          case "isoWeek":
          case "day":
          case "date":
            this.hours(0);

          case "hour":
            this.minutes(0);

          case "minute":
            this.seconds(0);

          case "second":
            this.milliseconds(0);
        }
        return "week" === units && this.weekday(0), "isoWeek" === units && this.isoWeekday(1), 
        "quarter" === units && this.month(3 * Math.floor(this.month() / 3)), this;
    }
    function endOf(units) {
        return void 0 === (units = normalizeUnits(units)) || "millisecond" === units ? this : ("date" === units && (units = "day"), 
        this.startOf(units).add(1, "isoWeek" === units ? "week" : units).subtract(1, "ms"));
    }
    function valueOf() {
        return this._d.valueOf() - 6e4 * (this._offset || 0);
    }
    function unix() {
        return Math.floor(this.valueOf() / 1e3);
    }
    function toDate() {
        return new Date(this.valueOf());
    }
    function toArray() {
        var m = this;
        return [ m.year(), m.month(), m.date(), m.hour(), m.minute(), m.second(), m.millisecond() ];
    }
    function toObject() {
        var m = this;
        return {
            years: m.year(),
            months: m.month(),
            date: m.date(),
            hours: m.hours(),
            minutes: m.minutes(),
            seconds: m.seconds(),
            milliseconds: m.milliseconds()
        };
    }
    function toJSON() {
        return this.isValid() ? this.toISOString() : null;
    }
    function isValid$2() {
        return isValid(this);
    }
    function parsingFlags() {
        return extend({}, getParsingFlags(this));
    }
    function invalidAt() {
        return getParsingFlags(this).overflow;
    }
    function creationData() {
        return {
            input: this._i,
            format: this._f,
            locale: this._locale,
            isUTC: this._isUTC,
            strict: this._strict
        };
    }
    function addWeekYearFormatToken(token, getter) {
        addFormatToken(0, [ token, token.length ], 0, getter);
    }
    function getSetWeekYear(input) {
        return getSetWeekYearHelper.call(this, input, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy);
    }
    function getSetISOWeekYear(input) {
        return getSetWeekYearHelper.call(this, input, this.isoWeek(), this.isoWeekday(), 1, 4);
    }
    function getISOWeeksInYear() {
        return weeksInYear(this.year(), 1, 4);
    }
    function getWeeksInYear() {
        var weekInfo = this.localeData()._week;
        return weeksInYear(this.year(), weekInfo.dow, weekInfo.doy);
    }
    function getSetWeekYearHelper(input, week, weekday, dow, doy) {
        var weeksTarget;
        return null == input ? weekOfYear(this, dow, doy).year : (weeksTarget = weeksInYear(input, dow, doy), 
        week > weeksTarget && (week = weeksTarget), setWeekAll.call(this, input, week, weekday, dow, doy));
    }
    function setWeekAll(weekYear, week, weekday, dow, doy) {
        var dayOfYearData = dayOfYearFromWeeks(weekYear, week, weekday, dow, doy), date = createUTCDate(dayOfYearData.year, 0, dayOfYearData.dayOfYear);
        return this.year(date.getUTCFullYear()), this.month(date.getUTCMonth()), this.date(date.getUTCDate()), 
        this;
    }
    function getSetQuarter(input) {
        return null == input ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (input - 1) + this.month() % 3);
    }
    function getSetDayOfYear(input) {
        var dayOfYear = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
        return null == input ? dayOfYear : this.add(input - dayOfYear, "d");
    }
    function parseMs(input, array) {
        array[MILLISECOND] = toInt(1e3 * ("0." + input));
    }
    function getZoneAbbr() {
        return this._isUTC ? "UTC" : "";
    }
    function getZoneName() {
        return this._isUTC ? "Coordinated Universal Time" : "";
    }
    function createUnix(input) {
        return createLocal(1e3 * input);
    }
    function createInZone() {
        return createLocal.apply(null, arguments).parseZone();
    }
    function preParsePostFormat(string) {
        return string;
    }
    function get$1(format, index, field, setter) {
        var locale = getLocale(), utc = createUTC().set(setter, index);
        return locale[field](utc, format);
    }
    function listMonthsImpl(format, index, field) {
        if (isNumber(format) && (index = format, format = void 0), format = format || "", 
        null != index) return get$1(format, index, field, "month");
        var i, out = [];
        for (i = 0; i < 12; i++) out[i] = get$1(format, i, field, "month");
        return out;
    }
    function listWeekdaysImpl(localeSorted, format, index, field) {
        "boolean" == typeof localeSorted ? (isNumber(format) && (index = format, format = void 0), 
        format = format || "") : (format = localeSorted, index = format, localeSorted = !1, 
        isNumber(format) && (index = format, format = void 0), format = format || "");
        var locale = getLocale(), shift = localeSorted ? locale._week.dow : 0;
        if (null != index) return get$1(format, (index + shift) % 7, field, "day");
        var i, out = [];
        for (i = 0; i < 7; i++) out[i] = get$1(format, (i + shift) % 7, field, "day");
        return out;
    }
    function listMonths(format, index) {
        return listMonthsImpl(format, index, "months");
    }
    function listMonthsShort(format, index) {
        return listMonthsImpl(format, index, "monthsShort");
    }
    function listWeekdays(localeSorted, format, index) {
        return listWeekdaysImpl(localeSorted, format, index, "weekdays");
    }
    function listWeekdaysShort(localeSorted, format, index) {
        return listWeekdaysImpl(localeSorted, format, index, "weekdaysShort");
    }
    function listWeekdaysMin(localeSorted, format, index) {
        return listWeekdaysImpl(localeSorted, format, index, "weekdaysMin");
    }
    function abs() {
        var data = this._data;
        return this._milliseconds = mathAbs(this._milliseconds), this._days = mathAbs(this._days), 
        this._months = mathAbs(this._months), data.milliseconds = mathAbs(data.milliseconds), 
        data.seconds = mathAbs(data.seconds), data.minutes = mathAbs(data.minutes), data.hours = mathAbs(data.hours), 
        data.months = mathAbs(data.months), data.years = mathAbs(data.years), this;
    }
    function addSubtract$1(duration, input, value, direction) {
        var other = createDuration(input, value);
        return duration._milliseconds += direction * other._milliseconds, duration._days += direction * other._days, 
        duration._months += direction * other._months, duration._bubble();
    }
    function add$1(input, value) {
        return addSubtract$1(this, input, value, 1);
    }
    function subtract$1(input, value) {
        return addSubtract$1(this, input, value, -1);
    }
    function absCeil(number) {
        return number < 0 ? Math.floor(number) : Math.ceil(number);
    }
    function bubble() {
        var seconds, minutes, hours, years, monthsFromDays, milliseconds = this._milliseconds, days = this._days, months = this._months, data = this._data;
        return milliseconds >= 0 && days >= 0 && months >= 0 || milliseconds <= 0 && days <= 0 && months <= 0 || (milliseconds += 864e5 * absCeil(monthsToDays(months) + days), 
        days = 0, months = 0), data.milliseconds = milliseconds % 1e3, seconds = absFloor(milliseconds / 1e3), 
        data.seconds = seconds % 60, minutes = absFloor(seconds / 60), data.minutes = minutes % 60, 
        hours = absFloor(minutes / 60), data.hours = hours % 24, days += absFloor(hours / 24), 
        monthsFromDays = absFloor(daysToMonths(days)), months += monthsFromDays, days -= absCeil(monthsToDays(monthsFromDays)), 
        years = absFloor(months / 12), months %= 12, data.days = days, data.months = months, 
        data.years = years, this;
    }
    function daysToMonths(days) {
        return 4800 * days / 146097;
    }
    function monthsToDays(months) {
        return 146097 * months / 4800;
    }
    function as(units) {
        if (!this.isValid()) return NaN;
        var days, months, milliseconds = this._milliseconds;
        if ("month" === (units = normalizeUnits(units)) || "year" === units) return days = this._days + milliseconds / 864e5, 
        months = this._months + daysToMonths(days), "month" === units ? months : months / 12;
        switch (days = this._days + Math.round(monthsToDays(this._months)), units) {
          case "week":
            return days / 7 + milliseconds / 6048e5;

          case "day":
            return days + milliseconds / 864e5;

          case "hour":
            return 24 * days + milliseconds / 36e5;

          case "minute":
            return 1440 * days + milliseconds / 6e4;

          case "second":
            return 86400 * days + milliseconds / 1e3;

          case "millisecond":
            return Math.floor(864e5 * days) + milliseconds;

          default:
            throw new Error("Unknown unit " + units);
        }
    }
    function valueOf$1() {
        return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * toInt(this._months / 12) : NaN;
    }
    function makeAs(alias) {
        return function() {
            return this.as(alias);
        };
    }
    function get$2(units) {
        return units = normalizeUnits(units), this.isValid() ? this[units + "s"]() : NaN;
    }
    function makeGetter(name) {
        return function() {
            return this.isValid() ? this._data[name] : NaN;
        };
    }
    function weeks() {
        return absFloor(this.days() / 7);
    }
    function substituteTimeAgo(string, number, withoutSuffix, isFuture, locale) {
        return locale.relativeTime(number || 1, !!withoutSuffix, string, isFuture);
    }
    function relativeTime$1(posNegDuration, withoutSuffix, locale) {
        var duration = createDuration(posNegDuration).abs(), seconds = round(duration.as("s")), minutes = round(duration.as("m")), hours = round(duration.as("h")), days = round(duration.as("d")), months = round(duration.as("M")), years = round(duration.as("y")), a = seconds <= thresholds.ss && [ "s", seconds ] || seconds < thresholds.s && [ "ss", seconds ] || minutes <= 1 && [ "m" ] || minutes < thresholds.m && [ "mm", minutes ] || hours <= 1 && [ "h" ] || hours < thresholds.h && [ "hh", hours ] || days <= 1 && [ "d" ] || days < thresholds.d && [ "dd", days ] || months <= 1 && [ "M" ] || months < thresholds.M && [ "MM", months ] || years <= 1 && [ "y" ] || [ "yy", years ];
        return a[2] = withoutSuffix, a[3] = +posNegDuration > 0, a[4] = locale, substituteTimeAgo.apply(null, a);
    }
    function getSetRelativeTimeRounding(roundingFunction) {
        return void 0 === roundingFunction ? round : "function" == typeof roundingFunction && (round = roundingFunction, 
        !0);
    }
    function getSetRelativeTimeThreshold(threshold, limit) {
        return void 0 !== thresholds[threshold] && (void 0 === limit ? thresholds[threshold] : (thresholds[threshold] = limit, 
        "s" === threshold && (thresholds.ss = limit - 1), !0));
    }
    function humanize(withSuffix) {
        if (!this.isValid()) return this.localeData().invalidDate();
        var locale = this.localeData(), output = relativeTime$1(this, !withSuffix, locale);
        return withSuffix && (output = locale.pastFuture(+this, output)), locale.postformat(output);
    }
    function toISOString$1() {
        if (!this.isValid()) return this.localeData().invalidDate();
        var minutes, hours, years, seconds = abs$1(this._milliseconds) / 1e3, days = abs$1(this._days), months = abs$1(this._months);
        minutes = absFloor(seconds / 60), hours = absFloor(minutes / 60), seconds %= 60, 
        minutes %= 60, years = absFloor(months / 12), months %= 12;
        var Y = years, M = months, D = days, h = hours, m = minutes, s = seconds, total = this.asSeconds();
        return total ? (total < 0 ? "-" : "") + "P" + (Y ? Y + "Y" : "") + (M ? M + "M" : "") + (D ? D + "D" : "") + (h || m || s ? "T" : "") + (h ? h + "H" : "") + (m ? m + "M" : "") + (s ? s + "S" : "") : "P0D";
    }
    var hookCallback, some;
    some = Array.prototype.some ? Array.prototype.some : function(fun) {
        for (var t = Object(this), len = t.length >>> 0, i = 0; i < len; i++) if (i in t && fun.call(this, t[i], i, t)) return !0;
        return !1;
    };
    var some$1 = some, momentProperties = hooks.momentProperties = [], updateInProgress = !1, deprecations = {};
    hooks.suppressDeprecationWarnings = !1, hooks.deprecationHandler = null;
    var keys;
    keys = Object.keys ? Object.keys : function(obj) {
        var i, res = [];
        for (i in obj) hasOwnProp(obj, i) && res.push(i);
        return res;
    };
    var indexOf, keys$1 = keys, defaultCalendar = {
        sameDay: "[Today at] LT",
        nextDay: "[Tomorrow at] LT",
        nextWeek: "dddd [at] LT",
        lastDay: "[Yesterday at] LT",
        lastWeek: "[Last] dddd [at] LT",
        sameElse: "L"
    }, defaultLongDateFormat = {
        LTS: "h:mm:ss A",
        LT: "h:mm A",
        L: "MM/DD/YYYY",
        LL: "MMMM D, YYYY",
        LLL: "MMMM D, YYYY h:mm A",
        LLLL: "dddd, MMMM D, YYYY h:mm A"
    }, defaultDayOfMonthOrdinalParse = /\d{1,2}/, defaultRelativeTime = {
        future: "in %s",
        past: "%s ago",
        s: "a few seconds",
        ss: "%d seconds",
        m: "a minute",
        mm: "%d minutes",
        h: "an hour",
        hh: "%d hours",
        d: "a day",
        dd: "%d days",
        M: "a month",
        MM: "%d months",
        y: "a year",
        yy: "%d years"
    }, aliases = {}, priorities = {}, formattingTokens = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g, localFormattingTokens = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, formatFunctions = {}, formatTokenFunctions = {}, match1 = /\d/, match2 = /\d\d/, match3 = /\d{3}/, match4 = /\d{4}/, match6 = /[+-]?\d{6}/, match1to2 = /\d\d?/, match3to4 = /\d\d\d\d?/, match5to6 = /\d\d\d\d\d\d?/, match1to3 = /\d{1,3}/, match1to4 = /\d{1,4}/, match1to6 = /[+-]?\d{1,6}/, matchUnsigned = /\d+/, matchSigned = /[+-]?\d+/, matchOffset = /Z|[+-]\d\d:?\d\d/gi, matchShortOffset = /Z|[+-]\d\d(?::?\d\d)?/gi, matchTimestamp = /[+-]?\d+(\.\d{1,3})?/, matchWord = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i, regexes = {}, tokens = {}, YEAR = 0, MONTH = 1, DATE = 2, HOUR = 3, MINUTE = 4, SECOND = 5, MILLISECOND = 6, WEEK = 7, WEEKDAY = 8;
    indexOf = Array.prototype.indexOf ? Array.prototype.indexOf : function(o) {
        var i;
        for (i = 0; i < this.length; ++i) if (this[i] === o) return i;
        return -1;
    };
    var indexOf$1 = indexOf;
    addFormatToken("M", [ "MM", 2 ], "Mo", function() {
        return this.month() + 1;
    }), addFormatToken("MMM", 0, 0, function(format) {
        return this.localeData().monthsShort(this, format);
    }), addFormatToken("MMMM", 0, 0, function(format) {
        return this.localeData().months(this, format);
    }), addUnitAlias("month", "M"), addUnitPriority("month", 8), addRegexToken("M", match1to2), 
    addRegexToken("MM", match1to2, match2), addRegexToken("MMM", function(isStrict, locale) {
        return locale.monthsShortRegex(isStrict);
    }), addRegexToken("MMMM", function(isStrict, locale) {
        return locale.monthsRegex(isStrict);
    }), addParseToken([ "M", "MM" ], function(input, array) {
        array[MONTH] = toInt(input) - 1;
    }), addParseToken([ "MMM", "MMMM" ], function(input, array, config, token) {
        var month = config._locale.monthsParse(input, token, config._strict);
        null != month ? array[MONTH] = month : getParsingFlags(config).invalidMonth = input;
    });
    var MONTHS_IN_FORMAT = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/, defaultLocaleMonths = "January_February_March_April_May_June_July_August_September_October_November_December".split("_"), defaultLocaleMonthsShort = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"), defaultMonthsShortRegex = matchWord, defaultMonthsRegex = matchWord;
    addFormatToken("Y", 0, 0, function() {
        var y = this.year();
        return y <= 9999 ? "" + y : "+" + y;
    }), addFormatToken(0, [ "YY", 2 ], 0, function() {
        return this.year() % 100;
    }), addFormatToken(0, [ "YYYY", 4 ], 0, "year"), addFormatToken(0, [ "YYYYY", 5 ], 0, "year"), 
    addFormatToken(0, [ "YYYYYY", 6, !0 ], 0, "year"), addUnitAlias("year", "y"), addUnitPriority("year", 1), 
    addRegexToken("Y", matchSigned), addRegexToken("YY", match1to2, match2), addRegexToken("YYYY", match1to4, match4), 
    addRegexToken("YYYYY", match1to6, match6), addRegexToken("YYYYYY", match1to6, match6), 
    addParseToken([ "YYYYY", "YYYYYY" ], YEAR), addParseToken("YYYY", function(input, array) {
        array[YEAR] = 2 === input.length ? hooks.parseTwoDigitYear(input) : toInt(input);
    }), addParseToken("YY", function(input, array) {
        array[YEAR] = hooks.parseTwoDigitYear(input);
    }), addParseToken("Y", function(input, array) {
        array[YEAR] = parseInt(input, 10);
    }), hooks.parseTwoDigitYear = function(input) {
        return toInt(input) + (toInt(input) > 68 ? 1900 : 2e3);
    };
    var getSetYear = makeGetSet("FullYear", !0);
    addFormatToken("w", [ "ww", 2 ], "wo", "week"), addFormatToken("W", [ "WW", 2 ], "Wo", "isoWeek"), 
    addUnitAlias("week", "w"), addUnitAlias("isoWeek", "W"), addUnitPriority("week", 5), 
    addUnitPriority("isoWeek", 5), addRegexToken("w", match1to2), addRegexToken("ww", match1to2, match2), 
    addRegexToken("W", match1to2), addRegexToken("WW", match1to2, match2), addWeekParseToken([ "w", "ww", "W", "WW" ], function(input, week, config, token) {
        week[token.substr(0, 1)] = toInt(input);
    });
    var defaultLocaleWeek = {
        dow: 0,
        doy: 6
    };
    addFormatToken("d", 0, "do", "day"), addFormatToken("dd", 0, 0, function(format) {
        return this.localeData().weekdaysMin(this, format);
    }), addFormatToken("ddd", 0, 0, function(format) {
        return this.localeData().weekdaysShort(this, format);
    }), addFormatToken("dddd", 0, 0, function(format) {
        return this.localeData().weekdays(this, format);
    }), addFormatToken("e", 0, 0, "weekday"), addFormatToken("E", 0, 0, "isoWeekday"), 
    addUnitAlias("day", "d"), addUnitAlias("weekday", "e"), addUnitAlias("isoWeekday", "E"), 
    addUnitPriority("day", 11), addUnitPriority("weekday", 11), addUnitPriority("isoWeekday", 11), 
    addRegexToken("d", match1to2), addRegexToken("e", match1to2), addRegexToken("E", match1to2), 
    addRegexToken("dd", function(isStrict, locale) {
        return locale.weekdaysMinRegex(isStrict);
    }), addRegexToken("ddd", function(isStrict, locale) {
        return locale.weekdaysShortRegex(isStrict);
    }), addRegexToken("dddd", function(isStrict, locale) {
        return locale.weekdaysRegex(isStrict);
    }), addWeekParseToken([ "dd", "ddd", "dddd" ], function(input, week, config, token) {
        var weekday = config._locale.weekdaysParse(input, token, config._strict);
        null != weekday ? week.d = weekday : getParsingFlags(config).invalidWeekday = input;
    }), addWeekParseToken([ "d", "e", "E" ], function(input, week, config, token) {
        week[token] = toInt(input);
    });
    var defaultLocaleWeekdays = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"), defaultLocaleWeekdaysShort = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"), defaultLocaleWeekdaysMin = "Su_Mo_Tu_We_Th_Fr_Sa".split("_"), defaultWeekdaysRegex = matchWord, defaultWeekdaysShortRegex = matchWord, defaultWeekdaysMinRegex = matchWord;
    addFormatToken("H", [ "HH", 2 ], 0, "hour"), addFormatToken("h", [ "hh", 2 ], 0, hFormat), 
    addFormatToken("k", [ "kk", 2 ], 0, kFormat), addFormatToken("hmm", 0, 0, function() {
        return "" + hFormat.apply(this) + zeroFill(this.minutes(), 2);
    }), addFormatToken("hmmss", 0, 0, function() {
        return "" + hFormat.apply(this) + zeroFill(this.minutes(), 2) + zeroFill(this.seconds(), 2);
    }), addFormatToken("Hmm", 0, 0, function() {
        return "" + this.hours() + zeroFill(this.minutes(), 2);
    }), addFormatToken("Hmmss", 0, 0, function() {
        return "" + this.hours() + zeroFill(this.minutes(), 2) + zeroFill(this.seconds(), 2);
    }), meridiem("a", !0), meridiem("A", !1), addUnitAlias("hour", "h"), addUnitPriority("hour", 13), 
    addRegexToken("a", matchMeridiem), addRegexToken("A", matchMeridiem), addRegexToken("H", match1to2), 
    addRegexToken("h", match1to2), addRegexToken("k", match1to2), addRegexToken("HH", match1to2, match2), 
    addRegexToken("hh", match1to2, match2), addRegexToken("kk", match1to2, match2), 
    addRegexToken("hmm", match3to4), addRegexToken("hmmss", match5to6), addRegexToken("Hmm", match3to4), 
    addRegexToken("Hmmss", match5to6), addParseToken([ "H", "HH" ], HOUR), addParseToken([ "k", "kk" ], function(input, array, config) {
        var kInput = toInt(input);
        array[HOUR] = 24 === kInput ? 0 : kInput;
    }), addParseToken([ "a", "A" ], function(input, array, config) {
        config._isPm = config._locale.isPM(input), config._meridiem = input;
    }), addParseToken([ "h", "hh" ], function(input, array, config) {
        array[HOUR] = toInt(input), getParsingFlags(config).bigHour = !0;
    }), addParseToken("hmm", function(input, array, config) {
        var pos = input.length - 2;
        array[HOUR] = toInt(input.substr(0, pos)), array[MINUTE] = toInt(input.substr(pos)), 
        getParsingFlags(config).bigHour = !0;
    }), addParseToken("hmmss", function(input, array, config) {
        var pos1 = input.length - 4, pos2 = input.length - 2;
        array[HOUR] = toInt(input.substr(0, pos1)), array[MINUTE] = toInt(input.substr(pos1, 2)), 
        array[SECOND] = toInt(input.substr(pos2)), getParsingFlags(config).bigHour = !0;
    }), addParseToken("Hmm", function(input, array, config) {
        var pos = input.length - 2;
        array[HOUR] = toInt(input.substr(0, pos)), array[MINUTE] = toInt(input.substr(pos));
    }), addParseToken("Hmmss", function(input, array, config) {
        var pos1 = input.length - 4, pos2 = input.length - 2;
        array[HOUR] = toInt(input.substr(0, pos1)), array[MINUTE] = toInt(input.substr(pos1, 2)), 
        array[SECOND] = toInt(input.substr(pos2));
    });
    var globalLocale, defaultLocaleMeridiemParse = /[ap]\.?m?\.?/i, getSetHour = makeGetSet("Hours", !0), baseConfig = {
        calendar: defaultCalendar,
        longDateFormat: defaultLongDateFormat,
        invalidDate: "Invalid date",
        ordinal: "%d",
        dayOfMonthOrdinalParse: defaultDayOfMonthOrdinalParse,
        relativeTime: defaultRelativeTime,
        months: defaultLocaleMonths,
        monthsShort: defaultLocaleMonthsShort,
        week: defaultLocaleWeek,
        weekdays: defaultLocaleWeekdays,
        weekdaysMin: defaultLocaleWeekdaysMin,
        weekdaysShort: defaultLocaleWeekdaysShort,
        meridiemParse: defaultLocaleMeridiemParse
    }, locales = {}, localeFamilies = {}, extendedIsoRegex = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/, basicIsoRegex = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/, tzRegex = /Z|[+-]\d\d(?::?\d\d)?/, isoDates = [ [ "YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/ ], [ "YYYY-MM-DD", /\d{4}-\d\d-\d\d/ ], [ "GGGG-[W]WW-E", /\d{4}-W\d\d-\d/ ], [ "GGGG-[W]WW", /\d{4}-W\d\d/, !1 ], [ "YYYY-DDD", /\d{4}-\d{3}/ ], [ "YYYY-MM", /\d{4}-\d\d/, !1 ], [ "YYYYYYMMDD", /[+-]\d{10}/ ], [ "YYYYMMDD", /\d{8}/ ], [ "GGGG[W]WWE", /\d{4}W\d{3}/ ], [ "GGGG[W]WW", /\d{4}W\d{2}/, !1 ], [ "YYYYDDD", /\d{7}/ ] ], isoTimes = [ [ "HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/ ], [ "HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/ ], [ "HH:mm:ss", /\d\d:\d\d:\d\d/ ], [ "HH:mm", /\d\d:\d\d/ ], [ "HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/ ], [ "HHmmss,SSSS", /\d\d\d\d\d\d,\d+/ ], [ "HHmmss", /\d\d\d\d\d\d/ ], [ "HHmm", /\d\d\d\d/ ], [ "HH", /\d\d/ ] ], aspNetJsonRegex = /^\/?Date\((\-?\d+)/i, basicRfcRegex = /^((?:Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d?\d\s(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(?:\d\d)?\d\d\s)(\d\d:\d\d)(\:\d\d)?(\s(?:UT|GMT|[ECMP][SD]T|[A-IK-Za-ik-z]|[+-]\d{4}))$/;
    hooks.createFromInputFallback = deprecate("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function(config) {
        config._d = new Date(config._i + (config._useUTC ? " UTC" : ""));
    }), hooks.ISO_8601 = function() {}, hooks.RFC_2822 = function() {};
    var prototypeMin = deprecate("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function() {
        var other = createLocal.apply(null, arguments);
        return this.isValid() && other.isValid() ? other < this ? this : other : createInvalid();
    }), prototypeMax = deprecate("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function() {
        var other = createLocal.apply(null, arguments);
        return this.isValid() && other.isValid() ? other > this ? this : other : createInvalid();
    }), now = function() {
        return Date.now ? Date.now() : +new Date();
    }, ordering = [ "year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond" ];
    offset("Z", ":"), offset("ZZ", ""), addRegexToken("Z", matchShortOffset), addRegexToken("ZZ", matchShortOffset), 
    addParseToken([ "Z", "ZZ" ], function(input, array, config) {
        config._useUTC = !0, config._tzm = offsetFromString(matchShortOffset, input);
    });
    var chunkOffset = /([\+\-]|\d\d)/gi;
    hooks.updateOffset = function() {};
    var aspNetRegex = /^(\-)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/, isoRegex = /^(-)?P(?:(-?[0-9,.]*)Y)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)W)?(?:(-?[0-9,.]*)D)?(?:T(?:(-?[0-9,.]*)H)?(?:(-?[0-9,.]*)M)?(?:(-?[0-9,.]*)S)?)?$/;
    createDuration.fn = Duration.prototype, createDuration.invalid = createInvalid$1;
    var add = createAdder(1, "add"), subtract = createAdder(-1, "subtract");
    hooks.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", hooks.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
    var lang = deprecate("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function(key) {
        return void 0 === key ? this.localeData() : this.locale(key);
    });
    addFormatToken(0, [ "gg", 2 ], 0, function() {
        return this.weekYear() % 100;
    }), addFormatToken(0, [ "GG", 2 ], 0, function() {
        return this.isoWeekYear() % 100;
    }), addWeekYearFormatToken("gggg", "weekYear"), addWeekYearFormatToken("ggggg", "weekYear"), 
    addWeekYearFormatToken("GGGG", "isoWeekYear"), addWeekYearFormatToken("GGGGG", "isoWeekYear"), 
    addUnitAlias("weekYear", "gg"), addUnitAlias("isoWeekYear", "GG"), addUnitPriority("weekYear", 1), 
    addUnitPriority("isoWeekYear", 1), addRegexToken("G", matchSigned), addRegexToken("g", matchSigned), 
    addRegexToken("GG", match1to2, match2), addRegexToken("gg", match1to2, match2), 
    addRegexToken("GGGG", match1to4, match4), addRegexToken("gggg", match1to4, match4), 
    addRegexToken("GGGGG", match1to6, match6), addRegexToken("ggggg", match1to6, match6), 
    addWeekParseToken([ "gggg", "ggggg", "GGGG", "GGGGG" ], function(input, week, config, token) {
        week[token.substr(0, 2)] = toInt(input);
    }), addWeekParseToken([ "gg", "GG" ], function(input, week, config, token) {
        week[token] = hooks.parseTwoDigitYear(input);
    }), addFormatToken("Q", 0, "Qo", "quarter"), addUnitAlias("quarter", "Q"), addUnitPriority("quarter", 7), 
    addRegexToken("Q", match1), addParseToken("Q", function(input, array) {
        array[MONTH] = 3 * (toInt(input) - 1);
    }), addFormatToken("D", [ "DD", 2 ], "Do", "date"), addUnitAlias("date", "D"), addUnitPriority("date", 9), 
    addRegexToken("D", match1to2), addRegexToken("DD", match1to2, match2), addRegexToken("Do", function(isStrict, locale) {
        return isStrict ? locale._dayOfMonthOrdinalParse || locale._ordinalParse : locale._dayOfMonthOrdinalParseLenient;
    }), addParseToken([ "D", "DD" ], DATE), addParseToken("Do", function(input, array) {
        array[DATE] = toInt(input.match(match1to2)[0], 10);
    });
    var getSetDayOfMonth = makeGetSet("Date", !0);
    addFormatToken("DDD", [ "DDDD", 3 ], "DDDo", "dayOfYear"), addUnitAlias("dayOfYear", "DDD"), 
    addUnitPriority("dayOfYear", 4), addRegexToken("DDD", match1to3), addRegexToken("DDDD", match3), 
    addParseToken([ "DDD", "DDDD" ], function(input, array, config) {
        config._dayOfYear = toInt(input);
    }), addFormatToken("m", [ "mm", 2 ], 0, "minute"), addUnitAlias("minute", "m"), 
    addUnitPriority("minute", 14), addRegexToken("m", match1to2), addRegexToken("mm", match1to2, match2), 
    addParseToken([ "m", "mm" ], MINUTE);
    var getSetMinute = makeGetSet("Minutes", !1);
    addFormatToken("s", [ "ss", 2 ], 0, "second"), addUnitAlias("second", "s"), addUnitPriority("second", 15), 
    addRegexToken("s", match1to2), addRegexToken("ss", match1to2, match2), addParseToken([ "s", "ss" ], SECOND);
    var getSetSecond = makeGetSet("Seconds", !1);
    addFormatToken("S", 0, 0, function() {
        return ~~(this.millisecond() / 100);
    }), addFormatToken(0, [ "SS", 2 ], 0, function() {
        return ~~(this.millisecond() / 10);
    }), addFormatToken(0, [ "SSS", 3 ], 0, "millisecond"), addFormatToken(0, [ "SSSS", 4 ], 0, function() {
        return 10 * this.millisecond();
    }), addFormatToken(0, [ "SSSSS", 5 ], 0, function() {
        return 100 * this.millisecond();
    }), addFormatToken(0, [ "SSSSSS", 6 ], 0, function() {
        return 1e3 * this.millisecond();
    }), addFormatToken(0, [ "SSSSSSS", 7 ], 0, function() {
        return 1e4 * this.millisecond();
    }), addFormatToken(0, [ "SSSSSSSS", 8 ], 0, function() {
        return 1e5 * this.millisecond();
    }), addFormatToken(0, [ "SSSSSSSSS", 9 ], 0, function() {
        return 1e6 * this.millisecond();
    }), addUnitAlias("millisecond", "ms"), addUnitPriority("millisecond", 16), addRegexToken("S", match1to3, match1), 
    addRegexToken("SS", match1to3, match2), addRegexToken("SSS", match1to3, match3);
    var token;
    for (token = "SSSS"; token.length <= 9; token += "S") addRegexToken(token, matchUnsigned);
    for (token = "S"; token.length <= 9; token += "S") addParseToken(token, parseMs);
    var getSetMillisecond = makeGetSet("Milliseconds", !1);
    addFormatToken("z", 0, 0, "zoneAbbr"), addFormatToken("zz", 0, 0, "zoneName");
    var proto = Moment.prototype;
    proto.add = add, proto.calendar = calendar$1, proto.clone = clone, proto.diff = diff, 
    proto.endOf = endOf, proto.format = format, proto.from = from, proto.fromNow = fromNow, 
    proto.to = to, proto.toNow = toNow, proto.get = stringGet, proto.invalidAt = invalidAt, 
    proto.isAfter = isAfter, proto.isBefore = isBefore, proto.isBetween = isBetween, 
    proto.isSame = isSame, proto.isSameOrAfter = isSameOrAfter, proto.isSameOrBefore = isSameOrBefore, 
    proto.isValid = isValid$2, proto.lang = lang, proto.locale = locale, proto.localeData = localeData, 
    proto.max = prototypeMax, proto.min = prototypeMin, proto.parsingFlags = parsingFlags, 
    proto.set = stringSet, proto.startOf = startOf, proto.subtract = subtract, proto.toArray = toArray, 
    proto.toObject = toObject, proto.toDate = toDate, proto.toISOString = toISOString, 
    proto.inspect = inspect, proto.toJSON = toJSON, proto.toString = toString, proto.unix = unix, 
    proto.valueOf = valueOf, proto.creationData = creationData, proto.year = getSetYear, 
    proto.isLeapYear = getIsLeapYear, proto.weekYear = getSetWeekYear, proto.isoWeekYear = getSetISOWeekYear, 
    proto.quarter = proto.quarters = getSetQuarter, proto.month = getSetMonth, proto.daysInMonth = getDaysInMonth, 
    proto.week = proto.weeks = getSetWeek, proto.isoWeek = proto.isoWeeks = getSetISOWeek, 
    proto.weeksInYear = getWeeksInYear, proto.isoWeeksInYear = getISOWeeksInYear, proto.date = getSetDayOfMonth, 
    proto.day = proto.days = getSetDayOfWeek, proto.weekday = getSetLocaleDayOfWeek, 
    proto.isoWeekday = getSetISODayOfWeek, proto.dayOfYear = getSetDayOfYear, proto.hour = proto.hours = getSetHour, 
    proto.minute = proto.minutes = getSetMinute, proto.second = proto.seconds = getSetSecond, 
    proto.millisecond = proto.milliseconds = getSetMillisecond, proto.utcOffset = getSetOffset, 
    proto.utc = setOffsetToUTC, proto.local = setOffsetToLocal, proto.parseZone = setOffsetToParsedOffset, 
    proto.hasAlignedHourOffset = hasAlignedHourOffset, proto.isDST = isDaylightSavingTime, 
    proto.isLocal = isLocal, proto.isUtcOffset = isUtcOffset, proto.isUtc = isUtc, proto.isUTC = isUtc, 
    proto.zoneAbbr = getZoneAbbr, proto.zoneName = getZoneName, proto.dates = deprecate("dates accessor is deprecated. Use date instead.", getSetDayOfMonth), 
    proto.months = deprecate("months accessor is deprecated. Use month instead", getSetMonth), 
    proto.years = deprecate("years accessor is deprecated. Use year instead", getSetYear), 
    proto.zone = deprecate("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", getSetZone), 
    proto.isDSTShifted = deprecate("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", isDaylightSavingTimeShifted);
    var proto$1 = Locale.prototype;
    proto$1.calendar = calendar, proto$1.longDateFormat = longDateFormat, proto$1.invalidDate = invalidDate, 
    proto$1.ordinal = ordinal, proto$1.preparse = preParsePostFormat, proto$1.postformat = preParsePostFormat, 
    proto$1.relativeTime = relativeTime, proto$1.pastFuture = pastFuture, proto$1.set = set, 
    proto$1.months = localeMonths, proto$1.monthsShort = localeMonthsShort, proto$1.monthsParse = localeMonthsParse, 
    proto$1.monthsRegex = monthsRegex, proto$1.monthsShortRegex = monthsShortRegex, 
    proto$1.week = localeWeek, proto$1.firstDayOfYear = localeFirstDayOfYear, proto$1.firstDayOfWeek = localeFirstDayOfWeek, 
    proto$1.weekdays = localeWeekdays, proto$1.weekdaysMin = localeWeekdaysMin, proto$1.weekdaysShort = localeWeekdaysShort, 
    proto$1.weekdaysParse = localeWeekdaysParse, proto$1.weekdaysRegex = weekdaysRegex, 
    proto$1.weekdaysShortRegex = weekdaysShortRegex, proto$1.weekdaysMinRegex = weekdaysMinRegex, 
    proto$1.isPM = localeIsPM, proto$1.meridiem = localeMeridiem, getSetGlobalLocale("en", {
        dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
        ordinal: function(number) {
            var b = number % 10;
            return number + (1 === toInt(number % 100 / 10) ? "th" : 1 === b ? "st" : 2 === b ? "nd" : 3 === b ? "rd" : "th");
        }
    }), hooks.lang = deprecate("moment.lang is deprecated. Use moment.locale instead.", getSetGlobalLocale), 
    hooks.langData = deprecate("moment.langData is deprecated. Use moment.localeData instead.", getLocale);
    var mathAbs = Math.abs, asMilliseconds = makeAs("ms"), asSeconds = makeAs("s"), asMinutes = makeAs("m"), asHours = makeAs("h"), asDays = makeAs("d"), asWeeks = makeAs("w"), asMonths = makeAs("M"), asYears = makeAs("y"), milliseconds = makeGetter("milliseconds"), seconds = makeGetter("seconds"), minutes = makeGetter("minutes"), hours = makeGetter("hours"), days = makeGetter("days"), months = makeGetter("months"), years = makeGetter("years"), round = Math.round, thresholds = {
        ss: 44,
        s: 45,
        m: 45,
        h: 22,
        d: 26,
        M: 11
    }, abs$1 = Math.abs, proto$2 = Duration.prototype;
    return proto$2.isValid = isValid$1, proto$2.abs = abs, proto$2.add = add$1, proto$2.subtract = subtract$1, 
    proto$2.as = as, proto$2.asMilliseconds = asMilliseconds, proto$2.asSeconds = asSeconds, 
    proto$2.asMinutes = asMinutes, proto$2.asHours = asHours, proto$2.asDays = asDays, 
    proto$2.asWeeks = asWeeks, proto$2.asMonths = asMonths, proto$2.asYears = asYears, 
    proto$2.valueOf = valueOf$1, proto$2._bubble = bubble, proto$2.get = get$2, proto$2.milliseconds = milliseconds, 
    proto$2.seconds = seconds, proto$2.minutes = minutes, proto$2.hours = hours, proto$2.days = days, 
    proto$2.weeks = weeks, proto$2.months = months, proto$2.years = years, proto$2.humanize = humanize, 
    proto$2.toISOString = toISOString$1, proto$2.toString = toISOString$1, proto$2.toJSON = toISOString$1, 
    proto$2.locale = locale, proto$2.localeData = localeData, proto$2.toIsoString = deprecate("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", toISOString$1), 
    proto$2.lang = lang, addFormatToken("X", 0, 0, "unix"), addFormatToken("x", 0, 0, "valueOf"), 
    addRegexToken("x", matchSigned), addRegexToken("X", matchTimestamp), addParseToken("X", function(input, array, config) {
        config._d = new Date(1e3 * parseFloat(input, 10));
    }), addParseToken("x", function(input, array, config) {
        config._d = new Date(toInt(input));
    }), hooks.version = "2.18.1", function(callback) {
        hookCallback = callback;
    }(createLocal), hooks.fn = proto, hooks.min = min, hooks.max = max, hooks.now = now, 
    hooks.utc = createUTC, hooks.unix = createUnix, hooks.months = listMonths, hooks.isDate = isDate, 
    hooks.locale = getSetGlobalLocale, hooks.invalid = createInvalid, hooks.duration = createDuration, 
    hooks.isMoment = isMoment, hooks.weekdays = listWeekdays, hooks.parseZone = createInZone, 
    hooks.localeData = getLocale, hooks.isDuration = isDuration, hooks.monthsShort = listMonthsShort, 
    hooks.weekdaysMin = listWeekdaysMin, hooks.defineLocale = defineLocale, hooks.updateLocale = updateLocale, 
    hooks.locales = listLocales, hooks.weekdaysShort = listWeekdaysShort, hooks.normalizeUnits = normalizeUnits, 
    hooks.relativeTimeRounding = getSetRelativeTimeRounding, hooks.relativeTimeThreshold = getSetRelativeTimeThreshold, 
    hooks.calendarFormat = getCalendarFormat, hooks.prototype = proto, hooks;
}), function(factory) {
    "function" == typeof define && define.amd ? define([ "picker", "jquery" ], factory) : "object" == typeof exports ? module.exports = factory(require("./picker.js"), require("jquery")) : factory(Picker, jQuery);
}(function(Picker, $) {
    function TimePicker(picker, settings) {
        var clock = this, elementValue = picker.$node[0].value, elementDataValue = picker.$node.data("value"), valueString = elementDataValue || elementValue, formatString = elementDataValue ? settings.formatSubmit : settings.format;
        clock.settings = settings, clock.$node = picker.$node, clock.queue = {
            interval: "i",
            min: "measure create",
            max: "measure create",
            now: "now create",
            select: "parse create validate",
            highlight: "parse create validate",
            view: "parse create validate",
            disable: "deactivate",
            enable: "activate"
        }, clock.item = {}, clock.item.clear = null, clock.item.interval = settings.interval || 30, 
        clock.item.disable = (settings.disable || []).slice(0), clock.item.enable = -function(collectionDisabled) {
            return !0 === collectionDisabled[0] ? collectionDisabled.shift() : -1;
        }(clock.item.disable), clock.set("min", settings.min).set("max", settings.max).set("now"), 
        valueString ? clock.set("select", valueString, {
            format: formatString
        }) : clock.set("select", null).set("highlight", clock.item.now), clock.key = {
            40: 1,
            38: -1,
            39: 1,
            37: -1,
            go: function(timeChange) {
                clock.set("highlight", clock.item.highlight.pick + timeChange * clock.item.interval, {
                    interval: timeChange * clock.item.interval
                }), this.render();
            }
        }, picker.on("render", function() {
            var $pickerHolder = picker.$root.children(), $viewset = $pickerHolder.find("." + settings.klass.viewset), vendors = function(prop) {
                return [ "webkit", "moz", "ms", "o", "" ].map(function(vendor) {
                    return (vendor ? "-" + vendor + "-" : "") + prop;
                });
            }, animations = function($el, state) {
                vendors("transform").map(function(prop) {
                    $el.css(prop, state);
                }), vendors("transition").map(function(prop) {
                    $el.css(prop, state);
                });
            };
            $viewset.length && (animations($pickerHolder, "none"), $pickerHolder[0].scrollTop = ~~$viewset.position().top - 2 * $viewset[0].clientHeight, 
            animations($pickerHolder, ""));
        }, 1).on("open", function() {
            picker.$root.find("button").attr("disabled", !1);
        }, 1).on("close", function() {
            picker.$root.find("button").attr("disabled", !0);
        }, 1);
    }
    var _ = Picker._;
    TimePicker.prototype.set = function(type, value, options) {
        var clock = this, clockItem = clock.item;
        return null === value ? ("clear" == type && (type = "select"), clockItem[type] = value, 
        clock) : (clockItem["enable" == type ? "disable" : "flip" == type ? "enable" : type] = clock.queue[type].split(" ").map(function(method) {
            return value = clock[method](type, value, options);
        }).pop(), "select" == type ? clock.set("highlight", clockItem.select, options) : "highlight" == type ? clock.set("view", clockItem.highlight, options) : "interval" == type ? clock.set("min", clockItem.min, options).set("max", clockItem.max, options) : type.match(/^(flip|min|max|disable|enable)$/) && (clockItem.select && clock.disabled(clockItem.select) && clock.set("select", value, options), 
        clockItem.highlight && clock.disabled(clockItem.highlight) && clock.set("highlight", value, options), 
        "min" == type && clock.set("max", clockItem.max, options)), clock);
    }, TimePicker.prototype.get = function(type) {
        return this.item[type];
    }, TimePicker.prototype.create = function(type, value, options) {
        var clock = this;
        return value = void 0 === value ? type : value, _.isDate(value) && (value = [ value.getHours(), value.getMinutes() ]), 
        $.isPlainObject(value) && _.isInteger(value.pick) ? value = value.pick : $.isArray(value) ? value = 60 * +value[0] + +value[1] : _.isInteger(value) || (value = clock.now(type, value, options)), 
        "max" == type && value < clock.item.min.pick && (value += 1440), "min" != type && "max" != type && (value - clock.item.min.pick) % clock.item.interval != 0 && (value += clock.item.interval), 
        value = clock.normalize(type, value, options), {
            hour: ~~(24 + value / 60) % 24,
            mins: (60 + value % 60) % 60,
            time: (1440 + value) % 1440,
            pick: value % 1440
        };
    }, TimePicker.prototype.createRange = function(from, to) {
        var clock = this, createTime = function(time) {
            return !0 === time || $.isArray(time) || _.isDate(time) ? clock.create(time) : time;
        };
        return _.isInteger(from) || (from = createTime(from)), _.isInteger(to) || (to = createTime(to)), 
        _.isInteger(from) && $.isPlainObject(to) ? from = [ to.hour, to.mins + from * clock.settings.interval ] : _.isInteger(to) && $.isPlainObject(from) && (to = [ from.hour, from.mins + to * clock.settings.interval ]), 
        {
            from: createTime(from),
            to: createTime(to)
        };
    }, TimePicker.prototype.withinRange = function(range, timeUnit) {
        return range = this.createRange(range.from, range.to), timeUnit.pick >= range.from.pick && timeUnit.pick <= range.to.pick;
    }, TimePicker.prototype.overlapRanges = function(one, two) {
        var clock = this;
        return one = clock.createRange(one.from, one.to), two = clock.createRange(two.from, two.to), 
        clock.withinRange(one, two.from) || clock.withinRange(one, two.to) || clock.withinRange(two, one.from) || clock.withinRange(two, one.to);
    }, TimePicker.prototype.now = function(type, value) {
        var isBelowInterval, interval = this.item.interval, date = new Date(), nowMinutes = 60 * date.getHours() + date.getMinutes(), isValueInteger = _.isInteger(value);
        return nowMinutes -= nowMinutes % interval, isBelowInterval = value < 0 && interval * value + nowMinutes <= -interval, 
        nowMinutes += "min" == type && isBelowInterval ? 0 : interval, isValueInteger && (nowMinutes += interval * (isBelowInterval && "max" != type ? value + 1 : value)), 
        nowMinutes;
    }, TimePicker.prototype.normalize = function(type, value) {
        var interval = this.item.interval, minTime = this.item.min && this.item.min.pick || 0;
        return value -= "min" == type ? 0 : (value - minTime) % interval;
    }, TimePicker.prototype.measure = function(type, value, options) {
        var clock = this;
        return value || (value = "min" == type ? [ 0, 0 ] : [ 23, 59 ]), "string" == typeof value ? value = clock.parse(type, value) : !0 === value || _.isInteger(value) ? value = clock.now(type, value, options) : $.isPlainObject(value) && _.isInteger(value.pick) && (value = clock.normalize(type, value.pick, options)), 
        value;
    }, TimePicker.prototype.validate = function(type, timeObject, options) {
        var clock = this, interval = options && options.interval ? options.interval : clock.item.interval;
        return clock.disabled(timeObject) && (timeObject = clock.shift(timeObject, interval)), 
        timeObject = clock.scope(timeObject), clock.disabled(timeObject) && (timeObject = clock.shift(timeObject, -1 * interval)), 
        timeObject;
    }, TimePicker.prototype.disabled = function(timeToVerify) {
        var clock = this, isDisabledMatch = clock.item.disable.filter(function(timeToDisable) {
            return _.isInteger(timeToDisable) ? timeToVerify.hour == timeToDisable : $.isArray(timeToDisable) || _.isDate(timeToDisable) ? timeToVerify.pick == clock.create(timeToDisable).pick : $.isPlainObject(timeToDisable) ? clock.withinRange(timeToDisable, timeToVerify) : void 0;
        });
        return isDisabledMatch = isDisabledMatch.length && !isDisabledMatch.filter(function(timeToDisable) {
            return $.isArray(timeToDisable) && "inverted" == timeToDisable[2] || $.isPlainObject(timeToDisable) && timeToDisable.inverted;
        }).length, -1 === clock.item.enable ? !isDisabledMatch : isDisabledMatch || timeToVerify.pick < clock.item.min.pick || timeToVerify.pick > clock.item.max.pick;
    }, TimePicker.prototype.shift = function(timeObject, interval) {
        var clock = this, minLimit = clock.item.min.pick, maxLimit = clock.item.max.pick;
        for (interval = interval || clock.item.interval; clock.disabled(timeObject) && (timeObject = clock.create(timeObject.pick += interval), 
        !(timeObject.pick <= minLimit || timeObject.pick >= maxLimit)); ) ;
        return timeObject;
    }, TimePicker.prototype.scope = function(timeObject) {
        var minLimit = this.item.min.pick, maxLimit = this.item.max.pick;
        return this.create(timeObject.pick > maxLimit ? maxLimit : timeObject.pick < minLimit ? minLimit : timeObject);
    }, TimePicker.prototype.parse = function(type, value, options) {
        var hour, minutes, isPM, item, parseValue, clock = this, parsingObject = {};
        if (!value || "string" != typeof value) return value;
        options && options.format || (options = options || {}, options.format = clock.settings.format), 
        clock.formats.toArray(options.format).map(function(label) {
            var substring, formattingLabel = clock.formats[label], formatLength = formattingLabel ? _.trigger(formattingLabel, clock, [ value, parsingObject ]) : label.replace(/^!/, "").length;
            formattingLabel && (substring = value.substr(0, formatLength), parsingObject[label] = substring.match(/^\d+$/) ? +substring : substring), 
            value = value.substr(formatLength);
        });
        for (item in parsingObject) parseValue = parsingObject[item], _.isInteger(parseValue) ? item.match(/^(h|hh)$/i) ? (hour = parseValue, 
        "h" != item && "hh" != item || (hour %= 12)) : "i" == item && (minutes = parseValue) : item.match(/^a$/i) && parseValue.match(/^p/i) && ("h" in parsingObject || "hh" in parsingObject) && (isPM = !0);
        return 60 * (isPM ? hour + 12 : hour) + minutes;
    }, TimePicker.prototype.formats = {
        h: function(string, timeObject) {
            return string ? _.digits(string) : timeObject.hour % 12 || 12;
        },
        hh: function(string, timeObject) {
            return string ? 2 : _.lead(timeObject.hour % 12 || 12);
        },
        H: function(string, timeObject) {
            return string ? _.digits(string) : "" + timeObject.hour % 24;
        },
        HH: function(string, timeObject) {
            return string ? _.digits(string) : _.lead(timeObject.hour % 24);
        },
        i: function(string, timeObject) {
            return string ? 2 : _.lead(timeObject.mins);
        },
        a: function(string, timeObject) {
            return string ? 4 : 720 > timeObject.time % 1440 ? "a.m." : "p.m.";
        },
        A: function(string, timeObject) {
            return string ? 2 : 720 > timeObject.time % 1440 ? "AM" : "PM";
        },
        toArray: function(formatString) {
            return formatString.split(/(h{1,2}|H{1,2}|i|a|A|!.)/g);
        },
        toString: function(formatString, itemObject) {
            var clock = this;
            return clock.formats.toArray(formatString).map(function(label) {
                return _.trigger(clock.formats[label], clock, [ 0, itemObject ]) || label.replace(/^!/, "");
            }).join("");
        }
    }, TimePicker.prototype.isTimeExact = function(one, two) {
        var clock = this;
        return _.isInteger(one) && _.isInteger(two) || "boolean" == typeof one && "boolean" == typeof two ? one === two : (_.isDate(one) || $.isArray(one)) && (_.isDate(two) || $.isArray(two)) ? clock.create(one).pick === clock.create(two).pick : !(!$.isPlainObject(one) || !$.isPlainObject(two)) && (clock.isTimeExact(one.from, two.from) && clock.isTimeExact(one.to, two.to));
    }, TimePicker.prototype.isTimeOverlap = function(one, two) {
        var clock = this;
        return _.isInteger(one) && (_.isDate(two) || $.isArray(two)) ? one === clock.create(two).hour : _.isInteger(two) && (_.isDate(one) || $.isArray(one)) ? two === clock.create(one).hour : !(!$.isPlainObject(one) || !$.isPlainObject(two)) && clock.overlapRanges(one, two);
    }, TimePicker.prototype.flipEnable = function(val) {
        var itemObject = this.item;
        itemObject.enable = val || (-1 == itemObject.enable ? 1 : -1);
    }, TimePicker.prototype.deactivate = function(type, timesToDisable) {
        var clock = this, disabledItems = clock.item.disable.slice(0);
        return "flip" == timesToDisable ? clock.flipEnable() : !1 === timesToDisable ? (clock.flipEnable(1), 
        disabledItems = []) : !0 === timesToDisable ? (clock.flipEnable(-1), disabledItems = []) : timesToDisable.map(function(unitToDisable) {
            for (var matchFound, index = 0; index < disabledItems.length; index += 1) if (clock.isTimeExact(unitToDisable, disabledItems[index])) {
                matchFound = !0;
                break;
            }
            matchFound || (_.isInteger(unitToDisable) || _.isDate(unitToDisable) || $.isArray(unitToDisable) || $.isPlainObject(unitToDisable) && unitToDisable.from && unitToDisable.to) && disabledItems.push(unitToDisable);
        }), disabledItems;
    }, TimePicker.prototype.activate = function(type, timesToEnable) {
        var clock = this, disabledItems = clock.item.disable, disabledItemsCount = disabledItems.length;
        return "flip" == timesToEnable ? clock.flipEnable() : !0 === timesToEnable ? (clock.flipEnable(1), 
        disabledItems = []) : !1 === timesToEnable ? (clock.flipEnable(-1), disabledItems = []) : timesToEnable.map(function(unitToEnable) {
            var matchFound, disabledUnit, index, isRangeMatched;
            for (index = 0; index < disabledItemsCount; index += 1) {
                if (disabledUnit = disabledItems[index], clock.isTimeExact(disabledUnit, unitToEnable)) {
                    matchFound = disabledItems[index] = null, isRangeMatched = !0;
                    break;
                }
                if (clock.isTimeOverlap(disabledUnit, unitToEnable)) {
                    $.isPlainObject(unitToEnable) ? (unitToEnable.inverted = !0, matchFound = unitToEnable) : $.isArray(unitToEnable) ? (matchFound = unitToEnable, 
                    matchFound[2] || matchFound.push("inverted")) : _.isDate(unitToEnable) && (matchFound = [ unitToEnable.getFullYear(), unitToEnable.getMonth(), unitToEnable.getDate(), "inverted" ]);
                    break;
                }
            }
            if (matchFound) for (index = 0; index < disabledItemsCount; index += 1) if (clock.isTimeExact(disabledItems[index], unitToEnable)) {
                disabledItems[index] = null;
                break;
            }
            if (isRangeMatched) for (index = 0; index < disabledItemsCount; index += 1) if (clock.isTimeOverlap(disabledItems[index], unitToEnable)) {
                disabledItems[index] = null;
                break;
            }
            matchFound && disabledItems.push(matchFound);
        }), disabledItems.filter(function(val) {
            return null != val;
        });
    }, TimePicker.prototype.i = function(type, value) {
        return _.isInteger(value) && value > 0 ? value : this.item.interval;
    }, TimePicker.prototype.nodes = function(isOpen) {
        var clock = this, settings = clock.settings, selectedObject = clock.item.select, highlightedObject = clock.item.highlight, viewsetObject = clock.item.view, disabledCollection = clock.item.disable;
        return _.node("ul", _.group({
            min: clock.item.min.pick,
            max: clock.item.max.pick,
            i: clock.item.interval,
            node: "li",
            item: function(loopedTime) {
                loopedTime = clock.create(loopedTime);
                var timeMinutes = loopedTime.pick, isSelected = selectedObject && selectedObject.pick == timeMinutes, isHighlighted = highlightedObject && highlightedObject.pick == timeMinutes, isDisabled = disabledCollection && clock.disabled(loopedTime), formattedTime = _.trigger(clock.formats.toString, clock, [ settings.format, loopedTime ]);
                return [ _.trigger(clock.formats.toString, clock, [ _.trigger(settings.formatLabel, clock, [ loopedTime ]) || settings.format, loopedTime ]), function(klasses) {
                    return isSelected && klasses.push(settings.klass.selected), isHighlighted && klasses.push(settings.klass.highlighted), 
                    viewsetObject && viewsetObject.pick == timeMinutes && klasses.push(settings.klass.viewset), 
                    isDisabled && klasses.push(settings.klass.disabled), klasses.join(" ");
                }([ settings.klass.listItem ]), "data-pick=" + loopedTime.pick + " " + _.ariaAttr({
                    role: "option",
                    label: formattedTime,
                    selected: !(!isSelected || clock.$node.val() !== formattedTime) || null,
                    activedescendant: !!isHighlighted || null,
                    disabled: !!isDisabled || null
                }) ];
            }
        }) + _.node("li", _.node("button", settings.clear, settings.klass.buttonClear, "type=button data-clear=1" + (isOpen ? "" : " disabled") + " " + _.ariaAttr({
            controls: clock.$node[0].id
        })), "", _.ariaAttr({
            role: "presentation"
        })), settings.klass.list, _.ariaAttr({
            role: "listbox",
            controls: clock.$node[0].id
        }));
    }, TimePicker.defaults = function(prefix) {
        return {
            clear: "Clear",
            format: "h:i A",
            interval: 30,
            closeOnSelect: !0,
            closeOnClear: !0,
            klass: {
                picker: prefix + " " + prefix + "--time",
                holder: prefix + "__holder",
                list: prefix + "__list",
                listItem: prefix + "__list-item",
                disabled: prefix + "__list-item--disabled",
                selected: prefix + "__list-item--selected",
                highlighted: prefix + "__list-item--highlighted",
                viewset: prefix + "__list-item--viewset",
                now: prefix + "__list-item--now",
                buttonClear: prefix + "__button--clear"
            }
        };
    }(Picker.klasses().picker), Picker.extend("pickatime", TimePicker);
}), function(root, factory) {
    "use strict";
    var moment;
    if ("object" == typeof exports) {
        try {
            moment = require("moment");
        } catch (e) {}
        module.exports = factory(moment);
    } else "function" == typeof define && define.amd ? define(function(req) {
        try {
            moment = req("moment");
        } catch (e) {}
        return factory(moment);
    }) : root.Pikaday = factory(root.moment);
}(this, function(moment) {
    "use strict";
    var hasMoment = "function" == typeof moment, hasEventListeners = !!window.addEventListener, document = window.document, sto = window.setTimeout, addEvent = function(el, e, callback, capture) {
        hasEventListeners ? el.addEventListener(e, callback, !!capture) : el.attachEvent("on" + e, callback);
    }, removeEvent = function(el, e, callback, capture) {
        hasEventListeners ? el.removeEventListener(e, callback, !!capture) : el.detachEvent("on" + e, callback);
    }, fireEvent = function(el, eventName, data) {
        var ev;
        document.createEvent ? (ev = document.createEvent("HTMLEvents"), ev.initEvent(eventName, !0, !1), 
        ev = extend(ev, data), el.dispatchEvent(ev)) : document.createEventObject && (ev = document.createEventObject(), 
        ev = extend(ev, data), el.fireEvent("on" + eventName, ev));
    }, trim = function(str) {
        return str.trim ? str.trim() : str.replace(/^\s+|\s+$/g, "");
    }, hasClass = function(el, cn) {
        return -1 !== (" " + el.className + " ").indexOf(" " + cn + " ");
    }, addClass = function(el, cn) {
        hasClass(el, cn) || (el.className = "" === el.className ? cn : el.className + " " + cn);
    }, removeClass = function(el, cn) {
        el.className = trim((" " + el.className + " ").replace(" " + cn + " ", " "));
    }, isArray = function(obj) {
        return /Array/.test(Object.prototype.toString.call(obj));
    }, isDate = function(obj) {
        return /Date/.test(Object.prototype.toString.call(obj)) && !isNaN(obj.getTime());
    }, isWeekend = function(date) {
        var day = date.getDay();
        return 0 === day || 6 === day;
    }, isLeapYear = function(year) {
        return year % 4 == 0 && year % 100 != 0 || year % 400 == 0;
    }, getDaysInMonth = function(year, month) {
        return [ 31, isLeapYear(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ][month];
    }, setToStartOfDay = function(date) {
        isDate(date) && date.setHours(0, 0, 0, 0);
    }, compareDates = function(a, b) {
        return a.getTime() === b.getTime();
    }, extend = function(to, from, overwrite) {
        var prop, hasProp;
        for (prop in from) hasProp = void 0 !== to[prop], hasProp && "object" == typeof from[prop] && null !== from[prop] && void 0 === from[prop].nodeName ? isDate(from[prop]) ? overwrite && (to[prop] = new Date(from[prop].getTime())) : isArray(from[prop]) ? overwrite && (to[prop] = from[prop].slice(0)) : to[prop] = extend({}, from[prop], overwrite) : !overwrite && hasProp || (to[prop] = from[prop]);
        return to;
    }, adjustCalendar = function(calendar) {
        return calendar.month < 0 && (calendar.year -= Math.ceil(Math.abs(calendar.month) / 12), 
        calendar.month += 12), calendar.month > 11 && (calendar.year += Math.floor(Math.abs(calendar.month) / 12), 
        calendar.month -= 12), calendar;
    }, defaults = {
        field: null,
        bound: void 0,
        position: "bottom left",
        reposition: !0,
        format: "YYYY-MM-DD",
        defaultDate: null,
        setDefaultDate: !1,
        firstDay: 0,
        formatStrict: !1,
        minDate: null,
        maxDate: null,
        yearRange: 10,
        showWeekNumber: !1,
        pickWholeWeek: !1,
        minYear: 0,
        maxYear: 9999,
        minMonth: void 0,
        maxMonth: void 0,
        startRange: null,
        endRange: null,
        isRTL: !1,
        yearSuffix: "",
        showMonthAfterYear: !1,
        showDaysInNextAndPreviousMonths: !1,
        numberOfMonths: 1,
        mainCalendar: "left",
        container: void 0,
        blurFieldOnSelect: !0,
        i18n: {
            previousMonth: "Previous Month",
            nextMonth: "Next Month",
            months: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
            weekdays: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ],
            weekdaysShort: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ]
        },
        theme: null,
        events: [],
        onSelect: null,
        onOpen: null,
        onClose: null,
        onDraw: null
    }, renderDayName = function(opts, day, abbr) {
        for (day += opts.firstDay; day >= 7; ) day -= 7;
        return abbr ? opts.i18n.weekdaysShort[day] : opts.i18n.weekdays[day];
    }, renderDay = function(opts) {
        var arr = [], ariaSelected = "false";
        if (opts.isEmpty) {
            if (!opts.showDaysInNextAndPreviousMonths) return '<td class="is-empty"></td>';
            arr.push("is-outside-current-month");
        }
        return opts.isDisabled && arr.push("is-disabled"), opts.isToday && arr.push("is-today"), 
        opts.isSelected && (arr.push("is-selected"), ariaSelected = "true"), opts.hasEvent && arr.push("has-event"), 
        opts.isInRange && arr.push("is-inrange"), opts.isStartRange && arr.push("is-startrange"), 
        opts.isEndRange && arr.push("is-endrange"), '<td data-day="' + opts.day + '" class="' + arr.join(" ") + '" aria-selected="' + ariaSelected + '"><button class="pika-button pika-day" type="button" data-pika-year="' + opts.year + '" data-pika-month="' + opts.month + '" data-pika-day="' + opts.day + '">' + opts.day + "</button></td>";
    }, renderWeek = function(d, m, y) {
        var onejan = new Date(y, 0, 1);
        return '<td class="pika-week">' + Math.ceil(((new Date(y, m, d) - onejan) / 864e5 + onejan.getDay() + 1) / 7) + "</td>";
    }, renderRow = function(days, isRTL, pickWholeWeek, isRowSelected) {
        return '<tr class="pika-row' + (pickWholeWeek ? " pick-whole-week" : "") + (isRowSelected ? " is-selected" : "") + '">' + (isRTL ? days.reverse() : days).join("") + "</tr>";
    }, renderBody = function(rows) {
        return "<tbody>" + rows.join("") + "</tbody>";
    }, renderHead = function(opts) {
        var i, arr = [];
        for (opts.showWeekNumber && arr.push("<th></th>"), i = 0; i < 7; i++) arr.push('<th scope="col"><abbr title="' + renderDayName(opts, i) + '">' + renderDayName(opts, i, !0) + "</abbr></th>");
        return "<thead><tr>" + (opts.isRTL ? arr.reverse() : arr).join("") + "</tr></thead>";
    }, renderTitle = function(instance, c, year, month, refYear, randId) {
        var i, j, arr, monthHtml, yearHtml, opts = instance._o, isMinYear = year === opts.minYear, isMaxYear = year === opts.maxYear, html = '<div id="' + randId + '" class="pika-title" role="heading" aria-live="assertive">', prev = !0, next = !0;
        for (arr = [], i = 0; i < 12; i++) arr.push('<option value="' + (year === refYear ? i - c : 12 + i - c) + '"' + (i === month ? ' selected="selected"' : "") + (isMinYear && i < opts.minMonth || isMaxYear && i > opts.maxMonth ? 'disabled="disabled"' : "") + ">" + opts.i18n.months[i] + "</option>");
        for (monthHtml = '<div class="pika-label">' + opts.i18n.months[month] + '<select class="pika-select pika-select-month" tabindex="-1">' + arr.join("") + "</select></div>", 
        isArray(opts.yearRange) ? (i = opts.yearRange[0], j = opts.yearRange[1] + 1) : (i = year - opts.yearRange, 
        j = 1 + year + opts.yearRange), arr = []; i < j && i <= opts.maxYear; i++) i >= opts.minYear && arr.push('<option value="' + i + '"' + (i === year ? ' selected="selected"' : "") + ">" + i + "</option>");
        return yearHtml = '<div class="pika-label">' + year + opts.yearSuffix + '<select class="pika-select pika-select-year" tabindex="-1">' + arr.join("") + "</select></div>", 
        opts.showMonthAfterYear ? html += yearHtml + monthHtml : html += monthHtml + yearHtml, 
        isMinYear && (0 === month || opts.minMonth >= month) && (prev = !1), isMaxYear && (11 === month || opts.maxMonth <= month) && (next = !1), 
        0 === c && (html += '<button class="pika-prev' + (prev ? "" : " is-disabled") + '" type="button">' + opts.i18n.previousMonth + "</button>"), 
        c === instance._o.numberOfMonths - 1 && (html += '<button class="pika-next' + (next ? "" : " is-disabled") + '" type="button">' + opts.i18n.nextMonth + "</button>"), 
        html += "</div>";
    }, renderTable = function(opts, data, randId) {
        return '<table cellpadding="0" cellspacing="0" class="pika-table" role="grid" aria-labelledby="' + randId + '">' + renderHead(opts) + renderBody(data) + "</table>";
    }, Pikaday = function(options) {
        var self = this, opts = self.config(options);
        self._onMouseDown = function(e) {
            if (self._v) {
                e = e || window.event;
                var target = e.target || e.srcElement;
                if (target) if (hasClass(target, "is-disabled") || (!hasClass(target, "pika-button") || hasClass(target, "is-empty") || hasClass(target.parentNode, "is-disabled") ? hasClass(target, "pika-prev") ? self.prevMonth() : hasClass(target, "pika-next") && self.nextMonth() : (self.setDate(new Date(target.getAttribute("data-pika-year"), target.getAttribute("data-pika-month"), target.getAttribute("data-pika-day"))), 
                opts.bound && sto(function() {
                    self.hide(), opts.blurFieldOnSelect && opts.field && opts.field.blur();
                }, 100))), hasClass(target, "pika-select")) self._c = !0; else {
                    if (!e.preventDefault) return e.returnValue = !1, !1;
                    e.preventDefault();
                }
            }
        }, self._onChange = function(e) {
            e = e || window.event;
            var target = e.target || e.srcElement;
            target && (hasClass(target, "pika-select-month") ? self.gotoMonth(target.value) : hasClass(target, "pika-select-year") && self.gotoYear(target.value));
        }, self._onKeyChange = function(e) {
            if (e = e || window.event, self.isVisible()) switch (e.keyCode) {
              case 13:
              case 27:
                opts.field && opts.field.blur();
                break;

              case 37:
                e.preventDefault(), self.adjustDate("subtract", 1);
                break;

              case 38:
                self.adjustDate("subtract", 7);
                break;

              case 39:
                self.adjustDate("add", 1);
                break;

              case 40:
                self.adjustDate("add", 7);
            }
        }, self._onInputChange = function(e) {
            var date;
            e.firedBy !== self && (hasMoment ? (date = moment(opts.field.value, opts.format, opts.formatStrict), 
            date = date && date.isValid() ? date.toDate() : null) : date = new Date(Date.parse(opts.field.value)), 
            isDate(date) && self.setDate(date), self._v || self.show());
        }, self._onInputFocus = function() {
            self.show();
        }, self._onInputClick = function() {
            self.show();
        }, self._onInputBlur = function() {
            var pEl = document.activeElement;
            do {
                if (hasClass(pEl, "pika-single")) return;
            } while (pEl = pEl.parentNode);
            self._c || (self._b = sto(function() {
                self.hide();
            }, 50)), self._c = !1;
        }, self._onClick = function(e) {
            e = e || window.event;
            var target = e.target || e.srcElement, pEl = target;
            if (target) {
                !hasEventListeners && hasClass(target, "pika-select") && (target.onchange || (target.setAttribute("onchange", "return;"), 
                addEvent(target, "change", self._onChange)));
                do {
                    if (hasClass(pEl, "pika-single") || pEl === opts.trigger) return;
                } while (pEl = pEl.parentNode);
                self._v && target !== opts.trigger && pEl !== opts.trigger && self.hide();
            }
        }, self.el = document.createElement("div"), self.el.className = "pika-single" + (opts.isRTL ? " is-rtl" : "") + (opts.theme ? " " + opts.theme : ""), 
        addEvent(self.el, "mousedown", self._onMouseDown, !0), addEvent(self.el, "touchend", self._onMouseDown, !0), 
        addEvent(self.el, "change", self._onChange), addEvent(document, "keydown", self._onKeyChange), 
        opts.field && (opts.container ? opts.container.appendChild(self.el) : opts.bound ? document.body.appendChild(self.el) : opts.field.parentNode.insertBefore(self.el, opts.field.nextSibling), 
        addEvent(opts.field, "change", self._onInputChange), opts.defaultDate || (hasMoment && opts.field.value ? opts.defaultDate = moment(opts.field.value, opts.format).toDate() : opts.defaultDate = new Date(Date.parse(opts.field.value)), 
        opts.setDefaultDate = !0));
        var defDate = opts.defaultDate;
        isDate(defDate) ? opts.setDefaultDate ? self.setDate(defDate, !0) : self.gotoDate(defDate) : self.gotoDate(new Date()), 
        opts.bound ? (this.hide(), self.el.className += " is-bound", addEvent(opts.trigger, "click", self._onInputClick), 
        addEvent(opts.trigger, "focus", self._onInputFocus), addEvent(opts.trigger, "blur", self._onInputBlur)) : this.show();
    };
    return Pikaday.prototype = {
        config: function(options) {
            this._o || (this._o = extend({}, defaults, !0));
            var opts = extend(this._o, options, !0);
            opts.isRTL = !!opts.isRTL, opts.field = opts.field && opts.field.nodeName ? opts.field : null, 
            opts.theme = "string" == typeof opts.theme && opts.theme ? opts.theme : null, opts.bound = !!(void 0 !== opts.bound ? opts.field && opts.bound : opts.field), 
            opts.trigger = opts.trigger && opts.trigger.nodeName ? opts.trigger : opts.field, 
            opts.disableWeekends = !!opts.disableWeekends, opts.disableDayFn = "function" == typeof opts.disableDayFn ? opts.disableDayFn : null;
            var nom = parseInt(opts.numberOfMonths, 10) || 1;
            if (opts.numberOfMonths = nom > 4 ? 4 : nom, isDate(opts.minDate) || (opts.minDate = !1), 
            isDate(opts.maxDate) || (opts.maxDate = !1), opts.minDate && opts.maxDate && opts.maxDate < opts.minDate && (opts.maxDate = opts.minDate = !1), 
            opts.minDate && this.setMinDate(opts.minDate), opts.maxDate && this.setMaxDate(opts.maxDate), 
            isArray(opts.yearRange)) {
                var fallback = new Date().getFullYear() - 10;
                opts.yearRange[0] = parseInt(opts.yearRange[0], 10) || fallback, opts.yearRange[1] = parseInt(opts.yearRange[1], 10) || fallback;
            } else opts.yearRange = Math.abs(parseInt(opts.yearRange, 10)) || defaults.yearRange, 
            opts.yearRange > 100 && (opts.yearRange = 100);
            return opts;
        },
        toString: function(format) {
            return isDate(this._d) ? hasMoment ? moment(this._d).format(format || this._o.format) : this._d.toDateString() : "";
        },
        getMoment: function() {
            return hasMoment ? moment(this._d) : null;
        },
        setMoment: function(date, preventOnSelect) {
            hasMoment && moment.isMoment(date) && this.setDate(date.toDate(), preventOnSelect);
        },
        getDate: function() {
            return isDate(this._d) ? new Date(this._d.getTime()) : null;
        },
        setDate: function(date, preventOnSelect) {
            if (!date) return this._d = null, this._o.field && (this._o.field.value = "", fireEvent(this._o.field, "change", {
                firedBy: this
            })), this.draw();
            if ("string" == typeof date && (date = new Date(Date.parse(date))), isDate(date)) {
                var min = this._o.minDate, max = this._o.maxDate;
                isDate(min) && date < min ? date = min : isDate(max) && date > max && (date = max), 
                this._d = new Date(date.getTime()), setToStartOfDay(this._d), this.gotoDate(this._d), 
                this._o.field && (this._o.field.value = this.toString(), fireEvent(this._o.field, "change", {
                    firedBy: this
                })), preventOnSelect || "function" != typeof this._o.onSelect || this._o.onSelect.call(this, this.getDate());
            }
        },
        gotoDate: function(date) {
            var newCalendar = !0;
            if (isDate(date)) {
                if (this.calendars) {
                    var firstVisibleDate = new Date(this.calendars[0].year, this.calendars[0].month, 1), lastVisibleDate = new Date(this.calendars[this.calendars.length - 1].year, this.calendars[this.calendars.length - 1].month, 1), visibleDate = date.getTime();
                    lastVisibleDate.setMonth(lastVisibleDate.getMonth() + 1), lastVisibleDate.setDate(lastVisibleDate.getDate() - 1), 
                    newCalendar = visibleDate < firstVisibleDate.getTime() || lastVisibleDate.getTime() < visibleDate;
                }
                newCalendar && (this.calendars = [ {
                    month: date.getMonth(),
                    year: date.getFullYear()
                } ], "right" === this._o.mainCalendar && (this.calendars[0].month += 1 - this._o.numberOfMonths)), 
                this.adjustCalendars();
            }
        },
        adjustDate: function(sign, days) {
            var newDay, day = this.getDate() || new Date(), difference = 24 * parseInt(days) * 60 * 60 * 1e3;
            "add" === sign ? newDay = new Date(day.valueOf() + difference) : "subtract" === sign && (newDay = new Date(day.valueOf() - difference)), 
            hasMoment && ("add" === sign ? newDay = moment(day).add(days, "days").toDate() : "subtract" === sign && (newDay = moment(day).subtract(days, "days").toDate())), 
            this.setDate(newDay);
        },
        adjustCalendars: function() {
            this.calendars[0] = adjustCalendar(this.calendars[0]);
            for (var c = 1; c < this._o.numberOfMonths; c++) this.calendars[c] = adjustCalendar({
                month: this.calendars[0].month + c,
                year: this.calendars[0].year
            });
            this.draw();
        },
        gotoToday: function() {
            this.gotoDate(new Date());
        },
        gotoMonth: function(month) {
            isNaN(month) || (this.calendars[0].month = parseInt(month, 10), this.adjustCalendars());
        },
        nextMonth: function() {
            this.calendars[0].month++, this.adjustCalendars();
        },
        prevMonth: function() {
            this.calendars[0].month--, this.adjustCalendars();
        },
        gotoYear: function(year) {
            isNaN(year) || (this.calendars[0].year = parseInt(year, 10), this.adjustCalendars());
        },
        setMinDate: function(value) {
            value instanceof Date ? (setToStartOfDay(value), this._o.minDate = value, this._o.minYear = value.getFullYear(), 
            this._o.minMonth = value.getMonth()) : (this._o.minDate = defaults.minDate, this._o.minYear = defaults.minYear, 
            this._o.minMonth = defaults.minMonth, this._o.startRange = defaults.startRange), 
            this.draw();
        },
        setMaxDate: function(value) {
            value instanceof Date ? (setToStartOfDay(value), this._o.maxDate = value, this._o.maxYear = value.getFullYear(), 
            this._o.maxMonth = value.getMonth()) : (this._o.maxDate = defaults.maxDate, this._o.maxYear = defaults.maxYear, 
            this._o.maxMonth = defaults.maxMonth, this._o.endRange = defaults.endRange), this.draw();
        },
        setStartRange: function(value) {
            this._o.startRange = value;
        },
        setEndRange: function(value) {
            this._o.endRange = value;
        },
        draw: function(force) {
            if (this._v || force) {
                var randId, opts = this._o, minYear = opts.minYear, maxYear = opts.maxYear, minMonth = opts.minMonth, maxMonth = opts.maxMonth, html = "";
                this._y <= minYear && (this._y = minYear, !isNaN(minMonth) && this._m < minMonth && (this._m = minMonth)), 
                this._y >= maxYear && (this._y = maxYear, !isNaN(maxMonth) && this._m > maxMonth && (this._m = maxMonth)), 
                randId = "pika-title-" + Math.random().toString(36).replace(/[^a-z]+/g, "").substr(0, 2);
                for (var c = 0; c < opts.numberOfMonths; c++) html += '<div class="pika-lendar">' + renderTitle(this, c, this.calendars[c].year, this.calendars[c].month, this.calendars[0].year, randId) + this.render(this.calendars[c].year, this.calendars[c].month, randId) + "</div>";
                this.el.innerHTML = html, opts.bound && "hidden" !== opts.field.type && sto(function() {
                    opts.trigger.focus();
                }, 1), "function" == typeof this._o.onDraw && this._o.onDraw(this), opts.bound && opts.field.setAttribute("aria-label", "Use the arrow keys to pick a date");
            }
        },
        adjustPosition: function() {
            var field, pEl, width, height, viewportWidth, viewportHeight, scrollTop, left, top, clientRect;
            if (!this._o.container) {
                if (this.el.style.position = "absolute", field = this._o.trigger, pEl = field, width = this.el.offsetWidth, 
                height = this.el.offsetHeight, viewportWidth = window.innerWidth || document.documentElement.clientWidth, 
                viewportHeight = window.innerHeight || document.documentElement.clientHeight, scrollTop = window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop, 
                "function" == typeof field.getBoundingClientRect) clientRect = field.getBoundingClientRect(), 
                left = clientRect.left + window.pageXOffset, top = clientRect.bottom + window.pageYOffset; else for (left = pEl.offsetLeft, 
                top = pEl.offsetTop + pEl.offsetHeight; pEl = pEl.offsetParent; ) left += pEl.offsetLeft, 
                top += pEl.offsetTop;
                (this._o.reposition && left + width > viewportWidth || this._o.position.indexOf("right") > -1 && left - width + field.offsetWidth > 0) && (left = left - width + field.offsetWidth), 
                (this._o.reposition && top + height > viewportHeight + scrollTop || this._o.position.indexOf("top") > -1 && top - height - field.offsetHeight > 0) && (top = top - height - field.offsetHeight), 
                this.el.style.left = left + "px", this.el.style.top = top + "px";
            }
        },
        render: function(year, month, randId) {
            var opts = this._o, now = new Date(), days = getDaysInMonth(year, month), before = new Date(year, month, 1).getDay(), data = [], row = [];
            setToStartOfDay(now), opts.firstDay > 0 && (before -= opts.firstDay) < 0 && (before += 7);
            for (var previousMonth = 0 === month ? 11 : month - 1, nextMonth = 11 === month ? 0 : month + 1, yearOfPreviousMonth = 0 === month ? year - 1 : year, yearOfNextMonth = 11 === month ? year + 1 : year, daysInPreviousMonth = getDaysInMonth(yearOfPreviousMonth, previousMonth), cells = days + before, after = cells; after > 7; ) after -= 7;
            cells += 7 - after;
            for (var isWeekSelected = !1, i = 0, r = 0; i < cells; i++) {
                var day = new Date(year, month, i - before + 1), isSelected = !!isDate(this._d) && compareDates(day, this._d), isToday = compareDates(day, now), hasEvent = -1 !== opts.events.indexOf(day.toDateString()), isEmpty = i < before || i >= days + before, dayNumber = i - before + 1, monthNumber = month, yearNumber = year, isStartRange = opts.startRange && compareDates(opts.startRange, day), isEndRange = opts.endRange && compareDates(opts.endRange, day), isInRange = opts.startRange && opts.endRange && opts.startRange < day && day < opts.endRange, isDisabled = opts.minDate && day < opts.minDate || opts.maxDate && day > opts.maxDate || opts.disableWeekends && isWeekend(day) || opts.disableDayFn && opts.disableDayFn(day);
                isEmpty && (i < before ? (dayNumber = daysInPreviousMonth + dayNumber, monthNumber = previousMonth, 
                yearNumber = yearOfPreviousMonth) : (dayNumber -= days, monthNumber = nextMonth, 
                yearNumber = yearOfNextMonth));
                var dayConfig = {
                    day: dayNumber,
                    month: monthNumber,
                    year: yearNumber,
                    hasEvent: hasEvent,
                    isSelected: isSelected,
                    isToday: isToday,
                    isDisabled: isDisabled,
                    isEmpty: isEmpty,
                    isStartRange: isStartRange,
                    isEndRange: isEndRange,
                    isInRange: isInRange,
                    showDaysInNextAndPreviousMonths: opts.showDaysInNextAndPreviousMonths
                };
                opts.pickWholeWeek && isSelected && (isWeekSelected = !0), row.push(renderDay(dayConfig)), 
                7 == ++r && (opts.showWeekNumber && row.unshift(renderWeek(i - before, month, year)), 
                data.push(renderRow(row, opts.isRTL, opts.pickWholeWeek, isWeekSelected)), row = [], 
                r = 0, isWeekSelected = !1);
            }
            return renderTable(opts, data, randId);
        },
        isVisible: function() {
            return this._v;
        },
        show: function() {
            this.isVisible() || (this._v = !0, this.draw(), this._o.bound && (addEvent(document, "click", this._onClick), 
            this.adjustPosition()), removeClass(this.el, "is-hidden"), "function" == typeof this._o.onOpen && this._o.onOpen.call(this));
        },
        hide: function() {
            var v = this._v;
            !1 !== v && (this._o.bound && removeEvent(document, "click", this._onClick), this.el.style.position = "static", 
            this.el.style.left = "auto", this.el.style.top = "auto", addClass(this.el, "is-hidden"), 
            this._v = !1, void 0 !== v && "function" == typeof this._o.onClose && this._o.onClose.call(this));
        },
        destroy: function() {
            this.hide(), removeEvent(this.el, "mousedown", this._onMouseDown, !0), removeEvent(this.el, "touchend", this._onMouseDown, !0), 
            removeEvent(this.el, "change", this._onChange), this._o.field && (removeEvent(this._o.field, "change", this._onInputChange), 
            this._o.bound && (removeEvent(this._o.trigger, "click", this._onInputClick), removeEvent(this._o.trigger, "focus", this._onInputFocus), 
            removeEvent(this._o.trigger, "blur", this._onInputBlur))), this.el.parentNode && this.el.parentNode.removeChild(this.el);
        }
    }, Pikaday;
}), function(root, factory) {
    "use strict";
    "object" == typeof exports ? factory(require("jquery"), require("../pikaday")) : "function" == typeof define && define.amd ? define([ "jquery", "pikaday" ], factory) : factory(root.jQuery, root.Pikaday);
}(this, function($, Pikaday) {
    "use strict";
    $.fn.pikaday = function() {
        var args = arguments;
        return args && args.length || (args = [ {} ]), this.each(function() {
            var self = $(this), plugin = self.data("pikaday");
            if (plugin instanceof Pikaday) "string" == typeof args[0] && "function" == typeof plugin[args[0]] && (plugin[args[0]].apply(plugin, Array.prototype.slice.call(args, 1)), 
            "destroy" === args[0] && self.removeData("pikaday")); else if ("object" == typeof args[0]) {
                var options = $.extend({}, args[0]);
                options.field = self[0], self.data("pikaday", new Pikaday(options));
            }
        });
    };
}), function($) {
    $.fn.savecheck = function(message) {
        $(window).bind("beforeunload", function() {
            return message;
        }), this.click(function() {
            $(window).unbind("beforeunload");
        });
    };
}(jQuery);